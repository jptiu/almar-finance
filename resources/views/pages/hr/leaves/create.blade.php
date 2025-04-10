<x-app-layout>
    <div class="px-4 sm:px-6 lg:px-8 py-8 w-full max-w-9xl mx-auto">
        <!-- Page header -->
        <div class="mb-8">
            <div class="mb-4">
                <h1 class="text-2xl md:text-3xl text-slate-800 dark:text-slate-100 font-bold">Create Leave Request</h1>
            </div>
        </div>

        <!-- Form -->
        <form action="{{ route('leaves.store') }}" method="POST" class="space-y-6">
            @csrf
            
            <!-- Employee Selection -->
            <div class="bg-white dark:bg-slate-800 shadow-lg rounded-sm border border-slate-200 dark:border-slate-700">
                <header class="px-5 py-4 border-b border-slate-200 dark:border-slate-700">
                    <h2 class="font-semibold text-slate-800 dark:text-slate-100">Employee Details</h2>
                </header>
                <div class="p-3">
                    <div class="grid grid-cols-12 gap-4">
                        <div class="col-span-12">
                            @can('hr_access')
                            <label class="block text-sm font-medium mb-1" for="employee_id">Employee</label>
                            <select id="employee_id" name="employee_id" class="form-select w-full" required>
                                <option value="">Select Employee</option>
                                @foreach($employees as $employee)
                                    <option value="{{ $employee->id }}">{{ $employee->name }}</option>
                                @endforeach
                            </select>
                            @error('employee_id')
                                <p class="mt-1 text-xs text-red-600 dark:text-red-400">{{ $message }}</p>
                            @enderror
                            @endcan
                            @cannot('hr_access')
                            <label class="block text-sm font-medium mb-1">Employee</label>
                            <div class="flex items-center bg-gray-50 dark:bg-slate-700 rounded-md p-2">
                                <input type="hidden" name="employee_id" value="{{ auth()->id() }}">
                                <span class="text-gray-700 dark:text-gray-300">{{ auth()->user()->name }}</span>
                            </div>
                            @endcannot
                        </div>
                    </div>
                </div>
            </div>

            <!-- Leave Details -->
            <div class="bg-white dark:bg-slate-800 shadow-lg rounded-sm border border-slate-200 dark:border-slate-700">
                <header class="px-5 py-4 border-b border-slate-200 dark:border-slate-700">
                    <h2 class="font-semibold text-slate-800 dark:text-slate-100">Leave Details</h2>
                </header>
                <div class="p-3">
                    <div class="grid grid-cols-12 gap-4">
                        <div class="col-span-6">
                            <label class="block text-sm font-medium mb-1" for="leave_type">Leave Type</label>
                            <select id="leave_type" name="leave_type" class="form-select w-full" required>
                                <option value="">Select Leave Type</option>
                                <option value="sick">Sick Leave</option>
                                <option value="vacation">Vacation Leave</option>
                                <option value="emergency">Emergency Leave</option>
                                <option value="maternity">Maternity Leave</option>
                                <option value="paternity">Paternity Leave</option>
                            </select>
                            @error('leave_type')
                                <p class="mt-1 text-xs text-red-600 dark:text-red-400">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="col-span-6">
                            <label class="block text-sm font-medium mb-1" for="days_requested">Days Requested</label>
                            <input id="days_requested" name="days_requested" type="number" min="1" class="form-input w-full" required>
                            @error('days_requested')
                                <p class="mt-1 text-xs text-red-600 dark:text-red-400">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="col-span-6">
                            <label class="block text-sm font-medium mb-1" for="start_date">Start Date</label>
                            <input id="start_date" name="start_date" type="date" class="form-input w-full" required>
                            @error('start_date')
                                <p class="mt-1 text-xs text-red-600 dark:text-red-400">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="col-span-6">
                            <label class="block text-sm font-medium mb-1" for="end_date">End Date</label>
                            <input id="end_date" name="end_date" type="date" class="form-input w-full" required>
                            @error('end_date')
                                <p class="mt-1 text-xs text-red-600 dark:text-red-400">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="col-span-6">
                            @can('hr_access')
                            <label class="block text-sm font-medium mb-1" for="status">Status</label>
                            <select id="status" name="status" class="form-select w-full" required>
                                <option value="pending">Pending</option>
                                <option value="approved">Approved</option>
                                <option value="rejected">Rejected</option>
                            </select>
                            @error('status')
                                <p class="mt-1 text-xs text-red-600 dark:text-red-400">{{ $message }}</p>
                            @enderror
                            @endcan
                            @cannot('hr_access')
                            <label class="block text-sm font-medium mb-1">Status</label>
                            <div class="flex items-center bg-gray-50 dark:bg-slate-700 rounded-md p-2">
                                <input type="hidden" name="status" value="pending">
                                <span class="text-gray-700 dark:text-gray-300">Pending</span>
                            </div>
                            @endcannot
                        </div>
                    </div>
                </div>
            </div>

            <!-- Reason -->
            <div class="bg-white dark:bg-slate-800 shadow-lg rounded-sm border border-slate-200 dark:border-slate-700">
                <header class="px-5 py-4 border-b border-slate-200 dark:border-slate-700">
                    <h2 class="font-semibold text-slate-800 dark:text-slate-100">Reason</h2>
                </header>
                <div class="p-3">
                    <div class="grid grid-cols-12 gap-4">
                        <div class="col-span-12">
                            <label class="block text-sm font-medium mb-1" for="reason">Reason for Leave</label>
                            <textarea id="reason" name="reason" rows="3" class="form-textarea w-full" required></textarea>
                            @error('reason')
                                <p class="mt-1 text-xs text-red-600 dark:text-red-400">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>

            <!-- Remarks -->
            <div class="bg-white dark:bg-slate-800 shadow-lg rounded-sm border border-slate-200 dark:border-slate-700">
                <header class="px-5 py-4 border-b border-slate-200 dark:border-slate-700">
                    <h2 class="font-semibold text-slate-800 dark:text-slate-100">Remarks</h2>
                </header>
                <div class="p-3">
                    <div class="grid grid-cols-12 gap-4">
                        <div class="col-span-12">
                            <label class="block text-sm font-medium mb-1" for="remarks">Additional Remarks</label>
                            <textarea id="remarks" name="remarks" rows="3" class="form-textarea w-full"></textarea>
                            @error('remarks')
                                <p class="mt-1 text-xs text-red-600 dark:text-red-400">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>

            <!-- Submit Button -->
            <div class="text-right">
                <button type="submit" class="btn bg-indigo-500 hover:bg-indigo-600 text-white">
                    Submit Leave Request
                </button>
            </div>
        </form>
    </div>
</x-app-layout>
