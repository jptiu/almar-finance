<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PerformanceEvaluation extends Model
{
    protected $fillable = [
        'employee_id',
        'evaluation_date',
        'evaluation_period',
        'overall_rating',
        'strengths',
        'areas_for_improvement',
        'goals',
        'manager_comments',
        'employee_comments',
        'evaluated_by'
    ];

    protected $casts = [
        'evaluation_date' => 'date',
        'overall_rating' => 'decimal:1'
    ];

    public function employee()
    {
        return $this->belongsTo(User::class, 'employee_id', 'id');
    }

    public function evaluatedBy()
    {
        return $this->belongsTo(User::class, 'evaluated_by', 'id');
    }
}
