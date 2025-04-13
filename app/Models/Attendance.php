<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Traits\HasAttendanceStatus;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;

class Attendance extends Model
{
    use HasAttendanceStatus;
    const STANDARD_START_TIME = '08:00';
    const STANDARD_END_TIME = '17:00';
    const LUNCH_BREAK_HOURS = 1;
    const WORKING_HOURS_PER_DAY = 8;
    protected $fillable = [
        'employee_id',
        'attendance_date',
        'clock_in',
        'clock_out',
        'status',
        'remarks',
        'is_sunday',
        'is_branch_meeting',
        'late_minutes',
        'undertime_minutes',
        'daily_rate'
    ];

    protected $casts = [
        'attendance_date' => 'date',
        'clock_in' => 'string',
        'clock_out' => 'string',
        'is_sunday' => 'boolean',
        'is_branch_meeting' => 'boolean',
        'late_minutes' => 'integer',
        'undertime_minutes' => 'integer',
        'daily_rate' => 'decimal:2'
    ];

    public function employee()
    {
        return $this->belongsTo(User::class, 'employee_id', 'id');
    }

    public function getWorkingHoursAttribute()
    {
        if (!$this->clock_in || !$this->clock_out) {
            return 0;
        }
        
        // Convert time strings to timestamps
        $start = strtotime($this->clock_in);
        $end = strtotime($this->clock_out);
        $totalHours = ($end - $start) / 3600;
        
        // Subtract lunch break if worked more than 5 hours
        if ($totalHours > 5) {
            $totalHours -= self::LUNCH_BREAK_HOURS;
        }
        
        return round($totalHours, 2);
    }

    public function getClockInFormattedAttribute()
    {
        return $this->clock_in ? date('H:i', strtotime($this->clock_in)) : '-';
    }

    public function getClockOutFormattedAttribute()
    {
        return $this->clock_out ? date('H:i', strtotime($this->clock_out)) : '-';
    }

    protected static function booted()
    {
        static::saving(function ($attendance) {
            $attendance->calculateLateAndUndertime();
        });
    }

    protected function calculateLateAndUndertime()
    {
        if (!$this->clock_in || !$this->clock_out) {
            return;
        }

        // Skip calculations for Sundays and branch meetings
        if ($this->is_sunday || $this->is_branch_meeting) {
            $this->late_minutes = 0;
            $this->undertime_minutes = 0;
            return;
        }

        try {
            // Create base date
            $date = new \DateTime($this->attendance_date);
            
            // Calculate late minutes using Manila timezone
            $standardStart = \DateTime::createFromFormat('Y-m-d H:i:s', 
                $date->format('Y-m-d') . ' ' . self::STANDARD_START_TIME);
            
            if (!$standardStart) {
                throw new \Exception('Invalid standard start time format');
            }
            
            $standardStart->setTimezone(new \DateTimeZone('Asia/Manila'));
            
            $actualStart = \DateTime::createFromFormat('Y-m-d H:i:s', 
                $date->format('Y-m-d') . ' ' . $this->clock_in);
            
            if (!$actualStart) {
                throw new \Exception('Invalid clock in time format');
            }
            
            $actualStart->setTimezone(new \DateTimeZone('Asia/Manila'));
            
            $this->late_minutes = max(0, $actualStart->diff($standardStart)->i);

            // Calculate undertime minutes using Manila timezone
            $standardEnd = \DateTime::createFromFormat('Y-m-d H:i:s', 
                $date->format('Y-m-d') . ' ' . self::STANDARD_END_TIME);
            
            if (!$standardEnd) {
                throw new \Exception('Invalid standard end time format');
            }
            
            $standardEnd->setTimezone(new \DateTimeZone('Asia/Manila'));
            
            $actualEnd = \DateTime::createFromFormat('Y-m-d H:i:s', 
                $date->format('Y-m-d') . ' ' . $this->clock_out);
            
            if (!$actualEnd) {
                throw new \Exception('Invalid clock out time format');
            }
            
            $actualEnd->setTimezone(new \DateTimeZone('Asia/Manila'));
            
            $this->undertime_minutes = max(0, $standardEnd->diff($actualEnd)->i);
        } catch (\Exception $e) {
            // Log the error and set default values
            Log::error('Attendance time calculation error: ' . $e->getMessage());
            $this->late_minutes = 0;
            $this->undertime_minutes = 0;
        }
    }

    public function getDeductionsAttribute()
    {
        if ($this->is_sunday || $this->is_branch_meeting) {
            return 0;
        }

        $hourlyRate = $this->daily_rate / self::WORKING_HOURS_PER_DAY;
        $minuteRate = $hourlyRate / 60;

        return round(
            ($this->late_minutes + $this->undertime_minutes) * $minuteRate,
            2
        );
    }

    public function getNetAmountAttribute()
    {
        return round($this->daily_rate - $this->deductions, 2);
    }
}
