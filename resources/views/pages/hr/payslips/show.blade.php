<x-app-layout>
    <div class="container mx-auto px-4 py-8">
        <div class="max-w-4xl mx-auto bg-white dark:bg-gray-800 rounded-lg shadow-lg overflow-hidden">
            <div class="p-6">
                <div class="header mb-8">
                    <div class="company-info text-center">
                        <h1 class="text-2xl font-bold text-gray-900 dark:text-gray-100 mb-2">ALMAR FREEMILE FINANCE CORP</h1>
                        <p class="text-gray-600 dark:text-gray-400">{{ $payslip->employee->branch->location ?? 'Manila, Philippines' }}</p>
                    </div>
                </div>

                <div class="payslip-info mb-8">
                    <h2 class="text-xl font-bold text-gray-900 dark:text-gray-100 mb-4">Payslip</h2>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <p class="font-medium text-gray-600 dark:text-gray-400">Employee Name:</p>
                            <p class="text-gray-900 dark:text-gray-100">{{ $payslip->employee->name }}</p>
                        </div>
                        <div>
                            <p class="font-medium text-gray-600 dark:text-gray-400">Employee ID:</p>
                            <p class="text-gray-900 dark:text-gray-100">{{ $payslip->employee->id }}</p>
                        </div>
                        <div>
                            <p class="font-medium text-gray-600 dark:text-gray-400">Pay Period:</p>
                            <p class="text-gray-900 dark:text-gray-100">
                                {{ $payslip->pay_period_start->format('M d') }} - {{ $payslip->pay_period_end->format('M d') }}
                            </p>
                        </div>
                        <div>
                            <p class="font-medium text-gray-600 dark:text-gray-400">Date:</p>
                            <p class="text-gray-900 dark:text-gray-100">{{ now()->format('M d, Y') }}</p>
                        </div>
                    </div>
                </div>

                <div class="grid grid-cols-2 gap-6">
                    <div>
                        <h3 class="text-lg font-semibold mb-4">Earnings</h3>
                        <div class="space-y-2">
                            <div class="flex justify-between">
                                <span>Basic Salary</span>
                                <span>₱{{ number_format($payslip->basic_salary, 2) }}</span>
                            </div>
                            <div class="flex justify-between">
                                <span>Overtime Pay</span>
                                <span>₱{{ number_format($payslip->overtime_pay, 2) }}</span>
                            </div>
                            <div class="flex justify-between">
                                <span>Allowances</span>
                                <span>₱{{ number_format($payslip->allowances, 2) }}</span>
                            </div>
                            @if($payslip->thirteenth_month_pay > 0)
                            <div class="flex justify-between">
                                <span>13th Month Pay</span>
                                <span>₱{{ number_format($payslip->thirteenth_month_pay, 2) }}</span>
                            </div>
                            @endif
                            <div class="flex justify-between">
                                <span>Total Earnings</span>
                                <span class="font-semibold">₱{{ number_format($payslip->calculateTotalEarnings(), 2) }}</span>
                            </div>
                        </div>
                    </div>
                    <div>
                        <h3 class="text-lg font-semibold mb-4">Deductions</h3>
                        <div class="space-y-2">
                            <div class="flex justify-between">
                                <span>Tax Deduction</span>
                                <span>₱{{ number_format($payslip->tax_deduction, 2) }}</span>
                            </div>
                            <div class="flex justify-between">
                                <span>Cash Advance</span>
                                <span>₱{{ number_format($payslip->cash_advance, 2) }}</span>
                            </div>
                            <div class="flex justify-between">
                                <span>Other Deductions</span>
                                <span>₱{{ number_format($payslip->other_deductions, 2) }}</span>
                            </div>
                            <div class="flex justify-between">
                                <span>Total Deductions</span>
                                <span class="font-semibold">₱{{ number_format($payslip->calculateTotalDeductions(), 2) }}</span>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="mt-8 p-6 bg-gray-50 rounded-lg">
                    <h3 class="text-lg font-semibold mb-4">Service Incentive Leave (SIL)</h3>
                    <div class="space-y-2">
                        <div class="flex justify-between">
                            <span>Remaining SIL Days</span>
                            <span>{{ $payslip->remaining_sil_days }} days</span>
                        </div>
                        <div class="flex justify-between">
                            <span>SIL Value</span>
                            <span>₱{{ number_format($payslip->sil_value, 2) }}</span>
                        </div>
                    </div>
                </div>

                <div class="mt-8 p-6 bg-gray-50 rounded-lg">
                    <div class="flex justify-between font-semibold">
                        <span>Net Pay</span>
                        <span class="text-2xl">₱{{ number_format($payslip->net_pay, 2) }}</span>
                    </div>
                </div>

                <div class="mt-8 border-t border-gray-200 dark:border-gray-700 pt-6">
                    <div class="flex justify-between items-center">
                        <div class="text-lg font-bold text-gray-900 dark:text-gray-100">
                            <p>Net Pay: {{ number_format($payslip->net_pay, 2) }}</p>
                        </div>
                        <div class="flex space-x-4">
                            <a href="{{ route('payslips.download', $payslip->id) }}" 
                               class="px-4 py-2 bg-green-500 text-white rounded hover:bg-green-600"
                            >
                                Download PDF
                            </a>
                            @if(auth()->user()->can('admin_access'))
                                <a href="{{ route('payslips.edit', $payslip->id) }}" 
                                   class="px-4 py-2 bg-yellow-500 text-white rounded hover:bg-yellow-600"
                                >
                                    Edit
                                </a>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
