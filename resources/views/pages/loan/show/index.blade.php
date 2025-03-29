<x-app-layout>
    <div class="px-4 sm:px-6 lg:px-8 py-8 w-full max-w-9xl mx-auto">


        <!-- Dashboard actions -->
        <div class="sm:flex sm:justify-between sm:items-center mb-4">
            <div>
                <h1 class="text-2xl md:text-2xl text-slate-800 dark:text-slate-100 font-bold">Grant Loan Entry</h1>
                <ol class="inline-flex items-center space-x-2">
                    <!-- Home -->
                    <li>
                        <a href="/" class="text-gray-500 hover:text-gray-700">
                            <svg xmlns="http://www.w3.org/2000/svg" height="20px" viewBox="0 -960 960 960" width="20px"
                                fill="#A9A9A9">
                                <path
                                    d="M264-216h96v-240h240v240h96v-348L480-726 264-564v348Zm-72 72v-456l288-216 288 216v456H528v-240h-96v240H192Zm288-327Z" />
                            </svg>
                        </a>
                    </li>
                    <!-- Separator -->
                    <li>
                        <span class="text-gray-500">/</span>
                    </li>
                    <!-- Page -->
                    <li>
                        <a href="#" class="text-sm text-gray-500">Grant Loan Entry</a>
                    </li>
                    <!-- Separator -->
                    <li>
                        <span class="text-gray-500">/</span>
                    </li>
                    <!-- Current Page -->
                    <li>
                        <span class="text-sm text-black font-medium">Show</span>
                    </li>
                </ol>
            </div>

            <!-- Right: Actions -->
            <div class="grid grid-flow-col sm:auto-cols-max justify-start sm:justify-end gap-2">

                <!-- Filter button -->
                <!-- <x-dropdown-filter align="right" /> -->

                <!-- Add view button -->
                <button id="open-modal" type="button"
                    class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                    Request to Edit
                </button>

                <!-- Modal -->
                <div id="modal" class="fixed inset-0 z-50 hidden overflow-y-auto">
                    <div class="flex items-center justify-center min-h-screen px-4">
                        <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity"></div>
                        <div class="relative transform overflow-hidden rounded-lg bg-white text-left shadow-xl transition-all sm:my-8 sm:w-full sm:max-w-lg">
                            <!-- Modal Header -->
                            <div class="flex justify-between items-center p-4 mb-4">
                                <h2 class="text-lg font-semibold">Request to Edit</h2>
                                <button id="close-modal" class="text-gray-500 hover:text-gray-700">&times;</button>
                            </div>

                            <!-- Modal Form -->
                            <form id="modal-form" class="px-6" action="{{ route('loan.request-edit.store', $loan->id) }}" method="POST">
                                @csrf
                                <!-- Date Input -->
                                <div class="mb-4">
                                    <label for="date" class="block text-sm font-medium text-gray-700">Date</label>
                                    <input type="date" id="date" name="date"
                                        class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2 focus:ring-blue-500 focus:border-blue-500"
                                        required>
                                </div>

                                <div class="mb-4">
                                    <label for="time" class="block text-sm font-medium text-gray-700">Time</label>
                                    <input type="time" id="time" name="time"
                                        class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2 focus:ring-blue-500 focus:border-blue-500"
                                        required>
                                </div>

                                <!-- Reason Input -->
                                <div class="mb-4">
                                    <label for="reason" class="block text-sm font-medium text-gray-700">Reason</label>
                                    <textarea id="reason" name="reason" rows="3"
                                        class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2 focus:ring-blue-500 focus:border-blue-500"
                                        placeholder="Enter reason here..." required></textarea>
                                </div>

                                <!-- Modal Actions -->
                                <div class="flex justify-end mb-4">
                                    <button type="button" id="close-modal-btn"
                                        class="bg-gray-300 text-gray-700 px-4 py-2 rounded mr-2 hover:bg-gray-400">
                                        Cancel
                                    </button>
                                    <button type="submit"
                                        class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">
                                        Submit
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>


                <div id="modal" class="relative z-10 hidden" aria-labelledby="modal-title" role="dialog"
                    aria-modal="true">
                    <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" aria-hidden="true"></div>

                    <div class="fixed inset-0 z-10 w-screen overflow-y-auto">
                        <div class="flex items-center justify-center min-h-screen px-4">
                            <div class="relative transform overflow-hidden rounded-lg bg-white text-left shadow-xl transition-all sm:my-8 sm:w-full sm:max-w-lg">
                                <form action="{{ route('barangay.importcsv') }}" method="POST"
                                    enctype="multipart/form-data">
                                    @csrf
                                    <div class="bg-white px-4 pb-4 pt-5 sm:p-6 sm:pb-4">
                                        <div class="sm:flex sm:items-start">
                                            <div
                                                class="mx-auto flex h-12 w-12 flex-shrink-0 items-center justify-center rounded-full bg-blue-100 sm:mx-0 sm:h-10 sm:w-10">
                                                <svg class="h-6 w-6 text-blue-500" viewBox="0 0 24 24" fill="none"
                                                    stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                                    stroke-linejoin="round">
                                                    <polyline points="16 16 12 12 8 16" />
                                                    <line x1="12" y1="12" x2="12" y2="21" />
                                                    <path d="M20.39 18.39A5 5 0 0 0 18 9h-1.26A8 8 0 1 0 3 16.3" />
                                                    <polyline points="16 16 12 12 8 16" />
                                                </svg>
                                            </div>
                                            <div class="mt-3 text-center sm:mt-0 sm:text-left">
                                                <h3 class="text-base font-semibold leading-6 text-gray-900"
                                                    id="modal-title">Import Barangay</h3>
                                                <div class="mt-2">
                                                    <div class="fields">
                                                        <div class="input-group mb-3">
                                                            <input type="file" class="form-control" id="file"
                                                                name="file" accept=".csv">
                                                            <label class="input-group-text"
                                                                for="file">Upload</label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="bg-gray-50 px-4 py-3 sm:flex sm:flex-row-reverse sm:px-6">
                                        <button type="submit"
                                            class="inline-flex w-full justify-center rounded-md bg-blue-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-red-500 sm:ml-3 sm:w-auto">Upload</button>
                                        <button id="hide-modal" type="button"
                                            class="mt-3 inline-flex w-full justify-center rounded-md bg-white px-3 py-2 text-sm font-semibold text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 hover:bg-gray-50 sm:mt-0 sm:w-auto">Cancel</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>

        <div class="bg-white rounded shadow-lg p-4 px-4 md:p-8 mb-6">
            <div class="flex items-center text-gray-600 mb-12">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                    xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                </svg>
                <a href="{{ route('loan.index') }}" class="text-base font-semibold">Back</a>
            </div>

            <div class="grid grid-cols-1 gap-4">
                <div class="...">
                    {{-- <form action="{{ route('customer.store') }}" method="POST"> --}}

                    <div class="flex items-center space-x-4 mb-6">
                        <div class="w-12 h-12 bg-gray-200 rounded-full flex items-center justify-center">
                            <svg width="47" height="47" viewBox="0 0 47 47" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <circle cx="23.5" cy="23.5" r="23.5" fill="#000D3A" />
                                <path
                                    d="M23.5 16.0227C22.5757 16.0227 21.6721 16.2968 20.9036 16.8103C20.1351 17.3238 19.5361 18.0537 19.1824 18.9076C18.8287 19.7616 18.7361 20.7012 18.9165 21.6077C19.0968 22.5143 19.5419 23.347 20.1954 24.0006C20.849 24.6541 21.6817 25.0992 22.5882 25.2795C23.4948 25.4599 24.4344 25.3673 25.2884 25.0136C26.1423 24.6599 26.8722 24.0609 27.3857 23.2924C27.8992 22.5239 28.1733 21.6203 28.1733 20.696C28.1733 19.4566 27.6809 18.2679 26.8045 17.3915C25.9281 16.5151 24.7394 16.0227 23.5 16.0227Z"
                                    fill="white" />
                                <path
                                    d="M23.5 10.4148C20.912 10.4148 18.3821 11.1822 16.2303 12.62C14.0784 14.0578 12.4012 16.1015 11.4109 18.4925C10.4205 20.8835 10.1613 23.5145 10.6662 26.0528C11.1711 28.5911 12.4174 30.9226 14.2474 32.7526C16.0774 34.5826 18.4089 35.8289 20.9472 36.3338C23.4855 36.8387 26.1165 36.5796 28.5075 35.5892C30.8985 34.5988 32.9422 32.9216 34.38 30.7698C35.8178 28.6179 36.5853 26.088 36.5853 23.5C36.5813 20.0308 35.2014 16.7048 32.7483 14.2517C30.2952 11.7986 26.9692 10.4187 23.5 10.4148ZM30.9708 31.8428C30.9526 30.6165 30.4531 29.4465 29.5801 28.5852C28.7071 27.7238 27.5304 27.2402 26.304 27.2386H20.6961C19.4698 27.2405 18.2934 27.7242 17.4206 28.5855C16.5477 29.4468 16.0484 30.6166 16.0302 31.8428C14.3353 30.3293 13.14 28.3367 12.6027 26.1289C12.0654 23.921 12.2113 21.602 13.0212 19.479C13.8311 17.3559 15.2668 15.5289 17.1382 14.2399C19.0095 12.9509 21.2282 12.2607 23.5005 12.2607C25.7728 12.2607 27.9915 12.9509 29.8628 14.2399C31.7342 15.5289 33.1698 17.3559 33.9798 19.479C34.7897 21.602 34.9356 23.921 34.3983 26.1289C33.861 28.3367 32.6657 30.3293 30.9708 31.8428Z"
                                    fill="white" />
                            </svg>
                        </div>
                        <div>
                            <h1 class="text-lg font-bold">{{ $loan->customer->first_name }}
                                {{ $loan->customer->last_name }}</h1>
                            <p class="text-sm text-gray-500">ID: {{ $loan->id }}</p>
                        </div>
                    </div>
                    <div class="flex flex-row gap-12 mb-12">
                        <div class="">
                            <p class="text-sm text-gray-500 mr-4">Customer Type:</p>
                            <h1 class="text-sm text-gray-900 font-bold">{{ $loan->customer->type }}</h1>
                        </div>
                        <div class="">
                            <p class="text-sm text-gray-500 mr-4">Status:</p>
                            <h1 class="text-sm text-gray-900 font-bold">{{ $loan->customer->status }}</h1>
                        </div>
                    </div>


                    <!-- Loan Transaction Summary -->
                    <div class="relative">
                        <h2 class="text-2xl md:text-2xl text-slate-800 dark:text-slate-100 font-bold mb-2">Loan
                            Payment Details</h2>
                        <hr class="h-px my-4 mb-4 bg-gray-200 border-0 dark:bg-gray-700">
                    </div>
                    <div class="mb-6">
                        <div class="grid grid-cols-3 gap-8 mt-4 mb-12 text-sm text-gray-500">
                            <div>
                                <p class="text-gray-900 text-sm">Transaction No.</p>
                                <p class="font-bold text-gray-900 text-base">{{ $loan->id }}</p>
                            </div>
                            <div>
                                <p class="text-gray-900 text-sm">Date of Loan </p>
                                <p class="font-bold text-gray-900 text-base">{{ $loan->date_of_loan }}</p>
                            </div>
                            <div>
                                <p class="text-gray-900 text-sm">Loan Type</p>
                                <p class="font-bold text-gray-900 text-base">{{ ucfirst($loan->loan_type) }}</p>
                            </div>
                            <div>
                                <p class="text-gray-900 text-sm">Transaction Type</p>
                                <p class="font-bold text-gray-900 text-base">{{ $loan->transaction_type }}</p>
                            </div>
                        </div>
                    </div>

                    <!-- Terms of Payment -->
                    <div class="relative">
                        <h2 class="text-2xl md:text-2xl text-slate-800 dark:text-slate-100 font-bold mb-2">Terms of
                            Payment</h2>
                        <hr class="h-px my-4 mb-4 bg-gray-200 border-0 dark:bg-gray-700">
                    </div>
                    <div class="mb-6">
                        <div class="grid grid-cols-3 gap-8 mt-4 mb-12 text-sm text-gray-500">
                            <div>
                                <p class="text-gray-900 text-sm">Principal Amount</p>
                                <p class="font-bold text-gray-900 text-base">{{ $loan->principal_amount }}</p>
                            </div>
                            <div>
                                <p class="text-gray-900 text-sm">Interest</p>
                                <p class="font-bold text-gray-900 text-base">{{ $loan->interest }}</p>
                            </div>
                            <div>
                                <p class="text-gray-900 text-sm">Interest Amount</p>
                                <p class="font-bold text-gray-900 text-base"value="" placeholder="₱">
                                    {{ $loan->interest_amount }}</p>
                            </div>
                            <div>
                                <p class="text-gray-900 text-sm">Service Charge</p>
                                <p class="font-bold text-gray-900 text-base">{{ $loan->svc_charge??0 }}</p>
                            </div>
                            <div>
                                <p class="text-gray-900 text-sm">Payable Amount</p>
                                <p class="font-bold text-gray-900 text-base">{{ $loan->payable_amount??0 }}</p>
                            </div>
                            <div>
                                <p class="text-gray-900 text-sm">Days to Pay</p>
                                <p class="font-bold text-gray-900 text-base">{{ $loan->days_to_pay }}</p>
                            </div>
                            <div>
                                <p class="text-gray-900 text-sm">Months to Pay</p>
                                <p class="font-bold text-gray-900 text-base">{{ $loan->months_to_pay }}</p>
                            </div>
                            <div>
                                <p class="text-gray-900 text-sm">Actual Record </p>
                                <p class="font-bold text-gray-900 text-base">{{ $loan->actual_record }}</p>
                            </div>
                            <div>
                                <p class="text-gray-900 text-sm">Processing Fee</p>
                                <p class="font-bold text-gray-900 text-base">{{ $loan->processing_fee??0 }}</p>
                            </div>
                            <div>
                                <p class="text-gray-900 text-sm">Notary Fee</p>
                                <p class="font-bold text-gray-900 text-base">{{ $loan->notary_fee??0 }}</p>
                            </div>
                        </div>
                    </div>

                    <section class="container mx-auto">
                        <div class="flex flex-col">
                            <div class="-mx-4 -my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                                <div class="inline-block min-w-full py-2 align-middle md:px-6 lg:px-8">
                                    <div
                                        class="overflow-hidden border border-gray-200 dark:border-gray-700 md:rounded-lg">
                                        <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                                            <thead class="bg-blue-700 dark:bg-gray-800">
                                                <tr>
                                                    <th scope="col"
                                                        class="px-4 py-3.5 text-sm font-normal text-left rtl:text-right text-white dark:text-white">
                                                        Day No
                                                    </th>

                                                    <th scope="col"
                                                        class="px-4 py-3.5 text-sm font-normal text-left rtl:text-right text-white dark:text-white">
                                                        Due Date
                                                    </th>

                                                    <th scope="col"
                                                        class="px-4 py-3.5 text-sm font-normal text-left rtl:text-right text-white dark:text-white">
                                                        Due Amt
                                                    </th>

                                                    <th scope="col"
                                                        class="px-4 py-3.5 text-sm font-normal text-left rtl:text-right text-white dark:text-white">
                                                        Date Paid
                                                    </th>

                                                    <th scope="col"
                                                        class="px-4 py-3.5 text-sm font-normal text-left rtl:text-right text-white dark:text-white">
                                                        Run Bal
                                                    </th>

                                                    <th scope="col"
                                                        class="px-4 py-3.5 text-sm font-normal text-left rtl:text-right text-white dark:text-white">
                                                        Bank
                                                    </th>

                                                    <th scope="col"
                                                        class="px-4 py-3.5 text-sm font-normal text-left rtl:text-right text-white dark:text-white">
                                                        Check No.
                                                    </th>

                                                    <th scope="col"
                                                        class="px-4 py-3.5 text-sm font-normal text-left rtl:text-right text-white dark:text-white">
                                                        Remarks
                                                    </th>
                                                </tr>
                                            </thead>
                                            <tbody
                                                class="bg-white divide-y divide-gray-200 dark:divide-gray-500 dark:bg-gray-900">
                                                @foreach ($loan->details as $details)
                                                    <tr>
                                                        <td
                                                            class="px-4 py-4 text-sm font-medium text-gray-500 dark:text-gray-200 whitespace-nowrap">
                                                            {{ $details->loan_day_no }}
                                                        </td>
                                                        <td class="px-4 py-4 text-sm text-gray-500 dark:text-gray-300 whitespace-nowrap due-date"
                                                            data-detail-id="{{ $details->id }}"
                                                            data-due-date="{{ $details->loan_due_date }}">
                                                            {{ $details->loan_due_date }}
                                                        </td>
                                                        <td
                                                            class="px-4 py-4 text-sm text-gray-500 dark:text-gray-300 whitespace-nowrap">
                                                            {{ $details->loan_due_amount }}
                                                        </td>
                                                        <td
                                                            class="px-4 py-4 text-sm text-gray-500 dark:text-gray-300 whitespace-nowrap">
                                                            {{ $details->loan_date_paid }}
                                                        </td>
                                                        <td
                                                            class="px-4 py-4 text-sm text-gray-500 dark:text-gray-300 whitespace-nowrap">
                                                            {{ $details->loan_running_balance }}
                                                        </td>
                                                        <td
                                                            class="px-4 py-4 text-sm text-gray-500 dark:text-gray-300 whitespace-nowrap">
                                                            {{ $details->loan_bank }}
                                                        </td>
                                                        <td
                                                            class="px-4 py-4 text-sm text-gray-500 dark:text-gray-300 whitespace-nowrap">
                                                            {{ $details->loan_check_no }}
                                                        </td>
                                                        <td
                                                            class="px-4 py-4 text-sm text-gray-500 dark:text-gray-300 whitespace-nowrap">
                                                            {{ $details->loan_remarks }}
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>

                    <div class="relative mt-4">
                        <h2 class="text-2xl md:text-2xl text-slate-800 dark:text-slate-100 font-bold mb-2">Amortization Table</h2>
                        <hr class="h-px my-4 mb-4 bg-gray-200 border-0 dark:bg-gray-700">
                    </div>
                    <section class="container mx-auto">
                        <div class="flex flex-col">
                            <div class="-mx-4 -my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                                <div class="inline-block min-w-full py-2 align-middle md:px-6 lg:px-8">
                                    <div
                                        class="overflow-hidden border border-gray-200 dark:border-gray-700 md:rounded-lg">
                                        <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                                            <thead class="bg-blue-700 dark:bg-gray-800">
                                                <tr>
                                                    <th scope="col"
                                                        class="px-4 py-3.5 text-sm font-normal text-left rtl:text-right text-white dark:text-white">
                                                        Installment
                                                    </th>

                                                    <th scope="col"
                                                        class="px-4 py-3.5 text-sm font-normal text-left rtl:text-right text-white dark:text-white">
                                                        Principal
                                                    </th>

                                                    <th scope="col"
                                                        class="px-4 py-3.5 text-sm font-normal text-left rtl:text-right text-white dark:text-white">
                                                        Interest
                                                    </th>

                                                    <th scope="col"
                                                        class="px-4 py-3.5 text-sm font-normal text-left rtl:text-right text-white dark:text-white">
                                                        Service Charge
                                                    </th>

                                                    <th scope="col"
                                                        class="px-4 py-3.5 text-sm font-normal text-left rtl:text-right text-white dark:text-white">
                                                        Total
                                                    </th>

                                                    <th scope="col"
                                                        class="px-4 py-3.5 text-sm font-normal text-left rtl:text-right text-white dark:text-white">
                                                        Outstanding Balance
                                                    </th>
                                                </tr>
                                            </thead>
                                            <tbody
                                                class="bg-white divide-y divide-gray-200 dark:divide-gray-500 dark:bg-gray-900">
                                                @php
                                                    $totalPrincipal = $loan->principal_amount;
                                                    $totalInterest = $loan->interest_amount;
                                                    $totalInstallments = $loan->details->count();
                                                    $principalAmount = number_format($totalPrincipal / $totalInstallments, 2);
                                                    $interestAmount = number_format($totalInterest / $totalInstallments, 2);
                                                @endphp
                                                @foreach ($loan->details as $key => $details)
                                                    <tr>
                                                        <td
                                                            class="px-4 py-4 text-sm font-medium text-gray-500 dark:text-gray-200 whitespace-nowrap">
                                                            {{ $details->loan_day_no }}
                                                        </td>
                                                        <td class="px-4 py-4 text-sm text-gray-500 dark:text-gray-300 whitespace-nowrap due-date"
                                                            >
                                                            {{ $principalAmount }}
                                                        </td>
                                                        <td
                                                            class="px-4 py-4 text-sm text-gray-500 dark:text-gray-300 whitespace-nowrap">
                                                            {{ $interestAmount }}
                                                        </td>
                                                        <td
                                                            class="px-4 py-4 text-sm text-gray-500 dark:text-gray-300 whitespace-nowrap">
                                                            {{-- {{ $details->loan_running_balance }} --}}
                                                        </td>
                                                        <td
                                                            class="px-4 py-4 text-sm text-gray-500 dark:text-gray-300 whitespace-nowrap">
                                                            {{ $details->loan_due_amount }}
                                                        </td>
                                                        <td
                                                            class="px-4 py-4 text-sm text-gray-500 dark:text-gray-300 whitespace-nowrap">
                                                            {{ $details->loan_running_balance }}
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>


                    <div class="mb-8 mt-8">
                        <div class="grid gap-4 gap-y-2 text-sm grid-cols-1 lg:grid-cols-1">
                            <div class="lg:col-span-2">
                                <div class="grid gap-4 gap-y-2 text-sm grid-cols-1 md:grid-cols-2">
                                    <div class="md:col-span-1">
                                        <button type="button" name="grace" id="allowGracePeriod"
                                            class="border px-2 py-2 bg-gray-50">
                                            Allow Grace period</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div id="modal-import-new" class="relative z-10 hidden" aria-labelledby="modal-title"
                            role="dialog" aria-modal="true">
                            <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity"
                                aria-hidden="true"></div>

                            <div class="fixed inset-0 z-10 w-screen overflow-y-auto">
                                <div
                                    class="flex min-h-full items-end justify-center p-4 text-center sm:items-center sm:p-0">
                                    <div
                                        class="relative transform overflow-hidden rounded-lg bg-white text-left shadow-xl transition-all md:my-10 md:w-full md:max-w-2xl">
                                        <form action="{{ route('loan.gracePeriod') }}" method="POST"
                                            enctype="multipart/form-data">
                                            @csrf
                                            <section class="container mx-auto">
                                                <div class="flex flex-col">
                                                    <div class="-mx-4 -my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                                                        <div
                                                            class="inline-block min-w-full py-2 align-middle md:px-6 lg:px-8">
                                                            <div
                                                                class="overflow-hidden border border-gray-200 dark:border-gray-700 md:rounded-lg">
                                                                <table
                                                                    class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                                                                    <thead
                                                                        class="bg-primary-100">
                                                                        <tr>
                                                                            <th scope="col" id="modal-title"
                                                                                class="px-4 py-3.5 text-base text-center rtl:text-right text-white dark:text-white">
                                                                                Allow Grace Period
                                                                            </th>
                                                                        </tr>
                                                                    </thead>

                                                                </table>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </section>
                                            <div class="bg-white px-4 pb-4 pt-5 sm:p-6 sm:pb-4">
                                                <div class="">
                                                    <div class="mt-3 text-center sm:mt-0 sm:text-left">
                                                        <div class="mt-2">
                                                            <div class="fields grid grid-cols-2 gap-4">
                                                                <div>
                                                                    <label for="id"
                                                                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Loan
                                                                        ID</label>
                                                                    <input type="number" name="id"
                                                                        id="id"
                                                                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-2 p-2.5"
                                                                        value="" />
                                                                </div>
                                                                <div>
                                                                    <label for="months_to_pay"
                                                                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Months
                                                                        to pay</label>
                                                                    <input type="number" name="months_to_pay"
                                                                        id="months_to_pay"
                                                                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-2 p-2.5"
                                                                        value="" />
                                                                </div>
                                                                <div>
                                                                    <label for="loan_due_amount"
                                                                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Loan
                                                                        Due Amount</label>
                                                                    <input type="number" name="loan_due_amount"
                                                                        id="loan_due_amount"
                                                                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-2 p-2.5"
                                                                        value="" />
                                                                </div>
                                                                <div>
                                                                    <label for="interest"
                                                                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Interest</label>
                                                                    <input type="number" name="interest"
                                                                        id="interest"
                                                                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-2 p-2.5"
                                                                        value="" />
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <section class="container mx-auto mb-12 mt-12">
                                                        <div class="flex flex-col">
                                                            <div class="-mx-4 -my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                                                                <div
                                                                    class="inline-block min-w-full py-2 align-middle md:px-6 lg:px-8">
                                                                    <div
                                                                        class="overflow-hidden border border-gray-200 dark:border-gray-700 md:rounded-lg">
                                                                        <table
                                                                            class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                                                                            <thead
                                                                                class="bg-blue-700 dark:bg-gray-800">
                                                                                <tr>
                                                                                    <th scope="col"
                                                                                        class="px-4 py-3.5 text-sm font-normal text-left rtl:text-right text-white dark:text-white">
                                                                                        Day No
                                                                                    </th>

                                                                                    <th scope="col"
                                                                                        class="px-4 py-3.5 text-sm font-normal text-left rtl:text-right text-white dark:text-white">
                                                                                        Due Date
                                                                                    </th>

                                                                                    <th scope="col"
                                                                                        class="px-4 py-3.5 text-sm font-normal text-left rtl:text-right text-white dark:text-white">
                                                                                        Due Amt
                                                                                    </th>

                                                                                    <th scope="col"
                                                                                        class="px-4 py-3.5 text-sm font-normal text-left rtl:text-right text-white dark:text-white">
                                                                                        Date Paid
                                                                                    </th>

                                                                                    <th scope="col"
                                                                                        class="px-4 py-3.5 text-sm font-normal text-left rtl:text-right text-white dark:text-white">
                                                                                        Run Bal
                                                                                    </th>

                                                                                    <th scope="col"
                                                                                        class="px-4 py-3.5 text-sm font-normal text-left rtl:text-right text-white dark:text-white">
                                                                                        Bank
                                                                                    </th>

                                                                                    <th scope="col"
                                                                                        class="px-4 py-3.5 text-sm font-normal text-left rtl:text-right text-white dark:text-white">
                                                                                        Check No.
                                                                                    </th>

                                                                                    <th scope="col"
                                                                                        class="px-4 py-3.5 text-sm font-normal text-left rtl:text-right text-white dark:text-white">
                                                                                        Remarks
                                                                                    </th>
                                                                                </tr>
                                                                            </thead>
                                                                            <tbody id="tbodyUpdate"
                                                                                class="bg-white divide-y divide-gray-200 dark:divide-gray-500 dark:bg-gray-900">
                                                                            </tbody>
                                                                        </table>
                                                                        <!-- Hidden Inputs for Rows -->
                                                                        <div id="hidden-inputsUpdate"></div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </section>
                                                </div>
                                            </div>
                                            <div class="bg-gray-50 px-4 py-3 sm:flex sm:flex-row-reverse sm:px-6">
                                                <button type="submit"
                                                    class="inline-flex w-full justify-center rounded-md bg-accent-100 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-accent-200 sm:ml-3 sm:w-auto">Submit</button>
                                                <button id="hide-modal-new" type="button"
                                                    class="mt-3 inline-flex w-full justify-center rounded-md bg-white px-3 py-2 text-sm font-semibold text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 hover:bg-gray-50 sm:mt-0 sm:w-auto">Cancel</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        {{-- <div>
                            <div class="grid gap-4 gap-y-2 text-sm grid-cols-1 lg:grid-cols-3">
                                <div class="text-gray-600">
                                    <p class="font-medium text-lg"></p>
                                </div>

                                <div class="lg:col-span-2">
                                    <div class="grid gap-4 gap-y-2 text-sm grid-cols-1 md:grid-cols-5">
                                        <div class="md:col-span-5 text-right">
                                            <div class="inline-flex items-end">
                                                <button type="submit"
                                                    class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Input
                                                    Check Number</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div> --}}
                    </div>
                </div>
            </div>
        </div>

    </div>
