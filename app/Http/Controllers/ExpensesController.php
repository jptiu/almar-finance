<?php

namespace App\Http\Controllers;

use App\Models\Chart;
use App\Models\Expenses;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class ExpensesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        abort_unless(Gate::allows('loan_access') || Gate::allows('branch_access') || Gate::allows('hr_access') || Gate::allows('auditor_access'), 404);
        $branch = auth()->user()->branch_id;
        $lists = Expenses::where('branch_id', $branch)->paginate(10);

        return view('pages.expenses.index', compact('lists'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        abort_unless(Gate::allows('loan_access') || Gate::allows('branch_access') || Gate::allows('auditor_access'), 404);
        $branch = auth()->user()->branch_id;
        $lists = Chart::where('branch_id', $branch)->get();
        return view('pages.expenses.entry.index', compact('lists'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $branch = auth()->user()->branch_id;
        $exp = new Expenses();
        // $exp->exp_ref_no = $request->exp_ref_no;
        $exp->acc_no = $request->acc_no;
        $exp->acc_class = $request->acc_class;
        $exp->acc_type = $request->acc_type;
        $exp->acc_title = $request->acc_title;
        $exp->justification = $request->justification;
        $exp->or_no = $request->or_no;
        $exp->amount = $request->amount;
        $exp->exp_date = Carbon::createFromFormat('Y-m-d', $request->exp_date)->format('m/d/Y');
        $exp->branch_id = $branch;
        $exp->user_id = auth()->user()->id;
        $exp->save();

        return redirect(route("expenses.index"))->with('success', 'Created Successfully');

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        abort_unless(Gate::allows('loan_access') || Gate::allows('branch_access'), 404);
        $branch = auth()->user()->branch_id;
        $expenses = Expenses::with('account')->where('branch_id', $branch)->where('id', $id)->first();

        return view('pages.expenses.show.index', compact('expenses'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        abort_unless(Gate::allows('loan_access') || Gate::allows('branch_access'), 404);
        $branch = auth()->user()->branch_id;
        $expenses = Expenses::with('account')->where('branch_id', $branch)->where('id', $id)->first();
        
        return view('pages.expenses.update.index', compact('expenses'));
    }
    
    public function requestEdit(string $id)
    {
        abort_unless(Gate::allows('loan_access') || Gate::allows('branch_access'), 404);
        $branch = auth()->user()->branch_id;
        $expenses = Expenses::with('account')->where('branch_id', $branch)->where('id', $id)->first();
        
        return view('pages.expenses.update.index', compact('expenses'));
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

    public function getAccountData($acctNo)
    {
        $branch = auth()->user()->branch_id;
        $account = Chart::where('branch_id', $branch)->where('acc_no', $acctNo)->first();

        if ($account) {
            return response()->json([
                'account_class' => $account->acc_class,
                'account_type' => $account->acc_type,
                'account_title' => $account->acc_title,
            ]);
        } else {
            return response()->json(null);
        }
    }

    public function importCSV(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:csv,txt|max:2048', // Validate the uploaded file
        ]);
        $branch = auth()->user()->branch_id;

        $file = $request->file('file');

        // Read the CSV data
        $csvData = file_get_contents($file);
        // dd($csvData);

        // Split CSV data into rows
        $rows = array_map('str_getcsv', explode("\n", $csvData));

        // Remove the header row if it exists
        $header = array_shift($rows);
        // dd($header);

        foreach ($rows as $row) {
            $formattedAmount = (float) str_replace(',', '', $row[5]);
            // Create and save your model instance
            Expenses::create([
                'exp_ref_no' => $row[0],
                'exp_date' => $row[1],
                'acc_no' => $row[2],
                'justification' => $row[3],
                'or_no' => $row[4],
                'amount' => number_format($formattedAmount, 2, '.', ''),
                'user_id' => auth()->user()->id,
                'branch_id' => $branch,
            ]);
        }

        return redirect(route("barangay.index"))->with('success', 'CSV Data Imported Successfully');    
    }
}


