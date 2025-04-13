<?php

namespace Database\Seeders;

use App\Models\Payslip;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class PayslipSeeder extends Seeder
{
    public function run()
    {
        // Get active employees
        $employees = User::where('employment_status', 'active')
            ->where('employment_type', '!=', 'probation')
            ->get();

        // Generate payslips for the last 3 months
        $startDate = Carbon::now()->subMonths(3);
        
        for ($i = 0; $i < 3; $i++) {
            $periodStart = $startDate->copy()->startOfMonth();
            $periodEnd = $startDate->copy()->endOfMonth();

            foreach ($employees as $employee) {
                $basicSalary = $this->getRandomBasicSalary();
                
                Payslip::create([
                    'employee_id' => $employee->id,
                    'pay_period_start' => $periodStart,
                    'pay_period_end' => $periodEnd,
                    'basic_salary' => $basicSalary,
                    'total_hours' => $this->getRandomWorkingHours(),
                    'overtime_hours' => $this->getRandomOvertimeHours(),
                    'overtime_pay' => $this->calculateOvertimePay($basicSalary, $this->getRandomOvertimeHours()),
                    'allowances' => $this->getRandomAllowances(),
                    'sss_contribution' => $basicSalary * Payslip::SS_RATE_EMPLOYEE,
                    'philhealth_contribution' => $basicSalary * Payslip::PHILHEALTH_RATE_EMPLOYEE,
                    'pagibig_contribution' => $basicSalary * Payslip::PAGIBIG_RATE_EMPLOYEE,
                    'tax_deduction' => $basicSalary * Payslip::TAX_RATE,
                    'cash_advance' => $this->getRandomCashAdvance(),
                    'other_deductions' => $this->getRandomOtherDeductions(),
                    'net_pay' => $this->calculateNetPay($basicSalary, $this->calculateOvertimePay($basicSalary, $this->getRandomOvertimeHours()), $this->getRandomAllowances()),
                    'status' => 'approved',
                    'notes' => $this->getRandomNotes(),
                    'thirteenth_month_pay' => $this->getRandomThirteenthMonthPay($basicSalary),
                    'sil_value' => $this->getRandomSilValue(),
                    'remaining_sil_days' => $this->getRandomSilDays()
                ]);
            }

            $startDate->addMonth();
        }
    }

    private function getRandomBasicSalary()
    {
        return mt_rand(20000, 50000);
    }

    private function getRandomWorkingHours()
    {
        return mt_rand(160, 176);
    }

    private function getRandomOvertimeHours()
    {
        return mt_rand(0, 10);
    }

    private function calculateOvertimePay($basicSalary, $overtimeHours)
    {
        // Assuming 8 hours per day for basic salary
        $dailyRate = $basicSalary / 20;
        $hourlyRate = $dailyRate / 8;
        return $hourlyRate * $overtimeHours * 1.25; // 1.25x for overtime
    }

    private function getRandomAllowances()
    {
        return mt_rand(0, 5000);
    }

    private function getRandomCashAdvance()
    {
        return mt_rand(0, 10000);
    }

    private function getRandomOtherDeductions()
    {
        return mt_rand(0, 2000);
    }

    private function calculateNetPay($basicSalary, $overtimePay, $allowances)
    {
        $totalEarnings = $basicSalary + $overtimePay + $allowances;
        $sss = $basicSalary * Payslip::SS_RATE_EMPLOYEE;
        $philhealth = $basicSalary * Payslip::PHILHEALTH_RATE_EMPLOYEE;
        $pagibig = $basicSalary * Payslip::PAGIBIG_RATE_EMPLOYEE;
        $tax = $basicSalary * Payslip::TAX_RATE;
        $cashAdvance = $this->getRandomCashAdvance();
        $otherDeductions = $this->getRandomOtherDeductions();
        
        return $totalEarnings - ($sss + $philhealth + $pagibig + $tax + $cashAdvance + $otherDeductions);
    }

    private function getRandomNotes()
    {
        $notes = [
            'Regular payroll',
            'Includes overtime pay',
            'No adjustments',
            'With cash advance',
            'Full attendance'
        ];
        return $notes[array_rand($notes)];
    }

    private function getRandomThirteenthMonthPay($basicSalary)
    {
        return $basicSalary / 12;
    }

    private function getRandomSilValue()
    {
        return mt_rand(0, 500);
    }

    private function getRandomSilDays()
    {
        return mt_rand(0, 10);
    }
}