</x-app-layout>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script>
    function getCustomer() {
        const customerID = document.getElementById("customer").value;

        $.ajax({
            url: '{{ route('collection.index') }}',
            type: 'GET',
            data: {
                _token: '{{ csrf_token() }}',
                customer_id: customerID,
            },
            success: function(response) {
                if (response.customer) {
                    const customerData = response.customer;
                    const loanData = response.customer.loan;

                    // Handle the special case for "name" input field
                    const nameField = document.getElementById("name");
                    const transactionField = document.getElementById("trans_no");

                    if (nameField && customerData.first_name && customerData.last_name &&
                        transactionField && loanData.id) {
                        nameField.value = `${customerData.first_name} ${customerData.last_name}`;
                        transactionField.value = loanData
                            .id; // No need for template literal here unless formatting is required
                    }



                    // Handle the special case for "trans_no" input field
                    // if (transactionField && loanData.id) {
                    //     // console.log(loanData.id);
                    //     transactionField.value = loanData.id;
                    // }

                    // Loop through each key in customerData to update respective fields
                    Object.keys(customerData).forEach(key => {
                        if (key !== "first_name" && key !==
                            "last_name") { // Skip first and last name as we already handled it
                            const element = document.getElementById(key);
                            if (element) {
                                if (element.tagName === "SELECT") {
                                    element.value = customerData[key];
                                    element.dispatchEvent(new Event('change'));
                                } else {
                                    element.value = customerData[key];
                                }
                            }
                        }
                    });

                    // Loop through each key in loanData to update respective fields
                    Object.keys(loanData).forEach(key => {
                        if (key !== "id") {
                            const element = document.getElementById(key);
                            if (element) {
                                if (element.tagName === "SELECT") {
                                    element.value = loanData[key];
                                    element.dispatchEvent(new Event('change'));
                                } else {
                                    element.value = loanData[key];
                                }
                            }
                        }
                    });
                } else {
                    console.log('Collection not found.');
                    alert('Collection not found.');
                }
            },
            error: function(xhr) {
                console.log('Error:', xhr.responseText);
                alert("Unable to retrieve customer information. Please try again.");
            }
        });
    }
