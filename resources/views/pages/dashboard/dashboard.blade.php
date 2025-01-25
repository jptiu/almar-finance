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
        <div class="grid grid-cols-3 gap-4 xl:grid-cols-3 2xl:gap-7.5">

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
