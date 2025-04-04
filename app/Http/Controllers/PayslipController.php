<?php

namespace App\Http\Controllers;

use App\Models\Payslip;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class PayslipController extends Controller
{
    public function index()
    {
        abort_unless(Gate::allows('hr_access') || Gate::allows('admin_access'), 403);
        
        $payslips = Payslip::with('employee')
            ->orderBy('pay_period_start', 'desc')
            ->paginate(20);

        return view('pages.hr.payslips.index', compact('payslips'));
    }

    public function create()
    {
        abort_unless(Gate::allows('hr_access') || Gate::allows('admin_access'), 403);
        
        $employees = User::whereHas('roles')->get();

        return view('pages.hr.payslips.create', compact('employees'));
    }

    public function store(Request $request)
    {
        abort_unless(Gate::allows('hr_access') || Gate::allows('admin_access'), 403);

        $validated = $request->validate([
            'employee_id' => 'required|exists:users,id',
            'pay_period_start' => 'required|date',
            'pay_period_end' => 'required|date|after:pay_period_start',
            'basic_salary' => 'required|numeric|min:0',
            'total_hours' => 'required|numeric|min:0',
            'overtime_hours' => 'nullable|numeric|min:0',
            'overtime_pay' => 'nullable|numeric|min:0',
            'allowances' => 'nullable|numeric|min:0',
            'deductions' => 'nullable|numeric|min:0',
            'notes' => 'nullable|string'
        ]);

        $validated['net_pay'] = $validated['basic_salary'] + 
            $validated['overtime_pay'] + 
            $validated['allowances'] - 
            $validated['deductions'];

        Payslip::create($validated);

        return redirect()->route('payslips.index')
            ->with('success', 'Payslip created successfully');
    }

    public function show(Payslip $payslip)
    {
        abort_unless(Gate::allows('hr_access') || Gate::allows('admin_access'), 403);
        
        return view('pages.hr.payslips.show', compact('payslip'));
    }

    public function employeePayslips(User $employee)
    {
        abort_unless(Gate::allows('hr_access') || Gate::allows('admin_access'), 403);

        $payslips = Payslip::where('employee_id', $employee->id)
            ->orderBy('pay_period_start', 'desc')
            ->paginate(20);

        return view('pages.hr.payslips.employee', compact('employee', 'payslips'));
    }

    public function printPayslip(Payslip $payslip)
    {
        abort_unless(Gate::allows('hr_access') || Gate::allows('admin_access'), 403);
        
        return view('pages.hr.payslips.print', compact('payslip'));
    }
}
