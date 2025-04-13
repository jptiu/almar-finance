<?php

namespace App\Models\Models;

use App\Models\Payslip;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;

class ContributionReport extends Model
{
    protected $table = 'contribution_reports';
    
    protected $fillable = [
        'employee_id',
        'sss_number',
        'philhealth_number',
        'pagibig_number',
        'sss_employee_contribution',
        'sss_employer_contribution',
        'philhealth_employee_contribution',
        'philhealth_employer_contribution',
        'pagibig_employee_contribution',
        'pagibig_employer_contribution',
        'total_employee_contribution',
        'total_employer_contribution',
        'total_contribution',
        'report_date'
    ];

    protected $casts = [
        'sss_employee_contribution' => 'decimal:2',
        'sss_employer_contribution' => 'decimal:2',
        'philhealth_employee_contribution' => 'decimal:2',
        'philhealth_employer_contribution' => 'decimal:2',
        'pagibig_employee_contribution' => 'decimal:2',
        'pagibig_employer_contribution' => 'decimal:2',
        'total_employee_contribution' => 'decimal:2',
        'total_employer_contribution' => 'decimal:2',
        'total_contribution' => 'decimal:2',
        'report_date' => 'date'
    ];

    public function employee()
    {
        return $this->belongsTo(User::class);
    }

    public function calculateContributions($basicSalary)
    {
        // Using Payslip model's constants for consistency
        $this->sss_employee_contribution = $basicSalary * Payslip::SS_RATE_EMPLOYEE;
        $this->sss_employer_contribution = $basicSalary * Payslip::SS_RATE_EMPLOYER;
        
        $this->philhealth_employee_contribution = $basicSalary * Payslip::PHILHEALTH_RATE_EMPLOYEE;
        $this->philhealth_employer_contribution = $basicSalary * Payslip::PHILHEALTH_RATE_EMPLOYER;
        
        $this->pagibig_employee_contribution = $basicSalary * Payslip::PAGIBIG_RATE_EMPLOYEE;
        $this->pagibig_employer_contribution = $basicSalary * Payslip::PAGIBIG_RATE_EMPLOYER;
        
        $this->total_employee_contribution = $this->sss_employee_contribution + 
                                            $this->philhealth_employee_contribution + 
                                            $this->pagibig_employee_contribution;
        
        $this->total_employer_contribution = $this->sss_employer_contribution + 
                                            $this->philhealth_employer_contribution + 
                                            $this->pagibig_employer_contribution;
        
        $this->total_contribution = $this->total_employee_contribution + $this->total_employer_contribution;
    }
}
