<?php

namespace App\Http\Controllers;

use App\Models\Collection;
use App\Models\Customer;
use App\Models\Loan;
use App\Models\LoanDetails;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class CollectionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        //abort_unless(Gate::allows('loan_access'), 404);
        $branch = auth()->user()->branch_id;
        $lists = Collection::with('user')->where('branch_id', $branch)->paginate(20);
        $customers = Customer::where('branch_id', $branch)->get();
        $collectors = User::where('branch_id', $branch)->where('roles.title', 'Collector')
            ->join('role_user', 'users.id', '=', 'role_user.user_id')
            ->join('roles', 'role_user.role_id', '=', 'roles.id')
            ->get();
        $loan = [];
        $customer = [];
        if ($request->transaction_no) {
            $loan = Loan::with('customer')->find($request->transaction_no);
        }
        if ($request->customer_id) {
            $customer = Customer::with(['loan' => function ($query) {
                $query->where('status', '!=', null);
            } ,'customerType','loan.details' => function ($query) {
                $query->whereNull('loan_date_paid'); // Filter due today
            }])->find($request->customer_id);
        }
        // Check if the request is an AJAX call
        if ($request->ajax()) {
            return response()->json([
                'customer' => $customer,
                'loan' => $loan,
            ]);
        }
        

        return view('pages.collections.index', compact('lists', 'customers', 'collectors'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        abort_unless(Gate::allows('loan_access') || Gate::allows('branch_access'), 404);
        $branch = auth()->user()->branch_id;
        $customers = Customer::where('branch_id', $branch)->get();
        $collectors = User::where('branch_id', $branch)->where('roles.title', 'Collector')
            ->join('role_user', 'users.id', '=', 'role_user.user_id')
            ->join('roles', 'role_user.role_id', '=', 'roles.id')
            ->get();

        return view('pages.collections.entry.index', compact('customers', 'collectors'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $branch = auth()->user()->branch_id;
        $loan = Loan::findOrFail($request->trans_no);
        $loanDetails = LoanDetails::where('loan_id', $loan->id)
            ->where('loan_day_no', $request->loan_no)
            ->first();
        if($loanDetails){
            $loanDetails->loan_date_paid = Carbon::createFromFormat('Y-m-d', $request->date_paid)->format('m/d/Y');
            $loanDetails->loan_amount_paid = $request->loan_amount_paid;
            $loanDetails->loan_amount_change = $request->loan_amount_change ?? 0;
            $loanDetails->loan_withdraw_from_bank = $request->loan_withdraw_from_bank ?? 0;
            $loanDetails->update();
        }

        if ($loan) {
            $col = new Collection();
            $col->customer_id = $loan->customer_id;
            $col->user_id = auth()->user()->id;
            $col->name = $request->name;
            $col->type = $request->type;
            $col->status = $request->status;
            $col->trans_no = $request->trans_no;
            $col->date = Carbon::createFromFormat('Y-m-d', $request->date_paid)->format('m/d/Y');
            $col->paid_amount = $request->loan_amount_paid;
            $col->branch_id = $branch;
            $col->lat = $request->lat ?? 0;
            $col->long = $request->long ?? 0;
            $col->loan_details_id = $loanDetails->id;
            $col->save();
        }
        if($loanDetails->loan_running_balance == 0){
            $loan->status = 'FULPD';
            $loan->update();
        }

        return redirect(route("collection.index"))->with('success', 'Payment has been made.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        abort_unless(Gate::allows('loan_access') || Gate::allows('branch_access'), 404);
        $collection = Collection::where('id', $id)->first();

        return view('pages.collections.show.index', compact('collection'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request,string $id)
    {
        abort_unless(Gate::allows('loan_access') || Gate::allows('branch_access'), 404);
        $branch = auth()->user()->branch_id;
        $collection = Collection::where('branch_id', $branch)->find($id);
        $customers = Customer::where('branch_id', $branch)->get();
        $collectors = User::where('branch_id', $branch)->where('roles.title', 'Collector')
            ->join('role_user', 'users.id', '=', 'role_user.user_id')
            ->join('roles', 'role_user.role_id', '=', 'roles.id')
            ->get();
        $loan = [];
        $customer = [];
        if ($request->customer_id) {
            $customer = Customer::with(['loan' => function ($query) {
                $query->where('status', '!=', null);
            } ,'customerType','loan.details' => function ($query) {
                $query->whereNull('loan_date_paid'); // Filter due today
            }])->find($request->customer_id);
        }
        // Check if the request is an AJAX call
        if ($request->ajax()) {
            return response()->json([
                'customer' => $customer,
                'loan' => $loan,
            ]);
        }

        return view('pages.collections.update.index', compact('collection', 'customers', 'collectors'));
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
