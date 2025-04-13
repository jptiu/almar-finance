<x-app-layout>
    <div class="px-4 sm:px-6 lg:px-8 py-8 w-full max-w-9xl mx-auto">
        <div class="sm:flex sm:justify-between sm:items-center mb-8">
            <div class="mb-4 sm:mb-0">
                <h1 class="text-2xl md:text-3xl text-slate-800 dark:text-slate-100 font-bold">Leave Credits</h1>
            </div>
        </div>

        <div class="bg-white dark:bg-slate-800 shadow-lg rounded-sm border border-slate-200 dark:border-slate-700">
            <div class="p-6">
                <div class="overflow-x-auto">
                    <table class="table-auto w-full dark:text-slate-300">
                        <thead class="text-xs font-semibold uppercase text-slate-500 dark:text-slate-400 bg-slate-50 dark:bg-slate-700 dark:bg-opacity-50">
                            <tr>
                                <th class="p-2 whitespace-nowrap">
                                    <div class="font-semibold text-left">Leave Type</div>
                                </th>
                                <th class="p-2 whitespace-nowrap">
                                    <div class="font-semibold text-left">Total Credits</div>
                                </th>
                                <th class="p-2 whitespace-nowrap">
                                    <div class="font-semibold text-left">Used Credits</div>
                                </th>
                                <th class="p-2 whitespace-nowrap">
                                    <div class="font-semibold text-left">Remaining Credits</div>
                                </th>
                                <th class="p-2 whitespace-nowrap">
                                    <div class="font-semibold text-left">Status</div>
                                </th>
                            </tr>
                        </thead>
                        <tbody class="text-sm divide-y divide-slate-200 dark:divide-slate-700">
                            @foreach($leaveCredits as $credit)
                                <tr>
                                    <td class="p-2 whitespace-nowrap">
                                        <div class="text-left">{{ $credit['leave_type'] }}</div>
                                    </td>
                                    <td class="p-2 whitespace-nowrap">
                                        <div class="text-left">{{ $credit['total_credits'] }}</div>
                                    </td>
                                    <td class="p-2 whitespace-nowrap">
                                        <div class="text-left">{{ $credit['used_credits'] }}</div>
                                    </td>
                                    <td class="p-2 whitespace-nowrap">
                                        <div class="text-left">{{ $credit['remaining_credits'] }}</div>
                                    </td>
                                    <td class="p-2 whitespace-nowrap">
                                        @switch($credit['status'])
                                            @case('No credits assigned')
                                                <div class="inline-flex font-medium rounded-full text-center px-2.5 py-0.5 bg-slate-100 text-slate-800">
                                                    {{ $credit['status'] }}
                                                </div>
                                                @break
                                            @case('Overdrawn credits')
                                                <div class="inline-flex font-medium rounded-full text-center px-2.5 py-0.5 bg-red-100 text-red-800">
                                                    {{ $credit['status'] }}
                                                </div>
                                                @break
                                            @case('No credits remaining')
                                                <div class="inline-flex font-medium rounded-full text-center px-2.5 py-0.5 bg-red-100 text-red-800">
                                                    {{ $credit['status'] }}
                                                </div>
                                                @break
                                            @case('Low credits remaining')
                                                <div class="inline-flex font-medium rounded-full text-center px-2.5 py-0.5 bg-yellow-100 text-yellow-800">
                                                    {{ $credit['status'] }}
                                                </div>
                                                @break
                                            @default
                                                <div class="inline-flex font-medium rounded-full text-center px-2.5 py-0.5 bg-emerald-100 text-emerald-600">
                                                    {{ $credit['status'] }}
                                                </div>
                                        @endswitch
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
