<x-app-layout>
    <div class="px-4 sm:px-6 lg:px-8 py-8 w-full max-w-9xl mx-auto">
        @if (session()->has('success'))
            <div class="alert alert-success">
                <div class="flex items-center p-4 mb-4 text-sm text-green-800 border border-green-300 rounded-lg bg-green-50 dark:bg-gray-800 dark:text-green-400 dark:border-green-800" role="alert">
                    <svg class="flex-shrink-0 inline w-4 h-4 mr-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z"/>
                    </svg>
                    <span class="sr-only">Info</span>
                    <div>
                        <span class="font-medium">{{ session()->get('success') }}</span>
                    </div>
                </div>
            </div>
        @endif
        @if (session()->has('error'))
            <div class="alert alert-error">
                <div class="flex items-center p-4 mb-4 text-sm text-red-800 border border-red-300 rounded-lg bg-red-50 dark:bg-gray-800 dark:text-red-400 dark:border-red-800" role="alert">
                    <svg class="flex-shrink-0 inline w-4 h-4 mr-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M10 18a8 8 0 1 0 0-16 8 8 0 0 0 0 16zm8-8A8 8 0 1 1 2 10a8 8 0 0 1 16 0zm-9-.293a1 1 0 0 0-.707 1.707L10.293 10l-1.586 1.586a1 1 0 1 0 1.414 1.414L11 11.414l1.293 1.293a1 1 0 0 0 1.414-1.414L11.414 10l1.586-1.586a1 1 0 0 0-1.414-1.414L10 8.586 8.707 7.293a1 1 0 0 0-1.414 1.414L8.586 10 7.293 11.293a1 1 0 0 0 1.414 1.414L10 11.414l1.293 1.293a1 1 0 0 0 1.414-1.414L11.414 10l1.586-1.586a1 1 0 0 0-1.414-1.414L10 8.586 8.707 7.293z"/>
                    </svg>
                    <span class="sr-only">Error</span>
                    <div>
                        <span class="font-medium">{{ session()->get('error') }}</span>
                    </div>
                </div>
            </div>
        @endif

        <div class="relative">
            <h1 class="text-2xl md:text-2xl text-fonts-200 dark:text-slate-100 font-bold mb-4">Loan Summary</h1>
        </div>

        <div class="p-6 w-full max-w-[1500px] mx-auto bg-white rounded-lg border border-bgbody-200">
            <div class="sm:flex sm:justify-between sm:items-center mb-4">
                <form action="{{ route('loan-summary.index') }}" method="GET" class="flex items-center">
                    <div class="grid grid-cols-1 md:grid-cols-1 gap-4">
                        <div>
                            <input type="text" name="date" value="{{ $dateRange }}" placeholder="mm/dd/yyyy - mm/dd/yyyy" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm datepicker">
                        </div>
                    </div>
                    <button type="submit" class="ml-4 inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                        Apply Filter
                    </button>
                </form>

                <div class="flex items-center space-x-4">
                    <form action="{{ route('loan-summary.export') }}" method="POST" class="ml-4">
                        @csrf
                        <input type="hidden" name="date" value="{{ $dateRange }}">
                        <button type="submit" class="inline-flex items-center px-4 py-2 bg-green-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-green-500 active:bg-green-700 focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-2 transition ease-in-out duration-150">
                            Export to Docx
                        </button>
                    </form>

                    <form action="{{ route('loan-summary.print') }}" method="GET" class="ml-4">
                        <input type="hidden" name="date" value="{{ $dateRange }}">
                        <button type="submit" class="inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-500 active:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition ease-in-out duration-150">
                            Print
                        </button>
                    </form>
                </div>
            </div>

            <div class="overflow-x-auto">
                <table class="min-w-full border-collapse text-left text-sm rounded-md overflow-hidden">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="p-4 text-fonts-100 font-normal">Loan ID</th>
                            <th class="p-4 text-fonts-100 font-normal">Customer Name</th>
                            <th class="p-4 text-fonts-100 font-normal">Customer Type</th>
                            <th class="p-4 text-fonts-100 font-normal">Loan Date</th>
                            <th class="p-4 text-fonts-100 font-normal">Principal Amount</th>
                            <th class="p-4 text-fonts-100 font-normal">Payable Amount</th>
                            <th class="p-4 text-fonts-100 font-normal">Status</th>
                        </tr>
                    </thead>
                    <tbody class="text-gray-600 font-semibold text-sm">
                        @foreach($loans as $loan)
                            <tr class="border-b hover:bg-gray-50">
                                <td class="px-4 py-4 text-sm text-gray-500 dark:text-gray-200 whitespace-nowrap">{{ $loan->id }}</td>
                                <td class="px-4 py-4 text-sm text-gray-500 dark:text-gray-300 whitespace-nowrap">{{ $loan->customer->first_name }} {{ $loan->customer->last_name }}</td>
                                <td class="px-4 py-4 text-sm text-gray-500 dark:text-gray-300 whitespace-nowrap">{{ $loan->customer->customerType->description }}</td>
                                <td class="px-4 py-4 text-sm text-gray-500 dark:text-gray-300 whitespace-nowrap">{{ $loan->date_of_loan }}</td>
                                <td class="px-4 py-4 text-sm text-gray-500 dark:text-gray-300 whitespace-nowrap">{{ number_format($loan->principal_amount, 2) }}</td>
                                <td class="px-4 py-4 text-sm text-gray-500 dark:text-gray-300 whitespace-nowrap">{{ $loan->payable_amount }}</td>
                                <td class="px-4 py-4 text-sm whitespace-nowrap">
                                    <span class="px-2 py-1 text-xs font-semibold rounded-full {{ $loan->status === 'FULPD' ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                        {{ $loan->status }}
                                    </span>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div class="mt-6">
                {{ $loans->links() }}
            </div>
        </div>
    </div>

    <script>
        flatpickr('.datepicker', {
            dateFormat: 'm/d/Y',
            allowInput: true,
            maxDate: new Date(),
            mode: 'range',
            defaultDate: '{{ $dateRange }}'
        });
    </script>
</x-app-layout>