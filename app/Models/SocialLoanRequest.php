<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class SocialLoanRequest extends Model
{
    protected $fillable = [
        'user_id',
        'loan_type',
        'amount_requested',
        'purpose',
        'status',
        'remarks',
        'approved_by',
        'rejected_by'
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function approvedBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'approved_by', 'id');
    }

    public function rejectedBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'rejected_by', 'id');
    }
}
