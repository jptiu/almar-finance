<x-app-layout>
    <div class="px-4 sm:px-6 lg:px-8 py-8 w-full max-w-9xl mx-auto">
        
        <div class="relative">
            <h1 class="text-2xl md:text-2xl text-slate-800 dark:text-slate-100 font-bold mb-8">Customer Ledger - Daily</h1>
        </div>

        <!-- Dashboard actions -->
        <div class="sm:flex sm:justify-between sm:items-center">
            <div></div>

            <!-- Right: Actions -->
            <div class="grid grid-flow-col sm:auto-cols-max justify-start sm:justify-end gap-2">

                <!-- Filter button -->
                <!-- <x-dropdown-filter align="right" /> -->

            </div>

        </div>

        <form action="#" method="POST">
            @csrf
            <div class="bg-white rounded shadow-lg p-4 px-4 md:p-8 mb-6">

                <div>
                    <div class="grid gap-4 gap-y-2 text-sm grid-cols-1 lg:grid-cols-1">
                        <div class="lg:col-span-2">
                            <div class="grid gap-4 gap-y-2 text-sm grid-cols-1 md:grid-cols-6">
                                <div class="md:col-span-1">
                                    <h3 class="text-sm">Type <span class="ml-2 bg-yellow-100 text-red-700 font-medium me-2 px-2.5 py-0.5 rounded-full dark:bg-blue-900 dark:text-blue-300">Ordinary</span></h3>
                                </div>

                                <div class="md:col-span-1">
                                <h3 class="text-sm">Status <span class="ml-2 bg-red-100 text-red-700 font-medium me-2 px-2.5 py-0.5 rounded-full dark:bg-blue-900 dark:text-blue-300">AC</span></h3>
                                </div>
                            </div>  
                        </div>
                    </div>
                </div>

                <x-section-border />
            
                <div>
                    <div class="grid gap-4 gap-y-2 text-sm grid-cols-1 lg:grid-cols-1">
                        <div class="lg:col-span-2">
                            <div class="grid gap-4 gap-y-2 text-sm grid-cols-1 md:grid-cols-6">
                                <div class="md:col-span-1">
                                    <label class="text-black font-medium" for="house">Customer ID</label>
                                    <input type="text" name="house" id="house" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-2 p-2.5" value=""
                                            placeholder="" />
                                </div>

                                <div class="md:col-span-2">
                                    <label class="text-black font-medium" for="house">Name</label>
                                    <input type="text" name="house" id="house" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-2 p-2.5" value=""
                                            placeholder="" />
                                </div>
                            </div>  
                        </div>
                    </div>
                </div>

                <x-section-border />

                <div>
                    <div class="grid gap-4 gap-y-2 text-sm grid-cols-1 lg:grid-cols-1">
                        <div class="lg:col-span-2">
                            <div class="grid gap-4 gap-y-2 text-sm grid-cols-1 md:grid-cols-6">

                                <div class="md:col-span-2">
                                    <label class="text-black font-medium" for="house">Transaction No.</label>
                                    <input type="text" name="house" id="house" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-2 p-2.5" value=""
                                            placeholder="" />
                                </div>

                                <div class="md:col-span-1">
                                    <label class="text-black font-medium" for="house">Date of Loan</label>
                                    <input type="date" name="house" id="house" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-2 p-2.5" value=""
                                            placeholder="" />
                                </div>

                                <div class="md:col-span-1">
                                    <label class="text-black font-medium" for="house">Principal Amount</label>
                                    <input type="number" name="house" id="house" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-2 p-2.5" value=""
                                            placeholder="" value="" placeholder="₱" />
                                </div>
                            </div>  
                        </div>
                    </div>
                </div>

                <x-section-border />

                <div>
                    <div class="grid gap-4 gap-y-2 text-sm grid-cols-1 lg:grid-cols-3 mb-12">
                        <div>
                            <h1 class="text-xl md:text-xl text-slate-600 dark:text-slate-100 font-bold mb-2">Terms of Payment</h1>
                        </div>

                        <div class="lg:col-span-2">
                        </div>
                    </div>
                </div>

                <div>
                    <div class="grid gap-4 gap-y-2 text-sm grid-cols-1 lg:grid-cols-1">
                        <div class="lg:col-span-2">
                            <div class="grid gap-4 gap-y-2 text-sm grid-cols-1 md:grid-cols-5">

                                <div class="md:col-span-1">
                                    <label class="text-black font-medium" for="house">Days to pay</label>
                                    <select name="type" id="type" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-2 p-2.5" value=""
                                            placeholder=""" />
                                        <option value="business loan">15</option>
                                        <option value="personal loan">30</option>
                                    </select>
                                </div>

                                <div class="md:col-span-1">
                                    <label class="text-black font-medium" for="house">Months to pay</label>
                                    <select name="type" id="type" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-2 p-2.5" value=""
                                            placeholder=""" />
                                        <option value="business loan">3 months</option>
                                        <option value="personal loan">6 months</option>
                                    </select>
                                </div>

                                <div class="md:col-span-1">
                                    <label class="text-black font-medium" for="house">Monthly Interest %</label>
                                    <select name="type" id="type" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-2 p-2.5" value=""
                                            placeholder=""" />
                                        <option value="business loan">5</option>
                                        <option value="personal loan">10</option>
                                    </select>
                                </div>
                                
                                <div class="md:col-span-1">
                                    <label class="text-black font-medium" for="house">Amount with Interest</label>
                                    <input type="number" name="house" id="house" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-2 p-2.5" value=""
                                            placeholder=""" value="" placeholder="₱" />
                                </div>

                                <div class="md:col-span-1">
                                    <label class="text-black font-medium" for="house">Running Balance</label>
                                    <input type="number" name="house" id="house" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-2 p-2.5" value=""
                                            placeholder=""" value="" placeholder="₱" />
                                </div>
                            </div>  
                        </div>
                    </div>
                </div>

                <x-section-border />

                <!-- Cards -->
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

                <x-section-border />

                <div>
                    <div class="grid gap-4 gap-y-2 text-sm grid-cols-1 lg:grid-cols-3">
                        <div class="lg:col-span-2">
                            <div class="grid gap-4 gap-y-2 text-sm grid-cols-1 md:grid-cols-5">                    
                                <div class="md:col-span-5 text-left">
                                    <div class="inline-flex items-end">
                                    <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">For Grace Period</button>
                                    </div>

                                    <div class="inline-flex items-end ml-4">
                                    <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">For Staggered Print</button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="text-gray-600">
                            <p class="font-medium text-lg"></p>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</x-app-layout>
