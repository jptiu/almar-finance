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
                <a id="open-modal" href="#" class="btn bg-indigo-500 hover:bg-indigo-600 text-white">
                    <svg xmlns="http://www.w3.org/2000/svg" height="20px" viewBox="0 -960 960 960" width="20px"
                        fill="#FFFFFF">
                        <path
                            d="M216-216h51l375-375-51-51-375 375v51Zm-72 72v-153l498-498q11-11 23.84-16 12.83-5 27-5 14.16 0 27.16 5t24 16l51 51q11 11 16 24t5 26.54q0 14.45-5.02 27.54T795-642L297-144H144Zm600-549-51-51 51 51Zm-127.95 76.95L591-642l51 51-25.95-25.05Z" />
                    </svg>
                    <span class="hidden xs:block ml-2">Request to Edit</span>
                </a>

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


                <div id="modal" class="relative z-10 hidden" aria-labelledby="modal-title" role="dialog"
                    aria-modal="true">
                    <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" aria-hidden="true"></div>

                    <div class="fixed inset-0 z-10 w-screen overflow-y-auto">
                        <div class="flex min-h-full items-end justify-center p-4 text-center sm:items-center sm:p-0">
                            <div
                                class="relative transform overflow-hidden rounded-lg bg-white text-left shadow-xl transition-all sm:my-8 sm:w-full sm:max-w-lg">
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
                                            <div class="mt-3 text-center sm:ml-4 sm:mt-0 sm:text-left">
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
                <a href="{{ route('customer.index') }}" class="text-base font-semibold">Back</a>
            </div>

            <!-- Tabs Section -->
            <div class="mt-6 mb-8 border-b border-gray-200">
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
                                    <td class="border border-gray-200 px-4 py-2">{{ $loan->loan_type }}</td>
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
                                    <td class="border border-gray-200 px-4 py-2">{{ $loan->principal_amount }}</td>
                                    <td class="border border-gray-200 px-4 py-2">{{ $loan->days_to_pay }}</td>
                                    <td class="border border-gray-200 px-4 py-2">{{ $loan->months_to_pay }}</td>
                                    <td class="border border-gray-200 px-4 py-2">{{ $loan->interest }}</td>
                                    <td class="border border-gray-200 px-4 py-2">{{ $loan->interest_amount }}</td>
                                    <td class="border border-gray-200 px-4 py-2">{{ $loan->svc_charge }}</td>
                                    <td class="border border-gray-200 px-4 py-2">{{ $loan->payable_amount }}</td>
                                    <td class="border border-gray-200 px-4 py-2">{{ $loan->branch_id }}</td>
                                    <td class="border border-gray-200 px-4 py-2">
                                        @if ($loan->file)
                                            <a href="data:application/pdf;base64,{{ $loan->file }}"
                                                download="Download" class="underline text-blue-500">
                                                Download File
                                            </a>
                                        @endif
                                        @if ($loan->file == null)
                                            NO FILE UPLOADED
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
                                {{ $customer->barangay }}, {{ $customer->city }}
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
</script>
