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
        <div class="relative">
            
            <div class="mb-8">
            <h1 class="text-2xl md:text-2xl text-slate-800 dark:text-slate-100 font-bold">Compute Cash on Hand</h1>
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
                        <a href="#" class="text-sm text-gray-500">Compute Cash on Hand</a>
                    </li>
                    <!-- Separator -->
                    <li>
                        <span class="text-gray-500">/</span>
                    </li>
                    <!-- Current Page -->
                    <li>
                        <span class="text-sm text-black font-medium">Create</span>
                    </li>
                </ol>
            </div>
        </div>

        <div class="bg-white rounded shadow-lg p-4 px-4 md:p-8 mb-6">
            <div class="flex items-center text-gray-600 mb-12">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                    xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                </svg>
                <a href="{{ route('compute.index') }}" class="text-base font-semibold">Back</a>
            </div>

            <form action="{{ route('compute.store') }}" method="POST">
                @csrf

                <!-- Section 1 -->
                <div class="mb-4">
                    <div class="grid gap-4 gap-y-2 text-sm grid-cols-1 lg:grid-cols-1">
                        <div class="grid gap-4 text-sm grid-cols-1 md:grid-cols-3">
                            {{-- <div>
                                <label for="ref_no" class="text-black font-medium">Ref. No.</label>
                                <input type="text" name="ref_no" id="ref_no"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                                    placeholder="Enter Ref. No." />
                            </div> --}}
                            <div>
                                <label for="prev_transaction" class="text-black font-medium">Prev Tran Date</label>
                                <input type="date" name="prev_transaction" id="prev_transaction"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" required/>
                            </div>
                            <div>
                                <label for="cash_beginning" class="text-black font-medium">Cash Beginning</label>
                                <input type="number" name="cash_beginning" id="cash_beginning"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                                    placeholder="0.00" required />
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Section 2 -->
                <div class="mb-4">
                    <div class="grid gap-4 gap-y-2 text-sm grid-cols-1 lg:grid-cols-1">
                        <div class="grid gap-4 text-sm grid-cols-1 md:grid-cols-4">
                            <div>
                                <label for="transaction_date" class="text-black font-medium">Today's Tran Date</label>
                                <input type="date" name="transaction_date" id="transaction_date"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" required/>
                            </div>
                            <div>
                                <label for="collection" class="text-black font-medium">Collection</label>
                                <input type="number" name="collection" id="collection"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                                    placeholder="0.00" required/>
                            </div>
                            <div>
                                <label for="add_cash" class="text-black font-medium">Add Cash</label>
                                <input type="number" name="add_cash" id="add_cash"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                                    placeholder="0.00" required/>
                            </div>
                            <div>
                                <label for="add_cash_2" class="text-black font-medium">Add Cash (2nd)</label>
                                <input type="number" name="add_cash_2" id="add_cash_2"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                                    placeholder="0.00" required/>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Section 3 -->
                <div class="mb-4">
                    <div class="grid gap-4 gap-y-2 text-sm grid-cols-1 lg:grid-cols-1">
                        <div class="grid gap-4 text-sm grid-cols-1 md:grid-cols-3">
                            <div>
                                <label for="loan_releases" class="text-black font-medium">Today's Loan Releases</label>
                                <input type="number" name="loan_releases" id="loan_releases"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                                    placeholder="0.00" required/>
                            </div>
                            <div>
                                <label for="expenses" class="text-black font-medium">Today's Expenses</label>
                                <input type="number" name="expenses" id="expenses"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                                    placeholder="0.00" required/>
                            </div>
                            <div>
                                <label for="new_cash_on_hand" class="text-black font-medium">New Cash on Hand</label>
                                <input type="number" name="new_cash_on_hand" id="new_cash_on_hand"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                                    placeholder="0.00" required/>
                            </div>
                        </div>
                    </div>
                </div>

                <x-section-border />

                <!-- Section 4 -->
                <h1 class="text-xl text-slate-600 font-bold mb-4">Other Financial Figures</h1>
                <div class="mb-4">
                    <div class="grid gap-4 text-sm grid-cols-1 md:grid-cols-6">
                        <div>
                            <label for="penalty" class="text-black font-medium">Penalty</label>
                            <input type="number" name="penalty" id="penalty"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                                placeholder="0.00" />
                        </div>
                        <div>
                            <label for="passbook" class="text-black font-medium">Passbook</label>
                            <input type="number" name="passbook" id="passbook"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                                placeholder="0.00" />
                        </div>
                        <div>
                            <label for="withdraw" class="text-black font-medium">Withdraw</label>
                            <input type="number" name="withdraw" id="withdraw"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                                placeholder="0.00" />
                        </div>
                        <div>
                            <label for="xerox" class="text-black font-medium">Xerox</label>
                            <input type="number" name="xerox" id="xerox"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                                placeholder="0.00" />
                        </div>
                    </div>
                </div>

                <x-section-border />

                <h1 class="text-xl text-slate-600 font-bold mb-4">Details of Add Cash from Savings Customers</h1>
                <div class="mb-4">
                    <div class="grid gap-4 text-sm grid-cols-1 md:grid-cols-6">
                        <div>
                            <label for="charge_swipe" class="text-black font-medium">Charge Swipe</label>
                            <input type="number" name="charge_swipe" id="charge_swipe"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                                placeholder="0.00" />
                        </div>
                        <div>
                            <label for="savings" class="text-black font-medium">Savings</label>
                            <input type="number" name="savings" id="savings"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                                placeholder="0.00" />
                        </div>
                        <div>
                            <label for="death_aid" class="text-black font-medium">Death Aid</label>
                            <input type="number" name="death_aid" id="death_aid"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                                placeholder="0.00" />
                        </div>
                        <div>
                            <label for="photocopy" class="text-black font-medium">Photocopy</label>
                            <input type="number" name="photocopy" id="photocopy"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                                placeholder="0.00" />
                        </div>
                        <div>
                            <label for="details_withdraw" class="text-black font-medium">Withdraw</label>
                            <input type="number" name="details_withdraw" id="details_withdraw"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                                placeholder="0.00" />
                        </div>
                        <div>
                            <label for="details_xerox" class="text-black font-medium">Xerox</label>
                            <input type="number" name="details_xerox" id="details_xerox"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                                placeholder="0.00" />
                        </div>
                    </div>
                </div>

                <div class="mb-8 mt-8 flex flex-row-reverse">
                    <div class="grid gap-4 gap-y-2 text-sm grid-cols-1 lg:grid-cols-1">
                        <div class="lg:col-span-2">
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
            </form>
        </div>
    </div>
</x-app-layout>
