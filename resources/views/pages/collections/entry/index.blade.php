<x-app-layout>
    <div class="px-4 sm:px-6 lg:px-8 py-8 w-full max-w-9xl mx-auto">

        <div class="relative">
            <h1 class="text-2xl md:text-2xl text-slate-800 dark:text-slate-100 font-bold mb-12">Collections Data Entry
            </h1>
        </div>

        <!-- Dashboard actions -->
        <div class="sm:flex sm:justify-between sm:items-center mb-8">
            <div></div>

            <!-- Right: Actions -->
            <div class="grid grid-flow-col sm:auto-cols-max justify-start sm:justify-end gap-2">

                <!-- Filter button -->
                <x-dropdown-filter align="right" />

                <!-- Add view button -->
                <a href="{{ route('collection.create') }}" class="btn bg-indigo-500 hover:bg-indigo-600 text-white">
                    <svg class="w-4 h-4 fill-current opacity-50 shrink-0" viewBox="0 0 16 16">
                        <path
                            d="M15 7H9V1c0-.6-.4-1-1-1S7 .4 7 1v6H1c-.6 0-1 .4-1 1s.4 1 1 1h6v6c0 .6.4 1 1 1s1-.4 1-1V9h6c.6 0 1-.4 1-1s-.4-1-1-1z" />
                    </svg>
                    <span class="hidden xs:block ml-2">New</span>
                </a>

            </div>

        </div>

        <div class="bg-white rounded shadow-lg p-4 px-4 md:p-8 mb-6">
            <div class="flex items-center text-gray-600 mb-12">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                    xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                </svg>
                <a href="{{ route('collection.index') }}" class="text-base font-semibold">Back</a>
            </div>
            <form action="{{ route('collection.store') }}" method="POST">
                @csrf
                <div class="grid grid-cols-2 gap-4">
                    <div class="...">
                        <div class="mb-8">
                            <div class="grid gap-4 gap-y-2 text-sm grid-cols-1 lg:grid-cols-1">
                                <div class="lg:col-span-2">
                                    <div class="grid gap-4 gap-y-2 text-sm grid-cols-1 md:grid-cols-2">

                                        <div class="md:col-span-1">
                                            <label for="customer" class="text-black font-medium">Select Customer</label>
                                            <div class="relative">
                                                <input type="text" id="customerInput" placeholder="Type to search..."
                                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-2 p-2.5"
                                                    oninput="filterCustomers()" />
                                                <ul id="customerDropdown"
                                                    class="absolute bg-white border border-gray-300 rounded-lg w-full mt-1 hidden max-h-48 overflow-y-auto z-10">
                                                    @foreach ($customers as $customer)
                                                        <li class="px-4 py-2 cursor-pointer hover:bg-blue-500 hover:text-white"
                                                            onclick="selectCustomer('{{ $customer->id }}', '{{ $customer->first_name }} {{ $customer->last_name }}')">
                                                            {{ $customer->first_name . ' ' . $customer->last_name }}
                                                        </li>
                                                    @endforeach
                                                </ul>
                                                <input type="hidden" name="customer" id="selectedCustomer">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>


                        <div class="mb-8">
                            <div class="grid gap-4 gap-y-2 text-sm grid-cols-1 lg:grid-cols-1">
                                <div class="lg:col-span-2">
                                    <div class="grid gap-4 gap-y-2 text-sm grid-cols-1 md:grid-cols-2">

                                        <div class="md:col-span-1">
                                            <label for="id" class="text-black font-medium">ID</label>
                                            <input type="text" name="id" id="id"
                                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-2 p-2.5"
                                                value="" placeholder="" />
                                        </div>

                                        <div class="md:col-span-1">
                                            <label for="name" class="text-black font-medium">Name</label>
                                            <input type="text" name="name" id="name"
                                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-2 p-2.5"
                                                value="" placeholder="" />
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="mb-8">
                            <div class="grid gap-4 gap-y-2 text-sm grid-cols-1 lg:grid-cols-1">
                                <div class="lg:col-span-2">
                                    <div class="grid gap-4 gap-y-2 text-sm grid-cols-1 md:grid-cols-2">

                                        <div class="md:col-span-1">
                                            <label for="type" class="text-black font-medium">Type</label>
                                            <input type="text" name="type" id="type"
                                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-2 p-2.5"
                                                value="" placeholder="" />
                                        </div>

                                        <div class="md:col-span-1">
                                            <label for="status" class="text-black font-medium">Status</label>
                                            <input type="text" name="status" id="status"
                                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-2 p-2.5"
                                                value="" placeholder="" />
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="mb-8">
                            <div class="grid gap-4 gap-y-2 text-sm grid-cols-1 lg:grid-cols-1">
                                <div class="lg:col-span-2">
                                    <div class="grid gap-4 gap-y-2 text-sm grid-cols-1 md:grid-cols-2">

                                        <div class="md:col-span-1">
                                            <label for="trans_no" class="text-black font-medium">Transaction No.</label>
                                            <input type="text" name="trans_no" id="trans_no"
                                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-2 p-2.5"
                                                value="" placeholder="" />
                                        </div>

                                        <div class="md:col-span-1">
                                            <label for="collector" class="text-black font-medium">Collector</label>
                                            <select name="collector" id="collector"
                                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-2 p-2.5" />
                                            @foreach ($collectors as $collector)
                                                <option value="{{ $collector->id }}">{{ $collector->name }}</option>
                                            @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="mb-24">
                            <div class="grid gap-4 gap-y-2 text-sm grid-cols-1 lg:grid-cols-1">
                                <div class="lg:col-span-2">
                                    <div class="grid gap-4 gap-y-2 text-sm grid-cols-1 md:grid-cols-2">

                                        <div class="md:col-span-1">
                                            <label for="date_of_loan" class="text-black font-medium">Date</label>
                                            <input type="date" name="date_of_loan" id="date_of_loan"
                                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-2 p-2.5"
                                                value="" placeholder="" />
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="mb-8">
                            <div class="grid gap-4 gap-y-2 text-sm grid-cols-1 lg:grid-cols-1">
                                <div class="lg:col-span-2">
                                    <div class="grid gap-4 gap-y-2 text-sm grid-cols-1 md:grid-cols-2">

                                        <div class="md:col-span-1">
                                            <label for="loans" class="text-black font-medium">Select which unpaid
                                                Loan to pay</label>
                                            <select name="loans" id="loans"
                                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-2 p-2.5" />
                                            <option>Select</option>
                                            </select>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="mb-8">
                            <div class="grid gap-4 gap-y-2 text-sm grid-cols-1 lg:grid-cols-1">
                                <div class="lg:col-span-2">
                                    <div class="grid gap-4 gap-y-2 text-sm grid-cols-1 md:grid-cols-2">

                                        <div class="md:col-span-1">
                                            <label for="loan_no" class="text-black font-medium">LTD Row #</label>
                                            <input type="text" name="loan_no" id="loan_no"
                                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-2 p-2.5"
                                                value="" placeholder="" />
                                        </div>

                                        <div class="md:col-span-1">
                                            <label for="loan_due_date" class="text-black font-medium">Due Date</label>
                                            <input type="date" name="loan_due_date" id="loan_due_date"
                                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-2 p-2.5"
                                                value="" placeholder="" />
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="mb-8">
                            <div class="grid gap-4 gap-y-2 text-sm grid-cols-1 lg:grid-cols-1">
                                <div class="lg:col-span-2">
                                    <div class="grid gap-4 gap-y-2 text-sm grid-cols-1 md:grid-cols-2">

                                        <div class="md:col-span-1">
                                            <label for="loan_due_amount" class="text-black font-medium">Amount
                                                Due</label>
                                            <input type="text" name="loan_due_amount" id="loan_due_amount"
                                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-2 p-2.5"
                                                disabled />
                                        </div>

                                        <div class="md:col-span-1">
                                            <label for="date_paid" class="text-black font-medium">Date Paid</label>
                                            <input type="date" name="date_paid" id="date_paid"
                                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-2 p-2.5"
                                                value="" placeholder="" />
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="mb-8">
                            <div class="grid gap-4 gap-y-2 text-sm grid-cols-1 lg:grid-cols-1">
                                <div class="lg:col-span-2">
                                    <div
                                        class="flex justify-between grid gap-4 gap-y-2 text-sm grid-cols-1 md:grid-cols-2">

                                        <div class="md:col-span-1">
                                            <input type="checkbox" name="house" id="house"
                                                class="border px-2 py-2 bg-gray-50" value="" placeholder="" />
                                            <label for="house" class="mt-2 ml-1">Allow Grace period</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="mb-8 flex flex-row-reverse">
                            <div class="grid gap-4 gap-y-2 text-sm grid-cols-1 lg:grid-cols-1">
                                <div class="lg:col-span-2">
                                    <div
                                        class="flex justify-between grid gap-4 gap-y-2 text-sm grid-cols-1 md:grid-cols-2">

                                        <div class="md:col-span-1">
                                            {{-- <button type="submit"
                                            class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Input
                                            Check Number</button> --}}
                                            <button type="submit"
                                                class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Submit</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>

                    <div class="...">
                        <section class="p-8">
                            <div>
                                <div class="border-2">
                                    <div class="text-center bg-blue-800 text-white py-3">
                                        <h1 class="text-lg font-bold">Payment Details</h1>
                                    </div>
                                    <div class="p-4">
                                        <div class="mb-4">
                                            <div class="grid gap-4 gap-y-2 text-sm grid-cols-1 lg:grid-cols-1">
                                                <div class="lg:col-span-2">
                                                    <div class="grid gap-4 gap-y-2 text-sm grid-cols-1 md:grid-cols-2">

                                                        <div class="md:col-span-1">
                                                            <h1 class="text-lg mt-2 font-medium">Previous Balance</h1>
                                                        </div>

                                                        <div class="md:col-span-1">
                                                            <input type="text" name="prev_balance"
                                                                id="prev_balance"
                                                                class="h-10 border mt-1 rounded px-4 w-full bg-gray-50"
                                                                value="" placeholder="" disabled />
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="mb-4">
                                            <div class="grid gap-4 gap-y-2 text-sm grid-cols-1 lg:grid-cols-1">
                                                <div class="lg:col-span-2">
                                                    <div class="grid gap-4 gap-y-2 text-sm grid-cols-1 md:grid-cols-2">

                                                        <div class="md:col-span-1">
                                                            <h1 class="text-lg mt-2 font-medium">Amount Withdrawn from
                                                                ATM</h1>
                                                        </div>

                                                        <div class="md:col-span-1">
                                                            <input type="number" name="loan_withdraw_from_bank"
                                                                id="loan_withdraw_from_bank"
                                                                class="h-10 border mt-1 rounded px-4 w-full bg-gray-50"
                                                                value="" placeholder="" />
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="mb-4">
                                            <div class="grid gap-4 gap-y-2 text-sm grid-cols-1 lg:grid-cols-1">
                                                <div class="lg:col-span-2">
                                                    <div class="grid gap-4 gap-y-2 text-sm grid-cols-1 md:grid-cols-2">

                                                        <div class="md:col-span-1">
                                                            <h1 class="text-lg mt-2 font-medium">Total Amount Due</h1>
                                                        </div>

                                                        <div class="md:col-span-1">
                                                            <input type="text" name="total_due_amount"
                                                                id="total_due_amount"
                                                                class="h-10 border mt-1 rounded px-4 w-full bg-gray-50"
                                                                disabled />
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="mb-4">
                                            <div class="grid gap-4 gap-y-2 text-sm grid-cols-1 lg:grid-cols-1">
                                                <div class="lg:col-span-2">
                                                    <div class="grid gap-4 gap-y-2 text-sm grid-cols-1 md:grid-cols-2">

                                                        <div class="md:col-span-1">
                                                            <h1 class="text-lg mt-2 font-medium">Actual Amount Paid
                                                            </h1>
                                                        </div>

                                                        <div class="md:col-span-1">
                                                            <input type="text" name="loan_amount_paid"
                                                                id="loan_amount_paid"
                                                                class="h-10 border mt-1 rounded px-4 w-full bg-gray-50"
                                                                value="" placeholder="" />
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="mb-4">
                                            <div class="grid gap-4 gap-y-2 text-sm grid-cols-1 lg:grid-cols-1">
                                                <div class="lg:col-span-2">
                                                    <div class="grid gap-4 gap-y-2 text-sm grid-cols-1 md:grid-cols-2">

                                                        <div class="md:col-span-1">
                                                            <h1 class="text-lg mt-2 font-medium">Change</h1>
                                                        </div>

                                                        <div class="md:col-span-1">
                                                            <input type="number" name="loan_amount_change"
                                                                id="loan_amount_change"
                                                                class="h-10 border mt-1 rounded px-4 w-full bg-gray-50"
                                                                value="" placeholder="" />
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="mb-4">
                                            <div class="grid gap-4 gap-y-2 text-sm grid-cols-1 lg:grid-cols-1">
                                                <div class="lg:col-span-2">
                                                    <div class="grid gap-4 gap-y-2 text-sm grid-cols-1 md:grid-cols-2">

                                                        <div class="md:col-span-1">
                                                            <h1 class="text-lg mt-2 font-medium">Current Balance</h1>
                                                        </div>

                                                        <div class="md:col-span-1">
                                                            <input type="text" name="loan_running_balance"
                                                                id="loan_running_balance"
                                                                class="h-10 border mt-1 rounded px-4 w-full bg-gray-50"
                                                                disabled />
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </section>
                    </div>
                </div>
            </form>
        </div>

    </div>
