<?php

namespace App\Http\Controllers;

use App\Mail\RenewalApproved;
use App\Models\ActivityLog;
use App\Models\CustomerType;
use App\Models\Loan;
use App\Models\LoanDetails;
use App\Models\RenewalRequest;
use Gate;
use Illuminate\Http\Request;
use Mail;

class RenewalRequestController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        abort_unless(Gate::allows('loan_access') || Gate::allows('hr_access'), 404);
        $branch = auth()->user()->branch_id;
        $lists = RenewalRequest::where('branch_id', $branch)->paginate(20);
        $types = CustomerType::all();

        return view('pages.renewalrequest.index', compact('lists', 'types'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }


    /**
     * Create a renewal request for a loan.
     *
     * This function checks for user permissions and retrieves the loan details
     * for the specified loan ID. It calculates the equivalent months based on the
     * unpaid loan details and creates a new renewal request with the provided
     * data. An activity log is also recorded for the action.
     *
     * @param Request $request The request object containing renewal data inputs.
     * @param int $id The ID of the loan for which the renewal request is being created.
     * @return \Illuminate\Http\RedirectResponse Redirects back with a success message 
     * indicating the renewal request submission.
     */

    public function renew(Request $request, $id)
    {
        abort_unless(Gate::allows('loan_access') || Gate::allows('branch_access'), 404);
        $branch = auth()->user()->branch_id;
        $loan = Loan::with(['details' => function ($query) {
            $query->whereNotNull('loan_date_paid'); // Filter due today
        }])->where('branch_id', $branch)->find($id);

        $unpaidCount = $loan->details->count();
        // Calculate the equivalent months (2 unpaid details = 1 month)
        $equivalentMonths = floor($unpaidCount / 2);
        
        $renewal = new RenewalRequest();
        $renewal->loan_id = $loan->id;
        $renewal->branch_id = $branch;
        $renewal->customer_id = $loan->customer_id;
        $renewal->previous_balance = $loan->details->last()->loan_running_balance;
        $renewal->month = $equivalentMonths;
        $renewal->user_id = auth()->user()->id;
        $requestedRenewalAmount = $request->input('requested_renewal_amount');
        $renewal->requested_renewal_amount = $requestedRenewalAmount;
        $pendingBalance = $loan->details->last()->loan_running_balance;
        $renewal->renewed_amount = $requestedRenewalAmount - $pendingBalance;
        $renewal->renewal_tenure = $request->input('renewal_tenure', null);
        $renewal->renewal_interest_rate = $request->input('renewal_interest_rate', null);
        $renewal->notes = $request->input('notes', null);
        $renewal->save();

        $log = new ActivityLog();
        $log->user_id = auth()->user()->id;
        $log->description = auth()->user()->name . ' Created a renewal request.';
        $log->save();

        return redirect()->back()->with('success', 'Renewal request submitted, Please wait for approval.');

    }

    /**
     * Approve a renewal request for a loan.
     *
     * This function checks for user permissions and retrieves the renewal request
     * for the specified ID. It updates the renewal request status to 'APPROVED',
     * sets the approved user ID and date, and saves the changes. It also marks
     * the related loan unpaid details as paid. A new loan is created with the
     * approved details and the loan details are created with staggered payments.
     * The original loan is updated to a status of 'FULPD'. An activity log is
     * also recorded for the action. Finally, an email is sent to the customer
     * with the approved renewal request details.
     *
     * @param int $id The ID of the renewal request to approve.
     * @return \Illuminate\Http\RedirectResponse Redirects back with a success message
     * indicating the renewal request approval.
     */
    public function renewApprove($id)
    {
        abort_unless(Gate::allows('hr_access') || Gate::allows('admin_access'), 404);
        $renewal = RenewalRequest::find($id);
        $renewal->status = 'APPROVED';
        $renewal->approved_by = auth()->user()->id;
        $renewal->approved_date = now();
        $renewal->save();

        $unpaid = LoanDetails::where('loan_id', $renewal->loan_id)->where('loan_date_paid', null)->get();

        foreach ($unpaid as $detail) {
            $detail->loan_date_paid = now();
            $detail->save();
        }

        $newLoan = new Loan();
        $newLoan->branch_id = $renewal->branch_id;
        $newLoan->customer_id = $renewal->customer_id;
        $newLoan->date_of_loan = $renewal->approved_date;
        $newLoan->months_to_pay = $renewal->renewal_tenure;
        $newLoan->principal_amount = $renewal->renewed_amount;
        $newLoan->interest = $renewal->renewal_interest_rate;
        $newLoan->status = 'UNPD';
        $newLoan->save();

        $staggeredPayments = $renewal->renewed_amount / $renewal->renewal_tenure;
        $currentBalance = $renewal->renewed_amount;

        $currentDay = $renewal->approved_date->copy()->day;
        for ($i = 0; $i < $renewal->renewal_tenure; $i++) {
            $newLoanDetail = new LoanDetails();
            $newLoanDetail->loan_day_no = $i + 1;
            $newLoanDetail->loan_id = $newLoan->id;
            $newLoanDetail->loan_date_paid = null;
            $newLoanDetail->loan_running_balance = $currentBalance;
            $newLoanDetail->loan_due_date = $renewal->approved_date->copy()->addMonths($i + 1);
            $newLoanDetail->loan_due_amount = $staggeredPayments + ($staggeredPayments * ($renewal->renewal_interest_rate / 100));
            $newLoanDetail->save();

            $currentBalance -= $staggeredPayments;
        }

        $loan = Loan::find($renewal->loan_id);
        $loan->status = 'FULPD';
        $loan->save();

        $renewalDate = $newLoanDetail->loan_date_paid;
        $expirationDate = $newLoanDetail->loan_due_date;
        $totalAmount = $newLoanDetail->loan_running_balance;

        Mail::to($renewal->customer->email)->send(new RenewalApproved($renewal->customer->name, $renewalDate, $expirationDate, $totalAmount));
    

        return redirect()->back()->with('success', 'Renewal request approved.');
    }

    public function renewDecline($id)
    {
        abort_unless(Gate::allows('hr_access') || Gate::allows('admin_access'), 404);
        $renewal = RenewalRequest::find($id);
        $renewal->status = 'DECLINED';
        $renewal->save();

        return redirect()->back()->with('success', 'Renewal request declined.');
    }
}
