<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Attendance;
use App\Models\OvertimeRequest;
use App\Models\EmployeeSalary;

class Payslip extends Model
{
    protected $fillable = [
        'employee_id',
        'pay_period_start',
        'pay_period_end',
        'basic_salary',
        'total_hours',
        'overtime_hours',
        'overtime_pay',
        'allowances',
        'sss_contribution',
        'philhealth_contribution',
        'pagibig_contribution',
        'tax_deduction',
        'cash_advance',
        'other_deductions',
        'net_pay',
        'status',
        'notes',
        'thirteenth_month_pay',
        'sil_value',
        'remaining_sil_days'
    ];

    protected $casts = [
        'pay_period_start' => 'datetime',
        'pay_period_end' => 'datetime',
        'basic_salary' => 'decimal:2',
        'total_hours' => 'decimal:2',
        'overtime_hours' => 'decimal:2',
        'overtime_pay' => 'decimal:2',
        'allowances' => 'decimal:2',
        'sss_contribution' => 'decimal:2',
        'philhealth_contribution' => 'decimal:2',
        'pagibig_contribution' => 'decimal:2',
        'tax_deduction' => 'decimal:2',
        'cash_advance' => 'decimal:2',
        'other_deductions' => 'decimal:2',
        'net_pay' => 'decimal:2',
        'thirteenth_month_pay' => 'decimal:2',
        'sil_value' => 'decimal:2'
    ];

    // Fixed deduction rates based on client's requirements
    const SS_RATE_EMPLOYEE = 0.045; // 4.5% of basic salary (employee portion)
    const SS_RATE_EMPLOYER = 0.095; // 9.5% of basic salary (employer portion)
    const PHILHEALTH_RATE_EMPLOYEE = 0.01; // 1% of basic salary (employee portion)
    const PHILHEALTH_RATE_EMPLOYER = 0.01; // 1% of basic salary (employer portion)
    const PAGIBIG_RATE_EMPLOYEE = 0.01; // 1% of basic salary (employee portion)
    const PAGIBIG_RATE_EMPLOYER = 0.01; // 1% of basic salary (employer portion)
    const TAX_RATE = 0.10; // 10% of basic salary
    const WORKING_HOURS_PER_DAY = 8;

    public function employee()
    {
        return $this->belongsTo(User::class);
    }

    public function calculateWorkingHours($startDate, $endDate)
    {
        $totalHours = 0;
        
        // Get all attendance records within the period
        $attendances = Attendance::where('employee_id', $this->employee_id)
            ->whereBetween('attendance_date', [$startDate, $endDate])
            ->get();

        foreach ($attendances as $attendance) {
            $totalHours += $attendance->total_hours;
        }

        return $totalHours;
    }

    public function calculateOvertimeHours($startDate, $endDate)
    {
        $totalOvertime = 0;
        
        // Get approved overtime requests within the period
        $overtimes = OvertimeRequest::where('employee_id', $this->employee_id)
            ->whereBetween('date', [$startDate, $endDate])
            ->where('status', 'approved')
            ->get();

        foreach ($overtimes as $overtime) {
            $totalOvertime += $overtime->hours_requested;
        }

        return $totalOvertime;
    }

    public function calculateOvertimePay($overtimeHours)
    {
        // Get the employee's current salary record
        $currentSalary = EmployeeSalary::getCurrentSalary($this->employee_id);
        
        // If no overtime rate is set, calculate it as 1.25x of hourly rate
        $hourlyRate = $currentSalary->daily_rate / self::WORKING_HOURS_PER_DAY;
        $overtimeRate = $currentSalary->overtime_rate ?? ($hourlyRate * 1.25);

        return $overtimeHours * $overtimeRate;
    }

    public function calculateTotalEarnings()
    {
        // Use the stored basic salary and overtime pay
        $totalEarnings = $this->basic_salary + $this->overtime_pay;

        // Add allowances if any
        if ($this->allowances) {
            $totalEarnings += $this->allowances;
        }

        return $totalEarnings;
    }

