<x-app-layout>
    <div class="px-4 sm:px-6 lg:px-8 py-8 w-full max-w-9xl mx-auto">

        <!-- Welcome banner -->
        <x-dashboard.welcome-banner />

        <!-- Dashboard actions -->
        <div class="sm:flex sm:justify-between sm:items-center">
            <div>

            </div>

            <!-- Right: Actions -->
            <div class="grid grid-flow-col sm:auto-cols-max justify-start sm:justify-end gap-2">

                <!-- Filter button -->
                <!-- <x-dropdown-filter align="right" /> -->

                <!-- Datepicker built with flatpickr -->
                <!-- <x-datepicker /> -->

                <!-- Add view button -->
                <!-- <button class="btn bg-indigo-500 hover:bg-indigo-600 text-white">
                    <svg class="w-4 h-4 fill-current opacity-50 shrink-0" viewBox="0 0 16 16">
                        <path d="M15 7H9V1c0-.6-.4-1-1-1S7 .4 7 1v6H1c-.6 0-1 .4-1 1s.4 1 1 1h6v6c0 .6.4 1 1 1s1-.4 1-1V9h6c.6 0 1-.4 1-1s-.4-1-1-1z" />
                    </svg>
                    <span class="hidden xs:block ml-2">Add View</span>
                </button> -->

            </div>
        </div>

        <div class="px-4 w-full max-w-9xl mx-auto">
            <div class="relative">
                <h1 class="text-2xl md:text-2xl text-slate-800 dark:text-slate-100 font-bold mb-4">Dashboard Overview
                </h1>
            </div>
            <div class="grid grid-cols-3 gap-4 xl:grid-cols-3 2xl:gap-7.5">
                <div class="rounded-md border border-stroke bg-white p-4 shadow-default dark:border-strokedark dark:bg-boxdark md:p-6 xl:p-7.5">
                    <div class="px-5 py-5">
                        <div class="flex items-center">
                        <svg width="60" height="60" viewBox="0 0 60 60" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <circle cx="30" cy="30" r="30" fill="#57E559"/>
                            <path d="M18.3333 45C17.4167 45 16.6319 44.6736 15.9792 44.0208C15.3264 43.3681 15 42.5833 15 41.6667V18.3333C15 17.4167 15.3264 16.6319 15.9792 15.9792C16.6319 15.3264 17.4167 15 18.3333 15H41.6667C42.5833 15 43.3681 15.3264 44.0208 15.9792C44.6736 16.6319 45 17.4167 45 18.3333V22.5H41.6667V18.3333H18.3333V41.6667H41.6667V37.5H45V41.6667C45 42.5833 44.6736 43.3681 44.0208 44.0208C43.3681 44.6736 42.5833 45 41.6667 45H18.3333ZM31.6667 38.3333C30.75 38.3333 29.9653 38.0069 29.3125 37.3542C28.6597 36.7014 28.3333 35.9167 28.3333 35V25C28.3333 24.0833 28.6597 23.2986 29.3125 22.6458C29.9653 21.9931 30.75 21.6667 31.6667 21.6667H43.3333C44.25 21.6667 45.0347 21.9931 45.6875 22.6458C46.3403 23.2986 46.6667 24.0833 46.6667 25V35C46.6667 35.9167 46.3403 36.7014 45.6875 37.3542C45.0347 38.0069 44.25 38.3333 43.3333 38.3333H31.6667ZM43.3333 35V25H31.6667V35H43.3333ZM36.6667 32.5C37.3611 32.5 37.9514 32.2569 38.4375 31.7708C38.9236 31.2847 39.1667 30.6944 39.1667 30C39.1667 29.3056 38.9236 28.7153 38.4375 28.2292C37.9514 27.7431 37.3611 27.5 36.6667 27.5C35.9722 27.5 35.3819 27.7431 34.8958 28.2292C34.4097 28.7153 34.1667 29.3056 34.1667 30C34.1667 30.6944 34.4097 31.2847 34.8958 31.7708C35.3819 32.2569 35.9722 32.5 36.6667 32.5Z" fill="white"/>
                        </svg>
                            <div class="ml-4">
                                <div class="self-center">
                                    <p class="text-gray-400 text-sm">Cash Beginning</p>
                                    <span class="text-3xl font-semibold text-gray-800">₱{{ number_format($cashBeginning,2) }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="rounded-md border border-stroke bg-white p-4 shadow-default dark:border-strokedark dark:bg-boxdark md:p-6 xl:p-7.5">
                    <div class="px-5 py-5">
                        <div class="flex items-center">
                        <svg width="60" height="60" viewBox="0 0 60 60" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <circle cx="30" cy="30" r="30" fill="#45E3FF"/>
                            <path d="M18.3333 45C17.4167 45 16.6319 44.6736 15.9792 44.0208C15.3264 43.3681 15 42.5833 15 41.6667V18.3333C15 17.4167 15.3264 16.6319 15.9792 15.9792C16.6319 15.3264 17.4167 15 18.3333 15H41.6667C42.5833 15 43.3681 15.3264 44.0208 15.9792C44.6736 16.6319 45 17.4167 45 18.3333V22.5H41.6667V18.3333H18.3333V41.6667H41.6667V37.5H45V41.6667C45 42.5833 44.6736 43.3681 44.0208 44.0208C43.3681 44.6736 42.5833 45 41.6667 45H18.3333ZM31.6667 38.3333C30.75 38.3333 29.9653 38.0069 29.3125 37.3542C28.6597 36.7014 28.3333 35.9167 28.3333 35V25C28.3333 24.0833 28.6597 23.2986 29.3125 22.6458C29.9653 21.9931 30.75 21.6667 31.6667 21.6667H43.3333C44.25 21.6667 45.0347 21.9931 45.6875 22.6458C46.3403 23.2986 46.6667 24.0833 46.6667 25V35C46.6667 35.9167 46.3403 36.7014 45.6875 37.3542C45.0347 38.0069 44.25 38.3333 43.3333 38.3333H31.6667ZM43.3333 35V25H31.6667V35H43.3333ZM36.6667 32.5C37.3611 32.5 37.9514 32.2569 38.4375 31.7708C38.9236 31.2847 39.1667 30.6944 39.1667 30C39.1667 29.3056 38.9236 28.7153 38.4375 28.2292C37.9514 27.7431 37.3611 27.5 36.6667 27.5C35.9722 27.5 35.3819 27.7431 34.8958 28.2292C34.4097 28.7153 34.1667 29.3056 34.1667 30C34.1667 30.6944 34.4097 31.2847 34.8958 31.7708C35.3819 32.2569 35.9722 32.5 36.6667 32.5Z" fill="white"/>
                        </svg>
                            <div class="ml-4">
                                <div class="self-center">
                                    <p class="text-gray-400 text-sm">Cash End</p>
                                    <span class="text-3xl font-semibold text-gray-800">₱0.00</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="rounded-md border border-stroke bg-white p-4 shadow-default dark:border-strokedark dark:bg-boxdark md:p-6 xl:p-7.5">
                    <div class="px-5 py-5">
                        <div class="flex items-center">
                            <svg width="60" height="60" viewBox="0 0 60 60" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <circle cx="30" cy="30" r="30" fill="#000D3A"/>
                                <path d="M10 40V37.6529C10 36.5404 10.5879 35.635 11.7638 34.9367C12.9399 34.2381 14.485 33.8887 16.3992 33.8887C16.745 33.8887 17.0774 33.8957 17.3962 33.9096C17.7154 33.9235 18.0278 33.955 18.3333 34.0042C18.0556 34.52 17.8472 35.0493 17.7083 35.5921C17.5694 36.1351 17.5 36.7017 17.5 37.2917V40H10ZM20 40V37.2917C20 36.4028 20.2431 35.5903 20.7292 34.8542C21.2153 34.1181 21.9028 33.4722 22.7917 32.9167C23.6806 32.3611 24.7431 31.9444 25.9792 31.6667C27.2153 31.3889 28.5556 31.25 30 31.25C31.4722 31.25 32.8264 31.3889 34.0625 31.6667C35.2986 31.9444 36.3611 32.3611 37.25 32.9167C38.1389 33.4722 38.8194 34.1181 39.2917 34.8542C39.7639 35.5903 40 36.4028 40 37.2917V40H20ZM42.5 40V37.2917C42.5 36.6831 42.4375 36.1096 42.3125 35.5713C42.1875 35.0329 41.9907 34.5113 41.7221 34.0063C42.0276 33.9557 42.3371 33.9235 42.6504 33.9096C42.964 33.8957 43.2843 33.8887 43.6113 33.8887C45.5279 33.8887 47.0718 34.2315 48.2429 34.9171C49.4143 35.6026 50 36.5146 50 37.6529V40H42.5ZM22.8471 37.2221H37.1667V37.0554C37.0742 36.1851 36.3496 35.4629 34.9929 34.8887C33.6365 34.3149 31.9722 34.0279 30 34.0279C28.0278 34.0279 26.3635 34.3149 25.0071 34.8887C23.6504 35.4629 22.9304 36.1944 22.8471 37.0833V37.2221ZM16.3767 32.5C15.5422 32.5 14.8264 32.2008 14.2292 31.6025C13.6319 31.0042 13.3333 30.2849 13.3333 29.4446C13.3333 28.5926 13.6325 27.8704 14.2308 27.2779C14.8292 26.6851 15.5485 26.3888 16.3888 26.3888C17.2407 26.3888 17.9629 26.6851 18.5554 27.2779C19.1482 27.8704 19.4446 28.5967 19.4446 29.4567C19.4446 30.2911 19.1482 31.0069 18.5554 31.6042C17.9629 32.2014 17.2367 32.5 16.3767 32.5ZM43.5992 32.5C42.7644 32.5 42.0485 32.2008 41.4513 31.6025C40.854 31.0042 40.5554 30.2849 40.5554 29.4446C40.5554 28.5926 40.8547 27.8704 41.4533 27.2779C42.0517 26.6851 42.771 26.3888 43.6113 26.3888C44.4629 26.3888 45.1851 26.6851 45.7779 27.2779C46.3704 27.8704 46.6667 28.5967 46.6667 29.4567C46.6667 30.2911 46.3704 31.0069 45.7779 31.6042C45.1851 32.2014 44.4589 32.5 43.5992 32.5ZM30 30C28.6111 30 27.4306 29.5139 26.4583 28.5417C25.4861 27.5694 25 26.3889 25 25C25 23.5833 25.4861 22.3958 26.4583 21.4375C27.4306 20.4792 28.6111 20 30 20C31.4167 20 32.6042 20.4792 33.5625 21.4375C34.5208 22.3958 35 23.5833 35 25C35 26.3889 34.5208 27.5694 33.5625 28.5417C32.6042 29.5139 31.4167 30 30 30ZM30.0096 27.2221C30.6421 27.2221 31.169 27.0082 31.5904 26.5804C32.0115 26.1526 32.2221 25.6226 32.2221 24.9904C32.2221 24.3579 32.0101 23.831 31.5863 23.4096C31.1621 22.9885 30.6365 22.7779 30.0096 22.7779C29.3829 22.7779 28.8543 22.9899 28.4238 23.4137C27.9932 23.8379 27.7779 24.3635 27.7779 24.9904C27.7779 25.6171 27.9918 26.1457 28.4196 26.5763C28.8474 27.0068 29.3774 27.2221 30.0096 27.2221Z" fill="white"/>
                            </svg>

                            <div class="ml-4">
                                <div class="self-center">
                                    <p class="text-gray-400 text-sm">Total Customer</p>
                                    <span class="text-3xl font-semibold text-gray-800">{{ number_format($totalCustomer) }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>

        <div class="px-4 w-full max-w-9xl mx-auto mt-4">
            <div class="grid grid-cols-3 gap-4 xl:grid-cols-3 2xl:gap-7.5">
                
            <div class="col-span-1 rounded-md border border-stroke bg-white shadow-default dark:border-strokedark divide-y">
                <div class="flex flex-col items-center justify-center p-6">
                    <h2 class="text-xl text-slate-800 dark:text-slate-100 font-bold mt-4 mb-6">Latest Payer vs Late Payee</h2>
                    <canvas id="pieChart" class="w-64 h-64"></canvas>
                    
                    <!-- Legend with Numbers -->
                    <div class="mt-6 flex space-x-6">
                        <div class="flex items-center space-x-2">
                            <span class="w-4 h-4 bg-green-400 rounded-full"></span>
                            <p class="text-slate-800 dark:text-slate-100 font-medium">
                                Latest Payer: <span id="latestPayerCount">0</span>
                            </p>
                        </div>
                        <div class="flex items-center space-x-2">
                            <span class="w-4 h-4 bg-late-100 rounded-full"></span>
                            <p class="text-slate-800 dark:text-slate-100 font-medium">
                                Late Payee: <span id="latePayeeCount">0</span>
                            </p>
                        </div>
                    </div>
                </div>
            </div>

                <div class="col-span-2 rounded-md border border-stroke bg-white shadow-default dark:border-strokedark divide-y">
                    <div class="bg-white rounded-lg border border-slate-200 shadow-[0px_8px_20px_rgba(0,0,0,0.08)] mb-8 flex items-center justify-center ">
                        <header class="px-5 py-4 border-b border-slate-100 dark:border-slate-700">
                            <h2 class="text-xl text-slate-800 dark:text-slate-100 font-bold">Recent Collection</h2>
                        </header>
                    </div>
                    <div class="p-3 max-h-96 overflow-y-auto">
                        @foreach ($collections as $collection)
                        <div>
                            <header
                                class="text-xs uppercase text-slate-400 dark:text-slate-500 bg-slate-50 dark:bg-slate-700 dark:bg-opacity-50 rounded-sm font-semibold p-2">
                                {{$collection->updated_at->toDateString() }}
                            </header>
                            <ul class="my-1">
                                <!-- Item -->
                                <li class="flex px-2">
                                    <div class="w-9 h-9 rounded-full shrink-0 my-2 mr-3">
                                        <svg class="h-8 w-8 text-blue-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                        </svg>
                                    </div>
                                    <div class="grow flex items-center border-b border-slate-100 dark:border-slate-700 text-sm py-2">
                                        <div class="grow flex justify-between">
                                            <div class="flex w-full">
                                                <div
                                                    class="w-1/2 font-medium text-slate-800 hover:text-slate-900 dark:text-slate-100 dark:hover:text-white">
                                                    <p class="font-bold">{{$collection->name}}</p>
                                                    <span class="text-gray-400 text-xs">{{$collection->user->name}}</span>
                                                </div>
                                                <div
                                                    class="w-1/4 text-slate-800 hover:text-slate-900 dark:text-slate-100 dark:hover:text-white">
                                                    <p class="font-bold">Paid Amount: {{$collection->paid_amount}}</p>
                                                    <span class="text-gray-400 text-xs">Transaction No. {{$collection->trans_no}}</span>
                                                </div>
                                                <div
                                                    class="w-1/4 text-slate-800 hover:text-slate-900 dark:text-slate-100 dark:hover:text-white">
                                                    <p class="font-bold">{{$collection->date}}</p>
                                                    <span class="text-gray-400 text-xs">Status: {{$collection->status}}</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                            </ul>
                        </div>
                        @endforeach
                    </div>

                </div>
             </div>
        </div>
        <div class="px-4 w-full max-w-9xl mx-auto mt-12">
        <div class="relative">
            <h1 class="text-2xl md:text-2xl text-fonts-200 dark:text-slate-100 font-bold mb-4">Recent Applied Customers
            </h1>
        </div>

        <div></div>

        <!-- Dashboard actions -->
        

            <!-- Cards -->
            <section class="container">
                <div class="p-6 w-full max-w-[1500px] mx-auto bg-white rounded-lg border border-bgbody-200">
                    <div class="sm:flex sm:justify-between sm:items-center mb-4">
                        <div>
                        <form method="GET" action="{{ route('customer.index') }}" class="flex items-center mx-auto">
                            <label for="search" class="sr-only">Search</label>
                            <div class="relative w-[280px]"> <!-- Set width to 280px -->
                                <input type="text" id="search" name="search"
                                    class="bg-bgbody-100 border border-bgbody-200 text-fonts-100 text-sm rounded-full focus:ring-blue-500 focus:border-blue-500 block w-full ps-10 pr-16 p-4 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                    placeholder="Search customer name..." required />
                                <div class="absolute inset-y-0 left-3 flex items-center text-fonts-100">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
                                        <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.099zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z"/>
                                    </svg>
                                </div>
                                <button type="submit" class="absolute inset-y-1 right-1 flex items-center bg-indigo-500 hover:bg-indigo-600 text-white rounded-full px-4 py-2">
                                    <svg xmlns="http://www.w3.org/2000/svg" height="20px" viewBox="0 0 24 24" width="20px" fill="#FFFFFF">
                                        <path d="M0 0h24v24H0z" fill="none" />
                                        <path d="M15.5 14h-.79l-.28-.27C15.41 12.59 16 11.11 16 9.5 16 5.91 13.09 3 9.5 3S3 5.91 3 9.5 5.91 16 9.5 16c1.61 0 3.09-.59 4.23-1.57l.27.28v.79l5 4.99L20.49 19l-4.99-5zm-6 0C7.01 14 5 11.99 5 9.5S7.01 5 9.5 5 14 7.01 14 9.5 11.99 14 9.5 14z" />
                                    </svg>
                                </button>
                            </div>
                        </form>

                        </div>
                        <!-- Right: Actions -->
                        <div class="grid grid-flow-col sm:auto-cols-max justify-start sm:justify-end gap-2">
                        <div class="relative inline-flex" x-data="{ open: false }">
                            <!-- <button
                                class="bg-white border border-gray-300 gap-2 text-gray-700 text-sm rounded-full focus:ring-blue-500 focus:border-blue-500 px-4 py-2 flex items-center hover:bg-indigo-500 hover:text-white dark:bg-gray-700 dark:border-gray-600 dark:text-white dark:hover:bg-gray-600"
                                aria-haspopup="true" @click.prevent="open = !open" :aria-expanded="open.toString()">
                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-filter">
                                    <polygon points="22 3 2 3 10 12.46 10 19 14 21 14 12.46 22 3"/>
                                </svg>
                                <span>Select Branch</span>
                            </button> -->

                            <!-- Filter Form -->
                            <form method="GET" action="{{ route('customer.index') }}">
                                <div class="origin-top-right z-10 absolute top-full left-0 right-auto min-w-56 bg-white dark:bg-slate-800 border border-slate-200 dark:border-slate-700 pt-1.5 rounded shadow-lg overflow-hidden mt-1"
                                    @click.outside="open = false" @keydown.escape.window="open = false" x-show="open"
                                    x-transition:enter="transition ease-out duration-200 transform"
                                    x-transition:enter-start="opacity-0 -translate-y-2"
                                    x-transition:enter-end="opacity-100 translate-y-0"
                                    x-transition:leave="transition ease-out duration-200"
                                    x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0" x-cloak>
                                    
                                    <div class="text-xs font-semibold text-slate-400 dark:text-slate-500 uppercase pt-1.5 pb-2 px-3">
                                        Filters
                                    </div>

                                    <div class="py-2 px-3 border-t border-slate-200 dark:border-slate-700 bg-slate-50 dark:bg-slate-700/20">
                                        <ul class="flex items-center justify-between">
                                            <li>
                                                <button type="button" id="clear-filters" class="btn-xs bg-white dark:bg-slate-800 border-slate-200 dark:border-slate-700 hover:border-slate-300 dark:hover:border-slate-600 text-slate-500 dark:text-slate-300 hover:text-slate-600 dark:hover:text-slate-200"
                                                    onclick="clearFilters()">
                                                    Clear
                                                </button>
                                            </li>
                                            <li>
                                                <button type="submit" class="btn-xs bg-blue-400 hover:bg-blue-700 text-white"
                                                    @click="open = false" @focusout="open = false">
                                                    Apply
                                                </button>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </form>
                        </div>
                        
                        <a href="{{ route('customer.add') }}" class="btn bg-indigo-500 hover:bg-indigo-600 text-white rounded-full px-4 py-3 flex items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-circle-plus"><circle cx="12" cy="12" r="10"/><path d="M8 12h8"/><path d="M12 8v8"/></svg>
                            <span class="hidden xs:block ml-2 text-sm">Add Customer</span>
                        </a>
                        <a id="show-modal" href="#" class="btn bg-indigo-500 hover:bg-indigo-600 text-white rounded-full px-6 py-3 flex items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-circle-plus">
                                <circle cx="12" cy="12" r="10"/>
                                <path d="M8 12h8"/>
                                <path d="M12 8v8"/>
                            </svg>
                            <span class="hidden xs:block ml-2 text-sm">Import</span>
                        </a>

                            <div id="modal" class="relative z-10 hidden" aria-labelledby="modal-title" role="dialog" aria-modal="true">
                                <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" aria-hidden="true"></div>
                                <div class="fixed inset-0 z-10 w-screen overflow-y-auto">
                                    <div class="flex min-h-full items-end justify-center p-4 text-center sm:items-center sm:p-0">
                                        <div
                                            class="relative transform overflow-hidden rounded-lg bg-white text-left shadow-xl transition-all sm:my-8 sm:w-full sm:max-w-lg">
                                            <form action="{{ route('customer.importcsv') }}" method="POST"
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
                                                                id="modal-title">Import Customer</h3>
                                                            <div class="mt-2">
                                                                <div class="fields">
                                                                    <div class="input-group mb-3">
                                                                        <input type="file" class="form-control" id="file" name="file"
                                                                            accept=".csv">
                                                                        <label class="input-group-text" for="file">Upload</label>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="bg-gray-50 px-4 py-3 sm:flex sm:flex-row-reverse sm:px-6">
                                                    <button type="submit"
                                                        class="inline-flex w-full justify-center rounded-md bg-blue-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-red-500 sm:ml-3 sm:w-auto">
                                                        Upload
                                                    </button>
                                                    <button id="hide-modal" type="button"
                                                        class="mt-3 inline-flex w-full justify-center rounded-md bg-white px-3 py-2 text-sm font-semibold text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 hover:bg-gray-50 sm:mt-0 sm:w-auto">
                                                        Cancel
                                                    </button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <table class="w-full border-collapse text-left text-sm rounded-md overflow-hidden border border-black">
                        <thead class="bg-bgbody-100 rounded-2xl">
                            <tr class=" text-fonts-100 font-extrabold">
                                <th class="p-4 text-fonts-100 font-normal">Customer ID</th>
                                <th class="p-4 text-fonts-100 font-normal">Name</th>
                                <th class="p-4 text-fonts-100 font-normal">Address</th>
                                @can('auditor_access')
                                <th class="p-4 text-fonts-100 font-normal">Branch</th>
                                @endcan
                                <th class="p-4 text-fonts-100 font-normal">Customer Type</th>
                            </tr>
                        </thead>
                        <tbody class="text-gray-600 font-semibold text-sm">
                            @foreach ($lists as $list)
                                <tr class="border-b hover:bg-gray-50">
                                    <td class="p-4">{{ $list->id }}</td>
                                    <td class="p-4">{{ $list->first_name }} {{ $list->last_name }}</td>
                                    <td class="p-4">
                                        <div class="text-sm text-gray-500">
                                            {{ $list->house ?? '' }} {{ $list->street }} {{ $list->bry->barangay_name ?? '' }}
                                            {{ $list->cty->city_town ?? '' }}
                                        </div>
                                    </td>
                                    <td class="p-4">{{ $list->customerType->description }}</td> 
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                    <div class="mt-6">
                        {{ $lists->links() }}
                    </div>
                </div>
            </section>
            </div>
        </div>
    </div>
</x-app-layout>

<!-- Required chart.js -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
  document.addEventListener("DOMContentLoaded", function () {
    const ctx = document.getElementById('pieChart').getContext('2d');
    const data = {
      labels: ['Latest Payer', 'Late Payee'],
      datasets: [{
        data: [60, 40], // Replace with your dynamic data
        backgroundColor: ['#34D399', '#0B6ECA'], // Tailwind green and red colors
        hoverBackgroundColor: ['#10B981', '#EF4444']
      }]
    };

    new Chart(ctx, {
      type: 'pie',
      data: data,
      options: {
        responsive: true,
        plugins: {
          legend: {
            position: 'top',
          },
        },
      },
    });
  });
    const latestPayerCount = 30; // Example value
    const latePayeeCount = 20;

    const data = {
    labels: ['Latest Payer', 'Late Payee'],
    datasets: [{
        data: [latestPayerCount, latePayeeCount],
        backgroundColor: ['#000D3A', '#0B6ECA'],
        hoverBackgroundColor: ['#10B981', '#EF4444']
    }]
    };

</script>

<!-- Required chart.js -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
  document.addEventListener("DOMContentLoaded", function () {
    const latestPayerCount = 30; // Replace with dynamic value
    const latePayeeCount = 20;   // Replace with dynamic value

    // Update legend numbers
    document.getElementById('latestPayerCount').textContent = latestPayerCount;
    document.getElementById('latePayeeCount').textContent = latePayeeCount;

    const ctx = document.getElementById('pieChart').getContext('2d');
    new Chart(ctx, {
      type: 'pie',
      data: {
        labels: ['Latest Payer', 'Late Payee'],
        datasets: [{
          data: [latestPayerCount, latePayeeCount],
          backgroundColor: ['#34D399', '#F87171'],
          hoverBackgroundColor: ['#10B981', '#EF4444']
        }]
      },
      options: {
        responsive: true,
        plugins: {
          legend: { position: 'top' },
        },
      },
    });
  });
</script>

