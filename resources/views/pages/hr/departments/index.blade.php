<x-app-layout>
    <div class="px-4 sm:px-6 lg:px-8 py-8 w-full max-w-9xl mx-auto">
        <div class="sm:flex sm:justify-between sm:items-center mb-8">
            <div class="mb-4 sm:mb-0">
                <h1 class="text-2xl md:text-3xl text-slate-800 dark:text-slate-100 font-bold">Departments</h1>
            </div>
            <div>
                <a href="{{ route('departments.create') }}" class="btn bg-indigo-500 hover:bg-indigo-600 text-white">
                    <svg class="w-4 h-4 fill-current opacity-50 shrink-0" viewBox="0 0 16 16">
                        <path d="M15 7H9V1h2v5h4V2a1 1 0 0 0-1-1H5a1 1 0 0 0-1 1v14a1 1 0 0 0 1 1h8a1 1 0 0 0 1-1V8h4a1 1 0 0 0 0-2z"/>
                    </svg>
                    <span class="ml-2">Add Department</span>
                </a>
            </div>
        </div>

        <div class="bg-white dark:bg-slate-800 shadow-lg rounded-sm border border-slate-200 dark:border-slate-700">
            <div class="p-6">
                <div class="overflow-x-auto">
                    <table class="table-auto w-full dark:text-slate-300">
                        <thead class="text-xs font-semibold uppercase text-slate-500 dark:text-slate-400 bg-slate-50 dark:bg-slate-700 dark:bg-opacity-50">
                            <tr>
                                <th class="p-2 whitespace-nowrap">
                                    <div class="font-semibold text-left">Name</div>
                                </th>
                                <th class="p-2 whitespace-nowrap">
                                    <div class="font-semibold text-left">Description</div>
                                </th>
                                <th class="p-2 whitespace-nowrap">
                                    <div class="font-semibold text-left">Employees</div>
                                </th>
                                <th class="p-2 whitespace-nowrap">
                                    <div class="font-semibold text-left">Actions</div>
                                </th>
                            </tr>
                        </thead>
                        <tbody class="text-sm divide-y divide-slate-200 dark:divide-slate-700">
                            @foreach($departments as $department)
                                <tr>
                                    <td class="p-2 whitespace-nowrap">
                                        <div class="text-left font-medium text-slate-800 dark:text-slate-100">{{ $department->name }}</div>
                                    </td>
                                    <td class="p-2 whitespace-nowrap">
                                        <div class="text-left text-slate-500 dark:text-slate-400">{{ $department->description }}</div>
                                    </td>
                                    <td class="p-2 whitespace-nowrap">
                                        <div class="text-left">{{ $department->users()->count() }}</div>
                                    </td>
                                    <td class="p-2 whitespace-nowrap">
                                        <div class="flex items-center space-x-2">
                                            <a href="{{ route('departments.edit', $department) }}" class="text-sm text-slate-500 hover:text-slate-600 dark:text-slate-400 dark:hover:text-slate-300">
                                                <svg class="w-4 h-4 fill-current shrink-0" viewBox="0 0 16 16">
                                                    <path d="M11.7.3c-.4-.4-1-.4-1.4 0l-10 10c-.2.2-.3.4-.3.7v4c0 .6.4 1 1 1h4c.3 0 .5-.1.7-.3l10-10c.4-.4.4-1 0-1.4l-4-4zM4.6 14H2v-2.6l6-6L10.6 8l-6 6z"/>
                                                </svg>
                                            </a>
                                            <form method="POST" action="{{ route('departments.destroy', $department) }}" class="inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="text-sm text-red-500 hover:text-red-600" onclick="return confirm('Are you sure you want to delete this department?')">
                                                    <svg class="w-4 h-4 fill-current shrink-0" viewBox="0 0 16 16">
                                                        <path d="M5 7h2v6H5V7zm4 0h2v6H9V7zm3-6v2h4v2H12v10c0 .6-.4 1-1 1H4c-.6 0-1-.4-1-1V3c0-.6.4-1 1-1h4zm2 0H6c-.6 0-1 .4-1 1v12c0 .6.4 1 1 1h6c.6 0 1-.4 1-1V4c0-.6-.4-1-1-1z"/>
                                                    </svg>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                
                <!-- Pagination -->
                <div class="mt-4">
                    {{ $departments->links() }}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
