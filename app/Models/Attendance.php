<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Attendance extends Model
{
    protected $fillable = [
        'employee_id',
        'attendance_date',
        'clock_in',
        'clock_out',
        'status',
        'remarks'
    ];

    protected $casts = [
        'attendance_date' => 'date',
        'clock_in' => 'string',
        'clock_out' => 'string'
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
        return round((($end - $start) / 3600), 2);
    }

    public function getClockInFormattedAttribute()
    {
        return $this->clock_in ? date('H:i', strtotime($this->clock_in)) : '-';
    }

    public function getClockOutFormattedAttribute()
    {
        return $this->clock_out ? date('H:i', strtotime($this->clock_out)) : '-';
    }
}
