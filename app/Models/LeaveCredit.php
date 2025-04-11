<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

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
            'paternity' => 7
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
}
