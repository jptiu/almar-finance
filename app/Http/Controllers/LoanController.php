<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoanCreateRequest;
use App\Http\Requests\LoanUpdateRequest;
use App\Models\ActivityLog;
use App\Models\Customer;
use App\Models\CustomerType;
use App\Models\Loan;
use App\Models\LoanDetails;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class LoanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        abort_unless(Gate::allows('loan_access') || Gate::allows('branch_access'), 404);
        $branch = auth()->user()->branch_id;
        if ($request->search) {
            $lists = Loan::with(['customer'])->where('branch_id', $branch)
                ->where('id', $request->search)
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
    public function store(LoanCreateRequest $request)
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

            // Create the loan entry
            $loan = new Loan();
            $loan->loan_type = $request->loan_type;
            $loan->transaction_type = $request->transaction_type;
            // $loan->trans_no = $request->trans_no; // If needed, uncomment
            $loan->date_of_loan = $request->date_of_loan;
            $loan->customer_id = $request->customer_id;
            $loan->customer_type = $request->customer_type;
            $loan->status = null; // Default status (adjust based on your logic)
            $loan->principal_amount = $request->principal_amount;
            $loan->days_to_pay = $request->days_to_pay;
            $loan->months_to_pay = $request->months_to_pay;
            $loan->interest = $request->interest;
            $loan->interest_amount = $request->interest_amount;
            $loan->svc_charge = $request->svc_charge;
            $loan->actual_record = $request->actual_record;
            $loan->payable_amount = $request->payable_amount;
            $loan->branch_id = $branch;
            $loan->user_id = auth()->user()->id;
            if (isset($image) == true) {
                $imageBase64 = base64_encode(file_get_contents($image));
                $loan->file = $imageBase64;
            }
            $loan->save();

            // if ($image) {
            //     // Convert the image to base64
            //     $imageBase64 = base64_encode(file_get_contents($image));
            //     $loan->file = $imageBase64;
            //     $loan->update();
            // }

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

            // Redirect back with success message
            return redirect()->back()->with('success', 'Loan created successfully and is pending approval.');
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
        abort_unless(Gate::allows('loan_access') || Gate::allows('branch_access'), 404);
        $branch = auth()->user()->branch_id;
        $loan = Loan::where('branch_id', $branch)->where('id', $id)->first();

        return view('pages.loan.show.index', compact('loan'));
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
            $loan->date_of_loan = $request->date_of_loan;
            $loan->customer_id = $request->customer_id;
            $loan->customer_type = $request->customer_type;
            $loan->status = $request->status;
            $loan->principal_amount = $request->principal_amount;
            $loan->days_to_pay = $request->days_to_pay;
            $loan->months_to_pay = $request->months_to_pay;
            $loan->interest = $request->interest;
            $loan->interest_amount = $request->interest_amount;
            $loan->svc_charge = $request->svc_charge;
            $loan->actual_record = $request->actual_record;
            $loan->payable_amount = $request->payable_amount;
            $loan->save();

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

}
