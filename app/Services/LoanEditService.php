<?php

namespace App\Services;

use App\Models\Loan;
use App\Models\EditRequest;
use App\Models\LoanDetails;
use Illuminate\Support\Facades\DB;

class LoanEditService
{
    public function processEditRequest(EditRequest $editRequest, array $updates)
    {
        DB::beginTransaction();
        
        try {
            // Update the loan
            $loan = Loan::findOrFail($editRequest->loan_id);
            $loan->update($updates);

            // Recalculate interest and due amounts if principal or interest rate changed
            if (isset($updates['principal_amount']) || isset($updates['interest'])) {
                $this->recalculateLoanDetails($loan);
            }

            // Update the edit request status
            $editRequest->update([
                'status' => 'approved',
                'processed_at' => now()
            ]);

            DB::commit();
            return true;
        } catch (\Exception $e) {
            DB::rollBack();
            throw $e;
        }
    }

    private function recalculateLoanDetails(Loan $loan)
    {
        // Get the current principal amount
        $principalAmount = $loan->principal_amount;
        $monthsToPay = $loan->months_to_pay;
        $interestRate = $loan->interest;

        // Calculate total interest (10% of principal)
        $totalInterest = ($principalAmount * $interestRate) / 100;
        
        // Calculate monthly payment (principal + interest divided by number of payments)
        $monthlyPayment = ($principalAmount + $totalInterest) / ($monthsToPay * 2);

        // Get all loan details sorted by day number
        $details = $loan->details()->orderBy('loan_day_no')->get();

        // Update each payment with the monthly payment amount
        $remainingBalance = $principalAmount + $totalInterest;
        foreach ($details as $detail) {
            $detail->update([
                'loan_due_amount' => $monthlyPayment,
                'loan_running_balance' => $remainingBalance
            ]);
            $remainingBalance -= $monthlyPayment;
        }

        // Update loan details with total interest
        $loan->update([
            'interest_amount' => $totalInterest,
            'payable_amount' => $principalAmount + $totalInterest
        ]);
    }
}
