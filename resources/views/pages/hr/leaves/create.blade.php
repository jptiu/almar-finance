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
                            <label class="block text-sm font-medium mb-1">Employee</label>
                            <div class="flex items-center bg-gray-50 dark:bg-slate-700 rounded-md p-2">
                                <input type="hidden" name="employee_id" value="{{ auth()->user()->id }}">
                                <span class="text-gray-700 dark:text-gray-300">{{ auth()->user()->name }}</span>
                            </div>
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
                            <label class="block text-sm font-medium mb-1" for="leave_type">Leave Type <span class="text-rose-500">*</span></label>
                            <select id="leave_type" name="leave_type" class="form-select w-full" required>
                                <option value="">Select Leave Type</option>
                                <option value="sick">Sick Leave</option>
                                <option value="vacation">Vacation Leave</option>
                                <option value="maternity">Maternity Leave</option>
                                <option value="paternity">Paternity Leave</option>
                                <option value="service_incentive">Service Incentive</option>
                            </select>
                            @error('leave_type')
                                <div class="text-xs mt-1 text-rose-500">{{ $message }}</div>
                            @enderror
                        </div>
                        <div id="leaveCredits" class="mt-2 text-sm text-slate-400 col-span-6">
                            Available Credits: <span id="availableCredits">Loading...</span>
                        </div>
                        <div class="col-span-6">
                            <label class="block text-sm font-medium mb-1" for="days_requested">Days Requested <span class="text-rose-500">*</span></label>
                            <input id="days_requested" name="days_requested" class="form-input w-full" type="number" min="1" required />
                            <div id="creditWarning" class="text-xs text-rose-500 hidden mt-1">Insufficient leave credits available</div>
                            @error('days_requested')
                                <div class="text-xs mt-1 text-rose-500">{{ $message }}</div>
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

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const leaveTypeSelect = document.getElementById('leave_type');
        const daysInput = document.getElementById('days_requested');
        const availableCreditsSpan = document.getElementById('availableCredits');
        const creditWarning = document.getElementById('creditWarning');
        const employeeId = {{ auth()->user()->id }};

        async function getAvailableCredits(leaveType) {
            try {
                const response = await fetch(`/api/leave-credits/${employeeId}/${leaveType}`);
                const data = await response.json();
                availableCreditsSpan.textContent = data.remaining_credits;
                return data.remaining_credits;
            } catch (error) {
                console.error('Error fetching credits:', error);
                availableCreditsSpan.textContent = 'Error loading credits';
                return 0;
            }
        }

        function validateCredits() {
            const leaveType = leaveTypeSelect.value;
            const days = parseInt(daysInput.value) || 0;
            const availableCredits = parseInt(availableCreditsSpan.textContent) || 0;

            if (leaveType && days > availableCredits) {
                creditWarning.classList.remove('hidden');
                daysInput.setCustomValidity('Insufficient leave credits available');
            } else {
                creditWarning.classList.add('hidden');
                daysInput.setCustomValidity('');
            }
        }

        leaveTypeSelect.addEventListener('change', async function() {
            if (this.value) {
                const credits = await getAvailableCredits(this.value);
                validateCredits();
            }
        });

        daysInput.addEventListener('input', validateCredits);
    });
</script>
