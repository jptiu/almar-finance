<?php

namespace App\Http\Controllers;

use App\Http\Requests\CLMCreateRequest;
use App\Http\Requests\CLMUpdateRequest;
use App\Models\Branch;
use App\Models\Customer;
use App\Models\Loan;
use App\Models\LoanDetails;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class CLMController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        abort_unless(Gate::allows('loan_access') || Gate::allows('branch_access'), 404);
        $branch = auth()->user()->branch_id;
        $branches = Branch::paginate(10);
        $customers = Customer::where('branch_id', $branch)->get();
        return view('pages.customer.month.index', compact('branches', 'customers'));
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
    public function store(CLMCreateRequest $request)
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
    public function update(CLMUpdateRequest $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        return view('pages.hr.payroll.print.index');
    }

    public function printLoan(Request $request)
    {
        $branch = auth()->user()->branch_id;
        $branchAddress = Branch::find($branch);
        if ($request->date_from) {
            $customer = Customer::with([
                'loan',
                'loan.details' => function ($query) use ($request) {
                    $query->whereBetween('loan_due_date', [$request->date_from, $request->date_to]);
                }
            ])->where('branch_id', $branch)->find($request->customer);
        } else {
            $customer = Customer::with([
                'loan',
                'loan.details'
            ])->where('branch_id', $branch)->find($request->customer);
        }

        return view('pages.customer.month.printLoan.index', compact('customer', 'branchAddress'));
    }

    public function printStatement($id)
    {
        $customer = Customer::find($id);
        return view('pages.customer.month.printStatement.index', compact('customer'));
    }

}
