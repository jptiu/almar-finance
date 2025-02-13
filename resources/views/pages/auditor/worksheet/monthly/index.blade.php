<x-app-layout>
    <div class="px-4 sm:px-6 lg:px-8 py-8 w-full max-w-9xl mx-auto">

        @if (session()->has('success'))
            <div class="alert alert-success">
                <div class="flex items-center p-4 mb-4 text-sm text-green-800 border border-green-300 rounded-lg bg-green-50 dark:bg-gray-800 dark:text-green-400 dark:border-green-800"
                    role="alert">
                    <svg class="flex-shrink-0 inline w-4 h-4 mr-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                        fill="currentColor" viewBox="0 0 20 20">
                        <path
                            d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z" />
                    </svg>
                    <span class="sr-only">Info</span>
                    <div>
                        <span class="font-medium">{{ session()->get('success') }}</span>
                    </div>
                </div>
            </div>
        @endif

        <div class="relative">
            <h1 class="text-2xl md:text-2xl text-slate-800 dark:text-slate-100 font-bold mb-12 lg:px-4">Worksheet Monthly Report</h1>
        </div>

        <div></div>

        <!-- Cards -->
        <section class="container px-4 mx-auto">
            <div class="flex flex-col">
                <div class="-mx-4 -my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                    <div class="inline-block min-w-full py-2 align-middle md:px-6 lg:px-8">
                        <div class="overflow-hidden border border-gray-200 dark:border-gray-700 md:rounded-lg">
                                <h1 class="mt-4 text-2xl text-center font-bold mb-4">WORKSHEET MONTH OF {{ now()->format('F Y') }}</h1>
                                <table class="min-w-full bg-white">
                                    <thead>
                                        <tr>
                                            <th class="py-2 px-4 border text-sm">Explanation</th>
                                            <th class="py-2 px-4 border text-sm">Capital</th>
                                            <th class="py-2 px-4 border text-sm">Company</th>
                                            <th class="py-2 px-4 border text-sm">Atm Swipe</th>
                                            <th class="py-2 px-4 border text-sm">Cash</th>
                                            <th class="py-2 px-4 border text-sm">Acct. Receivable</th>
                                            <th class="py-2 px-4 border text-sm">Acct. Payable</th>
                                            <th class="py-2 px-4 border text-sm">Salaries</th>
                                            <th class="py-2 px-4 border text-sm">Petty Cash</th>
                                            <th class="py-2 px-4 border text-sm">Office Supply</th>
                                            <th class="py-2 px-4 border text-sm">Misc. Exp.</th>
                                            <th class="py-2 px-4 border text-sm">Motor Exp.</th>
                                            <th class="py-2 px-4 border text-sm">Deposit</th>
                                            <th class="py-2 px-4 border text-sm">POS Encashment</th>
                                            <th class="py-2 px-4 border text-sm">Death Aid</th>
                                            <th class="py-2 px-4 border text-sm">CBL Payment</th>
                                            <th class="py-2 px-4 border text-sm">CBM Release</th>
                                            <th class="py-2 px-4 border text-sm">Penalty</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($expenses as $expense)
                                        <tr class="hover:bg-gray-100">
                                            <td class="py-2 px-4 border text-xs">{{ $expense->acc_title }}</td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="mt-4 text-right">
                <a href="{{ route('bamonth.export') }}" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-800">Export to Excel</a>
            </div>
        </section>


    </div>
</x-app-layout>
