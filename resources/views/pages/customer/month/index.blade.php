<x-app-layout>
    <div class="px-4 sm:px-6 lg:px-8 py-8 w-full max-w-9xl mx-auto">

        <div class="relative">
            <h1 class="text-2xl md:text-2xl text-slate-800 dark:text-slate-100 font-bold mb-4">Customer Ledger - Atm
            </h1>
        </div>

        <!-- Dashboard actions -->
        <div class="sm:flex sm:justify-between sm:items-center">
            <div></div>

            <!-- Right: Actions -->
            <div class="grid grid-flow-col sm:auto-cols-max justify-start sm:justify-end gap-2">

                <!-- Filter button -->
                <!-- <x-dropdown-filter align="right" /> -->

                <!-- Add view button -->
                <!-- <a href="{{ route('customer.add') }}" class="btn bg-indigo-500 hover:bg-indigo-600 text-white">
                    <svg class="w-4 h-4 fill-current opacity-50 shrink-0" viewBox="0 0 16 16">
                        <path
                            d="M15 7H9V1c0-.6-.4-1-1-1S7 .4 7 1v6H1c-.6 0-1 .4-1 1s.4 1 1 1h6v6c0 .6.4 1 1 1s1-.4 1-1V9h6c.6 0 1-.4 1-1s-.4-1-1-1z" />
                    </svg>
                    <span class="hidden xs:block ml-2">New</span>
                </a> -->

            </div>

        </div>

        <form id="loan-form" action="{{ route('printLoan.index') }}" method="GET">
            @csrf
            <div class="bg-white rounded shadow-lg p-4 px-4 md:p-8 mb-6">
                <div>
                    <div class="grid gap-4 gap-y-2 text-sm grid-cols-1 lg:grid-cols-1">
                        <div class="lg:col-span-2">
                            <div class="grid gap-4 gap-y-2 text-sm grid-cols-1 md:grid-cols-8">
                                <div class="md:col-span-2">
                                    <label for="house" class="text-black font-medium">Branch</label>
                                    <select name="type" id="type"
                                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-2 p-2.5" />
                                    @foreach ($branches as $branch)
                                        <option value="{{ $branch->id }}">{{ $branch->name }}</option>
                                    @endforeach
                                    </select>
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
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <x-section-border />

                <div>
                    <div class="grid gap-4 gap-y-2 text-sm grid-cols-1 lg:grid-cols-1 mt-6">
                        <div class="lg:col-span-2">
                            <div class="grid gap-4 gap-y-2 text-sm grid-cols-1 md:grid-cols-8">
                                <div class="md:col-span-2">
                                    <label for="date_from" class="text-black font-medium">From</label>
                                    <input type="date" name="date_from" id="date_from"
                                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-2 p-2.5"
                                        value="" placeholder="" required/>
                                </div>
                                <div class="md:col-span-2">
                                    <label for="date_to" class="text-black font-medium">To</label>
                                    <input type="date" name="date_to" id="date_to"
                                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-2 p-2.5"
                                        value="" placeholder="" required/>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="flex items-center mt-4">
                        <input id="checkbox" type="checkbox" value=""
                            class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                        <label for="checkbox" class="ms-2 text-sm font-medium text-gray-900 dark:text-gray-300">For
                            statement of account</label>
                    </div>
                </div>
                <div class="grid grid-flow-col sm:auto-cols-max justify-start sm:justify-end gap-2">
                    <button id="hide-modal" type="button"
                        class="mt-3 inline-flex w-full justify-center rounded-md bg-white px-3 py-2 text-sm font-semibold text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 hover:bg-gray-50 sm:mt-0 sm:w-auto">Cancel</button>
                    <button type="submit"
                        class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Submit
                    </button>
                    {{-- <a href="#" onclick="submitForm()" class="btn bg-indigo-500 hover:bg-indigo-600 text-white">
                        <svg class="w-4 h-4 fill-current opacity-50 shrink-0" viewBox="0 0 16 16">
                            <path
                                d="M15 7H9V1c0-.6-.4-1-1-1S7 .4 7 1v6H1c-.6 0-1 .4-1 1s.4 1 1 1h6v6c0 .6.4 1 1 1s1-.4 1-1V9h6c.6 0 1-.4 1-1s-.4-1-1-1z" />
                        </svg>
                        <span class="xs:block ml-2">Process Data</span>
                    </a> --}}
                </div>
            </div>



    </div>
    </form>
    </div>
</x-app-layout>

<script>
    document.getElementById('checkbox').addEventListener('change', function() {
        var form = document.getElementById('loan-form');
        var cid = document.getElementById('selectedCustomer').value;
        if (this.checked) {
            // Dynamically set the action with the cid value
            form.action = "{{ url('monthly/print/statement') }}/" + cid;
        } else {
            form.action = "{{ route('printLoan.index') }}";
        }
    });


    function submitForm() {
        document.getElementById('loan-form').submit();
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
