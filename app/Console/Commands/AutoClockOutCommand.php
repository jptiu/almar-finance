<?php

namespace App\Console\Commands;

use App\Models\Attendance;
use App\Models\DailyTimeRecord;
use Carbon\Carbon;
use Illuminate\Console\Command;

class AutoClockOutCommand extends Command
{
    protected $signature = 'attendance:auto-clock-out {--date= : Optional date in Y-m-d format}';
    protected $description = 'Automatically clock out employees who forgot to clock out';

    public function handle()
    {
        $date = $this->option('date') ? Carbon::parse($this->option('date')) : Carbon::yesterday();
        
        $this->info("Processing missing clock outs for: " . $date->format('Y-m-d'));

        // Find all attendance records for the date that have clock in but no clock out
        $attendances = Attendance::where('attendance_date', $date->format('Y-m-d'))
            ->whereNotNull('clock_in')
            ->whereNull('clock_out')
            ->get();

        if ($attendances->isEmpty()) {
            $this->info("No missing clock outs found.");
            return;
        }

        $bar = $this->output->createProgressBar(count($attendances));
        $bar->start();

        foreach ($attendances as $attendance) {
            // Default clock out to 5:00 PM of the same day
            $clockOut = Carbon::parse($attendance->attendance_date)->setTime(17, 0, 0);
            
            // Update attendance record
            $attendance->clock_out = $clockOut;
            $attendance->status = $attendance->determineStatus($attendance->clock_in, $clockOut);
            $attendance->remarks = $attendance->remarks . ' [Auto clock-out]';
            $attendance->save();

            // Update or create DTR record
            $dtr = DailyTimeRecord::firstOrNew([
                'employee_id' => $attendance->employee_id,
                'attendance_date' => $attendance->attendance_date
            ]);

            $clockIn = Carbon::parse($attendance->clock_in);
            $startTime = Carbon::parse($attendance->attendance_date)->setTime(8, 0, 0);
            $workingHours = $clockOut->diffInHours($clockIn);

            $dtr->fill([
                'clock_in' => $attendance->clock_in,
                'clock_out' => $clockOut,
                'working_hours' => $workingHours,
                'late_minutes' => max(0, $clockIn->diffInMinutes($startTime, false)),
                'undertime_minutes' => 0, // No undertime since we're setting to 5 PM
                'status' => $attendance->status,
                'is_sunday' => $date->isSunday(),
                'is_branch_meeting' => false
            ]);

            $dtr->save();
            $dtr->calculateNetAmount();
            $dtr->save();

            $bar->advance();
        }

        $bar->finish();
        $this->newLine();
        $this->info("Auto clock-out completed for {$attendances->count()} records.");
    }
}
