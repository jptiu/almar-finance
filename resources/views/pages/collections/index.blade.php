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
            <h1 class="text-2xl md:text-2xl text-fonts-200 dark:text-slate-100 font-bold mb-4">Collection Data Entry
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
                        @props([
                        'align' => 'right',
                    ])
    
                    <div class="relative inline-flex" x-data="{ open: false, filters: [
                        'DAILY', 
                        'Ordinary', 
                        'Salary Loan - Dummy', 
                        'Motoposh', 
                        'SALARY LOAN - CEO', 
                        'PENSION', 
                        'ST. MATHEWS HIGH SCHOOL', 
                        'ST. PETER CASKET\'S INC.', 
                        'BDO', 
                        'ST. PETER CASKET INC', 
                        'SENTINEL SEC. AGENCY INC.', 
                        'ALMAR FREEMILE FINANCING CORP.', 
                        'Generics Pharmacy Inc.', 
                        'Salary Loan - Generics Pharmacy Inc.', 
                        'Salary Loan - Motoposh', 
                        'Salary Loan - St. Mathews High School', 
                        'Salary Loan - Pension', 
                        'Salary Loan - St. Peter Casket Inc.', 
                        'Salary Loan - BDO'] }">
                        <button
                            class="btn bg-white dark:bg-slate-800 border-slate-200 hover:border-slate-300 dark:border-slate-700 dark:hover:border-slate-600 text-slate-500 hover:text-slate-600 dark:text-slate-400 dark:hover:text-slate-300"
                            aria-haspopup="true" @click.prevent="open = !open" :aria-expanded="open">
                            <span class="sr-only">Customer Type</span><wbr>
                            <svg class="w-4 h-4 fill-current" viewBox="0 0 16 16">
                                <path
                                    d="M9 15H7a1 1 0 010-2h2a1 1 0 010 2zM11 11H5a1 1 0 010-2h6a1 1 0 010 2zM13 7H3a1 1 0 010-2h10a1 1 0 010 2zM15 3H1a1 1 0 010-2h14a1 1 0 010 2z" />
                            </svg>
                        </button>
                        <form method="GET" action="{{ route('resignation.index') }}">
                            <div class="origin-top-right z-10 absolute top-full left-0 right-auto min-w-56 bg-white dark:bg-slate-800 border border-slate-200 dark:border-slate-700 pt-1.5 rounded shadow-lg overflow-hidden mt-1 {{ $align === 'right' ? 'md:left-auto md:right-0' : 'md:left-0 md:right-auto' }}"
                                @click.outside="open = false" @keydown.escape.window="open = false" x-show="open"
                                x-transition:enter="transition ease-out duration-200 transform"
                                x-transition:enter-start="opacity-0 -translate-y-2" x-transition:enter-end="opacity-100 translate-y-0"
                                x-transition:leave="transition ease-out duration-200" x-transition:leave-start="opacity-100"
                                x-transition:leave-end="opacity-0" x-cloak>
                                <div class="text-xs font-semibold text-slate-400 dark:text-slate-500 uppercase pt-1.5 pb-2 px-3">Customer Type</div>
                                <ul class="mb-4">
                                    <template x-for="filter in filters" :key="filter">
                                        <li class="py-1 px-3">
                                            <label class="flex items-center">
                                                <input type="checkbox" name="filter[]" :value="filter.toLowerCase()" class="form-checkbox" />
                                                <span class="text-sm font-medium ml-2" x-text="filter"></span>
                                            </label>
                                        </li>
                                    </template>
                                </ul>
                                <div class="py-2 px-3 border-t border-slate-200 dark:border-slate-700 bg-slate-50 dark:bg-slate-700/20">
                                    <ul class="flex items-center justify-between">
                                        <li>
                                            <button type="reset"
                                                class="btn-xs bg-white dark:bg-slate-800 border-slate-200 dark:border-slate-700 hover:border-slate-300 dark:hover:border-slate-600 text-slate-500 dark:text-slate-300 hover:text-slate-600 dark:hover:text-slate-200">Clear</button>
                                        </li>
                                        <li>
                                            <button type="submit" class="btn-xs bg-blue-400 hover:bg-blue-700 text-white"
                                                @click="open = false" @focusout="open = false">Apply</button>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </form>
                    </div>
                    <a href="{{ route('collection.create') }}" class="btn bg-indigo-500 hover:bg-indigo-600 text-white rounded-full px-6 py-3 flex items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-circle-plus"><circle cx="12" cy="12" r="10"/><path d="M8 12h8"/><path d="M12 8v8"/></svg>
                        <span class="hidden xs:block ml-2">New</span>
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
                    <thead class="bg-bgbody-100 rounded-2xl w-full">
                        <tr class=" text-fonts-100 font-extrabold">
                            <th class="p-4 text-fonts-100 font-normal">ID</th>
                            <th class="p-4 text-fonts-100 font-normal">Name</th>
                            <th class="p-4 text-fonts-100 font-normal">Transcation No</th>
                            <th class="p-4 text-fonts-100 font-normal">Type</th>
                            <th class="p-4 text-fonts-100 font-normal ">Collector</th>
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
                                {{ $list->name }}
                            </td>
                            <td
                                class="p-4">
                                {{ $list->trans_no }}
                            </td>
                            <td
                                class="p-4">
                                {{ $list->type }}
                            </td>
                            <td
                                class="p-4">
                                {{ $list->user->name }}
                            </td>
                            <!-- <td class="px-4 py-4 text-sm whitespace-nowrap">
                                <div class="flex items-center gap-x-6">
                            
                                    {{-- <a href="{{ route('collection.show', $list->id) }}"
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

                                    {{-- <a href="{{ route('collection.edit', $list->id) }}"
                                        class="text-gray-500 transition-colors duration-200 dark:hover:text-indigo-500 dark:text-gray-300 hover:text-indigo-500 focus:outline-none">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16"
                                            height="16" fill="currentColor" class="bi bi-pencil"
                                            viewBox="0 0 16 16">
                                            <path
                                                d="M12.146.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1 0 .708l-10 10a.5.5 0 0 1-.168.11l-5 2a.5.5 0 0 1-.65-.65l2-5a.5.5 0 0 1 .11-.168zM11.207 2.5 13.5 4.793 14.793 3.5 12.5 1.207zm1.586 3L10.5 3.207 4 9.707V10h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.293zm-9.761 5.175-.106.106-1.528 3.821 3.821-1.528.106-.106A.5.5 0 0 1 5 12.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.468-.325" />
                                        </svg>
                                    </a> --}}

                                    {{-- <form action=""
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
                                    </form> --}}
                                </div>
                            </td> -->
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
