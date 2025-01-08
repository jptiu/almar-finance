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
        <!-- <div class="relative">
            <h1 class="text-2xl md:text-2xl text-slate-800 dark:text-slate-100 font-bold mb-12">Breakdown of Cash Bills</h1>
        </div> -->

        <!-- Dashboard actions -->
        <div class="sm:flex sm:justify-between sm:items-center mb-8">
            <div>
            <h1 class="text-2xl md:text-2xl text-slate-800 dark:text-slate-100 font-bold">Breakdown of Cash Bills</h1>
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
                        <a href="#" class="text-sm text-gray-500">Breakdown of Cash Bills</a>
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

            <!-- Right: Actions -->
            <div class="grid grid-flow-col sm:auto-cols-max justify-start sm:justify-end gap-2">

                <!-- Filter button -->
                <!-- <x-dropdown-filter align="right" /> -->

                <!-- Add view button -->
                <a id="show-modal-new" href="#" class="btn bg-indigo-500 hover:bg-indigo-600 text-white">
                    <svg class="w-4 h-4 fill-current opacity-50 shrink-0" viewBox="0 0 16 16">
                        <path
                            d="M15 7H9V1c0-.6-.4-1-1-1S7 .4 7 1v6H1c-.6 0-1 .4-1 1s.4 1 1 1h6v6c0 .6.4 1 1 1s1-.4 1-1V9h6c.6 0 1-.4 1-1s-.4-1-1-1z" />
                    </svg>
                    <span class="hidden xs:block ml-2">New</span>
                </a>
                <a id="show-modal-import" href="#" class="btn bg-indigo-500 hover:bg-indigo-600 text-white">
                    <svg class="h-6 w-6 text-gray-300" width="24" height="24" viewBox="0 0 24 24"
                        stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round"
                        stroke-linejoin="round">
                        <path stroke="none" d="M0 0h24v24H0z" />
                        <path d="M14 3v4a1 1 0 0 0 1 1h4" />
                        <path d="M17 21h-10a2 2 0 0 1 -2 -2v-14a2 2 0 0 1 2 -2h7l5 5v11a2 2 0 0 1 -2 2z" />
                        <line x1="12" y1="11" x2="12" y2="17" />
                        <polyline points="9 14 12 17 15 14" />
                    </svg>
                    <span class="hidden xs:block ml-2">Import Cash Bills</span>
                </a>
                <a id="show-modal-import-breakdown" href="#"
                    class="btn bg-indigo-500 hover:bg-indigo-600 text-white">
                    <svg class="h-6 w-6 text-gray-300" width="24" height="24" viewBox="0 0 24 24"
                        stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round"
                        stroke-linejoin="round">
                        <path stroke="none" d="M0 0h24v24H0z" />
                        <path d="M14 3v4a1 1 0 0 0 1 1h4" />
                        <path d="M17 21h-10a2 2 0 0 1 -2 -2v-14a2 2 0 0 1 2 -2h7l5 5v11a2 2 0 0 1 -2 2z" />
                        <line x1="12" y1="11" x2="12" y2="17" />
                        <polyline points="9 14 12 17 15 14" />
                    </svg>
                    <span class="hidden xs:block ml-2">Import Breakdowns</span>
                </a>
                <div id="modal-import-breakdown" class="relative z-10 hidden" aria-labelledby="modal-title"
                    role="dialog" aria-modal="true">
                    <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" aria-hidden="true"></div>

                    <div class="fixed inset-0 z-10 w-screen overflow-y-auto">
                        <div class="flex min-h-full items-end justify-center p-4 text-center sm:items-center sm:p-0">
                            <div
                                class="relative transform overflow-hidden rounded-lg bg-white text-left shadow-xl transition-all sm:my-8 sm:w-full sm:max-w-lg">
                                <form action="{{ route('breakdown.importcsv2') }}" method="POST"
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
                                                    id="modal-title">Import Breakdowns</h3>
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
                                        <button id="hide-modal-import-breakdown" type="button"
                                            class="mt-3 inline-flex w-full justify-center rounded-md bg-white px-3 py-2 text-sm font-semibold text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 hover:bg-gray-50 sm:mt-0 sm:w-auto">Cancel</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <div id="modal-import" class="relative z-10 hidden" aria-labelledby="modal-title" role="dialog"
                    aria-modal="true">
                    <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" aria-hidden="true"></div>

                    <div class="fixed inset-0 z-10 w-screen overflow-y-auto">
                        <div class="flex min-h-full items-end justify-center p-4 text-center sm:items-center sm:p-0">
                            <div
                                class="relative transform overflow-hidden rounded-lg bg-white text-left shadow-xl transition-all sm:my-8 sm:w-full sm:max-w-lg">
                                <form action="{{ route('breakdown.importcsv') }}" method="POST"
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
                                                    <line x1="12" y1="12" x2="12"
                                                        y2="21" />
                                                    <path d="M20.39 18.39A5 5 0 0 0 18 9h-1.26A8 8 0 1 0 3 16.3" />
                                                    <polyline points="16 16 12 12 8 16" />
                                                </svg>
                                            </div>
                                            <div class="mt-3 text-center sm:ml-4 sm:mt-0 sm:text-left">
                                                <h3 class="text-base font-semibold leading-6 text-gray-900"
                                                    id="modal-title">Import Cash Bills</h3>
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
                                        <button id="hide-modal-import" type="button"
                                            class="mt-3 inline-flex w-full justify-center rounded-md bg-white px-3 py-2 text-sm font-semibold text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 hover:bg-gray-50 sm:mt-0 sm:w-auto">Cancel</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <div id="modal-import-new" class="relative z-10 hidden" aria-labelledby="modal-title" role="dialog"
                    aria-modal="true">
                    <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" aria-hidden="true"></div>

                    <div class="fixed inset-0 z-10 w-screen overflow-y-auto">
                        <div class="flex min-h-full items-end justify-center p-4 text-center sm:items-center sm:p-0">
                            <div
                                class="relative transform overflow-hidden rounded-lg bg-white text-left shadow-xl transition-all sm:my-8 sm:w-full sm:max-w-lg">
                                <form action="{{ route('breakdown.store') }}" method="POST"
                                    enctype="multipart/form-data">
                                    @csrf
                                    <section class="container mx-auto">
                                        <div class="flex flex-col">
                                            <div class="-mx-4 -my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                                                <div class="inline-block min-w-full py-2 align-middle md:px-6 lg:px-8">
                                                    <div
                                                        class="overflow-hidden border border-gray-200 dark:border-gray-700 md:rounded-lg">
                                                        <table
                                                            class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                                                            <thead class="bg-primary-100">
                                                                <tr>
                                                                    <th scope="col" id="modal-title"
                                                                        class="px-4 py-3.5 text-base text-center rtl:text-right text-white dark:text-white">
                                                                        Input Denomination
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
                                                            <label for="date"
                                                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Date</label>
                                                            <input type="date" name="date" id="date"
                                                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-2 p-2.5"
                                                                value="" />
                                                        </div>
                                                        <div>
                                                            <label for="denomination"
                                                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Denomination</label>
                                                            <select id="denomination" name="denomination"
                                                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                                                @foreach ($denoms as $denom)
                                                                    <option value="{{ $denom->denom_amt }}">
                                                                        {{ $denom->denom_amt }}
                                                                    </option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                        <div>
                                                            <label for="type"
                                                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Type</label>
                                                            <select id="type" name="type"
                                                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                                                <option selected>Select Type</option>
                                                                <option value="US">Coin</option>
                                                                <option value="CA">Pbil</option>
                                                            </select>
                                                        </div>
                                                        <div>
                                                            <label for="qty"
                                                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Qty</label>
                                                            <input type="text" id="qty" name="qty"
                                                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                                                placeholder="0" required />
                                                        </div>
                                                        <div>
                                                            <label for="amount"
                                                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Amount</label>
                                                            <input type="text" id="amount" name="amount"
                                                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                                                placeholder="0.00" required />
                                                        </div>

                                                    </div>
                                                </div>
                                            </div>
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
            </div>

        </div>

        <div class="bg-white rounded shadow-lg p-4 px-4 md:p-8 mb-6">
        <div class="flex items-center text-gray-600 mb-12">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                </svg>
            <a href="{{ route('breakdown.index') }}" class="text-base font-semibold">Back</a>
            </div>
            <div class="grid grid-cols-4 gap-8">
                <div class="...">
                    <form action="{{ route('customer.store') }}" method="POST">
                        @csrf
                        <div class="mb-4">
                            <div class="grid gap-4 gap-y-2 text-sm grid-cols-1 lg:grid-cols-1">
                                <div class="lg:col-span-2">
                                    <div class="grid gap-4 gap-y-2 text-sm grid-cols-1 md:grid-cols-1">

                                        <div class="md:col-span-1">
                                            <label class="text-black font-medium" for="ref">Ref No.</label>
                                            <input type="text" name="ref" id="ref"
                                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-2 p-2.5"
                                                value="" placeholder="" />
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="mb-4">
                            <div class="grid gap-4 gap-y-2 text-sm grid-cols-1 lg:grid-cols-1">
                                <div class="lg:col-span-2">
                                    <div class="grid gap-4 gap-y-2 text-sm grid-cols-1 md:grid-cols-1">

                                        <div class="md:col-span-1">
                                            <label class="text-black font-medium" for="house">Date</label>
                                            <input type="date" name="house" id="house"
                                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-2 p-2.5"
                                                value="" placeholder="" />
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="mb-4">
                            <div class="grid gap-4 gap-y-2 text-sm grid-cols-1 lg:grid-cols-1">
                                <div class="lg:col-span-2">
                                    <div class="grid gap-4 gap-y-2 text-sm grid-cols-1 md:grid-cols-1">

                                        <div class="md:col-span-1">
                                            <label class="text-black font-medium" for="house">Cashier</label>
                                            <select name="type" id="type"
                                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-2 p-2.5" />
                                            <option value="{{ $user->name }}">{{ $user->name }}</option>
                                            </select>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>

                    </form>
                </div>

                <div class="col-span-3">
                    <section class="container mx-auto">
                        <div class="flex flex-col">
                            <div class="-mx-4 -my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                                <div class="inline-block min-w-full py-2 align-middle md:px-6 lg:px-8">
                                    <div
                                        class="overflow-hidden border border-gray-200 dark:border-gray-700 md:rounded-lg">
                                        <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                                            <thead class="bg-blue-800 dark:bg-gray-800">
                                                <tr>
                                                    <th scope="col"
                                                        class="px-4 py-3.5 text-sm font-normal text-center rtl:text-right text-white dark:text-white">
                                                        Row No.
                                                    </th>

                                                    <th scope="col"
                                                        class="px-4 py-3.5 text-sm font-normal text-center rtl:text-right text-white dark:text-white">
                                                        Denomination
                                                    </th>

                                                    <th scope="col"
                                                        class="px-4 py-3.5 text-sm font-normal text-center rtl:text-right text-white dark:text-white">
                                                        Type
                                                    </th>

                                                    <th scope="col"
                                                        class="px-4 py-3.5 text-sm font-normal text-center rtl:text-right text-white dark:text-white">
                                                        Qty
                                                    </th>

                                                    <th scope="col"
                                                        class="px-4 py-3.5 text-sm font-normal text-center rtl:text-right text-white dark:text-white">
                                                        Amount
                                                    </th>

                                                </tr>
                                            </thead>
                                            <tbody
                                                class="bg-white divide-y divide-gray-200 dark:divide-gray-500 dark:bg-gray-900">

                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>

                    <div class="text-end mt-12">
                        <div>
                            <h1 class="text-sm font-medium">Total Amount</h1>
                            <span id="total-amount" class="text-2xl font-bold text-red-600">0.00</span>
                        </div>
                        <a id="show-modal" href="#"
                            class="mt-4 btn bg-indigo-500 hover:bg-indigo-600 text-white">
                            <svg class="w-4 h-4 fill-current opacity-50 shrink-0" viewBox="0 0 16 16">
                                <path
                                    d="M15 7H9V1c0-.6-.4-1-1-1S7 .4 7 1v6H1c-.6 0-1 .4-1 1s.4 1 1 1h6v6c0 .6.4 1 1 1s1-.4 1-1V9h6c.6 0 1-.4 1-1s-.4-1-1-1z" />
                            </svg>
                            <span class="hidden xs:block ml-2">Add Denomination</span>
                        </a>
                        <div class="grid grid-flow-col sm:auto-cols-max justify-start sm:justify-end gap-2">


                            <div id="modal" class="relative z-10 hidden" aria-labelledby="modal-title"
                                role="dialog" aria-modal="true">
                                <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity"
                                    aria-hidden="true"></div>

                                <div class="fixed inset-0 z-10 w-screen overflow-y-auto">
                                    <div
                                        class="flex min-h-full items-end justify-center p-4 text-center sm:items-center sm:p-0">
                                        <div
                                            class="relative transform overflow-hidden rounded-lg bg-white text-left shadow-xl transition-all sm:my-8 sm:w-full sm:max-w-lg">
                                            <form action="{{ route('breakdown.storeBill') }}" method="POST"
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
                                                                        <thead class="bg-primary-100">
                                                                            <tr>
                                                                                <th scope="col" id="modal-title"
                                                                                    class="px-4 py-3.5 text-base text-center rtl:text-right text-white dark:text-white">
                                                                                    Input Denomination
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
                                                                        <input type="hidden" name="breakdown_id"
                                                                            id="breakdown_id"
                                                                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-2 p-2.5"
                                                                            value=""/>
                                                                        <label for="denomination"
                                                                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Denomination</label>
                                                                        <select id="denomination" name="denomination"
                                                                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                                                            @foreach ($denoms as $denom)
                                                                                <option
                                                                                    value="{{ $denom->denom_amt }}">
                                                                                    {{ $denom->denom_amt }}
                                                                                </option>
                                                                            @endforeach
                                                                        </select>
                                                                    </div>
                                                                    <div>
                                                                        <label for="type"
                                                                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Type</label>
                                                                        <select id="type" name="type"
                                                                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                                                            <option selected>Select Type</option>
                                                                            <option value="Coin">Coin</option>
                                                                            <option value="Pbil">Pbil</option>
                                                                        </select>
                                                                    </div>
                                                                    <div>
                                                                        <label for="qty"
                                                                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Qty</label>
                                                                        <input type="text" id="qty" name="qty"
                                                                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                                                            placeholder="0.00" required />
                                                                    </div>
                                                                    <div>
                                                                        <label for="amount"
                                                                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Amount</label>
                                                                        <input type="text" id="amount" name="amount"
                                                                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                                                            placeholder="0.00" required />
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="bg-gray-50 px-4 py-3 sm:flex sm:flex-row-reverse sm:px-6">
                                                    <button type="submit"
                                                        class="inline-flex w-full justify-center rounded-md bg-accent-100 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-accent-200 sm:ml-3 sm:w-auto">Submit</button>
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
                </div>

            </div>
        </div>

    </div>
