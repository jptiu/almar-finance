<x-app-layout>
    <div class="px-4 sm:px-6 lg:px-8 py-8 w-full max-w-9xl mx-auto">
        <!-- Page header -->
        <div class="mb-8">
            <div class="mb-4">
                <h1 class="text-2xl md:text-3xl text-slate-800 dark:text-slate-100 font-bold">Create Performance Evaluation</h1>
            </div>
        </div>

        <!-- Form -->
        <form action="{{ route('performance.store') }}" method="POST" class="space-y-6">
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

            <!-- Evaluation Details -->
            <div class="bg-white dark:bg-slate-800 shadow-lg rounded-sm border border-slate-200 dark:border-slate-700">
                <header class="px-5 py-4 border-b border-slate-200 dark:border-slate-700">
                    <h2 class="font-semibold text-slate-800 dark:text-slate-100">Evaluation Details</h2>
                </header>
                <div class="p-3">
                    <div class="grid grid-cols-12 gap-4">
                        <div class="col-span-6">
                            <label class="block text-sm font-medium mb-1" for="evaluation_date">Evaluation Date</label>
                            <input id="evaluation_date" name="evaluation_date" type="date" class="form-input w-full" required>
                            @error('evaluation_date')
                                <p class="mt-1 text-xs text-red-600 dark:text-red-400">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="col-span-6">
                            <label class="block text-sm font-medium mb-1" for="evaluation_period">Evaluation Period</label>
                            <input id="evaluation_period" name="evaluation_period" type="text" class="form-input w-full" required>
                            @error('evaluation_period')
                                <p class="mt-1 text-xs text-red-600 dark:text-red-400">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="col-span-6">
                            <label class="block text-sm font-medium mb-1" for="overall_rating">Overall Rating</label>
                            <select id="overall_rating" name="overall_rating" class="form-select w-full" required>
                                <option value="">Select Rating</option>
                                <option value="5">Excellent (5/5)</option>
                                <option value="4">Very Good (4/5)</option>
                                <option value="3">Good (3/5)</option>
                                <option value="2">Fair (2/5)</option>
                                <option value="1">Poor (1/5)</option>
                            </select>
                            @error('overall_rating')
                                <p class="mt-1 text-xs text-red-600 dark:text-red-400">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>

            <!-- Strengths -->
            <div class="bg-white dark:bg-slate-800 shadow-lg rounded-sm border border-slate-200 dark:border-slate-700">
                <header class="px-5 py-4 border-b border-slate-200 dark:border-slate-700">
                    <h2 class="font-semibold text-slate-800 dark:text-slate-100">Strengths</h2>
                </header>
                <div class="p-3">
                    <div class="grid grid-cols-12 gap-4">
                        <div class="col-span-12">
                            <label class="block text-sm font-medium mb-1" for="strengths">Key Strengths</label>
                            <textarea id="strengths" name="strengths" rows="4" class="form-textarea w-full" required></textarea>
                            @error('strengths')
                                <p class="mt-1 text-xs text-red-600 dark:text-red-400">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>

            <!-- Areas for Improvement -->
            <div class="bg-white dark:bg-slate-800 shadow-lg rounded-sm border border-slate-200 dark:border-slate-700">
                <header class="px-5 py-4 border-b border-slate-200 dark:border-slate-700">
                    <h2 class="font-semibold text-slate-800 dark:text-slate-100">Areas for Improvement</h2>
                </header>
                <div class="p-3">
                    <div class="grid grid-cols-12 gap-4">
                        <div class="col-span-12">
                            <label class="block text-sm font-medium mb-1" for="areas_for_improvement">Areas for Improvement</label>
                            <textarea id="areas_for_improvement" name="areas_for_improvement" rows="4" class="form-textarea w-full" required></textarea>
                            @error('areas_for_improvement')
                                <p class="mt-1 text-xs text-red-600 dark:text-red-400">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>

            <!-- Goals -->
            <div class="bg-white dark:bg-slate-800 shadow-lg rounded-sm border border-slate-200 dark:border-slate-700">
                <header class="px-5 py-4 border-b border-slate-200 dark:border-slate-700">
                    <h2 class="font-semibold text-slate-800 dark:text-slate-100">Goals</h2>
                </header>
                <div class="p-3">
                    <div class="grid grid-cols-12 gap-4">
                        <div class="col-span-12">
                            <label class="block text-sm font-medium mb-1" for="goals">Professional Goals</label>
                            <textarea id="goals" name="goals" rows="4" class="form-textarea w-full" required></textarea>
                            @error('goals')
                                <p class="mt-1 text-xs text-red-600 dark:text-red-400">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>

            <!-- Comments -->
            <div class="bg-white dark:bg-slate-800 shadow-lg rounded-sm border border-slate-200 dark:border-slate-700">
                <header class="px-5 py-4 border-b border-slate-200 dark:border-slate-700">
                    <h2 class="font-semibold text-slate-800 dark:text-slate-100">Comments</h2>
                </header>
                <div class="p-3">
                    <div class="grid grid-cols-12 gap-4">
                        <div class="col-span-12">
                            <label class="block text-sm font-medium mb-1" for="manager_comments">Manager Comments</label>
                            <textarea id="manager_comments" name="manager_comments" rows="4" class="form-textarea w-full" required></textarea>
                            @error('manager_comments')
                                <p class="mt-1 text-xs text-red-600 dark:text-red-400">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="col-span-12">
                            <label class="block text-sm font-medium mb-1" for="employee_comments">Employee Comments</label>
                            <textarea id="employee_comments" name="employee_comments" rows="4" class="form-textarea w-full"></textarea>
                            @error('employee_comments')
                                <p class="mt-1 text-xs text-red-600 dark:text-red-400">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>

            <!-- Submit Button -->
            <div class="text-right">
                <button type="submit" class="btn bg-indigo-500 hover:bg-indigo-600 text-white">
                    Submit Evaluation
                </button>
            </div>
        </form>
    </div>
</x-app-layout>
