<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Models\Loan;
use App\Models\User;

class EditRequest extends Model
{
    protected $fillable = [
        'loan_id',
        'user_id',
        'requested_date',
        'requested_time',
        'reason',
        'status',
        'processed_at',
        'declined_reason'
    ];

    protected $casts = [
        'processed_at' => 'datetime',
        'requested_date' => 'date',
        // 'requested_time' => 'time'
    ];

    public function loan(): BelongsTo
    {
        return $this->belongsTo(Loan::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
