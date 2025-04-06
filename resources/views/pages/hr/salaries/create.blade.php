<x-app-layout>
    <div class="px-4 sm:px-6 lg:px-8 py-8 w-full max-w-9xl mx-auto">
        <div class="sm:flex sm:justify-between sm:items-center mb-8">
            <div class="mb-4 sm:mb-0">
                <h1 class="text-2xl md:text-3xl text-slate-800 dark:text-slate-100 font-bold">Add New Salary Record</h1>
            </div>
        </div>

        <div class="bg-white dark:bg-slate-800 shadow-lg rounded-sm border border-slate-200 dark:border-slate-700">
            <div class="p-6">
                <form action="{{ route('salaries.store') }}" method="POST">
                    @csrf
                    <div class="space-y-4">
                        <div>
                            <label class="block text-sm font-medium mb-1" for="employee_id">Employee <span class="text-rose-500">*</span></label>
                            <select id="employee_id" name="employee_id" class="form-select w-full" required>
                                <option value="">Select Employee</option>
                                @foreach($employees as $employee)
                                    <option value="{{ $employee->id }}">{{ $employee->name }}</option>
                                @endforeach
                            </select>
                            @error('employee_id')
                                <div class="text-xs mt-1 text-rose-500">{{ $message }}</div>
                            @enderror
                        </div>

                        <div>
                            <label class="block text-sm font-medium mb-1" for="basic_salary">Basic Salary <span class="text-rose-500">*</span></label>
                            <input id="basic_salary" name="basic_salary" class="form-input w-full" type="number" step="0.01" required />
                            @error('basic_salary')
                                <div class="text-xs mt-1 text-rose-500">{{ $message }}</div>
                            @enderror
                        </div>

                        <div>
                            <label class="block text-sm font-medium mb-1" for="daily_rate">Daily Rate <span class="text-rose-500">*</span></label>
                            <input id="daily_rate" name="daily_rate" class="form-input w-full" type="number" step="0.01" required />
                            @error('daily_rate')
                                <div class="text-xs mt-1 text-rose-500">{{ $message }}</div>
                            @enderror
                        </div>

                        <div>
                            <label class="block text-sm font-medium mb-1" for="effective_date">Effective Date <span class="text-rose-500">*</span></label>
                            <input id="effective_date" name="effective_date" class="form-input w-full" type="date" required value="{{ now()->format('Y-m-d') }}" />
                            @error('effective_date')
                                <div class="text-xs mt-1 text-rose-500">{{ $message }}</div>
                            @enderror
                        </div>

                        <div>
                            <label class="block text-sm font-medium mb-1" for="notes">Notes</label>
                            <textarea id="notes" name="notes" class="form-textarea w-full" rows="3"></textarea>
                            @error('notes')
                                <div class="text-xs mt-1 text-rose-500">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="flex items-center justify-between mt-6">
                        <a href="{{ route('salaries.index') }}" class="btn border-slate-200 hover:border-slate-300 text-slate-600">Cancel</a>
                        <button type="submit" class="btn bg-indigo-500 hover:bg-indigo-600 text-white">Save Changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>

<script>
    document.getElementById('basic_salary').addEventListener('input', function() {
        const basicSalary = parseFloat(this.value) || 0;
        const dailyRate = basicSalary / 22; // Assuming 22 working days per month
        document.getElementById('daily_rate').value = dailyRate.toFixed(2);
    });

    document.getElementById('daily_rate').addEventListener('input', function() {
        const dailyRate = parseFloat(this.value) || 0;
        const basicSalary = dailyRate * 22; // Assuming 22 working days per month
        document.getElementById('basic_salary').value = basicSalary.toFixed(2);
    });
</script>
