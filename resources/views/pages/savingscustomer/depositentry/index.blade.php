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
            <h1 class="text-2xl md:text-2xl text-fonts-200 dark:text-slate-100 font-bold mb-4">Savings Deposit
            </h1>
        </div>

        <div></div>

        <!-- Dashboard actions -->
        

        <!-- Cards -->
        <section class="container">
            <div class="p-6 w-full max-w-[1500px] mx-auto bg-white rounded-lg border border-bgbody-200">
                <div class="sm:flex sm:justify-between sm:items-center mb-4">
                    <div>
                    <form method="GET" action="{{ route('depositentry.index') }}" class="flex items-center mx-auto">
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

                    <a id="show-modal" href="{{route('depositentry.createDeposit')}}" class="btn bg-indigo-500 hover:bg-indigo-600 text-white rounded-full px-6 py-3 flex items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-circle-plus"><circle cx="12" cy="12" r="10"/><path d="M8 12h8"/><path d="M12 8v8"/></svg>
                        <span class="hidden xs:block ml-2 text-sm">New</span>
                    </a>
                    
                    <a id="show-modal" href="{{route('savings.export')}}" class="btn bg-indigo-500 hover:bg-indigo-600 text-white rounded-full px-6 py-3 flex items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-external-link"><path d="M15 3h6v6"/><path d="M10 14 21 3"/><path d="M18 13v6a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h6"/></svg>
                        <span class="hidden xs:block ml-2 text-sm">Export</span>
                    </a>
                    </div>
                </div>

                <table class="w-full border-collapse text-left text-sm rounded-md overflow-hidden border border-black">
                    <thead class="bg-bgbody-100 rounded-2xl">
                        <tr class="text-fonts-100 font-extrabold">
                            <th class="p-4 text-fonts-100 font-normal">Ref No.</th>
                            <th class="p-4 text-fonts-100 font-normal">Customer ID</th>
                            <th class="p-4 text-fonts-100 font-normal">Transaction Date</th>
                            <th class="p-4 text-fonts-100 font-normal">Amount</th>
                            <th class="p-4 text-fonts-100 font-normal">Action</th>
                        </tr>
                    </thead>
                    
                    <tbody class="text-gray-600 font-semibold text-sm">
                        @foreach ($lists as $list)
                            <tr class="border-b hover:bg-gray-50">
                                <td class="p-4">{{ $list->id }}</td>
                                <td class="p-4">{{ $list->customer_id }}</td>
                                <td class="p-4">{{ $list->customer->first_name ?? '' }} {{ $list->customer->last_name ?? '' }}</td>
                                <td class="p-4">{{ number_format($list->amount, 2) }}</td>
                                <td class="p-4">
                                    <div class="flex items-center gap-x-6">
                                        <a href="{{ route('printDeposit.print', $list->id) }}"
                                            class="text-gray-500 transition-colors duration-200 dark:hover:text-indigo-500 dark:text-gray-300 hover:text-indigo-500 focus:outline-none">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-printer-check"><path d="M13.5 22H7a1 1 0 0 1-1-1v-6a1 1 0 0 1 1-1h10a1 1 0 0 1 1 1v.5"/><path d="m16 19 2 2 4-4"/><path d="M6 18H4a2 2 0 0 1-2-2v-5a2 2 0 0 1 2-2h16a2 2 0 0 1 2 2v2"/><path d="M6 9V3a1 1 0 0 1 1-1h10a1 1 0 0 1 1 1v6"/></svg>
                                        </a>
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