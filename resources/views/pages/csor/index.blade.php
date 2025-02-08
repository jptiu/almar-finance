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

        <form action="{{ route('print.index') }}" method="GET">
            @csrf
            <!-- Dashboard actions -->
            <div class="sm:flex sm:justify-between sm:items-center mb-4 ml-4">
                <div class="relative">
                    <h1 class="text-2xl md:text-2xl text-slate-800 dark:text-slate-100 font-bold">CSOR</h1>
                </div>
                <!-- Right: Actions -->
                <div class="grid grid-flow-col sm:auto-cols-max justify-start sm:justify-end gap-2 mr-4">
                    <div class="relative">
                        <input name="date_range" id="date_range"
                            class="datepicker form-input pl-9 dark:bg-slate-800 text-slate-500 hover:text-slate-600 dark:text-slate-300 dark:hover:text-slate-200 font-medium w-[15.5rem]"
                            placeholder="Select dates" data-class="flatpickr-right" />
                        <div class="absolute inset-0 right-auto flex items-center pointer-events-none">
                            <svg class="w-4 h-4 fill-current text-slate-500 dark:text-slate-400 ml-3"
                                viewBox="0 0 16 16">
                                <path
                                    d="M15 2h-2V0h-2v2H9V0H7v2H5V0H3v2H1a1 1 0 00-1 1v12a1 1 0 001 1h14a1 1 0 001-1V3a1 1 0 00-1-1zm-1 12H2V6h12v8z" />
                            </svg>
                        </div>
                        <button type="sumbit"
                            class="bg-indigo-500 hover:bg-primary-200 text-white py-2 px-4 rounded">Apply</button>
                    </div>
                </div>

            </div>

            <div></div>

            <section class="container px-4 mx-auto mt-8">
                <div class="flex flex-col">
                    <div class="-mx-4 -my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                        <div class="inline-block min-w-full py-2 align-middle md:px-6 lg:px-8">
                            <div
                                class="bg-white rounded shadow-lg p-4 px-4 md:p-8 mb-6 overflow-hidden border border-gray-200 dark:border-gray-700 md:rounded-lg">
                                <div class="">
                                    <div id="loading"
                                        class="hidden fixed inset-0 bg-gray-500 bg-opacity-90 flex items-center justify-center z-50">
                                        <div
                                            class="loader ease-linear rounded-full border-8 border-t-8 border-gray-200 h-32 w-32 mb-4">
                                        </div>
                                    </div>
                                    <div id="loading-message"
                                        class="hidden fixed inset-0 flex items-center justify-center bg-gray-500 bg-opacity-90 z-50 text-white text-lg">
                                        Please wait a moment...
                                    </div>
                                    <div id="step1" class="">
                                        <div class="flex place-content-center justify-center items-center mb-16 mt-2">
                                            <ol class="space-y-4 sm:flex sm:space-x-6 sm:space-y-0 rtl:space-x-reverse">
                                                <li
                                                    class="flex items-center text-blue-600 dark:text-gray-400 space-x-2.5 rtl:space-x-reverse">
                                                    <span
                                                        class="flex items-center justify-center w-8 h-8 border border-blue-600 rounded-full shrink-0 dark:border-gray-400">
                                                        1
                                                    </span>
                                                    <span>
                                                        <h3 class="font-medium leading-tight">Expenses</h3>
                                                    </span>
                                                </li>
                                                <li
                                                    class="flex items-center text-gray-500 dark:text-gray-400 space-x-2.5 rtl:space-x-reverse">
                                                    <span
                                                        class="flex items-center justify-center w-8 h-8 border border-gray-500 rounded-full shrink-0 dark:border-gray-400">
                                                        2
                                                    </span>
                                                    <span>
                                                        <h3 class="font-medium leading-tight">Breakdown of Cash Bills
                                                        </h3>
                                                    </span>
                                                    <svg class="w-3 h-3 ms-2 sm:ms-4 rtl:rotate-180" aria-hidden="true"
                                                        xmlns="http://www.w3.org/2000/svg" fill="none"
                                                        viewBox="0 0 12 10">
                                                        <path stroke="currentColor" stroke-linecap="round"
                                                            stroke-linejoin="round" stroke-width="2"
                                                            d="m7 9 4-4-4-4M1 9l4-4-4-4" />
                                                    </svg>
                                                </li>
                                                <li
                                                    class="flex items-center text-gray-500 dark:text-gray-400 space-x-2.5 rtl:space-x-reverse">
                                                    <span
                                                        class="flex items-center justify-center w-8 h-8 border border-gray-500 rounded-full shrink-0 dark:border-gray-400">
                                                        3
                                                    </span>
                                                    <span>
                                                        <h3 class="font-medium leading-tight">Savings</h3>
                                                    </span>
                                                    <svg class="w-3 h-3 ms-2 sm:ms-4 rtl:rotate-180" aria-hidden="true"
                                                        xmlns="http://www.w3.org/2000/svg" fill="none"
                                                        viewBox="0 0 12 10">
                                                        <path stroke="currentColor" stroke-linecap="round"
                                                            stroke-linejoin="round" stroke-width="2"
                                                            d="m7 9 4-4-4-4M1 9l4-4-4-4" />
                                                    </svg>
                                                </li>
                                                <li
                                                    class="flex items-center text-gray-500 dark:text-gray-400 space-x-2.5 rtl:space-x-reverse">
                                                    <span
                                                        class="flex items-center justify-center w-8 h-8 border border-gray-500 rounded-full shrink-0 dark:border-gray-400">
                                                        4
                                                    </span>
                                                    <span>
                                                        <h3 class="font-medium leading-tight">Compute Cash On Hand</h3>
                                                    </span>
                                                    <svg class="w-3 h-3 ms-2 sm:ms-4 rtl:rotate-180" aria-hidden="true"
                                                        xmlns="http://www.w3.org/2000/svg" fill="none"
                                                        viewBox="0 0 12 10">
                                                        <path stroke="currentColor" stroke-linecap="round"
                                                            stroke-linejoin="round" stroke-width="2"
                                                            d="m7 9 4-4-4-4M1 9l4-4-4-4" />
                                                    </svg>
                                                </li>
                                                <li
                                                    class="flex items-center text-gray-500 dark:text-gray-400 space-x-2.5 rtl:space-x-reverse">
                                                    <span
                                                        class="flex items-center justify-center w-8 h-8 border border-gray-500 rounded-full shrink-0 dark:border-gray-400">
                                                        5
                                                    </span>
                                                    <span>
                                                        <h3 class="font-medium leading-tight">Regular & Bad Accounts
                                                        </h3>
                                                    </span>
                                                    <svg class="w-3 h-3 ms-2 sm:ms-4 rtl:rotate-180" aria-hidden="true"
                                                        xmlns="http://www.w3.org/2000/svg" fill="none"
                                                        viewBox="0 0 12 10">
                                                        <path stroke="currentColor" stroke-linecap="round"
                                                            stroke-linejoin="round" stroke-width="2"
                                                            d="m7 9 4-4-4-4M1 9l4-4-4-4" />
                                                    </svg>
                                                </li>
                                                <li
                                                    class="flex items-center text-gray-500 dark:text-gray-400 space-x-2.5 rtl:space-x-reverse">
                                                    <span
                                                        class="flex items-center justify-center w-8 h-8 border border-gray-500 rounded-full shrink-0 dark:border-gray-400">
                                                        6
                                                    </span>
                                                    <span>
                                                        <h3 class="font-medium leading-tight">Print</h3>
                                                    </span>
                                                    <svg class="w-3 h-3 ms-2 sm:ms-4 rtl:rotate-180" aria-hidden="true"
                                                        xmlns="http://www.w3.org/2000/svg" fill="none"
                                                        viewBox="0 0 12 10">
                                                        <path stroke="currentColor" stroke-linecap="round"
                                                            stroke-linejoin="round" stroke-width="2"
                                                            d="m7 9 4-4-4-4M1 9l4-4-4-4" />
                                                    </svg>
                                                </li>
                                            </ol>
                                        </div>



                                        <div class="mt-6">
                                            <div class="mb-1">
                                                <div
                                                    class="overflow-hidden border border-gray-200 dark:border-gray-700 md:rounded-lg">
                                                    <table
                                                        class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                                                        <thead class="bg-gray-50 dark:bg-gray-800">
                                                            <tr>
                                                                <th scope="col"
                                                                    class="px-4 py-3.5 text-sm font-normal text-left rtl:text-right text-gray-500 dark:text-gray-400">
                                                                    Acct Title
                                                                </th>

                                                                <th scope="col"
                                                                    class="px-4 py-3.5 text-sm font-normal text-left rtl:text-right text-gray-500 dark:text-gray-400">
                                                                    Justification
                                                                </th>

                                                                <th scope="col"
                                                                    class="px-4 py-3.5 text-sm font-normal text-left rtl:text-right text-gray-500 dark:text-gray-400">
                                                                    Amounnt
                                                                </th>

                                                            </tr>
                                                        </thead>
                                                        <tbody
                                                            class="bg-white divide-y divide-gray-200 dark:divide-gray-500 dark:bg-gray-900">
                                                            @foreach ($expenses as $exp)
                                                                <tr>
                                                                    <td
                                                                        class="px-4 py-4 text-sm font-medium text-gray-500 dark:text-gray-200 whitespace-nowrap">
                                                                        {{ $exp->acc_title }}
                                                                    </td>
                                                                    <td
                                                                        class="px-4 py-4 text-sm font-medium text-gray-500 dark:text-gray-200 whitespace-nowrap">
                                                                        {{ $exp->justification }}
                                                                    </td>
                                                                    <td
                                                                        class="px-4 py-4 text-sm text-gray-500 dark:text-gray-300 whitespace-nowrap">
                                                                        {{ $exp->amount }}
                                                                    </td>
                                                                </tr>
                                                            @endforeach
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div id="step2" class="hidden">
                                        <div class="flex place-content-center justify-center items-center mb-16 mt-2">
                                            <ol
                                                class="space-y-4 sm:flex sm:space-x-6 sm:space-y-0 rtl:space-x-reverse">
                                                <li
                                                    class="flex items-center text-gray-500 dark:text-gray-400 space-x-2.5 rtl:space-x-reverse">
                                                    <span
                                                        class="flex items-center justify-center w-8 h-8 border border-gray-500 rounded-full shrink-0 dark:border-gray-400">
                                                        1
                                                    </span>
                                                    <span>
                                                        <h3 class="font-medium leading-tight">Expenses</h3>
                                                    </span>
                                                </li>
                                                <li
                                                    class="flex items-center text-blue-600 dark:text-gray-400 space-x-2.5 rtl:space-x-reverse">
                                                    <span
                                                        class="flex items-center justify-center w-8 h-8 border border-blue-600 rounded-full shrink-0 dark:border-gray-400">
                                                        2
                                                    </span>
                                                    <span>
                                                        <h3 class="font-medium leading-tight">Breakdown of Cash Bills
                                                        </h3>
                                                    </span>
                                                    <svg class="w-3 h-3 ms-2 sm:ms-4 rtl:rotate-180"
                                                        aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                                        fill="none" viewBox="0 0 12 10">
                                                        <path stroke="currentColor" stroke-linecap="round"
                                                            stroke-linejoin="round" stroke-width="2"
                                                            d="m7 9 4-4-4-4M1 9l4-4-4-4" />
                                                    </svg>
                                                </li>
                                                <li
                                                    class="flex items-center text-gray-500 dark:text-gray-400 space-x-2.5 rtl:space-x-reverse">
                                                    <span
                                                        class="flex items-center justify-center w-8 h-8 border border-gray-500 rounded-full shrink-0 dark:border-gray-400">
                                                        3
                                                    </span>
                                                    <span>
                                                        <h3 class="font-medium leading-tight">Savings</h3>
                                                    </span>
                                                    <svg class="w-3 h-3 ms-2 sm:ms-4 rtl:rotate-180"
                                                        aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                                        fill="none" viewBox="0 0 12 10">
                                                        <path stroke="currentColor" stroke-linecap="round"
                                                            stroke-linejoin="round" stroke-width="2"
                                                            d="m7 9 4-4-4-4M1 9l4-4-4-4" />
                                                    </svg>
                                                </li>
                                                <li
                                                    class="flex items-center text-gray-500 dark:text-gray-400 space-x-2.5 rtl:space-x-reverse">
                                                    <span
                                                        class="flex items-center justify-center w-8 h-8 border border-gray-500 rounded-full shrink-0 dark:border-gray-400">
                                                        4
                                                    </span>
                                                    <span>
                                                        <h3 class="font-medium leading-tight">Compute Cash On Hand</h3>
                                                    </span>
                                                    <svg class="w-3 h-3 ms-2 sm:ms-4 rtl:rotate-180"
                                                        aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                                        fill="none" viewBox="0 0 12 10">
                                                        <path stroke="currentColor" stroke-linecap="round"
                                                            stroke-linejoin="round" stroke-width="2"
                                                            d="m7 9 4-4-4-4M1 9l4-4-4-4" />
                                                    </svg>
                                                </li>
                                                <li
                                                    class="flex items-center text-gray-500 dark:text-gray-400 space-x-2.5 rtl:space-x-reverse">
                                                    <span
                                                        class="flex items-center justify-center w-8 h-8 border border-gray-500 rounded-full shrink-0 dark:border-gray-400">
                                                        5
                                                    </span>
                                                    <span>
                                                        <h3 class="font-medium leading-tight">Regular & Bad Accounts
                                                        </h3>
                                                    </span>
                                                    <svg class="w-3 h-3 ms-2 sm:ms-4 rtl:rotate-180"
                                                        aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                                        fill="none" viewBox="0 0 12 10">
                                                        <path stroke="currentColor" stroke-linecap="round"
                                                            stroke-linejoin="round" stroke-width="2"
                                                            d="m7 9 4-4-4-4M1 9l4-4-4-4" />
                                                    </svg>
                                                </li>
                                                <li
                                                    class="flex items-center text-gray-500 dark:text-gray-400 space-x-2.5 rtl:space-x-reverse">
                                                    <span
                                                        class="flex items-center justify-center w-8 h-8 border border-gray-500 rounded-full shrink-0 dark:border-gray-400">
                                                        6
                                                    </span>
                                                    <span>
                                                        <h3 class="font-medium leading-tight">Print</h3>
                                                    </span>
                                                    <svg class="w-3 h-3 ms-2 sm:ms-4 rtl:rotate-180"
                                                        aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                                        fill="none" viewBox="0 0 12 10">
                                                        <path stroke="currentColor" stroke-linecap="round"
                                                            stroke-linejoin="round" stroke-width="2"
                                                            d="m7 9 4-4-4-4M1 9l4-4-4-4" />
                                                    </svg>
                                                </li>
                                            </ol>
                                        </div>



                                        <div class="mt-6">
                                            <div class="mb-1">
                                                <div
                                                    class="overflow-hidden border border-gray-200 dark:border-gray-700 md:rounded-lg">
                                                    <table
                                                        class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                                                        <thead class="bg-gray-50 dark:bg-gray-800">
                                                            <tr>
                                                                <th scope="col"
                                                                    class="px-4 py-3.5 text-sm font-normal text-left rtl:text-right text-gray-500 dark:text-gray-400">
                                                                    Denomination
                                                                </th>

                                                                <th scope="col"
                                                                    class="px-4 py-3.5 text-sm font-normal text-left rtl:text-right text-gray-500 dark:text-gray-400">
                                                                    Type
                                                                </th>

                                                                <th scope="col"
                                                                    class="px-4 py-3.5 text-sm font-normal text-left rtl:text-right text-gray-500 dark:text-gray-400">
                                                                    Qty
                                                                </th>

                                                                <th scope="col"
                                                                    class="px-4 py-3.5 text-sm font-normal text-left rtl:text-right text-gray-500 dark:text-gray-400">
                                                                    Amt
                                                                </th>

                                                            </tr>
                                                        </thead>
                                                        <tbody
                                                            class="bg-white divide-y divide-gray-200 dark:divide-gray-500 dark:bg-gray-900">
                                                            @php
                                                                $grandTotal = 0; // Initialize a variable to hold the grand total sum
                                                            @endphp

                                                            @foreach ($cashBillData as $data)
                                                                {{-- No need for `$denomination => $data` --}}
                                                                @if ($data['count'] > 0)
                                                                    <tr>
                                                                        <td
                                                                            class="px-4 py-4 text-sm font-medium text-gray-500 dark:text-gray-200 whitespace-nowrap">
                                                                            {{ number_format((float) $data['denomination'], 2) }}
                                                                        </td>
                                                                        <td
                                                                            class="px-4 py-4 text-sm font-medium text-gray-500 dark:text-gray-200 whitespace-nowrap">
                                                                            {{ $data['type'] }}
                                                                        </td>
                                                                        <td
                                                                            class="px-4 py-4 text-sm text-gray-500 dark:text-gray-300 whitespace-nowrap">
                                                                            {{ $data['count'] }}
                                                                        </td>
                                                                        <td
                                                                            class="px-4 py-4 text-sm text-gray-500 dark:text-gray-300 whitespace-nowrap">
                                                                            {{ number_format($data['sum'], 2) }}
                                                                        </td>
                                                                    </tr>
                                                                    @php
                                                                        $grandTotal += $data['sum']; // Add the sum of each row to the grand total
                                                                    @endphp
                                                                @endif
                                                            @endforeach
                                                        </tbody>

                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div id="step3" class="hidden">
                                    <div class="flex place-content-center justify-center items-center mb-16 mt-2">
                                        <ol class="space-y-4 sm:flex sm:space-x-6 sm:space-y-0 rtl:space-x-reverse">
                                            <li
                                                class="flex items-center text-gray-500 dark:text-gray-400 space-x-2.5 rtl:space-x-reverse">
                                                <span
                                                    class="flex items-center justify-center w-8 h-8 border border-gray-500 rounded-full shrink-0 dark:border-gray-400">
                                                    1
                                                </span>
                                                <span>
                                                    <h3 class="font-medium leading-tight">Expenses</h3>
                                                </span>
                                            </li>
                                            <li
                                                class="flex items-center text-gray-500 dark:text-gray-400 space-x-2.5 rtl:space-x-reverse">
                                                <span
                                                    class="flex items-center justify-center w-8 h-8 border border-gray-500 rounded-full shrink-0 dark:border-gray-400">
                                                    2
                                                </span>
                                                <span>
                                                    <h3 class="font-medium leading-tight">Breakdown of Cash Bills</h3>
                                                </span>
                                                <svg class="w-3 h-3 ms-2 sm:ms-4 rtl:rotate-180" aria-hidden="true"
                                                    xmlns="http://www.w3.org/2000/svg" fill="none"
                                                    viewBox="0 0 12 10">
                                                    <path stroke="currentColor" stroke-linecap="round"
                                                        stroke-linejoin="round" stroke-width="2"
                                                        d="m7 9 4-4-4-4M1 9l4-4-4-4" />
                                                </svg>
                                            </li>
                                            <li
                                                class="flex items-center text-blue-600 dark:text-gray-400 space-x-2.5 rtl:space-x-reverse">
                                                <span
                                                    class="flex items-center justify-center w-8 h-8 border border-blue-600 rounded-full shrink-0 dark:border-gray-400">
                                                    3
                                                </span>
                                                <span>
                                                    <h3 class="font-medium leading-tight">Savings</h3>
                                                </span>
                                                <svg class="w-3 h-3 ms-2 sm:ms-4 rtl:rotate-180" aria-hidden="true"
                                                    xmlns="http://www.w3.org/2000/svg" fill="none"
                                                    viewBox="0 0 12 10">
                                                    <path stroke="currentColor" stroke-linecap="round"
                                                        stroke-linejoin="round" stroke-width="2"
                                                        d="m7 9 4-4-4-4M1 9l4-4-4-4" />
                                                </svg>
                                            </li>
                                            <li
                                                class="flex items-center text-gray-500 dark:text-gray-400 space-x-2.5 rtl:space-x-reverse">
                                                <span
                                                    class="flex items-center justify-center w-8 h-8 border border-gray-500 rounded-full shrink-0 dark:border-gray-400">
                                                    4
                                                </span>
                                                <span>
                                                    <h3 class="font-medium leading-tight">Compute Cash On Hand</h3>
                                                </span>
                                                <svg class="w-3 h-3 ms-2 sm:ms-4 rtl:rotate-180" aria-hidden="true"
                                                    xmlns="http://www.w3.org/2000/svg" fill="none"
                                                    viewBox="0 0 12 10">
                                                    <path stroke="currentColor" stroke-linecap="round"
                                                        stroke-linejoin="round" stroke-width="2"
                                                        d="m7 9 4-4-4-4M1 9l4-4-4-4" />
                                                </svg>
                                            </li>
                                            <li
                                                class="flex items-center text-gray-500 dark:text-gray-400 space-x-2.5 rtl:space-x-reverse">
                                                <span
                                                    class="flex items-center justify-center w-8 h-8 border border-gray-500 rounded-full shrink-0 dark:border-gray-400">
                                                    5
                                                </span>
                                                <span>
                                                    <h3 class="font-medium leading-tight">Regular & Bad Accounts</h3>
                                                </span>
                                                <svg class="w-3 h-3 ms-2 sm:ms-4 rtl:rotate-180" aria-hidden="true"
                                                    xmlns="http://www.w3.org/2000/svg" fill="none"
                                                    viewBox="0 0 12 10">
                                                    <path stroke="currentColor" stroke-linecap="round"
                                                        stroke-linejoin="round" stroke-width="2"
                                                        d="m7 9 4-4-4-4M1 9l4-4-4-4" />
                                                </svg>
                                            </li>
                                            <li
                                                class="flex items-center text-gray-500 dark:text-gray-400 space-x-2.5 rtl:space-x-reverse">
                                                <span
                                                    class="flex items-center justify-center w-8 h-8 border border-gray-500 rounded-full shrink-0 dark:border-gray-400">
                                                    6
                                                </span>
                                                <span>
                                                    <h3 class="font-medium leading-tight">Print</h3>
                                                </span>
                                                <svg class="w-3 h-3 ms-2 sm:ms-4 rtl:rotate-180" aria-hidden="true"
                                                    xmlns="http://www.w3.org/2000/svg" fill="none"
                                                    viewBox="0 0 12 10">
                                                    <path stroke="currentColor" stroke-linecap="round"
                                                        stroke-linejoin="round" stroke-width="2"
                                                        d="m7 9 4-4-4-4M1 9l4-4-4-4" />
                                                </svg>
                                            </li>
                                        </ol>
                                    </div>
                                    <div class="">


                                        <div class="mt-6">
                                            <div class="mb-1">
                                                <div
                                                    class="overflow-hidden border border-gray-200 dark:border-gray-700 md:rounded-lg">
                                                    <table
                                                        class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                                                        <thead class="bg-gray-50 dark:bg-gray-800">
                                                            <tr>
                                                                <th scope="col"
                                                                    class="px-4 py-3.5 text-sm font-normal text-left rtl:text-right text-gray-500 dark:text-gray-400">
                                                                    Charge Swipe
                                                                </th>

                                                                <th scope="col"
                                                                    class="px-4 py-3.5 text-sm font-normal text-left rtl:text-right text-gray-500 dark:text-gray-400">
                                                                    Savings
                                                                </th>

                                                                <th scope="col"
                                                                    class="px-4 py-3.5 text-sm font-normal text-left rtl:text-right text-gray-500 dark:text-gray-400">
                                                                    Death Aid
                                                                </th>

                                                                <th scope="col"
                                                                    class="px-4 py-3.5 text-sm font-normal text-left rtl:text-right text-gray-500 dark:text-gray-400">
                                                                    Photocopy
                                                                </th>

                                                                <th scope="col"
                                                                    class="px-4 py-3.5 text-sm font-normal text-left rtl:text-right text-gray-500 dark:text-gray-400">
                                                                    Withdraw
                                                                </th>
                                                            </tr>
                                                        </thead>
                                                        <tbody
                                                            class="bg-white divide-y divide-gray-200 dark:divide-gray-500 dark:bg-gray-900">
                                                            @foreach ($comps as $comp)
                                                                <tr>
                                                                    <td
                                                                        class="px-4 py-4 text-sm font-medium text-gray-500 dark:text-gray-200 whitespace-nowrap">
                                                                        {{ $comp->charge_swipe }}
                                                                    </td>
                                                                    <td
                                                                        class="px-4 py-4 text-sm font-medium text-gray-500 dark:text-gray-200 whitespace-nowrap">
                                                                        {{ $comp->savings }}
                                                                    </td>
                                                                    <td
                                                                        class="px-4 py-4 text-sm text-gray-500 dark:text-gray-300 whitespace-nowrap">
                                                                        {{ $comp->death_aid }}
                                                                    </td>
                                                                    <td
                                                                        class="px-4 py-4 text-sm text-gray-500 dark:text-gray-300 whitespace-nowrap">
                                                                        {{ $comp->photocopy }}
                                                                    </td>
                                                                    <td
                                                                        class="px-4 py-4 text-sm text-gray-500 dark:text-gray-300 whitespace-nowrap">
                                                                        {{ $comp->withdraw }}
                                                                    </td>
                                                                </tr>
                                                            @endforeach
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div id="step4" class="hidden">
                                    <div class="flex place-content-center justify-center items-center mb-16 mt-2">
                                        <ol class="space-y-4 sm:flex sm:space-x-6 sm:space-y-0 rtl:space-x-reverse">
                                            <li
                                                class="flex items-center text-gray-500 dark:text-gray-400 space-x-2.5 rtl:space-x-reverse">
                                                <span
                                                    class="flex items-center justify-center w-8 h-8 border border-gray-500 rounded-full shrink-0 dark:border-gray-400">
                                                    1
                                                </span>
                                                <span>
                                                    <h3 class="font-medium leading-tight">Expenses</h3>
                                                </span>
                                            </li>
                                            <li
                                                class="flex items-center text-gray-500 dark:text-gray-400 space-x-2.5 rtl:space-x-reverse">
                                                <span
                                                    class="flex items-center justify-center w-8 h-8 border border-gray-500 rounded-full shrink-0 dark:border-gray-400">
                                                    2
                                                </span>
                                                <span>
                                                    <h3 class="font-medium leading-tight">Breakdown of Cash Bills</h3>
                                                </span>
                                                <svg class="w-3 h-3 ms-2 sm:ms-4 rtl:rotate-180" aria-hidden="true"
                                                    xmlns="http://www.w3.org/2000/svg" fill="none"
                                                    viewBox="0 0 12 10">
                                                    <path stroke="currentColor" stroke-linecap="round"
                                                        stroke-linejoin="round" stroke-width="2"
                                                        d="m7 9 4-4-4-4M1 9l4-4-4-4" />
                                                </svg>
                                            </li>
                                            <li
                                                class="flex items-center text-gray-500 dark:text-gray-400 space-x-2.5 rtl:space-x-reverse">
                                                <span
                                                    class="flex items-center justify-center w-8 h-8 border border-gray-500 rounded-full shrink-0 dark:border-gray-400">
                                                    3
                                                </span>
                                                <span>
                                                    <h3 class="font-medium leading-tight">Savings</h3>
                                                </span>
                                                <svg class="w-3 h-3 ms-2 sm:ms-4 rtl:rotate-180" aria-hidden="true"
                                                    xmlns="http://www.w3.org/2000/svg" fill="none"
                                                    viewBox="0 0 12 10">
                                                    <path stroke="currentColor" stroke-linecap="round"
                                                        stroke-linejoin="round" stroke-width="2"
                                                        d="m7 9 4-4-4-4M1 9l4-4-4-4" />
                                                </svg>
                                            </li>
                                            <li
                                                class="flex items-center text-blue-600 dark:text-gray-400 space-x-2.5 rtl:space-x-reverse">
                                                <span
                                                    class="flex items-center justify-center w-8 h-8 border border-blue-600 rounded-full shrink-0 dark:border-gray-400">
                                                    4
                                                </span>
                                                <span>
                                                    <h3 class="font-medium leading-tight">Compute Cash On Hand</h3>
                                                </span>
                                                <svg class="w-3 h-3 ms-2 sm:ms-4 rtl:rotate-180" aria-hidden="true"
                                                    xmlns="http://www.w3.org/2000/svg" fill="none"
                                                    viewBox="0 0 12 10">
                                                    <path stroke="currentColor" stroke-linecap="round"
                                                        stroke-linejoin="round" stroke-width="2"
                                                        d="m7 9 4-4-4-4M1 9l4-4-4-4" />
                                                </svg>
                                            </li>
                                            <li
                                                class="flex items-center text-gray-500 dark:text-gray-400 space-x-2.5 rtl:space-x-reverse">
                                                <span
                                                    class="flex items-center justify-center w-8 h-8 border border-gray-500 rounded-full shrink-0 dark:border-gray-400">
                                                    5
                                                </span>
                                                <span>
                                                    <h3 class="font-medium leading-tight">Regular & Bad Accounts</h3>
                                                </span>
                                                <svg class="w-3 h-3 ms-2 sm:ms-4 rtl:rotate-180" aria-hidden="true"
                                                    xmlns="http://www.w3.org/2000/svg" fill="none"
                                                    viewBox="0 0 12 10">
                                                    <path stroke="currentColor" stroke-linecap="round"
                                                        stroke-linejoin="round" stroke-width="2"
                                                        d="m7 9 4-4-4-4M1 9l4-4-4-4" />
                                                </svg>
                                            </li>
                                            <li
                                                class="flex items-center text-gray-500 dark:text-gray-400 space-x-2.5 rtl:space-x-reverse">
                                                <span
                                                    class="flex items-center justify-center w-8 h-8 border border-gray-500 rounded-full shrink-0 dark:border-gray-400">
                                                    6
                                                </span>
                                                <span>
                                                    <h3 class="font-medium leading-tight">Print</h3>
                                                </span>
                                                <svg class="w-3 h-3 ms-2 sm:ms-4 rtl:rotate-180" aria-hidden="true"
                                                    xmlns="http://www.w3.org/2000/svg" fill="none"
                                                    viewBox="0 0 12 10">
                                                    <path stroke="currentColor" stroke-linecap="round"
                                                        stroke-linejoin="round" stroke-width="2"
                                                        d="m7 9 4-4-4-4M1 9l4-4-4-4" />
                                                </svg>
                                            </li>
                                        </ol>
                                    </div>
                                    <div class="">
                                        <div class="mb-1">
                                            <div class="grid gap-4 gap-y-2 text-sm grid-cols-1 lg:grid-cols-1">
                                                <div class="lg:col-span-2">
                                                    <div class="grid gap-4 gap-y-2 text-sm grid-cols-1 md:grid-cols-1">
                                                        <div class="lg:col-span-2">
                                                            <div
                                                                class="grid gap-4 gap-y-2 text-sm grid-cols-1 md:grid-cols-3">
                                                                <div class="md:col-span-1">
                                                                    <label for="coh_id">Reference No.</label>
                                                                    <input type="text" name="coh_id"
                                                                        id="coh_id"
                                                                        class="h-10 border mt-1 rounded px-4 w-full bg-gray-50"
                                                                        value="" placeholder="" />
                                                                </div>
                                                                <div class="md:col-span-1 mt-8">
                                                                    <button type="button"
                                                                        class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-1 px-4 rounded mx-2">
                                                                        Confirm
                                                                    </button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="mt-6">
                                            <div class="mb-1">
                                                <div
                                                    class="overflow-hidden border border-gray-200 dark:border-gray-700 md:rounded-lg">
                                                    <table
                                                        class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                                                        <thead class="bg-gray-50 dark:bg-gray-800">
                                                            <tr>
                                                                <th scope="col"
                                                                    class="px-4 py-3.5 text-sm font-normal text-left rtl:text-right text-gray-500 dark:text-gray-400">
                                                                    Cash Beginning
                                                                </th>

                                                                <th scope="col"
                                                                    class="px-4 py-3.5 text-sm font-normal text-left rtl:text-right text-gray-500 dark:text-gray-400">
                                                                    Collections
                                                                </th>

                                                                <th scope="col"
                                                                    class="px-4 py-3.5 text-sm font-normal text-left rtl:text-right text-gray-500 dark:text-gray-400">
                                                                    Add Cash
                                                                </th>

                                                                <th scope="col"
                                                                    class="px-4 py-3.5 text-sm font-normal text-left rtl:text-right text-gray-500 dark:text-gray-400">
                                                                    Add Cash (2nd)
                                                                </th>
                                                            </tr>
                                                        </thead>
                                                        <tbody
                                                            class="bg-white divide-y divide-gray-200 dark:divide-gray-500 dark:bg-gray-900">
                                                            @foreach ($comps as $comp)
                                                                <tr>
                                                                    <td
                                                                        class="px-4 py-4 text-sm font-medium text-gray-500 dark:text-gray-200 whitespace-nowrap">
                                                                        {{ $comp->cash_beginning }}
                                                                    </td>
                                                                    <td
                                                                        class="px-4 py-4 text-sm font-medium text-gray-500 dark:text-gray-200 whitespace-nowrap">
                                                                        {{ $comp->collection }}
                                                                    </td>
                                                                    <td
                                                                        class="px-4 py-4 text-sm text-gray-500 dark:text-gray-300 whitespace-nowrap">
                                                                        {{ $comp->add_cash }}
                                                                    </td>
                                                                    <td
                                                                        class="px-4 py-4 text-sm text-gray-500 dark:text-gray-300 whitespace-nowrap">
                                                                        {{ $comp->add_cash2 }}
                                                                    </td>
                                                                </tr>
                                                            @endforeach
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div id="step5" class="hidden">
                                    <div class="flex place-content-center justify-center items-center mb-16 mt-2">
                                        <ol class="space-y-4 sm:flex sm:space-x-6 sm:space-y-0 rtl:space-x-reverse">
                                            <li
                                                class="flex items-center text-gray-500 dark:text-gray-400 space-x-2.5 rtl:space-x-reverse">
                                                <span
                                                    class="flex items-center justify-center w-8 h-8 border border-gray-500 rounded-full shrink-0 dark:border-gray-400">
                                                    1
                                                </span>
                                                <span>
                                                    <h3 class="font-medium leading-tight">Expenses</h3>
                                                </span>
                                            </li>
                                            <li
                                                class="flex items-center text-gray-500 dark:text-gray-400 space-x-2.5 rtl:space-x-reverse">
                                                <span
                                                    class="flex items-center justify-center w-8 h-8 border border-gray-500 rounded-full shrink-0 dark:border-gray-400">
                                                    2
                                                </span>
                                                <span>
                                                    <h3 class="font-medium leading-tight">Breakdown of Cash Bills</h3>
                                                </span>
                                                <svg class="w-3 h-3 ms-2 sm:ms-4 rtl:rotate-180" aria-hidden="true"
                                                    xmlns="http://www.w3.org/2000/svg" fill="none"
                                                    viewBox="0 0 12 10">
                                                    <path stroke="currentColor" stroke-linecap="round"
                                                        stroke-linejoin="round" stroke-width="2"
                                                        d="m7 9 4-4-4-4M1 9l4-4-4-4" />
                                                </svg>
                                            </li>
                                            <li
                                                class="flex items-center text-gray-500 dark:text-gray-400 space-x-2.5 rtl:space-x-reverse">
                                                <span
                                                    class="flex items-center justify-center w-8 h-8 border border-gray-500 rounded-full shrink-0 dark:border-gray-400">
                                                    3
                                                </span>
                                                <span>
                                                    <h3 class="font-medium leading-tight">Savings</h3>
                                                </span>
                                                <svg class="w-3 h-3 ms-2 sm:ms-4 rtl:rotate-180" aria-hidden="true"
                                                    xmlns="http://www.w3.org/2000/svg" fill="none"
                                                    viewBox="0 0 12 10">
                                                    <path stroke="currentColor" stroke-linecap="round"
                                                        stroke-linejoin="round" stroke-width="2"
                                                        d="m7 9 4-4-4-4M1 9l4-4-4-4" />
                                                </svg>
                                            </li>
                                            <li
                                                class="flex items-center text-gray-500 dark:text-gray-400 space-x-2.5 rtl:space-x-reverse">
                                                <span
                                                    class="flex items-center justify-center w-8 h-8 border border-gray-500 rounded-full shrink-0 dark:border-gray-400">
                                                    4
                                                </span>
                                                <span>
                                                    <h3 class="font-medium leading-tight">Compute Cash On Hand</h3>
                                                </span>
                                                <svg class="w-3 h-3 ms-2 sm:ms-4 rtl:rotate-180" aria-hidden="true"
                                                    xmlns="http://www.w3.org/2000/svg" fill="none"
                                                    viewBox="0 0 12 10">
                                                    <path stroke="currentColor" stroke-linecap="round"
                                                        stroke-linejoin="round" stroke-width="2"
                                                        d="m7 9 4-4-4-4M1 9l4-4-4-4" />
                                                </svg>
                                            </li>
                                            <li
                                                class="flex items-center text-blue-600 dark:text-gray-400 space-x-2.5 rtl:space-x-reverse">
                                                <span
                                                    class="flex items-center justify-center w-8 h-8 border border-blue-600 rounded-full shrink-0 dark:border-gray-400">
                                                    5
                                                </span>
                                                <span>
                                                    <h3 class="font-medium leading-tight">Regular & Bad Accounts</h3>
                                                </span>
                                                <svg class="w-3 h-3 ms-2 sm:ms-4 rtl:rotate-180" aria-hidden="true"
                                                    xmlns="http://www.w3.org/2000/svg" fill="none"
                                                    viewBox="0 0 12 10">
                                                    <path stroke="currentColor" stroke-linecap="round"
                                                        stroke-linejoin="round" stroke-width="2"
                                                        d="m7 9 4-4-4-4M1 9l4-4-4-4" />
                                                </svg>
                                            </li>
                                            <li
                                                class="flex items-center text-gray-500 dark:text-gray-400 space-x-2.5 rtl:space-x-reverse">
                                                <span
                                                    class="flex items-center justify-center w-8 h-8 border border-gray-500 rounded-full shrink-0 dark:border-gray-400">
                                                    6
                                                </span>
                                                <span>
                                                    <h3 class="font-medium leading-tight">Print</h3>
                                                </span>
                                                <svg class="w-3 h-3 ms-2 sm:ms-4 rtl:rotate-180" aria-hidden="true"
                                                    xmlns="http://www.w3.org/2000/svg" fill="none"
                                                    viewBox="0 0 12 10">
                                                    <path stroke="currentColor" stroke-linecap="round"
                                                        stroke-linejoin="round" stroke-width="2"
                                                        d="m7 9 4-4-4-4M1 9l4-4-4-4" />
                                                </svg>
                                            </li>
                                        </ol>
                                    </div>
                                    <div class="">


                                        <div class="mt-2">
                                            <div class="text-2xl font-medium leading-tight py-4">Regular Accounts</div>
                                        </div>

                                        <div class="mb-1">
                                            <div class="grid gap-4 gap-y-2 text-sm grid-cols-1 lg:grid-cols-1">
                                                <div class="lg:col-span-2">
                                                    <div class="grid gap-4 gap-y-2 text-sm grid-cols-1 md:grid-cols-1">
                                                        <div class="lg:col-span-2">
                                                            <div
                                                                class="grid gap-4 gap-y-2 text-sm grid-cols-1 md:grid-cols-4">
                                                                <div class="md:col-span-2">
                                                                    <div
                                                                        class="overflow-hidden border border-gray-200 dark:border-gray-700 md:rounded-lg">
                                                                        <div
                                                                            class="text-lg font-medium leading-tight p-4 text-center bg-blue-100 dark:bg-gray-800 border border-gray-20">
                                                                            Regular Loans</div>
                                                                        <table
                                                                            class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                                                                            <thead class="bg-gray-50 dark:bg-gray-800">
                                                                                <tr>
                                                                                    <th scope="col"
                                                                                        class="px-4 py-3.5 text-sm font-normal text-left rtl:text-right text-gray-500 dark:text-gray-400">
                                                                                        No. of Customer
                                                                                    </th>

                                                                                    <th scope="col"
                                                                                        class="px-4 py-3.5 text-sm font-normal text-left rtl:text-right text-gray-500 dark:text-gray-400">
                                                                                        Receivable Amount
                                                                                    </th>

                                                                                    <th scope="col"
                                                                                        class="px-4 py-3.5 text-sm font-normal text-left rtl:text-right text-gray-500 dark:text-gray-400">
                                                                                        Actual Collection
                                                                                    </th>
                                                                                </tr>
                                                                            </thead>
                                                                            <tbody
                                                                                class="bg-white divide-y divide-gray-200 dark:divide-gray-500 dark:bg-gray-900">
                                                                                <tr>
                                                                                    <td
                                                                                        class="px-4 py-4 text-sm font-medium text-gray-500 dark:text-gray-200 whitespace-nowrap">
                                                                                        {{ $customerCountRegular }}
                                                                                    </td>
                                                                                    <td
                                                                                        class="px-4 py-4 text-sm font-medium text-gray-500 dark:text-gray-200 whitespace-nowrap">
                                                                                        {{ number_format($receivableAmountRegular, 2) }}
                                                                                    </td>
                                                                                    <td
                                                                                        class="px-4 py-4 text-sm text-gray-500 dark:text-gray-300 whitespace-nowrap">
                                                                                        {{ number_format($collectionAmountRegular, 2) }}
                                                                                    </td>
                                                                                </tr>
                                                                            </tbody>
                                                                        </table>
                                                                    </div>
                                                                </div>
                                                                <div class="md:col-span-2">
                                                                    <div
                                                                        class="overflow-hidden border border-gray-200 dark:border-gray-700 md:rounded-lg">
                                                                        <div
                                                                            class="text-lg font-medium leading-tight p-4 text-center bg-blue-100 dark:bg-gray-800 border border-gray-20">
                                                                            C/A Monthly</div>
                                                                        <table
                                                                            class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                                                                            <thead class="bg-gray-50 dark:bg-gray-800">
                                                                                <tr>
                                                                                    <th scope="col"
                                                                                        class="px-4 py-3.5 text-sm font-normal text-left rtl:text-right text-gray-500 dark:text-gray-400">
                                                                                        No. of Customer
                                                                                    </th>

                                                                                    <th scope="col"
                                                                                        class="px-4 py-3.5 text-sm font-normal text-left rtl:text-right text-gray-500 dark:text-gray-400">
                                                                                        Receivable Amount
                                                                                    </th>

                                                                                    <th scope="col"
                                                                                        class="px-4 py-3.5 text-sm font-normal text-left rtl:text-right text-gray-500 dark:text-gray-400">
                                                                                        Actual Collection
                                                                                    </th>
                                                                                </tr>
                                                                            </thead>
                                                                            <tbody
                                                                                class="bg-white divide-y divide-gray-200 dark:divide-gray-500 dark:bg-gray-900">
                                                                                <tr>
                                                                                    <td
                                                                                        class="px-4 py-4 text-sm font-medium text-gray-500 dark:text-gray-200 whitespace-nowrap">
                                                                                        {{ $customerCountCA }}
                                                                                    </td>
                                                                                    <td
                                                                                        class="px-4 py-4 text-sm font-medium text-gray-500 dark:text-gray-200 whitespace-nowrap">
                                                                                        {{ number_format($receivableAmountCA, 2) }}
                                                                                    </td>
                                                                                    <td
                                                                                        class="px-4 py-4 text-sm text-gray-500 dark:text-gray-300 whitespace-nowrap">
                                                                                        {{ number_format($collectionAmountCA, 2) }}
                                                                                    </td>
                                                                                </tr>
                                                                            </tbody>
                                                                        </table>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="mt-12">


                                        <div class="mt-2">
                                            <div class="text-2xl font-medium leading-tight py-4">Bad Accounts</div>
                                        </div>

                                        <div class="mb-1">
                                            <div class="grid gap-4 gap-y-2 text-sm grid-cols-1 lg:grid-cols-1">
                                                <div class="lg:col-span-2">
                                                    <div class="grid gap-4 gap-y-2 text-sm grid-cols-1 md:grid-cols-1">
                                                        <div class="lg:col-span-2">
                                                            <div
                                                                class="grid gap-4 gap-y-2 text-sm grid-cols-1 md:grid-cols-4">
                                                                <div class="md:col-span-2">
                                                                    <div
                                                                        class="overflow-hidden border border-gray-200 dark:border-gray-700 md:rounded-lg">
                                                                        <div
                                                                            class="text-lg font-medium leading-tight p-4 text-center bg-blue-100 dark:bg-gray-800 border border-gray-20">
                                                                            Active</div>
                                                                        <table
                                                                            class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                                                                            <thead class="bg-gray-50 dark:bg-gray-800">
                                                                                <tr>
                                                                                    <th scope="col"
                                                                                        class="px-4 py-3.5 text-sm font-normal text-left rtl:text-right text-gray-500 dark:text-gray-400">
                                                                                        No. of Customer
                                                                                    </th>

                                                                                    <th scope="col"
                                                                                        class="px-4 py-3.5 text-sm font-normal text-left rtl:text-right text-gray-500 dark:text-gray-400">
                                                                                        Receivable Amount
                                                                                    </th>

                                                                                    <th scope="col"
                                                                                        class="px-4 py-3.5 text-sm font-normal text-left rtl:text-right text-gray-500 dark:text-gray-400">
                                                                                        Actual Collection
                                                                                    </th>
                                                                                </tr>
                                                                            </thead>
                                                                            <tbody
                                                                                class="bg-white divide-y divide-gray-200 dark:divide-gray-500 dark:bg-gray-900">
                                                                                <tr>
                                                                                    <td
                                                                                        class="px-4 py-4 text-sm font-medium text-gray-500 dark:text-gray-200 whitespace-nowrap">
                                                                                        test
                                                                                    </td>
                                                                                    <td
                                                                                        class="px-4 py-4 text-sm font-medium text-gray-500 dark:text-gray-200 whitespace-nowrap">
                                                                                        test
                                                                                    </td>
                                                                                    <td
                                                                                        class="px-4 py-4 text-sm text-gray-500 dark:text-gray-300 whitespace-nowrap">
                                                                                        test
                                                                                    </td>
                                                                                </tr>
                                                                            </tbody>
                                                                        </table>
                                                                    </div>
                                                                </div>
                                                                <div class="md:col-span-2">
                                                                    <div
                                                                        class="overflow-hidden border border-gray-200 dark:border-gray-700 md:rounded-lg">
                                                                        <div
                                                                            class="text-lg font-medium leading-tight p-4 text-center bg-blue-100 dark:bg-gray-800 border border-gray-20">
                                                                            C/A Becomes BA</div>
                                                                        <table
                                                                            class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                                                                            <thead class="bg-gray-50 dark:bg-gray-800">
                                                                                <tr>
                                                                                    <th scope="col"
                                                                                        class="px-4 py-3.5 text-sm font-normal text-left rtl:text-right text-gray-500 dark:text-gray-400">
                                                                                        No. of Customer
                                                                                    </th>

                                                                                    <th scope="col"
                                                                                        class="px-4 py-3.5 text-sm font-normal text-left rtl:text-right text-gray-500 dark:text-gray-400">
                                                                                        Receivable Amount
                                                                                    </th>

                                                                                    <th scope="col"
                                                                                        class="px-4 py-3.5 text-sm font-normal text-left rtl:text-right text-gray-500 dark:text-gray-400">
                                                                                        Actual Collection
                                                                                    </th>
                                                                                </tr>
                                                                            </thead>
                                                                            <tbody
                                                                                class="bg-white divide-y divide-gray-200 dark:divide-gray-500 dark:bg-gray-900">
                                                                                <tr>
                                                                                    <td
                                                                                        class="px-4 py-4 text-sm font-medium text-gray-500 dark:text-gray-200 whitespace-nowrap">
                                                                                        test
                                                                                    </td>
                                                                                    <td
                                                                                        class="px-4 py-4 text-sm font-medium text-gray-500 dark:text-gray-200 whitespace-nowrap">
                                                                                        test
                                                                                    </td>
                                                                                    <td
                                                                                        class="px-4 py-4 text-sm text-gray-500 dark:text-gray-300 whitespace-nowrap">
                                                                                        test
                                                                                    </td>
                                                                                </tr>
                                                                            </tbody>
                                                                        </table>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div id="step6" class="hidden">
                                    <div class="flex place-content-center justify-center items-center mb-16 mt-2">
                                        <ol class="space-y-4 sm:flex sm:space-x-6 sm:space-y-0 rtl:space-x-reverse">
                                            <li
                                                class="flex items-center text-gray-500 dark:text-gray-400 space-x-2.5 rtl:space-x-reverse">
                                                <span
                                                    class="flex items-center justify-center w-8 h-8 border border-gray-500 rounded-full shrink-0 dark:border-gray-400">
                                                    1
                                                </span>
                                                <span>
                                                    <h3 class="font-medium leading-tight">Expenses</h3>
                                                </span>
                                            </li>
                                            <li
                                                class="flex items-center text-gray-500 dark:text-gray-400 space-x-2.5 rtl:space-x-reverse">
                                                <span
                                                    class="flex items-center justify-center w-8 h-8 border border-gray-500 rounded-full shrink-0 dark:border-gray-400">
                                                    2
                                                </span>
                                                <span>
                                                    <h3 class="font-medium leading-tight">Breakdown of Cash Bills</h3>
                                                </span>
                                                <svg class="w-3 h-3 ms-2 sm:ms-4 rtl:rotate-180" aria-hidden="true"
                                                    xmlns="http://www.w3.org/2000/svg" fill="none"
                                                    viewBox="0 0 12 10">
                                                    <path stroke="currentColor" stroke-linecap="round"
                                                        stroke-linejoin="round" stroke-width="2"
                                                        d="m7 9 4-4-4-4M1 9l4-4-4-4" />
                                                </svg>
                                            </li>
                                            <li
                                                class="flex items-center text-gray-500 dark:text-gray-400 space-x-2.5 rtl:space-x-reverse">
                                                <span
                                                    class="flex items-center justify-center w-8 h-8 border border-gray-500 rounded-full shrink-0 dark:border-gray-400">
                                                    3
                                                </span>
                                                <span>
                                                    <h3 class="font-medium leading-tight">Savings</h3>
                                                </span>
                                                <svg class="w-3 h-3 ms-2 sm:ms-4 rtl:rotate-180" aria-hidden="true"
                                                    xmlns="http://www.w3.org/2000/svg" fill="none"
                                                    viewBox="0 0 12 10">
                                                    <path stroke="currentColor" stroke-linecap="round"
                                                        stroke-linejoin="round" stroke-width="2"
                                                        d="m7 9 4-4-4-4M1 9l4-4-4-4" />
                                                </svg>
                                            </li>
                                            <li
                                                class="flex items-center text-gray-500 dark:text-gray-400 space-x-2.5 rtl:space-x-reverse">
                                                <span
                                                    class="flex items-center justify-center w-8 h-8 border border-gray-500 rounded-full shrink-0 dark:border-gray-400">
                                                    4
                                                </span>
                                                <span>
                                                    <h3 class="font-medium leading-tight">Compute Cash On Hand</h3>
                                                </span>
                                                <svg class="w-3 h-3 ms-2 sm:ms-4 rtl:rotate-180" aria-hidden="true"
                                                    xmlns="http://www.w3.org/2000/svg" fill="none"
                                                    viewBox="0 0 12 10">
                                                    <path stroke="currentColor" stroke-linecap="round"
                                                        stroke-linejoin="round" stroke-width="2"
                                                        d="m7 9 4-4-4-4M1 9l4-4-4-4" />
                                                </svg>
                                            </li>
                                            <li
                                                class="flex items-center text-gray-500 dark:text-gray-400 space-x-2.5 rtl:space-x-reverse">
                                                <span
                                                    class="flex items-center justify-center w-8 h-8 border border-gray-500 rounded-full shrink-0 dark:border-gray-400">
                                                    5
                                                </span>
                                                <span>
                                                    <h3 class="font-medium leading-tight">Regular & Bad Accounts</h3>
                                                </span>
                                                <svg class="w-3 h-3 ms-2 sm:ms-4 rtl:rotate-180" aria-hidden="true"
                                                    xmlns="http://www.w3.org/2000/svg" fill="none"
                                                    viewBox="0 0 12 10">
                                                    <path stroke="currentColor" stroke-linecap="round"
                                                        stroke-linejoin="round" stroke-width="2"
                                                        d="m7 9 4-4-4-4M1 9l4-4-4-4" />
                                                </svg>
                                            </li>
                                            <li
                                                class="flex items-center text-blue-600 dark:text-gray-400 space-x-2.5 rtl:space-x-reverse">
                                                <span
                                                    class="flex items-center justify-center w-8 h-8 border border-blue-600 rounded-full shrink-0 dark:border-gray-400">
                                                    6
                                                </span>
                                                <span>
                                                    <h3 class="font-medium leading-tight">Print</h3>
                                                </span>
                                                <svg class="w-3 h-3 ms-2 sm:ms-4 rtl:rotate-180" aria-hidden="true"
                                                    xmlns="http://www.w3.org/2000/svg" fill="none"
                                                    viewBox="0 0 12 10">
                                                    <path stroke="currentColor" stroke-linecap="round"
                                                        stroke-linejoin="round" stroke-width="2"
                                                        d="m7 9 4-4-4-4M1 9l4-4-4-4" />
                                                </svg>
                                            </li>
                                        </ol>
                                    </div>
                                    <div class="mb-6">
                                        <div class="grid gap-4 gap-y-2 text-sm grid-cols-1 lg:grid-cols-1">
                                            <div class="lg:col-span-2">
                                                <div class="grid gap-4 gap-y-2 text-sm grid-cols-1 md:grid-cols-1">
                                                    <div class="lg:col-span-2">
                                                        <div
                                                            class="grid gap-4 gap-y-2 text-sm grid-cols-1 md:grid-cols-1">
                                                            <div class="md:col-span-1">
                                                                <label for="description"
                                                                    class="text-lg font-medium py-2">Additional
                                                                    Notes</label>
                                                                <textarea name="description" id="description" rows="4"
                                                                    class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                                                    placeholder="Type here..."></textarea>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="mt-8">
                                    <div class="grid gap-4 gap-y-2 text-sm grid-cols-1 lg:grid-cols-1">
                                        <div class="lg:col-span-2">
                                            <div class="grid gap-4 gap-y-2 text-sm grid-cols-1 md:grid-cols-1">
                                                <div class="md:col-span-1">
                                                    <button type="button" id="prevBtn"
                                                        class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded mx-2">
                                                        Previous
                                                    </button>
                                                    <div class="inline-flex" style="float:right;">
                                                        <button type="button" id="nextBtn"
                                                            class="bg-primary-100 hover:bg-primary-200 text-white font-bold py-2 px-4 rounded mx-2">
                                                            Next Step
                                                        </button>

                                                        <button type="submit" id="submitBtn"
                                                            class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded mx-2">
                                                            Generate Report
                                                        </button>

                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </form>
    </div>
