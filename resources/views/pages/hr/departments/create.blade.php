<x-app-layout>
    <div class="px-4 sm:px-6 lg:px-8 py-8 w-full max-w-9xl mx-auto">
        <div class="sm:flex sm:justify-between sm:items-center mb-8">
            <div class="mb-4 sm:mb-0">
                <h1 class="text-2xl md:text-3xl text-slate-800 dark:text-slate-100 font-bold">Add New Department</h1>
            </div>
            <div>
                <a href="{{ route('departments.index') }}" class="btn bg-slate-50 hover:bg-slate-100 text-slate-800">
                    <svg class="w-4 h-4 fill-current opacity-50 shrink-0" viewBox="0 0 16 16">
                        <path d="M15 11.586l-4.293 4.293a1 1 0 0 1-1.414 0l-6-6a1 1 0 0 1 0-1.414l6-6a1 1 0 0 1 1.414 1.414L6.828 6l4.293 4.293a1 1 0 0 1 0 1.414z"/>
                    </svg>
                    <span class="ml-2">Back to Departments</span>
                </a>
            </div>
        </div>

        <div class="bg-white dark:bg-slate-800 shadow-lg rounded-sm border border-slate-200 dark:border-slate-700">
            <div class="p-6">
                <form action="{{ route('departments.store') }}" method="POST" class="space-y-5">
                    @csrf

                    <div class="space-y-2">
                        <label class="block text-sm font-medium mb-1">Name</label>
                        <input type="text" name="name" 
                               class="form-input w-full {{ $errors->has('name') ? 'border-rose-500' : '' }}"
                               value="{{ old('name') }}" 
                               required>
                        @error('name')
                            <p class="text-rose-500 text-xs italic mt-2">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="space-y-2">
                        <label class="block text-sm font-medium mb-1">Description</label>
                        <textarea name="description" 
                                  class="form-textarea w-full {{ $errors->has('description') ? 'border-rose-500' : '' }}"
                                  rows="3">{{ old('description') }}</textarea>
                        @error('description')
                            <p class="text-rose-500 text-xs italic mt-2">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="flex justify-end space-x-2">
                        <a href="{{ route('departments.index') }}" class="btn bg-slate-50 hover:bg-slate-100 text-slate-800">Cancel</a>
                        <button type="submit" class="btn bg-indigo-500 hover:bg-indigo-600 text-white">Create Department</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
