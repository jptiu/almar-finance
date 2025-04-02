<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EmployeeBenefit extends Model
{
    protected $fillable = [
        'employee_id',
        'benefit_type',
        'amount',
        'effective_date',
        'expiration_date',
        'description',
        'status'
    ];

    protected $casts = [
        'effective_date' => 'date',
        'expiration_date' => 'date',
        'amount' => 'decimal:2'
    ];

    public function employee()
    {
        return $this->belongsTo(User::class, 'employee_id', 'id');
    }

    public function isExpired()
    {
        return $this->status === 'expired' || ($this->expiration_date && $this->expiration_date->isPast());
    }
}