</x-app-layout>
<script>
    const showModalButton = document.getElementById('show-modal');
    const hideModalButton = document.getElementById('hide-modal');
    const modal = document.getElementById('modal');
    const breakdownID = document.getElementById('ref');
    const breakdownHiddenID = document.getElementById('breakdown_id');

    showModalButton.addEventListener('click', () => {
        breakdownHiddenID.value = breakdownID.value;
        modal.classList.remove('hidden');
    });

    hideModalButton.addEventListener('click', () => {
        modal.classList.add('hidden');
    });

    const showModalButtonImport = document.getElementById('show-modal-import');
    const hideModalButtonImport = document.getElementById('hide-modal-import');
    const modalImport = document.getElementById('modal-import');

    showModalButtonImport.addEventListener('click', () => {
        modalImport.classList.remove('hidden');
    });

    hideModalButtonImport.addEventListener('click', () => {
        modalImport.classList.add('hidden');
    });

    const showModalButtonImportBreakdown = document.getElementById('show-modal-import-breakdown');
    const hideModalButtonImportBreakdown = document.getElementById('hide-modal-import-breakdown');
    const modalImportBreakdown = document.getElementById('modal-import-breakdown');

    showModalButtonImportBreakdown.addEventListener('click', () => {
        modalImportBreakdown.classList.remove('hidden');
    });

    hideModalButtonImportBreakdown.addEventListener('click', () => {
        modalImportBreakdown.classList.add('hidden');
    });

    const showModalButtonImportnew = document.getElementById('show-modal-new');
    const hideModalButtonImportnew = document.getElementById('hide-modal-new');
    const modalImportnew = document.getElementById('modal-import-new');

    showModalButtonImportnew.addEventListener('click', () => {
        modalImportnew.classList.remove('hidden');
    });

    hideModalButtonImportnew.addEventListener('click', () => {
        modalImportnew.classList.add('hidden');
    });