</x-app-layout>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script>
    function updateCSOR() {
        var urlParams = new URLSearchParams(window.location.search);
        var date_range = urlParams.get('date_range');
        $.ajax({
            url: '{{ route('csor.index') }}',
            type: 'GET',
            data: {
                _token: '{{ csrf_token() }}',
                date_range: date_range,
            },
            success: function(response) {
                // Handle the success response
                window.location.reload();
                console.log(response);
            },
            error: function(xhr) {
                console.log('Error:', xhr.responseText);
                // Handle the error response
            }
        });

    }
</script>

<script>
    let currentStep = 1;
    const totalSteps = 6;

    document.getElementById('nextBtn').addEventListener('click', () => {
        showLoading();
        setTimeout(() => {
            if (currentStep < totalSteps) {
                document.getElementById(`step${currentStep}`).classList.add('hidden');
                currentStep++;
                document.getElementById(`step${currentStep}`).classList.remove('hidden');
            }
            hideLoading();
            updateButtons();
        }, 500); // Simulate loading time
    });

    document.getElementById('prevBtn').addEventListener('click', () => {
        showLoading();
        setTimeout(() => {
            if (currentStep > 1) {
                document.getElementById(`step${currentStep}`).classList.add('hidden');
                currentStep--;
                document.getElementById(`step${currentStep}`).classList.remove('hidden');
            }
            hideLoading();
            updateButtons();
        }, 500); // Simulate loading time
    });

    function updateButtons() {
        document.getElementById('prevBtn').style.display = currentStep === 1 ? 'none' : 'inline-block';
        document.getElementById('nextBtn').style.display = currentStep === totalSteps ? 'none' : 'inline-block';
        document.getElementById('submitBtn').style.display = currentStep === totalSteps ? 'inline-block' : 'none';
    }

    function showLoading() {
        document.getElementById('loading').classList.remove('hidden');
    }

    function hideLoading() {
        document.getElementById('loading').classList.add('hidden');
    }

    // Initialize buttons on page load
    updateButtons();
