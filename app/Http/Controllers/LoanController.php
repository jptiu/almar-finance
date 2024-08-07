<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoanCreateRequest;
use App\Http\Requests\LoanUpdateRequest;
use App\Models\Loan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class LoanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        abort_unless(Gate::allows('loan_access'), 404);
        $lists = Loan::get();

        return view('pages.loan.entry.index', compact('lists'));
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
    public function store(LoanCreateRequest $request)
    {
        abort_unless(Gate::allows('loan_access'), 404);
        if ($request->validated()) {
            $loan = new Loan();
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

            return redirect()->back()->with('success', 'Loan Entry Created.');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        abort_unless(Gate::allows('loan_access'), 404);
        $loan = Loan::find($id);
        
        return view('pages.loan.entry.index', compact('loan'));
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
    public function update(LoanUpdateRequest $request, string $id)
    {
        abort_unless(Gate::allows('loan_access'), 404);
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

            return redirect()->back()->with('success', 'Loan Entry Updated.');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        abort_unless(Gate::allows('loan_access'), 404);
        $loan = Loan::find($id);
        $loan->delete();

        return redirect()->back()->with('success', 'Loan deleted.');
    }
}
