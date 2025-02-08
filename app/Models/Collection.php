<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Collection extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'name',
        'type',
        'status',
        'trans_no',
        'date',
        'branch_id',
        'customer_id',
        'paid_amount',
        'lat',
        'long',
        'loan_details_id',
    ];

    public function user(){
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function customer()
    {
        return $this->belongsTo(Customer::class, 'customer_id');
    }

    public function loanDetails()
    {
        return $this->belongsTo(LoanDetails::class, 'loan_details_id');
    }

    public function loan()
    {
        return $this->belongsTo(Loan::class, 'trans_no', 'id');
    }
    
}
