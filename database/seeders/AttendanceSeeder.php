<?php

namespace Database\Seeders;

use App\Models\Attendance;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class AttendanceSeeder extends Seeder
{
    public function run()
    {
        // Get active employees
        $employees = User::where('employment_status', 'active')
            ->where('employment_type', '!=', 'probation')
            ->get();

        // Generate attendance records for the last 3 months
        $startDate = Carbon::now()->subMonths(3);
        
        for ($i = 0; $i < 3; $i++) {
            $currentDate = $startDate->copy()->startOfMonth();
            
            while ($currentDate->lt($startDate->copy()->endOfMonth())) {
                foreach ($employees as $employee) {
                    // Skip weekends
                    if ($currentDate->dayOfWeek === Carbon::SATURDAY || $currentDate->dayOfWeek === Carbon::SUNDAY) {
                        continue;
                    }

                    $isPresent = $this->getRandomAttendanceStatus();
                    
                    if ($isPresent) {
                        Attendance::create([
                            'employee_id' => $employee->id,
                            'attendance_date' => $currentDate,
                            'clock_in' => $this->getRandomTimeIn(),
                            'clock_out' => $this->getRandomTimeOut(),
                            'status' => 'present',
                            'daily_rate' => $this->getRandomDailyRate(),
                            'late_minutes' => $this->calculateLateMinutes($this->getRandomTimeIn()),
                            'undertime_minutes' => $this->calculateUndertimeMinutes($this->getRandomTimeOut()),
                            'is_sunday' => $currentDate->dayOfWeek === Carbon::SUNDAY,
                            'is_branch_meeting' => $this->getRandomBranchMeetingStatus(),
                            'remarks' => $this->getRandomNotes()
                        ]);
                    } else {
                        Attendance::create([
                            'employee_id' => $employee->id,
                            'attendance_date' => $currentDate,
                            'status' => $this->getRandomAbsentStatus(),
                            'remarks' => $this->getRandomNotes()
                        ]);
                    }
                }
                
                $currentDate->addDay();
            }

            $startDate->addMonth();
        }
    }

    private function getRandomAttendanceStatus()
    {
        // 90% chance of being present
        return mt_rand(1, 100) <= 90;
    }

    private function getRandomTimeIn()
    {
        $hours = mt_rand(8, 9);
        $minutes = mt_rand(0, 59);
        return Carbon::createFromFormat('H:i', sprintf('%d:%02d', $hours, $minutes));
    }

    private function getRandomTimeOut()
    {
        $hours = mt_rand(17, 18);
        $minutes = mt_rand(0, 59);
        return Carbon::createFromFormat('H:i', sprintf('%d:%02d', $hours, $minutes));
    }

    private function calculateLateMinutes($timeIn)
    {
        $expectedTimeIn = Carbon::createFromFormat('H:i', '08:00');
        return $timeIn->diffInMinutes($expectedTimeIn);
    }

    private function calculateUndertimeMinutes($timeOut)
    {
        $expectedTimeOut = Carbon::createFromFormat('H:i', '17:00');
        return $expectedTimeOut->diffInMinutes($timeOut);
    }

    private function getRandomAbsentStatus()
    {
        $statuses = ['absent', 'late', 'half_day'];
        return $statuses[array_rand($statuses)];
    }

    private function getRandomDailyRate()
    {
        return mt_rand(500, 1000);
    }

    private function getRandomBranchMeetingStatus()
    {
        return mt_rand(1, 100) <= 20;
    }

    private function getRandomNotes()
    {
        $notes = [
            'Regular attendance',
            'Late due to traffic',
            'Half day due to personal matters',
            'Absent with valid reason',
            'Work from home',
            'On leave'
        ];
        return $notes[array_rand($notes)];
    }
}
