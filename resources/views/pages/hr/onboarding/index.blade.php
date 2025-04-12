<x-app-layout>
    <div class="px-4 sm:px-6 lg:px-8 py-8 w-full max-w-9xl mx-auto">
        <!-- Page Header -->
        <div class="sm:flex sm:justify-between sm:items-center mb-8">
            <!-- Left: Title -->
            <div class="mb-4 sm:mb-0">
                <h1 class="text-2xl md:text-3xl text-slate-800 font-bold dark:text-slate-100 mb-1">
                    Employee Onboarding
                </h1>
            </div>
            <!-- Right: Actions -->
            <div class="flex items-center space-x-3">
                <form action="{{ route('hr.onboarding.select') }}" method="POST" class="flex space-x-2">
                    @csrf
                    <select name="user_id" class="form-select w-full max-w-xs" required>
                        <option value="">Select Employee</option>
                        @foreach($employees as $employee)
                            @if(!$employee->onboarding)
                                <option value="{{ $employee->id }}" {{ old('user_id') == $employee->id ? 'selected' : '' }}>
                                    {{ $employee->name }} ({{ $employee->id }})
                                </option>
                            @endif
                        @endforeach
                    </select>
                    <button type="submit" class="inline-flex items-center justify-center px-3 py-1.5 border border-transparent rounded-md font-medium bg-blue-500 text-white hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-all text-sm">
                        <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                        </svg>
                        Start Onboarding
                    </button>
                </form>
                <button type="button" class="inline-flex items-center justify-center px-3 py-1.5 border border-transparent rounded-md font-medium bg-emerald-500 text-white hover:bg-emerald-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-emerald-500 transition-all text-sm"
                        onclick="openModal('addEmployeeModal')">
                    <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"></path>
                    </svg>
                    Add New Employee
                </button>
            </div>
        </div>

        <!-- Stats -->
        <div class="grid grid-cols-1 lg:grid-cols-4 gap-6 mb-8">
            <!-- Total Employees -->
            <div class="bg-white dark:bg-slate-800 shadow-lg rounded-sm border border-slate-200 dark:border-slate-700">
                <div class="px-5 py-5">
                    <div class="text-2xl font-bold text-slate-800 dark:text-slate-100">{{ $employees->count() }}</div>
                    <div class="text-sm text-slate-500 dark:text-slate-400">Total Employees</div>
                </div>
            </div>

            <!-- Employees Without Onboarding -->
            <div class="bg-white dark:bg-slate-800 shadow-lg rounded-sm border border-slate-200 dark:border-slate-700">
                <div class="px-5 py-5">
                    <div class="text-2xl font-bold text-slate-800 dark:text-slate-100">
                        {{ $employees->whereNull('onboarding')->count() }}
                    </div>
                    <div class="text-sm text-slate-500 dark:text-slate-400">Need Onboarding</div>
                </div>
            </div>

            <!-- Probation Extensions -->
            <div class="bg-white dark:bg-slate-800 shadow-lg rounded-sm border border-slate-200 dark:border-slate-700">
                <div class="px-5 py-5">
                    <div class="text-2xl font-bold text-slate-800 dark:text-slate-100">
                        {{ $employees->where('onboarding.probation_status', 'extended')->count() }}
                    </div>
                    <div class="text-sm text-slate-500 dark:text-slate-400">Probation Extensions</div>
                </div>
            </div>

            <!-- Failed -->
            <div class="bg-white dark:bg-slate-800 shadow-lg rounded-sm border border-slate-200 dark:border-slate-700">
                <div class="px-5 py-5">
                    <div class="text-2xl font-bold text-red-500">
                        {{ $employees->where('onboarding.probation_status', 'failed')->count() }}
                    </div>
                    <div class="text-sm text-slate-500 dark:text-slate-400">Failed Probation</div>
                </div>
            </div>
        </div>

        <!-- Employees Table -->
        <div class="bg-white dark:bg-slate-800 shadow-lg rounded-sm border border-slate-200 dark:border-slate-700">
            <header class="px-5 py-4 border-b border-slate-100 dark:border-slate-700">
                <h2 class="font-semibold text-slate-500 uppercase dark:text-slate-400">Employee List</h2>
            </header>
            <div class="overflow-x-auto">
                <table class="table-auto w-full">
                    <thead>
                        <tr class="text-slate-400 uppercase text-xs font-semibold tracking-wide text-left">
                            <th class="px-4 py-3">Employee Name</th>
                            <th class="px-4 py-3">Probation Period</th>
                            <th class="px-4 py-3">Status</th>
                            <th class="px-4 py-3">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="text-sm divide-y divide-slate-100 dark:divide-slate-700">
                        @foreach ($employees as $employee)
                            <tr>
                                <td class="px-4 py-3 text-slate-500 dark:text-slate-400 font-medium">
                                    {{ $employee->name }}
                                </td>
                                <td class="px-4 py-3">
                                    @if($employee->onboarding)
                                        <div class="flex items-center">
                                            <span class="text-slate-500 dark:text-slate-400">
                                                {{ $employee->onboarding->probation_start_date->format('M d, Y') }} - 
                                                @if ($employee->onboarding->probation_end_date)
                                                    {{ $employee->onboarding->probation_end_date->format('M d, Y') }}
                                                @else
                                                    N/A
                                                @endif
                                            </span>
                                        </div>
                                    @else
                                        <span class="text-slate-400">N/A</span>
                                    @endif
                                </td>
                                <td class="px-4 py-3">
                                    @if($employee->onboarding)
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-{{ 
                                            match($employee->onboarding->probation_status) {
                                                'pending' => 'yellow-100',
                                                'completed' => 'green-100',
                                                'extended' => 'blue-100',
                                                'failed' => 'red-100'
                                            }
                                        }} text-{{ 
                                            match($employee->onboarding->probation_status) {
                                                'pending' => 'yellow-800',
                                                'completed' => 'green-800',
                                                'extended' => 'blue-800',
                                                'failed' => 'red-800'
                                            }
                                        }}">
                                            {{ ucfirst($employee->onboarding->probation_status) }}
                                        </span>
                                    @else
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-gray-100 text-gray-800">
                                            No Onboarding
                                        </span>
                                    @endif
                                </td>
                                <td class="px-4 py-3">
                                    <div class="flex space-x-2">
                                        @if($employee->onboarding)
                                            @if ($employee->onboarding->isProbationPeriod())
                                                <button type="button" class="inline-flex items-center justify-center px-3 py-1.5 border border-transparent rounded-md font-medium bg-blue-50 text-blue-600 hover:bg-blue-100 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-all text-xs"
                                                        onclick="openModal('extendModal{{ $employee->id }}')">
                                                    <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                                                    </svg>
                                                    Extend
                                                </button>
                                                <button type="button" class="inline-flex items-center justify-center px-3 py-1.5 border border-transparent rounded-md font-medium bg-red-50 text-red-600 hover:bg-red-100 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 transition-all text-xs"
                                                        onclick="openModal('failModal{{ $employee->id }}')">
                                                    <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                                    </svg>
                                                    Fail
                                                </button>
                                                <button type="button" class="inline-flex items-center justify-center px-3 py-1.5 border border-transparent rounded-md font-medium bg-green-50 text-green-600 hover:bg-green-100 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500 transition-all text-xs"
                                                        onclick="openModal('completeModal{{ $employee->id }}')">
                                                    <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                                    </svg>
                                                    Complete
                                                </button>
                                            @endif
                                            @if ($employee->onboarding->isProbationCompleted())
                                                <form action="{{ route('hr.onboarding.regularize', $employee->onboarding) }}" method="POST" class="inline">
                                                    @csrf
                                                    @method('PUT')
                                                    <button type="submit" class="inline-flex items-center justify-center px-3 py-1.5 border border-transparent rounded-md font-medium bg-purple-50 text-purple-600 hover:bg-purple-100 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-purple-500 transition-all text-xs">
                                                        <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                                                        </svg>
                                                        Regularize
                                                    </button>
                                                </form>
                                            @endif
                                        @endif
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Regular Employees Table -->
        <div class="mt-8 bg-white dark:bg-slate-800 shadow-lg rounded-sm border border-slate-200 dark:border-slate-700">
            <header class="px-5 py-4 border-b border-slate-100 dark:border-slate-700">
                <h2 class="font-semibold text-slate-500 uppercase dark:text-slate-400">Regularized Employees</h2>
            </header>
            <div class="overflow-x-auto">
                <table class="table-auto w-full">
                    <thead>
                        <tr>
                            <th class="px-4 py-3 text-sm font-semibold text-left text-slate-800 dark:text-slate-100">Name</th>
                            <th class="px-4 py-3 text-sm font-semibold text-left text-slate-800 dark:text-slate-100">Regularization Date</th>
                            <th class="px-4 py-3 text-sm font-semibold text-left text-slate-800 dark:text-slate-100">Probation Duration</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($employees as $employee)
                            @if($employee->onboarding && $employee->onboarding->isProbationCompleted())
                                <tr>
                                    <td class="px-4 py-3 text-sm text-slate-500 dark:text-slate-400">{{ $employee->name }}</td>
                                    <td class="px-4 py-3 text-sm text-slate-500 dark:text-slate-400">
                                        {{ $employee->onboarding->regularization_date ? $employee->onboarding->regularization_date->format('M d, Y') : 'N/A' }}
                                    </td>
                                    <td class="px-4 py-3 text-sm text-slate-500 dark:text-slate-400">
                                        {{ $employee->onboarding->calculateProbationDuration() }} days
                                    </td>
                                </tr>
                            @endif
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Add Employee Modal -->
        <div id="addEmployeeModal" class="fixed inset-0 bg-black bg-opacity-50 z-50 hidden" aria-hidden="true">
            <div class="fixed inset-0 flex items-center justify-center p-4">
                <div class="bg-white dark:bg-slate-800 rounded-lg shadow-xl w-full max-w-md">
                    <div class="p-6">
                        <h3 class="text-lg font-semibold text-slate-800 dark:text-slate-100 mb-4">Add New Employee</h3>
                        <form action="{{ route('hr.onboarding.add') }}" method="POST">
                            @csrf
                            <div class="space-y-4">
                                <div>
                                    <label class="block text-sm font-medium mb-2 text-slate-500 dark:text-slate-400">Employee Name</label>
                                    <input type="text" name="name" class="w-full px-3 py-2 border border-slate-300 dark:border-slate-700 rounded-md text-sm focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                                </div>
                                <div>
                                    <label class="block text-sm font-medium mb-2 text-slate-500 dark:text-slate-400">Employee ID</label>
                                    <input type="text" name="employee_id" class="w-full px-3 py-2 border border-slate-300 dark:border-slate-700 rounded-md text-sm focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                                </div>
                                <div>
                                    <label class="block text-sm font-medium mb-2 text-slate-500 dark:text-slate-400">Department</label>
                                    <select name="department_id" class="w-full px-3 py-2 border border-slate-300 dark:border-slate-700 rounded-md text-sm focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                                        <option value="">Select Department</option>
                                        @foreach($departments as $department)
                                            <option value="{{ $department->id }}">{{ $department->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="flex justify-end space-x-3">
                                    <button type="button" class="px-4 py-2 rounded-md text-sm font-medium text-slate-500 dark:text-slate-400 hover:bg-slate-100 dark:hover:bg-slate-700"
                                            onclick="closeModal('addEmployeeModal')">
                                        Cancel
                                    </button>
                                    <button type="submit" class="px-4 py-2 rounded-md text-sm font-medium text-white bg-emerald-500 hover:bg-emerald-600 focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:ring-offset-2">
                                        Add Employee
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- Tailwind Modals -->
        @foreach ($employees as $employee)
            @if($employee->onboarding && $employee->onboarding->isProbationPeriod())
                <!-- Extend Modal -->
                <div id="extendModal{{ $employee->id }}" class="fixed inset-0 bg-black bg-opacity-50 z-50 hidden" aria-hidden="true">
                    <div class="fixed inset-0 flex items-center justify-center p-4">
                        <div class="bg-white dark:bg-slate-800 rounded-lg shadow-xl w-full max-w-md">
                            <div class="p-6">
                                <h3 class="text-lg font-semibold text-slate-800 dark:text-slate-100 mb-4">Extend Probation Period</h3>
                                <form action="{{ route('hr.onboarding.extend', $employee->onboarding) }}" method="POST">
                                    @csrf
                                    @method('PUT')
                                    <div class="mb-4">
                                        <label class="block text-sm font-medium mb-2 text-slate-500 dark:text-slate-400">New End Date</label>
                                        <input type="date" name="new_end_date" class="w-full px-3 py-2 border border-slate-300 dark:border-slate-700 rounded-md text-sm focus:outline-none focus:ring-2 focus:ring-blue-500"
                                               min="{{ $employee->onboarding->probation_start_date->format('Y-m-d') }}" required>
                                    </div>
                                    <div class="mb-4">
                                        <label class="block text-sm font-medium mb-2 text-slate-500 dark:text-slate-400">Reason for Extension</label>
                                        <textarea name="reason" rows="3" class="w-full px-3 py-2 border border-slate-300 dark:border-slate-700 rounded-md text-sm focus:outline-none focus:ring-2 focus:ring-blue-500" required></textarea>
                                    </div>
                                    <div class="flex justify-end space-x-3">
                                        <button type="button" class="px-4 py-2 rounded-md text-sm font-medium text-slate-500 dark:text-slate-400 hover:bg-slate-100 dark:hover:bg-slate-700"
                                                onclick="closeModal('extendModal{{ $employee->id }}')">
                                            Cancel
                                        </button>
                                        <button type="submit" class="px-4 py-2 rounded-md text-sm font-medium text-white bg-blue-500 hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2">
                                            Extend Probation
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Fail Modal -->
                <div id="failModal{{ $employee->id }}" class="fixed inset-0 bg-black bg-opacity-50 z-50 hidden" aria-hidden="true">
                    <div class="fixed inset-0 flex items-center justify-center p-4">
                        <div class="bg-white dark:bg-slate-800 rounded-lg shadow-xl w-full max-w-md">
                            <div class="p-6">
                                <h3 class="text-lg font-semibold text-slate-800 dark:text-slate-100 mb-4">Fail Probation</h3>
                                <form action="{{ route('hr.onboarding.fail', $employee->onboarding) }}" method="POST">
                                    @csrf
                                    @method('PUT')
                                    <div class="mb-4">
                                        <label class="block text-sm font-medium mb-2 text-slate-500 dark:text-slate-400">Reason for Failing Probation</label>
                                        <textarea name="reason" rows="3" class="w-full px-3 py-2 border border-slate-300 dark:border-slate-700 rounded-md text-sm focus:outline-none focus:ring-2 focus:ring-red-500" required></textarea>
                                    </div>
                                    <div class="flex justify-end space-x-3">
                                        <button type="button" class="px-4 py-2 rounded-md text-sm font-medium text-slate-500 dark:text-slate-400 hover:bg-slate-100 dark:hover:bg-slate-700"
                                                onclick="closeModal('failModal{{ $employee->id }}')">
                                            Cancel
                                        </button>
                                        <button type="submit" class="px-4 py-2 rounded-md text-sm font-medium text-white bg-red-500 hover:bg-red-600 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2">
                                            Fail Probation
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Complete Modal -->
                <div id="completeModal{{ $employee->id }}" class="fixed inset-0 bg-black bg-opacity-50 z-50 hidden" aria-hidden="true">
                    <div class="fixed inset-0 flex items-center justify-center p-4">
                        <div class="bg-white dark:bg-slate-800 rounded-lg shadow-xl w-full max-w-md">
                            <div class="p-6">
                                <h3 class="text-lg font-semibold text-slate-800 dark:text-slate-100 mb-4">Complete Probation</h3>
                                <form action="{{ route('hr.onboarding.complete', $employee->onboarding) }}" method="POST">
                                    @csrf
                                    @method('PUT')
                                    <div class="mb-4">
                                        <label class="block text-sm font-medium mb-2 text-slate-500 dark:text-slate-400">Probation Evaluation</label>
                                        <textarea name="evaluation" rows="3" class="w-full px-3 py-2 border border-slate-300 dark:border-slate-700 rounded-md text-sm focus:outline-none focus:ring-2 focus:ring-green-500" required></textarea>
                                    </div>
                                    <div class="flex justify-end space-x-3">
                                        <button type="button" class="px-4 py-2 rounded-md text-sm font-medium text-slate-500 dark:text-slate-400 hover:bg-slate-100 dark:hover:bg-slate-700"
                                                onclick="closeModal('completeModal{{ $employee->id }}')">
                                            Cancel
                                        </button>
                                        <button type="submit" class="px-4 py-2 rounded-md text-sm font-medium text-white bg-green-500 hover:bg-green-600 focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-2">
                                            Complete Probation
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
        @endforeach
    </div>

    <script>
    function openModal(modalId) {
        document.getElementById(modalId).classList.remove('hidden');
        document.getElementById(modalId).setAttribute('aria-hidden', 'false');
    }

    function closeModal(modalId) {
        document.getElementById(modalId).classList.add('hidden');
        document.getElementById(modalId).setAttribute('aria-hidden', 'true');
    }

    // Close modals when clicking outside
    document.addEventListener('click', function(e) {
        if (e.target.classList.contains('bg-black')) {
            const modal = e.target.parentElement;
            closeModal(modal.id);
        }
    });

    // Close modals when pressing Esc
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape') {
            const modals = document.querySelectorAll('.fixed.inset-0.bg-black.bg-opacity-50:not(.hidden)');
            modals.forEach(modal => closeModal(modal.id));
        }
    });
    </script>
</x-app-layout>
