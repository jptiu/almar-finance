<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ComputeCashOnHand extends Model
{
    use HasFactory;

    protected $fillable = [
        'prev_transaction_date',
        'cash_beginning',
        'transaction_date',
        'collection',
        'add_cash',
        'add_cash_2',
        'loan_releases',
        'expenses',
        'new_cash_on_hand',
        'charge_swipe',
        'savings',
        'death_aid',
        'photocopy',
        'withdraw',
        'xerox',
        'penalty',
        'passbook',
        'details_withdraw',
        'details_xerox',
        'user_id',
        'branch_id',
    ];
}
