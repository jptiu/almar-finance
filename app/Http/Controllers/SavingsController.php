<?php

namespace App\Http\Controllers;


use App\Http\Requests\SavingsCreateRequest;
use App\Models\Branch;
use App\Models\Customer;
use Illuminate\Http\Request;
// use App\Http\Controllers\SavingsController;
use Illuminate\Support\Facades\Gate;
use App\Models\SavingsDeposit;
use App\Models\SavingsWithdrawal;

class SavingsController extends Controller
{

    // Savings Deposit Methods
    public function indexDeposit()
    {
        $branch = auth()->user()->branch_id;
        $lists = SavingsDeposit::paginate(20);
        return view('pages.savingscustomer.depositentry.index', compact('lists'));
    }

    public function createDeposit()
    {
        $branch = auth()->user()->branch_id;
        $customers = Customer::where('branch_id', $branch)->get();
        return view('pages.savingscustomer.depositentry.entry.index', compact('customers'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function storeDeposit(Request $request)
    {
        $branch = auth()->user()->branch_id;
        $dep = new SavingsDeposit();
        $dep->customer_id = $request->customer;
        $dep->customer_name = $request->customer_name;
        $dep->tran_date = $request->tran_date;
        $dep->amount = $request->amount;
        $dep->branch_id = $branch;
        $dep->save();

        return redirect()->route('depositentry.index')->with('success', 'Deposit entry created successfully.');
    }

    // Savings Withdrawal Methods
    public function indexWithdrawal()
    {
        $branch = auth()->user()->branch_id;
        $lists = SavingsWithdrawal::paginate(20);
        return view('pages.savingscustomer.withdrawalentry.index', compact('lists'));
    }

    public function createWithdrawal(Request $request)
    {
        $branch = auth()->user()->branch_id;
        $customers = Customer::where('branch_id', $branch)->get();
        $customer = '';
        if ($request->customer) {
            $customer = Customer::with(['loan', 'loan.details', 'deposits'])->where('branch_id', $branch)->find($request->customer);
        }

        // Check if the request is an AJAX call
        if ($request->ajax()) {
            return response()->json([
                'customer' => $customer,
            ]);
        }


        return view('pages.savingscustomer.withdrawalentry.entry.index', compact('customer', 'customers'));
    }

    public function storeWithdrawal(Request $request)
    {
        $branch = auth()->user()->branch_id;
        // $request->validate([
        //     'customer_id' => 'required',
        //     'amount' => 'required|numeric',
        //     'date' => 'required|date',
        //     'customer_name' => 'required|string',
        //     'tran_date' => 'required|string',
        //     'net_amount' => 'required|numeric',
        //     'interest_amount' => 'required|numeric',
        //     'interest_rate' => 'required|numeric',
        // ]);

        $w = new SavingsWithdrawal();
        $w->customer_id = $request->customer;
        $w->amount = $request->amount;
        // $w->date = now()->toDateString();
        $w->customer_name = $request->customer_name;
        $w->tran_date = now()->toDateString();
        $w->net_amount = $request->netAmount;
        $w->interest_amount = $request->interestAmount;
        $w->interest_rate = $request->interestRate;
        $w->branch_id = $branch;
        $w->save();

        return redirect()->route('savingscustomer.index')->with('success', 'Withdrawal entry created successfully.');
    }

    public function printDeposit($id)
    {
        $branch = auth()->user()->branch_id;
        $company = Branch::find($branch);
        $deposit = SavingsDeposit::find($id);

        return view('pages.savingscustomer.depositentry.printDeposit.index', compact('deposit', 'company'));
    }

    public function printWithdrawal($id)
    {
        $branch = auth()->user()->branch_id;
        $company = Branch::find($branch);
        $withdraw = SavingsWithdrawal::find($id);
        return view('pages.savingscustomer.withdrawalentry.printWithdrawal.index', compact('withdraw', 'company'));
    }

    public function exportsavingsData()
    {
        $filename = 'savingsdepositData.csv';
        $data = SavingsDeposit::all();
        $headers = [
            "Content-type" => "text/csv",
            "Content-Disposition" => "attachment; filename=".$filename."",
            "Pragma" => "no-cache",
            "Cache-Control" => "must-revalidate, post-check=0, pre-check=0",
            "Expires" => "0",];
        $columns = ['customer_id', 'customer_name', 'tran_date', 'amount'];
        $callback = function () use ($data, $columns) {
            $file = fopen('php://output', 'w');
            fputcsv($file, $columns);
    
            foreach ($data as $row) {
                fputcsv($file, [
                    $row->customer_id,
                    $row->customer_name, // Replace with your actual column names
                    $row->tran_date,
                    $row->amount,
                ]);
            }
    
            fclose($file);
        };
    
        return response()->stream($callback, 200, $headers);

    }
    
    public function exportwithdrawalData()
    {
        $filename = 'savingswithdrawalData.csv';
        $data = SavingsWithdrawal::all();
        $headers = [
            "Content-type" => "text/csv",
            "Content-Disposition" => "attachment; filename=".$filename."",
            "Pragma" => "no-cache",
            "Cache-Control" => "must-revalidate, post-check=0, pre-check=0",
            "Expires" => "0",];
        $columns = ['customer_id', 'customer_name', 'tran_date', 'amount'];
        $callback = function () use ($data, $columns) {
            $file = fopen('php://output', 'w');
            fputcsv($file, $columns);
    
            foreach ($data as $row) {
                fputcsv($file, [
                    $row->customer_id,
                    $row->customer_name,
                    $row->tran_date,
                    $row->amount,
                ]);
            }
    
            fclose($file);
        };
    
        return response()->stream($callback, 200, $headers);

    }
    
}
