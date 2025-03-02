<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Collection;
use App\Models\Loan;
use App\Models\LoanDetails;
use Carbon\Carbon;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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
        // Sanitize loan_amount_paid by removing commas
        $loanAmountPaid = str_replace(',', '', $request->loan_amount_paid);

        $branch = auth()->user()->branch_id;
        $loan = Loan::findOrFail($request->trans_no);
        $loanDetails = LoanDetails::where('loan_id', $loan->id)
            ->where('loan_day_no', $request->loan_no)
            ->where('loan_amount_paid', null)
            ->first();

        if ($loanDetails) {
            $loanDetails->loan_date_paid = Carbon::createFromFormat('Y-m-d', $request->date_paid)->format('m/d/Y');
            $loanDetails->loan_amount_paid = $loanAmountPaid; // Use sanitized value
            $loanDetails->loan_amount_change = $request->loan_amount_change ?? 0;
            $loanDetails->loan_withdraw_from_bank = $request->loan_withdraw_from_bank ?? 0;
            $loanDetails->update();
        }

        if ($loan) {
            $col = new Collection();
            $col->customer_id = $loan->customer_id;
            $col->user_id = auth()->user()->id;
            $col->name = $request->name;
            $col->type = $request->type;
            $col->status = $request->status;
            $col->trans_no = $request->trans_no;
            $col->date = Carbon::createFromFormat('Y-m-d', $request->date_paid)->format('m/d/Y');
            $col->paid_amount = $loanAmountPaid; // Use sanitized value
            $col->branch_id = $branch;
            $col->lat = $request->lat ?? 0;
            $col->long = $request->long ?? 0;
            $col->loan_details_id = $loanDetails->id;
            $col->save();
        }

        if ($loanDetails->loan_running_balance == 0) {
            $loan->status = 'FULPD';
            $loan->update();
        }

        // Sanitize loan_due_amount as well (if it contains commas)
        $loanDueAmount = str_replace(',', '', $loanDetails->loan_due_amount);

        if ($loanAmountPaid > $loanDueAmount) {
            $remaining = $loanAmountPaid - $loanDueAmount;
            $nextLoanDetails = LoanDetails::where('loan_id', $loan->id)
                ->where('loan_day_no', '>', $request->loan_no)
                ->orderBy('loan_day_no', 'asc')
                ->first();

            if ($nextLoanDetails) {
                $nextLoanDetails->loan_date_paid = Carbon::createFromFormat('Y-m-d', $request->date_paid)->format('m/d/Y');
                $nextLoanDetails->loan_amount_paid = $remaining;
                $nextLoanDetails->update();
            } else {
                $nextLoanDetails = LoanDetails::where('loan_id', $loan->id)
                    ->orderBy('loan_day_no', 'asc')
                    ->first();
                $nextLoanDetails->loan_date_paid = Carbon::createFromFormat('Y-m-d', $request->date_paid)->format('m/d/Y');
                $nextLoanDetails->loan_amount_paid = $remaining;
                $nextLoanDetails->update();
            }

            // Recalculate the total remaining balance after applying the overpayment
            $totalRemainingBalance = LoanDetails::where('loan_id', $loan->id)
                ->whereNull('loan_amount_paid')
                ->sum('loan_due_amount');

            // If the total remaining balance is fully paid after overpayment, update the loan status to FULPD
            if ($totalRemainingBalance <= 0) {
                $loan->status = 'FULPD';
                $loan->update();
            }
        }

        return response()->json([
            'message' => 'Payment has been made.',
            'data' => $col,
        ], 200);
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

    public function pay(Request $request)
    {
        $loan = Loan::findOrFail($request->trans_no);
        $loanDetails = LoanDetails::where('loan_id', $loan->id)
            ->where('loan_date_paid', '!=', '')
            ->orWhere('loan_date_paid', '!=', null)
            ->get();
        if ($loanDetails->loan_due_date == now()->toDateString()) {
            $loanDetails->loan_date_paid = now()->toDateString();
            $loanDetails->loan_amount_paid = $request->amount_paid;
            $loanDetails->update();
        }

        if ($loan) {
            $col = new Collection();
            $col->user_id = auth()->user()->id;
            $col->name = $request->name;
            $col->type = $request->type;
            $col->status = $request->status;
            $col->trans_no = $request->trans_no;
            $col->collector_id = auth()->user()->id;
            $col->date = $request->date_of_loan;
            $col->save();
        }
    }
}
