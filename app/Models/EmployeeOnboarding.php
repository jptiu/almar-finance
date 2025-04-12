<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmployeeOnboarding extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'probation_start_date',
        'probation_end_date',
        'regularization_date',
        'probation_evaluation',
        'regularization_notes',
        'probation_status',
        'is_regularized',
        'probation_duration',
        'performance_metrics',
        'training_requirements'
    ];

    protected $casts = [
        'probation_start_date' => 'date',
        'probation_end_date' => 'date',
        'regularization_date' => 'date',
        'is_regularized' => 'boolean'
    ];

    const PROBATION_STATUS_PENDING = 'pending';
    const PROBATION_STATUS_COMPLETED = 'completed';
    const PROBATION_STATUS_EXTENDED = 'extended';
    const PROBATION_STATUS_FAILED = 'failed';

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function isProbationPeriod()
    {
        return !$this->is_regularized && $this->probation_status !== self::PROBATION_STATUS_FAILED;
    }

    public function isProbationExtended()
    {
        return $this->probation_status === self::PROBATION_STATUS_EXTENDED;
    }

    public function isProbationFailed()
    {
        return $this->probation_status === self::PROBATION_STATUS_FAILED;
    }

    public function isRegularized()
    {
        return $this->is_regularized;
    }

    public function extendProbation($endDate)
    {
        $this->probation_end_date = $endDate;
        $this->probation_status = self::PROBATION_STATUS_EXTENDED;
        return $this->save();
    }

    public function failProbation($notes = null)
    {
        $this->probation_status = self::PROBATION_STATUS_FAILED;
        $this->probation_evaluation = $notes;
        return $this->save();
    }

    public function completeProbation($notes = null)
    {
        $this->probation_status = self::PROBATION_STATUS_COMPLETED;
        $this->probation_evaluation = $notes;
        return $this->save();
    }

    public function regularize($notes = null)
    {
        $this->is_regularized = true;
        $this->regularization_date = now();
        $this->regularization_notes = $notes;
        return $this->save();
    }

    public function isProbationCompleted()
    {
        return $this->probation_status === self::PROBATION_STATUS_COMPLETED;
    }

    public function calculateProbationDuration()
    {
        if ($this->probation_start_date && $this->probation_end_date) {
            return $this->probation_end_date->diffInDays($this->probation_start_date);
        }
        return 0;
    }
}
