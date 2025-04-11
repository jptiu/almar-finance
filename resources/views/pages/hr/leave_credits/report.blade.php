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
                    <table class="table-auto w-full dark:text-slate-300">
                        <thead class="text-xs font-semibold uppercase text-slate-500 dark:text-slate-400 bg-slate-50 dark:bg-slate-700 dark:bg-opacity-50">
                            <tr>
                                <th class="p-2 whitespace-nowrap">
                                    <div class="font-semibold text-left">
                                        <a href="{{ route('leave-credits.report', array_merge($filters, ['sort' => 'name', 'direction' => $sort === 'name' && $direction === 'asc' ? 'desc' : 'asc'])) }}" 
                                           class="flex items-center">
                                            Employee
                                            @if($sort === 'name')
                                                <svg class="w-4 h-4 ml-1" viewBox="0 0 24 24">
                                                    <path fill="currentColor" d="M7.41,8.58L12,13.17L16.59,8.58L18,10L12,16L6,10L7.41,8.58Z"/>
                                                </svg>
                                            @endif
                                        </a>
                                    </div>
                                </th>
                                <th class="p-2 whitespace-nowrap">
                                    <div class="font-semibold text-left">
                                        <a href="{{ route('leave-credits.report', array_merge($filters, ['sort' => 'department', 'direction' => $sort === 'department' && $direction === 'asc' ? 'desc' : 'asc'])) }}" 
                                           class="flex items-center">
                                            Department
                                            @if($sort === 'department')
                                                <svg class="w-4 h-4 ml-1" viewBox="0 0 24 24">
                                                    <path fill="currentColor" d="M7.41,8.58L12,13.17L16.59,8.58L18,10L12,16L6,10L7.41,8.58Z"/>
                                                </svg>
                                            @endif
                                        </a>
                                    </div>
                                </th>
                                <th class="p-2 whitespace-nowrap">
                                    <div class="font-semibold text-left">
                                        <a href="{{ route('leave-credits.report', array_merge($filters, ['sort' => 'total_credits', 'direction' => $sort === 'total_credits' && $direction === 'asc' ? 'desc' : 'asc'])) }}" 
                                           class="flex items-center">
                                            Total Credits
                                            @if($sort === 'total_credits')
                                                <svg class="w-4 h-4 ml-1" viewBox="0 0 24 24">
                                                    <path fill="currentColor" d="M7.41,8.58L12,13.17L16.59,8.58L18,10L12,16L6,10L7.41,8.58Z"/>
                                                </svg>
                                            @endif
                                        </a>
                                    </div>
                                </th>
                                <th class="p-2 whitespace-nowrap">
                                    <div class="font-semibold text-left">
                                        <a href="{{ route('leave-credits.report', array_merge($filters, ['sort' => 'used_credits', 'direction' => $sort === 'used_credits' && $direction === 'asc' ? 'desc' : 'asc'])) }}" 
                                           class="flex items-center">
                                            Used Credits
                                            @if($sort === 'used_credits')
                                                <svg class="w-4 h-4 ml-1" viewBox="0 0 24 24">
                                                    <path fill="currentColor" d="M7.41,8.58L12,13.17L16.59,8.58L18,10L12,16L6,10L7.41,8.58Z"/>
                                                </svg>
                                            @endif
                                        </a>
                                    </div>
                                </th>
                                <th class="p-2 whitespace-nowrap">
                                    <div class="font-semibold text-left">
                                        <a href="{{ route('leave-credits.report', array_merge($filters, ['sort' => 'remaining_credits', 'direction' => $sort === 'remaining_credits' && $direction === 'asc' ? 'desc' : 'asc'])) }}" 
                                           class="flex items-center">
                                            Remaining Credits
                                            @if($sort === 'remaining_credits')
                                                <svg class="w-4 h-4 ml-1" viewBox="0 0 24 24">
                                                    <path fill="currentColor" d="M7.41,8.58L12,13.17L16.59,8.58L18,10L12,16L6,10L7.41,8.58Z"/>
                                                </svg>
                                            @endif
                                        </a>
                                    </div>
                                </th>
                                <th class="p-2 whitespace-nowrap">
                                    <div class="font-semibold text-left">
                                        <a href="{{ route('leave-credits.report', array_merge($filters, ['sort' => 'percentage_used', 'direction' => $sort === 'percentage_used' && $direction === 'asc' ? 'desc' : 'asc'])) }}" 
                                           class="flex items-center">
                                            Usage %
                                            @if($sort === 'percentage_used')
                                                <svg class="w-4 h-4 ml-1" viewBox="0 0 24 24">
                                                    <path fill="currentColor" d="M7.41,8.58L12,13.17L16.59,8.58L18,10L12,16L6,10L7.41,8.58Z"/>
                                                </svg>
                                            @endif
                                        </a>
                                    </div>
                                </th>
                                <th class="p-2 whitespace-nowrap">
                                    <div class="font-semibold text-left">Status</div>
                                </th>
                                <th class="p-2 whitespace-nowrap">
                                    <div class="font-semibold text-left">Leave Types</div>
                                </th>
                            </tr>
                        </thead>
                        <tbody class="text-sm divide-y divide-slate-200 dark:divide-slate-700">
                            @foreach($employees as $employee)
                                <tr>
                                    <td class="p-2 whitespace-nowrap">
                                        <div class="text-left">{{ $employee['name'] }}</div>
                                    </td>
                                    <td class="p-2 whitespace-nowrap">
                                        <div class="text-left">{{ $employee['department'] }}</div>
                                    </td>
                                    <td class="p-2 whitespace-nowrap">
                                        <div class="text-left">{{ $employee['total_credits'] }}</div>
                                    </td>
                                    <td class="p-2 whitespace-nowrap">
                                        <div class="text-left">{{ $employee['used_credits'] }}</div>
                                    </td>
                                    <td class="p-2 whitespace-nowrap">
                                        <div class="text-left">{{ $employee['remaining_credits'] }}</div>
                                    </td>
                                    <td class="p-2 whitespace-nowrap">
                                        <div class="flex items-center">
                                            <div class="w-full bg-slate-200 dark:bg-slate-700 rounded-full h-2.5">
                                                <div class="bg-emerald-600 h-2.5 rounded-full" style="width: {{ $employee['percentage_used'] }}%"></div>
                                            </div>
                                            <div class="ml-2">{{ number_format($employee['percentage_used'], 1) }}%</div>
                                        </div>
                                    </td>
                                    <td class="p-2 whitespace-nowrap">
                                        <div class="inline-flex font-medium rounded-full text-center px-2.5 py-0.5 
                                            @switch($employee['status'])
                                                @case('No credits assigned')
                                                    bg-slate-100 text-slate-800
                                                    @break
                                                @case('Overdrawn credits')
                                                    bg-red-100 text-red-800
                                                    @break
                                                @case('No credits remaining')
                                                    bg-red-100 text-red-800
                                                    @break
                                                @case('Low credits remaining')
                                                    bg-yellow-100 text-yellow-800
                                                    @break
                                                @default
                                                    bg-emerald-100 text-emerald-600
                                            @endswitch">
                                            {{ $employee['status'] }}
                                        </div>
                                    </td>
                                    <td class="p-2 whitespace-nowrap">
                                        <div class="text-left">
                                            @foreach($employee['leave_types'] as $type)
                                                <div class="flex items-center gap-2">
                                                    <span class="text-sm">{{ $type['leave_type'] }}:</span>
                                                    <span class="text-sm">{{ $type['remaining_credits'] }}</span>
                                                    <div class="inline-flex font-medium rounded-full text-center px-2.5 py-0.5 
                                                        @switch($type['status'])
                                                            @case('No credits assigned')
                                                                bg-slate-100 text-slate-800
                                                                @break
                                                            @case('Overdrawn credits')
                                                                bg-red-100 text-red-800
                                                                @break
                                                            @case('No credits remaining')
                                                                bg-red-100 text-red-800
                                                                @break
                                                            @case('Low credits remaining')
                                                                bg-yellow-100 text-yellow-800
                                                                @break
                                                            @default
                                                                bg-emerald-100 text-emerald-600
                                                        @endswitch">
                                                        {{ $type['status'] }}
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
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
