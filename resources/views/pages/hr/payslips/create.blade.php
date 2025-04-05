<x-app-layout>
    <div class="px-4 sm:px-6 lg:px-8 py-8 w-full max-w-9xl mx-auto">
        <!-- Page header -->
        <div class="mb-8">
            <div class="mb-4">
                <h1 class="text-2xl md:text-3xl text-slate-800 dark:text-slate-100 font-bold">Create Payslip</h1>
            </div>
        </div>

        <!-- Form -->
        <form action="{{ route('payslips.store') }}" method="POST" class="space-y-6">
            @csrf

            <!-- Employee Selection -->
            <div class="bg-white dark:bg-slate-800 shadow-lg rounded-sm border border-slate-200 dark:border-slate-700">
                <header class="px-5 py-4 border-b border-slate-200 dark:border-slate-700">
                    <h2 class="font-semibold text-slate-800 dark:text-slate-100">Employee Details</h2>
                </header>
                <div class="p-3">
                    <div class="grid grid-cols-12 gap-4">
                        <div class="col-span-12">
                            <label class="block text-sm font-medium mb-1" for="employee_id">Employee</label>
                            <select id="employee_id" name="employee_id" class="form-select w-full"
                                onchange="updateOvertimeHours()">
                                <option value="">Select Employee</option>
                                @foreach ($employees as $employee)
                                    <option value="{{ $employee->id }}"
                                        {{ old('employee_id') == $employee->id ? 'selected' : '' }}>
                                        {{ $employee->name }}
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

            <!-- Pay Period -->
            <div class="bg-white dark:bg-slate-800 shadow-lg rounded-sm border border-slate-200 dark:border-slate-700">
                <header class="px-5 py-4 border-b border-slate-200 dark:border-slate-700">
                    <h2 class="font-semibold text-slate-800 dark:text-slate-100">Pay Period</h2>
                </header>
                <div class="p-3">
                    <div class="grid grid-cols-12 gap-4">
                        <div class="col-span-6">
                            <label class="block text-sm font-medium mb-1" for="pay_period_start">Start Date</label>
                            <input id="pay_period_start" name="pay_period_start" type="date"
                                class="form-input w-full" onchange="updateOvertimeHours()" required>
                            @error('pay_period_start')
                                <p class="mt-1 text-xs text-red-600 dark:text-red-400">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="col-span-6">
                            <label class="block text-sm font-medium mb-1" for="pay_period_end">End Date</label>
                            <input id="pay_period_end" name="pay_period_end" type="date" class="form-input w-full"
                                onchange="updateOvertimeHours()" required>
                            @error('pay_period_end')
                                <p class="mt-1 text-xs text-red-600 dark:text-red-400">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>

            <!-- Salary Details -->
            <div class="bg-white dark:bg-slate-800 shadow-lg rounded-sm border border-slate-200 dark:border-slate-700">
                <header class="px-5 py-4 border-b border-slate-200 dark:border-slate-700">
                    <h2 class="font-semibold text-slate-800 dark:text-slate-100">Salary Details</h2>
                </header>
                <div class="p-3">
                    <div class="grid grid-cols-12 gap-4">
                        <div class="col-span-6">
                            <label class="block text-sm font-medium mb-1" for="basic_salary">Basic Salary</label>
                            <input id="basic_salary" name="basic_salary" type="number" step="0.01"
                                class="form-input w-full" required>
                            @error('basic_salary')
                                <p class="mt-1 text-xs text-red-600 dark:text-red-400">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="col-span-6">
                            <label class="block text-sm font-medium mb-1" for="total_hours">Total Hours</label>
                            <input id="total_hours" name="total_hours" type="number" step="0.01"
                                class="form-input w-full" required>
                            @error('total_hours')
                                <p class="mt-1 text-xs text-red-600 dark:text-red-400">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="col-span-6">
                            <label class="block text-sm font-medium mb-1" for="overtime_hours">Overtime Hours</label>
                            <input id="overtime_hours" name="overtime_hours" type="number" step="0.01"
                                class="form-input w-full @error('overtime_hours') border-red-500 @enderror" readonly>
                            @error('overtime_hours')
                                <p class="mt-1 text-xs text-red-600 dark:text-red-400">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="col-span-6">
                            <label class="block text-sm font-medium mb-1">Approved Overtime Requests</label>
                            <div id="approved-overtime" class="space-y-2">
                                @if (isset($approvedOvertime) && $approvedOvertime->isNotEmpty())
                                    @foreach ($approvedOvertime as $overtime)
                                        <div
                                            class="flex items-center justify-between bg-slate-50 dark:bg-slate-700 px-3 py-2 rounded">
                                            <div>
                                                <span class="text-sm">{{ $overtime->date->format('M d, Y') }}</span>
                                                <br>
                                                <span class="text-xs text-slate-500">{{ $overtime->hours_requested }}
                                                    hours</span>
                                            </div>
                                            <div class="text-xs text-green-500">
                                                {{ ucfirst($overtime->status) }}
                                            </div>
                                        </div>
                                    @endforeach
                                @else
                                    <div class="text-sm text-slate-500">No approved overtime requests for this period
                                    </div>
                                @endif
                            </div>
                        </div>
                        <div class="col-span-6">
                            <label class="block text-sm font-medium mb-1" for="allowances">Allowances</label>
                            <input id="allowances" name="allowances" type="number" step="0.01"
                                class="form-input w-full">
                            @error('allowances')
                                <p class="mt-1 text-xs text-red-600 dark:text-red-400">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="col-span-6">
                            <label class="block text-sm font-medium mb-1" for="net_pay">Net Pay</label>
                            <input id="net_pay" name="net_pay" type="number" step="0.01"
                                class="form-input w-full" readonly>
                            @error('net_pay')
                                <p class="mt-1 text-xs text-red-600 dark:text-red-400">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="col-span-6">
                            <label class="block text-sm font-medium mb-1" for="status">Status</label>
                            <select id="status" name="status" class="form-select w-full" required>
                                <option value="draft">Draft</option>
                                <option value="processed">Processed</option>
                                <option value="paid">Paid</option>
                            </select>
                            @error('status')
                                <p class="mt-1 text-xs text-red-600 dark:text-red-400">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>

            <!-- Notes -->
            <div class="bg-white dark:bg-slate-800 shadow-lg rounded-sm border border-slate-200 dark:border-slate-700">
                <header class="px-5 py-4 border-b border-slate-200 dark:border-slate-700">
                    <h2 class="font-semibold text-slate-800 dark:text-slate-100">Notes</h2>
                </header>
                <div class="p-3">
                    <div class="grid grid-cols-12 gap-4">
                        <div class="col-span-12">
                            <label class="block text-sm font-medium mb-1" for="notes">Notes</label>
                            <textarea id="notes" name="notes" rows="3" class="form-textarea w-full"></textarea>
                            @error('notes')
                                <p class="mt-1 text-xs text-red-600 dark:text-red-400">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>

            <!-- Submit Button -->
            <div class="text-right">
                <button type="submit" class="btn bg-indigo-500 hover:bg-indigo-600 text-white">
                    Create Payslip
                </button>
            </div>
        </form>
    </div>