</script>

<script>
    document.addEventListener('DOMContentLoaded', () => {
        const openModalBtn = document.getElementById('open-modal');
        const closeModalBtn = document.getElementById('close-modal');
        const closeBtn = document.getElementById('close-modal-btn');
        const modal = document.getElementById('modal');
        const modalForm = document.getElementById('modal-form');
        const loanId = {{ $loan->id }};

        // Open modal
        openModalBtn.addEventListener('click', (e) => {
            e.preventDefault();
            modal.classList.remove('hidden');
        });

        // Close modal
        [closeModalBtn, closeBtn].forEach(btn => {
            btn.addEventListener('click', () => {
                modal.classList.add('hidden');
                modalForm.reset();
            });
        });

        // Close modal when clicking outside
        modal.addEventListener('click', (e) => {
            if (e.target === modal) {
                modal.classList.add('hidden');
                modalForm.reset();
            }
        });

        // Submit form
        modalForm.addEventListener('submit', async (e) => {
            e.preventDefault();
            
            const formData = new FormData(modalForm);
            
            try {
                const response = await fetch(modalForm.action, {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                    },
                    body: formData
                });

                const data = await response.json();
                
                if (response.ok && data.success) {
                    modal.classList.add('hidden');
                    modalForm.reset();
                    alert(data.message || 'Edit request submitted successfully');
                } else {
                    let errorMessage = 'Failed to submit edit request';
                    if (data.errors) {
                        errorMessage = Object.values(data.errors).flat().join('\n');
                    } else if (data.message) {
                        errorMessage = data.message;
                    }
                    alert(errorMessage);
                }
            } catch (error) {
                console.error('Error details:', {
                    error: error,
                    message: error.message,
                    stack: error.stack
                });
                alert('An error occurred while submitting the request: ' + error.message);
            }
        });
    });
