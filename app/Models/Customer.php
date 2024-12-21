<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;

    protected $fillable = [
        'type',
        'first_name',
        'middle_name',
        'last_name',
        'house',
        'street',
        'barangay',
        'city',
        'job_position',
        'salary_sched',
        'tel_number',
        'cell_number',
        'civil_status',
        'status',
        'birth_date',
        'birth_place',
        'age',
        'gender',
        'citizenship',
        'facebook_name',
        'spouse_name',
        'spouse_number',
        'spouse_age',
        'spouse_bdate',
        'spouse_fb',
        'occupation',
        'c_nameadd',
        'agency_name',
        'add_tel',
        'add_telc',
        'comp_name',
        'date_hired',
        'day_off',
        'monthly_salary',
        'salary_sched',
        'monthly_pension',
        'pension_sched',
        'pension_type',
        'fathers_name',
        'fathers_num',
        'mothers_name',
        'mothers_num',
        'branch',
        'card_no',
        'acc_no',
        'pin_no',
        'branch_id',
        'email',
    ];

    protected $appends = ['barangay_name', 'city_town'];

    public function getBarangayNameAttribute()
    {
        return $this->bry ? $this->bry->barangay_name : null; // Replace 'name' with the actual column in Barangay model
    }

    public function getCityTownAttribute()
    {
        return $this->cty ? $this->cty->city_town : null; // Replace 'name' with the actual column in City model
    }

    public function loan()
    {
        return $this->hasOne(Loan::class, 'customer_id')->latestOfMany();
    }

    public function loans()
    {
        return $this->hasMany(Loan::class, 'customer_id');
    }

    public function bry()
    {
        return $this->belongsTo(Barangay::class, 'barangay', 'id');
    }

    public function cty()
    {
        return $this->belongsTo(CityTown::class, 'city', 'id');
    }

    public function customerType()
    {
        return $this->belongsTo(CustomerType::class, 'type', 'code');
    }

    public function deposits()
    {
        return $this->hasMany(SavingsDeposit::class, 'customer_id');
    }

    public function withdraws()
    {
        return $this->hasMany(SavingsWithdrawal::class, 'customer_id');
    }

    public function collections()
    {
        return $this->hasMany(Collection::class, 'customer_id');
    }
}
