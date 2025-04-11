<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\EmployeeSalary;

class LeaveCredit extends Model
{
    protected $fillable = [
        'employee_id',
        'leave_type',
        'total_credits',
        'used_credits',
        'remaining_credits',
        'effective_date'
    ];

    protected $casts = [
        'effective_date' => 'date',
        'total_credits' => 'integer',
        'used_credits' => 'integer',
        'remaining_credits' => 'integer'
    ];

    public function employee()
    {
        return $this->belongsTo(User::class, 'employee_id', 'id');
    }

    public static function getDefaultCredits()
    {
        return [
            'sick' => 10,
            'vacation' => 15,
            'maternity' => 60,
            'paternity' => 7,
            'service_incentive' => 10
        ];
    }

    public static function createDefaultCredits(User $employee)
    {
        $defaultCredits = self::getDefaultCredits();
        
        foreach ($defaultCredits as $type => $credits) {
            self::create([
                'employee_id' => $employee->id,
                'leave_type' => $type,
                'total_credits' => $credits,
                'remaining_credits' => $credits,
                'effective_date' => now()
            ]);
        }
    }

    public function updateSIL($daysTaken)
    {
        if ($this->leave_type === 'service_incentive' && $this->remaining_credits >= $daysTaken) {
            $this->remaining_credits -= $daysTaken;
            $this->used_credits += $daysTaken;
            $this->save();
            return true;
        }
        return false;
    }

    public function calculateSILValue($currentSalary = null)
    {
        if ($this->leave_type === 'service_incentive') {
            $salary = $currentSalary ?? EmployeeSalary::getCurrentSalary($this->employee_id);
            return $salary ? $salary->daily_rate * $this->remaining_credits : 0;
        }
        return 0;
    }
}
