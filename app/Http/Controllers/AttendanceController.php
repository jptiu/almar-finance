<?php

namespace App\Http\Controllers;

use App\Models\Attendance;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class AttendanceController extends Controller
{
    public function index()
    {
        abort_unless(Gate::allows('hr_access'), 403);
        
        $attendances = Attendance::with('employee')
            ->orderBy('attendance_date', 'desc')
            ->orderBy('clock_in', 'desc')
            ->paginate(20);

        return view('pages.hr.attendance.index', compact('attendances'));
    }

    public function store(Request $request)
    {
        abort_unless(Gate::allows('hr_access'), 403);

        // Get today's date
        $today = now()->toDateString();

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
            $status = $this->determineStatus($attendance->clock_in, $validated['clock_out']);
            
            $attendance->update([
                'clock_out' => $validated['clock_out'],
                'status' => $status,
                'remarks' => $validated['remarks'] ?? null
            ]);

            return redirect()->route('hr.attendance.index')
                ->with('success', 'Successfully clocked out');
        } else {
            // If no existing record, this is a clock in
            $validated = $request->validate([
                'clock_in' => 'required|date_format:H:i',
                'remarks' => 'nullable|string|max:255'
            ]);

            // Set initial status to present
            $status = 'present';

            Attendance::create([
                'employee_id' => auth()->id(),
                'attendance_date' => $today,
                'clock_in' => $validated['clock_in'],
                'status' => $status,
                'remarks' => $validated['remarks'] ?? null
            ]);

            return redirect()->route('hr.attendance.index')
                ->with('success', 'Successfully clocked in');
        }
    }

    private function determineStatus($clockIn, $clockOut)
    {
        // Convert times to timestamps
        $inTime = strtotime($clockIn);
        $outTime = strtotime($clockOut);
        
        // Calculate working hours
        $workingHours = round((($outTime - $inTime) / 3600), 2);

        // Simple status logic (you might want to adjust this based on your company's rules)
        if ($workingHours < 4) {
            return 'half-day';
        }
        if ($workingHours < 8) {
            return 'late';
        }
        return 'present';
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

        return redirect()->route('hr.attendance.index')
            ->with('success', 'Attendance updated successfully');
    }

    public function employeeAttendance(User $employee)
    {
        abort_unless(Gate::allows('hr_access'), 403);

        $attendances = Attendance::where('employee_id', $employee->id)
            ->orderBy('attendance_date', 'desc')
            ->paginate(20);

        return view('pages.hr.attendance.employee', compact('employee', 'attendances'));
    }
}