</script>

<script>
    $('#expenseButton').on('click', function(event) {
        event.preventDefault(); // Prevent the default link behavior

        var now = new Date();
        var monthNames = ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"];
        var day = now.getDate();
        var month = monthNames[now.getMonth()];
        var year = now.getFullYear();
        var formattedDate = month + ' ' + day + ', ' + year;

        var expense_name = $('#expense_name').val();
        var expense_price = $('#expense_price').val();
        var expense_qty = $('#expense_qty').val();
        var urlParams = new URLSearchParams(window.location.search);
        var expense_date = urlParams.get('date_range') ?? formattedDate;

        $.ajax({
            url: '#',
            type: 'POST',
            data: {
                _token: '{{ csrf_token() }}',
                expense_name: expense_name,
                expense_price: expense_price,
                expense_qty: expense_qty,
                expense_date: expense_date,
            },
            success: function(response) {
                updateCSOR();
                setTimeout(function() {
                    document.getElementById('modal').classList.add(
                        'hidden'); // Hide the modal
                }, 30); // Adjust the timeout as needed
                showLoadingMessage();
            },
            error: function(xhr) {
                console.log('Error:', xhr.responseText);
                document.getElementById('loading-message').classList.add(
                    'hidden'); // Hide the loading message
                // Handle the error response
            }
        });
    });

    function showLoadingMessage() {
        document.getElementById('loading-message').classList.remove('hidden');
        document.getElementById('expenseButton').classList.add('pointer-events-none', 'opacity-50');
    }
</script>

<script>
    const showModalButton = document.getElementById('show-modal');
    const hideModalButton = document.getElementById('hide-modal');
    const modal = document.getElementById('modal');

    showModalButton.addEventListener('click', () => {
        modal.classList.remove('hidden');
    });

    hideModalButton.addEventListener('click', () => {
        modal.classList.add('hidden');
    });
</script>
