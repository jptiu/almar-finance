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
            <h1 class="text-2xl md:text-2xl text-slate-800 dark:text-slate-100 font-bold mb-4">Pending Loan
                Approvals
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
                    <!-- Filter button -->
                    <div>
                        <form id="filterForm" method="GET" action="">
                            <div class="relative">
                                <input name="date_range" id="date_range"
                                    class="datepicker form-input pl-9 px-4 py-3  dark:bg-slate-800 text-slate-500 hover:text-slate-600 dark:text-slate-300 dark:hover:text-slate-200 rounded-full font-medium w-[15.5rem]"
                                    placeholder="Select dates" data-class="flatpickr-right" />
                                <div class="absolute inset-0 right-auto flex items-center pointer-events-none">
                                    <svg class="w-4 h-4 fill-current text-slate-500 dark:text-slate-400 ml-3"
                                        viewBox="0 0 16 16">
                                        <path
                                            d="M15 2h-2V0h-2v2H9V0H7v2H5V0H3v2H1a1 1 0 00-1 1v12a1 1 0 001 1h14a1 1 0 001-1V3a1 1 0 00-1-1zm-1 12H2V6h12v8z" />
                                    </svg>
                                </div>
                                <button type="submit"
                                    class="bg-indigo-500 hover:bg-primary-200 text-white px-4 py-3 rounded-full">Filter</button>
                            </div>
                        </form>
                    </div>

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
                                                            id="modal-title">Import Expenses</h3>
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
                        <tr class="text-fonts-100 font-extrabold">
                            <th class="p-4 text-fonts-100 font-normal">Transaction No.</th>
                            <th class="p-4 text-fonts-100 font-normal">Name</th>
                            <th class="p-4 text-fonts-100 font-normal">Address</th>
                            <th class="p-4 text-fonts-100 font-normal">Loan Amount</th>
                            <th class="p-4 text-fonts-100 font-normal">Submission Date</th>
                            <th class="p-4 text-fonts-100 font-normal">Action</th>
                        </tr>
                    </thead>
                    
                    <tbody class="bg-white divide-y font-semibold text-sm divide-gray-200 dark:divide-gray-500 dark:bg-gray-900">
                        @foreach ($lists as $list)
                            <tr class="border-b hover:bg-gray-50">
                                <td class="p-4">{{ $list->id }}</td>
                                <td class="p-4">{{ $list->customer->first_name }} {{ $list->customer->last_name }}</td>
                                <td class="p-4 whitespace-wrap">
                                    {{ $list->customer->house }} {{ $list->customer->street }}
                                    {{ $list->customer->bry->barangay_name }}
                                    {{ $list->customer->cty->city_town }}
                                </td>
                                <td class="p-4">{{ number_format($list->principal_amount, 2) }}</td>
                                <td class="p-4">{{ $list->date_of_loan }}</td>
                                <td class="p-4">
                                    <div class="flex items-center gap-x-2">
                                        <!-- Decline Button -->
                                        <button id="show-decline-modal"
                                            class="bg-bgbody-100 border border-bgbody-200  text-red hover:bg-red-600 hover:text-white flex items-center px-4 py-2 font-semibold rounded-full">
                                            <svg xmlns="http://www.w3.org/2000/svg" height="20px" viewBox="0 -960 960 960" width="20px" fill="#000000">
                                                <path d="m291-240-51-51 189-189-189-189 51-51 189 189 189-189 51 51-189 189 189 189-51 51-189-189-189 189Z" />
                                            </svg>
                                            <span class="hidden xs:block ml-2">Decline</span>
                                        </button>

                                        <!-- Approve Button -->
                                        <button id="show-approve-modal"
                                            class="bg-indigo-500 hover:bg-indigo-600 text-white hover:bg-green-600 flex items-center px-4 py-2 font-semibold rounded-full">
                                            <svg xmlns="http://www.w3.org/2000/svg" height="20px" viewBox="0 -960 960 960" width="20px" fill="#F3F3F3">
                                                <path d="M389-267 195-460l51-52 143 143 325-324 51 51-376 375Z" />
                                            </svg>
                                            <span class="hidden xs:block ml-2">Approve</span>
                                        </button>
                                        
                                        
                                    </div>
                                </td>
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