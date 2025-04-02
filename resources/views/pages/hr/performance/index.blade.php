<x-app-layout>
    <div class="px-4 sm:px-6 lg:px-8 py-8 w-full max-w-9xl mx-auto">
        <!-- Page header -->
        <div class="mb-8">
            <div class="mb-4">
                <h1 class="text-2xl md:text-3xl text-slate-800 dark:text-slate-100 font-bold">Performance Evaluations</h1>
            </div>
            <div class="mb-6">
                <a href="{{ route('hr.performance.create') }}" 
                   class="btn bg-indigo-500 hover:bg-indigo-600 text-white">
                    <svg class="w-4 h-4 fill-current opacity-50 shrink-0" viewBox="0 0 16 16">
                        <path d="M15 7H9V1c0-.6-.4-1-1-1S7 .4 7 1v6H1c-.6 0-1 .4-1 1s.4 1 1 1h6v6c0 .6.4 1 1 1s1-.4 1-1V9h6c.6 0 1-.4 1-1s-.4-1-1-1z" />
                    </svg>
                    <span class="hidden xs:block ml-2">Create Evaluation</span>
                </a>
            </div>
        </div>

        <!-- Cards -->
        <div class="bg-white dark:bg-slate-800 shadow-lg rounded-sm border border-slate-200 dark:border-slate-700">
            <header class="px-5 py-4 border-b border-slate-200 dark:border-slate-700">
                <h2 class="font-semibold text-slate-800 dark:text-slate-100">Evaluations</h2>
            </header>
            <div class="p-3">
                <!-- Table -->
                <div class="overflow-x-auto">
                    <table class="table-auto w-full">
                        <!-- Table head -->
                        <thead class="text-xs font-semibold uppercase text-slate-500 dark:text-slate-400 bg-slate-50 dark:bg-slate-700">
                            <tr>
                                <th class="p-2 whitespace-nowrap">
                                    <div class="font-semibold text-left">Employee</div>
                                </th>
                                <th class="p-2 whitespace-nowrap">
                                    <div class="font-semibold text-left">Evaluation Date</div>
                                </th>
                                <th class="p-2 whitespace-nowrap">
                                    <div class="font-semibold text-left">Period</div>
                                </th>
                                <th class="p-2 whitespace-nowrap">
                                    <div class="font-semibold text-left">Overall Rating</div>
                                </th>
                                <th class="p-2 whitespace-nowrap">
                                    <div class="font-semibold text-left">Evaluator</div>
                                </th>
                                <th class="p-2 whitespace-nowrap">
                                    <div class="font-semibold text-left">Actions</div>
                                </th>
                            </tr>
                        </thead>
                        <!-- Table body -->
                        <tbody class="text-sm divide-y divide-slate-200 dark:divide-slate-700">
                            @foreach($evaluations as $evaluation)
                            <tr>
                                <td class="p-2 whitespace-nowrap">
                                    <div class="text-left">{{ $evaluation->employee->name }}</div>
                                </td>
                                <td class="p-2 whitespace-nowrap">
                                    <div class="text-left">{{ $evaluation->evaluation_date->format('M d, Y') }}</div>
                                </td>
                                <td class="p-2 whitespace-nowrap">
                                    <div class="text-left">{{ $evaluation->evaluation_period }}</div>
                                </td>
                                <td class="p-2 whitespace-nowrap">
                                    <div class="text-left">
                                        <div class="flex items-center">
                                            <div class="text-{{ $evaluation->overall_rating >= 4 ? 'green' : ($evaluation->overall_rating >= 3 ? 'yellow' : 'red') }}-500">
                                                {{ $evaluation->overall_rating }}/5
                                            </div>
                                            <div class="ml-2">
                                                <div class="flex items-center">
                                                    @for($i = 1; $i <= 5; $i++)
                                                        <svg class="w-3 h-3 fill-current text-{{ $i <= $evaluation->overall_rating ? 'yellow' : 'gray' }}-400" viewBox="0 0 24 24">
                                                            <path d="M12 17.27L18.18 21l-1.64-7.03L22 9.24l-7.19-.61L12 2 9.19 8.63 2 9.24l5.46 4.73L5.82 21z"/>
                                                        </svg>
                                                    @endfor
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                                <td class="p-2 whitespace-nowrap">
                                    <div class="text-left">{{ $evaluation->evaluatedBy->name }}</div>
                                </td>
                                <td class="p-2 whitespace-nowrap">
                                    <div class="text-left">
                                        <div class="flex items-center space-x-2">
                                            <a href="{{ route('hr.performance.show', $evaluation) }}" class="text-indigo-500 hover:text-indigo-600">
                                                <svg class="w-4 h-4 fill-current" viewBox="0 0 16 16">
                                                    <path d="M15 8a.5.5 0 0 0-.5-.5H2.707l3.147-3.146a.5.5 0 1 0-.708-.708l-4 4a.5.5 0 0 0 0 .708l4 4a.5.5 0 0 0 .708-.708L2.707 8.5H14.5A.5.5 0 0 0 15 8z"/>
                                                </svg>
                                            </a>
                                            <a href="{{ route('hr.performance.print', $evaluation) }}" class="text-green-500 hover:text-green-600">
                                                <svg class="w-4 h-4 fill-current" viewBox="0 0 16 16">
                                                    <path d="M2.5 8a.5.5 0 0 0-.5.5v3a.5.5 0 0 0 .5.5h10a.5.5 0 0 0 .5-.5v-3a.5.5 0 0 0-.5-.5h-10ZM3 1a2 2 0 0 0-2 2v1h16V3a2 2 0 0 0-2-2H3ZM11 5.5a.5.5 0 0 1 .5-.5h4a.5.5 0 0 1 0 1h-4a.5.5 0 0 1-.5-.5Z"/>
                                                </svg>
                                            </a>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
