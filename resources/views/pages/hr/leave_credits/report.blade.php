<x-app-layout>
    <div class="px-4 sm:px-6 lg:px-8 py-8 w-full max-w-9xl mx-auto">
        <div class="sm:flex sm:justify-between sm:items-center mb-8">
            <div class="mb-4 sm:mb-0">
                <h1 class="text-2xl md:text-3xl text-slate-800 dark:text-slate-100 font-bold">Leave Credits Report</h1>
            </div>
            <div class="flex items-center gap-2">
                <button onclick="window.location.href='{{ route('leave-credits.export') }}'" 
                        class="btn bg-indigo-500 hover:bg-indigo-600 text-white">
                    <svg class="w-4 h-4 fill-current opacity-50 shrink-0" viewBox="0 0 16 16">
                        <path d="M14 1H2a1 1 0 0 0-1 1v12a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1zM14 0H2C0.9 0 0 .9 0 2v12c0 1.1.9 2 2 2h12c1.1 0 2-.9 2-2V2c0-1.1-.9-2-2-2z"/>
                        <path d="M14 1H2a1 1 0 0 0-1 1v12a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1zM9 13H7V9h2v4zm0-6H7V3h2v4z"/>
                    </svg>
                    <span class="ml-2">Export Report</span>
                </button>
            </div>
        </div>

        <!-- Summary Section -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-8">
            <div class="bg-white dark:bg-slate-800 shadow-lg rounded-sm border border-slate-200 dark:border-slate-700">
                <div class="p-4">
                    <div class="text-sm font-semibold uppercase text-slate-500 dark:text-slate-400 mb-1">Total Employees</div>
                    <div class="text-2xl font-bold text-slate-800 dark:text-slate-100">{{ $summary['total_employees'] }}</div>
                </div>
            </div>
            <div class="bg-white dark:bg-slate-800 shadow-lg rounded-sm border border-slate-200 dark:border-slate-700">
                <div class="p-4">
                    <div class="text-sm font-semibold uppercase text-slate-500 dark:text-slate-400 mb-1">Total Credits</div>
                    <div class="text-2xl font-bold text-slate-800 dark:text-slate-100">{{ number_format($summary['total_credits']) }}</div>
                </div>
            </div>
            <div class="bg-white dark:bg-slate-800 shadow-lg rounded-sm border border-slate-200 dark:border-slate-700">
                <div class="p-4">
                    <div class="text-sm font-semibold uppercase text-slate-500 dark:text-slate-400 mb-1">Usage Rate</div>
                    <div class="text-2xl font-bold text-slate-800 dark:text-slate-100">{{ number_format($summary['percentage_used'], 1) }}%</div>
                </div>
            </div>
        </div>

        <!-- Filters Section -->
        <div class="bg-white dark:bg-slate-800 shadow-lg rounded-sm border border-slate-200 dark:border-slate-700 mb-8">
            <div class="p-6">
                <form id="filterForm" method="GET" action="{{ route('leave-credits.report') }}">
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                        <div>
                            <label class="block text-sm font-medium mb-2">Leave Type</label>
                            <select name="leave_type" class="form-select w-full" onchange="this.form.submit()">
                                <option value="">All Types</option>
                                <option value="sick" {{ $filters['leave_type'] === 'sick' ? 'selected' : '' }}>Sick Leave</option>
                                <option value="vacation" {{ $filters['leave_type'] === 'vacation' ? 'selected' : '' }}>Vacation Leave</option>
                                <option value="maternity" {{ $filters['leave_type'] === 'maternity' ? 'selected' : '' }}>Maternity Leave</option>
                                <option value="paternity" {{ $filters['leave_type'] === 'paternity' ? 'selected' : '' }}>Paternity Leave</option>
                                <option value="service_incentive" {{ $filters['leave_type'] === 'service_incentive' ? 'selected' : '' }}>Service Incentive Leave</option>
                            </select>
                        </div>
                        <div>
                            <label class="block text-sm font-medium mb-2">Department</label>
                            <select name="department" class="form-select w-full" onchange="this.form.submit()">
                                <option value="">All Departments</option>
                                @foreach($departments as $department)
                                    <option value="{{ $department->name }}" {{ $filters['department'] === $department->name ? 'selected' : '' }}>
                                        {{ $department->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div>
                            <label class="block text-sm font-medium mb-2">Status</label>
                            <select name="status" class="form-select w-full" onchange="this.form.submit()">
                                <option value="">All Statuses</option>
                                <option value="no_credits" {{ $filters['status'] === 'no_credits' ? 'selected' : '' }}>No Credits Assigned</option>
                                <option value="overdrawn" {{ $filters['status'] === 'overdrawn' ? 'selected' : '' }}>Overdrawn Credits</option>
                                <option value="low" {{ $filters['status'] === 'low' ? 'selected' : '' }}>Low Credits</option>
                                <option value="no_remaining" {{ $filters['status'] === 'no_remaining' ? 'selected' : '' }}>No Remaining Credits</option>
                            </select>
                        </div>
                        <div>
                            <label class="block text-sm font-medium mb-2">Date Range</label>
                            <div class="flex gap-2">
                                <input type="date" name="start_date" 
                                       class="form-input w-full" 
                                       value="{{ $filters['start_date'] ?? '' }}">
                                <input type="date" name="end_date" 
                                       class="form-input w-full" 
                                       value="{{ $filters['end_date'] ?? '' }}">
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <!-- Table Section -->
        <div class="bg-white dark:bg-slate-800 shadow-lg rounded-sm border border-slate-200 dark:border-slate-700">
            <div class="p-6">
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Employee</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Department</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Total Credits</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Used Credits</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Remaining Credits</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">SIL Balance (Days)</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">SIL Value</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Percentage Used</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @foreach($employees as $employee)
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $employee['name'] }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $employee['department'] }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $employee['total_credits'] }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $employee['used_credits'] }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $employee['remaining_credits'] }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $employee['sil_balance'] }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">₱{{ number_format($employee['sil_value'], 2) }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ round($employee['percentage_used'], 2) }}%</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full {{ $employee['status'] === 'low' ? 'bg-red-100 text-red-800' : 'bg-green-100 text-green-800' }}">
                                        {{ $employee['status'] === 'low' ? 'Low Balance' : 'Good' }}
                                    </span>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
