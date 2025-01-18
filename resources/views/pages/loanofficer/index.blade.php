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
                                    <span class="text-3xl font-semibold text-gray-800">₱2,134,900</span>
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
                                    <span class="text-3xl font-semibold text-gray-800">₱2,134,900</span>
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
                                    <span class="text-3xl font-semibold text-gray-800">34,900</span>
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
                    <div class="flex items-center justify-center ">
                        <div>
                            <h2 class="text-xl text-slate-800 dark:text-slate-100 font-bold mb-8">Latest Payer vs Late Payee</h2>
                            <canvas id="pieChart" class="w-64 h-64"></canvas>
                        </div>
                    </div>
                </div>

                <div class="col-span-2 rounded-md border border-stroke bg-white shadow-default dark:border-strokedark divide-y">
                    <div class="bg-white rounded-lg border border-slate-200 shadow-[0px_8px_20px_rgba(0,0,0,0.08)] mb-4 flex items-center justify-center ">
                        <header class="px-5 py-4 border-b border-slate-100 dark:border-slate-700">
                            <h2 class="text-xl text-slate-800 dark:text-slate-100 font-bold">Recent Collection</h2>
                        </header>
                    </div>
                </div>
             </div>
        </div>

        <!-- Cards -->
        <div class="px-4 py-8 w-full max-w-9xl mx-auto">
            @if (session()->has('success'))
                <div class="alert alert-success">
                    <div class="flex items-center p-4 mb-4 text-sm text-green-800 border border-green-300 rounded-lg bg-green-50 dark:bg-gray-800 dark:text-green-400 dark:border-green-800"
                        role="alert">
                        <svg class="flex-shrink-0 inline w-4 h-4 mr-3" aria-hidden="true"
                            xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
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
                <h1 class="text-2xl md:text-2xl text-slate-800 dark:text-slate-100 font-bold mb-4">Recent Applied
                    Customers
                </h1>
            </div>

            <div></div>

            <!-- Dashboard actions -->
            <div class="sm:flex sm:justify-between sm:items-center mb-4">
                <div>
                    <form method="GET" action="" class="flex items-center max-w-sm mx-auto">
                        <label for="search" class="sr-only">Search</label>
                        <div class="relative w-full">
                            <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
                            </div>
                            <input type="text" id="search" name="search"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-2 p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                placeholder="Search customer name..." required />
                        </div>
                        <button type="submit" class="btn bg-indigo-500 hover:bg-indigo-600 text-white ml-2">
                            <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 0 24 24" width="24px"
                                fill="#FFFFFF">
                                <path d="M0 0h24v24H0z" fill="none" />
                                <path
                                    d="M15.5 14h-.79l-.28-.27C15.41 12.59 16 11.11 16 9.5 16 5.91 13.09 3 9.5 3S3 5.91 3 9.5 5.91 16 9.5 16c1.61 0 3.09-.59 4.23-1.57l.27.28v.79l5 4.99L20.49 19l-4.99-5zm-6 0C7.01 14 5 11.99 5 9.5S7.01 5 9.5 5 14 7.01 14 9.5 11.99 14 9.5 14z" />
                            </svg>
                            <span class="sr-only">Search</span>
                        </button>
                    </form>
                </div>

                <!-- Right: Actions -->
                <div class="grid grid-flow-col sm:auto-cols-max justify-start sm:justify-end gap-2">

                    <!-- Filter button -->
                    <x-dropdown-filter align="right" />

                    <!-- Add view button -->
                    <a href="{{ route('customer.add') }}" class="btn bg-indigo-500 hover:bg-indigo-600 text-white">
                        <svg class="w-4 h-4 fill-current opacity-50 shrink-0" viewBox="0 0 16 16">
                            <path
                                d="M15 7H9V1c0-.6-.4-1-1-1S7 .4 7 1v6H1c-.6 0-1 .4-1 1s.4 1 1 1h6v6c0 .6.4 1 1 1s1-.4 1-1V9h6c.6 0 1-.4 1-1s-.4-1-1-1z" />
                        </svg>
                        <span class="hidden xs:block ml-2">Add Customer</span>
                    </a>
                    <a id="show-modal" href="#" class="btn bg-indigo-500 hover:bg-indigo-600 text-white">
                        <svg class="w-4 h-4 fill-current opacity-50 shrink-0" viewBox="0 0 16 16">
                            <path
                                d="M15 7H9V1c0-.6-.4-1-1-1S7 .4 7 1v6H1c-.6 0-1 .4-1 1s.4 1 1 1h6v6c0 .6.4 1 1 1s1-.4 1-1V9h6c.6 0 1-.4 1-1s-.4-1-1-1z" />
                        </svg>
                        <span class="hidden xs:block ml-2">Import</span>
                    </a>
                    <div id="modal" class="relative z-10 hidden" aria-labelledby="modal-title" role="dialog"
                        aria-modal="true">
                        <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" aria-hidden="true">
                        </div>

                        <div class="fixed inset-0 z-10 w-screen overflow-y-auto">
                            <div
                                class="flex min-h-full items-end justify-center p-4 text-center sm:items-center sm:p-0">
                                <div
                                    class="relative transform overflow-hidden rounded-lg bg-white text-left shadow-xl transition-all sm:my-8 sm:w-full sm:max-w-lg">
                                    <form action="{{ route('customer.importcsv') }}" method="POST"
                                        enctype="multipart/form-data">
                                        @csrf
                                        <div class="bg-white px-4 pb-4 pt-5 sm:p-6 sm:pb-4">
                                            <div class="sm:flex sm:items-start">
                                                <div
                                                    class="mx-auto flex h-12 w-12 flex-shrink-0 items-center justify-center rounded-full bg-blue-100 sm:mx-0 sm:h-10 sm:w-10">
                                                    <svg class="h-6 w-6 text-blue-500" viewBox="0 0 24 24"
                                                        fill="none" stroke="currentColor" stroke-width="2"
                                                        stroke-linecap="round" stroke-linejoin="round">
                                                        <polyline points="16 16 12 12 8 16" />
                                                        <line x1="12" y1="12" x2="12"
                                                            y2="21" />
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
                                                                <input type="file" class="form-control"
                                                                    id="file" name="file" accept=".csv">
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

            <!-- Cards -->
            <section class="container mx-auto">
                <div class="flex flex-col">
                    <div class="-mx-4 -my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                        <div class="inline-block min-w-full py-2 align-middle md:px-6 lg:px-8">
                            <div class="overflow-hidden border border-gray-200 dark:border-gray-700 md:rounded-lg">
                                <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                                    <thead class="bg-gray-50 dark:bg-gray-800">
                                        <tr>
                                            <th scope="col"
                                                class="px-4 py-3.5 text-sm font-normal text-left rtl:text-right text-gray-500 dark:text-gray-400">
                                                Customer ID
                                            </th>

                                            <th scope="col"
                                                class="px-4 py-3.5 text-sm font-normal text-left rtl:text-right text-gray-500 dark:text-gray-400">
                                                Name
                                            </th>

                                            <th scope="col"
                                                class="px-4 py-3.5 text-sm font-normal text-left rtl:text-right text-gray-500 dark:text-gray-400">
                                                Address
                                            </th>

                                            <th scope="col"
                                                class="px-4 py-3.5 text-sm font-normal text-left rtl:text-right text-gray-500 dark:text-gray-400">
                                                Customer Type
                                            </th>

                                        </tr>
                                    </thead>
                                    <tbody
                                        class="bg-white divide-y divide-gray-200 dark:divide-gray-500 dark:bg-gray-900">
                                        @foreach ($lists as $list)
                                            <tr>
                                                <td
                                                    class="px-4 py-4 text-sm font-medium text-gray-500 dark:text-gray-200 whitespace-nowrap">
                                                    {{ $list->id }}
                                                </td>
                                                <td
                                                    class="px-4 py-4 text-sm font-medium text-gray-500 dark:text-gray-200 whitespace-nowrap">
                                                    {{ $list->first_name }} {{ $list->last_name }}
                                                </td>
                                                <td
                                                    class="px-4 py-4 text-sm text-gray-500 dark:text-gray-300 whitespace-nowrap">
                                                    {{ $list->house }} {{ $list->street }} {{$list->bry->barangay_name??''}} {{$list->cty->city_town??''}}
                                                </td>
                                                <td
                                                    class="px-4 py-4 text-sm text-gray-500 dark:text-gray-300 whitespace-nowrap">
                                                    {{ $list->customerType->description }}
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="flex-end items-center justify-between mt-6">
                    {{ $lists->links() }}
                </div>
            </section>


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








