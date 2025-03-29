<x-app-layout>
    <div class="px-4 sm:px-6 lg:px-8 py-8 w-full max-w-9xl mx-auto">

        <!-- <div class="relative">
            <h1 class="text-2xl md:text-2xl text-slate-800 dark:text-slate-100 font-bold mb-12">My Profile</h1>
        </div> -->

        <div class="sm:flex sm:justify-between sm:items-center mb-4">
            <div>
            <h1 class="text-2xl md:text-2xl text-slate-800 dark:text-slate-100 font-bold">My Profile</h1>
                <ol class="inline-flex items-center space-x-2">
                    <!-- Home -->
                    <li>
                        <a href="/" class="text-gray-500 hover:text-gray-700">
                        <svg xmlns="http://www.w3.org/2000/svg" height="20px" viewBox="0 -960 960 960" width="20px" fill="#A9A9A9"><path d="M264-216h96v-240h240v240h96v-348L480-726 264-564v348Zm-72 72v-456l288-216 288 216v456H528v-240h-96v240H192Zm288-327Z"/></svg>
                        </a>
                    </li>
                    <!-- Separator -->
                    <li>
                        <span class="text-gray-500">/</span>
                    </li>
                    <!-- Page -->
                    <li>
                        <a href="#" class="text-sm text-gray-500">My Profile</a>
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
                
                <a href="{{ route('printcustomerSavings.index', ['id' => $customer->id]) }}" 
                class="btn bg-indigo-500 hover:bg-indigo-600 text-white">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" 
                        fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" 
                        stroke-linejoin="round" class="lucide lucide-external-link">
                        <path d="M15 3h6v6"/>
                        <path d="M10 14 21 3"/>
                        <path d="M18 13v6a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h6"/>
                    </svg>
                    <span class="hidden xs:block ml-2">Export Customer Savings</span>
                </a>

                

                <a id="open-transaction-modal" href="#" class="btn bg-indigo-500 hover:bg-indigo-600 text-white">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-external-link"><path d="M15 3h6v6"/><path d="M10 14 21 3"/><path d="M18 13v6a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h6"/></svg>
                    <span class="hidden xs:block ml-2">Export Customer Loan</span>
                </a>

               

                <a id="open-modal" href="#" class="btn bg-indigo-500 hover:bg-indigo-600 text-white">
                    <svg xmlns="http://www.w3.org/2000/svg" height="20px" viewBox="0 -960 960 960" width="20px"
                        fill="#FFFFFF">
                        <path
                            d="M216-216h51l375-375-51-51-375 375v51Zm-72 72v-153l498-498q11-11 23.84-16 12.83-5 27-5 14.16 0 27.16 5t24 16l51 51q11 11 16 24t5 26.54q0 14.45-5.02 27.54T795-642L297-144H144Zm600-549-51-51 51 51Zm-127.95 76.95L591-642l51 51-25.95-25.05Z" />
                    </svg>
                    <span class="hidden xs:block ml-2">Request to Edit</span>
                </a>

                <div id="transaction-modal" class="fixed inset-0 z-50 hidden bg-gray-800 bg-opacity-50 flex items-center justify-center">
                    <div class="relative bg-white rounded-lg shadow-xl w-full max-w-md p-6">
                        <!-- Modal Header -->
                        <div class="flex justify-between items-center border-b pb-2 mb-4">
                            <h2 class="text-lg font-semibold">Select Transaction</h2>
                            <button id="close-transaction-modal" class="text-gray-500 hover:text-gray-700">&times;</button>
                        </div>

                        <!-- Transaction Selection -->
                        <div class="mb-4">
                            <label for="transaction" class="block text-sm font-medium text-gray-700">Transaction</label>
                            <select id="transaction" name="transaction_id" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2 focus:ring-blue-500 focus:border-blue-500">
                                <option value="">Select a transaction</option>
                                @foreach ($customer->loans as $loan)
                                    <option value="{{ $loan->id }}">{{ $loan->id }}</option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Modal Actions -->
                        <div class="flex justify-end">
                            <button type="button" id="close-transaction-btn" class="bg-gray-300 text-gray-700 px-4 py-2 rounded mr-2 hover:bg-gray-400">Cancel</button>
                            <!-- Export Button -->
                            <form id="export-form" action="{{ route('printcustomerLoan.index', $loan->id) }}" method="GET">
                                <input type="hidden" name="transaction_id" id="selected-transaction">
                                <button type="submit" class="bg-green-500 text-white px-4 py-2 rounded hover:bg-green-600">
                                    Print
                                </button>
                            </form>
                        </div>
                    </div>
                </div>

                <!-- Modal -->
                <div id="modal"
                    class="fixed inset-0 z-50 hidden bg-gray-800 bg-opacity-50 flex items-center justify-center">
                    <!-- Modal Content -->
                    <div class="fixed inset-0 z-10 w-screen overflow-y-auto">
                        <div class="flex min-h-full items-end justify-center p-4 text-center sm:items-center sm:p-0">
                            <div
                                class="relative transform overflow-hidden rounded-lg bg-white text-left shadow-xl transition-all sm:my-8 sm:w-full sm:max-w-lg">
                                <!-- Modal Header -->
                                <div class="flex justify-between items-center p-4 mb-4">
                                    <h2 class="text-lg font-semibold">Request to Edit</h2>
                                  <button id="close-modal" class="text-gray-500 hover:text-gray-700">&times;</button>
                                </div>

                                <!-- Modal Form -->
                                <form id="modal-form" class="px-6">
                                    <!-- Date Input -->
                                    <div class="mb-4">
                                        <label for="date"
                                            class="block text-sm font-medium text-gray-700">Date</label>
                                        <input type="date" id="date" name="date"
                                            class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2 focus:ring-blue-500 focus:border-blue-500"
                                            required>
                                    </div>

                                    <div class="mb-4">
                                        <label for="time"
                                            class="block text-sm font-medium text-gray-700">Time</label>
                                        <input type="time" id="time" name="time"
                                            class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2 focus:ring-blue-500 focus:border-blue-500"
                                            required>
                                    </div>

                                    <!-- Reason Input -->
                                    <div class="mb-4">
                                        <label for="reason"
                                            class="block text-sm font-medium text-gray-700">Reason</label>
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
                </div>
            </div>

        </div>

        <div class="bg-white rounded shadow-lg p-4 px-4 md:p-8 mb-6">
            <div class="flex items-center text-gray-600 mb-12">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                    xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                </svg>
                <a href="{{ route('customer.index') }}" class="text-base font-semibold">Back</a>
            </div>

            <!-- Tabs Section -->
            <div class="mt-6 mb-0 border-b border-gray-200">
                <!-- Tabs -->
                <nav class="flex space-x-4">
                    <!-- Profile Tab -->
                    <button id="profile-tab"
                        class="tab-btn px-4 py-2 text-sm font-medium text-accent-600 border-b-2 border-accent-100 hover:text-accent-600 focus:outline-none"
                        onclick="switchTab('profile')">
                        Profile Information
                    </button>
                    <!-- Loan History Tab -->
                    <button id="loan-history-tab"
                        class="tab-btn px-4 py-2 text-sm font-medium text-gray-500 border-b-2 border-accent-100 hover:text-accent-600 focus:outline-none"
                        onclick="switchTab('loan-history')">
                        Loan History
                    </button>
                </nav>
            </div>


            <div id="loan-history" class="tab-content mt-6 hidden">
                <!-- Page Header -->
                <!-- <div class="flex justify-between items-center mb-6">
                    <h1 class="text-xl font-bold text-gray-800">Loan History</h1>
                    <button class="bg-orange-500 hover:bg-orange-600 text-white font-medium px-4 py-2 rounded-md">
                    Add New Loan
                    </button>
                </div> -->
                <!--export btn-->
                <div class="flex flex-wrap justify-end items-center mb-2 mt-0">
                    <a id="show-modal" href="{{ route('loanhistory.export', ['id' => $customer->id]) }}" class="btn bg-indigo-500 hover:bg-indigo-600 text-white flex items-center px-6">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-external-link"><path d="M15 3h6v6"/><path d="M10 14 21 3"/><path d="M18 13v6a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h6"/></svg>
                            <span class="hidden xs:block ml-2 text-sm">Export</span>
                    </a>
                </div>

                <!-- Table -->
                <div class="overflow-x-auto">
                    <table class="table-auto w-full border-collapse border border-gray-200">
                        <thead>
                            <tr class="bg-gray-100 text-left text-sm font-medium text-gray-600">
                                <th class="border border-gray-200 px-4 py-2">Loan Type</th>
                                <th class="border border-gray-200 px-4 py-2">Transaction Type</th>
                                <th class="border border-gray-200 px-4 py-2">Transaction No</th>
                                <th class="border border-gray-200 px-4 py-2">Date of Loan</th>
                                <th class="border border-gray-200 px-4 py-2">Customer ID</th>
                                <th class="border border-gray-200 px-4 py-2">Customer Type</th>
                                <th class="border border-gray-200 px-4 py-2">Status</th>
                                <th class="border border-gray-200 px-4 py-2">Collateral</th>
                                <th class="border border-gray-200 px-4 py-2">Cert</th>
                                <th class="border border-gray-200 px-4 py-2">Principal Amount</th>
                                <th class="border border-gray-200 px-4 py-2">Days to Pay</th>
                                <th class="border border-gray-200 px-4 py-2">Months to Pay</th>
                                <th class="border border-gray-200 px-4 py-2">Interest Rate</th>
                                <th class="border border-gray-200 px-4 py-2">Interest Amount</th>
                                <th class="border border-gray-200 px-4 py-2">SVC Charge</th>
                                <th class="border border-gray-200 px-4 py-2">Payable Amount</th>
                                <th class="border border-gray-200 px-4 py-2">Branch ID</th>
                                <th class="border border-gray-200 px-4 py-2">File</th>
                                <th class="border border-gray-200 px-4 py-2">Note</th>
                            </tr>
                        </thead>
                        <tbody class="text-sm text-gray-700">
                            <!-- Example Row -->
                            @foreach ($customer->loans as $loan)
                                <tr class="hover:bg-gray-50">
                                    <td class="border border-gray-200 px-4 py-2">{{ $loan->loan_type == 'monthly' ? str_replace('monthly', 'MONTHLY', $loan->loan_type): str_replace('daily', 'DAILY', $loan->loan_type)}}</td>
                                    <td class="border border-gray-200 px-4 py-2">{{ $loan->transaction_type }}</td>
                                    <td class="border border-gray-200 px-4 py-2">
                                        <a href="{{ route('loan.show', $loan->id) }}"
                                            class="text-blue-500 hover:underline">
                                            {{ $loan->id }}
                                        </a>
                                    </td>
                                    <td class="border border-gray-200 px-4 py-2">{{ $loan->date_of_loan }}</td>
                                    <td class="border border-gray-200 px-4 py-2">{{ $customer->id }}</td>
                                    <td class="border border-gray-200 px-4 py-2">{{ $loan->customer_type }}</td>
                                    <td class="border border-gray-200 px-4 py-2 text-green-600 font-medium">
                                        {{ $loan->status }}</td>
                                    <td class="border border-gray-200 px-4 py-2 text-center">
                                        {{ $loan->transaction_with_collateral }}</td>
                                    <td class="border border-gray-200 px-4 py-2 text-center">
                                        {{ $loan->transaction_with_cert }}</td>
                                    <td class="border border-gray-200 px-4 py-2">{{ number_format($loan->principal_amount,2) }}</td>
                                    <td class="border border-gray-200 px-4 py-2">{{ $loan->days_to_pay }}</td>
                                    <td class="border border-gray-200 px-4 py-2">{{ $loan->months_to_pay }}</td>
                                    <td class="border border-gray-200 px-4 py-2">{{ $loan->interest }}</td>
                                    <td class="border border-gray-200 px-4 py-2">{{ $loan->interest_amount }}</td>
                                    <td class="border border-gray-200 px-4 py-2">{{ $loan->svc_charge }}</td>
                                    <td class="border border-gray-200 px-4 py-2">{{ $loan->payable_amount }}</td>
                                    <td class="border border-gray-200 px-4 py-2">{{ $loan->branch_id }}</td>
                                    <td class="border border-gray-200 px-4 py-2" x-data="{ isOpen: false, activeSlide: 0, slides: {{ $loan->file ? count(json_decode($loan->file, true)) : 0 }} }">
                                        @if ($loan->file)
                                            @php
                                                // Decode the JSON string to an array
                                                $files = json_decode($loan->file, true);
                                            @endphp
                                            
                                            <!-- Preview button -->
                                            <button @click="isOpen = true" class="inline-flex items-center px-3 py-2 border border-gray-300 shadow-sm text-sm leading-4 font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                                <svg class="-ml-0.5 mr-2 h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                                </svg>
                                                View Files ({{ count($files) }})
                                            </button>

                                            <!-- Modal -->
                                            <div x-show="isOpen" 
                                                 x-transition:enter="transition ease-out duration-300"
                                                 x-transition:enter-start="opacity-0"
                                                 x-transition:enter-end="opacity-100"
                                                 x-transition:leave="transition ease-in duration-200"
                                                 x-transition:leave-start="opacity-100"
                                                 x-transition:leave-end="opacity-0"
                                                 class="fixed inset-0 z-50 overflow-y-auto" 
                                                 style="display: none;">
                                                <!-- Background overlay -->
                                                <div class="fixed inset-0 bg-black opacity-50"></div>

                                                <!-- Modal content -->
                                                <div class="relative min-h-screen flex items-center justify-center p-4">
                                                    <div class="relative bg-white rounded-lg max-w-3xl w-full mx-auto shadow-xl overflow-hidden">
                                                        <!-- Modal header -->
                                                        <div class="flex items-center justify-between p-4 border-b">
                                                            <h3 class="text-lg font-medium text-gray-900">File Gallery</h3>
                                                            <button @click="isOpen = false" class="text-gray-400 hover:text-gray-500">
                                                                <span class="sr-only">Close</span>
                                                                <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                                                </svg>
                                                            </button>
                                                        </div>

                                                        <!-- Carousel container -->
                                                        <div class="relative overflow-hidden" style="height: 60vh;">
                                                            @foreach ($files as $index => $file)
                                                                <div x-show="activeSlide === {{ $index }}"
                                                                     x-transition:enter="transition ease-out duration-300"
                                                                     x-transition:enter-start="opacity-0 transform translate-x-full"
                                                                     x-transition:enter-end="opacity-100 transform translate-x-0"
                                                                     x-transition:leave="transition ease-in duration-300"
                                                                     x-transition:leave-start="opacity-100 transform translate-x-0"
                                                                     x-transition:leave-end="opacity-0 transform -translate-x-full"
                                                                     class="absolute inset-0 flex items-center justify-center p-4">
                                                                    @if (Str::startsWith($file['mime_type'], 'image/'))
                                                                        <img src="data:{{ $file['mime_type'] }};base64,{{ $file['base64'] }}"
                                                                             class="max-w-full max-h-full object-contain"
                                                                             alt="{{ $file['file_name'] }}">
                                                                    @else
                                                                        <div class="text-center p-8 bg-gray-50 rounded-lg">
                                                                            <svg class="mx-auto h-16 w-16 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z"></path>
                                                                            </svg>
                                                                            <p class="mt-4 text-lg text-gray-900">{{ $file['file_name'] }}</p>
                                                                        </div>
                                                                    @endif
                                                                </div>
                                                            @endforeach
                                                        </div>

                                                        <!-- Modal footer with controls -->
                                                        <div class="border-t p-4">
                                                            <div class="flex items-center justify-between">
                                                                <!-- Navigation buttons -->
                                                                @if (count($files) > 1)
                                                                <div class="flex space-x-4">
                                                                    <button @click="activeSlide = activeSlide === 0 ? slides - 1 : activeSlide - 1"
                                                                            class="inline-flex items-center px-3 py-2 border border-gray-300 shadow-sm text-sm leading-4 font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50">
                                                                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                                                                        </svg>
                                                                        Previous
                                                                    </button>
                                                                    <button @click="activeSlide = activeSlide === slides - 1 ? 0 : activeSlide + 1"
                                                                            class="inline-flex items-center px-3 py-2 border border-gray-300 shadow-sm text-sm leading-4 font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50">
                                                                        Next
                                                                        <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                                                                        </svg>
                                                                    </button>
                                                                </div>
                                                                @endif

                                                                <!-- Download button -->
                                                                @foreach ($files as $index => $file)
                                                                    <a x-show="activeSlide === {{ $index }}"
                                                                       href="data:{{ $file['mime_type'] }};base64,{{ $file['base64'] }}"
                                                                       download="{{ $file['file_name'] }}" 
                                                                       class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                                                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"></path>
                                                                        </svg>
                                                                        Download
                                                                    </a>
                                                                @endforeach
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @else
                                            <div class="text-gray-500">NO FILE UPLOADED</div>
                                        @endif
                                    </td>
                                    <td class="border border-gray-200 px-4 py-2">{{ $loan->note }}</td>
                                </tr>
                                <!-- Repeat rows for more data -->
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>


            <!-- First Section: Personal Information -->
            <div id="profile" class="tab-content mt-6">
                <div>
                    <h3 class="text-2xl font-semibold mb-4">Personal Information</h3>
                    <div>
                        <li class="flex flex-wrap mb-2">
                            <div class="text-gray-500 w-72">Customer Type:</div>
                            <div class="text-gray-900">{{ $customer->type }}</div>
                        </li>

                        <li class="flex flex-wrap mb-2">
                            <div class="text-gray-500 w-72">Full Name:</div>
                            <div class="text-gray-900">{{ $customer->first_name }} {{ $customer->middle_name }}
                                {{ $customer->last_name }}</div>
                        </li>

                        <li class="flex flex-wrap mb-2">
                            <div class="text-gray-500 w-72">Personal Contact Number:</div>
                            <div class="text-gray-900">{{ $customer->cell_number }}</div>
                        </li>

                        <li class="flex flex-wrap mb-2">
                            <div class="text-gray-500 w-72">Birthdate:</div>
                            <div class="text-gray-900">{{ $customer->birth_date }}</div>
                        </li>

                        <li class="flex flex-wrap mb-2">
                            <div class="text-gray-500 w-72">Birth Place:</div>
                            <div class="text-gray-900">{{ $customer->birth_place }} </div>
                        </li>

                        <li class="flex flex-wrap mb-2">
                            <div class="text-gray-500 w-72">Address:</div>
                            <div class="text-gray-900">{{ $customer->house }}, {{ $customer->street }},
                                {{ $customer->barangay_name }}, {{ $customer->city_town }}
                            </div>
                        </li>

                        <li class="flex flex-wrap mb-2">
                            <div class="text-gray-500 w-72">Civil Status:</div>
                            <div class="text-gray-900">{{ $customer->civil_status }}</div>
                        </li>

                        <li class="flex flex-wrap mb-2">
                            <div class="text-gray-500 w-72">Age:</div>
                            <div class="text-gray-900">{{ $customer->age }}</div>
                        </li>

                        <li class="flex flex-wrap mb-2">
                            <div class="text-gray-500 w-72">Gender:</div>
                            <div class="text-gray-900">{{ $customer->gender }}</div>
                        </li>

                        <li class="flex flex-wrap mb-2">
                            <div class="text-gray-500 w-72">Citizenship:</div>
                            <div class="text-gray-900">{{ $customer->citizenship }}</div>
                        </li>

                        <li class="flex flex-wrap mb-2">
                            <div class="text-gray-500 w-72">Email Address:</div>
                            <div class="text-gray-900">{{ $customer->email }}</div>
                        </li>

                        <li class="flex flex-wrap mb-2">
                            <div class="text-gray-500 w-72">Facebook:</div>
                            <div class="text-gray-900">{{ $customer->facebook_name }}</div>
                        </li>
                    </div>

                </div>

                <!-- Separator Line -->
                <hr class="my-6 border-gray-300" />

                <!-- Second Section: Spousal Data -->

                <div>
                    <h3 class="text-2xl font-semibold mb-4">Spousal Data</h3>
                    <div>
                        <li class="flex flex-wrap mb-2">
                            <div class="text-gray-500 w-72">Complete Name of Spouse:</div>
                            <div class="text-gray-900">{{ $customer->spouse_name }}</div>
                        </li>

                        <li class="flex flex-wrap mb-2">
                            <div class="text-gray-500 w-72">Personal Contact Number:</div>
                            <div class="text-gray-900">{{ $customer->cell_number }}</div>
                        </li>

                        <li class="flex flex-wrap mb-2">
                            <div class="text-gray-500 w-72">Birthdate:</div>
                            <div class="text-gray-900">{{ $customer->birth_date }}</div>
                        </li>

                        <li class="flex flex-wrap mb-2">
                            <div class="text-gray-500 w-72">Age:</div>
                            <div class="text-gray-900">{{ $customer->age }}</div>
                        </li>

                        <li class="flex flex-wrap mb-2">
                            <div class="text-gray-500 w-72">Occupation:</div>
                            <div class="text-gray-900">{{ $customer->occupation }}</div>
                        </li>

                        <li class="flex flex-wrap mb-2">
                            <div class="text-gray-500 w-72">Company Name/ Address:</div>
                            <div class="text-gray-900">{{ $customer->c_nameadd }}</div>
                        </li>

                        <li class="flex flex-wrap mb-2">
                            <div class="text-gray-500 w-72">Facebook:</div>
                            <div class="text-gray-900">{{ $customer->spouse_fb }}</div>
                        </li>
                    </div>

                </div>

                <!-- Separator Line -->
                <hr class="my-6 border-gray-300" />

                <!-- Third Section: Company Information -->
                <div>
                    <h3 class="text-2xl font-semibold mb-4">Company Information</h3>
                    <div>
                        <li class="flex flex-wrap mb-2">
                            <div class="text-gray-500 w-72">Agency Name:</div>
                            <div class="text-gray-900">{{ $customer->agency_name }}</div>
                        </li>

                        <li class="flex flex-wrap mb-2">
                            <div class="text-gray-500 w-72">Address / Tel. no:</div>
                            <div class="text-gray-900">{{ $customer->add_tel }}</div>
                        </li>

                        <li class="flex flex-wrap mb-2">
                            <div class="text-gray-500 w-72">Company Name:</div>
                            <div class="text-gray-900">{{ $customer->comp_name }}</div>
                        </li>

                        <li class="flex flex-wrap mb-2">
                            <div class="text-gray-500 w-72">Address / Tel. no:</div>
                            <div class="text-gray-900">{{ $customer->add_telc }}</div>
                        </li>

                        <li class="flex flex-wrap mb-2">
                            <div class="text-gray-500 w-72">Date Hired:</div>
                            <div class="text-gray-900">{{ $customer->date_hired }}</div>
                        </li>

                        <li class="flex flex-wrap mb-2">
                            <div class="text-gray-500 w-72">Day Off:</div>
                            <div class="text-gray-900">{{ $customer->day_off }}</div>
                        </li>

                        <li class="flex flex-wrap mb-2">
                            <div class="text-gray-500 w-72">Position:</div>
                            <div class="text-gray-900">{{ $customer->job_position }}</div>
                        </li>

                        <li class="flex flex-wrap mb-2">
                            <div class="text-gray-500 w-72">Monthly Salary:</div>
                            <div class="text-gray-900">{{ $customer->monthly_salary }}</div>
                        </li>

                        <li class="flex flex-wrap mb-2">
                            <div class="text-gray-500 w-72">Salary Schedule:</div>
                            <div class="text-gray-900">{{ $customer->salary_sched }}</div>
                        </li>
                    </div>

                </div>




                <!-- Separator Line -->
                <hr class="my-6 border-gray-300" />

                <!-- Fourth Section: For Pensioners ONLY -->
                <div>
                    <h3 class="text-2xl font-semibold mb-4">For Pensioners ONLY</h3>
                    <div>
                        <li class="flex flex-wrap mb-2">
                            <div class="text-gray-500 w-72">Monthly Pension:</div>
                            <div class="text-gray-900">{{ $customer->monthly_pension }}</div>
                        </li>

                        <li class="flex flex-wrap mb-2">
                            <div class="text-gray-500 w-72">Pension Schedule:</div>
                            <div class="text-gray-900">{{ $customer->pension_sched }}</div>
                        </li>

                        <li class="flex flex-wrap mb-2">
                            <div class="text-gray-500 w-72">Pension Type:</div>
                            <div class="text-gray-900">{{ $customer->pension_type }}</div>
                        </li>

                    </div>

                </div>

                <!-- Separator Line -->
                <hr class="my-6 border-gray-300" />

                <!-- Fifth Section: Background Data -->
                <div>
                    <h3 class="text-2xl font-semibold mb-4">Background Data</h3>
                    <div>
                        <li class="flex flex-wrap mb-2">
                            <div class="text-gray-500 w-72">Father's Name:</div>
                            <div class="text-gray-900">{{ $customer->fathers_name }}</div>
                        </li>

                        <li class="flex flex-wrap mb-2">
                            <div class="text-gray-500 w-72">Contact No.:</div>
                            <div class="text-gray-900">{{ $customer->fathers_num }}</div>
                        </li>

                        <li class="flex flex-wrap mb-2">
                            <div class="text-gray-500 w-72">Mother's Name:</div>
                            <div class="text-gray-900">{{ $customer->mothers_name }}</div>
                        </li>

                        <li class="flex flex-wrap mb-2">
                            <div class="text-gray-500 w-72">Contact No.:</div>
                            <div class="text-gray-900">{{ $customer->mothers_num }}</div>
                        </li>
                    </div>

                </div>

                <!-- Separator Line -->
                <hr class="my-6 border-gray-300" />

                <!-- Last Section: Bank Account Informations -->
                <div>
                    <h3 class="text-2xl font-semibold mb-4">Bank Account Informations</h3>
                    <div>
                        <li class="flex flex-wrap mb-2">
                            <div class="text-gray-500 w-72">Bank / Branch:</div>
                            <div class="text-gray-900">{{ $customer->branch }}</div>
                        </li>

                        <li class="flex flex-wrap mb-2">
                            <div class="text-gray-500 w-72">Card No.:</div>
                            <div class="text-gray-900">{{ $customer->card_no }}</div>
                        </li>

                        <li class="flex flex-wrap mb-2">
                            <div class="text-gray-500 w-72">Account No.:</div>
                            <div class="text-gray-900">{{ $customer->acc_no }}</div>
                        </li>

                        <li class="flex flex-wrap mb-2">
                            <div class="text-gray-500 w-72">Pin No.:</div>
                            <div class="text-gray-900">{{ $customer->pin_no }}</div>
                        </li>
                    </div>

                </div>
            </div>

        </div>

