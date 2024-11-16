<x-app-layout>
    <div class="px-4 sm:px-6 lg:px-8 py-8 w-full max-w-9xl mx-auto">

        <div class="relative">
            <h1 class="text-2xl md:text-2xl text-slate-800 dark:text-slate-100 font-bold mb-12">Grant Loan Entry</h1>
        </div>

        <!-- Dashboard actions -->
        <div class="sm:flex sm:justify-between sm:items-center mb-8">
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

        <div class="bg-white rounded shadow-lg p-4 px-4 md:p-8 mb-6">
        <div class="flex items-center text-gray-600 mb-12">
            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
            </svg>
            <a href="{{ route('collection.index') }}" class="text-base font-semibold">Back</a>
        </div>
        
            <div class="grid grid-cols-1 gap-4">
                <div class="...">
                    <form action="{{ route('customer.store') }}" method="POST">
                        
                    <div class="flex items-center space-x-4 mb-6">
                        <div class="w-12 h-12 bg-gray-200 rounded-full flex items-center justify-center">
                        <svg width="47" height="47" viewBox="0 0 47 47" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <circle cx="23.5" cy="23.5" r="23.5" fill="#000D3A"/>
                        <path d="M23.5 16.0227C22.5757 16.0227 21.6721 16.2968 20.9036 16.8103C20.1351 17.3238 19.5361 18.0537 19.1824 18.9076C18.8287 19.7616 18.7361 20.7012 18.9165 21.6077C19.0968 22.5143 19.5419 23.347 20.1954 24.0006C20.849 24.6541 21.6817 25.0992 22.5882 25.2795C23.4948 25.4599 24.4344 25.3673 25.2884 25.0136C26.1423 24.6599 26.8722 24.0609 27.3857 23.2924C27.8992 22.5239 28.1733 21.6203 28.1733 20.696C28.1733 19.4566 27.6809 18.2679 26.8045 17.3915C25.9281 16.5151 24.7394 16.0227 23.5 16.0227Z" fill="white"/>
                        <path d="M23.5 10.4148C20.912 10.4148 18.3821 11.1822 16.2303 12.62C14.0784 14.0578 12.4012 16.1015 11.4109 18.4925C10.4205 20.8835 10.1613 23.5145 10.6662 26.0528C11.1711 28.5911 12.4174 30.9226 14.2474 32.7526C16.0774 34.5826 18.4089 35.8289 20.9472 36.3338C23.4855 36.8387 26.1165 36.5796 28.5075 35.5892C30.8985 34.5988 32.9422 32.9216 34.38 30.7698C35.8178 28.6179 36.5853 26.088 36.5853 23.5C36.5813 20.0308 35.2014 16.7048 32.7483 14.2517C30.2952 11.7986 26.9692 10.4187 23.5 10.4148ZM30.9708 31.8428C30.9526 30.6165 30.4531 29.4465 29.5801 28.5852C28.7071 27.7238 27.5304 27.2402 26.304 27.2386H20.6961C19.4698 27.2405 18.2934 27.7242 17.4206 28.5855C16.5477 29.4468 16.0484 30.6166 16.0302 31.8428C14.3353 30.3293 13.14 28.3367 12.6027 26.1289C12.0654 23.921 12.2113 21.602 13.0212 19.479C13.8311 17.3559 15.2668 15.5289 17.1382 14.2399C19.0095 12.9509 21.2282 12.2607 23.5005 12.2607C25.7728 12.2607 27.9915 12.9509 29.8628 14.2399C31.7342 15.5289 33.1698 17.3559 33.9798 19.479C34.7897 21.602 34.9356 23.921 34.3983 26.1289C33.861 28.3367 32.6657 30.3293 30.9708 31.8428Z" fill="white"/>
                        </svg>
                        </div>
                            <div>
                                <h1 class="text-lg font-bold">Luther Harber</h1>
                                <p class="text-sm text-gray-500">ID: 100232124</p>
                            </div>
                        </div>
                        <div class="flex flex-row gap-12 mb-12">
                            <div class="">
                                <p class="text-sm text-gray-500 mr-4">Customer Type:</p>
                                <h1 class="text-sm text-gray-900 font-bold">Type C</h1> 
                            </div>
                            <div class="">
                                <p class="text-sm text-gray-500 mr-4">Status:</p>
                                <h1 class="text-sm text-gray-900 font-bold">Active</h1> 
                            </div>
                        </div> 


                        <!-- Loan Transaction Summary -->
                        <div class="relative">
                            <h2 class="text-2xl md:text-2xl text-slate-800 dark:text-slate-100 font-bold mb-2">Loan Payment Details</h2>
                            <hr class="h-px my-4 mb-4 bg-gray-200 border-0 dark:bg-gray-700">
                        </div>
                        <div class="mb-6">
                            <div class="grid grid-cols-3 gap-8 mt-4 mb-12 text-sm text-gray-500">
                                <div>
                                    <p class="text-gray-900 text-sm">Transaction No.</p>
                                    <p class="font-bold text-gray-900 text-base">Business</p>
                                </div>
                                <div>
                                    <p class="text-gray-900 text-sm">Date of Loan </p>
                                    <p class="font-bold text-gray-900 text-base">Business</p>
                                </div>
                                <div>
                                    <p class="text-gray-900 text-sm">Loan Type</p>
                                    <p class="font-bold text-gray-900 text-base">Business</p>
                                </div>
                                <div>
                                    <p class="text-gray-900 text-sm">Transaction Type</p>
                                    <p class="font-bold text-gray-900 text-base">Business</p>
                                </div>
                            </div>
                        </div>

                        <!-- Terms of Payment -->
                        <div class="relative">
                            <h2 class="text-2xl md:text-2xl text-slate-800 dark:text-slate-100 font-bold mb-2">Terms of Payment</h2>
                            <hr class="h-px my-4 mb-4 bg-gray-200 border-0 dark:bg-gray-700">
                        </div>
                        <div class="mb-6">
                            <div class="grid grid-cols-3 gap-8 mt-4 mb-12 text-sm text-gray-500">
                                <div>
                                    <p class="text-gray-900 text-sm">Principal Amount</p>
                                    <p class="font-bold text-gray-900 text-base">Business</p>
                                </div>
                                <div>
                                    <p class="text-gray-900 text-sm">Interest</p>
                                    <p class="font-bold text-gray-900 text-base">Business</p>
                                </div>
                                <div>
                                    <p class="text-gray-900 text-sm">Interest Amount</p>
                                    <p class="font-bold text-gray-900 text-base"value="" placeholder="₱">Business</p>
                                </div>
                                <div>
                                    <p class="text-gray-900 text-sm">Service Charge</p>
                                    <p class="font-bold text-gray-900 text-base">Business</p>
                                </div>
                                <div>
                                    <p class="text-gray-900 text-sm">Payable Amount</p>
                                    <p class="font-bold text-gray-900 text-base">Business</p>
                                </div>
                                <div>
                                    <p class="text-gray-900 text-sm">Days to Pay</p>
                                    <p class="font-bold text-gray-900 text-base">Business</p>
                                </div>
                                <div>
                                    <p class="text-gray-900 text-sm">Months to Pay</p>
                                    <p class="font-bold text-gray-900 text-base">Business</p>
                                </div>
                                <div>
                                    <p class="text-gray-900 text-sm">Actual Record </p>
                                    <p class="font-bold text-gray-900 text-base">Business</p>
                                </div>
                            </div>
                        </div>

                        <section class="container mx-auto">
                                <div class="flex flex-col">
                                    <div class="-mx-4 -my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                                        <div class="inline-block min-w-full py-2 align-middle md:px-6 lg:px-8">
                                            <div class="overflow-hidden border border-gray-200 dark:border-gray-700 md:rounded-lg">
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
                                                        <tbody class="bg-white divide-y divide-gray-200 dark:divide-gray-500 dark:bg-gray-900">
                                                        
                                                            <tr>
                                                                <td
                                                                    class="px-4 py-4 text-sm font-medium text-gray-500 dark:text-gray-200 whitespace-nowrap">
                                                                    
                                                                </td>
                                                                <td
                                                                    class="px-4 py-4 text-sm text-gray-500 dark:text-gray-300 whitespace-nowrap">
                                                                    
                                                                </td>
                                                                <td
                                                                    class="px-4 py-4 text-sm text-gray-500 dark:text-gray-300 whitespace-nowrap">
                                                                    <div class="flex items-center gap-x-2">
                                                                        <div>
                                                                            <h2 class="text-sm font-medium text-gray-500 dark:text-white ">
                                                                                </h2>
                                                                        </div>
                                                                    </div>
                                                                </td>
                                                            </tr>
                                                        
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
                                                <input type="checkbox" name="house" id="house"
                                                    class="border px-2 py-2 bg-gray-50" value="" placeholder="" />
                                                <label for="house" class="mt-2 ml-1">Allow Grace period</label>
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
                                                <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Input Check Number</button>
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
                        transactionField.value = loanData.id; // No need for template literal here unless formatting is required
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
