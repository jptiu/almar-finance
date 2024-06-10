<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CityTown extends Model
{
    use HasFactory;

    protected $fillable = [
        'code',
        'city_town',
        'user_id',
    ];
}
