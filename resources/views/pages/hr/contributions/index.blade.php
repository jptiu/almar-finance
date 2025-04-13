<x-app-layout>
    <div class="px-4 sm:px-6 lg:px-8 py-8 w-full max-w-9xl mx-auto">
        <!-- Page header -->
        <div class="mb-8">
            <div class="mb-4">
                <h1 class="text-2xl md:text-3xl text-slate-800 dark:text-slate-100 font-bold">Contribution Reports</h1>
            </div>
            <div class="mb-6">
                <a href="{{ route('hr.contributions.create') }}" 
                   class="btn bg-indigo-500 hover:bg-indigo-600 text-white">
                    <svg class="w-4 h-4 fill-current opacity-50 shrink-0" viewBox="0 0 16 16">
                        <path d="M15 7H9V1c0-.6-.4-1-1-1S7 .4 7 1v6H1c-.6 0-1 .4-1 1s.4 1 1 1h6v6c0 .6.4 1 1 1s1-.4 1-1V9h6c.6 0 1-.4 1-1s-.4-1-1-1z" />
                    </svg>
                    <span class="hidden xs:block ml-2">Generate Report</span>
                </a>
            </div>
        </div>

        <!-- Cards -->
        <div class="bg-white dark:bg-slate-800 shadow-lg rounded-sm border border-slate-200 dark:border-slate-700">
            <header class="px-5 py-4 border-b border-slate-100 dark:border-slate-700">
                <h2 class="font-semibold text-slate-800 dark:text-slate-100">Reports List</h2>
            </header>
            <div class="p-3">
                <!-- Error Message -->
                @if(session('error'))
                    <div class="alert bg-red-500 text-white border-l-4 border-red-700 p-4 mb-4 rounded-sm">
                        <p class="text-sm">{{ session('error') }}</p>
                    </div>
                @endif

                <!-- Success Message -->
                @if(session('success'))
                    <div class="alert bg-green-500 text-white border-l-4 border-green-700 p-4 mb-4 rounded-sm">
                        <p class="text-sm">{{ session('success') }}</p>
                    </div>
                @endif

                <!-- Generate Reports Form -->
                <div class="mb-6">
                    <form action="{{ route('hr.contributions.generate') }}" method="POST" class="space-y-4">
                        @csrf
                        <div class="grid grid-cols-12 gap-4">
                            <div class="col-span-6">
                                <label class="block text-sm font-medium mb-1" for="month">Month</label>
                                <select id="month" name="month" class="form-select w-full">
                                    @for ($i = 1; $i <= 12; $i++)
                                        <option value="{{ $i }}" {{ old('month') == $i ? 'selected' : '' }}>
                                            {{ date('F', mktime(0, 0, 0, $i, 1)) }}
                                        </option>
                                    @endfor
                                </select>
                            </div>
                            <div class="col-span-6">
                                <label class="block text-sm font-medium mb-1" for="year">Year</label>
                                <select id="year" name="year" class="form-select w-full">
                                    @php
                                        $currentYear = date('Y');
                                        $startYear = 2020;
                                    @endphp
                                    @for ($i = $currentYear; $i >= $startYear; $i--)
                                        <option value="{{ $i }}" {{ old('year') == $i ? 'selected' : '' }}>
                                            {{ $i }}
                                        </option>
                                    @endfor
                                </select>
                            </div>
                        </div>
                        <button type="submit" class="btn bg-indigo-500 hover:bg-indigo-600 text-white">
                            Generate Reports
                        </button>
                    </form>
                </div>

                <!-- Table -->
                <div class="overflow-x-auto">
                    <table class="table-auto w-full">
                        <!-- Table head -->
                        <thead class="text-xs font-semibold uppercase text-slate-500 dark:text-slate-400 bg-slate-50 dark:bg-slate-700">
                            <tr>
                                <th class="p-2 whitespace-nowrap">
                                    <div class="font-semibold text-left">Employee</div>
                                </th>
                                <th class="p-2 whitespace-nowrap">
                                    <div class="font-semibold text-left">Report Date</div>
                                </th>
                                <th class="p-2 whitespace-nowrap">
                                    <div class="font-semibold text-left">Total Employee Contribution</div>
                                </th>
                                <th class="p-2 whitespace-nowrap">
                                    <div class="font-semibold text-left">Total Employer Contribution</div>
                                </th>
                                <th class="p-2 whitespace-nowrap">
                                    <div class="font-semibold text-left">Total Contribution</div>
                                </th>
                                <th class="p-2 whitespace-nowrap">
                                    <div class="font-semibold text-left">Actions</div>
                                </th>
                            </tr>
                        </thead>
                        <!-- Table body -->
                        <tbody class="text-sm divide-y divide-slate-200 dark:divide-slate-700">
                            @foreach($reports as $report)
                            <tr>
                                <td class="p-2 whitespace-nowrap">
                                    <div class="text-left">
                                        {{ $report->employee->name }}
                                        <div class="text-xs text-slate-500 dark:text-slate-400">
                                            SSS: {{ $report->sss_number }}<br>
                                            PhilHealth: {{ $report->philhealth_number }}<br>
                                            Pag-IBIG: {{ $report->pagibig_number }}
                                        </div>
                                    </div>
                                </td>
                                <td class="p-2 whitespace-nowrap">
                                    <div class="text-left">{{ $report->report_date->format('M d, Y') }}</div>
                                </td>
                                <td class="p-2 whitespace-nowrap">
                                    <div class="text-left">₱{{ number_format($report->total_employee_contribution, 2) }}</div>
                                </td>
                                <td class="p-2 whitespace-nowrap">
                                    <div class="text-left">₱{{ number_format($report->total_employer_contribution, 2) }}</div>
                                </td>
                                <td class="p-2 whitespace-nowrap">
                                    <div class="text-left">₱{{ number_format($report->total_contribution, 2) }}</div>
                                </td>
                                <td class="p-2 whitespace-nowrap">
                                    <div class="text-left">
                                        <div class="flex items-center space-x-2">
                                            <a href="{{ route('hr.contributions.print', $report) }}" class="text-green-500 hover:text-green-600">
                                                <svg class="w-4 h-4 fill-current" viewBox="0 0 16 16">
                                                    <path d="M2.5 8a.5.5 0 0 0-.5.5v3a.5.5 0 0 0 .5.5h10a.5.5 0 0 0 .5-.5v-3a.5.5 0 0 0-.5-.5h-10ZM3 1a2 2 0 0 0-2 2v1h16V3a2 2 0 0 0-2-2H3ZM11 5.5a.5.5 0 0 1 .5-.5h4a.5.5 0 0 1 0 1h-4a.5.5 0 0 1-.5-.5Z"/>
                                                </svg>
                                            </a>
                                        </div>
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