</x-app-layout>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script>
    function getCustomer(id) {
        // const customerID = document.getElementById("customer").value;

        $.ajax({
            url: '{{ route('collection.index') }}',
            type: 'GET',
            data: {
                _token: '{{ csrf_token() }}',
                customer_id: id,
            },
            success: function(response) {
                // Handle the special case for "name" input field
                const nameField = document.getElementById("name");
                const transactionField = document.getElementById("trans_no");
                const loanNo = document.getElementById("loan_no");
                const loanDue = document.getElementById("loan_due_amount");
                const totalDue = document.getElementById("total_due_amount");
                const loanDueDate = document.getElementById("loan_due_date");
                const loanRunBal = document.getElementById("loan_running_balance");
                const loans = document.getElementById("loans");
                const customerType = document.getElementById("type");
                const prevBal = document.getElementById("prev_balance");
                let bal = 0.00;
                loans.innerHTML = '';
                if (response.customer) {
                    const customerData = response.customer;
                    const loanData = response.customer.loan;
                    if (loanData.status == 'CLOSE') {
                        alert('No Transactions');
                    } else {
                        if (nameField && customerData.first_name && customerData.last_name) {
                            nameField.value = `${customerData.first_name} ${customerData.last_name}`;
                        }

                        if (transactionField && loanData.id) {
                            console.log(loanData.id)
                            transactionField.value = `${loanData.id}`;
                        }

                        if (customerType && customerData.customer_type) {
                            customerType.value = `${customerData.customer_type.description}`;
                        }

                        if (loanData.details[0]) {
                            loanNo.value = loanData.details[0].loan_day_no;
                            loanDue.value = new Intl.NumberFormat('en-US', {
                                minimumFractionDigits: 2,
                                maximumFractionDigits: 2
                            }).format(loanData.details[0].loan_due_amount);
                            totalDue.value = new Intl.NumberFormat('en-US', {
                                minimumFractionDigits: 2,
                                maximumFractionDigits: 2
                            }).format(loanData.details[0].loan_due_amount);
                            loanDueDate.value = loanData.details[0].loan_due_date;
                            loanRunBal.value = new Intl.NumberFormat('en-US', {
                                minimumFractionDigits: 2,
                                maximumFractionDigits: 2
                            }).format(loanData.details[0].loan_running_balance);
                        }

                        // Assuming loanData.details is an array
                        for (let i = 0; i < loanData.details.length; i++) {
                            const row =
                                `<option value="${loanData.details[i].loan_day_no}">${loanData.details[i].loan_day_no}</option>`;
                            loans.innerHTML += row;
                            bal += parseFloat(loanData.details[i].loan_due_amount) || 0;
                        }
                        prevBal.value = new Intl.NumberFormat('en-US', {
                            minimumFractionDigits: 2,
                            maximumFractionDigits: 2
                        }).format(bal);

                        // Loop through each key in customerData to update respective fields
                        Object.keys(customerData).forEach(key => {
                            if (key !== "first_name" && key !== "last_name" && key !==
                                "type") { // Skip first and last name as we already handled it
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
                            if (key !== "id" && key !== "trans_no" && key !== "status") {
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
                    }
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

    function filterCustomers() {
        const input = document.getElementById('customerInput').value.toLowerCase();
        const dropdown = document.getElementById('customerDropdown');
        const items = dropdown.getElementsByTagName('li');

        dropdown.classList.remove('hidden'); // Show dropdown

        Array.from(items).forEach(item => {
            const name = item.textContent.toLowerCase();
            if (name.includes(input)) {
                item.classList.remove('hidden');
            } else {
                item.classList.add('hidden');
            }
        });
    }

    function selectCustomer(id, name) {
        document.getElementById('customerInput').value = name;
        document.getElementById('selectedCustomer').value = id;
        document.getElementById('customerDropdown').classList.add('hidden'); // Hide dropdown
        getCustomer(id);
    }
    // Hide dropdown when clicking outside
    document.addEventListener('click', (event) => {
        const dropdown = document.getElementById('customerDropdown');
        const input = document.getElementById('customerInput');
        if (!dropdown.contains(event.target) && !input.contains(event.target)) {
            dropdown.classList.add('hidden');
        }
    });
</script>
