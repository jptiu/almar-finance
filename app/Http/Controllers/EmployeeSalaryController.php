<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\EmployeeSalary;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class EmployeeSalaryController extends Controller
{
    public function index()
    {
        abort_unless(Gate::allows('hr_access'), 403);
        
        $employees = User::with(['salaries' => function($query) {
            $query->where('status', 'active')
                  ->latest('effective_date');
        }])->get();
        
        return view('pages.hr.salaries.index', compact('employees'));
    }
    
    public function create()
    {
        abort_unless(Gate::allows('hr_access'), 403);
        
        $employees = User::orderBy('name')->get();
        return view('pages.hr.salaries.create', compact('employees'));
    }
    
    public function store(Request $request)
    {
        abort_unless(Gate::allows('hr_access'), 403);
        
        $validated = $request->validate([
            'employee_id' => 'required|exists:users,id',
            'basic_salary' => 'required|numeric|min:0',
            'daily_rate' => 'required|numeric|min:0',
            'effective_date' => 'required|date',
            'notes' => 'nullable|string'
        ]);
        
        // Deactivate previous salary records
        EmployeeSalary::where('employee_id', $validated['employee_id'])
            ->where('status', 'active')
            ->update(['status' => 'inactive']);
            
        // Create new salary record
        EmployeeSalary::create($validated + ['status' => 'active']);
        
        return redirect()->route('salaries.index')
            ->with('success', 'Employee salary updated successfully');
    }
    
    public function edit(EmployeeSalary $salary)
    {
        abort_unless(Gate::allows('hr_access'), 403);
        
        return view('pages.hr.salaries.edit', compact('salary'));
    }
    
    public function update(Request $request, EmployeeSalary $salary)
    {
        abort_unless(Gate::allows('hr_access'), 403);
        
        $validated = $request->validate([
            'basic_salary' => 'required|numeric|min:0',
            'daily_rate' => 'required|numeric|min:0',
            'effective_date' => 'required|date',
            'notes' => 'nullable|string'
        ]);
        
        $salary->update($validated);
        
        return redirect()->route('salaries.index')
            ->with('success', 'Salary record updated successfully');
    }
    
    public function history(User $employee)
    {
        abort_unless(Gate::allows('hr_access'), 403);
        
        $salaries = $employee->salaries()
            ->orderBy('effective_date', 'desc')
            ->paginate(20);
            
        return view('pages.hr.salaries.history', compact('employee', 'salaries'));
    }
}
