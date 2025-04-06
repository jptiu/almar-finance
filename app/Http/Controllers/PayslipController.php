<?php

namespace App\Http\Controllers;

use App\Models\Payslip;
use App\Models\User;
use App\Models\OvertimeRequest;
use App\Models\Attendance;
use App\Models\EmployeeSalary;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Barryvdh\DomPDF\Facade\Pdf;

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

    public function create(Request $request)
    {
        abort_unless(Gate::allows('hr_access') || Gate::allows('admin_access'), 403);
        
        $employees = User::whereHas('roles')->get();
        
        // Get approved overtime requests for the selected employee (if any)
        $employeeId = $request->query('employee_id');
        $approvedOvertime = null;
        $totalOvertimeHours = 0;
        
        if ($employeeId) {
            $startDate = $request->query('pay_period_start');
            $endDate = $request->query('pay_period_end');
            
            if ($startDate && $endDate) {
                $approvedOvertime = OvertimeRequest::where('employee_id', $employeeId)
                    ->where('status', 'approved')
                    ->whereBetween('date', [$startDate, $endDate])
                    ->get();
                
                // Calculate total overtime hours
                $totalOvertimeHours = $approvedOvertime->sum('hours_requested');
            }
            
            // Get current salary
            $currentSalary = EmployeeSalary::getCurrentSalary($employeeId);
        }

        return view('pages.hr.payslips.create', [
            'employees' => $employees,
            'approvedOvertime' => $approvedOvertime,
            'totalOvertimeHours' => $totalOvertimeHours,
            'currentSalary' => $currentSalary ?? null
        ]);
    }

    public function store(Request $request)
    {
        abort_unless(Gate::allows('hr_access') || Gate::allows('admin_access'), 403);

        $validated = $request->validate([
            'employee_id' => 'required|exists:users,id',
            'pay_period_start' => 'required|date',
            'pay_period_end' => 'required|date|after:pay_period_start',
            'basic_salary' => 'required|numeric|min:0',
            'allowances' => 'nullable|numeric|min:0',
            'notes' => 'nullable|string',
            'overtime_hours' => 'nullable|numeric|min:0',
            'overtime_pay' => 'nullable|numeric|min:0',
            'net_pay' => 'nullable|numeric|min:0'
        ]);

        try {
            // Get current salary to verify
            $currentSalary = EmployeeSalary::getCurrentSalary($validated['employee_id']);
            if (!$currentSalary || $currentSalary->basic_salary != $validated['basic_salary']) {
                throw new \Exception('Basic salary mismatch with current salary record');
            }

            // Calculate working hours and overtime hours first
            $workingHours = Attendance::where('employee_id', $validated['employee_id'])
                ->whereBetween('attendance_date', [$validated['pay_period_start'], $validated['pay_period_end']])
                ->get()
                ->sum('working_hours');

            $overtimeHours = OvertimeRequest::where('employee_id', $validated['employee_id'])
                ->where('status', 'approved')
                ->whereBetween('date', [$validated['pay_period_start'], $validated['pay_period_end']])
                ->sum('hours_requested');
                
            // Calculate expected working hours for the pay period
            $startDate = new \DateTime($validated['pay_period_start']);
            $endDate = new \DateTime($validated['pay_period_end']);
            $interval = $startDate->diff($endDate);
            $workingDays = $interval->days + 1; // Include both start and end dates
            $expectedHours = $workingDays * 8; // 8 hours per working day
            
            // Prorate basic salary based on actual hours worked
            $proratedBasicSalary = $workingHours > 0 ? 
                ($validated['basic_salary'] / $expectedHours) * $workingHours : 0;
            
            // Create payslip with all information
            $payslip = Payslip::create([
                'employee_id' => $validated['employee_id'],
                'pay_period_start' => $validated['pay_period_start'],
                'pay_period_end' => $validated['pay_period_end'],
                'basic_salary' => round($proratedBasicSalary, 2),
                'total_hours' => $workingHours,
                'overtime_hours' => $overtimeHours,
                'overtime_pay' => $overtimeHours * Payslip::OVERTIME_RATE,
                'allowances' => $validated['allowances'] ?? 0,
                'notes' => $validated['notes'] ?? null,
                'status' => 'pending'
            ]);

            // Calculate and save deductions
            $payslip->calculateDeductions();

            // Calculate and save net pay
            $payslip->net_pay = $payslip->calculateNetPay();
            $payslip->save();

            return redirect()->route('payslips.index')
                ->with('success', 'Payslip created successfully');

        } catch (\Exception $e) {
            return redirect()->back()
                ->withInput()
                ->with('error', 'Error creating payslip: ' . $e->getMessage());
        }
    }

    public function show($id)
    {
        // abort_unless(Gate::allows('hr_access') || Gate::allows('admin_access'), 403);
        $payslip = Payslip::findOrFail($id);
        return view('pages.hr.payslips.show', compact('payslip'));
    }

    public function employeePayslips(User $employee)
    {

        $payslips = Payslip::where('employee_id', $employee->id)
            ->with(['employee'])
            ->orderBy('pay_period_start', 'desc')
            ->paginate(20);

        return view('pages.hr.payslips.employee', compact('employee', 'payslips'));
    }

    public function printPayslip($id)
    {
        abort_unless(Gate::allows('hr_access') || Gate::allows('admin_access'), 403);
        $payslip = Payslip::with('employee')->findOrFail($id);
        
        return view('pages.hr.payslips.print', compact('payslip'));
    }

    public function generatePdf($id)
    {
        // abort_unless(Gate::allows('hr_access') || Gate::allows('admin_access'), 403);
        $payslip = Payslip::with('employee')->findOrFail($id);
        
        $branchLocation = $payslip->employee->branch->location ?? 'Manila, Philippines';
        
        $pdf = Pdf::loadView('pages.hr.payslips.pdf', compact('payslip', 'branchLocation'));
        
        return $pdf->download('payslip_' . $payslip->id . '.pdf');
    }

    public function getOvertimeHours(Request $request)
    {
        try {
            // Validate the request
            $validated = $request->validate([
                'employee_id' => 'required|integer|exists:users,id',
                'start_date' => 'required|date',
                'end_date' => 'required|date|after_or_equal:start_date'
            ], [
                'employee_id.exists' => 'The selected employee is invalid.',
                'start_date.required' => 'Start date is required.',
                'end_date.required' => 'End date is required.',
                'end_date.after_or_equal' => 'End date must be after or equal to start date.'
            ]);

            // Get approved overtime requests
            $approvedOvertime = OvertimeRequest::where('employee_id', $validated['employee_id'])
                ->where('status', 'approved')
                ->whereBetween('date', [$validated['start_date'], $validated['end_date']])
                ->with(['employee:id,name'])
                ->get()
                ->map(function ($ot) {
                    return [
                        'id' => $ot->id,
                        'date' => $ot->date,
                        'hours_requested' => $ot->hours_requested,
                        'status' => $ot->status,
                        'employee_name' => $ot->employee->name,
                        'created_at' => $ot->created_at,
                        'updated_at' => $ot->updated_at
                    ];
                });

            $totalHours = $approvedOvertime->sum('hours_requested');

            return response()->json([
                'success' => true,
                'total_hours' => $totalHours,
                'approved_overtime' => $approvedOvertime
            ]);

        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json([
                'success' => false,
                'error' => 'Validation error',
                'message' => $e->validator->errors()->first()
            ], 422);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'error' => 'Server error',
                'message' => $e->getMessage()
            ], 500);
        }
    }

    public function getCurrentSalary(Request $request)
    {
        try {
            $validated = $request->validate([
                'employee_id' => 'required|integer|exists:users,id'
            ]);

            $currentSalary = EmployeeSalary::getCurrentSalary($validated['employee_id']);

            return response()->json([
                'success' => true,
                'basic_salary' => $currentSalary ? $currentSalary->basic_salary : null
            ]);

        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json([
                'success' => false,
                'error' => 'Validation error',
                'message' => $e->validator->errors()->first()
            ], 422);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'error' => 'Server error',
                'message' => $e->getMessage()
            ], 500);
        }
    }

    public function getWorkingHours(Request $request)
    {
        try {
            // Validate the request
            $validated = $request->validate([
                'employee_id' => 'required|integer|exists:users,id',
                'start_date' => 'required|date',
                'end_date' => 'required|date|after_or_equal:start_date'
            ], [
                'employee_id.exists' => 'The selected employee is invalid.',
                'start_date.required' => 'Start date is required.',
                'end_date.required' => 'End date is required.',
                'end_date.after_or_equal' => 'End date must be after or equal to start date.'
            ]);

            // Calculate total working hours from attendance
            $workingHours = Attendance::where('employee_id', $validated['employee_id'])
                ->whereBetween('attendance_date', [$validated['start_date'], $validated['end_date']])
                ->get()
                ->sum('working_hours');

            return response()->json([
                'success' => true,
                'total_working_hours' => $workingHours
            ]);

        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json([
                'success' => false,
                'error' => 'Validation error',
                'message' => $e->validator->errors()->first()
            ], 422);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'error' => 'Server error',
                'message' => $e->getMessage()
            ], 500);
        }
    }
}
