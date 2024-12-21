<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class SuperAdminController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('pages.superadmin.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    public function add()
    {
        // abort_unless(Gate::allows('loan_access') || Gate::allows('branch_access'), 404);
        // $types = CustomerType::get();
        return view('pages.superadmin.customerprof.add.index');
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

    public function monthlyReport(Request $request)
    {
        return view('pages.superadmin.monthlyreport.index');
    }

    public function userAccounts(Request $request)
    {
        $users = User::paginate(20);
        return view('pages.superadmin.useracc.index', compact('users'));
    }

    public function deactivateAccounts(Request $request)
    {
        return view('pages.superadmin.useracc.deleted.index');
    }

    public function updateAccounts(Request $request)
    {
        return view('pages.superadmin.useracc.update.index');
    }

    public function createAccounts(Request $request)
    {
        return view('pages.superadmin.useracc.create.index');
    }

    public function customerProf(Request $request)
    {
        return view('pages.superadmin.customerprof.index');
    }
}
