<?php

namespace App\Http\Controllers;

use App\Models\ComputeCashOnHand;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class ComputeCOHController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        abort_unless(Gate::allows('loan_access') || Gate::allows('branch_access'), 404);
        $lists = ComputeCashOnHand::paginate(20);

        return view('pages.compute.index', compact('lists'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        abort_unless(Gate::allows('loan_access') || Gate::allows('branch_access'), 404);


        return view('pages.compute.entry.index');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validate the request data
        $request->validate([
            'prev_transaction_date' => 'nullable|date',
            'cash_beginning' => 'required|numeric',
            'transaction_date' => 'required|date',
            'collection' => 'required|numeric',
            'add_cash' => 'nullable|numeric',
            'add_cash_2' => 'nullable|numeric',
            'loan_releases' => 'required|numeric',
            'expenses' => 'required|numeric',
            'new_cash_on_hand' => 'required|numeric',
            'charge_swipe' => 'nullable|numeric',
            'savings' => 'nullable|numeric',
            'death_aid' => 'nullable|numeric',
            'photocopy' => 'nullable|numeric',
            'withdraw' => 'nullable|numeric',
            'xerox' => 'nullable|numeric',
            'penalty' => 'nullable|numeric',
            'passbook' => 'nullable|numeric',
            'details_withdraw' => 'nullable|numeric',
            'details_xerox' => 'nullable|numeric',
        ]);
        $branch = auth()->user()->branch_id;

        // Store the data in the database
        $computeCashOnHand = new ComputeCashOnHand();
        $computeCashOnHand->prev_transaction_date = $request->prev_transaction;
        $computeCashOnHand->cash_beginning = $request->cash_beginning;
        $computeCashOnHand->transaction_date = $request->transaction_date;
        $computeCashOnHand->collection = $request->collection;
        $computeCashOnHand->add_cash = $request->add_cash ?? 0;
        $computeCashOnHand->add_cash_2 = $request->add_cash_2 ?? 0;
        $computeCashOnHand->loan_releases = $request->loan_releases ?? 0;
        $computeCashOnHand->expenses = $request->expenses ?? 0;
        $computeCashOnHand->new_cash_on_hand = $request->new_cash_on_hand;
        $computeCashOnHand->charge_swipe = $request->charge_swipe ?? 0;
        $computeCashOnHand->savings = $request->savings ?? 0;
        $computeCashOnHand->death_aid = $request->death_aid ?? 0;
        $computeCashOnHand->photocopy = $request->photocopy ?? 0;
        $computeCashOnHand->withdraw = $request->withdraw ?? 0;
        $computeCashOnHand->xerox = $request->xerox ?? 0;
        $computeCashOnHand->user_id = auth()->user()->id;
        $computeCashOnHand->penalty = $request->penalty ?? 0;
        $computeCashOnHand->passbook = $request->passbook ?? 0;
        $computeCashOnHand->details_withdraw = $request->details_withdraw ?? 0;
        $computeCashOnHand->details_xerox = $request->details_xerox ?? 0;
        $computeCashOnHand->branch_id = $branch;
        $computeCashOnHand->save();

        return redirect()->back()->with('success', 'Data saved successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        abort_unless(Gate::allows('loan_access') || Gate::allows('branch_access'), 404);
        $computecashonhand = ComputeCashOnHand::where('id', $id)->first();

        return view('pages.compute.show.index', compact('computecashonhand'));

    }

    /** 
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        abort_unless(Gate::allows('loan_access') || Gate::allows('branch_access'), 404);
        $computecashonhand = ComputeCashOnHand::where('id', $id)->first();

        return view('pages.compute.update.index', compact('computecashonhand'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // Validate the request data
        $request->validate([
            'prev_transaction_date' => 'nullable|date',
            'cash_beginning' => 'required|numeric',
            'transaction_date' => 'required|date',
            'collection' => 'required|numeric',
            'add_cash' => 'nullable|numeric',
            'add_cash_2' => 'nullable|numeric',
            'loan_releases' => 'required|numeric',
            'expenses' => 'required|numeric',
            'new_cash_on_hand' => 'required|numeric',
            'charge_swipe' => 'nullable|numeric',
            'savings' => 'nullable|numeric',
            'death_aid' => 'nullable|numeric',
            'photocopy' => 'nullable|numeric',
            'withdraw' => 'nullable|numeric',
            'xerox' => 'nullable|numeric',
            'penalty' => 'nullable|numeric',
            'passbook' => 'nullable|numeric',
            'details_withdraw' => 'nullable|numeric',
            'details_xerox' => 'nullable|numeric',
        ]);

        // Store the data in the database
        $computeCashOnHand = ComputeCashOnHand::findOrFail($id);
        $computeCashOnHand->prev_transaction_date = $request->prev_transaction;
        $computeCashOnHand->cash_beginning = $request->cash_beginning;
        $computeCashOnHand->transaction_date = $request->transaction_date;
        $computeCashOnHand->collection = $request->collection;
        $computeCashOnHand->add_cash = $request->add_cash ?? 0;
        $computeCashOnHand->add_cash_2 = $request->add_cash_2 ?? 0;
        $computeCashOnHand->loan_releases = $request->loan_releases ?? 0;
        $computeCashOnHand->expenses = $request->expenses ?? 0;
        $computeCashOnHand->new_cash_on_hand = $request->new_cash_on_hand;
        $computeCashOnHand->charge_swipe = $request->charge_swipe ?? 0;
        $computeCashOnHand->savings = $request->savings ?? 0;
        $computeCashOnHand->death_aid = $request->death_aid ?? 0;
        $computeCashOnHand->photocopy = $request->photocopy ?? 0;
        $computeCashOnHand->withdraw = $request->withdraw ?? 0;
        $computeCashOnHand->xerox = $request->xerox ?? 0;
        $computeCashOnHand->user_id = auth()->user()->id;
        $computeCashOnHand->penalty = $request->penalty ?? 0;
        $computeCashOnHand->passbook = $request->passbook ?? 0;
        $computeCashOnHand->details_withdraw = $request->details_withdraw ?? 0;
        $computeCashOnHand->details_xerox = $request->details_xerox ?? 0;
        $computeCashOnHand->update();

        return redirect()->back()->with('success', 'Data updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $list = ComputeCashOnHand::findOrFail($id);
        $list->delete();

        return redirect()->back()->with('success', 'Delete successfully!');
    }
}
