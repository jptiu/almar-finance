<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rebate extends Model
{
    use HasFactory;

    protected $fillable = [
        'loan_id',
        'rebate_amount',
        'rebate_percent',
        'mode_of_payment',
        'status',
        'branch_id'
    ];
}
