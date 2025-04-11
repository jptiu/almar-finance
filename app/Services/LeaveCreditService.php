<?php

namespace App\Services;

use App\Models\Leave;
use App\Models\LeaveCredit;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class LeaveCreditService
{
    public function hasSufficientCredits(Leave $leave)
    {
        $credit = LeaveCredit::where('employee_id', $leave->employee_id)
            ->where('leave_type', $leave->leave_type)
            ->first();
        
        return $credit && ($credit->remaining_credits >= $leave->days_requested);
    }

    public function updateLeaveCredits(Leave $leave)
    {
        $credit = LeaveCredit::where('employee_id', $leave->employee_id)
            ->where('leave_type', $leave->leave_type)
            ->first();
        
        if (!$credit) {
            throw new \Exception("No leave credit record found for this employee and leave type");
        }

        DB::transaction(function () use ($leave, $credit) {
            if ($leave->status === 'approved') {
                $credit->used_credits += $leave->days_requested;
                $credit->remaining_credits -= $leave->days_requested;
            } elseif ($leave->status === 'cancelled') {
                $credit->used_credits -= $leave->days_requested;
                $credit->remaining_credits += $leave->days_requested;
            }
            
            $credit->save();
        });
    }

    public function getEmployeeLeaveCredits(User $employee)
    {
        return LeaveCredit::where('employee_id', $employee->id)
            ->get()
            ->map(function ($credit) {
                return [
                    'leave_type' => $credit->leave_type,
                    'total_credits' => $credit->total_credits,
                    'used_credits' => $credit->used_credits,
                    'remaining_credits' => $credit->remaining_credits,
                    'effective_date' => $credit->effective_date
                ];
            });
    }
}
