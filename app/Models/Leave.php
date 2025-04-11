<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Services\LeaveCreditService;

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
}
