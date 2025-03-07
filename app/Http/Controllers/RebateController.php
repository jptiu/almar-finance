<?php

namespace App\Http\Controllers;

use App\Models\Rebate;
use Illuminate\Http\Request;

class RebateController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $branch = auth()->user()->branch_id;
        $lists = Rebate::where('branch_id', $branch)->paginate(10);

        return view('pages.rebates.index', compact('lists'));
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

    public function approve($id)
    {
        $rebate = Rebate::find($id);
        $rebate->status = 'Approved';
        $rebate->save();

        return redirect()->back()->with('success', 'Rebate Approved');
    }

    public function decline($id)
    {
        $rebate = Rebate::find($id);
        $rebate->status = 'Decline';
        $rebate->save();

        return redirect()->back()->with('success', 'Rebate Declined');
    }
}
