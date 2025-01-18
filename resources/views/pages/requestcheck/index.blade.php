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
            <h1 class="text-2xl md:text-2xl text-slate-800 dark:text-slate-100 font-bold mb-4">Request Check</h1>
        </div>

        <!-- Dashboard actions -->
        <div class="sm:flex sm:justify-between sm:items-center mb-4">
            <div></div>

            <!-- Right: Actions -->
            <div class="grid grid-flow-col sm:auto-cols-max justify-start sm:justify-end gap-2">

                <!-- Filter button -->

                <!-- <x-dropdown-filter align="right" /> -->

                <!-- Add view button -->

                <div id="modal" class="relative z-10 hidden" aria-labelledby="modal-title" role="dialog"
                    aria-modal="true">
                    <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" aria-hidden="true"></div>

                    <div class="fixed inset-0 z-10 w-screen overflow-y-auto">
                        <div class="flex min-h-full items-end justify-center p-4 text-center sm:items-center sm:p-0">
                            <div
                                class="relative transform overflow-hidden rounded-lg bg-white text-left shadow-xl transition-all sm:my-8 sm:w-full sm:max-w-lg">
                                <form action="{{ route('barangay.importcsv') }}" method="POST"
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
                                                    id="modal-title">Import Barangay</h3>
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

        <div>
            <div
                class="px-4 sm:px-6 lg:px-8 py-8 w-full max-w-9xl mx-auto bg-white rounded shadow-lg p-4 px-4 md:p-8 mb-6">
                <h2 class="mb-4">Branch Manager: Request Check</h2>

                <!-- Form -->
                <form action="{{ route('requestcheck.store') }}" method="POST" class="mb-6">
                    @csrf
                    
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                        <!-- Date -->

                        <style>
                            /* Custom Flatpickr styling for selected dates */
                            .flatpickr-day.selected, .flatpickr-day.selected:hover {
                            background-color: #6366F1; /* Indigo color */
                            color: #fff;
                            border-radius: 6px;
                            }
                            .flatpickr-day.inRange {
                            background-color: #A5B4FC; /* Light Indigo for in-between dates */
                            color: #fff;
                            border-radius: 6px;
                            }

                            .flatpickr-current-month{
                                font-size: 10px;
                            }
                        </style>
                        <!-- Include Flatpickr CSS -->
                        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">

                        <div>
                            <label for="request_date" class="block mb-1">Date</label>
                            <input type="date" name="request_date" id="request_date"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-2 p-2.5"
                                required>
                        </div>
                        <!-- Amount -->
                        <div>
                            <label for="amount" class="block mb-1">Amount</label>
                            <input type="number" step="0.01" name="amount" id="amount"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-2 p-2.5"
                                required>
                        </div>
                        <!-- Submit Button -->
                        <div class="flex items-end">
                            
                            <!-- Add Row Button -->
                            <div class="mt-4 text-right">
                                <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">
                                    Submit
                                </button>
                            </div>
                        </div>      
                    </div>

                    <!-- Total Section -->
                    <div class="mt-6 text-left">
                        <h2 class="text-lg font-bold text-gray-700">Total: ₱<span id="total-amount">0.00</span></h2>
                    </div>
                    <!-- Submit Button -->
                    <!-- <div class="mt-6">
                            <button type="submit" class="w-full px-4 py-2 text-white bg-green-500 rounded-md hover:bg-green-600">
                                Submit Check Requests
                            </button>
                        </div> -->
                </form>

                <!-- Display Requested Checks -->
                <h3 class="mb-2">Requested Checks</h3>
                <table class="table-auto border-collapse border border-gray-200 w-full">
                    <thead>
                        <tr>
                            @can('hr_access')
                                <th class="border px-4 py-2">Action</th>
                                <th class="border px-4 py-2">Print</th>
                            @endcan
                            <th class="border px-4 py-2">Date</th>
                            <th class="border px-4 py-2">Amount</th>
                            <th class="border px-4 py-2">Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($lists as $list)
                            <tr>
                                @can('hr_access')
                                <td class="px-4 py-4 text-sm whitespace-nowrap">
                                    <div class="flex items-center gap-x-6">
                                        <a href="{{ route('requestcheck.approve', $list->id)}}"
                                            class="bg-green-400 text-white hover:bg-green-600 flex items-center gap-x-2 px-4 py-2 font-semibold rounded-md"
                                            aria-label="Approve" title="Approve">
                                            <svg class="icon-fill" xmlns="http://www.w3.org/2000/svg" height="20px" viewBox="0 -960 960 960" width="20px">
                                                <path d="M389-267 195-460l51-52 143 143 325-324 51 51-376 375Z" />
                                            </svg>
                                            <span class="hidden xs:block ml-2">Approve</span>
                                        </a>
                                        <a href="{{route('requestcheck.reject', $list->id)}}"
                                            class="bg-red-400 text-white hover:bg-red-600 flex items-center gap-x-2 px-4 py-2 font-semibold rounded-md"
                                            aria-label="Reject" title="Reject">
                                            <svg class="icon-fill" xmlns="http://www.w3.org/2000/svg" height="20px" viewBox="0 -960 960 960" width="20px">
                                                <path d="m291-240-51-51 189-189-189-189 51-51 189 189 189-189 51 51-189 189 189 189-51 51-189-189-189 189Z" />
                                            </svg>
                                            <span class="hidden xs:block ml-2">Reject</span>
                                        </a>
                                    </div>
                                </td>
                                <td class="border px-4 py-2 text-center">
                                    <a href="{{ route('printCheck.index', $list->id) }}"
                                        class="text-gray-500 transition-colors duration-200 dark:hover:text-indigo-500 dark:text-gray-300 hover:text-indigo-500 focus:outline-none">
                                        <svg xmlns="http://www.w3.org/2000/svg" height="20px" viewBox="0 -960 960 960" width="20px" fill="#6b7280"><path d="M648-624v-120H312v120h-72v-192h480v192h-72Zm-480 72h625-625Zm539.79 96q15.21 0 25.71-10.29t10.5-25.5q0-15.21-10.29-25.71t-25.5-10.5q-15.21 0-25.71 10.29t-10.5 25.5q0 15.21 10.29 25.71t25.5 10.5ZM648-216v-144H312v144h336Zm72 72H240v-144H96v-240q0-40 28-68t68-28h576q40 0 68 28t28 68v240H720v144Zm73-216v-153.67Q793-530 781-541t-28-11H206q-16.15 0-27.07 11.04Q168-529.92 168-513.6V-360h72v-72h480v72h73Z"/></svg>
                                    </a>
                                </td>
                                @endcan
                                <td class="border px-4 py-2 w-1/2 text-center">{{ $list->request_date }}</td>
                                <td class="border px-4 py-2 w-1/2 text-center">{{ number_format($list->amount, 2) }}</td>
                                <td class="border px-4 py-2 text-center">{{ $list->status }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="3" class="border px-4 py-2 text-center">No requests found.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>


        </div>

    </div>


    


</x-app-layout>
<script>
    function openModal() {
        const modal = document.getElementById('myModal');
        const modalContent = document.getElementById('modalContent');
        modal.classList.remove('hidden');
        modalContent.classList.add('animate-fade-in-down');
    }

    function closeModal() {
        const modal = document.getElementById('myModal');
        const modalContent = document.getElementById('modalContent');
        modalContent.classList.remove('animate-fade-in-down');
        modal.classList.add('hidden');
    }

    document.addEventListener('animationend', (event) => {
        const modal = document.getElementById('myModal');
        if (event.animationName === 'fade-in-down' && event.target.id === 'modalContent') {
            modal.classList.remove('hidden');
        }
    });

    document.addEventListener('animationstart', (event) => {
        const modalContent = document.getElementById('modalContent');
        if (event.animationName === 'fade-in-down' && event.target.id === 'modalContent') {
            modalContent.classList.add('animate-fade-in-down');
        }
    });
</script>

<style>
    @keyframes fade-in-down {
        0% {
            opacity: 0;
            transform: translateY(-20px);
        }
        100% {
            opacity: 1;
            transform: translateY(0);
        }
    }
    
    .animate-fade-in-down {
        animation: fade-in-down 0.5s ease-out;
    }
</style>

 <!-- Include Flatpickr JS -->
 <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
<script>
    flatpickr("#request_date", {
        mode: "multiple",
        dateFormat: "Y-m-d",
        minDate: "today", // Optional: disable past dates
        minDate: null, // Allow past dates
        maxDate: null, // No upper limit
    });
</script>