</x-app-layout>

<script>
    // Add CSRF token to headers
    const csrfToken = document.querySelector('meta[name="csrf-token"]').content;
    
    async function fetchWorkingHours(employeeId, startDate, endDate) {
        try {
            const response = await fetch(`{{ route('payslips.get-working-hours') }}`, {
                method: 'POST',
                headers: {
                    'Accept': 'application/json',
                    'Content-Type': 'application/json',
                    'X-Requested-With': 'XMLHttpRequest',
                    'X-CSRF-TOKEN': csrfToken
                },
                credentials: 'same-origin',
                body: JSON.stringify({
                    employee_id: employeeId,
                    start_date: startDate,
                    end_date: endDate
                })
            });
            
            const data = await response.json();
            
            if (!response.ok || !data.success) {
                throw new Error(data.message || `HTTP error! status: ${response.status}`);
            }

            document.getElementById('total_hours').value = data.total_working_hours;

        } catch (error) {
            console.error('Error fetching working hours:', error);
            document.getElementById('total_hours').value = '';
        }
    }

    async function updateOvertimeHours() {
        try {
            const employeeId = document.getElementById('employee_id').value;
            const startDate = document.getElementById('pay_period_start').value;
            const endDate = document.getElementById('pay_period_end').value;

            if (!employeeId || !startDate || !endDate) {
                document.getElementById('overtime_hours').value = '';
                document.getElementById('approved-overtime').innerHTML = 
                    '<div class="text-sm text-slate-500">Please select employee and pay period dates</div>';
                document.getElementById('total_hours').value = '';
                return;
            }

            // Show loading state
            document.getElementById('approved-overtime').innerHTML = 
                '<div class="text-sm text-slate-500">Loading overtime data...</div>';

            // Fetch working hours first
            await fetchWorkingHours(employeeId, startDate, endDate);

            // Make AJAX request to get overtime hours
            const response = await fetch(`{{ route('payslips.get-overtime-hours') }}`, {
                method: 'POST',
                headers: {
                    'Accept': 'application/json',
                    'Content-Type': 'application/json',
                    'X-Requested-With': 'XMLHttpRequest',
                    'X-CSRF-TOKEN': csrfToken
                },
                credentials: 'same-origin',
                body: JSON.stringify({
                    employee_id: employeeId,
                    start_date: startDate,
                    end_date: endDate
                })
            });
            
            const data = await response.json();

            if (!response.ok || !data.success) {
                throw new Error(data.message || `HTTP error! status: ${response.status}`);
            }

            document.getElementById('overtime_hours').value = data.total_hours;

            // Update the approved overtime requests display
            const approvedOvertime = data.approved_overtime || [];
            const overtimeContainer = document.getElementById('approved-overtime');

            if (approvedOvertime.length === 0) {
                overtimeContainer.innerHTML = 
                    '<div class="text-sm text-slate-500">No approved overtime requests for this period</div>';
                return;
            }

            const overtimeHtml = approvedOvertime.map(ot => `
                <div class="flex items-center justify-between bg-slate-50 dark:bg-slate-700 px-3 py-2 rounded">
                    <div>
                        <span class="text-sm">${new Date(ot.date).toLocaleDateString()}</span>
                        <br>
                        <span class="text-xs text-slate-500">${ot.hours_requested} hours</span>
                    </div>
                    <div class="text-xs text-green-500">
                        ${ot.status.charAt(0).toUpperCase() + ot.status.slice(1)}
                    </div>
                </div>
            `).join('');

            overtimeContainer.innerHTML = overtimeHtml;

        } catch (error) {
            console.error('Error fetching overtime data:', error);
            document.getElementById('overtime_hours').value = '';
            document.getElementById('approved-overtime').innerHTML = 
                `<div class="text-sm text-red-500">Error loading overtime data: ${error.message}</div>`;
        }
    }

    // Initialize the form
    document.addEventListener('DOMContentLoaded', function() {
        // Check if we have old values from a previous submission
        const oldEmployeeId = '{{ old('employee_id') }}';
        const oldStartDate = '{{ old('pay_period_start') }}';
        const oldEndDate = '{{ old('pay_period_end') }}';
        
        if (oldEmployeeId && oldStartDate && oldEndDate) {
            updateOvertimeHours();
        }

        // Add event listeners for form changes
        document.getElementById('employee_id').addEventListener('change', updateOvertimeHours);
        document.getElementById('pay_period_start').addEventListener('change', updateOvertimeHours);
        document.getElementById('pay_period_end').addEventListener('change', updateOvertimeHours);
    });
</script>