</script>

<script>
    function calculatePayments() {
        const loanDue = @json($amountDue->loan_due_amount??0);
        const loanID = @json($amountDue->id??'');
        // const principalAmount = parseFloat(document.getElementById('principal_amount').value) || 0;
        const monthsToPay = parseInt(document.getElementById('months_to_pay').value) || 0;
        const interestPercent = parseFloat(document.getElementById('interest').value) || 0;
        // const serviceCharge = parseFloat(document.getElementById('svc_charge').value) || 0;

        const interestAmount = (loanDue * interestPercent) / 100;
        const totalInterest = interestAmount * monthsToPay;
        const payableAmount = loanDue + totalInterest;
        const monthlyDue = monthsToPay > 0 ? payableAmount / monthsToPay / 2 : 0;

        updatePaymentDisplay(totalInterest, payableAmount, monthlyDue, monthsToPay, 'monthly');
    }

    function updatePaymentDisplay(interestAmount, payableAmount, dueAmount, duration, type) {
        // document.getElementById('interest_amount').value = interestAmount.toFixed(2);
        // document.getElementById('payable_amount').value = payableAmount.toFixed(2);

        const tbody = document.getElementById('tbodyUpdate');
        const hiddenInputsContainer = document.getElementById('hidden-inputsUpdate');
        tbody.innerHTML = '';
        hiddenInputsContainer.innerHTML = '';

        let runningBalance = payableAmount;
        let currentDate = new Date();
        if (type === 'daily') {
            for (let i = 1; i <= duration; i++) {
                let dueDate;

                if (type === 'daily') {
                    dueDate = currentDate.toISOString().split('T')[0];
                    currentDate.setDate(currentDate.getDate() + 1); // Increment by 1 day
                }

                runningBalance -= dueAmount;

                const row = `
        <tr>
            <td class="px-4 py-4 text-sm font-medium text-gray-500 dark:text-gray-200 whitespace-nowrap">${i}</td>
            <td class="px-4 py-4 text-sm font-medium text-gray-500 dark:text-gray-200 whitespace-nowrap">${dueDate}</td>
            <td class="px-4 py-4 text-sm font-medium text-gray-500 dark:text-gray-200 whitespace-nowrap">${dueAmount.toFixed(2)}</td>
            <td class="px-4 py-4 text-sm font-medium text-gray-500 dark:text-gray-200 whitespace-nowrap"></td>
            <td class="px-4 py-4 text-sm font-medium text-gray-500 dark:text-gray-200 whitespace-nowrap">${runningBalance.toFixed(2)}</td>
        </tr>
        `;
                tbody.innerHTML += row;

                hiddenInputsContainer.innerHTML += `
        <input type="hidden" name="rows[${i}][id]" value="${i}">
        <input type="hidden" name="rows[${i}][due_date]" value="${dueDate}">
        <input type="hidden" name="rows[${i}][due_amount]" value="${dueAmount.toFixed(2)}">
        <input type="hidden" name="rows[${i}][remaining_balance]" value="${runningBalance.toFixed(2)}">
        `;
            }
        } else {
            for (let i = 1; i <= duration * 2; i++) {
                let dueDate;
                if (type === 'monthly') {
                    // Generate alternating due dates (15th and end of the month)
                    if (i % 2 === 1) {
                        currentDate.setDate(15); // 15th of the month
                    } else {
                        currentDate.setMonth(currentDate.getMonth() + 1, 0); // End of the month
                    }
                    dueDate = currentDate.toISOString().split('T')[0];
                    if (i % 2 === 0) {
                        currentDate.setMonth(currentDate.getMonth() + 1, 1); // Start of the next month
                    }
                }

                runningBalance -= dueAmount;

                const row = `
        <tr>
            <td class="px-4 py-4 text-sm font-medium text-gray-500 dark:text-gray-200 whitespace-nowrap">${i}</td>
            <td class="px-4 py-4 text-sm font-medium text-gray-500 dark:text-gray-200 whitespace-nowrap">${dueDate}</td>
            <td class="px-4 py-4 text-sm font-medium text-gray-500 dark:text-gray-200 whitespace-nowrap">${dueAmount.toFixed(2)}</td>
            <td class="px-4 py-4 text-sm font-medium text-gray-500 dark:text-gray-200 whitespace-nowrap"></td>
            <td class="px-4 py-4 text-sm font-medium text-gray-500 dark:text-gray-200 whitespace-nowrap">${runningBalance.toFixed(2)}</td>
        </tr>
        `;
                tbody.innerHTML += row;

                hiddenInputsContainer.innerHTML += `
        <input type="hidden" name="rows[${i}][id]" value="${i}">
        <input type="hidden" name="rows[${i}][due_date]" value="${dueDate}">
        <input type="hidden" name="rows[${i}][due_amount]" value="${dueAmount.toFixed(2)}">
        <input type="hidden" name="rows[${i}][remaining_balance]" value="${runningBalance.toFixed(2)}">
        `;
            }
        }

    }
    const showModalButtonImportnew = document.getElementById('allowGracePeriod');
    const hideModalButtonImportnew = document.getElementById('hide-modal-new');
    const modalImportnew = document.getElementById('modal-import-new');

    showModalButtonImportnew.addEventListener('click', () => {
        modalImportnew.classList.remove('hidden');
        let loanDue = @json($amountDue->loan_due_amount??0);
        let loanID = @json($amountDue->id??'');
        document.getElementById('loan_due_amount').value = loanDue;
        document.getElementById('id').value = loanID;
        document.getElementById('interest').addEventListener('input', calculatePayments);
    });

    hideModalButtonImportnew.addEventListener('click', () => {
        modalImportnew.classList.add('hidden');
    });
