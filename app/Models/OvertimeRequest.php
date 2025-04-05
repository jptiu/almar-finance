<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class OvertimeRequest extends Model
{
    protected $fillable = [
        'employee_id',
        'date',
        'hours_requested',
        'reason',
        'status',
        'approved_by',
        'approved_at',
        'notes'
    ];

    protected $casts = [
        'date' => 'date',
        'hours_requested' => 'decimal:2',
        'status' => 'string',
        'approved_at' => 'datetime'
    ];

    public function employee()
    {
        return $this->belongsTo(User::class, 'employee_id', 'id');
    }

    public function approver()
    {
        return $this->belongsTo(User::class, 'approved_by', 'id');
    }

    public function getStatusColorAttribute()
    {
        switch ($this->status) {
            case 'pending':
                return 'bg-yellow-200 text-yellow-800';
            case 'approved':
                return 'bg-green-200 text-green-800';
            case 'rejected':
                return 'bg-red-200 text-red-800';
            default:
                return 'bg-gray-200 text-gray-800';
        }
    }

    public function scopePending($query)
    {
        return $query->where('status', 'pending');
    }

    public function scopeApproved($query)
    {
        return $query->where('status', 'approved');
    }

    public function scopeRejected($query)
    {
        return $query->where('status', 'rejected');
    }
}
