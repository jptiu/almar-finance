<?php

namespace App\Http\Controllers;

use App\Http\Requests\CustomerCreateRequest;
use App\Http\Requests\CustomerUpdateRequest;
use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        abort_unless(Gate::allows('loan_access'), 404);
        $lists = Customer::where('first_name', 'LIKE', '%', $request->search, '%')->orderBy("created_at", "asc")->get();

        return view('pages.customer.index', compact('lists'));
    }

    public function add()
    {
        abort_unless(Gate::allows('loan_access'), 404);

        return view('pages.customer.add.index');
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
        abort_unless(Gate::allows('loan_access'), 404);
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
            $customer->status = $request->status;
            $customer->save();

            return redirect(route("customer.index"))->with('success', 'Created Successfully');

        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        abort_unless(Gate::allows('loan_access'), 404);
        $customer = Customer::where('id', $id)->first();

        return view('pages.customer.update.index', compact('customer'));
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
        abort_unless(Gate::allows('loan_access'), 404);
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
        abort_unless(Gate::allows('loan_access'), 404);
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
                'type' => $row[0],
                'first_name' => $row[1],
                'middle_name' => $row[2],
                'last_name' => $row[3],
                'house' => $row[4],
                'street' => $row[5],
                'barangay' => $row[6],
                'city' => $row[7],
                'job_position' => $row[8],
                'salary_sched' => $row[9],
                'tel_number' => $row[10],
                'cell_number' => $row[11],
                'status' => $row[12],
            ]);
        }

        return redirect(route("customer.index"))->with('success', 'CSV Data Imported Successfully');
    }
}
