<?php

namespace App\Http\Controllers;

use App\Models\ActivityLog;
use App\Models\Branch;
use App\Models\Breakdown;
use App\Models\CashBill;
use App\Models\Collection;
use App\Models\ComputeCashOnHand;
use App\Models\Customer;
use App\Models\DailyWorkOrder;
use App\Models\Expenses;
use App\Models\Loan;
use App\Models\SavingsDeposit;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class BMController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        abort_unless(Gate::allows('branch_access'), 404);
        $branch = auth()->user()->branch_id;
        $lists = Customer::where('branch_id', $branch)->orderByDesc('id')->paginate(10);
        $totalCustomer = Customer::where('branch_id', $branch)->count();

        $logs = ActivityLog::orderByDesc('id')->paginate(20);

        return view('pages.branch.index', compact('lists', 'totalCustomer', 'logs'));
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

    public function employeeEvaluation(Request $request)
    {
        return view('pages.employeeevaluation.index');
    }

    public function cashReqForm(Request $request)
    {
        return view('pages.cashadvreqform.index');
    }


    public function badAccount(Request $request)
    {
        $branch = auth()->user()->branch_id;

        // Initialize the base query
        $query = Loan::with('customer')
            ->where('branch_id', $branch)
            ->where('transaction_customer_status', 'BA')
            ->where('status', 'UNPD');

        // Apply the search filter
        if ($request->search) {
            $query->whereHas('customer', function ($query) use ($request) {
                $query->where('first_name', 'LIKE', '%' . $request->search . '%');
            });
        }

        // Execute the query with pagination
        $lists = $query->orderBy('created_at', 'asc')->paginate(20);

        return view('pages.badacc.index', compact('lists'));
    }

    public function regAccount(Request $request)
    {
        $lists = Loan::where('transaction_customer_status', '')->paginate(20);
        return view('pages.regacc.index', compact('lists'));
    }

    public function todaysPayer(Request $request)
    {
        return view('pages.todaypayer.index');
    }

    public function latePayer(Request $request)
    {
        return view('pages.latepayer.index');
    }
    public function paymentHistory(Request $request)
    {
        $branch = auth()->user()->branch_id;
        $lists = Collection::where('branch_id', $branch)->paginate(20);
        return view('pages.payhistory.index', compact('lists'));
    }

    public function pendingLoandApproval(Request $request)
    {
        $branch = auth()->user()->branch_id;
        // $lists = Loan::where('branch_id', $branch)->get();
        $lists = Loan::where('principal_amount', '<', '50000')
            ->where('branch_id', $branch)
            ->where('status', null)
            ->paginate(10);

        return view('pages.pendingloanapp.index', compact('lists'));
    }

    public function approvedLoan(Request $request)
    {
        $branch = auth()->user()->branch_id;
        $lists = Loan::where('principal_amount', '<', '50000')
            ->where('branch_id', $branch)
            ->where('status', '!=', null)
            ->where('status', '!=', 'CNCLD')->paginate(10);

        return view('pages.pendingloanapp.approvedloans.index', compact('lists'));
    }

    public function rejectedLoan(Request $request)
    {

        $lists = Loan::where('principal_amount', '<', '50000')
            ->where('status', '=', 'CNCLD')->paginate(10);

        return view('pages.pendingloanapp.rejectedloans.index', compact('lists'));
    }

    public function loanRenewal(Request $request)
    {
        return view('pages.loanrenewal.index');
    }

    public function overdueAcc(Request $request)
    {

        $lists = Loan::with(['details' => function ($query) {
            $query->where('loan_due_date', '<', now()->toDateString());
        }])
        ->where('transaction_customer_status', '')->paginate(20);
        return view('pages.overdueacc.index', compact('lists'));

    }

    public function biometricsAttendance()
    {
        return view('pages.attendancebm.index');
    }

    public function csor()
    {
        return view('pages.csor.index');
    }

    public function csorPrint(Request $request)
    {
        $branch = auth()->user()->branch_id;
        $branchlocation = Branch::find($branch);

        // Get the start and end dates of the current month
        // Assume this is the input from $request->date_range
        $dateRange = $request->date_range;

        // Split the date range into start and end dates
        [$startOfMonth, $endOfMonth] = explode(' - ', $dateRange);

        // Optionally convert the dates to a standard format (Y-m-d) if needed
        $startOfMonth = date('Y-m-d', strtotime($startOfMonth));
        $endOfMonth = date('Y-m-d', strtotime($endOfMonth));

        // Fetch expenses for the current month and branch
        $expenses = Expenses::where('branch_id', $branch)
            ->whereBetween('exp_date', [$startOfMonth, $endOfMonth])
            ->get();

        $breakdown = Breakdown::where('branch_id', $branch)->latest('created_at')->first();

        // Denominations and their types
        $denominations = [
            '1000.00' => 'pbil',
            '500.00' => 'pbil',
            '200.00' => 'pbil',
            '100.00' => 'pbil',
            '50.00' => 'pbil',
            '20.00' => 'pbil',
            '10.00' => 'coin',
            '5.00' => 'coin',
            '1.00' => 'coin',
            '0.25' => 'coin',
        ];

        $cashBillData = [];

        // Fetch data for each denomination
        foreach ($denominations as $denomination => $type) {
            $count = CashBill::where('branch_id', $branch)
                ->where('breakdown_id', $breakdown->id)
                ->where('denomination', $denomination)
                ->whereBetween('created_at', [$startOfMonth, $endOfMonth])
                ->count();

            $sum = CashBill::where('branch_id', $branch)
                ->where('breakdown_id', $breakdown->id)
                ->where('denomination', $denomination)
                ->whereBetween('created_at', [$startOfMonth, $endOfMonth])
                ->sum('amount');

            $cashBillData[] = [
                'denomination' => $denomination,
                'type' => $type,
                'count' => $count,
                'sum' => $sum
            ];
        }

        // Find compute cash on hand record
        $comps = ComputeCashOnHand::find($request->coh_id);

        // Return the view with compacted data
        return view('pages.csor.print.index', [
            'expenses' => $expenses,
            'cashBillData' => $cashBillData,
            'comps' => $comps,
            'branchlocation' => $branchlocation->location
        ]);
    }



    public function leaveRequest()
    {
        return view('pages.requestform.leave.index');
    }

    public function loanInformation()
    {
        return view('pages.loaninfo.index');
    }


    public function undertimeRequest()
    {
        return view('pages.requestform.undertime.index');
    }

    public function idRequest()
    {
        return view('pages.requestform.id.index');
    }

    public function clearanceRequest()
    {
        return view('pages.requestform.clearance.index');
    }

    public function cashadvanceRequest()
    {
        return view('pages.requestform.cashadvance.index');
    }

    public function cashBond(Request $request)
    {
        return view('pages.requestform.cashbond.index');
    }

    public function printStatement(Request $request, $id)
    {
        $loan = Loan::find($id);

        return view('pages.pendingloanapp.printStatement.index', compact('loan'));

    }

    public function cashBondPrint(Request $request)
    {

        return view('pages.requestform.cashbond.cashBondPrint.index');
    }

    public function reminderPay(Request $request)
    {

        return view('pages.reminder.index');
    }

    public function dailyWorklist(Request $request)
    {
        $lists = DailyWorkOrder::paginate(20);

        return view('pages.requestform.dailyworkorder.index', compact('lists'));
    }

    public function dailyWorkAdd(Request $request)
    {

        return view('pages.requestform.dailyworkorder.add.index');
    }

    public function dailyWorkStore(Request $request)
    {
        $workorder = new DailyWorkOrder();
        $workorder->type_of_holiday = $request->type_of_holiday;
        $workorder->date = $request->date;
        $workorder->user_id = auth()->user()->id;
        $workorder->save();

        return redirect()->route('dailyworkorder.index')->with('success', 'Request Daily Work Order Submitted');
    }

}
