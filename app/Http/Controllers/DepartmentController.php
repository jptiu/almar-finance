<?php

namespace App\Http\Controllers;

use App\Models\Department;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class DepartmentController extends Controller
{
    public function index()
    {
        abort_unless(Gate::allows('hr_access') || Gate::allows('admin_access'), 403);

        $departments = Department::orderBy('name')->paginate(20);

        return view('pages.hr.departments.index', compact('departments'));
    }

    public function create()
    {
        abort_unless(Gate::allows('hr_access') || Gate::allows('admin_access'), 403);

        return view('pages.hr.departments.create');
    }

    public function store(Request $request)
    {
        abort_unless(Gate::allows('hr_access') || Gate::allows('admin_access'), 403);

        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:departments',
            'description' => 'nullable|string|max:1000'
        ]);

        Department::create($validated);

        return redirect()->route('departments.index')
            ->with('success', 'Department created successfully');
    }

    public function edit(Department $department)
    {
        abort_unless(Gate::allows('hr_access') || Gate::allows('admin_access'), 403);

        return view('pages.hr.departments.edit', compact('department'));
    }

    public function update(Request $request, Department $department)
    {
        abort_unless(Gate::allows('hr_access') || Gate::allows('admin_access'), 403);

        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:departments,name,' . $department->id,
            'description' => 'nullable|string|max:1000'
        ]);

        $department->update($validated);

        return redirect()->route('departments.index')
            ->with('success', 'Department updated successfully');
    }

    public function destroy(Department $department)
    {
        abort_unless(Gate::allows('hr_access') || Gate::allows('admin_access'), 403);

        // Check if department has users
        if ($department->users()->count() > 0) {
            return redirect()->route('departments.index')
                ->with('error', 'Cannot delete department with assigned users');
        }

        $department->delete();

        return redirect()->route('departments.index')
            ->with('success', 'Department deleted successfully');
    }
}
