<?php

namespace App\Http\Controllers;

use App\Models\Check;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class CheckController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if(Gate::allows('branch_access')){
            $lists = Check::paginate(20);
        }else{
            $lists = Check::paginate(20);
        }
        

        return view('pages.requestcheck.index', compact('lists'));
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
        $check = new Check();
        $check->requestor_name = $request->requestor_name;
        $check->amount = $request->amount;
        $check->request_date = $request->request_date;
        $check->purpose = $request->purpose;
        $check->save();

        return redirect()->back()->with('success', 'Request Check Submitted');
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

    public function approve($id)
    {
        $check = Check::find($id);
        $check->status = 'Approved';
        $check->save();

        return redirect()->back()->with('success', 'Request Check Approved');
    }

    public function reject($id)
    {
        $check = Check::find($id);
        $check->status = 'Rejected';
        $check->save();

        return redirect()->back()->with('success', 'Request Check Rejected');
    }

    public function printCheck($id)
    {
        $check = Check::find($id);

        return view('pages.requestcheck.printCheck.index', compact('check'));
    }
}
