<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoanCreateRequest;
use App\Http\Requests\LoanUpdateRequest;
use App\Mail\LoanApprovalRequestMail;
use App\Models\ActivityLog;
use App\Models\Customer;
use App\Models\CustomerType;
use App\Models\Loan;
use App\Models\LoanDetails;
use App\Models\Branch;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Log;
use Mail;

class LoanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        abort_unless(Gate::allows('loan_access') || Gate::allows('branch_access') || Gate::allows('auditor_access'), 404);
        $branch = auth()->user()->branch_id;
        if ($request->search) {
            $lists = Loan::with(['customer'])
                ->where('branch_id', $branch)
                ->when($request->search, function ($query) use ($request) {
                    return $query->where('id', $request->search);
                })
                ->paginate(10);
        } else if ($request->search_name) {
            $lists = Loan::with([
                'customer' => function ($query) use ($request) {
                    $query->where('first_name', 'LIKE', '%' . $request->search_name . '%')
                        ->orWhere('last_name', 'LIKE', '%' . $request->search_name . '%');
                }
            ])
                ->where('branch_id', $branch)
                ->paginate(10);
        } else if ($request->filter) {
            $lists = Loan::with([
                'customer' => function ($query) use ($request) {
                    $query->where('type', 'LIKE', '%' . $request->filter[0] . '%');
                }
            ])
                ->where('branch_id', $branch)
                ->paginate(10);
        } else if ($request->transactionType) {
            $lists = Loan::with(['customer'])
                ->where('transaction_type', $request->transactionType)
                ->where('branch_id', $branch)
                ->paginate(10);
        } else {
            $lists = Loan::where('branch_id', $branch)->paginate(10);
        }
        $types = CustomerType::where('branch_id', $branch)->get();
        $loan = [];
        $customer = [];
        if ($request->transaction_no) {
            $loan = Loan::with('customer')->find($request->transaction_no);
        }
        if ($request->id) {
            $customer = Customer::find($request->id);
        }
        // Check if the request is an AJAX call
        if ($request->ajax()) {
            return response()->json([
                'customer' => $customer,
                'loan' => $loan,
            ]);
        }

        return view('pages.loan.index', compact('lists', 'types', 'customer', 'loan'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        abort_unless(Gate::allows('loan_access') || Gate::allows('branch_access'), 404);
        $branch = auth()->user()->branch_id;
        $types = CustomerType::where('branch_id', $branch)->get();
        $loan = [];
        $customer = [];
        if ($request->transaction_no) {
            $loan = Loan::with('customer')->find($request->transaction_no);
        }
        if ($request->id) {
            $customer = Customer::find($request->id);
        }
        // Check if the request is an AJAX call
        if ($request->ajax()) {
            return response()->json([
                'customer' => $customer,
                'loan' => $loan,
            ]);
        }

        return view('pages.loan.entry.index', compact('types', 'customer', 'loan'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        abort_unless(Gate::allows('loan_access') || Gate::allows('branch_access'), 404);
        try {
            // Retrieve authenticated user's branch ID
            $branch = auth()->user()->branch_id;
            $image = $request->file('upload_file');
            // Validate the input data
            $validatedData = $request->validate([
                'rows.*.id' => 'required|numeric',
                'rows.*.due_date' => 'required|date',
                'rows.*.due_amount' => 'required|numeric',
                'rows.*.remaining_balance' => 'required|numeric',
            ]);

            $check = Loan::with([
                'details' => function ($query) {
                    $query->where('loan_date_paid', null); // Only include unpaid details
                }
            ])
                ->where('customer_id', $request->customer_id)
                ->where('status', 'UNPD')
                ->first();
            // dd($check);

            // $checkDetails = $check->details;
            if (isset($check)) {
                // Count the number of unpaid details
                $unpaidCount = $check->details->count();
                // Calculate the equivalent months (2 unpaid details = 1 month)
                $equivalentMonths = floor($unpaidCount / 2); // Use floor() to round down

                // Add the equivalent_months field to the loan
                $check->equivalent_months = $equivalentMonths;

                if (number_format($equivalentMonths, 0) > 1) {
                    return redirect()->back()->with('loan_restriction', 'Attention: This customer has a ' . number_format($check->equivalent_months, 0) . ' month pending loan and is not eligible for renewal at this time.');
                }

                if (isset($check->details)) {
                    $totalRemaining = 0;

                    foreach ($check->details as $detail) {
                        if ($detail->loan_date_paid === null) {
                            $totalRemaining += $detail->loan_due_amount;
                            $detail->loan_date_paid = Carbon::createFromFormat('Y-m-d', $request->date_of_loan)->format('m/d/Y');
                            $detail->loan_amount_paid = number_format($detail->loan_due_amount, 2);
                            $detail->save();
                        }
                    }
                    $check->remaining = $totalRemaining;

                    // Check if all details are paid
                    $unpaidDetailsCount = $check->details()->where('loan_date_paid', null)->count();
                    if ($unpaidDetailsCount === 0) {
                        // Set loan status to FULPD if all details are paid
                        $loanCheck = Loan::with([
                            'details' => function ($query) {
                                $query->where('loan_date_paid', '!=', null); // Only include unpaid details
                            }
                        ])
                            ->where('customer_id', $request->customer_id)
                            ->where('status', 'UNPD')
                            ->first();
                        $loanCheck->status = 'FULPD';
                        $loanCheck->save();

                        $log = new ActivityLog();
                        $log->user_id = auth()->user()->id;
                        $log->description = 'Client ' . $check->customer->first_name . ' ' . $check->customer->last_name . ' renewed a loan with a remaining balance of ' . $equivalentMonths . ' months, amounting to ' . number_format($totalRemaining, 2) . ', which will be deducted from the renewed loan.';
                        $log->save();
                    }
                }
            }


            // Create the loan entry
            $loan = new Loan();
            $loan->loan_type = $request->loan_type;
            $loan->transaction_type = $request->transaction_type;
            // $loan->trans_no = $request->trans_no; // If needed, uncomment
            $loan->date_of_loan = Carbon::createFromFormat('Y-m-d', $request->date_of_loan)->format('m/d/Y');
            $loan->customer_id = $request->customer_id;
            $loan->customer_type = $request->customer_type;
            $loan->status = null; // Default status (adjust based on your logic)
            $loan->principal_amount = $request->principal_amount;
            $loan->days_to_pay = $request->days_to_pay;
            $loan->months_to_pay = $request->months_to_pay;
            $loan->interest = $request->interest;
            $loan->interest_amount = $request->interest_amount;
            $loan->svc_charge = $request->svc_charge ?? '';
            $loan->actual_record = $request->actual_record ?? '';
            // dd((float)$request->payable_amount - (float)$check->remaining);
            $loan->payable_amount = $request->payable_amount;
            // $loan->note = 'Deducted amount from previous loan: ' . number_format($check->remaining??0, 2);
            $loan->branch_id = $branch;
            $loan->user_id = auth()->user()->id;
            if (isset($image) == true) {
                $imageBase64 = base64_encode(file_get_contents($image));
                $loan->file = $imageBase64;
            }
            $loan->save();

            // Save each payment row as LoanDetails
            foreach ($validatedData['rows'] as $row) {
                LoanDetails::create([
                    'loan_id' => $loan->id,
                    'loan_due_date' => $row['due_date'],
                    'loan_due_amount' => $row['due_amount'],
                    'loan_running_balance' => $row['remaining_balance'],
                    'user_id' => auth()->user()->id,
                    'branch_id' => $branch,
                    'loan_day_no' => $row['id'],
                ]);
            }

            $log = new ActivityLog();
            $log->user_id = auth()->user()->id;
            $log->description = auth()->user()->name . ' Created the loan request.';
            $log->save();

            // Send email to HR
            $hrEmail = 'hr@almarfinance.com'; // Replace with HR email
            // Mail::to($hrEmail)->send(new LoanApprovalRequestMail($loan));
            // Redirect back with success message
            return redirect()->back()->with('success', 'Loan created successfully and is pending approval.');
        } catch (\Throwable $th) {
            // Redirect back with the error message
            return redirect()->back()->with('error', 'Error: ' . $th->getMessage());
        }

    }

    public function gracePeriod(LoanCreateRequest $request)
    {
        abort_unless(Gate::allows('loan_access') || Gate::allows('branch_access'), 404);
        // dd($request->all());
        try {
            // Retrieve authenticated user's branch ID
            $branch = auth()->user()->branch_id;
            // Validate the input data
            $validatedData = $request->validate([
                'rows.*.id' => 'required|numeric',
                'rows.*.due_date' => 'required|date',
                'rows.*.due_amount' => 'required|numeric',
                'rows.*.remaining_balance' => 'required|numeric',
            ]);
            $amountDue = LoanDetails::where('id', $request->id)->first();
            $amountDue->loan_running_balance = $request->loan_due_amount;
            $amountDue->loan_date_paid = now()->format('m/d/Y');
            $amountDue->loan_amount_paid = 0;
            $amountDue->loan_remarks = 'Added Grace Period';
            $amountDue->update(); // this part need to be changed, update all the remaining balance, date paid, and amount paid

            // Save each payment row as LoanDetails
            foreach ($validatedData['rows'] as $row) {
                LoanDetails::create([
                    'loan_id' => $amountDue->loan_id,
                    'loan_due_date' => $row['due_date'],
                    'loan_due_amount' => $row['due_amount'],
                    'loan_running_balance' => $row['remaining_balance'],
                    'user_id' => auth()->user()->id,
                    'branch_id' => $branch,
                    'loan_day_no' => $row['id'],
                ]);
            }

            $log = new ActivityLog();
            $log->user_id = auth()->user()->id;
            $log->description = auth()->user()->name . ' Allowed Grace Period, Loan #' . $request->id;
            $log->save();

            return redirect()->back()->with('success', 'Allowed Grace Period.');
        } catch (\Throwable $th) {
            // Redirect back with the error message
            return redirect()->back()->with('error', 'Error: ' . $th->getMessage());
        }

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        abort_unless(Gate::allows('loan_access') || Gate::allows('branch_access') || Gate::allows('auditor_access'), 404);
        $branch = auth()->user()->branch_id;
        $loan = Loan::where('branch_id', $branch)->where('id', $id)->first();
        $amountDue = LoanDetails::where('loan_id', $loan->id)
            ->where('loan_amount_paid', null)
            ->where('loan_running_balance', '0.00')
            ->first();

        return view('pages.loan.show.index', compact('loan', 'amountDue'));
    }

    public function updateDueDate(Request $request, string $id)
    {
        abort_unless(Gate::allows('loan_access') || Gate::allows('branch_access') || Gate::allows('auditor_access'), 404);

        // Update the due date
        $loanDetail = LoanDetails::findOrFail($id);
        if ($loanDetail) {
            $loanDetail->loan_due_date = $request->due_date;
            $loanDetail->save();
        }

        return redirect()->back()->with('success', 'Updated Successfuly!');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        abort_unless(Gate::allows('loan_access') || Gate::allows('branch_access'), 404);
        $branch = auth()->user()->branch_id;
        $loan = Loan::where('branch_id', $branch)->where('id', $id)->first();

        return view('pages.loan.update.index', compact('loan'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(LoanUpdateRequest $request, string $id)
    {
        abort_unless(Gate::allows('loan_access') || Gate::allows('branch_access'), 404);
        if ($request->validated()) {
            $loan = Loan::find($id);
            $loan->loan_type = $request->loan_type;
            $loan->transaction_type = $request->transaction_type;
            $loan->trans_no = $request->trans_no;
            $loan->date_of_loan = Carbon::createFromFormat('Y-m-d', $request->date_of_loan)->format('m/d/Y');
            ;
            $loan->customer_id = $request->customer_id;
            $loan->customer_type = $request->customer_type;
            $loan->status = $request->status;
            $loan->principal_amount = $request->principal_amount;
            $loan->days_to_pay = $request->days_to_pay;
            $loan->months_to_pay = $request->months_to_pay;
            $loan->interest = $request->interest;
            $loan->interest_amount = $request->interest_amount;
            $loan->svc_charge = $request->svc_charge ?? '';
            $loan->actual_record = $request->actual_record ?? '';
            $loan->payable_amount = $request->payable_amount;
            // if($loan->transaction_customer_status == 'BA'){
            //     $loan->transaction_customer_status = null;
            // }
            $loan->update();

            $log = new ActivityLog();
            $log->user_id = auth()->user()->id;
            $log->description = auth()->user()->name . ' Updated the loan request.';
            $log->save();

            return redirect()->back()->with('success', 'Loan Entry Updated.');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        abort_unless(Gate::allows('loan_access') || Gate::allows('branch_access'), 404);
        $loan = Loan::find($id);
        $loan->delete();

        $log = new ActivityLog();
        $log->user_id = auth()->user()->id;
        $log->description = auth()->user()->name . ' Deleted the loan request.';
        $log->save();

        return redirect()->back()->with('success', 'Loan deleted.');
    }

    public function importCSV(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:csv,txt|max:2048', // Validate the uploaded file
        ]);
        $branch = auth()->user()->branch_id;

        $file = $request->file('file');

        // Read the CSV data
        $csvData = file_get_contents($file);
        // dd($csvData);

        // Split CSV data into rows
        $rows = array_map('str_getcsv', explode("\n", $csvData));

        // Remove the header row if it exists
        $header = array_shift($rows);
        // dd($header);
        foreach ($rows as $row) {
            $formattedAmount = (float) str_replace(',', '', $row[3]); // Remove commas and convert to float
            // Create and save your model instance
            Loan::create([
                'id' => $row[0],
                'date_of_loan' => $row[1],
                'customer_id' => $row[2],
                'principal_amount' => number_format($formattedAmount, 2, '.', ''),
                'payable_amount' => $row[4],
                'days_to_pay' => $row[5],
                'months_to_pay' => $row[6],
                'interest' => $row[7],
                'status' => $row[9],
                'transaction_customer_status' => $row[10],
                'transaction_customer_status_date' => $row[11],
                'transaction_type' => $row[12],
                'transaction_with_collateral' => $row[13],
                'transaction_with_cert' => $row[14],
                'user_id' => $row[15],
                'branch_id' => $branch,
            ]);
        }

        $log = new ActivityLog();
        $log->user_id = auth()->user()->id;
        $log->description = auth()->user()->name . ' Imported the loan list.';
        $log->save();

        return redirect(route("loan.index"))->with('success', 'CSV Data Imported Successfully');
    }

    public function importCSVDetails(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:csv,txt|max:20000', // Validate the uploaded file
        ]);
        $branch = auth()->user()->branch_id;

        $file = $request->file('file');

        // Read the CSV data
        $csvData = file_get_contents($file);

        // Split CSV data into rows
        $rows = array_map('str_getcsv', explode("\n", $csvData));

        // Remove the header row if it exists
        $header = array_shift($rows);
        // dd($header);

        foreach ($rows as $row) {
            $formattedAmount = (float) str_replace(',', '', $row[4]);
            $formattedPaid = (float) str_replace(',', '', $row[6]);
            $formattedBal = (float) str_replace(',', '', $row[7]);
            $formattedTend = (float) str_replace(',', '', $row[13]);
            $formattedChange = (float) str_replace(',', '', $row[14]);
            // Create and save your model instance
            LoanDetails::create([
                'id' => $row[1],
                'loan_id' => $row[0],//Lnkltranh_no
                'loan_day_no' => $row[2],//ltrand_dayno
                'loan_due_date' => $row[3],//ltrand_duedate
                'loan_due_amount' => number_format($formattedAmount, 2, '.', ''),//ltrand_dueamt
                'loan_date_paid' => $row[5],//ltrand_datepaid
                'loan_amount_paid' => number_format($formattedPaid, 2, '.', ''),//ltrand_amtpaid
                'loan_running_balance' => number_format($formattedBal, 2, '.', ''),//ltrand_runbal
                'user_id' => $row[9],//ltrand_clctor
                'loan_bank' => $row[10],//ltrand_bank
                'loan_check_no' => $row[11],//ltrand_chkno
                'loan_remarks' => $row[12],//ltrand_rem
                'loan_amount_tenderd' => number_format($formattedTend, 2, '.', ''),//ltrand_amttend
                'loan_amount_change' => number_format($formattedChange, 2, '.', ''),//ltrand_amtchange
                'loan_withdraw_from_bank' => $row[15],//ltrand_withdrawn_frombank
                'branch_id' => $branch,
            ]);
        }

        $log = new ActivityLog();
        $log->user_id = auth()->user()->id;
        $log->description = auth()->user()->name . ' Imported the loan details.';
        $log->save();

        return redirect(route("loan.index"))->with('success', 'Loan Details Imported Successfully');
    }

    public function approve(Request $request, $id)
    {
        $loan = Loan::findOrFail($id);
        $loan->trans_no = $loan->id;
        $loan->status = 'UNPD';
        $loan->user_id = auth()->user()->id;
        $loan->note = $request->input('reason');
        $loan->update();

        $log = new ActivityLog();
        $log->user_id = auth()->user()->id;
        $log->description = auth()->user()->name . ' Approved the loan request.';
        $log->save();

        return redirect()->back()->with('success', 'Loan Approved.');
    }

    public function approveAPI(Request $request, $id)
    {
        $loan = Loan::findOrFail($id);
        $loan->trans_no = $loan->id;
        $loan->status = 'UNPD';
        $loan->user_id = 3;
        $loan->note = $request->input('reason');
        $loan->update();

        $log = new ActivityLog();
        $log->user_id = 3;
        $log->description = 'HR Approved the loan request.';
        $log->save();

        return response()->isSuccessful();
    }

    public function decline(Request $request, $id)
    {
        // Find the loan by ID
        $loan = Loan::findOrFail($id);

        // Set the fields
        $loan->trans_no = $loan->id;  // Ensure this is the correct logic for trans_no
        $loan->status = 'CNCLD';       // Assuming 'CLOSE' is a valid status
        $loan->user_id = auth()->user()->id;  // Ensure the user is authenticated
        $loan->note = $request->input('reason'); // Get the reason for decline

        // Save the changes
        $loan->save();

        $log = new ActivityLog();
        $log->user_id = auth()->user()->id;
        $log->description = auth()->user()->name . ' Declined the loan request.';
        $log->save();

        // Redirect with a success message
        return redirect()->back()->with('success', 'Loan has been declined with the provided reason.');
    }

    public function declineAPI(Request $request, $id)
    {
        // Find the loan by ID
        $loan = Loan::findOrFail($id);

        // Set the fields
        $loan->trans_no = $loan->id;  // Ensure this is the correct logic for trans_no
        $loan->status = 'CNCLD';       // Assuming 'CLOSE' is a valid status
        $loan->user_id = auth()->user()->id;  // Ensure the user is authenticated
        $loan->note = $request->input('reason'); // Get the reason for decline

        // Save the changes
        $loan->save();

        $log = new ActivityLog();
        $log->user_id = auth()->user()->id;
        $log->description = auth()->user()->name . ' Declined the loan request.';
        $log->save();

        // Redirect with a success message
        return redirect()->back()->with('success', 'Loan has been declined with the provided reason.');
    }
    public function printGrantLoan($id)
    {
        $branch = auth()->user()->branch_id;
        $branchAddress = Branch::find($branch);
        $loan = Loan::with([
            'customer',
        ])->where('branch_id', $branch)->find($id);
        return view('pages.loan.print.index', compact('loan', 'branchAddress'));
    }

    public function exportloanHistory($id)
    {
        $customer = Customer::findOrFail($id);
        $filename = 'loanHistory_'.$customer->first_name.'_'.$customer->last_name.'.csv';
        $data = Loan::where('customer_id', $id)->get();
        $headers = [
            "Content-type" => "text/csv",
            "Content-Disposition" => "attachment; filename=".$filename."",
            "Pragma" => "no-cache",
            "Cache-Control" => "must-revalidate, post-check=0, pre-check=0",
            "Expires" => "0",];
        $columns = ['loan_type', 'transaction_type', 'trans_no', 'date_of_loan',
        'customer_id','customer_type','status','transaction_with_collateral',
        'transaction_with_cert','principal_amount','days_to_pay','months_to_pay',
        'interest','interest_amount','svc_charge','payable_amount','branch_id','file','note'];
        $callback = function () use ($data, $columns) {
            $file = fopen('php://output', 'w');
            fputcsv($file, $columns);
    
            foreach ($data as $row) {
                fputcsv($file, [
                    $row->loan_type,
                    $row->transaction_type,
                    $row->trans_no,
                    $row->date_of_loan,
                    $row->customer_id,
                    $row->customer_type,
                    $row->status,
                    $row->transaction_with_collateral,
                    $row->transaction_with_cert,
                    $row->principal_amount,
                    $row->days_to_pay,
                    $row->months_to_pay,
                    $row->interest,
                    $row->interest_amount,
                    $row->svc_charge,
                    $row->payable_amount,
                    $row->branch_id,
                    $row->file,
                    $row->note,
                ]);
            }
    
            fclose($file);
        };
    
        return response()->stream($callback, 200, $headers);

    }

}
