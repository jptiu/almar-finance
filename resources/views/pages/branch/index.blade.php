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

            <div class="rounded-md border border-stroke bg-white p-4 shadow-default dark:border-strokedark dark:bg-boxdark md:p-6 xl:p-7.5">
                <div class="flex items-center justify-center ">
                    <div>
                        <h2 class="text-xl text-slate-800 dark:text-slate-100 font-bold mb-8">Latest Payer vs Late Payee</h2>
                        <canvas id="pieChart" class="w-64 h-64"></canvas>
                    </div>
                </div>
            </div>
            
        </div>
    </div>


    <div class="px-4 w-full max-w-9xl mx-auto mt-4">
        <div class="grid grid-cols-2 gap-4 xl:grid-cols-2 2xl:gap-7.5">
            <div class="bg-white rounded-lg border border-slate-200 shadow-[0px_8px_20px_rgba(0,0,0,0.08)] p-6 mb-4">
                <!-- Header Section -->
                <div class="flex justify-between items-center mb-4">
                    <h2 class="font-semibold text-slate-800 dark:text-slate-100">Announcements</h2>
                    <span class="bg-blue-100 text-blue-600 text-sm px-3 py-1 rounded-lg">Today, December 12,
                        2024</span>
                </div>
                {{-- <p class="text-gray-500 text-sm mb-4">1</p> --}}

                <!-- Announcement Cards -->
                <div class="space-y-4">
                    <!-- Card 1 -->

                    <div class="max-h-96 overflow-y-auto p-3">
                        <div onclick="/" class="bg-white rounded-lg shadow p-4 flex items-end justify-between mb-4">
                            <div>
                                <p class="text-gray-400 text-xs mb-1">Tasks</p>
                                <h3 class="text-gray-800 font-semibold mb-4">Task Title</h3>
                                <div class="flex items-center space-x-2">
                                    <!-- Icon -->
                                    <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960"
                                        width="24px" fill="#789DE5">
                                        <path
                                            d="M760-200H320q-33 0-56.5-23.5T240-280v-560q0-33 23.5-56.5T320-920h280l240 240v400q0 33-23.5 56.5T760-200ZM560-640v-200H320v560h440v-360H560ZM160-40q-33 0-56.5-23.5T80-120v-560h80v560h440v80H160Zm160-800v200-200 560-560Z" />
                                    </svg>
                                    <!-- Text -->
                                    <span class="text-gray-500 text-sm">Collect Payment</span>
                                </div>
                            </div>
                            <div class="flex items-center space-y-2">
                                <div class="shrink-0 self-end ml-2">
                                    <a class="font-medium text-indigo-500 hover:text-indigo-600 dark:hover:text-indigo-400"
                                        href="#0">View<span class="hidden sm:inline"> -&gt;</span></a>
                                </div>
                            </div>
                        </div>
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
        backgroundColor: ['#000D3A', '#0B6ECA'], // Tailwind green and red colors
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
