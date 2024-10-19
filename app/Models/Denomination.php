<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Denomination extends Model
{
    use HasFactory;

    protected $fillable = [
        'breakdown_id',
        'denomination',
        'type',
        'qty',
        'amount',
    ];
}
