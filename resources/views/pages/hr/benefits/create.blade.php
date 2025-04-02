<x-app-layout>
    <div class="px-4 sm:px-6 lg:px-8 py-8 w-full max-w-9xl mx-auto">
        <!-- Page header -->
        <div class="mb-8">
            <div class="mb-4">
                <h1 class="text-2xl md:text-3xl text-slate-800 dark:text-slate-100 font-bold">Create Employee Benefit</h1>
            </div>
        </div>

        <!-- Form -->
        <form action="{{ route('hr.benefits.store') }}" method="POST" class="space-y-6">
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
                            <select id="employee_id" name="employee_id" class="form-select w-full" required>
                                <option value="">Select Employee</option>
                                @foreach($employees as $employee)
                                    <option value="{{ $employee->id }}">{{ $employee->name }}</option>
                                @endforeach
                            </select>
                            @error('employee_id')
                                <p class="mt-1 text-xs text-red-600 dark:text-red-400">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>

            <!-- Benefit Details -->
            <div class="bg-white dark:bg-slate-800 shadow-lg rounded-sm border border-slate-200 dark:border-slate-700">
                <header class="px-5 py-4 border-b border-slate-200 dark:border-slate-700">
                    <h2 class="font-semibold text-slate-800 dark:text-slate-100">Benefit Details</h2>
                </header>
                <div class="p-3">
                    <div class="grid grid-cols-12 gap-4">
                        <div class="col-span-6">
                            <label class="block text-sm font-medium mb-1" for="benefit_type">Benefit Type</label>
                            <select id="benefit_type" name="benefit_type" class="form-select w-full" required>
                                <option value="">Select Benefit Type</option>
                                <option value="health_insurance">Health Insurance</option>
                                <option value="life_insurance">Life Insurance</option>
                                <option value="dental">Dental</option>
                                <option value="vision">Vision</option>
                                <option value="retirement">Retirement</option>
                                <option value="bonus">Bonus</option>
                                <option value="stock_options">Stock Options</option>
                                <option value="other">Other</option>
                            </select>
                            @error('benefit_type')
                                <p class="mt-1 text-xs text-red-600 dark:text-red-400">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="col-span-6">
                            <label class="block text-sm font-medium mb-1" for="amount">Amount</label>
                            <div class="flex">
                                <span class="inline-flex items-center px-3 text-sm text-slate-800 dark:text-slate-100 bg-slate-100 dark:bg-slate-700 border border-r-0 border-slate-200 dark:border-slate-700 rounded-l-md">
                                    ₱
                                </span>
                                <input id="amount" name="amount" type="number" step="0.01" class="form-input w-full" required>
                            </div>
                            @error('amount')
                                <p class="mt-1 text-xs text-red-600 dark:text-red-400">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="col-span-6">
                            <label class="block text-sm font-medium mb-1" for="effective_date">Effective Date</label>
                            <input id="effective_date" name="effective_date" type="date" class="form-input w-full" required>
                            @error('effective_date')
                                <p class="mt-1 text-xs text-red-600 dark:text-red-400">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="col-span-6">
                            <label class="block text-sm font-medium mb-1" for="expiration_date">Expiration Date</label>
                            <input id="expiration_date" name="expiration_date" type="date" class="form-input w-full">
                            @error('expiration_date')
                                <p class="mt-1 text-xs text-red-600 dark:text-red-400">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>

            <!-- Description -->
            <div class="bg-white dark:bg-slate-800 shadow-lg rounded-sm border border-slate-200 dark:border-slate-700">
                <header class="px-5 py-4 border-b border-slate-200 dark:border-slate-700">
                    <h2 class="font-semibold text-slate-800 dark:text-slate-100">Description</h2>
                </header>
                <div class="p-3">
                    <div class="grid grid-cols-12 gap-4">
                        <div class="col-span-12">
                            <label class="block text-sm font-medium mb-1" for="description">Benefit Description</label>
                            <textarea id="description" name="description" rows="3" class="form-textarea w-full" required></textarea>
                            @error('description')
                                <p class="mt-1 text-xs text-red-600 dark:text-red-400">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>

            <!-- Status -->
            <div class="bg-white dark:bg-slate-800 shadow-lg rounded-sm border border-slate-200 dark:border-slate-700">
                <header class="px-5 py-4 border-b border-slate-200 dark:border-slate-700">
                    <h2 class="font-semibold text-slate-800 dark:text-slate-100">Status</h2>
                </header>
                <div class="p-3">
                    <div class="grid grid-cols-12 gap-4">
                        <div class="col-span-12">
                            <label class="block text-sm font-medium mb-1" for="status">Benefit Status</label>
                            <select id="status" name="status" class="form-select w-full" required>
                                <option value="active">Active</option>
                                <option value="inactive">Inactive</option>
                                <option value="pending">Pending</option>
                                <option value="expired">Expired</option>
                            </select>
                            @error('status')
                                <p class="mt-1 text-xs text-red-600 dark:text-red-400">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>

            <!-- Submit Button -->
            <div class="text-right">
                <button type="submit" class="btn bg-indigo-500 hover:bg-indigo-600 text-white">
                    Create Benefit
                </button>
            </div>
        </form>
    </div>
</x-app-layout>
