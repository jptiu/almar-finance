<x-app-layout>
    <div class="px-4 sm:px-6 lg:px-8 py-8 w-full max-w-9xl mx-auto">
        <div class="sm:flex sm:justify-between sm:items-center mb-8">
            <div class="mb-4 sm:mb-0">
                <h1 class="text-2xl md:text-3xl text-slate-800 dark:text-slate-100 font-bold">Employee Salaries</h1>
            </div>
            <div class="grid grid-flow-col sm:auto-cols-max justify-start sm:justify-end gap-2">
                <a href="{{ route('salaries.create') }}" class="btn bg-indigo-500 hover:bg-indigo-600 text-white">
                    <svg class="w-4 h-4 fill-current opacity-50 shrink-0" viewBox="0 0 16 16">
                        <path d="M15 7H9V1c0-.6-.4-1-1-1S7 .4 7 1v6H1c-.6 0-1 .4-1 1s.4 1 1 1h6v6c0 .6.4 1 1 1s1-.4 1-1V9h6c.6 0 1-.4 1-1s-.4-1-1-1z" />
                    </svg>
                    <span class="hidden xs:block ml-2">Add New Salary</span>
                </a>
            </div>
        </div>

        <div class="bg-white dark:bg-slate-800 shadow-lg rounded-sm border border-slate-200 dark:border-slate-700">
            <div class="p-3">
                <div class="overflow-x-auto">
                    <table class="table-auto w-full dark:text-slate-300">
                        <thead class="text-xs font-semibold uppercase text-slate-500 dark:text-slate-400 bg-slate-50 dark:bg-slate-700 dark:bg-opacity-50">
                            <tr>
                                <th class="p-2 whitespace-nowrap">
                                    <div class="font-semibold text-left">Employee</div>
                                </th>
                                <th class="p-2 whitespace-nowrap">
                                    <div class="font-semibold text-left">Basic Salary</div>
                                </th>
                                <th class="p-2 whitespace-nowrap">
                                    <div class="font-semibold text-left">Daily Rate</div>
                                </th>
                                <th class="p-2 whitespace-nowrap">
                                    <div class="font-semibold text-left">Overtime Rate</div>
                                </th>
                                <th class="p-2 whitespace-nowrap">
                                    <div class="font-semibold text-left">Effective Date</div>
                                </th>
                                <th class="p-2 whitespace-nowrap">
                                    <div class="font-semibold text-left">Status</div>
                                </th>
                                <th class="p-2 whitespace-nowrap">
                                    <div class="font-semibold text-center">Actions</div>
                                </th>
                            </tr>
                        </thead>
                        <tbody class="text-sm divide-y divide-slate-200 dark:divide-slate-700">
                            @foreach($employees as $employee)
                                @php
                                    $currentSalary = $employee->salaries->first();
                                @endphp
                                <tr>
                                    <td class="p-2 whitespace-nowrap">
                                        <div class="flex items-center">
                                            <div class="font-medium text-slate-800 dark:text-slate-100">{{ $employee->name }}</div>
                                        </div>
                                    </td>
                                    <td class="p-2 whitespace-nowrap">
                                        <div class="text-left">₱{{ number_format($currentSalary?->basic_salary ?? 0, 2) }}</div>
                                    </td>
                                    <td class="p-2 whitespace-nowrap">
                                        <div class="text-left">₱{{ number_format($currentSalary?->daily_rate ?? 0, 2) }}</div>
                                    </td>
                                    <td class="p-2 whitespace-nowrap">
                                        <div class="text-left">₱{{ number_format($currentSalary?->overtime_rate ?? ($currentSalary?->daily_rate ?? 0) / 8 * 1.25, 2) }}</div>
                                    </td>
                                    <td class="p-2 whitespace-nowrap">
                                        <div class="text-left">{{ $currentSalary ? $currentSalary->effective_date->format('M d, Y') : 'Not set' }}</div>
                                    </td>
                                    <td class="p-2 whitespace-nowrap">
                                        @if($currentSalary)
                                            <div class="inline-flex font-medium rounded-full text-center px-2.5 py-0.5 bg-emerald-100 text-emerald-600">Active</div>
                                        @else
                                            <div class="inline-flex font-medium rounded-full text-center px-2.5 py-0.5 bg-slate-100 text-slate-500">Not Set</div>
                                        @endif
                                    </td>
                                    <td class="p-2 whitespace-nowrap">
                                        <div class="text-center space-x-2">
                                            @if($currentSalary)
                                                <a href="{{ route('salaries.edit', $currentSalary->id) }}" class="text-indigo-500 hover:text-indigo-600">
                                                    <span>Edit</span>
                                                </a>
                                            @endif
                                            <a href="{{ route('salaries.history', $employee->id) }}" class="text-slate-400 hover:text-slate-500">
                                                <span>History</span>
                                            </a>
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
