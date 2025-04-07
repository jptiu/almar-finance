<?php

namespace App\Http\Controllers;

use App\Models\OvertimeRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class OvertimeRequestController extends Controller
{
    public function index()
    {
        // abort_unless(Gate::allows('hr_access') || Gate::allows('admin_access'), 403);

        $requests = OvertimeRequest::with(['employee', 'approver'])
            ->when(auth()->user()->cannot('admin_access'), function ($query) {
                $query->where('employee_id', auth()->id());
            })
            ->orderBy('created_at', 'desc')
            ->get();

        return view('pages.hr.overtime.index', compact('requests'));
    }

    public function create()
    {
        // abort_unless(Gate::allows('employee_access'), 403);

        return view('pages.hr.overtime.create');
    }

    public function store(Request $request)
    {
        // abort_unless(Gate::allows('employee_access'), 403);

        $validated = $request->validate([
            'date' => 'required|date|after_or_equal:today',
            'hours_requested' => 'required|numeric|min:0.5|max:12',
            'reason' => 'required|string|min:10',
            'notes' => 'nullable|string'
        ]);

        $request = OvertimeRequest::create([
            'employee_id' => auth()->id(),
            'date' => $validated['date'],
            'hours_requested' => $validated['hours_requested'],
            'reason' => $validated['reason'],
            'notes' => $validated['notes'] ?? null
        ]);

        return redirect()->route('overtime.index')
            ->with('success', 'Overtime request submitted successfully');
    }

    public function approve(Request $request, OvertimeRequest $overtimeRequest)
    {
        abort_unless(Gate::allows('hr_access') || Gate::allows('admin_access'), 403);

        $validated = $request->validate([
            'notes' => 'nullable|string'
        ]);

        $overtimeRequest->update([
            'status' => 'approved',
            'approved_by' => auth()->id(),
            'approved_at' => now(),
            'notes' => $validated['notes'] ?? null
        ]);

        return redirect()->route('overtime.index')
            ->with('success', 'Overtime request approved successfully');
    }

    public function reject(Request $request, OvertimeRequest $overtimeRequest)
    {
        abort_unless(Gate::allows('hr_access') || Gate::allows('admin_access'), 403);

        $validated = $request->validate([
            'notes' => 'required|string|min:10'
        ]);

        $overtimeRequest->update([
            'status' => 'rejected',
            'approved_by' => auth()->id(),
            'approved_at' => now(),
            'notes' => $validated['notes']
        ]);

        return redirect()->route('overtime.index')
            ->with('success', 'Overtime request rejected successfully');
    }
}