</script>
<script>
    document.getElementById('ref').addEventListener('change', function() {
        var refNo = this.value;
        let totalAmount = 0; // Initialize total amount

        if (refNo) {
            fetch(`/breakdowns/${refNo}`)
                .then(response => response.json())
                .then(data => {
                    var tbody = document.querySelector('tbody');
                    tbody.innerHTML = ''; // Clear previous data

                    let totalAmount = 0; // Reset total amount before calculating

                    data.forEach((row, index) => {
                        tbody.innerHTML += `
                    <tr>
                        <td class="px-4 py-3.5 text-sm text-center">${index + 1}</td>
                        <td class="px-4 py-3.5 text-sm text-center">${row.denomination}</td>
                        <td class="px-4 py-3.5 text-sm text-center">${row.type}</td>
                        <td class="px-4 py-3.5 text-sm text-center">${row.qty}</td>
                        <td class="px-4 py-3.5 text-sm text-center">${row.amount}</td>
                    </tr>
                `;

                        // Remove commas from amount string before parsing
                        const cleanedAmount = row.amount.replace(/,/g, '');

                        // Add new amount to total
                        totalAmount += parseFloat(cleanedAmount);
                    });

                    // Update the total amount display
                    document.getElementById('total-amount').textContent = totalAmount.toLocaleString(
                        'en-US', {
                            minimumFractionDigits: 2,
                            maximumFractionDigits: 2
                        });
                })
                .catch(error => console.error('Error:', error));
        }
    });
    // document.querySelector('form').addEventListener('submit', function(event) {
    //     event.preventDefault(); // Prevent page reload

    //     let formData = new FormData(this);

    //     fetch("{{ route('breakdown.storeBill') }}", {
    //         method: 'POST',
    //         headers: {
    //             'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
    //         },
    //         body: formData
    //     })
    //     .then(response => response.json())
    //     .then(data => {
    //         // Hide the modal
    //         document.getElementById('modal').classList.add('hidden');

    //         // Update the denomination list dynamically
    //         let tbody = document.querySelector('tbody');
    //         tbody.innerHTML += `
    //             <tr>
    //                 <td class="px-4 py-3.5 text-sm text-center">${data.denomination}</td>
    //                 <td class="px-4 py-3.5 text-sm text-center">${data.type}</td>
    //                 <td class="px-4 py-3.5 text-sm text-center">${data.qty}</td>
    //                 <td class="px-4 py-3.5 text-sm text-center">${data.amount}</td>
    //             </tr>
    //         `;

    //         // Reset the form
    //         this.reset();
    //     })
    //     .catch(error => console.error('Error:', error));
    // });
</script>
