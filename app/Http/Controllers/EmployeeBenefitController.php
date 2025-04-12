<?php

namespace App\Http\Controllers;

use App\Models\EmployeeBenefit;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class EmployeeBenefitController extends Controller
{
    public function index()
    {
        abort_unless(Gate::allows('hr_access') || Gate::allows('admin_access') || Gate::allows('super_access'), 403);
        
        $benefits = EmployeeBenefit::with(['employee'])
            ->orderBy('effective_date', 'desc')
            ->paginate(20);

        return view('pages.hr.benefits.index', compact('benefits'));
    }

    public function create()
    {
        abort_unless(Gate::allows('hr_access') || Gate::allows('admin_access') || Gate::allows('super_access'), 403);
        
        $employees = User::whereHas('roles')->get();

        return view('pages.hr.benefits.create', compact('employees'));
    }

    public function store(Request $request)
    {
        abort_unless(Gate::allows('hr_access') || Gate::allows('admin_access') || Gate::allows('super_access'), 403);

        $validated = $request->validate([
            'employee_id' => 'required|exists:users,id',
            'benefit_type' => 'required|string',
            'amount' => 'nullable|numeric|min:0',
            'effective_date' => 'required|date',
            'expiration_date' => 'nullable|date|after:effective_date',
            'description' => 'required|string',
            'status' => 'required|in:active,expired,cancelled'
        ]);

        EmployeeBenefit::create($validated);

        return redirect()->route('benefits.index')
            ->with('success', 'Employee benefit created successfully');
    }

    public function update(Request $request, EmployeeBenefit $benefit)
    {
        abort_unless(Gate::allows('hr_access') || Gate::allows('admin_access') || Gate::allows('super_access'), 403);

        $validated = $request->validate([
            'amount' => 'nullable|numeric|min:0',
            'expiration_date' => 'nullable|date|after:effective_date',
            'description' => 'required|string',
            'status' => 'required|in:active,expired,cancelled'
        ]);

        $benefit->update($validated);

        return redirect()->route('benefits.index')
            ->with('success', 'Employee benefit updated successfully');
    }

    public function employeeBenefits(User $employee)
    {
        abort_unless(Gate::allows('hr_access') || Gate::allows('admin_access') || Gate::allows('super_access'), 403);

        $benefits = EmployeeBenefit::where('employee_id', $employee->id)
            ->orderBy('effective_date', 'desc')
            ->paginate(20);

        return view('pages.hr.benefits.employee', compact('employee', 'benefits'));
    }

    public function printBenefit(EmployeeBenefit $benefit)
    {
        abort_unless(Gate::allows('hr_access') || Gate::allows('admin_access') || Gate::allows('super_access'), 403);
        
        return view('pages.hr.benefits.print', compact('benefit'));
    }
}
