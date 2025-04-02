<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

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
        'deductions',
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
        'deductions' => 'decimal:2',
        'net_pay' => 'decimal:2'
    ];

    public function employee()
    {
        return $this->belongsTo(User::class, 'employee_id', 'id');
    }

    public function calculateNetPay()
    {
        return $this->basic_salary + $this->overtime_pay + $this->allowances - $this->deductions;
    }
}
