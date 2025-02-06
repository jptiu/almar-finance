<?php

namespace App\Http\Controllers;

use App\Http\Requests\CustomerTypeCreateRequest;
use App\Http\Requests\CustomerTypeUpdateRequest;
use App\Models\CustomerType;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class CustomerTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        abort_unless(Gate::allows('loan_access') || Gate::allows('branch_access'), 404);
        $branch = auth()->user()->branch_id;
        if ($request->search) {
            $lists = CustomerType::with('user')
                ->where('branch_id', $branch)
                ->where('code', 'LIKE', '%', $request->search, '%')->orderBy("created_at", "asc")
                ->paginate(20);
        }else{
            $lists = CustomerType::with('user')->where('branch_id', $branch)->paginate(20);
        }
        $query = CustomerType::where('branch_id', $branch);

        if ($request->filter) {
            $query->where('user_id', $request->filter);
        }

        $lists = $query->paginate(10);

        // Get distinct user_ids for filter selection
        $distinctUserIds = CustomerType::where('branch_id', $branch)
            ->select('user_id') // Select only the user_id column
            ->distinct() // Get distinct user_id values
            ->pluck('user_id');
        

        return view('pages.customerType.index', compact('lists','distinctUserIds'));
    }

    public function add()
    {
        abort_unless(Gate::allows('loan_access') || Gate::allows('branch_access'), 404);
        $branch = auth()->user()->branch_id;
        $collectors = User::where('branch_id', $branch)->where('roles.title', 'Collector')
            ->join('role_user', 'users.id', '=', 'role_user.user_id')
            ->join('roles', 'role_user.role_id', '=', 'roles.id')
            ->get();

        return view('pages.customerType.add.index', compact('collectors'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CustomerTypeCreateRequest $request)
    {
        abort_unless(Gate::allows('loan_access') || Gate::allows('branch_access'), 404);
        $branch = auth()->user()->branch_id;
        if ($request->validated()) {
            $customer = new CustomerType();
            $customer->code = $request->code;
            $customer->description = $request->description;
            $customer->user_id = $request->user_id;
            $customer->branch_id = $branch;
            $customer->save();

            return redirect(route("customerType.index"))->with('success', 'Customer Type Created Successfully');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        abort_unless(Gate::allows('loan_access') || Gate::allows('branch_access'), 404);
        $customer = CustomerType::where('id', $id)->first();
        $collectors = User::where('roles.title', 'Collector')
            ->join('role_user', 'users.id', '=', 'role_user.user_id')
            ->join('roles', 'role_user.role_id', '=', 'roles.id')
            ->get();

        return view('pages.customerType.update.index', compact('customer', 'collectors'));

    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CustomerTypeUpdateRequest $request, string $id)
    {
        abort_unless(Gate::allows('loan_access') || Gate::allows('branch_access'), 404);
        if ($request->validated()) {
            $customer = CustomerType::find($id);
            $customer->code = $request->code;
            $customer->description = $request->description;
            $customer->user_id = $request->user_id;
            $customer->update();

            return redirect(route("customerType.index"))->with('success', 'Custoemr Type Updated Successfully');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        abort_unless(Gate::allows('loan_access') || Gate::allows('branch_access'), 404);
        $customer = CustomerType::find($id);
        $customer->delete();

        return redirect()->back()->with('success', 'Customer Type deleted.');
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
            CustomerType::create([
                'code' => $row[1],
                'description' => $row[2],
                'user_id' => $row[3],
                'branch_id' => $branch,
            ]);
        }

        return redirect(route("customerType.index"))->with('success', 'CSV Data Imported Successfully');
    }
}
