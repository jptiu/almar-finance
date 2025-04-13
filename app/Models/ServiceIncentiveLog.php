<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ServiceIncentiveLog extends Model
{
    protected $fillable = [
        'employee_id',
        'date_taken',
        'days_taken',
        'amount_paid'
    ];

    protected $casts = [
        'date_taken' => 'date',
        'days_taken' => 'integer',
        'amount_paid' => 'decimal:2'
    ];

    public function employee()
    {
        return $this->belongsTo(User::class, 'employee_id');
    }
}
