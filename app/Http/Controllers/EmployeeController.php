<?php

namespace App\Http\Controllers;

use App\Http\Requests\EmployeeCreateRequest;
use App\Http\Requests\EmployeeUpdateRequest;
use App\Http\Requests\HRCreateRequest;
use App\Models\Employee;
use App\Models\HR;
use App\Models\NewHire;
use App\Models\Probation;
use App\Models\Resignation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Hash;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        abort_unless(Gate::allows('hr_access'), 404);
        $lists = Employee::get();

        return view('pages.hr.employee.index', compact('lists'));
    }

    public function add()
    {
        abort_unless(Gate::allows('hr_access'), 404);
        $lists = Employee::get();

        return view('pages.hr.employee.add.index', compact('lists'));
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
        abort_unless(Gate::allows('hr_access'), 404);
            $acc = \App\Models\User::factory()->create([
                'name' => $request->f_name.' '.$request->m_name.' '.$request->l_name,
                'email' => $request->f_name.' '.$request->l_name.'@almarfinance.com',
                'email_verified_at' => now(),
                'password' => Hash::make('password'),
                'created_at' => now(),
                'updated_at' => now()
            ]);
            var_dump($acc->id);

            $em = Employee::create($request->all());
            $em->save();
            $em->user_id = $acc->id;
            $em->update();

            $new = new NewHire();
            $new->user_id = $em->id;
            $new->date_hired = now()->toDateString();
            $new->status = 'Probation';
            $new->position = $em->position_desired;
            $new->save();

            if($new->status == 'Probation'){
                $prob = new Probation();
                $prob->user_id = $new->user_id;
                $prob->status = 'Probation';
                $prob->save();
            }

            return redirect(route("employee.index"))->with('success', 'Created Successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        abort_unless(Gate::allows('hr_access'), 404);
        $hr = HR::where('id', $id)->first();

        return view('pages.hr.employee.show', compact('hr'));
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
    public function update(EmployeeUpdateRequest $request, string $id, Employee $employee)
    {
        abort_unless(Gate::allows('hr_access'), 404);
        if($request->validated()){
            $employee->update($request->all());

            return redirect()->back()->with('success', 'Employee Updated.');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $emp = Employee::find($id);
        $emp->delete();

        return redirect()->back()->with('success', 'Employee Deleted.');
    }

    /**
     * BM Probation Display
     */
    public function bmprobation()
    {
        abort_unless(Gate::allows('hr_access'), 404);
        $lists = Probation::with('employee')->get();

        return view('pages.hr.employee.bmprobation.index', compact('lists'));
    }

    public function bmp_show($id)
    {
        abort_unless(Gate::allows('hr_access'), 404);
        // $lists = Probation::with('employee')->get();
        // $employee = Employee::where('id', $id)->first();
        $prob = Probation::with('employee')->find($id);

        return view('pages.hr.employee.bmprobation.edit.index', compact('prob'));
    }

    public function employeeshow($id)
    {
        abort_unless(Gate::allows('hr_access'), 404);
        $lists = Probation::with('employee')->get();
        $employee = Employee::where('id', $id)->first();

        return view('pages.hr.employee.show.index', compact('lists','employee'));
    }

    public function bmp_update(Request $request, string $id)
    {
        $prob = Probation::find($id);
        $prob->date_of_probation = $request->date_start.' - '.$request->date_end;
        $prob->quota = $request->quota;
        $prob->branch = $request->branch;
        $prob->type = $request->type;
        // $prob->status = $request->status;
        $prob->update();

        return redirect(route("bmprobation.index"))->with('success', 'Updated Successfully');
    }

    public function employeeupdate(EmployeeUpdateRequest $request, string $id)
    {
        if($request->validated()){
            $employee = Employee::find($id);
            $employee->update($request->all());

            return redirect(route("employee.index"))->with('success', 'Updated Successfully');
        }
    }

    public function newhire()
    {
        abort_unless(Gate::allows('hr_access'), 404);
        $lists = NewHire::with('employee')->get();

        return view('pages.hr.employee.newhire.index', compact('lists'));
    }

    public function newhireadd()
    {
        abort_unless(Gate::allows('hr_access'), 404);
        $lists = Employee::get();

        return view('pages.hr.employee.newhire.add.index', compact('lists'));
    }

    public function resignation()
    {
        abort_unless(Gate::allows('hr_access'), 404);
        $lists = Employee::get();

        return view('pages.hr.employee.resignation.index', compact('lists'));
    }

    public function resigadd(Request $request)
    {
        abort_unless(Gate::allows('hr_access'), 404);
        $employees = Employee::get();
        
        $resig = new Resignation();
        $resig->employee_name = $request->employee_name;

        return view('pages.hr.employee.resignation.add.index', compact('resig','employees'));
    }

    public function resigstore()
    {
        abort_unless(Gate::allows('hr_access'), 404);
        $lists = Employee::get();

        return redirect(route("employee.index"))->with('success', 'Created Successfully');
    }

    public function empPayroll(Request $request)
    {
        return view('pages.hr.payroll.index');
    }

    public function payrollAdd(Request $request)
    {
        abort_unless(Gate::allows('hr_access'), 404);

        return view('pages.hr.payroll.add.index');
        
    }

    public function payrollPrint(Request $request)
    {
        abort_unless(Gate::allows('hr_access'), 404);

        return view('pages.hr.payroll.print.index');
    }

}
