<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\CustomerCreateRequest;
use App\Http\Requests\CustomerUpdateRequest;
use App\Models\Collection;
use App\Models\Customer;
use App\Models\CustomerType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Carbon\Carbon;
use App\Models\LoanDetails;
use App\Models\Loan;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        // abort_unless(Gate::allows('loan_access') || Gate::allows('branch_access'), 404);
        try {
            $branch = auth()->user()->branch_id;
            if (isset($request->search)) {
                $lists = Customer::with([
                    'loan.details',
                    'collections' => function ($query) {
                        $query->select('id', 'lat', 'long', 'customer_id')
                            ->latest('created_at');
                    },
                    'bry', // Eager load Barangay relationship
                    'cty'      // Eager load City relationship
                ])
                    ->where('branch_id', $branch)
                    ->where('first_name', 'LIKE', '%' . $request->search . '%')
                    ->orderBy("created_at", "asc")
                    ->paginate(20);
            } else {
                $lists = Customer::with([
                    'loan.details',
                    'collections' => function ($query) {
                        $query->select('id', 'lat', 'long', 'customer_id')
                            ->latest('created_at');
                    }
                ])->where('branch_id', $branch)->paginate(10);
            }

            return response()->json($lists, 200);
        } catch (\Throwable $th) {
            //throw $th;
            $lists = Customer::where('branch_id', $branch)->paginate(10);
            return response()->json($lists, 200);
        }
    }

    public function add()
    {
        abort_unless(Gate::allows('loan_access') || Gate::allows('branch_access'), 404);
        $branch = auth()->user()->branch_id;
        $types = CustomerType::where('branch_id', $branch)->get();
        return view('pages.customer.add.index', compact('types'));
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
    public function store(CustomerCreateRequest $request)
    {
        abort_unless(Gate::allows('loan_access') || Gate::allows('branch_access'), 404);
        $branch = auth()->user()->branch_id;
        if ($request->validated()) {
            $customer = new Customer();
            $customer->type = $request->type;
            $customer->first_name = $request->first_name;
            $customer->middle_name = $request->middle_name;
            $customer->last_name = $request->last_name;
            $customer->house = $request->house;
            $customer->street = $request->street;
            $customer->barangay = $request->barangay;
            $customer->city = $request->city;
            $customer->job_position = $request->job_position;
            $customer->salary_sched = $request->salary_sched;
            $customer->tel_number = $request->tel_number;
            $customer->cell_number = $request->cell_number;
            $customer->civil_status = $request->civil_status;
            $customer->status = 1;
            $customer->branch_id = $branch;
            $customer->save();

            return redirect(route("customer.index"))->with('success', 'Created Successfully');

        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        // abort_unless(Gate::allows('loan_access') || Gate::allows('branch_access'), 404);
        $branch = auth()->user()->branch_id;
        $customer = Customer::with([
            'loan' => function ($query) {
                $query->where('status', '!=', null);
            },
            'customerType',
            'loan.details' => function ($query) {
                $query->whereNull('loan_date_paid'); // Filter due today
            },
            'collections'
        ])->find($id);

        return response()->json($customer, 200);
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
    public function update(CustomerUpdateRequest $request, string $id)
    {
        abort_unless(Gate::allows('loan_access') || Gate::allows('branch_access'), 404);
        if ($request->validated()) {
            $customer = Customer::find($id);
            $customer->type = $request->type;
            $customer->first_name = $request->first_name;
            $customer->middle_name = $request->middle_name;
            $customer->last_name = $request->last_name;
            $customer->house = $request->house;
            $customer->street = $request->street;
            $customer->barangay = $request->barangay;
            $customer->city = $request->city;
            $customer->job_position = $request->job_position;
            $customer->salary_sched = $request->salary_sched;
            $customer->tel_number = $request->tel_number;
            $customer->cell_number = $request->cell_number;
            $customer->status = $request->status;
            $customer->save();

            return redirect(route("customer.index"))->with('success', 'Updated Successfully');

        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        abort_unless(Gate::allows('loan_access') || Gate::allows('branch_access'), 404);
        $customer = Customer::find($id);
        $customer->delete();

        return redirect()->back()->with('success', 'Customer deleted.');
    }

    public function importPage()
    {
        return view('pages.customer.import.index');
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
            // Create and save your model instance
            Customer::create([
                'id' => $row[0],
                'type' => $row[9],
                'first_name' => $row[1],
                'middle_name' => $row[2],
                'last_name' => $row[3],
                'house' => $row[4],
                'street' => $row[5],
                'barangay' => $row[6],
                'city' => $row[7],
                'job_position' => $row[14],
                'salary_sched' => $row[18],
                'tel_number' => $row[15],
                'cell_number' => $row[16],
                'status' => $row[8],
                'civil_status' => '',
                'branch_id' => $branch,
            ]);
        }

        return redirect(route("customer.index"))->with('success', 'CSV Data Imported Successfully');
    }

    public function collection()
    {
        $currentMonth = Carbon::now()->month;
        $currentYear = Carbon::now()->year;
        $today = Carbon::now()->toDateString();
        $monthlyCollection = Collection::whereMonth('date', $currentMonth)
            ->whereYear('date', $currentYear)
            ->sum('paid_amount');
        $todayCollection = Collection::whereDate('date', $today)
            ->sum('paid_amount');

        return response()->json([
            'monthly_collections' => $monthlyCollection,
            'daily_collections' => $todayCollection,
        ], 200);
    }

    public function pastDue()
    {
        $today = Carbon::now()->toDateString();

        $branch = auth()->user()->branch_id;
        // Fetch overdue loan details with days past due
        $overdueLoans = LoanDetails::where('branch_id', $branch)
            ->where('loan_due_date', '<', $today)
            ->with([
                'loan' => function ($query) {
                    $query->where('status', 'UNPD');
                }
            ]) // has a relationship with Loan
            ->paginate(100)
            ->map(function ($detail) use ($today) {
                $dueDate = Carbon::parse($detail->loan_due_date);
                $daysPastDue = $dueDate->diffInDays($today); // Calculate days overdue
                $loan = Loan::with('customer')->find($detail->loan_id);

                return [
                    'loan_id' => $detail->loan_id,
                    'customer_id' => $loan->customer->id,
                    'customer_name' => $loan->customer->first_name . ' ' . $loan->customer->last_name, // Assuming Loan model has customer_name
                    'due_date' => $detail->loan_due_date,
                    'days_past_due' => $daysPastDue,
                ];
            });
        return response()->json([
            'overdue_loans' => $overdueLoans,
        ]);
    }

    public function badAccounts()
    {
        // Fetch delinquent loans where transaction_customer_status is 'BA'
        $delinquentLoans = Loan::where('transaction_customer_status', 'BA')
            ->with(['details']) // Load the related LoanDetails
            ->get()
            ->map(function ($loan) {
                return $loan->details->map(function ($detail) use ($loan) {
                    return [
                        'loan_id' => $loan->id,
                        'customer_name' => $loan->customer_name, // Replace with actual customer name column
                        'status' => $loan->transaction_customer_status,
                        'loan_amount' => $detail->loan_amount, // Loan amount from LoanDetails
                        'due_date' => $detail->loan_due_date,  // Due date from LoanDetails
                    ];
                });
            })
            ->flatten();
        return response()->json([
            'delinquent_loans' => $delinquentLoans,
        ]);
    }
}
