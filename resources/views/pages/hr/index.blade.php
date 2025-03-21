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
            <h1 class="text-2xl md:text-2xl text-slate-800 dark:text-slate-100 font-bold mb-4">Employee Overview
            </h1>
        </div>
        
    </div>



    <div class="px-4 w-full max-w-9xl mx-auto mt-4">
        <div class="grid grid-cols-2 gap-4 xl:grid-cols-2 2xl:gap-7.5">
            <div class="col-span-1 rounded-md border border-stroke bg-white shadow-default dark:border-strokedark divide-y">
                <h1 class="text-xl text-slate-800 dark:text-slate-100 font-bold p-4">Total Employee</h1>
            

                <div class="flex items-center text-lg p-4">
                    <div class="border-solid rounded p-2 border-2 border-borderline-100">
                    <svg xmlns="http://www.w3.org/2000/svg" height="40px" viewBox="0 -960 960 960" width="40px" fill="#434343">
                        <path d="M702-489.33 570-622l47-46.67 85 85 170-170L918.67-706 702-489.33Zm-342 8.66q-66 0-109.67-43.66Q206.67-568 206.67-634t43.66-109.67Q294-787.33 360-787.33t109.67 43.66Q513.33-700 513.33-634t-43.66 109.67Q426-480.67 360-480.67ZM40-160v-100q0-34.67 17.5-63.17T106.67-366q70.66-32.33 131-46.5Q298-426.67 360-426.67t122 14.17q60 14.17 130.67 46.5 31.66 15 49.5 43.17Q680-294.67 680-260v100H40Z"/>
                    </svg>
                    </div>
                    
                    <div class="ml-4">
                        <div class="self-center">
                            <p class="text-gray-400 text-sm">Active Employee</p>
                            <span class="text-2xl font-semibold text-gray-800">200</span>
                        </div>
                    </div>
                </div>

                <div class="flex items-center text-lg p-4">
                    <div class="border-solid rounded p-2 border-2 border-borderline-100">
                        <svg xmlns="http://www.w3.org/2000/svg" height="38px" viewBox="0 -960 960 960" width="38x" fill="#434343">
                            <path d="M0-240v-63q0-43 44-70t116-27q13 0 25 .5t23 2.5q-14 21-21 44t-7 48v65H0Zm240 0v-65q0-32 17.5-58.5T307-410q32-20 76.5-30t96.5-10q53 0 97.5 10t76.5 30q32 20 49 46.5t17 58.5v65H240Zm540 0v-65q0-26-6.5-49T754-397q11-2 22.5-2.5t23.5-.5q72 0 116 26.5t44 70.5v63H780ZM160-440q-33 0-56.5-23.5T80-520q0-34 23.5-57t56.5-23q34 0 57 23t23 57q0 33-23 56.5T160-440Zm640 0q-33 0-56.5-23.5T720-520q0-34 23.5-57t56.5-23q34 0 57 23t23 57q0 33-23 56.5T800-440Zm-320-40q-50 0-85-35t-35-85q0-51 35-85.5t85-34.5q51 0 85.5 34.5T600-600q0 50-34.5 85T480-480Z"/>
                        </svg>
                    </div>
                    
                    <div class="ml-4">
                        <div class="self-center">
                            <p class="text-gray-400 text-sm">New Hire</p>
                            <span class="text-2xl font-semibold text-gray-800">200</span>
                        </div>
                    </div>
                </div>

                <div class="flex items-center text-lg p-4">
                    <div class="border-solid rounded p-2 border-2 border-borderline-100">
                    <svg xmlns="http://www.w3.org/2000/svg" height="40px" viewBox="0 -960 960 960" width="40px" fill="#434343">
                        <path d="m658-120-10.67-64q-15.33-5-30.5-13.17Q601.67-205.33 590-216l-56 14-30-50.67 46.67-42.66q-2-10.67-2-25.34 0-14.66 2-25.33L504-388.67l30-50.66 56 14q11.67-10.67 26.83-18.84 15.17-8.16 30.5-13.16l10.67-64h62.67l10.66 64q15.34 5 30.5 13.33 15.17 8.33 26.84 19.33l56-14.66 30 51.33L828-345.33q2 10 2 25t-2 25l46.67 42.66-30 50.67-56-14q-11.67 10.67-26.84 18.83-15.16 8.17-30.5 13.17l-10.66 64H658ZM80-162.67v-100q0-34.33 17.33-62.66 17.34-28.34 49.34-43.34 65-30 127.33-45.33 62.33-15.33 126-15.33h12.33q5.67 0 11.67.66-23.67 58-20.67 137.34 3 79.33 38.67 128.66H80Zm609.33-78q35 0 57.5-22.5t22.5-57.5q0-35-22.5-57.5t-57.5-22.5q-35 0-57.5 22.5t-22.5 57.5q0 35 22.5 57.5t57.5 22.5ZM400-483.33q-66 0-109.67-43.67-43.66-43.67-43.66-109.67t43.66-109.66Q334-790 400-790t109.67 43.67q43.66 43.66 43.66 109.66T509.67-527Q466-483.33 400-483.33Z"/>
                    </svg>
                    </div>
                    
                    <div class="ml-4">
                        <div class="self-center">
                            <p class="text-gray-400 text-sm">Probation</p>
                            <span class="text-2xl font-semibold text-gray-800">200</span>
                        </div>
                    </div>
                </div>

                <div class="flex items-center text-lg p-4">
                    <div class="border-solid rounded p-2 border-2 border-borderline-100">
                    <svg xmlns="http://www.w3.org/2000/svg" height="40px" viewBox="0 -960 960 960" width="40px" fill="#434343">
                        <path d="m805.67-59-101-101H160v-100q0-36.67 18.5-64.17T226.67-366q55-25.67 107.5-40.33Q386.67-421 440-424.67l-381-381 47.67-47.66 746.66 746.66L805.67-59Zm-73-307q30.33 14 48.66 41.5Q799.67-297 800-260.67v5.34l-140-140q18 6.33 36.17 13.66 18.16 7.34 36.5 15.67ZM556-499.33 345.33-710q20.34-36.67 56.34-57T480-787.33q64 0 108.67 44.66Q633.33-698 633.33-634q0 42.33-20.33 78.33t-57 56.34Z"/>
                    </svg>
                    </div>
                    
                    <div class="ml-4">
                        <div class="self-center">
                            <p class="text-gray-400 text-sm">On Leave</p>
                            <span class="text-2xl font-semibold text-gray-800">200</span>
                        </div>
                    </div>
                </div> 
            </div>

            <div class="col-span-1 rounded-md border border-stroke bg-white shadow-default dark:border-strokedark divide-y">
                <h1 class="text-xl text-center text-slate-800 dark:text-slate-100 font-bold p-4">Employee & Client Overview</h1>
                <div class="flex items-center justify-center text-lg p-2">
                    <div class="flex flex-col items-center">
                    <div class="flex justify-start rounded p-2">
                        <svg xmlns="http://www.w3.org/2000/svg" height="38px" viewBox="0 -960 960 960" width="38x" fill="#434343">
                            <path d="M0-240v-63q0-43 44-70t116-27q13 0 25 .5t23 2.5q-14 21-21 44t-7 48v65H0Zm240 0v-65q0-32 17.5-58.5T307-410q32-20 76.5-30t96.5-10q53 0 97.5 10t76.5 30q32 20 49 46.5t17 58.5v65H240Zm540 0v-65q0-26-6.5-49T754-397q11-2 22.5-2.5t23.5-.5q72 0 116 26.5t44 70.5v63H780ZM160-440q-33 0-56.5-23.5T80-520q0-34 23.5-57t56.5-23q34 0 57 23t23 57q0 33-23 56.5T160-440Zm640 0q-33 0-56.5-23.5T720-520q0-34 23.5-57t56.5-23q34 0 57 23t23 57q0 33-23 56.5T800-440Zm-320-40q-50 0-85-35t-35-85q0-51 35-85.5t85-34.5q51 0 85.5 34.5T600-600q0 50-34.5 85T480-480Z"/>
                        </svg>
                    </div>
                        <p class="text-gray-400 text-sm">Employee</p>
                        <span class="text-2xl font-bold text-gray-800 mb-2">200</span>
                        <div class="flex items-center justify-between gap-22 mt-2">
                            <div class="flex items-center gap-2">
                                <span class="block h-4 w-4 rounded-full border-8 border-accent-100"></span>
                                <span class="text-gray-400 text-sm">Monthly</span>
                            </div>
                            <span class="inline-block rounded-md bg-accent-100 px-1.5 py-0.5 text-xs font-medium text-white">10%</span>
                        </div>

                    </div>
                    
                </div>

                <div class="flex items-center justify-center text-lg p-2">
                    <div class="flex flex-col items-center">
                    <div class="flex justify-start rounded p-2">
                        <svg xmlns="http://www.w3.org/2000/svg" height="38px" viewBox="0 -960 960 960" width="38x" fill="#434343">
                            <path d="M0-240v-63q0-43 44-70t116-27q13 0 25 .5t23 2.5q-14 21-21 44t-7 48v65H0Zm240 0v-65q0-32 17.5-58.5T307-410q32-20 76.5-30t96.5-10q53 0 97.5 10t76.5 30q32 20 49 46.5t17 58.5v65H240Zm540 0v-65q0-26-6.5-49T754-397q11-2 22.5-2.5t23.5-.5q72 0 116 26.5t44 70.5v63H780ZM160-440q-33 0-56.5-23.5T80-520q0-34 23.5-57t56.5-23q34 0 57 23t23 57q0 33-23 56.5T160-440Zm640 0q-33 0-56.5-23.5T720-520q0-34 23.5-57t56.5-23q34 0 57 23t23 57q0 33-23 56.5T800-440Zm-320-40q-50 0-85-35t-35-85q0-51 35-85.5t85-34.5q51 0 85.5 34.5T600-600q0 50-34.5 85T480-480Z"/>
                        </svg>
                    </div>
                        <p class="text-gray-400 text-sm">Clients</p>
                        <span class="text-2xl font-bold text-gray-800 mb-2">200</span>
                        <div class="flex items-center justify-between gap-22 mt-2">
                            <div class="flex items-center gap-2">
                                <span class="block h-4 w-4 rounded-full border-8 border-accent-100"></span>
                                <span class="text-gray-400 text-sm">Monthly</span>
                            </div>
                            <span class="inline-block rounded-md bg-accent-100 px-1.5 py-0.5 text-xs font-medium text-white">10%</span>
                        </div>
                        <div class="flex items-center justify-between gap-22 mt-2">
                            <div class="flex items-center gap-2">
                                <span class="block h-4 w-4 rounded-full border-8 border-primary-100"></span>
                                <span class="text-gray-400 text-sm">Daily</span>
                            </div>
                            <span class="inline-block rounded-md bg-primary-100 px-1.5 py-0.5 text-xs font-medium text-white">20%</span>
                        </div>

                    </div>
                    
                </div>
            </div>   
        </div>
    </div>


    <div class="px-4 w-full max-w-9xl mx-auto mt-4">
        <div class="grid grid-cols-2 gap-4 xl:grid-cols-2 2xl:gap-7.5">
            <div class="">
                <!-- Header Section -->
                
                {{-- <p class="text-gray-500 text-sm mb-4">1</p> --}}

                <!-- Announcement Cards -->
                <div
                    class="col-span-full xl:col-span-6 bg-white rounded-lg border border-slate-200 shadow-[0px_8px_20px_rgba(0,0,0,0.08)] p-6 mb-4">
                    <!-- Header Section -->
                    <div class="flex justify-between items-center mb-4">
                        <h2 class="font-semibold text-slate-800 dark:text-slate-100">Announcements</h2>
                        <span class="bg-blue-100 text-blue-600 text-sm px-3 py-1 rounded-lg">Today,
                            {{ $currentDate }}</span>
                    </div>
                    <p class="text-gray-500 text-sm mb-4">{{ $activeCount }} active
                        announcement{{ $activeCount != 1 ? 's' : '' }}</p>

                    <!-- Announcement Cards -->
                    <div class="space-y-4">
                        <!-- Card 1 -->
                        <div class="max-h-80 overflow-y-auto">
    @foreach ($announcements as $announcement)
        <div onclick="openModal({{ $announcement->id }})"
            class="bg-white rounded-lg shadow p-4 flex items-end justify-between mb-4">
            <div>
                <p class="text-gray-400 text-xs mb-1">
                    {{ $announcement->created_at->diffForHumans() }}
                </p>
                <h3 class="text-gray-800 font-semibold mb-4">{{ $announcement->title }}</h3>
                <div class="flex items-center space-x-2">
                    <!-- Icon -->
                    <svg xmlns="http://www.w3.org/2000/svg" height="24px"
                        viewBox="0 -960 960 960" width="24px" fill="#789DE5">
                        <path
                            d="M760-200H320q-33 0-56.5-23.5T240-280v-560q0-33 23.5-56.5T320-920h280l240 240v400q0 33-23.5 56.5T760-200ZM560-640v-200H320v560h440v-360H560ZM160-40q-33 0-56.5-23.5T80-120v-560h80v560h440v80H160Zm160-800v200-200 560-560Z" />
                    </svg>
                    <!-- Text -->
                    <span class="text-gray-500 text-sm">{{ $announcement->subject }}</span>
                </div>
            </div>
            <div class="flex items-center space-y-2">
                <div class="shrink-0 self-end ml-2">
                    <a class="font-medium text-indigo-500 hover:text-indigo-600 dark:hover:text-indigo-400"
                        href="#0">View<span class="hidden sm:inline"> -&gt;</span></a>
                </div>
            </div>
        </div>
    @endforeach
