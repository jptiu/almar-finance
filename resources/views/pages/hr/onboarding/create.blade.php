<x-app-layout>
    <div class="px-4 sm:px-6 lg:px-8 py-8 w-full max-w-9xl mx-auto">
        <!-- Title -->
        <div class="mb-8">
            <h1 class="text-2xl md:text-3xl text-slate-800 dark:text-slate-100 font-bold">Start Employee Onboarding</h1>
        </div>

        <div class="bg-white dark:bg-slate-800 shadow-lg rounded-sm border border-slate-200 dark:border-slate-700">
            <header class="px-5 py-4 border-b border-slate-100 dark:border-slate-700">
                <h2 class="font-semibold text-slate-800 dark:text-slate-100">Employee Information</h2>
            </header>
            <form action="{{ route('hr.onboarding.store', ['user' => $user->id]) }}" method="POST" class="p-5">
                @csrf
                @if(session('error'))
                    <div class="mb-4 p-4 bg-red-100 border border-red-400 text-red-700 rounded">
                        {{ session('error') }}
                    </div>
                @endif
                
                <!-- Employee Info -->
                <div class="mb-6">
                    <div class="mb-4">
                        <label class="block text-sm font-medium mb-2 text-slate-800 dark:text-slate-100">Employee Name</label>
                        <input type="text" value="{{ $user->name }}" disabled
                            class="form-input w-full text-slate-400 bg-slate-50 dark:bg-slate-700">
                    </div>
                    <div class="mb-4">
                        <label class="block text-sm font-medium mb-2 text-slate-800 dark:text-slate-100">Employee ID</label>
                        <input type="text" value="{{ $user->id }}" disabled
                            class="form-input w-full text-slate-400 bg-slate-50 dark:bg-slate-700">
                    </div>
                </div>

                <!-- Probation Period -->
                <div class="mb-6">
                    <h3 class="text-lg font-semibold mb-4 text-slate-800 dark:text-slate-100">Probation Period</h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-medium mb-2 text-slate-800 dark:text-slate-100">Start Date</label>
                            <input type="date" name="probation_start_date" required
                                class="form-input w-full @error('probation_start_date') border-red-500 @enderror"
                                value="{{ old('probation_start_date') }}">
                            @error('probation_start_date')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                        <div>
                            <label class="block text-sm font-medium mb-2 text-slate-800 dark:text-slate-100">End Date</label>
                            <input type="date" name="probation_end_date" required
                                class="form-input w-full @error('probation_end_date') border-red-500 @enderror"
                                value="{{ old('probation_end_date') }}">
                            @error('probation_end_date')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </div>

                <!-- Evaluation Criteria -->
                <div class="mb-6">
                    <h3 class="text-lg font-semibold mb-4 text-slate-800 dark:text-slate-100">Evaluation Criteria</h3>
                    <div class="space-y-4">
                        <div>
                            <label class="block text-sm font-medium mb-2 text-slate-800 dark:text-slate-100">Performance Metrics</label>
                            <textarea name="performance_metrics" rows="3"
                                class="form-textarea w-full @error('performance_metrics') border-red-500 @enderror"
                                placeholder="List key performance indicators and metrics to be evaluated">{{ old('performance_metrics') }}</textarea>
                            @error('performance_metrics')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                        <div>
                            <label class="block text-sm font-medium mb-2 text-slate-800 dark:text-slate-100">Training Requirements</label>
                            <textarea name="training_requirements" rows="3"
                                class="form-textarea w-full @error('training_requirements') border-red-500 @enderror"
                                placeholder="List required training programs">{{ old('training_requirements') }}</textarea>
                            @error('training_requirements')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </div>

                <!-- Submit -->
                <div class="text-right">
                    <button type="submit" class="btn bg-indigo-500 hover:bg-indigo-600 text-white">
                        Start Onboarding
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
