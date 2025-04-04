<?php

namespace App\Http\Controllers;

use App\Models\PerformanceEvaluation;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class PerformanceEvaluationController extends Controller
{
    public function index()
    {
        abort_unless(Gate::allows('hr_access') || Gate::allows('admin_access'), 403);
        
        $evaluations = PerformanceEvaluation::with(['employee', 'evaluatedBy'])
            ->orderBy('evaluation_date', 'desc')
            ->paginate(20);

        return view('pages.hr.performance.index', compact('evaluations'));
    }

    public function create()
    {
        abort_unless(Gate::allows('hr_access') || Gate::allows('admin_access'), 403);
        
        $employees = User::whereHas('roles')->get();

        return view('pages.hr.performance.create', compact('employees'));
    }

    public function store(Request $request)
    {
        abort_unless(Gate::allows('hr_access') || Gate::allows('admin_access'), 403);

        $validated = $request->validate([
            'employee_id' => 'required|exists:users,id',
            'evaluation_date' => 'required|date',
            'evaluation_period' => 'required|string',
            'overall_rating' => 'required|numeric|min:0|max:5',
            'strengths' => 'required|string',
            'areas_for_improvement' => 'required|string',
            'goals' => 'required|string',
            'manager_comments' => 'required|string',
            'employee_comments' => 'nullable|string'
        ]);

        $validated['evaluated_by'] = auth()->id();

        PerformanceEvaluation::create($validated);

        return redirect()->route('performance.index')
            ->with('success', 'Performance evaluation created successfully');
    }

    public function show(PerformanceEvaluation $evaluation)
    {
        abort_unless(Gate::allows('hr_access') || Gate::allows('admin_access'), 403);
        
        return view('pages.hr.performance.show', compact('evaluation'));
    }

    public function employeePerformance(User $employee)
    {
        abort_unless(Gate::allows('hr_access') || Gate::allows('admin_access'), 403);

        $evaluations = PerformanceEvaluation::where('employee_id', $employee->id)
            ->orderBy('evaluation_date', 'desc')
            ->paginate(20);

        return view('pages.hr.performance.employee', compact('employee', 'evaluations'));
    }

    public function printEvaluation(PerformanceEvaluation $evaluation)
    {
        abort_unless(Gate::allows('hr_access') || Gate::allows('admin_access'), 403);
        
        return view('pages.hr.performance.print', compact('evaluation'));
    }
}