</div>


                        <!-- Modal Overlay -->
                        <div id="modal-overlay"
                            class="hidden fixed inset-0 bg-gray-900 bg-opacity-50 flex items-center justify-center">
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
                                        <div
                                            class="bg-gray-100 border border-gray-200 rounded-lg p-3 flex items-center space-x-2">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                                                viewBox="0 0 24 24" width="24" height="24"
                                                class="text-gray-600">
                                                <path
                                                    d="M6 2h9l5 5v13c0 1.1-.9 2-2 2H6c-1.1 0-2-.9-2-2V4c0-1.1.9-2 2-2zm5 1.5v4h4.5L11 3.5zm1 13.5h-1.5v-1.5H10v1.5H8.5v-3H10v1.5h1.5v-1.5h1.5v3zm4.5 0H15v-1.5h1.5v-1.5H15v-1.5h2.5V17zm-6-1.5h1.5V17H11v-1.5zm6-6H7V4h5v5h5v3z" />
                                            </svg>
                                            <span class="text-gray-600 text-sm">loanfiles.pdf (7kb)</span>
                                            <a href="#"
                                                class="text-blue-500 hover:text-blue-600 ml-auto">Download</a>
                                        </div>
                                        <div
                                            class="bg-gray-100 border border-gray-200 rounded-lg p-3 flex items-center space-x-2">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                                                viewBox="0 0 24 24" width="24" height="24"
                                                class="text-gray-600">
                                                <path
                                                    d="M6 2h9l5 5v13c0 1.1-.9 2-2 2H6c-1.1 0-2-.9-2-2V4c0-1.1.9-2 2-2zm5 1.5v4h4.5L11 3.5zm1 13.5h-1.5v-1.5H10v1.5H8.5v-3H10v1.5h1.5v-1.5h1.5v3zm4.5 0H15v-1.5h1.5v-1.5H15v-1.5h2.5V17zm-6-1.5h1.5V17H11v-1.5zm6-6H7V4h5v5h5v3z" />
                                            </svg>
                                            <span class="text-gray-600 text-sm">loanfiles2.pdf (7kb)</span>
                                            <a href="#"
                                                class="text-blue-500 hover:text-blue-600 ml-auto">Download</a>
                                        </div>
                                    </div>
                                </div>
                                <!-- Close Button -->
                                <div class="flex justify-end mt-4">
                                    <button onclick="closeModal()"
                                        class="text-white bg-blue-500 hover:bg-blue-600 font-medium rounded-lg text-sm px-4 py-2">Close</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>   

            <div class="bg-white rounded-lg border border-slate-200 shadow-[0px_8px_20px_rgba(0,0,0,0.08)] mb-4">
                <header class="px-5 py-4 border-b border-slate-100 dark:border-slate-700">
                    <h2 class="font-semibold text-slate-800 dark:text-slate-100">Recent Logs</h2>
                </header>
                <div class="p-3 max-h-96 overflow-y-auto">
                    @foreach ($logs as $log)
                        <div>
                            <header class="text-xs uppercase text-slate-400 dark:text-slate-500 bg-slate-50 dark:bg-slate-700 dark:bg-opacity-50 rounded-sm font-semibold p-2">
                                {{ $log->created_at->toDateString() }}
                            </header>
                            <ul class="my-1">
                                <!-- Item -->
                                <li class="flex px-2">
                                    <div class="w-9 h-9 rounded-full shrink-0 bg-indigo-500 my-2 mr-3">
                                        <svg class="w-9 h-9 fill-current text-indigo-50" viewBox="0 0 36 36">
                                            <path d="M18 10c-4.4 0-8 3.1-8 7s3.6 7 8 7h.6l5.4 2v-4.4c1.2-1.2 2-2.8 2-4.6 0-3.9-3.6-7-8-7zm4 10.8v2.3L18.9 22H18c-3.3 0-6-2.2-6-5s2.7-5 6-5 6 2.2 6 5c0 2.2-2 3.8-2 3.8z"/>
                                        </svg>
                                    </div>
                                    <div class="grow flex items-center border-b border-slate-100 dark:border-slate-700 text-sm py-2">
                                        <div class="grow flex justify-between">
                                            <div class="self-center">
                                                <a class="font-medium text-slate-800 hover:text-slate-900 dark:text-slate-100 dark:hover:text-white" href="#0">
                                                    <p>{{ $log->user->name }}</p>
                                                    <span class="text-gray-400 text-xs">{{ $log->description }}</span>
                                                </a>
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
        <div class="grid grid-cols-12 gap-6 mt-4 mb-4">
            <!-- Leave Request -->
            <div
                class="col-span-full xl:col-span-6 bg-white rounded-lg border border-slate-200 shadow-[0px_8px_20px_rgba(0,0,0,0.08)] mb-4">
                <header class="px-5 py-4 border-b border-slate-100 dark:border-slate-700">
                    <h2 class="font-semibold text-slate-800 dark:text-slate-100">Leave Request</h2>
                </header>
                <div class="p-3">

                    <!-- Table -->
                    <div class="overflow-x-auto">
                        <table class="table-auto w-full">
                            <!-- Table body -->
                            <tbody class="text-sm divide-y divide-slate-100 dark:divide-slate-700">
                                <tr>
                                    <td class="p-2 whitespace-nowrap">
                                        <div class="flex items-center">
                                            <div class="w-10 h-10 shrink-0 mr-2 sm:mr-3">
                                                <img class="rounded-full" src="{{ asset('images/user-36-05.jpg') }}"
                                                    width="40" height="40" alt="Alex Shatov" />
                                            </div>
                                            <div class="font-medium text-slate-800"> Kent Paul</div>
                                        </div>
                                    </td>
                                    <td class="p-2 whitespace-nowrap">
                                        <div class="text-lg text-end text-sm">
                                            <a class="font-medium text-green-500 hover:text-indigo-600 dark:hover:text-indigo-400"
                                                href="#0">Leave Request<span class="hidden sm:inline"></span></a>
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>

                    </div>

                </div>
            </div>

            <!-- Probation Reminder -->
            <div
                class="col-span-full xl:col-span-6 bg-white rounded-lg border border-slate-200 shadow-[0px_8px_20px_rgba(0,0,0,0.08)] mb-4">
                <header class="px-5 py-4 border-b border-slate-100 dark:border-slate-700">
                    <h2 class="font-semibold text-slate-800 dark:text-slate-100">Probation Reminder</h2>
                </header>
                <div class="p-3">

                    <!-- Table -->
                    <div class="overflow-x-auto">
                        <table class="table-auto w-full">
                            <!-- Table body -->
                            <tbody class="text-sm divide-y divide-slate-100 dark:divide-slate-700">
                                <tr>
                                    <td class="p-2 whitespace-nowrap">
                                        <div class="flex items-center">
                                            <div class="w-10 h-10 shrink-0 mr-2 sm:mr-3">
                                                <img class="rounded-full" src="{{ asset('images/user-36-05.jpg') }}"
                                                    width="40" height="40" alt="Alex Shatov" />
                                            </div>
                                            <div class="font-medium text-slate-800"> JP Tiu</div>
                                        </div>
                                    </td>
                                    <td class="p-2 whitespace-nowrap">
                                        <div class="text-lg text-end text-red-500 text-sm">5 days remaining</div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>

                    </div>

                </div>
            </div>
        </div>

        <!-- Cards -->
        <div
            class="col-span-full xl:col-span-6 bg-white rounded-lg border border-slate-200 shadow-[0px_8px_20px_rgba(0,0,0,0.08)] mb-12">
            <header
                class="flex items-center justify-between px-5 py-4 border-b border-slate-100 dark:border-slate-700">
                <h2 class="font-semibold text-slate-800 dark:text-slate-100">Employee Lists</h2>
                <div class="grid grid-flow-col sm:auto-cols-max justify-start sm:justify-end gap-2">

                    <!-- Filter button -->
                    <x-dropdown-filter align="right" />

                    <!-- Add view button -->
                    <!-- <a href="{{ route('customer.add') }}" class="btn bg-indigo-500 hover:bg-indigo-600 text-white">
                    <svg class="w-4 h-4 fill-current opacity-50 shrink-0" viewBox="0 0 16 16">
                        <path
                            d="M15 7H9V1c0-.6-.4-1-1-1S7 .4 7 1v6H1c-.6 0-1 .4-1 1s.4 1 1 1h6v6c0 .6.4 1 1 1s1-.4 1-1V9h6c.6 0 1-.4 1-1s-.4-1-1-1z" />
                    </svg>
                    <span class="hidden xs:block ml-2">Add Employee</span>
                </a> -->

                </div>
            </header>

            <section class="container mx-auto">
                <div class="flex flex-col">
                    <div class="-mx-4 -my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                        <div class="inline-block min-w-full py-2 align-middle md:px-6 lg:px-8">
                            <div class="overflow-hidden ">
                                <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                                    <thead class="bg-gray-50">
                                        <tr>
                                            <th scope="col"
                                                class="px-4 py-3.5 text-sm font-normal text-left rtl:text-right text-gray-500 dark:text-gray-400">
                                                Employee ID
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
                                                Position
                                            </th>

                                            <th scope="col"
                                                class="px-4 py-3.5 text-sm font-normal text-left rtl:text-right text-gray-500 dark:text-gray-400">
                                                Status
                                            </th>

                                            <th scope="col"
                                                class="px-4 py-3.5 text-sm font-normal text-left rtl:text-right text-gray-500 dark:text-gray-400">
                                                Action
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
                                                    class="px-4 py-4 text-sm text-gray-500 dark:text-gray-300 whitespace-nowrap">
                                                    {{ $list->f_name }} {{ $list->l_name }}
                                                </td>
                                                <td
                                                    class="px-4 py-4 text-sm text-gray-500 dark:text-gray-300 whitespace-nowrap">
                                                    {{ $list->present_address }}
                                                </td>
                                                <td
                                                    class="px-4 py-4 text-sm text-gray-500 dark:text-gray-300 whitespace-nowrap">
                                                    {{ $list->position_desired }}
                                                </td>
                                                <td
                                                    class="px-4 py-4 text-sm text-gray-500 dark:text-gray-300 whitespace-nowrap">

                                                </td>
                                                <td class="px-4 py-4 text-sm whitespace-nowrap">
                                                    <div class="flex items-center gap-x-6">
                                                        <button
                                                            class="text-gray-500 transition-colors duration-200 dark:hover:text-indigo-500 dark:text-gray-300 hover:text-indigo-500 focus:outline-none">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="16"
                                                                height="16" fill="currentColor" class="bi bi-eye"
                                                                viewBox="0 0 16 16">
                                                                <path
                                                                    d="M16 8s-3-5.5-8-5.5S0 8 0 8s3 5.5 8 5.5S16 8 16 8M1.173 8a13 13 0 0 1 1.66-2.043C4.12 4.668 5.88 3.5 8 3.5s3.879 1.168 5.168 2.457A13 13 0 0 1 14.828 8q-.086.13-.195.288c-.335.48-.83 1.12-1.465 1.755C11.879 11.332 10.119 12.5 8 12.5s-3.879-1.168-5.168-2.457A13 13 0 0 1 1.172 8z" />
                                                                <path
                                                                    d="M8 5.5a2.5 2.5 0 1 0 0 5 2.5 2.5 0 0 0 0-5M4.5 8a3.5 3.5 0 1 1 7 0 3.5 3.5 0 0 1-7 0" />
                                                            </svg>
                                                        </button>

                                                        <a href="{{ route('employee.show', $list->id) }}"
                                                            class="text-gray-500 transition-colors duration-200 dark:hover:text-indigo-500 dark:text-gray-300 hover:text-indigo-500 focus:outline-none">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="16"
                                                                height="16" fill="currentColor"
                                                                class="bi bi-pencil" viewBox="0 0 16 16">
                                                                <path
                                                                    d="M12.146.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1 0 .708l-10 10a.5.5 0 0 1-.168.11l-5 2a.5.5 0 0 1-.65-.65l2-5a.5.5 0 0 1 .11-.168zM11.207 2.5 13.5 4.793 14.793 3.5 12.5 1.207zm1.586 3L10.5 3.207 4 9.707V10h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.293zm-9.761 5.175-.106.106-1.528 3.821 3.821-1.528.106-.106A.5.5 0 0 1 5 12.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.468-.325" />
                                                            </svg>
                                                        </a>

                                                        <form action="{{ route('customer.destroy', $list->id) }}"
                                                            method="post">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit"
                                                                class="text-gray-500 mt-1 transition-colors duration-200 dark:hover:text-indigo-500 dark:text-gray-300 hover:text-indigo-500 focus:outline-none">
                                                                <svg xmlns="http://www.w3.org/2000/svg" width="16"
                                                                    height="16" fill="currentColor"
                                                                    class="bi bi-trash" viewBox="0 0 16 16">
                                                                    <path
                                                                        d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5m2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5m3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0z" />
                                                                    <path
                                                                        d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4zM2.5 3h11V2h-11z" />
                                                                </svg>
                                                            </button>
                                                        </form>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
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
</x-app-layout>

<script>
    // JavaScript to open and close the modal
    function openModal(id) {
        const announcement = @json($announcements).find(a => a.id == id);
        document.getElementById("modal-title").textContent = announcement.title;
        document.getElementById("modal-content").innerHTML = announcement.content;
        document.getElementById("modal-overlay").classList.remove("hidden");
    }

    function closeModal() {
        document.getElementById("modal-overlay").classList.add("hidden");
    }
</script>