</script>

{{-- <script>
    const updateDueDateUrl = '{{ route('loan.duedateupdate', ['detail' => 'DETAIL_ID']) }}';

    document.getElementById('allowGracePeriod').addEventListener('change', function() {
        const checkboxes = document.querySelectorAll('.due-date');
        checkboxes.forEach((date) => {
            if (this.checked) {
                const currentDate = date.dataset.dueDate;
                date.innerHTML =
                    `<input type="text" class="border px-2 py-2 bg-gray-50" value="${currentDate}" /> 
            <button class="confirm-button bg-blue-500 hover:bg-blue-700 text-white font-bold py-1 px-3 rounded ml-2">Confirm</button>`;

                date.querySelector('.confirm-button').addEventListener('click', function(event) {
                    event.preventDefault(); // Prevent default form submission

                    const newDate = date.querySelector('input').value;
                    const detailId = date.dataset
                        .detailId; // Assuming the detail ID is stored in a data attribute

                    // Replace DETAIL_ID in the URL with the actual detail ID
                    const url = updateDueDateUrl.replace('DETAIL_ID', detailId);

                    // Send the AJAX request to update the date
                    fetch(url, {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': document.querySelector(
                                'meta[name="csrf-token"]').getAttribute('content')
                        },
                        body: JSON.stringify({
                            due_date: newDate
                        })
                    }).then((response) => {
                        window.location.reload();
                    })
                });
            } else {
                const input = date.querySelector('input');
                if (input) {
                    date.innerHTML = input.value;
                }
            }
        });
    });
</script> --}}
