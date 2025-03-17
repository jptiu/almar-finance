<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RenewalRequest extends Model
{
    use HasFactory;

    protected $fillable = [
        'loan_id',
        'branch_id',
        'customer_id',
        'previous_balance',
        'month',
        'status',
        'user_id',
        'approved_by',
        'approved_date',
        'requested_renewal_amount',
        'renewed_amount',
        'renewal_tenure',
        'renewal_interest_rate',
        'notes',
    ];

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function approvedBy()
    {
        return $this->belongsTo(User::class, 'approved_by');
    }
}
