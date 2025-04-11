<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EmployeeSalary extends Model
{
    protected $fillable = [
        'employee_id',
        'basic_salary',
        'daily_rate',
        'overtime_rate',
        'effective_date',
        'status',
        'notes'
    ];

    protected $casts = [
        'basic_salary' => 'decimal:2',
        'daily_rate' => 'decimal:2',
        'overtime_rate' => 'decimal:2',
        'effective_date' => 'date'
    ];

    public function employee()
    {
        return $this->belongsTo(User::class, 'employee_id');
    }

    // Get the current active salary for an employee
    public static function getCurrentSalary($employeeId)
    {
        return static::where('employee_id', $employeeId)
            ->where('status', 'active')
            ->latest('effective_date')
            ->first();
    }
}
