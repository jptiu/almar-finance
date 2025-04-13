<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Services\LeaveCreditService;
use App\Models\LeaveCredit;
use App\Models\ServiceIncentiveLog;

class Leave extends Model
{
    protected $fillable = [
        'employee_id',
        'leave_type',
        'start_date',
        'end_date',
        'days_requested',
        'reason',
        'status',
        'remarks',
        'approved_by'
    ];

    protected $casts = [
        'start_date' => 'date',
        'end_date' => 'date',
        'days_requested' => 'integer'
    ];

    public function employee()
    {
        return $this->belongsTo(User::class, 'employee_id', 'id');
    }

    public function approvedBy()
    {
        return $this->belongsTo(User::class, 'approved_by','id');
    }

    public function hasSufficientCredits()
    {
        $service = app(LeaveCreditService::class);
        return $service->hasSufficientCredits($this);
    }

    public function updateCredits()
    {
        $service = app(LeaveCreditService::class);
        $service->updateLeaveCredits($this);
    }

    public function getStatusColorAttribute()
    {
        return match($this->status) {
            'pending' => 'gray',
            'approved' => 'green',
            'rejected' => 'red',
            default => 'secondary'
        };
    }

    public function isSIL()
    {
        return $this->leave_type === 'service_incentive';
    }

    public function processSIL()
    {
        if ($this->isSIL()) {
            $credit = LeaveCredit::where('employee_id', $this->employee_id)
                ->where('leave_type', 'service_incentive')
                ->first();
            
            if ($credit && $credit->remaining_credits >= $this->days_requested) {
                $credit->updateSIL($this->days_requested);
                $this->status = 'approved';
                $this->save();
                
                // Create service incentive log
                ServiceIncentiveLog::create([
                    'employee_id' => $this->employee_id,
                    'date_taken' => $this->start_date,
                    'days_taken' => $this->days_requested,
                    'amount_paid' => $credit->calculateSILValue()
                ]);
            }
        }
    }
}
