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


        <!-- Dashboard actions -->
        <div class="sm:flex sm:justify-between sm:items-center mb-8">
            <div></div>

            <!-- Right: Actions -->
            <div class="grid grid-flow-col sm:auto-cols-max justify-start sm:justify-end gap-2">

                <!-- Filter button -->
                <!-- <x-dropdown-filter align="right" /> -->

                <!-- Add view button -->
                <!-- <a href="{{ route('expenses.index') }}" class="btn bg-indigo-500 hover:bg-indigo-600 text-white">
                    <svg class="w-4 h-4 fill-current opacity-50 shrink-0" viewBox="0 0 16 16">
                        <path
                            d="M15 7H9V1c0-.6-.4-1-1-1S7 .4 7 1v6H1c-.6 0-1 .4-1 1s.4 1 1 1h6v6c0 .6.4 1 1 1s1-.4 1-1V9h6c.6 0 1-.4 1-1s-.4-1-1-1z" />
                    </svg>
                    <span class="hidden xs:block ml-2">New</span>
                </a> -->

            </div>

        </div>

        <form action="{{ route('depositentry.storeDeposit') }}" method="POST">
            @csrf
            <div class="bg-white rounded shadow-lg p-4 px-4 md:p-8 mb-6">
                <div class="flex items-center text-gray-600 mb-12">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                        xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7">
                        </path>
                    </svg>
                    <a href="{{ route('depositentry.index') }}" class="text-base font-semibold">Back</a>
                </div>
                <div class="relative">
                    <h1 class="text-2xl md:text-2xl text-slate-800 dark:text-slate-100 font-bold mb-12">Savings Deposit
                        Entry</h1>
                </div>

                <div>
                    <div class="grid gap-4 gap-y-2 text-sm grid-cols-1 lg:grid-cols-1">
                        <div class="lg:col-span-2">
                            <div class="grid gap-4 gap-y-2 text-sm grid-cols-1 md:grid-cols-8">

                                <div class="md:col-span-2">
                                    <label for="ref_id" class="text-black font-medium">Ref No.</label>
                                    <input type="text" name="ref_id" id="ref_id"
                                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-2 p-2.5"
                                        value="" placeholder="Optional" />
                                </div>

                                <div class="md:col-span-2">
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
                                        <input type="hidden" name="customer_name" id="selectedCustomerName">
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>

                <x-section-border />

                <div>
                    <div class="grid gap-4 gap-y-2 text-sm grid-cols-1 lg:grid-cols-1">
                        <div class="lg:col-span-2">
                            <div class="grid gap-4 gap-y-2 text-sm grid-cols-1 md:grid-cols-8">

                                <div class="md:col-span-2">
                                    <label for="tran_date" class="text-black font-medium">Transaction Date</label>
                                    <input type="date" name="tran_date" id="tran_date"
                                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-2 p-2.5"
                                        value="" placeholder="" />
                                </div>

                                <div class="md:col-span-2">
                                    <label for="amount" class="text-black font-medium">Amount</label>
                                    <input type="text" name="amount" id="amount"
                                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-2 p-2.5"
                                        value="" placeholder="" />
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div>
                    <div class="grid gap-4 gap-y-2 text-sm grid-cols-1 lg:grid-cols-3">
                        <div class="text-gray-600">
                            <p class="font-medium text-lg"></p>
                        </div>

                        <div class="lg:col-span-2">
                            <div class="grid gap-4 gap-y-2 text-sm grid-cols-1 md:grid-cols-5">
                                <div class="md:col-span-5 text-right">
                                    <div class="inline-flex items-end">

                                        <button type="submit"
                                            class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded ml-2">Submit</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>

    </div>
</x-app-layout>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script>
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
        document.getElementById('selectedCustomerName').value = name;
        document.getElementById('selectedCustomer').value = id;
        document.getElementById('customerDropdown').classList.add('hidden'); // Hide dropdown
        getCustomer(id);
    }
    // Hide dropdown when clicking outside
    document.addEventListener('click', (event) => {
        const dropdown = document.getElementById('customerDropdown');
        const input = document.getElementById('selectedCustomerName');
        if (!dropdown.contains(event.target) && !input.contains(event.target)) {
            dropdown.classList.add('hidden');
        }
    });
</script>
