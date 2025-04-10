<?php

namespace App\Http\Controllers;

use App\Models\Attendance;
use App\Models\DailyTimeRecord;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class AttendanceController extends Controller
{
    public function index()
    {
        // abort_unless(Gate::allows('hr_access'), 403);
        
        $today = Carbon::now('Asia/Manila')->format('Y-m-d');
        $attendances = Attendance::with('employee')
            ->where('attendance_date', $today)
            ->orderBy('clock_in', 'desc')
            ->paginate(20);

        return view('pages.hr.attendance.index', compact('attendances', 'today'));
    }

    public function store(Request $request)
    {
        // abort_unless(Gate::allows('hr_access'), 403);

        $today = Carbon::now('Asia/Manila')->format('Y-m-d');
        $now = Carbon::now('Asia/Manila');

        // Check if there's an existing attendance record for today
        $attendance = Attendance::where('employee_id', auth()->id())
            ->where('attendance_date', $today)
            ->first();

        if ($attendance) {
            // If there's an existing record, we assume this is a clock out
            $validated = $request->validate([
                'clock_out' => 'required|date_format:H:i',
                'remarks' => 'nullable|string|max:255'
            ]);

            // Set status based on clock out time
            $status = $attendance->determineStatus($attendance->clock_in, $validated['clock_out']);
            
            // Calculate working hours using Manila timezone
            $clockIn = Carbon::parse($attendance->clock_in)->setTimezone('Asia/Manila');
            $clockOut = Carbon::parse($validated['clock_out'])->setTimezone('Asia/Manila');
            $workingHours = $clockOut->diffInHours($clockIn);
            
            // Update attendance record
            $attendance->update([
                'clock_out' => $validated['clock_out'],
                'status' => $status,
                'remarks' => $validated['remarks'] ?? null
            ]);
            
            // Update or create DTR record
            $dtr = DailyTimeRecord::firstOrNew([
                'employee_id' => auth()->id(),
                'attendance_date' => $today
            ]);
            
            $dtr->fill([
                'clock_in' => $attendance->clock_in,
                'clock_out' => $validated['clock_out'],
                'working_hours' => $workingHours,
                'late_minutes' => max(0, $clockIn->diffInMinutes(Carbon::parse($now->format('Y-m-d') . ' 08:00:00'), false)),
                'undertime_minutes' => max(0, Carbon::parse($now->format('Y-m-d') . ' 17:00:00')->diffInMinutes($clockOut, false)),
                'status' => $status,
                'employee_id' => auth()->id(),
                'attendance_date' => $today,
                'is_sunday' => $now->isSunday(),
                'is_branch_meeting' => false
            ]);
            
            $dtr->save();
            $dtr->calculateNetAmount();
            $dtr->save();

            return redirect()->route('attendance.index')
                ->with('success', 'Successfully clocked out');
        } else {
            // If no existing record, this is a clock in
            $validated = $request->validate([
                'clock_in' => 'required|date_format:H:i',
                'remarks' => 'nullable|string|max:255'
            ]);

            // Set initial status
            $status = (new Attendance)->determineStatus($validated['clock_in']);
            
            // Create attendance record
            $attendance = Attendance::create([
                'employee_id' => auth()->id(),
                'attendance_date' => $today,
                'clock_in' => $validated['clock_in'],
                'status' => $status,
                'remarks' => $validated['remarks'] ?? null
            ]);
            
            // Create DTR record
            $clockIn = Carbon::parse($validated['clock_in'])->setTimezone('Asia/Manila');
            $dtr = DailyTimeRecord::firstOrNew([
                'employee_id' => auth()->id(),
                'attendance_date' => $today
            ]);
            
            $dtr->fill([
                'clock_in' => $validated['clock_in'],
                'late_minutes' => max(0, $clockIn->diffInMinutes(Carbon::parse($now->format('Y-m-d') . ' 08:00:00'), false)),
                'status' => $status,
                'employee_id' => auth()->id(),
                'attendance_date' => $today,
                'is_sunday' => $now->isSunday(),
                'is_branch_meeting' => false
            ]);
            
            $dtr->save();

            return redirect()->route('attendance.index')
                ->with('success', 'Successfully clocked in');
        }
    }

    public function edit(Attendance $attendance)
    {
        abort_unless(Gate::allows('hr_access'), 403);
        
        return view('pages.hr.attendance.edit', compact('attendance'));
    }

    public function update(Request $request, Attendance $attendance)
    {
        abort_unless(Gate::allows('hr_access'), 403);

        $validated = $request->validate([
            'clock_in' => 'nullable|date_format:H:i',
            'clock_out' => 'nullable|date_format:H:i',
            'status' => 'required|in:present,absent,late,half-day',
            'remarks' => 'nullable|string|max:255'
        ]);

        $attendance->update($validated);

        return redirect()->route('attendance.index')
            ->with('success', 'Attendance updated successfully');
    }

    public function employeeAttendance(User $employee)
    {
        abort_unless(Gate::allows('hr_access'), 403);

        $today = Carbon::now('Asia/Manila')->format('Y-m-d');
        $attendances = Attendance::where('employee_id', $employee->id)
            ->where('attendance_date', $today)
            ->orderBy('attendance_date', 'desc')
            ->paginate(20);

        return view('pages.hr.attendance.employee', compact('employee', 'attendances'));
    }
}
