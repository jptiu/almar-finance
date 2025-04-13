<x-app-layout>
    <div class="px-4 sm:px-6 lg:px-8 py-8 w-full max-w-9xl mx-auto">
        <!-- Page header -->
        <div class="mb-8">
            <div class="mb-4">
                <h1 class="text-2xl md:text-3xl text-slate-800 dark:text-slate-100 font-bold">Generate Contribution Report</h1>
            </div>
        </div>

        <!-- Form -->
        <div class="bg-white dark:bg-slate-800 shadow-lg rounded-sm border border-slate-200 dark:border-slate-700">
            <form action="{{ route('hr.contributions.store') }}" method="POST" class="space-y-6 p-6">
                @csrf

                <!-- Employee Selection -->
                <div class="bg-slate-50 dark:bg-slate-700 rounded-sm">
                    <header class="px-5 py-4 border-b border-slate-200 dark:border-slate-700">
                        <h2 class="font-semibold text-slate-800 dark:text-slate-100">Employee Details</h2>
                    </header>
                    <div class="p-3">
                        <div class="grid grid-cols-12 gap-4">
                            <div class="col-span-12">
                                <label class="block text-sm font-medium mb-1" for="employee_id">Employee</label>
                                <select id="employee_id" name="employee_id" class="form-select w-full" required>
                                    <option value="">Select Employee</option>
                                    @foreach($employees as $employee)
                                        <option value="{{ $employee->id }}">
                                            {{ $employee->name }}
                                            @if($employee->benefits)
                                                (SSS: {{ $employee->benefits['sss'] ?? 'N/A' }}, 
                                                 PhilHealth: {{ $employee->benefits['philhealth'] ?? 'N/A' }}, 
                                                 Pag-IBIG: {{ $employee->benefits['pagibig'] ?? 'N/A' }})
                                            @endif
                                        </option>
                                    @endforeach
                                </select>
                                @error('employee_id')
                                    <p class="mt-1 text-xs text-red-600 dark:text-red-400">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Report Details -->
                <div class="bg-slate-50 dark:bg-slate-700 rounded-sm">
                    <header class="px-5 py-4 border-b border-slate-200 dark:border-slate-700">
                        <h2 class="font-semibold text-slate-800 dark:text-slate-100">Report Details</h2>
                    </header>
                    <div class="p-3">
                        <div class="grid grid-cols-12 gap-4">
                            <div class="col-span-6">
                                <label class="block text-sm font-medium mb-1" for="basic_salary">Basic Salary</label>
                                <div class="flex">
                                    <span class="inline-flex items-center px-3 text-sm text-slate-800 dark:text-slate-100 bg-slate-100 dark:bg-slate-700 border border-r-0 border-slate-200 dark:border-slate-700 rounded-l-md">
                                        ₱
                                    </span>
                                    <input id="basic_salary" name="basic_salary" type="number" step="0.01" 
                                           class="form-input flex-1" required>
                                </div>
                                @error('basic_salary')
                                    <p class="mt-1 text-xs text-red-600 dark:text-red-400">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="col-span-6">
                                <label class="block text-sm font-medium mb-1" for="report_date">Report Date</label>
                                <input id="report_date" name="report_date" type="date" 
                                       class="form-input w-full" required>
                                @error('report_date')
                                    <p class="mt-1 text-xs text-red-600 dark:text-red-400">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Submit Button -->
                <div class="text-right p-6">
                    <button type="submit" class="btn bg-indigo-500 hover:bg-indigo-600 text-white">
                        Generate Report
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
