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
            <h1 class="text-2xl md:text-2xl text-fonts-200 dark:text-slate-100 font-bold mb-4">Loan Renewal
            </h1>
        </div>

        <div></div>

        <!-- Dashboard actions -->


        <!-- Cards -->
        <section class="container">
            <div class="p-6 w-full max-w-[1500px] mx-auto bg-white rounded-lg border border-bgbody-200">
                <div class="sm:flex sm:justify-between sm:items-center mb-4">
                    <div>


                    </div>
                    <!-- Right: Actions -->

                    <div class="grid grid-flow-col sm:auto-cols-max justify-start sm:justify-end gap-2">
                        <!-- Filter button -->
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
                </div>



                <table class="w-full border-collapse text-left text-sm rounded-md overflow-hidden border border-black">
                    <thead class="bg-bgbody-100 rounded-2xl w-full">
                        <tr class=" text-fonts-100 font-extrabold">
                            <th class="p-4 text-fonts-100 font-normal">ID</th>
                            <th class="p-4 text-fonts-100 font-normal">Name</th>
                            <th class="p-4 text-fonts-100 font-normal">Address</th>
                            <th class="p-4 text-fonts-100 font-normal">Loan Amount</th>
                            <th class="p-4 text-fonts-100 font-normal ">Approval Date</th>
                            <th class="p-4 text-fonts-100 font-normal ">Status</th>
                        </tr>
                    </thead>
                    <tbody class="text-gray-600 font-semibold text-sm">
                        @foreach ($lists as $list)
                            <tr class="border-b hover:bg-gray-50">
                                <td class="p-4">
                                    {{ $list->id }}
                                </td>
                                <td class="p-4">
                                    {{ $list->customer->first_name }} {{ $list->customer->last_name }}
                                </td>
                                <td class="p-4">
                                    {{ $list->customer->house }} {{ $list->customer->street }}
                                    {{ $list->customer->bry->barangay_name }} {{ $list->customer->cty->city_town }}
                                </td>
                                <td class="p-4">
                                    {{ $list->principal_amount }}
                                </td>
                                <td class="p-4">
                                    {{ $list->updated_at->format('M d Y') }}
                                </td>
                                <td>
                                    <button
                                        class="text-gray-500 transition-colors duration-200 dark:hover:text-indigo-500 dark:text-gray-300 hover:text-indigo-500 focus:outline-none">
                                        View
                                    </button>
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
