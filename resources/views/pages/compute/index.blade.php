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
            <h1 class="text-2xl md:text-2xl text-slate-800 dark:text-slate-100 font-bold mb-4">Compute Cash on Hand
            </h1>
        </div>

        <div></div>

        <!-- Dashboard actions -->
        

        <!-- Cards -->
        <section class="container">
            <div class="p-6 w-full max-w-[1500px] mx-auto bg-white rounded-lg border border-bgbody-200">
                <!-- Right: Actions -->
                <div class="grid grid-flow-col sm:auto-cols-max justify-start sm:justify-end gap-2 mb-4">
        
                    <!-- Add view button -->
                    <a href="{{ route('compute.create') }}" class="btn bg-indigo-500 hover:bg-indigo-600 text-white rounded-full px-6 py-3 flex items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-circle-plus"><circle cx="12" cy="12" r="10"/><path d="M8 12h8"/><path d="M12 8v8"/></svg>
                        <span class="hidden xs:block ml-2">New</span>
                    </a>
                    <a id="show-modal" href="#" class="btn bg-indigo-500 hover:bg-indigo-600 text-white rounded-full px-6 py-3 flex items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-circle-plus">
                            <circle cx="12" cy="12" r="10"/>
                            <path d="M8 12h8"/>
                            <path d="M12 8v8"/>
                        </svg>
                        <span class="hidden xs:block ml-2">Import</span>
                    </a>
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
                                                        id="modal-title">Import Compute Cash on Hand</h3>
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
                <table class="w-full border-collapse text-left text-sm rounded-md overflow-hidden border border-black">
                    <thead class="bg-bgbody-100 rounded-2xl w-full">
                        <tr class=" text-fonts-100 font-extrabold">
                            <th class="p-4 text-fonts-100 font-normal">Ref No.</th>
                            <th class="p-4 text-fonts-100 font-normal">Prev Transaction</th>
                            <th class="p-4 text-fonts-100 font-normal">Today's Transaction</th>
                            <th class="p-4 text-fonts-100 font-normal">Cash Beginning</th>
                            <th class="p-4 text-fonts-100 font-normal">Collection</th>
                            <th class="p-4 text-fonts-100 font-normal">Total</th>
                            <th class="p-4 text-fonts-100 font-normal">Action</th>
                        </tr>
                    </thead>
                    <tbody class="text-gray-600 font-semibold text-sm">
                        @foreach ($lists as $list)
                        <tr class="border-b hover:bg-gray-50">
                            <td
                                class="p-4">
                                {{ $list->id }}
                            </td>
                            <td
                                class="p-4">
                                {{ $list->prev_transaction_date }}
                            </td>
                            <td
                                class="p-4">
                                {{ $list->transaction_date }}
                            </td>
                            <td
                                class="p-4">
                                {{ $list->cash_beginning }}
                            </td>
                            <td
                                class="p-4">
                                {{ $list->collection }}
                            </td>
                            <td
                                class="p-4">
                                
                            </td>
                            <td class="px-4 py-4 text-sm whitespace-nowrap">
                                <div class="flex items-center gap-x-6">
        
                                    {{-- <a href="{{ route('compute.show') }}"
                                        class="text-gray-500 transition-colors duration-200 dark:hover:text-indigo-500 dark:text-gray-300 hover:text-indigo-500 focus:outline-none">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16"
                                            height="16" fill="currentColor" class="bi bi-eye"
                                            viewBox="0 0 16 16">
                                            <path
                                                d="M16 8s-3-5.5-8-5.5S0 8 0 8s3 5.5 8 5.5S16 8 16 8M1.173 8a13 13 0 0 1 1.66-2.043C4.12 4.668 5.88 3.5 8 3.5s3.879 1.168 5.168 2.457A13 13 0 0 1 14.828 8q-.086.13-.195.288c-.335.48-.83 1.12-1.465 1.755C11.879 11.332 10.119 12.5 8 12.5s-3.879-1.168-5.168-2.457A13 13 0 0 1 1.172 8z" />
                                            <path
                                                d="M8 5.5a2.5 2.5 0 1 0 0 5 2.5 2.5 0 0 0 0-5M4.5 8a3.5 3.5 0 1 1 7 0 3.5 3.5 0 0 1-7 0" />
                                        </svg>
                                    </a> --}}
        
                                    <a id="open-modal" href="{{ route('compute.edit', $list->id) }}"
                                        class="text-gray-500 transition-colors duration-200 dark:hover:text-indigo-500 dark:text-gray-300 hover:text-indigo-500 focus:outline-none">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-pencil"><path d="M21.174 6.812a1 1 0 0 0-3.986-3.987L3.842 16.174a2 2 0 0 0-.5.83l-1.321 4.352a.5.5 0 0 0 .623.622l4.353-1.32a2 2 0 0 0 .83-.497z"/><path d="m15 5 4 4"/></svg>
                                    </a>
        
                                    <!-- Modal -->
                                    <div id="modal" class="fixed inset-0 z-50 hidden bg-gray-800 bg-opacity-50 flex items-center justify-center">
                                        <!-- Modal Content -->
                                        <div class="fixed inset-0 z-10 w-screen overflow-y-auto">
                                            <div class="flex min-h-full items-end justify-center p-4 text-center sm:items-center sm:p-0">
                                                <div class="relative transform overflow-hidden rounded-lg bg-white text-left shadow-xl transition-all sm:my-8 sm:w-full sm:max-w-lg">
                                                    <!-- Modal Header -->
                                                    <div class="flex justify-between items-center p-4 mb-4">
                                                        <h2 class="text-lg font-semibold">Request to Edit</h2>
                                                        <button id="close-modal" class="text-gray-500 hover:text-gray-700">&times;</button>
                                                    </div>
        
                                                    <!-- Modal Form -->
                                                    <form id="modal-form" class="px-6">
                                                        <!-- Date Input -->
                                                        <div class="mb-4">
                                                            <label for="date" class="block text-sm font-medium text-gray-700">Date</label>
                                                            <input type="date" id="date" name="date" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2 focus:ring-blue-500 focus:border-blue-500" required>
                                                        </div>
        
                                                        <div class="mb-4">
                                                            <label for="time" class="block text-sm font-medium text-gray-700">Time</label>
                                                            <input type="time" id="time" name="time"
                                                                class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2 focus:ring-blue-500 focus:border-blue-500"
                                                                required>
                                                        </div>
        
                                                        <!-- Reason Input -->
                                                        <div class="mb-4">
                                                            <label for="reason" class="block text-sm font-medium text-gray-700">Reason</label>
                                                            <textarea id="reason" name="reason" rows="3" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2 focus:ring-blue-500 focus:border-blue-500" placeholder="Enter reason here..." required></textarea>
                                                        </div>
        
                                                        <!-- Modal Actions -->
                                                        <div class="flex justify-end mb-4">
                                                            <button type="button" id="close-modal-btn" class="bg-gray-300 text-gray-700 px-4 py-2 rounded mr-2 hover:bg-gray-400">
                                                                Cancel
                                                            </button>
                                                            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">
                                                                Submit
                                                            </button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>    
                                        </div>
                                    </div>
        
                                    <a href="{{ route('compute.destroy', $list->id) }}"
                                        class="text-gray-500 transition-colors duration-200 dark:hover:text-indigo-500 dark:text-gray-300 hover:text-indigo-500 focus:outline-none">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-trash-2"><path d="M3 6h18"/><path d="M19 6v14c0 1-1 2-2 2H7c-1 0-2-1-2-2V6"/><path d="M8 6V4c0-1 1-2 2-2h4c1 0 2 1 2 2v2"/><line x1="10" x2="10" y1="11" y2="17"/><line x1="14" x2="14" y1="11" y2="17"/></svg>
                                    </a>
                                </div>
                            </td>
                        </tr>
        
                        @endforeach
                    </tbody>
                </table>
        
            </div>
        
                <div class="mt-6">
                    {{ $lists->links() }}
                </div>
            </div>
        </section>
    </div>
