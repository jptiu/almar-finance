<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\EmployeeOnboarding;
use App\Models\User;
use App\Models\Department;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;

class EmployeeOnboardingController extends Controller
{
    public function index()
    {
        // Get all employees with their onboarding status
        $employees = User::with(['onboarding'])
            ->whereHas('onboarding', function ($query) {
                $query->where('is_regularized', false)
                    ->where('probation_status', '!=', EmployeeOnboarding::PROBATION_STATUS_FAILED);
            })
            ->orWhereDoesntHave('onboarding')
            ->get();

        // Get regularized employees
        $regularEmployees = EmployeeOnboarding::with('user')
            ->where('is_regularized', true)
            ->get();

        // Get departments
        $departments = Department::all();

        return view('pages.hr.onboarding.index', compact('employees', 'regularEmployees', 'departments'));
    }

    public function selectEmployee(Request $request)
    {
        $validated = $request->validate([
            'user_id' => 'required|exists:users,id',
        ]);

        $user = User::findOrFail($validated['user_id']);
        
        // Check if user already has onboarding
        if ($user->onboarding) {
            return redirect()->back()->with('error', 'This employee already has an onboarding record');
        }

        // Redirect to create form with user ID as route parameter
        return redirect()->route('hr.onboarding.create', ['user' => $user->id]);
    }

    public function create(Request $request, User $user)
    {
        // Handle GET request - show the create form
        return view('pages.hr.onboarding.create', compact('user'));
    }

    public function store(Request $request, User $user)
    {
        $validated = $request->validate([
            'probation_start_date' => 'required|date|before:probation_end_date',
            'probation_end_date' => 'required|date|after:probation_start_date',
            'performance_metrics' => 'required|string|min:10',
            'training_requirements' => 'required|string|min:10',
        ]);

        // Convert dates to Carbon instances
        $startDate = Carbon::parse($validated['probation_start_date']);
        $endDate = Carbon::parse($validated['probation_end_date']);

        // Calculate probation duration in days
        $probationDuration = $endDate->diffInDays($startDate);

        // Validate probation duration
        if ($probationDuration < 30 || $probationDuration > 180) {
            return redirect()->back()->with('error', 'Probation period must be between 30 and 180 days');
        }

        $onboarding = new EmployeeOnboarding([
            'probation_start_date' => $startDate,
            'probation_end_date' => $endDate,
            'probation_status' => EmployeeOnboarding::PROBATION_STATUS_PENDING,
            'performance_metrics' => $validated['performance_metrics'],
            'training_requirements' => $validated['training_requirements'],
            'probation_duration' => $probationDuration,
        ]);

        // Save the onboarding record with the user
        $user->onboarding()->save($onboarding);

        // Redirect back to the index with success message
        return redirect()->route('hr.onboarding.index')->with('success', 'Employee onboarding started successfully');
    }

    public function extendProbation(Request $request, EmployeeOnboarding $onboarding)
    {
        $validated = $request->validate([
            'new_end_date' => 'required|date|after:probation_start_date',
            'reason' => 'nullable|string',
        ]);

        if (!$onboarding->isProbationPeriod()) {
            return redirect()->back()->with('error', 'Employee is not in probation period');
        }

        $onboarding->extendProbation($validated['new_end_date']);
        $onboarding->probation_evaluation = $validated['reason'];
        $onboarding->save();

        return redirect()->back()->with('success', 'Probation period extended successfully');
    }

    public function failProbation(Request $request, EmployeeOnboarding $onboarding)
    {
        $validated = $request->validate([
            'reason' => 'required|string',
        ]);

        if (!$onboarding->isProbationPeriod()) {
            return redirect()->back()->with('error', 'Employee is not in probation period');
        }

        $onboarding->failProbation($validated['reason']);
        $onboarding->save();

        return redirect()->back()->with('success', 'Probation failed successfully');
    }

    public function completeProbation(Request $request, EmployeeOnboarding $onboarding)
    {
        $validated = $request->validate([
            'evaluation' => 'required|string',
        ]);

        if (!$onboarding->isProbationPeriod()) {
            return redirect()->back()->with('error', 'Employee is not in probation period');
        }

        $onboarding->completeProbation($validated['evaluation']);
        $onboarding->save();

        return redirect()->back()->with('success', 'Probation completed successfully');
    }

    public function regularize(EmployeeOnboarding $onboarding)
    {
        if (!$onboarding->isProbationCompleted()) {
            return redirect()->back()->with('error', 'Employee probation period must be completed first');
        }

        $onboarding->regularization_date = now();
        $onboarding->is_regularized = true;
        $onboarding->save();

        $onboarding->user->employment_type = 'regular';
        $onboarding->user->save();

        return redirect()->back()->with('success', 'Employee regularized successfully');
    }

    public function addEmployee(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'employee_id' => 'required|string|max:255|unique:users',
            'department_id' => 'required|exists:departments,id',
        ]);

        try {
            $user = User::create([
                'name' => $validated['name'],
                'email' => strtolower(str_replace(' ', '.', $validated['name'])) . '@almarfinance.com',
                'password' => Hash::make('password'),
                'employee_id' => $validated['employee_id'],
                'department_id' => $validated['department_id'],
            ]);

            return redirect()->route('hr.onboarding.index')->with('success', 'Employee added successfully');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Failed to add employee: ' . $e->getMessage());
        }
    }
}
