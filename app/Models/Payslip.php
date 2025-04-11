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
        'notes'
    ];

    protected $casts = [
        'pay_period_start' => 'date',
        'pay_period_end' => 'date',
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
        'net_pay' => 'decimal:2'
    ];

    // Fixed deduction rates
    const SS_RATE = 0.045; // 4.5%
    const PHILHEALTH_RATE = 0.50; // 50%
    const PAGIBIG_RATE = 0.50; // 50%
    const TAX_RATE = 0.10; // 10%
    const WORKING_HOURS_PER_DAY = 8;
    const OVERTIME_RATE = 150; // PHP per hour

    public function employee()
    {
        return $this->belongsTo(User::class, 'employee_id', 'id');
    }

    public function calculateWorkingHours($startDate, $endDate)
    {
        $totalHours = 0;
        
        // Get all attendance records within the period
        $attendances = Attendance::where('employee_id', $this->employee_id)
            ->whereBetween('attendance_date', [$startDate, $endDate])
            ->get();

        foreach ($attendances as $attendance) {
            $totalHours += $attendance->working_hours;
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
        $totalEarnings = $this->calculateTotalEarnings();

        $this->sss_contribution = $totalEarnings * self::SS_RATE;
        $this->philhealth_contribution = $totalEarnings * self::PHILHEALTH_RATE;
        $this->pagibig_contribution = $totalEarnings * self::PAGIBIG_RATE;
        $this->tax_deduction = $totalEarnings * self::TAX_RATE;

        // Additional deductions like cash advance can be added here
        $this->other_deductions = 0; // Initialize to 0

        // Save the individual deductions to the database
        $this->save();
    }

    public function calculateTotalDeductions()
    {
        return $this->sss_contribution + $this->philhealth_contribution + 
               $this->pagibig_contribution + $this->tax_deduction + 
               $this->cash_advance + $this->other_deductions;
    }

    public function calculateNetPay()
    {
        $totalEarnings = $this->calculateTotalEarnings();
        $totalDeductions = $this->calculateTotalDeductions();

        return $totalEarnings - $totalDeductions;
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
