<?php

namespace App\Http\Controllers;

use App\Models\ComputeCashOnHand;
use App\Models\Customer;
use App\Models\Collection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class LOController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        abort_unless(Gate::allows('loan_access') || Gate::allows('branch_access'), 404);
        $branch = auth()->user()->branch_id;
        $lists = Customer::where('branch_id', $branch)->orderByDesc('id')->paginate(10);
        $totalCustomer = Customer::where('branch_id', $branch)->count();
        $cashBeginning = ComputeCashOnHand::where('branch_id', $branch)->sum('cash_beginning');
        $collections = Collection::orderByDesc('id')->paginate(5);
        return view('pages.loanofficer.index', compact('lists', 'totalCustomer', 'cashBeginning','collections'));
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

    public function badAccount(Request $request)
    {
        return view('pages.badacc.index');
    }

    public function addLoan(Request $request)
    {
        return view('pages.addloan.index');
    }

    public function autoPaymentreq (Request $request)
    {
        return view('pages.loanofficer.autopayment.index');
    }

    public function dailyWorkorder (Request $request)
    {
        return view('pages.loanofficer.dailyworkorder.index');
    }
}
