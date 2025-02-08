<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Loan extends Model
{
    use HasFactory;

    protected $fillable = [
        'loan_type',
        'transaction_type',//ltranh_type
        'trans_no',
        'date_of_loan',//ltranh_date
        'customer_id',//ltranh_cus_id
        'customer_type',
        'status',//ltranh_stat
        'transaction_customer_status',//ltranh_cus_stat
        'transaction_customer_status_date',//ltranh_cus_stat_dt
        'transaction_with_collateral',//ltranh_wcolat
        'transaction_with_cert',//ltranh_wcert
        'principal_amount',//ltranh_amt
        'days_to_pay',//ltranh_terms_day
        'months_to_pay',//ltranh_terms_mon
        'interest',//ltranh_intrate
        'interest_amount',//
        'svc_charge',
        'actual_record',
        'payable_amount',//ltranh_actrcvd
        'user_id',//ltranh_uid
        'branch_id',
        'file',
        'note',
    ];

    public function customer()
    {
        return $this->belongsTo(Customer::class, 'customer_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function details()
    {
        return $this->hasMany(LoanDetails::class, 'loan_id');
    }

    public function latestDue()
    {
        return $this->hasOne(LoanDetails::class, 'loan_id')->latest();
    }

    public function startDue()
    {
        return $this->hasOne(LoanDetails::class, 'loan_id');
    }
}