    public function calculateDeductions()
    {
        // Calculate deductions based on basic salary only
        $basicSalary = $this->basic_salary;

        // Employee contributions
        $this->sss_contribution = $basicSalary * self::SS_RATE_EMPLOYEE;
        $this->philhealth_contribution = $basicSalary * self::PHILHEALTH_RATE_EMPLOYEE;
        $this->pagibig_contribution = $basicSalary * self::PAGIBIG_RATE_EMPLOYEE;
        $this->tax_deduction = $basicSalary * self::TAX_RATE;

        // Additional deductions like cash advance can be added here
        $this->other_deductions = 0; // Initialize to 0

        // Save the individual deductions to the database
        $this->save();
    }

    public function calculateEmployerContributions()
    {
        // Calculate employer contributions based on basic salary
        $basicSalary = $this->basic_salary;

        $employerContributions = [
            'sss' => $basicSalary * self::SS_RATE_EMPLOYER,
            'philhealth' => $basicSalary * self::PHILHEALTH_RATE_EMPLOYER,
            'pagibig' => $basicSalary * self::PAGIBIG_RATE_EMPLOYER
        ];

        return $employerContributions;
    }

    public function calculateTotalDeductions()
    {
        return $this->sss_contribution + $this->philhealth_contribution + 
               $this->pagibig_contribution + $this->tax_deduction + 
               $this->cash_advance + $this->other_deductions;
    }

    public function calculateThirteenthMonthPay()
    {
        // Calculate 13th month pay only for December payslips
        $month = $this->pay_period_start->format('m');
        if ($month !== '12') {
            return 0;
        }
        
        // Calculate 1/13 of annual basic salary
        $annualSalary = $this->employee->salaries()
            ->where('status', 'active')
            ->latest('effective_date')
            ->first()
            ->basic_salary * 12;
            
        return $annualSalary / 13;
    }

    public function calculateSilValue()
    {
        // Calculate SIL value only for December payslips
        $month = $this->pay_period_start->format('m');
        if ($month !== '12') {
            return 0;
        }

        // Get SIL credit for this employee
        $silCredit = $this->employee->leaveCredits()
            ->where('leave_type', 'service_incentive')
            ->first();
            
        if (!$silCredit) {
            return 0;
        }
        
        // Calculate SIL value based on remaining days
        return $silCredit->calculateSILValue();
    }

    public function calculateRemainingSilDays()
    {
        // Get SIL credit for this employee
        $silCredit = $this->employee->leaveCredits()
            ->where('leave_type', 'service_incentive')
            ->first();
            
        return $silCredit ? $silCredit->remaining_credits : 0;
    }

    public function calculateNetPay()
    {
        // Get base net pay (total earnings minus deductions)
        $baseNetPay = $this->calculateTotalEarnings() - $this->calculateTotalDeductions();
        
        // Add 13th month pay if applicable (only in December)
        $thirteenthMonthPay = $this->calculateThirteenthMonthPay();
        
        // Add SIL value if applicable (only in December)
        $silValue = $this->calculateSilValue();
        
        // Ensure net pay is not negative
        $totalNetPay = $baseNetPay + $thirteenthMonthPay + $silValue;
        return max(0, $totalNetPay); // Ensure net pay is not negative
    }

    public function save(array $options = [])
    {
        // Calculate and set 13th month pay
        $this->thirteenth_month_pay = $this->calculateThirteenthMonthPay();
        
        // Calculate and set SIL value and remaining days
        $this->sil_value = $this->calculateSilValue();
        $this->remaining_sil_days = $this->calculateRemainingSilDays();
        
        return parent::save($options);
    }

    public function getPayPeriodAttribute()
    {
        return $this->pay_period_start->format('F d, Y') . ' - ' . $this->pay_period_end->format('F d, Y');
    }

    public function getStatusColorAttribute()
    {
        switch ($this->status) {
            case 'pending':
                return 'bg-yellow-200 text-yellow-800';
            case 'processed':
                return 'bg-green-200 text-green-800';
            case 'paid':
                return 'bg-blue-200 text-blue-800';
            default:
                return 'bg-gray-200 text-gray-800';
        }
    }

    public function scopePending($query)
    {
        return $query->where('status', 'pending');
    }

    public function scopeProcessed($query)
    {
        return $query->where('status', 'processed');
    }

    public function scopePaid($query)
    {
        return $query->where('status', 'paid');
    }

    public function scopeForPeriod($query, $start, $end)
    {
        return $query->whereBetween('pay_period_start', [$start, $end]);
    }
}