{{--
<x-app-layout>
    <div class="px-4 sm:px-6 lg:px-8 py-8 w-full max-w-9xl mx-auto">

        <!-- Welcome banner -->
        <x-dashboard.welcome-banner />

        <!-- Dashboard actions -->
        <div class="sm:flex sm:justify-between sm:items-center mb-8">
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

        <div class="grid grid-cols-3 gap-6 mb-8">
            <div class=" bg-white rounded-lg border border-slate-200 shadow-[0px_4px_12px_rgba(0,0,0,0.05)] p-4">
                <div class="px-5 py-5">
                    <div class="flex items-center">
                        <svg width="60" height="60" viewBox="0 0 60 60" fill="none"
                            xmlns="http://www.w3.org/2000/svg">
                            <circle cx="30" cy="30" r="30" fill="#57E559" />
                            <path
                                d="M18.3333 45C17.4167 45 16.6319 44.6736 15.9792 44.0208C15.3264 43.3681 15 42.5833 15 41.6667V18.3333C15 17.4167 15.3264 16.6319 15.9792 15.9792C16.6319 15.3264 17.4167 15 18.3333 15H41.6667C42.5833 15 43.3681 15.3264 44.0208 15.9792C44.6736 16.6319 45 17.4167 45 18.3333V22.5H41.6667V18.3333H18.3333V41.6667H41.6667V37.5H45V41.6667C45 42.5833 44.6736 43.3681 44.0208 44.0208C43.3681 44.6736 42.5833 45 41.6667 45H18.3333ZM31.6667 38.3333C30.75 38.3333 29.9653 38.0069 29.3125 37.3542C28.6597 36.7014 28.3333 35.9167 28.3333 35V25C28.3333 24.0833 28.6597 23.2986 29.3125 22.6458C29.9653 21.9931 30.75 21.6667 31.6667 21.6667H43.3333C44.25 21.6667 45.0347 21.9931 45.6875 22.6458C46.3403 23.2986 46.6667 24.0833 46.6667 25V35C46.6667 35.9167 46.3403 36.7014 45.6875 37.3542C45.0347 38.0069 44.25 38.3333 43.3333 38.3333H31.6667ZM43.3333 35V25H31.6667V35H43.3333ZM36.6667 32.5C37.3611 32.5 37.9514 32.2569 38.4375 31.7708C38.9236 31.2847 39.1667 30.6944 39.1667 30C39.1667 29.3056 38.9236 28.7153 38.4375 28.2292C37.9514 27.7431 37.3611 27.5 36.6667 27.5C35.9722 27.5 35.3819 27.7431 34.8958 28.2292C34.4097 28.7153 34.1667 29.3056 34.1667 30C34.1667 30.6944 34.4097 31.2847 34.8958 31.7708C35.3819 32.2569 35.9722 32.5 36.6667 32.5Z"
                                fill="white" />
                        </svg>

                        <div class="ml-4">
                            <div class="self-center">
                                <p class="text-gray-400 text-sm">Cash Beginning</p>
                                <span class="text-3xl font-semibold text-gray-800">₱2,134,900</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class=" bg-white rounded-lg border border-slate-200 shadow-[0px_4px_12px_rgba(0,0,0,0.05)] p-4">
                <div class="px-5 py-5">
                    <div class="flex items-center">
                        <svg width="60" height="60" viewBox="0 0 60 60" fill="none"
                            xmlns="http://www.w3.org/2000/svg">
                            <circle cx="30" cy="30" r="30" fill="#45E3FF" />
                            <path
                                d="M18.3333 45C17.4167 45 16.6319 44.6736 15.9792 44.0208C15.3264 43.3681 15 42.5833 15 41.6667V18.3333C15 17.4167 15.3264 16.6319 15.9792 15.9792C16.6319 15.3264 17.4167 15 18.3333 15H41.6667C42.5833 15 43.3681 15.3264 44.0208 15.9792C44.6736 16.6319 45 17.4167 45 18.3333V22.5H41.6667V18.3333H18.3333V41.6667H41.6667V37.5H45V41.6667C45 42.5833 44.6736 43.3681 44.0208 44.0208C43.3681 44.6736 42.5833 45 41.6667 45H18.3333ZM31.6667 38.3333C30.75 38.3333 29.9653 38.0069 29.3125 37.3542C28.6597 36.7014 28.3333 35.9167 28.3333 35V25C28.3333 24.0833 28.6597 23.2986 29.3125 22.6458C29.9653 21.9931 30.75 21.6667 31.6667 21.6667H43.3333C44.25 21.6667 45.0347 21.9931 45.6875 22.6458C46.3403 23.2986 46.6667 24.0833 46.6667 25V35C46.6667 35.9167 46.3403 36.7014 45.6875 37.3542C45.0347 38.0069 44.25 38.3333 43.3333 38.3333H31.6667ZM43.3333 35V25H31.6667V35H43.3333ZM36.6667 32.5C37.3611 32.5 37.9514 32.2569 38.4375 31.7708C38.9236 31.2847 39.1667 30.6944 39.1667 30C39.1667 29.3056 38.9236 28.7153 38.4375 28.2292C37.9514 27.7431 37.3611 27.5 36.6667 27.5C35.9722 27.5 35.3819 27.7431 34.8958 28.2292C34.4097 28.7153 34.1667 29.3056 34.1667 30C34.1667 30.6944 34.4097 31.2847 34.8958 31.7708C35.3819 32.2569 35.9722 32.5 36.6667 32.5Z"
                                fill="white" />
                        </svg>

                        <div class="ml-4">
                            <div class="self-center">
                                <p class="text-gray-400 text-sm">Cash End</p>
                                <span class="text-3xl font-semibold text-gray-800">₱2,134,900</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class=" bg-white rounded-lg border border-slate-200 shadow-[0px_4px_12px_rgba(0,0,0,0.05)] p-4">
                <div class="px-5 py-5">
                    <div class="flex items-center">
                        <svg width="60" height="60" viewBox="0 0 60 60" fill="none"
                            xmlns="http://www.w3.org/2000/svg">
                            <circle cx="30" cy="30" r="30" fill="#000D3A" />
                            <path
                                d="M10 40V37.6529C10 36.5404 10.5879 35.635 11.7638 34.9367C12.9399 34.2381 14.485 33.8887 16.3992 33.8887C16.745 33.8887 17.0774 33.8957 17.3962 33.9096C17.7154 33.9235 18.0278 33.955 18.3333 34.0042C18.0556 34.52 17.8472 35.0493 17.7083 35.5921C17.5694 36.1351 17.5 36.7017 17.5 37.2917V40H10ZM20 40V37.2917C20 36.4028 20.2431 35.5903 20.7292 34.8542C21.2153 34.1181 21.9028 33.4722 22.7917 32.9167C23.6806 32.3611 24.7431 31.9444 25.9792 31.6667C27.2153 31.3889 28.5556 31.25 30 31.25C31.4722 31.25 32.8264 31.3889 34.0625 31.6667C35.2986 31.9444 36.3611 32.3611 37.25 32.9167C38.1389 33.4722 38.8194 34.1181 39.2917 34.8542C39.7639 35.5903 40 36.4028 40 37.2917V40H20ZM42.5 40V37.2917C42.5 36.6831 42.4375 36.1096 42.3125 35.5713C42.1875 35.0329 41.9907 34.5113 41.7221 34.0063C42.0276 33.9557 42.3371 33.9235 42.6504 33.9096C42.964 33.8957 43.2843 33.8887 43.6113 33.8887C45.5279 33.8887 47.0718 34.2315 48.2429 34.9171C49.4143 35.6026 50 36.5146 50 37.6529V40H42.5ZM22.8471 37.2221H37.1667V37.0554C37.0742 36.1851 36.3496 35.4629 34.9929 34.8887C33.6365 34.3149 31.9722 34.0279 30 34.0279C28.0278 34.0279 26.3635 34.3149 25.0071 34.8887C23.6504 35.4629 22.9304 36.1944 22.8471 37.0833V37.2221ZM16.3767 32.5C15.5422 32.5 14.8264 32.2008 14.2292 31.6025C13.6319 31.0042 13.3333 30.2849 13.3333 29.4446C13.3333 28.5926 13.6325 27.8704 14.2308 27.2779C14.8292 26.6851 15.5485 26.3888 16.3888 26.3888C17.2407 26.3888 17.9629 26.6851 18.5554 27.2779C19.1482 27.8704 19.4446 28.5967 19.4446 29.4567C19.4446 30.2911 19.1482 31.0069 18.5554 31.6042C17.9629 32.2014 17.2367 32.5 16.3767 32.5ZM43.5992 32.5C42.7644 32.5 42.0485 32.2008 41.4513 31.6025C40.854 31.0042 40.5554 30.2849 40.5554 29.4446C40.5554 28.5926 40.8547 27.8704 41.4533 27.2779C42.0517 26.6851 42.771 26.3888 43.6113 26.3888C44.4629 26.3888 45.1851 26.6851 45.7779 27.2779C46.3704 27.8704 46.6667 28.5967 46.6667 29.4567C46.6667 30.2911 46.3704 31.0069 45.7779 31.6042C45.1851 32.2014 44.4589 32.5 43.5992 32.5ZM30 30C28.6111 30 27.4306 29.5139 26.4583 28.5417C25.4861 27.5694 25 26.3889 25 25C25 23.5833 25.4861 22.3958 26.4583 21.4375C27.4306 20.4792 28.6111 20 30 20C31.4167 20 32.6042 20.4792 33.5625 21.4375C34.5208 22.3958 35 23.5833 35 25C35 26.3889 34.5208 27.5694 33.5625 28.5417C32.6042 29.5139 31.4167 30 30 30ZM30.0096 27.2221C30.6421 27.2221 31.169 27.0082 31.5904 26.5804C32.0115 26.1526 32.2221 25.6226 32.2221 24.9904C32.2221 24.3579 32.0101 23.831 31.5863 23.4096C31.1621 22.9885 30.6365 22.7779 30.0096 22.7779C29.3829 22.7779 28.8543 22.9899 28.4238 23.4137C27.9932 23.8379 27.7779 24.3635 27.7779 24.9904C27.7779 25.6171 27.9918 26.1457 28.4196 26.5763C28.8474 27.0068 29.3774 27.2221 30.0096 27.2221Z"
                                fill="white" />
                        </svg>
                        <div class="ml-4">
                            <div class="self-center">
                                <p class="text-gray-400 text-sm">Total Customers</p>
                                <span class="text-3xl font-semibold text-gray-800">{{$totalCustomer}}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


            <!-- <div
                class="flex flex-col sm:col-span-6 xl:col-span-4 bg-white dark:bg-slate-800 shadow-lg rounded-lg border border-slate-200 dark:border-slate-700">
                <div class="p-8">
                    <div class="flex items-center">
                        <div class="">
                        </div>
                        <div class="ml-8">
                            <h2 class="text-sm font-base text-slate-400 dark:text-slate-100">TOTAL CUSTOMERS</h2>
                            <span
                                class="text-3xl font-semibold uppercase mb-1">33,493</span>
                        </div>
                    </div>
                    <div class="grid grid-cols-2 gap-1 mt-8">
                        <div>
                            <h3 class="text-sm font-semibold text-slate-400 dark:text-slate-100">This month</h3>
                            <span
                                class="text-lg font-semibold text-slate-700 dark:text-slate-500 uppercase mb-1"></span>
                        </div>
                        <div>
                            <h3 class="text-sm font-semibold text-slate-400 dark:text-slate-100">This week</h3>
                            <span
                                class="text-lg font-semibold text-slate-700 dark:text-slate-500 uppercase mb-1"></span>
                        </div>
                    </div>
                </div>
            </div> -->
        </div>

        <div class="flex items-start grid grid-cols-2 gap-4">
            <section class="grid grid-cols-6 gap-4 mb-8">
                <div class="col-span-3 bg-white rounded-lg border border-slate-200 shadow-[0px_4px_12px_rgba(0,0,0,0.05)] p-4">
                    <div class="px-5 py-5">
                        <div class="flex items-center">
                            <svg width="60" height="60" viewBox="0 0 60 60" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <circle cx="30" cy="30" r="30" fill="#000D3A"/>
                                <path d="M10 40V37.6529C10 36.5404 10.5879 35.635 11.7638 34.9367C12.9399 34.2381 14.485 33.8887 16.3992 33.8887C16.745 33.8887 17.0774 33.8957 17.3962 33.9096C17.7154 33.9235 18.0278 33.955 18.3333 34.0042C18.0556 34.52 17.8472 35.0493 17.7083 35.5921C17.5694 36.1351 17.5 36.7017 17.5 37.2917V40H10ZM20 40V37.2917C20 36.4028 20.2431 35.5903 20.7292 34.8542C21.2153 34.1181 21.9028 33.4722 22.7917 32.9167C23.6806 32.3611 24.7431 31.9444 25.9792 31.6667C27.2153 31.3889 28.5556 31.25 30 31.25C31.4722 31.25 32.8264 31.3889 34.0625 31.6667C35.2986 31.9444 36.3611 32.3611 37.25 32.9167C38.1389 33.4722 38.8194 34.1181 39.2917 34.8542C39.7639 35.5903 40 36.4028 40 37.2917V40H20ZM42.5 40V37.2917C42.5 36.6831 42.4375 36.1096 42.3125 35.5713C42.1875 35.0329 41.9907 34.5113 41.7221 34.0063C42.0276 33.9557 42.3371 33.9235 42.6504 33.9096C42.964 33.8957 43.2843 33.8887 43.6113 33.8887C45.5279 33.8887 47.0718 34.2315 48.2429 34.9171C49.4143 35.6026 50 36.5146 50 37.6529V40H42.5ZM22.8471 37.2221H37.1667V37.0554C37.0742 36.1851 36.3496 35.4629 34.9929 34.8887C33.6365 34.3149 31.9722 34.0279 30 34.0279C28.0278 34.0279 26.3635 34.3149 25.0071 34.8887C23.6504 35.4629 22.9304 36.1944 22.8471 37.0833V37.2221ZM16.3767 32.5C15.5422 32.5 14.8264 32.2008 14.2292 31.6025C13.6319 31.0042 13.3333 30.2849 13.3333 29.4446C13.3333 28.5926 13.6325 27.8704 14.2308 27.2779C14.8292 26.6851 15.5485 26.3888 16.3888 26.3888C17.2407 26.3888 17.9629 26.6851 18.5554 27.2779C19.1482 27.8704 19.4446 28.5967 19.4446 29.4567C19.4446 30.2911 19.1482 31.0069 18.5554 31.6042C17.9629 32.2014 17.2367 32.5 16.3767 32.5ZM43.5992 32.5C42.7644 32.5 42.0485 32.2008 41.4513 31.6025C40.854 31.0042 40.5554 30.2849 40.5554 29.4446C40.5554 28.5926 40.8547 27.8704 41.4533 27.2779C42.0517 26.6851 42.771 26.3888 43.6113 26.3888C44.4629 26.3888 45.1851 26.6851 45.7779 27.2779C46.3704 27.8704 46.6667 28.5967 46.6667 29.4567C46.6667 30.2911 46.3704 31.0069 45.7779 31.6042C45.1851 32.2014 44.4589 32.5 43.5992 32.5ZM30 30C28.6111 30 27.4306 29.5139 26.4583 28.5417C25.4861 27.5694 25 26.3889 25 25C25 23.5833 25.4861 22.3958 26.4583 21.4375C27.4306 20.4792 28.6111 20 30 20C31.4167 20 32.6042 20.4792 33.5625 21.4375C34.5208 22.3958 35 23.5833 35 25C35 26.3889 34.5208 27.5694 33.5625 28.5417C32.6042 29.5139 31.4167 30 30 30ZM30.0096 27.2221C30.6421 27.2221 31.169 27.0082 31.5904 26.5804C32.0115 26.1526 32.2221 25.6226 32.2221 24.9904C32.2221 24.3579 32.0101 23.831 31.5863 23.4096C31.1621 22.9885 30.6365 22.7779 30.0096 22.7779C29.3829 22.7779 28.8543 22.9899 28.4238 23.4137C27.9932 23.8379 27.7779 24.3635 27.7779 24.9904C27.7779 25.6171 27.9918 26.1457 28.4196 26.5763C28.8474 27.0068 29.3774 27.2221 30.0096 27.2221Z" fill="white"/>
                            </svg>
                            <div class="ml-4">
                                <div class="self-center">
                                    <p class="text-gray-400 text-sm">Total Employee</p>
                                    <span class="text-3xl font-semibold text-gray-800">485</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-span-3 bg-white rounded-lg border border-slate-200 shadow-[0px_4px_12px_rgba(0,0,0,0.05)] p-4">
                    <div class="px-5 py-5">
                        <div class="flex items-center">
                        <svg width="60" height="60" viewBox="0 0 60 60" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <circle cx="30" cy="30" r="30" fill="#57E559"/>
                            <path d="M26.6668 29.8619C24.8335 29.8619 23.3103 29.2554 22.0972 28.0423C20.8845 26.8293 20.2781 25.3061 20.2781 23.4727C20.2781 21.6394 20.8845 20.1163 22.0972 18.9036C23.3103 17.6905 24.8335 17.084 26.6668 17.084C28.5002 17.084 30.0234 17.6905 31.2364 18.9036C32.4492 20.1163 33.0556 21.6394 33.0556 23.4727C33.0556 25.3061 32.4492 26.8293 31.2364 28.0423C30.0234 29.2554 28.5002 29.8619 26.6668 29.8619ZM13.3335 43.2227V39.0561C13.3335 38.1025 13.5742 37.2322 14.0556 36.4452C14.5372 35.658 15.2225 35.0561 16.1114 34.6394C17.917 33.8061 19.6854 33.1765 21.4168 32.7507C23.1482 32.3248 24.8982 32.1119 26.6668 32.1119H27.1806C27.3567 32.1119 27.5188 32.1211 27.6668 32.1394C27.4816 32.5655 27.3357 32.9938 27.2293 33.4244C27.1229 33.855 27.0372 34.3433 26.9722 34.8894H26.6668C24.9354 34.8894 23.2942 35.0886 21.7431 35.4869C20.1922 35.885 18.7039 36.4358 17.2781 37.1394C16.8984 37.3338 16.6089 37.607 16.4097 37.959C16.2109 38.3109 16.1114 38.6766 16.1114 39.0561V40.4452H27.0835C27.2316 40.973 27.4167 41.4661 27.6389 41.9244C27.8611 42.3827 28.1204 42.8155 28.4168 43.2227H13.3335ZM37.4168 45.0007L36.9722 42.334C36.5464 42.1951 36.1228 42.0122 35.7014 41.7852C35.2803 41.5586 34.9077 41.297 34.5835 41.0007L32.2502 41.584L31.0002 39.4727L32.9447 37.6952C32.8892 37.3988 32.8614 37.0469 32.8614 36.6394C32.8614 36.2322 32.8892 35.8804 32.9447 35.584L31.0002 33.8061L32.2502 31.6952L34.5835 32.2786C34.9077 31.9822 35.2803 31.7205 35.7014 31.4936C36.1228 31.2669 36.5464 31.0841 36.9722 30.9452L37.4168 28.2786H40.0281L40.4723 30.9452C40.8984 31.0841 41.322 31.2693 41.7431 31.5007C42.1645 31.732 42.5372 32.0005 42.8614 32.3061L45.1947 31.6952L46.4447 33.834L44.5002 35.6119C44.5557 35.8897 44.5835 36.2369 44.5835 36.6536C44.5835 37.0702 44.5557 37.4175 44.5002 37.6952L46.4447 39.4727L45.1947 41.584L42.8614 41.0007C42.5372 41.297 42.1645 41.5586 41.7431 41.7852C41.322 42.0122 40.8984 42.1951 40.4723 42.334L40.0281 45.0007H37.4168ZM38.7222 39.9727C39.6945 39.9727 40.4931 39.6602 41.1181 39.0352C41.7431 38.4102 42.0556 37.6116 42.0556 36.6394C42.0556 35.6672 41.7431 34.8686 41.1181 34.2436C40.4931 33.6186 39.6945 33.3061 38.7222 33.3061C37.75 33.3061 36.9514 33.6186 36.3264 34.2436C35.7014 34.8686 35.3889 35.6672 35.3889 36.6394C35.3889 37.6116 35.7014 38.4102 36.3264 39.0352C36.9514 39.6602 37.75 39.9727 38.7222 39.9727ZM26.6668 27.084C27.6946 27.084 28.5534 26.7391 29.2431 26.0494C29.9331 25.3594 30.2781 24.5005 30.2781 23.4727C30.2781 22.445 29.9331 21.5862 29.2431 20.8965C28.5534 20.2068 27.6946 19.8619 26.6668 19.8619C25.6391 19.8619 24.7803 20.2068 24.0906 20.8965C23.4006 21.5862 23.0556 22.445 23.0556 23.4727C23.0556 24.5005 23.4006 25.3594 24.0906 26.0494C24.7803 26.7391 25.6391 27.084 26.6668 27.084Z" fill="white"/>
                        </svg>
                            <div class="ml-4">
                                <div class="self-center">
                                    <p class="text-gray-400 text-sm">Active Employee</p>
                                    <span class="text-3xl font-semibold text-gray-800">526</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-span-3 bg-white rounded-lg border border-slate-200 shadow-[0px_4px_12px_rgba(0,0,0,0.05)] p-4">
                    <div class="px-5 py-5">
                        <div class="flex items-center">
                        <svg width="60" height="60" viewBox="0 0 60 60" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <circle cx="30" cy="30" r="30" fill="#5272FF"/>
                            <path d="M39.2498 29.612L33.7498 24.0841L35.7082 22.1395L39.2498 25.6811L46.3332 18.5978L48.2778 20.5841L39.2498 29.612ZM24.9998 29.9728C23.1665 29.9728 21.6433 29.3664 20.4303 28.1536C19.2175 26.9406 18.6111 25.4174 18.6111 23.5841C18.6111 21.7507 19.2175 20.2275 20.4303 19.0145C21.6433 17.8017 23.1665 17.1953 24.9998 17.1953C26.8332 17.1953 28.3564 17.8017 29.5694 19.0145C30.7822 20.2275 31.3886 21.7507 31.3886 23.5841C31.3886 25.4174 30.7822 26.9406 29.5694 28.1536C28.3564 29.3664 26.8332 29.9728 24.9998 29.9728ZM11.6665 43.3341V39.1674C11.6665 38.2043 11.9096 37.327 12.3957 36.5353C12.8818 35.7436 13.5647 35.1488 14.4444 34.7507C16.4072 33.8527 18.2251 33.2068 19.8982 32.8132C21.5709 32.4196 23.27 32.2228 24.9953 32.2228C26.7205 32.2228 28.4165 32.4196 30.0832 32.8132C31.7498 33.2068 33.5647 33.8527 35.5278 34.7507C36.4072 35.1674 37.0947 35.767 37.5903 36.5495C38.0855 37.3317 38.3332 38.2043 38.3332 39.1674V43.3341H11.6665ZM14.4444 40.5561H35.5553V39.1674C35.5553 38.7693 35.4465 38.3943 35.229 38.0424C35.0115 37.6905 34.7222 37.4266 34.3611 37.2507C32.5461 36.3896 30.9303 35.7993 29.5136 35.4799C28.0969 35.1605 26.5923 35.0007 24.9998 35.0007C23.4073 35.0007 21.898 35.1605 20.4719 35.4799C19.0461 35.7993 17.4258 36.3896 15.6111 37.2507C15.25 37.4266 14.9653 37.6905 14.7569 38.0424C14.5486 38.3943 14.4444 38.7693 14.4444 39.1674V40.5561ZM24.9998 27.1953C26.0276 27.1953 26.8864 26.8503 27.5761 26.1603C28.2661 25.4706 28.6111 24.6118 28.6111 23.5841C28.6111 22.5563 28.2661 21.6975 27.5761 21.0078C26.8864 20.3178 26.0276 19.9728 24.9998 19.9728C23.9721 19.9728 23.1133 20.3178 22.4236 21.0078C21.7336 21.6975 21.3886 22.5563 21.3886 23.5841C21.3886 24.6118 21.7336 25.4706 22.4236 26.1603C23.1133 26.8503 23.9721 27.1953 24.9998 27.1953Z" fill="white"/>
                        </svg>
                            <div class="ml-4">
                                <div class="self-center">
                                    <p class="text-gray-400 text-sm">New Hire</p>
                                    <span class="text-3xl font-semibold text-gray-800">12</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-span-3 bg-white rounded-lg border border-slate-200 shadow-[0px_4px_12px_rgba(0,0,0,0.05)] p-4">
                    <div class="px-5 py-5">
                        <div class="flex items-center">
                        <svg width="60" height="60" viewBox="0 0 60 60" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <circle cx="30" cy="30" r="30" fill="#45E3FF"/>
                            <path d="M27.4447 43.6673C28.7503 41.1765 30.44 39.489 32.5139 38.6048C34.5881 37.7207 36.3797 37.2786 37.8889 37.2786C38.5278 37.2786 39.1297 37.3294 39.6947 37.4311C40.2595 37.533 40.8335 37.6673 41.4168 37.834C42.1204 36.797 42.7084 35.6015 43.1806 34.2473C43.6528 32.8934 43.8889 31.4779 43.8889 30.0007C43.8889 26.1234 42.5435 22.8393 39.8527 20.1482C37.1616 17.4573 33.8774 16.1119 30.0002 16.1119C26.1229 16.1119 22.8388 17.4573 20.1477 20.1482C17.4568 22.8393 16.1114 26.1234 16.1114 30.0007C16.1114 31.3618 16.3035 32.6719 16.6877 33.9311C17.0718 35.1905 17.6111 36.3341 18.3056 37.3619C19.4445 36.7691 20.6297 36.32 21.8614 36.0144C23.0928 35.7088 24.352 35.5561 25.6389 35.5561C26.4722 35.5561 27.2802 35.6186 28.0627 35.7436C28.8452 35.8686 29.5836 36.0654 30.2781 36.334C29.7872 36.6304 29.3081 36.9591 28.8406 37.3202C28.3728 37.6814 27.9445 38.047 27.5556 38.4173C27.1853 38.3618 26.845 38.334 26.5347 38.334H25.6518C24.6618 38.334 23.6877 38.4405 22.7293 38.6536C21.771 38.8664 20.852 39.195 19.9722 39.6394C20.9722 40.6766 22.1135 41.5494 23.396 42.2577C24.6785 42.9661 26.0281 43.4359 27.4447 43.6673ZM30.0131 46.6673C27.7175 46.6673 25.5559 46.2298 23.5281 45.3548C21.5003 44.4798 19.7317 43.2877 18.2222 41.7786C16.7131 40.2691 15.521 38.5027 14.646 36.4794C13.771 34.4561 13.3335 32.294 13.3335 29.9932C13.3335 27.6926 13.771 25.533 14.646 23.5144C15.521 21.4961 16.7131 19.7322 18.2222 18.2227C19.7317 16.7136 21.4981 15.5215 23.5214 14.6465C25.5447 13.7715 27.7068 13.334 30.0077 13.334C32.3082 13.334 34.4678 13.7715 36.4864 14.6465C38.5047 15.5215 40.2686 16.7136 41.7781 18.2227C43.2872 19.7322 44.4793 21.4963 45.3543 23.5152C46.2293 25.5344 46.6668 27.6919 46.6668 29.9877C46.6668 32.2833 46.2293 34.445 45.3543 36.4727C44.4793 38.5005 43.2872 40.2691 41.7781 41.7786C40.2686 43.2877 38.5045 44.4798 36.4856 45.3548C34.4664 46.2298 32.3089 46.6673 30.0131 46.6673ZM25.6422 32.5007C24.0475 32.5007 22.6853 31.9369 21.5556 30.8094C20.4261 29.6822 19.8614 28.3211 19.8614 26.7261C19.8614 25.1313 20.425 23.7691 21.5522 22.6394C22.6797 21.51 24.0409 20.9452 25.6356 20.9452C27.2306 20.9452 28.5928 21.5088 29.7222 22.6361C30.852 23.7636 31.4168 25.1247 31.4168 26.7194C31.4168 28.3144 30.8531 29.6766 29.7256 30.8061C28.5984 31.9358 27.2372 32.5007 25.6422 32.5007ZM25.6389 29.7227C26.4722 29.7227 27.1806 29.4311 27.7639 28.8477C28.3472 28.2644 28.6389 27.5561 28.6389 26.7227C28.6389 25.8894 28.3472 25.1811 27.7639 24.5977C27.1806 24.0144 26.4722 23.7227 25.6389 23.7227C24.8056 23.7227 24.0972 24.0144 23.5139 24.5977C22.9306 25.1811 22.6389 25.8894 22.6389 26.7227C22.6389 27.5561 22.9306 28.2644 23.5139 28.8477C24.0972 29.4311 24.8056 29.7227 25.6389 29.7227ZM37.8889 34.334C36.6853 34.334 35.6622 33.9127 34.8197 33.0702C33.977 32.2275 33.5556 31.2043 33.5556 30.0007C33.5556 28.797 33.977 27.7738 34.8197 26.9311C35.6622 26.0886 36.6853 25.6673 37.8889 25.6673C39.0928 25.6673 40.116 26.0886 40.9585 26.9311C41.801 27.7738 42.2223 28.797 42.2223 30.0007C42.2223 31.2043 41.801 32.2275 40.9585 33.0702C40.116 33.9127 39.0928 34.334 37.8889 34.334Z" fill="white"/>
                        </svg>

                            <div class="ml-4">
                                <div class="self-center">
                                    <p class="text-gray-400 text-sm">Probation</p>
                                    <span class="text-3xl font-semibold text-gray-800">12</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-span-3 bg-white rounded-lg border border-slate-200 shadow-[0px_4px_12px_rgba(0,0,0,0.05)] p-4">
                    <div class="px-5 py-5">
                        <div class="flex items-center">
                        <svg width="60" height="60" viewBox="0 0 60 60" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <circle cx="30" cy="30" r="30" fill="#FF5252"/>
                            <path d="M26.625 30C25.9769 30 25.4446 29.7546 25.0279 29.2637C24.6113 28.7732 24.4631 28.2131 24.5833 27.5833L25.1667 24.0833C25.3889 22.8889 25.9514 21.9097 26.8542 21.1458C27.7569 20.3819 28.8056 20 30 20C31.2222 20 32.2847 20.3819 33.1875 21.1458C34.0903 21.9097 34.6528 22.8889 34.875 24.0833L35.4583 27.5833C35.5786 28.2131 35.4304 28.7732 35.0138 29.2637C34.5971 29.7546 34.0647 30 33.4167 30H26.625ZM27.4583 27.2221H32.5833L32.1388 24.5417C32.0463 24.0231 31.801 23.5994 31.4029 23.2708C31.0046 22.9422 30.5415 22.7779 30.0138 22.7779C29.486 22.7779 29.0254 22.9422 28.6321 23.2708C28.2385 23.5994 27.9954 24.0231 27.9029 24.5417L27.4583 27.2221ZM15.5833 32.5167C15 32.5425 14.4944 32.4276 14.0667 32.1721C13.6389 31.9165 13.3601 31.5204 13.2304 30.9837C13.1788 30.7537 13.1714 30.5231 13.2083 30.2917C13.2453 30.0603 13.3101 29.8396 13.4029 29.6296C13.4029 29.656 13.389 29.6035 13.3613 29.4721C13.3426 29.4351 13.2149 29.129 12.9779 28.5537C12.9185 28.2401 12.949 27.9537 13.0696 27.6946C13.1899 27.4351 13.3611 27.1943 13.5833 26.9721L13.6667 26.8888C13.7222 26.3982 13.9215 25.9908 14.2646 25.6667C14.6076 25.3425 15.0333 25.1804 15.5417 25.1804C15.5881 25.1804 15.8257 25.2268 16.2546 25.3196L16.375 25.2779C16.5139 25.1574 16.6821 25.0624 16.8796 24.9929C17.0771 24.9235 17.2869 24.8888 17.5092 24.8888C17.7808 24.8888 18.0301 24.9374 18.2571 25.0346C18.4838 25.1318 18.6601 25.2696 18.7863 25.4479C18.8115 25.4479 18.8304 25.4543 18.8429 25.4671C18.8554 25.4799 18.8743 25.4862 18.8996 25.4862C19.2524 25.5115 19.561 25.6197 19.8254 25.8108C20.0899 26.0017 20.2915 26.2622 20.4304 26.5925C20.486 26.7703 20.5068 26.9418 20.4929 27.1071C20.479 27.2721 20.4443 27.4308 20.3888 27.5833C20.3888 27.6297 20.4026 27.676 20.4304 27.7221C20.6076 27.901 20.7469 28.0989 20.8483 28.3158C20.9494 28.5328 21 28.7563 21 28.9863C21 29.0601 20.926 29.3257 20.7779 29.7829C20.7501 29.8368 20.7501 29.8907 20.7779 29.9446C20.7963 30.0185 20.8147 30.2221 20.8333 30.5554C20.8333 31.0832 20.6114 31.5421 20.1675 31.9321C19.7236 32.3218 19.1847 32.5167 18.5508 32.5167H15.5833ZM43.5529 32.5C42.7121 32.5 41.9931 32.1996 41.3958 31.5988C40.7986 30.9982 40.5 30.2761 40.5 29.4325C40.5 29.1256 40.5486 28.8356 40.6458 28.5625C40.7431 28.2894 40.8657 28.0325 41.0138 27.7917L39.9304 26.8333C39.6899 26.6111 39.646 26.3518 39.7988 26.0554C39.9515 25.7593 40.181 25.6112 40.4871 25.6112H43.5492C44.3911 25.6112 45.1119 25.9114 45.7117 26.5117C46.3114 27.1122 46.6113 27.834 46.6113 28.6771V29.4438C46.6113 30.2868 46.3118 31.0069 45.7129 31.6042C45.114 32.2014 44.394 32.5 43.5529 32.5ZM10 40V37.6529C10 36.5146 10.5949 35.6026 11.7846 34.9171C12.9746 34.2315 14.5131 33.8887 16.4 33.8887C16.7456 33.8887 17.0778 33.8957 17.3967 33.9096C17.7156 33.9235 18.0278 33.9557 18.3333 34.0063C18.0556 34.5113 17.8472 35.0329 17.7083 35.5713C17.5694 36.1096 17.5 36.6831 17.5 37.2917V40H10ZM20 40V37.2917C20 35.4861 20.9236 34.0278 22.7708 32.9167C24.6181 31.8056 27.0278 31.25 30 31.25C33 31.25 35.4167 31.8056 37.25 32.9167C39.0833 34.0278 40 35.4861 40 37.2917V40H20ZM43.6113 33.8887C45.5279 33.8887 47.0718 34.2315 48.2429 34.9171C49.4143 35.6026 50 36.5146 50 37.6529V40H42.5V37.2917C42.5 36.6831 42.4375 36.1096 42.3125 35.5713C42.1875 35.0329 41.9907 34.5113 41.7221 34.0063C42.0276 33.9557 42.3371 33.9235 42.6504 33.9096C42.964 33.8957 43.2843 33.8887 43.6113 33.8887ZM29.9946 34.0279C27.989 34.0279 26.3149 34.3196 24.9721 34.9029C23.6296 35.4863 22.9212 36.2131 22.8471 37.0833V37.2221H37.1667V37.0554C37.0833 36.2037 36.3774 35.4863 35.0488 34.9029C33.7199 34.3196 32.0351 34.0279 29.9946 34.0279Z" fill="white"/>
                        </svg>
                            <div class="ml-4">
                                <div class="self-center">
                                    <p class="text-gray-400 text-sm">On Leave</p>
                                    <span class="text-3xl font-semibold text-gray-800">7</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <!-- recent logs and announcemnts -->

            <section>
            <div class="col-span-full xl:col-span-6 bg-white rounded-lg border border-slate-200 shadow-[0px_8px_20px_rgba(0,0,0,0.08)] p-6 mb-4">
                        <!-- Header Section --> 
                         <div class="flex justify-between items-center mb-4"> 
                            <h2 class="font-semibold text-slate-800 dark:text-slate-100">Announcements</h2> 
                            <span class="bg-blue-100 text-blue-600 text-sm px-3 py-1 rounded-lg">Today, December 12, 2024</span> 
                        </div> 
                        <p class="text-gray-500 text-sm mb-4">1</p>

                        <!-- Announcement Cards -->
                            <div class="space-y-4">
                                <!-- Card 1 -->
                                
                                    <div onclick="/" class="bg-white rounded-lg shadow p-4 flex items-end justify-between mb-4"> 
                                        <div> 
                                            <p class="text-gray-400 text-xs mb-1">Tasks</p> 
                                            <h3 class="text-gray-800 font-semibold mb-4">Task Title</h3> 
                                            <div class="flex items-center space-x-2"> 
                                                <!-- Icon -->
                                                <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="#789DE5"><path d="M760-200H320q-33 0-56.5-23.5T240-280v-560q0-33 23.5-56.5T320-920h280l240 240v400q0 33-23.5 56.5T760-200ZM560-640v-200H320v560h440v-360H560ZM160-40q-33 0-56.5-23.5T80-120v-560h80v560h440v80H160Zm160-800v200-200 560-560Z"/></svg> 
                                                <!-- Text --> 
                                                <span class="text-gray-500 text-sm">Collect Payment</span>
                                            </div> 
                                        </div> 
                                        <div class="flex items-center space-y-2"> 
                                            <div class="shrink-0 self-end ml-2"> 
                                                <a class="font-medium text-indigo-500 hover:text-indigo-600 dark:hover:text-indigo-400" href="#0">View<span class="hidden sm:inline"> -&gt;</span></a> 
                                            </div> 
                                        </div> 
                                    </div> 
                                

                                <!-- Modal Overlay --> 
                                 <div id="modal-overlay" class="hidden fixed inset-0 bg-gray-900 bg-opacity-50 flex items-center justify-center"> 
                                    <!-- Modal Content --> 
                                     <div class="bg-white rounded-lg shadow-lg p-6 w-full max-w-3xl"> 
                                        <!-- Modal Header --> 
                                         <div class="flex items-center mb-8"> 
                                            <h2 id="modal-title" class="text-2xl font-semibold text-gray-800"></h2> 
                                        </div> 
                                        <!-- Message Body --> 
                                         <div id="modal-content" class="mb-6"> 
                                            <p class="text-gray-700"></p> 
                                        </div> 
                                        <!-- File Attachments -->
                                        <div class="mb-4">
                                            <h4 class="text-gray-800 font-medium">File Attachments</h4>
                                            <div class="flex space-x-4 mt-2">
                                                <div class="bg-gray-100 border border-gray-200 rounded-lg p-3 flex items-center space-x-2">
                                                    <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24" width="24" height="24" class="text-gray-600">
                                                        <path d="M6 2h9l5 5v13c0 1.1-.9 2-2 2H6c-1.1 0-2-.9-2-2V4c0-1.1.9-2 2-2zm5 1.5v4h4.5L11 3.5zm1 13.5h-1.5v-1.5H10v1.5H8.5v-3H10v1.5h1.5v-1.5h1.5v3zm4.5 0H15v-1.5h1.5v-1.5H15v-1.5h2.5V17zm-6-1.5h1.5V17H11v-1.5zm6-6H7V4h5v5h5v3z"/>
                                                    </svg>
                                                    <span class="text-gray-600 text-sm">loanfiles.pdf (7kb)</span>
                                                    <a href="#" class="text-blue-500 hover:text-blue-600 ml-auto">Download</a>
                                                </div>
                                                <div class="bg-gray-100 border border-gray-200 rounded-lg p-3 flex items-center space-x-2">
                                                    <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24" width="24" height="24" class="text-gray-600">
                                                        <path d="M6 2h9l5 5v13c0 1.1-.9 2-2 2H6c-1.1 0-2-.9-2-2V4c0-1.1.9-2 2-2zm5 1.5v4h4.5L11 3.5zm1 13.5h-1.5v-1.5H10v1.5H8.5v-3H10v1.5h1.5v-1.5h1.5v3zm4.5 0H15v-1.5h1.5v-1.5H15v-1.5h2.5V17zm-6-1.5h1.5V17H11v-1.5zm6-6H7V4h5v5h5v3z"/>
                                                    </svg>
                                                    <span class="text-gray-600 text-sm">loanfiles2.pdf (7kb)</span>
                                                    <a href="#" class="text-blue-500 hover:text-blue-600 ml-auto">Download</a>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- Close Button --> 
                                        <div class="flex justify-end mt-4"> 
                                            <button onclick="closeModal()" class="text-white bg-blue-500 hover:bg-blue-600 font-medium rounded-lg text-sm px-4 py-2">Close</button> 
                                        </div> 
                                    </div> 
                                </div>
                            </div>
                    </div>

            <div
                class="col-span-full xl:col-span-6 bg-white rounded-lg border border-slate-200 shadow-[0px_8px_20px_rgba(0,0,0,0.08)] mb-4">
                <header class="px-5 py-4 border-b border-slate-100 dark:border-slate-700">
                    <h2 class="font-semibold text-slate-800 dark:text-slate-100">Recent Logs</h2>
                </header>
                <div class="p-3">
                    <div>
                        <header
                            class="text-xs uppercase text-slate-400 dark:text-slate-500 bg-slate-50 dark:bg-slate-700 dark:bg-opacity-50 rounded-sm font-semibold p-2">
                            Today</header>
                        <ul class="my-1">
                            <!-- Item -->
                            <li class="flex px-2">
                                <div class="w-9 h-9 rounded-full shrink-0 bg-indigo-500 my-2 mr-3">
                                    <svg class="w-9 h-9 fill-current text-indigo-50" viewBox="0 0 36 36">
                                        <path
                                            d="M18 10c-4.4 0-8 3.1-8 7s3.6 7 8 7h.6l5.4 2v-4.4c1.2-1.2 2-2.8 2-4.6 0-3.9-3.6-7-8-7zm4 10.8v2.3L18.9 22H18c-3.3 0-6-2.2-6-5s2.7-5 6-5 6 2.2 6 5c0 2.2-2 3.8-2 3.8z" />
                                    </svg>
                                </div>
                                <div
                                    class="grow flex items-center border-b border-slate-100 dark:border-slate-700 text-sm py-2">
                                    <div class="grow flex justify-between">
                                        <div class="self-center"><a
                                                class="font-medium text-slate-800 hover:text-slate-900 dark:text-slate-100 dark:hover:text-white"
                                                href="#0">
                                                <p>Branch Manager 1</p>
                                                <span class="text-gray-400 text-xs">Loan Approved 50,000</span>
                                        </div>
                                        <div class="shrink-0 self-end ml-2">
                                            <a class="font-medium text-indigo-500 hover:text-indigo-600 dark:hover:text-indigo-400"
                                                href="#0">View<span class="hidden sm:inline"> -&gt;</span></a>
                                        </div>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </div>
                    <!-- "Yesterday" group -->
                    <div>
                        <header
                            class="text-xs uppercase text-slate-400 dark:text-slate-500 bg-slate-50 dark:bg-slate-700 dark:bg-opacity-50 rounded-sm font-semibold p-2">
                            Yesterday</header>
                        <ul class="my-1">
                            <!-- Item -->
                            <li class="flex px-2">
                                <div class="w-9 h-9 rounded-full shrink-0 bg-sky-500 my-2 mr-3">
                                    <svg class="w-9 h-9 fill-current text-sky-50" viewBox="0 0 36 36">
                                        <path
                                            d="M23 11v2.085c-2.841.401-4.41 2.462-5.8 4.315-1.449 1.932-2.7 3.6-5.2 3.6h-1v2h1c3.5 0 5.253-2.338 6.8-4.4 1.449-1.932 2.7-3.6 5.2-3.6h3l-4-4zM15.406 16.455c.066-.087.125-.162.194-.254.314-.419.656-.872 1.033-1.33C15.475 13.802 14.038 13 12 13h-1v2h1c1.471 0 2.505.586 3.406 1.455zM24 21c-1.471 0-2.505-.586-3.406-1.455-.066.087-.125.162-.194.254-.316.422-.656.873-1.028 1.328.959.878 2.108 1.573 3.628 1.788V25l4-4h-3z" />
                                    </svg>
                                </div>
                                <div
                                    class="grow flex items-center border-b border-slate-100 dark:border-slate-700 text-sm py-2">
                                    <div class="grow flex justify-between">
                                        <div class="self-center"><a
                                                class="font-medium text-slate-800 hover:text-slate-900 dark:text-slate-100 dark:hover:text-white"
                                                href="#0">
                                                <p>Branch Manager 2</p>
                                                <span class="text-gray-400 text-xs">For approval</span>
                                        </div>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </div>

                </div>
            </div>
            </section>

            <section class="bg-white rounded-lg border border-slate-200 shadow-[0px_4px_12px_rgba(0,0,0,0.05)] p-4">
            <div class="flex w-max items-center justify-center ">
            <div>
                <h2 class="text-xl font-semibold text-gray-800 mb-4">Latest Payer vs Late Payee</h2>
                <canvas id="pieChart" class="w-64 h-64"></canvas>
            </div>
            </div>
            </section>
        </div>

        <!-- Cards -->
        <div class="px-4 py-8 w-full max-w-9xl mx-auto">
            @if (session()->has('success'))
                <div class="alert alert-success">
                    <div class="flex items-center p-4 mb-4 text-sm text-green-800 border border-green-300 rounded-lg bg-green-50 dark:bg-gray-800 dark:text-green-400 dark:border-green-800"
                        role="alert">
                        <svg class="flex-shrink-0 inline w-4 h-4 mr-3" aria-hidden="true"
                            xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
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
                <h1 class="text-2xl md:text-2xl text-slate-800 dark:text-slate-100 font-bold mb-4">Recent Applied
                    Customers
                </h1>
            </div>

            <div></div>

            <!-- Dashboard actions -->
            <div class="sm:flex sm:justify-between sm:items-center mb-4">
                <div>
                    <form method="GET" action="" class="flex items-center max-w-sm mx-auto">
                        <label for="search" class="sr-only">Search</label>
                        <div class="relative w-full">
                            <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
                            </div>
                            <input type="text" id="search" name="search"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-2 p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                placeholder="Search customer name..." required />
                        </div>
                        <button type="submit" class="btn bg-indigo-500 hover:bg-indigo-600 text-white ml-2">
                            <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 0 24 24" width="24px"
                                fill="#FFFFFF">
                                <path d="M0 0h24v24H0z" fill="none" />
                                <path
                                    d="M15.5 14h-.79l-.28-.27C15.41 12.59 16 11.11 16 9.5 16 5.91 13.09 3 9.5 3S3 5.91 3 9.5 5.91 16 9.5 16c1.61 0 3.09-.59 4.23-1.57l.27.28v.79l5 4.99L20.49 19l-4.99-5zm-6 0C7.01 14 5 11.99 5 9.5S7.01 5 9.5 5 14 7.01 14 9.5 11.99 14 9.5 14z" />
                            </svg>
                            <span class="sr-only">Search</span>
                        </button>
                    </form>
                </div>

                <!-- Right: Actions -->
                <div class="grid grid-flow-col sm:auto-cols-max justify-start sm:justify-end gap-2">

                    <!-- Filter button -->
                    <x-dropdown-filter align="right" />

                    <!-- Add view button -->
                    <a href="{{ route('customer.add') }}" class="btn bg-indigo-500 hover:bg-indigo-600 text-white">
                        <svg class="w-4 h-4 fill-current opacity-50 shrink-0" viewBox="0 0 16 16">
                            <path
                                d="M15 7H9V1c0-.6-.4-1-1-1S7 .4 7 1v6H1c-.6 0-1 .4-1 1s.4 1 1 1h6v6c0 .6.4 1 1 1s1-.4 1-1V9h6c.6 0 1-.4 1-1s-.4-1-1-1z" />
                        </svg>
                        <span class="hidden xs:block ml-2">Add Customer</span>
                    </a>
                    <a id="show-modal" href="#" class="btn bg-indigo-500 hover:bg-indigo-600 text-white">
                        <svg class="w-4 h-4 fill-current opacity-50 shrink-0" viewBox="0 0 16 16">
                            <path
                                d="M15 7H9V1c0-.6-.4-1-1-1S7 .4 7 1v6H1c-.6 0-1 .4-1 1s.4 1 1 1h6v6c0 .6.4 1 1 1s1-.4 1-1V9h6c.6 0 1-.4 1-1s-.4-1-1-1z" />
                        </svg>
                        <span class="hidden xs:block ml-2">Import</span>
                    </a>
                    <div id="modal" class="relative z-10 hidden" aria-labelledby="modal-title" role="dialog"
                        aria-modal="true">
                        <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" aria-hidden="true">
                        </div>

                        <div class="fixed inset-0 z-10 w-screen overflow-y-auto">
                            <div
                                class="flex min-h-full items-end justify-center p-4 text-center sm:items-center sm:p-0">
                                <div
                                    class="relative transform overflow-hidden rounded-lg bg-white text-left shadow-xl transition-all sm:my-8 sm:w-full sm:max-w-lg">
                                    <form action="{{ route('customer.importcsv') }}" method="POST"
                                        enctype="multipart/form-data">
                                        @csrf
                                        <div class="bg-white px-4 pb-4 pt-5 sm:p-6 sm:pb-4">
                                            <div class="sm:flex sm:items-start">
                                                <div
                                                    class="mx-auto flex h-12 w-12 flex-shrink-0 items-center justify-center rounded-full bg-blue-100 sm:mx-0 sm:h-10 sm:w-10">
                                                    <svg class="h-6 w-6 text-blue-500" viewBox="0 0 24 24"
                                                        fill="none" stroke="currentColor" stroke-width="2"
                                                        stroke-linecap="round" stroke-linejoin="round">
                                                        <polyline points="16 16 12 12 8 16" />
                                                        <line x1="12" y1="12" x2="12"
                                                            y2="21" />
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
                                                                <input type="file" class="form-control"
                                                                    id="file" name="file" accept=".csv">
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

            <!-- Cards -->
            <section class="container mx-auto">
                <div class="flex flex-col">
                    <div class="-mx-4 -my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                        <div class="inline-block min-w-full py-2 align-middle md:px-6 lg:px-8">
                            <div class="overflow-hidden border border-gray-200 dark:border-gray-700 md:rounded-lg">
                                <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                                    <thead class="bg-gray-50 dark:bg-gray-800">
                                        <tr>
                                            <th scope="col"
                                                class="px-4 py-3.5 text-sm font-normal text-left rtl:text-right text-gray-500 dark:text-gray-400">
                                                Customer ID
                                            </th>

                                            <th scope="col"
                                                class="px-4 py-3.5 text-sm font-normal text-left rtl:text-right text-gray-500 dark:text-gray-400">
                                                Name
                                            </th>

                                            <th scope="col"
                                                class="px-4 py-3.5 text-sm font-normal text-left rtl:text-right text-gray-500 dark:text-gray-400">
                                                Address
                                            </th>

                                            <th scope="col"
                                                class="px-4 py-3.5 text-sm font-normal text-left rtl:text-right text-gray-500 dark:text-gray-400">
                                                Customer Type
                                            </th>

                                        </tr>
                                    </thead>
                                    <tbody
                                        class="bg-white divide-y divide-gray-200 dark:divide-gray-500 dark:bg-gray-900">
                                        @foreach ($lists as $list)
                                            <tr>
                                                <td
                                                    class="px-4 py-4 text-sm font-medium text-gray-500 dark:text-gray-200 whitespace-nowrap">
                                                    {{ $list->id }}
                                                </td>
                                                <td
                                                    class="px-4 py-4 text-sm font-medium text-gray-500 dark:text-gray-200 whitespace-nowrap">
                                                    {{ $list->first_name }} {{ $list->last_name }}
                                                </td>
                                                <td
                                                    class="px-4 py-4 text-sm text-gray-500 dark:text-gray-300 whitespace-nowrap">
                                                    {{ $list->house }} {{ $list->street }} {{$list->bry->barangay_name??''}} {{$list->cty->city_town??''}}
                                                </td>
                                                <td
                                                    class="px-4 py-4 text-sm text-gray-500 dark:text-gray-300 whitespace-nowrap">
                                                    {{ $list->customerType->description }}
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="flex-end items-center justify-between mt-6">
                    {{ $lists->links() }}
                </div>
            </section>


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
        backgroundColor: ['#34D399', '#F87171'], // Tailwind green and red colors
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
        backgroundColor: ['#34D399', '#F87171'],
        hoverBackgroundColor: ['#10B981', '#EF4444']
    }]
    };

</script>

--}}