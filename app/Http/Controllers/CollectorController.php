<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class CollectorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        abort_unless(Gate::allows('collector_access'), 404);
        
        return view('pages.collector.index');
    }

    public function leave()
    {
        //abort_unless(Gate::allows('collector_access'), 404);
        
        return view('pages.collector.leave.index');
    }

    public function cashadvance()
    {
        //abort_unless(Gate::allows('collector_access'), 404);
        
        return view('pages.collector.cashadvance.index');
    }

    public function undertime()
    {
        //abort_unless(Gate::allows('collector_access'), 404);
        
        return view('pages.collector.undertime.index');
    }

    public function clearance()
    {
        //abort_unless(Gate::allows('collector_access'), 404);
        
        return view('pages.collector.clearance.index');
    }

    public function id()
    {
        //abort_unless(Gate::allows('collector_access'), 404);
        
        return view('pages.collector.id.index');
    }

    public function cashbond()
    {
        //abort_unless(Gate::allows('collector_access'), 404);
        
        return view('pages.collector.cashbond.index');
    }



    public function profile()
    {
        abort_unless(Gate::allows('collector_access'), 404);
        
        return view('pages.collector.profile.index');
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
}
