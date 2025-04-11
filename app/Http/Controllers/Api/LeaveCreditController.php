<?php

namespace App\Http\Controllers\Api;

use App\Models\LeaveCredit;
use App\Services\LeaveCreditService;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class LeaveCreditController extends Controller
{
    public function getEmployeeCredits(Request $request, $employeeId, $leaveType)
    {
        $credit = LeaveCredit::where('employee_id', $employeeId)
            ->where('leave_type', $leaveType)
            ->first();

        if (!$credit) {
            return response()->json([
                'error' => 'No leave credit record found'
            ], 404);
        }

        return response()->json([
            'total_credits' => $credit->total_credits,
            'used_credits' => $credit->used_credits,
            'remaining_credits' => $credit->remaining_credits,
            'effective_date' => $credit->effective_date
        ]);
    }

    public function getAllEmployeeCredits(Request $request, $employeeId)
    {
        $credits = LeaveCredit::where('employee_id', $employeeId)
            ->get()
            ->map(function ($credit) {
                return [
                    'leave_type' => $credit->leave_type,
                    'total_credits' => $credit->total_credits,
                    'used_credits' => $credit->used_credits,
                    'remaining_credits' => $credit->remaining_credits,
                    'effective_date' => $credit->effective_date
                ];
            });

        return response()->json($credits);
    }

    public function checkCredits(Request $request)
    {
        $validated = $request->validate([
            'employee_id' => 'required|exists:users,id',
            'leave_type' => 'required|in:sick,vacation,maternity,paternity'
        ]);

        $credit = LeaveCredit::where('employee_id', $validated['employee_id'])
            ->where('leave_type', $validated['leave_type'])
            ->first();

        if (!$credit) {
            return response()->json([
                'error' => 'No leave credit record found'
            ], 404);
        }

        return response()->json([
            'total_credits' => $credit->total_credits,
            'used_credits' => $credit->used_credits,
            'remaining_credits' => $credit->remaining_credits,
            'status' => app(\App\Http\Controllers\LeaveCreditController::class)->getCreditStatus(
                $credit->total_credits,
                $credit->remaining_credits
            )
        ]);
    }
}
