<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\CustomerType;
use App\Models\Loan;
use App\Models\LoanDetails;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Vtiful\Kernel\Excel;

class AuditorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        abort_unless(Gate::allows('auditor_access'), 404);
        $branch = auth()->user()->branch_id;

        return view('pages.auditor.index');
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

    public function loanLists(Request $request)
    {
        abort_unless(Gate::allows('auditor_access'), 404);
        $branch = auth()->user()->branch_id;
        if ($request->search) {
            $lists = Loan::with(['customer'])->where('branch_id', $branch)
                ->where('id', $request->search)
                ->paginate(10);
        } else {
            $lists = Loan::where('branch_id', $branch)->paginate(10);
        }
        $types = CustomerType::where('branch_id', $branch)->get();
        $loan = [];
        $customer = [];
        if ($request->transaction_no) {
            $loan = Loan::with('customer')->find($request->transaction_no);
        }
        if ($request->id) {
            $customer = Customer::find($request->id);
        }
        // Check if the request is an AJAX call
        if ($request->ajax()) {
            return response()->json([
                'customer' => $customer,
                'loan' => $loan,
            ]);
        }

        return view('pages.auditor.loans.index', compact('lists', 'types', 'customer', 'loan'));

    }

    public function customerLists(Request $request)
    {
        abort_unless(Gate::allows('auditor_access'), 404);
        try {
            $branch = auth()->user()->branch_id;
            if ($request->search) {
                $lists = Customer::where('branch_id', $branch)
                    ->where('first_name', 'LIKE', '%' . $request->search . '%')
                    ->orderBy("created_at", "asc")
                    ->paginate(20);
            } else {
                $lists = Customer::where('branch_id', $branch)->paginate(20);
            }


            return view('pages.auditor.customers.index', compact('lists'));
        } catch (\Throwable $th) {
            //throw $th;
            $lists = Customer::where('branch_id', $branch)->paginate(20);
            return view('pages.auditor.customers.index', compact('lists'));
        }
    }

    public function baMonth()
    {
        $branch = auth()->user()->branch_id;
        $now = Carbon::now();
        $startOfMonth = $now->startOfMonth()->toDateTimeString(); // Start of the current month
        $endOfMonth = $now->endOfMonth()->toDateTimeString();     // End of the current month

        $loans = LoanDetails::with([
            'loan' => function ($query)use ($branch, $startOfMonth, $endOfMonth) {
                $query->where('branch_id', $branch)
                    ->where('loan_type', 'monthly')
                    ->where('transaction_customer_status', 'BA')
                    ->whereBetween('updated_at', [$startOfMonth, $endOfMonth])
                    ->orderBy('updated_at', 'asc');
            }
        ])
            // ->where('loan_amount_paid', null)
            ->get();

        return view('pages.auditor.bamonth.index', compact('loans'));
    }
    public function baMonthExport()
    {
        $branch = auth()->user()->branch_id;
        $now = Carbon::now();
        $startOfMonth = $now->startOfMonth()->toDateTimeString(); // Start of the current month
        $endOfMonth = $now->endOfMonth()->toDateTimeString();     // End of the current month

        $filename = 'loans_export_bamonth.csv';
        $data = LoanDetails::with([
            'loan' => function ($query)use ($branch, $startOfMonth, $endOfMonth) {
                $query->where('branch_id', $branch)
                    ->where('loan_type', 'monthly')
                    ->where('transaction_customer_status', 'BA')
                    ->whereBetween('updated_at', [$startOfMonth, $endOfMonth])
                    ->orderBy('updated_at', 'asc');
            }
        ])
            // ->where('loan_amount_paid', null)
            ->get();
        $headers = [
            "Content-type" => "text/csv",
            "Content-Disposition" => "attachment; filename=" . $filename . "",
            "Pragma" => "no-cache",
            "Cache-Control" => "must-revalidate, post-check=0, pre-check=0",
            "Expires" => "0",
        ];
        $columns = [
            'ID',
            'Branch ID',
            'Client Name',
            'Company',
            'Amount Due',
            'Due Date',
            'With Interest',
            'Payment',
            'Balance',
            'Updated At'
        ];
        $callback = function () use ($data, $columns) {
            $file = fopen('php://output', 'w');
            fputcsv($file, $columns);

            foreach ($data as $loan) {
                fputcsv($file, [
                    $loan->id,
                    $loan->loan->branch_id,
                    $loan->loan->customer->first_name . ' ' . $loan->loan->customer->last_name,
                    $loan->loan->customer->comp_name,
                    $loan->loan_due_amount,
                    $loan->loan_due_date,
                    $loan->loan->interest_amount,
                    $loan->loan_amount_paid,
                    $loan->loan_running_balance,
                    $loan->loan->updated_at,
                ]);
            }

            fclose($file);
        };

        return response()->stream($callback, 200, $headers);

    }

    public function baDaily()
    {
        $branch = auth()->user()->branch_id;
        $now = Carbon::now();
        $startOfMonth = $now->startOfMonth()->toDateTimeString(); // Start of the current month
        $endOfMonth = $now->endOfMonth()->toDateTimeString();     // End of the current month

        $loans = LoanDetails::with([
            'loan' => function ($query)use ($branch, $startOfMonth, $endOfMonth) {
                $query->where('branch_id', $branch)
                    ->where('loan_type', 'daily')
                    ->where('transaction_customer_status', 'BA')
                    ->whereBetween('updated_at', [$startOfMonth, $endOfMonth])
                    ->orderBy('updated_at', 'asc');
            }
        ])
            ->where('loan_amount_paid', null)
            ->get();

        return view('pages.auditor.badaily.index', compact('loans'));
    }
    public function baDailyExport()
    {
        $branch = auth()->user()->branch_id;
        $now = Carbon::now();
        $startOfMonth = $now->startOfMonth()->toDateTimeString(); // Start of the current month
        $endOfMonth = $now->endOfMonth()->toDateTimeString();     // End of the current month

        $filename = 'loans_export_bamonth.csv';
        $data = LoanDetails::with([
            'loan' => function ($query)use ($branch, $startOfMonth, $endOfMonth) {
                $query->where('branch_id', $branch)
                    ->where('loan_type', 'daily')
                    ->where('transaction_customer_status', 'BA')
                    ->whereBetween('updated_at', [$startOfMonth, $endOfMonth])
                    ->orderBy('updated_at', 'asc');
            }
        ])
            ->where('loan_amount_paid', null)
            ->get();
        $headers = [
            "Content-type" => "text/csv",
            "Content-Disposition" => "attachment; filename=" . $filename . "",
            "Pragma" => "no-cache",
            "Cache-Control" => "must-revalidate, post-check=0, pre-check=0",
            "Expires" => "0",
        ];
        $columns = [
            'ID',
            'Branch ID',
            'Client Name',
            'Company',
            'Amount Due',
            'Due Date',
            'With Interest',
            'Payment',
            'Balance',
            'Updated At'
        ];
        $callback = function () use ($data, $columns) {
            $file = fopen('php://output', 'w');
            fputcsv($file, $columns);

            foreach ($data as $loan) {
                fputcsv($file, [
                    $loan->id,
                    $loan->branch_id,
                    $loan->customer->first_name . ' ' . $loan->customer->last_name,
                    $loan->customer->comp_name,
                    $loan->latestDue->loan_due_amount,
                    $loan->latestDue->loan_due_date,
                    $loan->interest_amount,
                    $loan->latestDue->loan_amount_paid,
                    $loan->latestDue->loan_running_balance,
                    $loan->updated_at,
                ]);
            }

            fclose($file);
        };

        return response()->stream($callback, 200, $headers);

    }

    public function baCollection()
    {
        $branch = auth()->user()->branch_id;
        $now = Carbon::now();
        $startOfMonth = $now->startOfMonth()->toDateTimeString(); // Start of the current month
        $endOfMonth = $now->endOfMonth()->toDateTimeString();     // End of the current month

        $loans = LoanDetails::with([
            'loan' => function ($query)use ($branch, $startOfMonth, $endOfMonth) {
                $query->where('branch_id', $branch)
                    ->where('loan_type', 'monthly')
                    ->where('transaction_customer_status', 'BA')
                    ->whereBetween('updated_at', [$startOfMonth, $endOfMonth])
                    ->orderBy('updated_at', 'asc');
            }
        ])
            ->where('loan_amount_paid', '!=', null)
            ->get();

        return view('pages.auditor.bacollection.index', compact('loans'));
    }

    public function baCollectionExport()
    {
        $branch = auth()->user()->branch_id;
        $now = Carbon::now();
        $startOfMonth = $now->startOfMonth()->toDateTimeString(); // Start of the current month
        $endOfMonth = $now->endOfMonth()->toDateTimeString();     // End of the current month

        $filename = 'loans_export_ba_collection.csv';
        $data = LoanDetails::with([
            'loan' => function ($query)use ($branch, $startOfMonth, $endOfMonth) {
                $query->where('branch_id', $branch)
                    ->where('loan_type', 'monthly')
                    ->where('transaction_customer_status', 'BA')
                    ->whereBetween('updated_at', [$startOfMonth, $endOfMonth])
                    ->orderBy('updated_at', 'asc');
            }
        ])
            ->where('loan_amount_paid', '!=', null)
            ->get();
        $headers = [
            "Content-type" => "text/csv",
            "Content-Disposition" => "attachment; filename=" . $filename . "",
            "Pragma" => "no-cache",
            "Cache-Control" => "must-revalidate, post-check=0, pre-check=0",
            "Expires" => "0",
        ];
        $columns = [
            'Date',
            'Client Name',
            'Company',
            'Amount Paid',
            'Total Balance',
            'Type',
            'Remarks',
        ];
        $callback = function () use ($data, $columns) {
            $file = fopen('php://output', 'w');
            fputcsv($file, $columns);

            foreach ($data as $loan) {
                fputcsv($file, [
                    $loan->loan_date_paid,
                    $loan->loan->customer->first_name . ' ' . $loan->loan->customer->last_name,
                    $loan->loan->customer->comp_name,
                    $loan->loan_amount_paid,
                    $loan->loan_running_balance,
                    $loan->loan->transaction_customer_status,
                    // $loan->details->loan_running_balance == '0.00' ? 'Full Paid': '',
                ]);
            }

            fclose($file);
        };

        return response()->stream($callback, 200, $headers);

    }
}
