<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

return new class extends Migration
{
    public function up()
    {
        // Get all records from attendances table
        $attendances = DB::table('attendances')->get();

        foreach ($attendances as $attendance) {
            // Insert into daily_time_records with the same data
            DB::table('daily_time_records')->insert([
                'employee_id' => $attendance->employee_id,
                'attendance_date' => Carbon::parse($attendance->attendance_date)->format('Y-m-d'),
                'clock_in' => $attendance->clock_in ? Carbon::parse($attendance->clock_in)->format('Y-m-d H:i:s') : null,
                'clock_out' => $attendance->clock_out ? Carbon::parse($attendance->clock_out)->format('Y-m-d H:i:s') : null,
                'working_hours' => $attendance->working_hours ?? 0,
                'late_minutes' => $attendance->late_minutes ?? 0,
                'undertime_minutes' => $attendance->undertime_minutes ?? 0,
                'status' => $attendance->status ?? 'present',
                'deductions' => $attendance->deductions ?? 0,
                'net_amount' => $attendance->net_amount ?? 0,
                'is_sunday' => Carbon::parse($attendance->attendance_date)->isSunday(),
                'is_branch_meeting' => false, // Default to false since we don't have this data
                'created_at' => $attendance->created_at,
                'updated_at' => $attendance->updated_at
            ]);
        }
    }

    public function down()
    {
        // Clear all records from daily_time_records
        DB::table('daily_time_records')->truncate();
    }
};
