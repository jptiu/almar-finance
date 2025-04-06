<?php

namespace App\Traits;

use Carbon\Carbon;

trait HasAttendanceStatus
{
    public function determineStatus($clockIn = null, $clockOut = null)
    {
        // If no clock in, status is absent
        if (!$clockIn) {
            return 'absent';
        }

        $clockIn = Carbon::parse($clockIn);
        $startTime = Carbon::parse($clockIn->format('Y-m-d') . ' 08:00:00');
        
        // Check if late
        $lateMinutes = max(0, $clockIn->diffInMinutes($startTime, false));
        
        // If clock out exists, check working hours and undertime
        if ($clockOut) {
            $clockOut = Carbon::parse($clockOut);
            $endTime = Carbon::parse($clockOut->format('Y-m-d') . ' 17:00:00');
            
            $workingHours = $clockOut->diffInHours($clockIn);
            $undertimeMinutes = max(0, $endTime->diffInMinutes($clockOut, false));
            
            if ($workingHours < 4) {
                return 'half-day';
            }
            
            if ($lateMinutes > 0 || $undertimeMinutes > 0) {
                return 'late';
            }
            
            return 'present';
        }
        
        // If no clock out yet but already late
        return $lateMinutes > 0 ? 'late' : 'present';
    }
}