</x-app-layout>

<script>
    function switchTab(tabId) {
        // Hide all tab content
        document.querySelectorAll(".tab-content").forEach((content) => {
            content.classList.add("hidden");
        });

        // Remove active styles from all tab buttons
        document.querySelectorAll(".tab-btn").forEach((btn) => {
            btn.classList.remove("text-accent-600", "border-accent-100");
            btn.classList.add("text-gray-500");
        });

        // Show the selected tab content
        document.getElementById(tabId).classList.remove("hidden");

        // Highlight the active tab button
        document
            .getElementById(tabId + "-tab")
            .classList.add("text-accent-600", "border-accent-100");
        document
            .getElementById(tabId + "-tab")
            .classList.remove("text-gray-500");
    }

    // Set default active tab
    switchTab("profile");
</script>

<script>
    // References to modal elements
    const modal = document.getElementById("modal");
    const openModalBtn = document.getElementById("open-modal");
    const closeModalBtn = document.getElementById("close-modal");
    const closeModalBtn2 = document.getElementById("close-modal-btn");
    const modalForm = document.getElementById("modal-form");

    // Show the modal
    openModalBtn.addEventListener("click", () => {
        modal.classList.remove("hidden");
    });

    // Hide the modal
    closeModalBtn.addEventListener("click", () => {
        modal.classList.add("hidden");
    });

    closeModalBtn2.addEventListener("click", () => {
        modal.classList.add("hidden");
    });

    // Handle form submission
    modalForm.addEventListener("submit", (e) => {
        e.preventDefault(); // Prevent default form submission

        // Collect form data
        const date = document.getElementById("date").value;
        const reason = document.getElementById("reason").value;

        // Log or use form data as needed
        console.log("Date:", date);
        console.log("Reason:", reason);

        // Close the modal
        modal.classList.add("hidden");

        // Optional: Reset form
        modalForm.reset();
    });

    function openModal(event) {
    event.preventDefault();
    document.getElementById('modal2').classList.remove('hidden');
    }

    function closeModal(event) {
        event.preventDefault();
        document.getElementById('modal2').classList.add('hidden');
    }

</script>

<script>
    document.getElementById("open-transaction-modal").addEventListener("click", function () {
        document.getElementById("transaction-modal").classList.remove("hidden");
    });
    document.getElementById("close-transaction-modal").addEventListener("click", function () {
        document.getElementById("transaction-modal").classList.add("hidden");
    });
    document.getElementById("close-transaction-btn").addEventListener("click", function () {
        document.getElementById("transaction-modal").classList.add("hidden");
    });

    document.getElementById('transaction').addEventListener('change', function() {
        document.getElementById('selected-transaction').value = this.value;
    });
</script>

