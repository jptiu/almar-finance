<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoanCreateRequest;
use App\Http\Requests\LoanUpdateRequest;
use App\Mail\LoanApprovalRequestMail;
use App\Mail\LoanApprovedMail;
use App\Models\ActivityLog;
use App\Models\Customer;
use App\Models\CustomerType;
use App\Models\Loan;
use App\Models\LoanDetails;
use App\Models\Branch;
use App\Models\RenewalRequest;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\PhpSpreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpWord\TemplateProcessor;

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

            // Validate the input data
            $validatedData = $request->validate([
                'rows.*.id' => 'required|numeric',
                'rows.*.due_date' => 'required|date',
                'rows.*.due_amount' => 'required|numeric',
                'rows.*.remaining_balance' => 'required|numeric',
                'upload_file.*' => 'required|file|mimes:jpeg,png,pdf|max:2048',
            ]);

            // Initialize an array to store file data
            $filesData = [];
            // Check if files are uploaded
            if ($request->hasFile('upload_file')) {
                $files = $request->file('upload_file');
                foreach ($files as $file) {
                    if ($file->isValid()) {
                        $imageBase64 = base64_encode(file_get_contents($file->path()));
                        $filesData[] = [
                            'file_name' => $file->getClientOriginalName(),
                            'mime_type' => $file->getMimeType(),
                            'size' => $file->getSize(),
                            'base64' => $imageBase64,
                        ];
                    }
                }
            }
            $filesJson = json_encode($filesData);

            // Check for existing unpaid loan
            $previousLoan = Loan::with([
                'details' => function ($query) {
                    $query->where('loan_date_paid', null);
                },
                'customer'
            ])
                ->where('customer_id', $request->customer_id)
                ->where('status', 'UNPD')
                ->first();

            $totalRemaining = 0;
            if ($previousLoan) {
                // Count unpaid details and calculate equivalent months
                $unpaidCount = $previousLoan->details->count();
                $equivalentMonths = floor($unpaidCount / 2);
                $previousLoan->equivalent_months = $equivalentMonths;

                // Check if customer is eligible for renewal
                if ($equivalentMonths > 1) {
                    $message = 'This customer has a ' . number_format($equivalentMonths, 0) . ' month pending loan and is not eligible for renewal at this time.';
                    return redirect()->back()->with('loan_restriction', compact('previousLoan', 'message'));
                }

                // Calculate total remaining balance and mark previous loan details as paid
                foreach ($previousLoan->details as $detail) {
                    if ($detail->loan_date_paid === null) {
                        $totalRemaining += $detail->loan_due_amount;
                        $detail->loan_date_paid = Carbon::createFromFormat('Y-m-d', $request->date_of_loan)->format('m/d/Y');
                        $detail->loan_amount_paid = number_format($detail->loan_due_amount, 2);
                        $detail->save();
                    }
                }

                // Update previous loan status
                $previousLoan->status = 'FULPD';
                $previousLoan->save();

                // Log the renewal
                $log = new ActivityLog();
                $log->user_id = auth()->user()->id;
                $log->description = 'Client ' . $previousLoan->customer->first_name . ' ' . $previousLoan->customer->last_name . 
                                   ' renewed a loan with a remaining balance of ' . $equivalentMonths . 
                                   ' months, amounting to ' . number_format($totalRemaining, 2) . 
                                   ', which will be deducted from the renewed loan.';
                $log->save();
            }

            // Create the new loan with adjusted amounts
            $loan = new Loan();
            $loan->loan_type = $request->loan_type;
            $loan->transaction_type = $request->transaction_type;
            $loan->date_of_loan = Carbon::createFromFormat('Y-m-d', $request->date_of_loan)->format('m/d/Y');
            $loan->customer_id = $request->customer_id;
            $loan->customer_type = $request->customer_type;
            $loan->status = null;
            $loan->principal_amount = $request->principal_amount;
            $loan->days_to_pay = $request->days_to_pay;
            $loan->months_to_pay = $request->months_to_pay;
            $loan->interest = $request->interest;
            $loan->interest_amount = $request->interest_amount;
            $loan->svc_charge = $request->svc_charge ?? '';
            $loan->actual_record = $request->actual_record ?? '';
            
            // Deduct the remaining balance from the new loan's payable amount
            $loan->payable_amount = (float)$request->payable_amount - $totalRemaining;
            $loan->note = $totalRemaining > 0 ? 'Deducted amount from previous loan: ' . number_format($totalRemaining, 2) : null;
            
            $loan->branch_id = $branch;
            $loan->user_id = auth()->user()->id;
            if (!empty($filesJson)) {
                $loan->file = $filesJson;
            }
            $loan->save();

            // Adjust and save loan details with the deducted amount
            $totalDeduction = $totalRemaining / count($validatedData['rows']); // Distribute deduction evenly
            foreach ($validatedData['rows'] as $row) {
                $adjustedDueAmount = $row['due_amount'] - ($totalDeduction > 0 ? $totalDeduction : 0);
                LoanDetails::create([
                    'loan_id' => $loan->id,
                    'loan_due_date' => $row['due_date'],
                    'loan_due_amount' => max(0, $adjustedDueAmount), // Ensure amount doesn't go negative
                    'loan_running_balance' => max(0, $row['remaining_balance'] - ($totalDeduction > 0 ? $totalDeduction : 0)),
                    'user_id' => auth()->user()->id,
                    'branch_id' => $branch,
                    'loan_day_no' => $row['id'],
                ]);
            }

            // Log the new loan creation
            $log = new ActivityLog();
            $log->user_id = auth()->user()->id;
            $log->description = auth()->user()->name . ' Created the loan request' . 
                               ($totalRemaining > 0 ? ' with deduction of ' . number_format($totalRemaining, 2) . ' from previous loan.' : '.');
            $log->save();

            $loanDetails = Loan::with(['customer'])->findOrFail($loan->id);

            // Send email to HR
            Mail::to('hr@almarfinance.com')->send(new LoanApprovalRequestMail($loanDetails));
            
            return redirect()->back()->with('success', 'Loan created successfully and is pending approval.');
        } catch (\Throwable $th) {
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
        abort_unless(Gate::allows('loan_access') || Gate::allows('branch_access') || Gate::allows('auditor_access') || Gate::allows('hr_access'), 404);
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

    private function generateApplicationForm($loan)
    {
        // Ensure the loan documents directory exists
        $loanDocumentsPath = storage_path('app/loan_documents/' . $loan->id);
        if (!file_exists($loanDocumentsPath)) {
            mkdir($loanDocumentsPath, 0755, true);
        }

        // Load the template
        $templatePath = storage_path('template/Application-Form.docx');
        if (!file_exists($templatePath)) {
            throw new \Exception('Application form template not found');
        }

        // Create TemplateProcessor instance
        $templateProcessor = new TemplateProcessor($templatePath);

        // Prepare data to replace placeholders
        $data = [
            'date_filed' => '',
            'customer_id' => $loan->customer->id,
            'customer_name' => $loan->customer->first_name . ' ' . $loan->customer->last_name,
            'birth_date' => $loan->customer->birth_date,
            'birth_place' => $loan->customer->birth_place,
            'civil_status' => $loan->customer->civil_status,
            'age' => $loan->customer->age,
            'gender' => $loan->customer->gender,
            'citizenship' => $loan->customer->citizenship,
            'perm_address' => $loan->customer->house.' '.$loan->customer->street.' '.$loan->customer->barangay_name.' '.$loan->customer->city_town,
            'present_address' => '',
            'cell_number' => $loan->customer->cell_number,
            'spouse_name' => $loan->customer->spouse_name,
            'spouse_occupation' => $loan->customer->occupation,
            'c_nameadd' => $loan->customer->c_nameadd,
            'spouse_number' => $loan->customer->spouse_number,
            'spouse_bdate' => $loan->customer->spouse_bdate,
            'spouse_age' => $loan->customer->spouse_age,
            'agency_name' => $loan->customer->agency_name,
            'add_tel' => $loan->customer->add_tel,
            'comp_name' => $loan->customer->comp_name,
            'add_telc' => $loan->customer->add_telc,
            'date_hired' => $loan->customer->date_hired,
            'job_position' => $loan->customer->job_position,
            'day_off' => $loan->customer->day_off,
            'monthly_salary' => number_format($loan->customer->monthly_salary, 2),
            'salary_sched' => $loan->customer->salary_sched,
            'monthly_pension'=> number_format($loan->customer->monthly_pension,2),
            'pension_sched' => $loan->customer->pension_sched,
            'fathers_name' => $loan->customer->fathers_name,
            'mothers_name' => $loan->customer->mothers_name,
            'fathers_num' => $loan->customer->fathers_num,
            'mothers_num' => $loan->customer->mothers_num,
            'branch' => $loan->customer->branch,
            'card_no' => $loan->customer->card_no,
            'acc_no' => $loan->customer->acc_no,
            'pin_no'=> $loan->customer->pin_no,
            'loan_amount' => number_format($loan->principal_amount, 2),
            'interest_rate' => number_format($loan->interest, 2) . '%',
            'term_months' => $loan->months_to_pay,
            'loan_date' => $loan->created_at->format('F d, Y'),
        ];

        // Replace placeholders with actual data
        foreach ($data as $key => $value) {
            $templateProcessor->setValue($key, $value);
        }

        // Save the generated document
        $outputPath = $loanDocumentsPath . '/application_form.docx';
        $templateProcessor->saveAs($outputPath);

        return $outputPath;
    }

    private function generateVoucherForm($loan)
    {
        // Ensure the loan documents directory exists
        $loanDocumentsPath = storage_path('app/loan_documents/' . $loan->id);
        if (!file_exists($loanDocumentsPath)) {
            mkdir($loanDocumentsPath, 0755, true);
        }

        // Load the template
        $templatePath = storage_path('template/Voucher.xlsx');
        if (!file_exists($templatePath)) {
            throw new \Exception('Voucher form template not found');
        }

        // Load the spreadsheet
        $spreadsheet = IOFactory::load($templatePath);
        $sheet = $spreadsheet->getActiveSheet();

        // Prepare data to replace placeholders
        $data = [
            'date_filed' => '',
            'customer_id' => $loan->customer->id,
            'customer_name' => $loan->customer->first_name . ' ' . $loan->customer->last_name,
            'birth_date' => $loan->customer->birth_date,
            'birth_place' => $loan->customer->birth_place,
            'civil_status' => $loan->customer->civil_status,
            'age' => $loan->customer->age,
            'gender' => $loan->customer->gender,
            'citizenship' => $loan->customer->citizenship,
            'perm_address' => $loan->customer->house.' '.$loan->customer->street.' '.$loan->customer->barangay_name.' '.$loan->customer->city_town,
            'present_address' => '',
            'cell_number' => $loan->customer->cell_number,
            'spouse_name' => $loan->customer->spouse_name,
            'spouse_occupation' => $loan->customer->occupation,
            'c_nameadd' => $loan->customer->c_nameadd,
            'spouse_number' => $loan->customer->spouse_number,
            'spouse_bdate' => $loan->customer->spouse_bdate,
            'spouse_age' => $loan->customer->spouse_age,
            'agency_name' => $loan->customer->agency_name,
            'add_tel' => $loan->customer->add_tel,
            'comp_name' => $loan->customer->comp_name,
            'comp_address' => $loan->customer->add_telc,
            'date_hired' => $loan->customer->date_hired,
            'job_position' => $loan->customer->job_position,
            'day_off' => $loan->customer->day_off,
            'monthly_salary' => number_format($loan->customer->monthly_salary, 2),
            'salary_sched' => $loan->customer->salary_sched,
            'monthly_pension'=> number_format($loan->customer->monthly_pension,2),
            'pension_sched' => $loan->customer->pension_sched,
            'fathers_name' => $loan->customer->fathers_name,
            'mothers_name' => $loan->customer->mothers_name,
            'fathers_num' => $loan->customer->fathers_num,
            'mothers_num' => $loan->customer->mothers_num,
            'branch' => $loan->customer->branch,
            'card_no' => $loan->customer->card_no,
            'acc_no' => $loan->customer->acc_no,
            'pin_no'=> $loan->customer->pin_no,
            'loan_amount' => number_format($loan->principal_amount, 2),
            'interest_rate' => number_format($loan->interest, 2) . '%',
            'term_months' => $loan->months_to_pay,
            'loan_date' => $loan->created_at->format('F d, Y'),
            'transaction_type' => $loan->transaction_type,
            'processing_fee' => '',
            'notary_fee' => '',
            'interest_amount' => number_format($loan->interest_amount, 2),
            'payable_amount' => number_format($loan->payable_amount, 2),
            'office_address' => auth()->user()->branch->location,
            'office_contact' => '',
        ];

        // Replace placeholders in the spreadsheet
        foreach ($data as $placeholder => $value) {
            foreach ($sheet->getRowIterator() as $row) {
                foreach ($row->getCellIterator() as $cell) {
                    if (strpos($cell->getValue(), $placeholder) !== false) {
                        $cell->setValue(str_replace($placeholder, $value, $cell->getValue()));
                    }
                }
            }
        }

        // Save the generated document
        $outputPath = $loanDocumentsPath . '/voucher_form.xlsx';
        $writer = IOFactory::createWriter($spreadsheet, 'Xlsx');
        $writer->save($outputPath);

        return $outputPath;
    }

    public function approve(Request $request, $id)
    {
        $loan = Loan::findOrFail($id);
        $loan->trans_no = $loan->id;
        $loan->status = 'UNPD';
        $loan->user_id = auth()->user()->id;
        $loan->note = $request->input('reason');
        $loan->update();

        // Generate and save the application form
        try {
            $this->generateApplicationForm($loan);
            Log::info('success created application form!!!');
        } catch (\Exception $e) {
            Log::error('Failed to generate application form: ' . $e->getMessage());
        }

        // Generate and save the voucher form
        try {
            $this->generateVoucherForm($loan);
        } catch (\Exception $e) {
            Log::error('Failed to generate voucher form: ' . $e->getMessage());
        }

        $log = new ActivityLog();
        $log->user_id = auth()->user()->id;
        $log->description = auth()->user()->name . ' Approved the loan request.';
        $log->save();

        $loanDetails = Loan::with([
            'customer',
        ])->findOrFail($id);

        // Send email to customer
        Mail::to($loan->customer->email)->send(new LoanApprovedMail($loanDetails));

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

        // Generate and save the application form
        try {
            $this->generateApplicationForm($loan);
        } catch (\Exception $e) {
            Log::error('Failed to generate application form: ' . $e->getMessage());
        }

        // Generate and save the voucher form
        try {
            $this->generateVoucherForm($loan);
        } catch (\Exception $e) {
            Log::error('Failed to generate voucher form: ' . $e->getMessage());
        }

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
        $filename = 'loanHistory_' . $customer->first_name . '_' . $customer->last_name . '.csv';
        $data = Loan::where('customer_id', $id)->get();
        $headers = [
            "Content-type" => "text/csv",
            "Content-Disposition" => "attachment; filename=" . $filename . "",
            "Pragma" => "no-cache",
            "Cache-Control" => "must-revalidate, post-check=0, pre-check=0",
            "Expires" => "0",
        ];
        $columns = [
            'loan_type',
            'transaction_type',
            'trans_no',
            'date_of_loan',
            'customer_id',
            'customer_type',
            'status',
            'transaction_with_collateral',
            'transaction_with_cert',
            'principal_amount',
            'days_to_pay',
            'months_to_pay',
            'interest',
            'interest_amount',
            'svc_charge',
            'payable_amount',
            'branch_id',
            'file',
            'note'
        ];
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


    public function exportTransaction(Request $request)
    {
        $loanId = $request->query('transaction_id');
        $loan = Loan::with(['customer', 'details'])->findOrFail($loanId); // Load loan with details
        $filename = 'Loan_Transaction_' . $loan->id . '.csv';

        $headers = [
            "Content-type" => "text/csv",
            "Content-Disposition" => "attachment; filename=" . $filename,
            "Pragma" => "no-cache",
            "Cache-Control" => "must-revalidate, post-check=0, pre-check=0",
            "Expires" => "0",
        ];

        $columns = [
            'Customer Name',
            'Customer ID',
            'Customer Type',
            'Status',
            'Transaction No.',
            'Date of Loan',
            'Loan Type',
            'Transaction Type',
            'Principal Amount',
            'Interest',
            'Interest Amount',
            'Service Charge',
            'Payable Amount',
            'Days to Pay',
            'Months to Pay',
            'Actual Record'
        ];

        $installmentColumns = [
            'Installment',
            'Principal',
            'Interest',
            'Service Charge',
            'Total',
            'Outstanding Balance'
        ];

        $callback = function () use ($loan, $columns, $installmentColumns) {
            $file = fopen('php://output', 'w');

            // Write Loan Summary
            fputcsv($file, ['Loan Summary']);
            fputcsv($file, $columns);
            fputcsv($file, [
                $loan->customer->first_name . ' ' . $loan->customer->last_name,
                $loan->id,
                $loan->customer->type,
                $loan->customer->status,
                $loan->id,
                $loan->date_of_loan,
                $loan->loan_type,
                $loan->transaction_type,
                $loan->principal_amount,
                $loan->interest,
                $loan->interest_amount,
                $loan->svc_charge,
                $loan->payable_amount,
                $loan->days_to_pay,
                $loan->months_to_pay,
                'Business'
            ]);

            // Write Installment Table
            fputcsv($file, []); // Blank row
            fputcsv($file, ['Installment Breakdown']);
            fputcsv($file, $installmentColumns);

            foreach ($loan->details as $details) {
                fputcsv($file, [
                    $details->loan_day_no,
                    number_format($loan->principal_amount / $loan->details->count(), 2),
                    number_format($loan->interest_amount / $loan->details->count(), 2),
                    '', // Service Charge (if available, modify)
                    $details->loan_due_amount,
                    $details->loan_running_balance
                ]);
            }

            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }
}
