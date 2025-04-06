<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use App\Traits\HasAttendanceStatus;

class DailyTimeRecord extends Model
{
    use HasAttendanceStatus;
    protected $fillable = [
        'employee_id',
        'attendance_date',
        'clock_in',
        'clock_out',
        'working_hours',
        'late_minutes',
        'undertime_minutes',
        'status',
        'deductions',
        'net_amount',
        'is_sunday',
        'is_branch_meeting'
    ];

    protected $dates = [
        'attendance_date',
        'clock_in',
        'clock_out'
    ];

    protected $casts = [
        'is_sunday' => 'boolean',
        'is_branch_meeting' => 'boolean',
        'attendance_date' => 'date',
        'clock_in' => 'datetime',
        'clock_out' => 'datetime'
    ];

    public function employee()
    {
        return $this->belongsTo(User::class, 'employee_id', 'id');
    }

    public function getClockInFormattedAttribute()
    {
        return $this->clock_in ? $this->clock_in->format('h:i A') : '-';
    }

    public function getClockOutFormattedAttribute()
    {
        return $this->clock_out ? $this->clock_out->format('h:i A') : '-';
    }

    public function calculateNetAmount()
    {
        // Get the employee's active salary record
        $salary = $this->employee->salaries()
            ->where('status', 'active')
            ->where('effective_date', '<=', $this->attendance_date)
            ->orderBy('effective_date', 'desc')
            ->first();

        if (!$salary) {
            return 0;
        }

        $dailyRate = $salary->daily_rate;
        $deductions = $this->calculateDeductions($dailyRate);
        $this->deductions = $deductions;
        
        // Calculate net amount (daily rate minus deductions)
        $netAmount = $dailyRate - $deductions;
        
        // Don't allow negative net amount
        $this->net_amount = max(0, $netAmount);
        
        return $this->net_amount;
    }

    protected function calculateDeductions($dailyRate)
    {
        $deductions = 0;
        $hourlyRate = $dailyRate / 8; // Assuming 8-hour workday
        $minuteRate = $hourlyRate / 60;

        // Late deductions
        if ($this->late_minutes > 0) {
            $deductions += $this->late_minutes * $minuteRate;
        }

        // Undertime deductions
        if ($this->undertime_minutes > 0) {
            $deductions += $this->undertime_minutes * $minuteRate;
        }

        return $deductions;
    }
}
