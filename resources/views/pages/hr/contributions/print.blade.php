<x-app-layout>
    <div class="px-4 sm:px-6 lg:px-8 py-8 w-full max-w-9xl mx-auto">
        <!-- Print Header -->
        <div class="mb-8">
            <div class="mb-4">
                <h1 class="text-2xl md:text-3xl text-slate-800 dark:text-slate-100 font-bold">Contribution Report</h1>
                <p class="text-slate-500 dark:text-slate-400">Report Date: {{ $report->report_date->format('F j, Y') }}</p>
            </div>
        </div>

        <!-- Report Details -->
        <div class="bg-white dark:bg-slate-800 shadow-lg rounded-sm border border-slate-200 dark:border-slate-700">
            <div class="p-6">
                <!-- Employee Information -->
                <div class="mb-6">
                    <h2 class="text-lg font-semibold mb-4">Employee Information</h2>
                    <div class="grid grid-cols-1 gap-4">
                        <div>
                            <div class="font-semibold">Name:</div>
                            <div>{{ $report->employee->name }}</div>
                        </div>
                        <div>
                            <div class="font-semibold">SSS Number:</div>
                            <div>{{ $report->sss_number }}</div>
                        </div>
                        <div>
                            <div class="font-semibold">PhilHealth Number:</div>
                            <div>{{ $report->philhealth_number }}</div>
                        </div>
                        <div>
                            <div class="font-semibold">Pag-IBIG Number:</div>
                            <div>{{ $report->pagibig_number }}</div>
                        </div>
                    </div>
                </div>

                <!-- Contribution Breakdown -->
                <div class="mb-6">
                    <h2 class="text-lg font-semibold mb-4">Contribution Breakdown</h2>
                    <div class="grid grid-cols-1 gap-4">
                        <div>
                            <h3 class="font-semibold mb-2">SSS</h3>
                            <div class="grid grid-cols-2 gap-4">
                                <div>
                                    <div class="font-semibold">Employee Contribution:</div>
                                    <div>₱{{ number_format($report->sss_employee_contribution, 2) }}</div>
                                </div>
                                <div>
                                    <div class="font-semibold">Employer Contribution:</div>
                                    <div>₱{{ number_format($report->sss_employer_contribution, 2) }}</div>
                                </div>
                            </div>
                        </div>
                        <div>
                            <h3 class="font-semibold mb-2">PhilHealth</h3>
                            <div class="grid grid-cols-2 gap-4">
                                <div>
                                    <div class="font-semibold">Employee Contribution:</div>
                                    <div>₱{{ number_format($report->philhealth_employee_contribution, 2) }}</div>
                                </div>
                                <div>
                                    <div class="font-semibold">Employer Contribution:</div>
                                    <div>₱{{ number_format($report->philhealth_employer_contribution, 2) }}</div>
                                </div>
                            </div>
                        </div>
                        <div>
                            <h3 class="font-semibold mb-2">Pag-IBIG</h3>
                            <div class="grid grid-cols-2 gap-4">
                                <div>
                                    <div class="font-semibold">Employee Contribution:</div>
                                    <div>₱{{ number_format($report->pagibig_employee_contribution, 2) }}</div>
                                </div>
                                <div>
                                    <div class="font-semibold">Employer Contribution:</div>
                                    <div>₱{{ number_format($report->pagibig_employer_contribution, 2) }}</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Totals -->
                <div class="border-t border-slate-200 dark:border-slate-700 pt-6">
                    <h2 class="text-lg font-semibold mb-4">Totals</h2>
                    <div class="grid grid-cols-3 gap-4">
                        <div>
                            <div class="font-semibold">Total Employee Contribution:</div>
                            <div class="text-xl font-bold">₱{{ number_format($report->total_employee_contribution, 2) }}</div>
                        </div>
                        <div>
                            <div class="font-semibold">Total Employer Contribution:</div>
                            <div class="text-xl font-bold">₱{{ number_format($report->total_employer_contribution, 2) }}</div>
                        </div>
                        <div>
                            <div class="font-semibold">Total Contribution:</div>
                            <div class="text-xl font-bold">₱{{ number_format($report->total_contribution, 2) }}</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
