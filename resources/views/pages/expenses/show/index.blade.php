<x-app-layout>
    <div class="px-4 sm:px-6 lg:px-8 py-8 w-full max-w-9xl mx-auto">

       <!-- Dashboard actions -->
       <div class="sm:flex sm:justify-between sm:items-center mb-4">
       <div>
            <h1 class="text-2xl md:text-2xl text-slate-800 dark:text-slate-100 font-bold">Expenses Data Entry</h1>
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
                        <a href="#" class="text-sm text-gray-500">Expenses Data Entry</a>
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
                <svg xmlns="http://www.w3.org/2000/svg" height="20px" viewBox="0 -960 960 960" width="20px" fill="#FFFFFF">
                    <path d="M216-216h51l375-375-51-51-375 375v51Zm-72 72v-153l498-498q11-11 23.84-16 12.83-5 27-5 14.16 0 27.16 5t24 16l51 51q11 11 16 24t5 26.54q0 14.45-5.02 27.54T795-642L297-144H144Zm600-549-51-51 51 51Zm-127.95 76.95L591-642l51 51-25.95-25.05Z"/>
                </svg>
                    <span class="hidden xs:block ml-2">Request to Edit</span>
                </a>

                <!-- Modal -->
                <div id="modal" class="fixed inset-0 z-50 hidden bg-gray-800 bg-opacity-50 flex items-center justify-center">
                    <!-- Modal Content -->
                    <div class="fixed inset-0 z-10 w-screen overflow-y-auto">
                        <div class="flex min-h-full items-end justify-center p-4 text-center sm:items-center sm:p-0">
                            <div class="relative transform overflow-hidden rounded-lg bg-white text-left shadow-xl transition-all sm:my-8 sm:w-full sm:max-w-lg">
                                <!-- Modal Header -->
                                <div class="flex justify-between items-center p-4 mb-4">
                                    <h2 class="text-lg font-semibold">Request to Edit</h2>
                                    <button id="close-modal" class="text-gray-500 hover:text-gray-700">&times;</button>
                                </div>

                                <!-- Modal Form -->
                                <form id="modal-form" class="px-6">
                                    <!-- Date Input -->
                                    <div class="mb-4">
                                        <label for="date" class="block text-sm font-medium text-gray-700">Date</label>
                                        <input type="date" id="date" name="date" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2 focus:ring-blue-500 focus:border-blue-500" required>
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
                                        <textarea id="reason" name="reason" rows="3" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2 focus:ring-blue-500 focus:border-blue-500" placeholder="Enter reason here..." required></textarea>
                                    </div>

                                    <!-- Modal Actions -->
                                    <div class="flex justify-end mb-4">
                                        <button type="button" id="close-modal-btn" class="bg-gray-300 text-gray-700 px-4 py-2 rounded mr-2 hover:bg-gray-400">
                                            Cancel
                                        </button>
                                        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">
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
                <a href="{{ route('expenses.index') }}" class="text-base font-semibold">Back</a>
            </div>

            <div class="grid grid-cols-1 gap-4">
                <div class="...">
                    <!-- Transaction Reference Summary -->
                    <div class="relative">
                        <h2 class="text-2xl md:text-2xl text-slate-800 dark:text-slate-100 font-bold mb-2">
                            Transaction Reference Summary</h2>
                        <hr class="h-px my-4 mb-4 bg-gray-200 border-0 dark:bg-gray-700">
                    </div>
                    <div class="mb-6">
                        <div class="grid grid-cols-3 gap-8 mt-4 mb-12 text-sm text-gray-500">
                            <div>
                                <p class="text-gray-900 text-sm">Exp Ref No.</p>
                                <p class="font-bold text-gray-900 text-base">{{ $expenses->id }}</p>
                            </div>
                            <div>
                                <p class="text-gray-900 text-sm">Acct No.</p>
                                <p class="font-bold text-gray-900 text-base">{{ $expenses->acc_no }}</p>
                            </div>
                            <div>
                                <p class="text-gray-900 text-sm">Acct Class</p>
                                <p class="font-bold text-gray-900 text-base">{{ $expenses->account->acc_class }}</p>
                            </div>
                            <div>
                                <p class="text-gray-900 text-sm">Acct Type</p>
                                <p class="font-bold text-gray-900 text-base">{{ $expenses->account->acc_type }}</p>
                            </div>
                            <div>
                                <p class="text-gray-900 text-sm">Acct Title</p>
                                <p class="font-bold text-gray-900 text-base">{{ $expenses->account->acc_title }}</p>
                            </div>
                            <div>
                                <p class="text-gray-900 text-sm">Amount</p>
                                <p class="font-bold text-gray-900 text-base">{{ $expenses->amount }}</p>
                            </div>
                            <div>
                                <p class="text-gray-900 text-sm">Expiry Date</p>
                                <p class="font-bold text-gray-900 text-base">{{ $expenses->exp_date }}</p>
                            </div>
                            <div>
                                <p class="text-gray-900 text-sm">O.R No.</p>
                                <p class="font-bold text-gray-900 text-base">{{ $expenses->or_no }}</p>
                            </div>
                            <div>
                                <p class="text-gray-900 text-sm">Justification</p>
                                <p class="font-bold text-gray-900 text-base">{{ $expenses->justification }}</p>
                            </div>
                        </div>
                    </div>
                    <!-- Cards -->
                    <div class="relative">
                        <h2 class="text-2xl md:text-2xl text-slate-800 dark:text-slate-100 font-bold mb-6">Payment
                            Details</h2>
                    </div>
                    <section class="container mx-auto mb-12">
                        <div class="flex flex-col">
                            <div class="-mx-4 -my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                                <div class="inline-block min-w-full py-2 align-middle md:px-6 lg:px-8">
                                    <div
                                        class="overflow-hidden border border-gray-200 dark:border-gray-700 md:rounded-lg">
                                        <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                                            <thead class="bg-gray-50 dark:bg-gray-800">
                                                <tr>
                                                    <th scope="col"
                                                        class="px-4 py-3.5 text-sm font-normal text-left rtl:text-right text-black font-medium">
                                                        Charge To
                                                    </th>


                                                </tr>
                                            </thead>
                                            <tbody
                                                class="bg-white divide-y divide-gray-200 dark:divide-gray-500 dark:bg-gray-900">

                                                <tr>
                                                    <td
                                                        class="px-4 py-4 text-sm font-medium text-gray-500 dark:text-gray-200 whitespace-nowrap">

                                                    </td>

                                                    <td
                                                        class="px-4 py-4 text-sm text-gray-500 dark:text-gray-300 whitespace-nowrap">
                                                        <div class="flex items-center gap-x-2">
                                                            <div>
                                                                <h2
                                                                    class="text-sm font-medium text-gray-500 dark:text-white ">
                                                                </h2>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td class="px-4 py-4 text-sm whitespace-nowrap">

                                                    </td>
                                                </tr>

                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>
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