</x-app-layout>
<script>
    const showModalButton = document.getElementById('show-modal');
    const hideModalButton = document.getElementById('hide-modal');
    const modal = document.getElementById('modal');

    showModalButton.addEventListener('click', () => {
        modal.classList.remove('hidden');
    });

    hideModalButton.addEventListener('click', () => {
        modal.classList.add('hidden');
    });
</script>

<script>
    // References to modal elements
    const modal = document.getElementById("modal");
    const openModalBtn = document.getElementById("open-modal");
    const closeModalBtn = document.getElementById("close-modal");
    const closeModalBtn2 = document.getElementById("close-modal-btn");
    const modalForm = document.getElementById("modal-form");

    // Show the modal
    openModalBtn.addEventListener("click", () => {
        modal.classList.remove("hidden");
    });

    // Hide the modal
    closeModalBtn.addEventListener("click", () => {
        modal.classList.add("hidden");
    });

    closeModalBtn2.addEventListener("click", () => {
        modal.classList.add("hidden");
    });

    // Handle form submission
    modalForm.addEventListener("submit", (e) => {
        e.preventDefault(); // Prevent default form submission

        // Collect form data
        const date = document.getElementById("date").value;
        const reason = document.getElementById("reason").value;

        // Log or use form data as needed
        console.log("Date:", date);
        console.log("Reason:", reason);

        // Close the modal
        modal.classList.add("hidden");

        // Optional: Reset form
        modalForm.reset();
    });
</script>




