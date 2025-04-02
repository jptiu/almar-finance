@extends('layouts.app')

@section('content')
<div class="px-4 sm:px-6 lg:px-8 py-8 w-full max-w-9xl mx-auto">
    <!-- Welcome banner -->
    <x-dashboard.welcome-banner />

    <!-- Success Message -->
    @if(session('success'))
        <div class="bg-green-50 border-l-4 border-green-400 p-4 mb-4">
            <div class="flex">
                <div class="flex-shrink-0">
                    <svg class="h-5 w-5 text-green-400" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                    </svg>
                </div>
                <div class="ml-3">
                    <p class="text-sm text-green-700">{{ session('success') }}</p>
                </div>
            </div>
        </div>
    @endif

    <div class="flex justify-between relative items-center mb-4">
        <h1 class="text-2xl md:text-2xl text-slate-800 dark:text-slate-100 font-bold lg:px-4">Edit Attendance</h1>
    </div>

    <div class="mt-6">
        <form action="{{ route('hr.attendance.update', $attendance) }}" method="POST" class="space-y-4">
            @csrf
            @method('PUT')
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label for="employee_id" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Employee</label>
                    <input type="text" id="employee_id" name="employee_id" value="{{ $attendance->employee->name }}" readonly class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                </div>
                <div>
                    <label for="attendance_date" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Attendance Date</label>
                    <input type="date" name="attendance_date" id="attendance_date" value="{{ $attendance->attendance_date->format('Y-m-d') }}" readonly class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                </div>
                <div>
                    <label for="clock_in" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Clock In</label>
                    <input type="time" name="clock_in" id="clock_in" value="{{ $attendance->clock_in ? $attendance->clock_in->format('H:i') : '' }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                </div>
                <div>
                    <label for="clock_out" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Clock Out</label>
                    <input type="time" name="clock_out" id="clock_out" value="{{ $attendance->clock_out ? $attendance->clock_out->format('H:i') : '' }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                </div>
                <div>
                    <label for="status" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Status</label>
                    <select id="status" name="status" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                        <option value="present" {{ $attendance->status === 'present' ? 'selected' : '' }}>Present</option>
                        <option value="absent" {{ $attendance->status === 'absent' ? 'selected' : '' }}>Absent</option>
                        <option value="late" {{ $attendance->status === 'late' ? 'selected' : '' }}>Late</option>
                        <option value="half-day" {{ $attendance->status === 'half-day' ? 'selected' : '' }}>Half Day</option>
                    </select>
                </div>
                <div>
                    <label for="remarks" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Remarks</label>
                    <textarea id="remarks" name="remarks" rows="3" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">{{ $attendance->remarks }}</textarea>
                </div>
            </div>
            <div class="flex justify-end">
                <button type="submit" class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                    Update Attendance
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
