<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Collection;
use App\Models\Loan;
use App\Models\LoanDetails;
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
        // dd(true);
        $branch = auth()->user()->branch_id;
        // dd($branch);
        $loan = Loan::findOrFail($request->trans_no);
        $loanDetails = LoanDetails::where('loan_id', $loan->id)
            ->where('loan_day_no', $request->loan_no)
            ->first();
        if($loanDetails){
            $loanDetails->loan_date_paid = $request->date_paid;
            $loanDetails->loan_amount_paid = $request->loan_amount_paid;
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
            $col->date = $request->date_paid;
            $col->paid_amount = $request->loan_amount_paid;
            $col->branch_id = $branch;
            $col->lat = $request->lat ?? 0;
            $col->long = $request->long ?? 0;
            $col->loan_details_id = $loanDetails->id;
            $col->save();
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
