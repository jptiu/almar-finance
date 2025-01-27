<?php

namespace App\Http\Controllers;

use App\Http\Requests\CustomerCreateRequest;
use App\Http\Requests\CustomerUpdateRequest;
use App\Models\Barangay;
use App\Models\CityTown;
use App\Models\Customer;
use App\Models\Branch;
use App\Models\CustomerType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        abort_unless(Gate::allows('loan_access') || Gate::allows('branch_access') || Gate::allows('admin_access') || Gate::allows('auditor_access'), 404);
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


            return view('pages.customer.index', compact('lists'));
        } catch (\Throwable $th) {
            //throw $th;
            $lists = Customer::where('branch_id', $branch)->paginate(20);
            return view('pages.customer.index', compact('lists'));
        }
    }

    public function add()
    {
        abort_unless(Gate::allows('loan_access') || Gate::allows('branch_access'), 404);
        $branch = auth()->user()->branch_id;
        $types = CustomerType::where('branch_id', $branch)->paginate(20);
        $barangays = Barangay::where('branch_id', $branch)->get();
        $cities = CityTown::where('branch_id', $branch)->get();
        return view('pages.customer.add.index', compact('types', 'barangays', 'cities'));
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
        abort_unless(Gate::allows('loan_access') || Gate::allows('branch_access'), 404);
        $branch = auth()->user()->branch_id;
        // if ($request->validated()) {
        $customer = new Customer();
        $customer->type = $request->type;
        $customer->first_name = $request->first_name;
        $customer->middle_name = $request->middle_name;
        $customer->last_name = $request->last_name;
        $customer->house = $request->house ?? '.';
        $customer->street = $request->street ?? '.';
        $customer->barangay = $request->barangay;
        $customer->city = $request->city;
        $customer->email = $request->email;
        $customer->job_position = $request->job_position;
        $customer->salary_sched = $request->salary_sched;
        $customer->tel_number = $request->tel_number;
        $customer->cell_number = $request->cell_number;
        $customer->civil_status = $request->civil_status;
        $customer->status = 'AC';
        $customer->birth_date = $request->birth_date;
        $customer->birth_place = $request->birth_place;
        $customer->age = $request->age;
        $customer->gender = $request->gender;
        $customer->citizenship = $request->citizenship;
        $customer->facebook_name = $request->facebook_name;
        $customer->spouse_name = $request->spouse_name;
        $customer->spouse_number = $request->spouse_number;
        $customer->spouse_age = $request->spouse_age;
        $customer->spouse_bdate = $request->spouse_bdate;
        $customer->spouse_fb = $request->spouse_fb;
        $customer->occupation = $request->occupation;
        $customer->c_nameadd = $request->c_nameadd;
        $customer->agency_name = $request->agency_name;
        $customer->add_tel = $request->add_tel;
        $customer->add_telc = $request->add_telc;
        $customer->comp_name = $request->comp_name;
        // $customer->date_hired = $request->date_hired;
        $customer->day_off = $request->day_off;
        $customer->monthly_salary = $request->monthly_salary;
        $customer->salary_sched = $request->salary_sched;
        $customer->monthly_pension = $request->monthly_pension;
        $customer->pension_sched = $request->pension_sched;
        $customer->pension_type = $request->pension_type;
        $customer->fathers_name = $request->fathers_name;
        $customer->fathers_num = $request->fathers_num;
        $customer->mothers_name = $request->mothers_name;
        $customer->mothers_num = $request->mothers_num;
        $customer->fathers_name = $request->fathers_name;
        $customer->branch = $request->branch;
        $customer->card_no = $request->card_no;
        $customer->acc_no = $request->acc_no;
        $customer->pin_no = $request->pin_no;
        $customer->branch_id = $branch;
        $customer->user_id = auth()->user()->id;
        $customer->save();

        return redirect(route("customer.index"))->with('success', 'Created Successfully');

        // }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        abort_unless(Gate::allows('loan_access') || Gate::allows('branch_access') || Gate::allows('auditor_access'), 404);
        $branch = auth()->user()->branch_id;
        $customer = Customer::where('branch_id', $branch)->where('id', $id)->first();

        return view('pages.customer.show.index', compact('customer'));

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        abort_unless(Gate::allows('loan_access') || Gate::allows('branch_access'), 404);
        $branch = auth()->user()->branch_id;
        $customer = Customer::where('branch_id', $branch)->where('id', $id)->first();
        $types = CustomerType::where('branch_id', $branch)->paginate(20);
        $barangays = Barangay::all();
        $cities = CityTown::all();
        return view('pages.customer.update.index', compact('customer', 'types', 'barangays', 'cities'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        abort_unless(Gate::allows('loan_access') || Gate::allows('branch_access'), 404);
        // if ($request->validated()) {
        $customer = Customer::find($id);
        $customer->type = $request->type;
        $customer->first_name = $request->first_name;
        $customer->middle_name = $request->middle_name;
        $customer->last_name = $request->last_name;
        $customer->house = $request->house ?? '.';
        $customer->street = $request->street ?? '.';
        $customer->barangay = $request->barangay;
        $customer->city = $request->city;
        $customer->email = $request->email;
        $customer->job_position = $request->job_position;
        $customer->salary_sched = $request->salary_sched;
        $customer->tel_number = $request->tel_number;
        $customer->cell_number = $request->cell_number;
        $customer->civil_status = $request->civil_status;
        $customer->status = 'AC';
        $customer->birth_date = $request->birth_date;
        $customer->birth_place = $request->birth_place;
        $customer->age = $request->age;
        $customer->gender = $request->gender;
        $customer->citizenship = $request->citizenship;
        $customer->facebook_name = $request->facebook_name;
        $customer->spouse_name = $request->spouse_name;
        $customer->spouse_number = $request->spouse_number;
        $customer->spouse_age = $request->spouse_age;
        $customer->spouse_bdate = $request->spouse_bdate;
        $customer->spouse_fb = $request->spouse_fb;
        $customer->occupation = $request->occupation;
        $customer->c_nameadd = $request->c_nameadd;
        $customer->agency_name = $request->agency_name;
        $customer->add_tel = $request->add_tel;
        $customer->add_telc = $request->add_telc;
        $customer->comp_name = $request->comp_name;
        // $customer->date_hired = $request->date_hired;
        $customer->day_off = $request->day_off;
        $customer->monthly_salary = $request->monthly_salary;
        $customer->salary_sched = $request->salary_sched;
        $customer->monthly_pension = $request->monthly_pension;
        $customer->pension_sched = $request->pension_sched;
        $customer->pension_type = $request->pension_type;
        $customer->fathers_name = $request->fathers_name;
        $customer->fathers_num = $request->fathers_num;
        $customer->mothers_name = $request->mothers_name;
        $customer->mothers_num = $request->mothers_num;
        $customer->fathers_name = $request->fathers_name;
        $customer->branch = $request->branch;
        $customer->card_no = $request->card_no;
        $customer->acc_no = $request->acc_no;
        $customer->pin_no = $request->pin_no;
        $customer->update();

        return redirect(route("customer.index"))->with('success', 'Updated Successfully');

        // }
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

    public function printCustomer($id)
    {
        $branch = auth()->user()->branch_id;
        $branchAddress = Branch::find($branch);
        $customer = Customer::with([
            'loan',
            'loan.details'
        ])->where('branch_id', $branch)->find($id);

        return view('pages.customer.print.index', compact('customer', 'branchAddress'));
    }
}
