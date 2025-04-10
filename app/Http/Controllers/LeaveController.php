<?php

namespace App\Http\Controllers;

use App\Models\Leave;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class LeaveController extends Controller
{
    public function index()
    {
        // abort_unless(Gate::allows('hr_access') || Gate::allows('admin_access'), 403);
        
        $leaves = Leave::with(['employee', 'approvedBy'])
            ->orderBy('start_date', 'desc')
            ->paginate(20);

        return view('pages.hr.leaves.index', compact('leaves'));
    }

    public function create()
    {
        // abort_unless(Gate::allows('hr_access') || Gate::allows('admin_access'), 403);
        
        $employees = User::whereHas('roles')->get();

        return view('pages.hr.leaves.create', compact('employees'));
    }

    public function store(Request $request)
    {
        // abort_unless(Gate::allows('hr_access') || Gate::allows('admin_access'), 403);

        $validated = $request->validate([
            'employee_id' => 'required|exists:users,id',
            'leave_type' => 'required|string',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after:start_date',
            'days_requested' => 'required|integer|min:1',
            'reason' => 'required|string|max:1000',
            'remarks' => 'nullable|string|max:255'
        ]);

        Leave::create($validated);

        return redirect()->route('leaves.index')
            ->with('success', 'Leave request created successfully');
    }

    public function approve(Request $request, Leave $leave)
    {
        abort_unless(Gate::allows('hr_access') || Gate::allows('admin_access'), 403);

        $validated = $request->validate([
            'remarks' => 'nullable|string|max:255'
        ]);

        $leave->update([
            'status' => 'approved',
            'approved_by' => auth()->id(),
            'remarks' => $validated['remarks'] ?? null
        ]);

        return redirect()->route('leaves.index')
            ->with('success', 'Leave request approved successfully');
    }

    public function reject(Request $request, Leave $leave)
    {
        abort_unless(Gate::allows('hr_access') || Gate::allows('admin_access'), 403);

        $validated = $request->validate([
            'remarks' => 'required|string|max:255'
        ]);

        $leave->update([
            'status' => 'rejected',
            'remarks' => $validated['remarks']
        ]);

        return redirect()->route('leaves.index')
            ->with('success', 'Leave request rejected successfully');
    }

    public function employeeLeaves(User $employee)
    {
        abort_unless(Gate::allows('hr_access') || Gate::allows('admin_access'), 403);

        $leaves = Leave::where('employee_id', $employee->id)
            ->orderBy('start_date', 'desc')
            ->paginate(20);

        return view('pages.hr.leaves.employee', compact('employee', 'leaves'));
    }
}
