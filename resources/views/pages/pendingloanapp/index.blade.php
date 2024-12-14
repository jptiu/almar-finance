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
            <h1 class="text-2xl md:text-2xl text-slate-800 dark:text-slate-100 font-bold mb-12 lg:px-4">Pending Loan
                Approvals
            </h1>
        </div>

        <div></div>

        <!-- Dashboard actions -->
        <div class="sm:flex sm:justify-between sm:items-center mb-4 md:px-2 lg:px-4">
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
                <!-- <a href="{{ route('barangay.add') }}" class="btn bg-indigo-500 hover:bg-indigo-600 text-white">
                    <svg class="w-4 h-4 fill-current opacity-50 shrink-0" viewBox="0 0 16 16">
                        <path
                            d="M15 7H9V1c0-.6-.4-1-1-1S7 .4 7 1v6H1c-.6 0-1 .4-1 1s.4 1 1 1h6v6c0 .6.4 1 1 1s1-.4 1-1V9h6c.6 0 1-.4 1-1s-.4-1-1-1z" />
                    </svg>
                    <span class="hidden xs:block ml-2">Add Barangay</span>
                </a> -->
                <a id="show-modal" href="#" class="btn bg-indigo-500 hover:bg-indigo-600 text-white">
                    <svg class="w-4 h-4 fill-current opacity-50 shrink-0" viewBox="0 0 16 16">
                        <path
                            d="M15 7H9V1c0-.6-.4-1-1-1S7 .4 7 1v6H1c-.6 0-1 .4-1 1s.4 1 1 1h6v6c0 .6.4 1 1 1s1-.4 1-1V9h6c.6 0 1-.4 1-1s-.4-1-1-1z" />
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

        <!-- Cards -->

        <section class="container px-4 mx-auto">
            <div class="flex flex-col">
                <div class="-mx-4 -my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                    <div class="inline-block min-w-full py-2 align-middle md:px-6 lg:px-8">
                        <div class="overflow-hidden border border-gray-200 dark:border-gray-700 md:rounded-lg">
                            <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                                <thead class="bg-gray-50 dark:bg-gray-800">
                                    <tr>
                                        <th scope="col"
                                            class="px-4 py-3.5 text-sm font-normal text-left rtl:text-right text-black font-medium">
                                            Transaction No.
                                        </th>

                                        <th scope="col"
                                            class="px-4 py-3.5 text-sm font-normal text-left rtl:text-right text-black font-medium">
                                            Name
                                        </th>

                                        <th scope="col"
                                            class="px-4 py-3.5 text-sm font-normal text-left rtl:text-right text-black font-medium">
                                            Address
                                        </th>

                                        <th scope="col"
                                            class="px-4 py-3.5 text-sm font-normal text-left rtl:text-right text-black font-medium">
                                            Loan Amount
                                        </th>

                                        <th scope="col"
                                            class="px-4 py-3.5 text-sm font-normal text-left rtl:text-right text-black font-medium">
                                            Submission Date
                                        </th>

                                        <th scope="col"
                                            class="px-4 py-3.5 text-sm font-normal text-left rtl:text-right text-black font-medium">
                                            Action
                                        </th>

                                    </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200 dark:divide-gray-500 dark:bg-gray-900">
                                    @foreach ($lists as $list)
                                        <tr>
                                            <td
                                                class="px-4 py-4 text-sm font-medium text-gray-500 dark:text-gray-200 whitespace-nowrap">
                                                {{ $list->id }}
                                            </td>
                                            <td
                                                class="px-4 py-4 text-sm text-gray-500 dark:text-gray-300 whitespace-nowrap">
                                                {{ $list->customer->first_name }} {{ $list->customer->last_name }}
                                            </td>
                                            <td
                                                class="px-4 py-4 text-sm text-gray-500 dark:text-gray-300 whitespace-wrap">
                                                {{ $list->customer->house }} {{ $list->customer->street }}
                                                {{ $list->customer->bry->barangay_name }}
                                                {{ $list->customer->cty->city_town }}
                                            </td>
                                            <td
                                                class="px-4 py-4 text-sm text-gray-500 dark:text-gray-300 whitespace-nowrap">
                                                {{ number_format($list->principal_amount, 2) }}
                                            </td>
                                            <td
                                                class="px-4 py-4 text-sm text-gray-500 dark:text-gray-300 whitespace-nowrap">
                                                {{ $list->date_of_loan }}
                                            </td>
                                            <td class="px-4 py-4 text-sm whitespace-nowrap">
                                                <div class="flex items-center gap-x-2">
                                                    <!-- Approve Button -->
                                                    <button id="show-approve-modal"
                                                        class="bg-green-400 text-white hover:bg-green-600 flex items-center gap-x-2 px-4 py-2 font-semibold rounded-md">
                                                        <svg xmlns="http://www.w3.org/2000/svg" height="20px"
                                                            viewBox="0 -960 960 960" width="20px" fill="#F3F3F3">
                                                            <path
                                                                d="M389-267 195-460l51-52 143 143 325-324 51 51-376 375Z" />
                                                        </svg>
                                                        <span class="hidden xs:block ml-2">Approve</span>
                                                    </button>
                                                    <!-- Approve Modal -->
                                                    <div id="approve-modal"
                                                        class="fixed z-10 inset-0 overflow-y-auto hidden opacity-0 transition-opacity duration-300">
                                                        <div class="flex items-center justify-center min-h-screen">
                                                            <div
                                                                class="bg-white p-6 rounded shadow-md max-w-lg w-full">
                                                                <h2 class="text-lg font-bold">Are you sure you want to
                                                                    approve this loan?</h2>
                                                                <label for="approve-reason"
                                                                    class="block text-sm font-medium text-gray-700 mt-4">Reason
                                                                    for
                                                                    Approval</label>
                                                                <textarea id="approve-reason" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm"></textarea>
                                                                <div class="mt-4 flex justify-end">
                                                                    <button id="hide-approve-modal"
                                                                        class="px-4 py-2 bg-gray-300 rounded-md">Cancel</button>
                                                                    <button id="approve-confirm-btn"
                                                                        class="px-4 py-2 bg-red-500 text-white rounded-md ml-2">Confirm</button>
                                                                </div>

                                                                <!-- Hidden form to submit the approve reason -->
                                                                <form id="approve-form"
                                                                    action="{{ route('loan.approve', $list->id) }}"
                                                                    method="POST" class="hidden">
                                                                    @csrf
                                                                    <input type="hidden" name="reason"
                                                                        id="approve-reason-input">
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <!-- Decline Button -->
                                                    <button id="show-decline-modal"
                                                        class="bg-red-400 text-white hover:bg-red-600 flex items-center gap-x-2 px-4 py-2 font-semibold rounded-md">
                                                        <svg xmlns="http://www.w3.org/2000/svg" height="20px"
                                                            viewBox="0 -960 960 960" width="20px" fill="#F3F3F3">
                                                            <path
                                                                d="m291-240-51-51 189-189-189-189 51-51 189 189 189-189 51 51-189 189 189 189-51 51-189-189-189 189Z" />
                                                        </svg>
                                                        <span class="hidden xs:block ml-2">Decline</span>
                                                    </button>
                                                    <!-- Decline Modal -->
                                                    <div id="decline-modal"
                                                        class="fixed z-10 inset-0 overflow-y-auto hidden opacity-0 transition-opacity duration-300">
                                                        <div class="flex items-center justify-center min-h-screen">
                                                            <div
                                                                class="bg-white p-6 rounded shadow-md max-w-lg w-full">
                                                                <h2 class="text-lg font-bold">Are you sure you want to
                                                                    decline this loan?</h2>
                                                                <label for="decline-reason"
                                                                    class="block text-sm font-medium text-gray-700 mt-4">Reason
                                                                    for
                                                                    Disapproval</label>
                                                                <textarea id="decline-reason" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm"></textarea>
                                                                <div class="mt-4 flex justify-end">
                                                                    <button id="hide-decline-modal"
                                                                        class="px-4 py-2 bg-gray-300 rounded-md">Cancel</button>
                                                                    <button id="decline-confirm-btn"
                                                                        class="px-4 py-2 bg-red-500 text-white rounded-md ml-2">Confirm</button>
                                                                </div>

                                                                <!-- Hidden form to submit the decline reason -->
                                                                <form id="decline-form"
                                                                    action="{{ route('loan.decline', $list->id) }}"
                                                                    method="POST" class="hidden">
                                                                    @csrf
                                                                    <input type="hidden" name="reason"
                                                                        id="decline-reason-input">
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>
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
            <div class="flex-end items-center justify-between mt-6">
                {{ $lists->links() }}
            </div>
        </section>

        <!-- Approve Modal -->
        <div id="approve-modal"
            class="fixed z-10 inset-0 overflow-y-auto hidden opacity-0 transition-opacity duration-300">
            <div class="flex items-center justify-center min-h-screen">
                <div class="bg-white p-6 rounded shadow-md max-w-lg w-full">
                    <h2 class="text-lg font-bold">Are you sure you want to approve this loan?</h2>
                    <label for="approve-notes" class="block text-sm font-medium text-gray-700 mt-4">
                        Additional Notes
                    </label>
                    <textarea id="approve-notes" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm"></textarea>
                    <div class="mt-4 flex justify-end">
                        <button id="hide-approve-modal" class="px-4 py-2 bg-gray-300 rounded-md">Cancel</button>
                        <button class="px-4 py-2 bg-blue-500 text-white rounded-md ml-2">Confirm</button>
                    </div>
                </div>
            </div>
        </div>


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
    // Approve Modal
    const showApproveModalButton = document.getElementById('show-approve-modal');
    const hideApproveModalButton = document.getElementById('hide-approve-modal');
    const approveModal = document.getElementById('approve-modal');
    const approveConfirmBtn = document.getElementById('approve-confirm-btn');
    const approveReasonInput = document.getElementById('approve-reason');
    const approveForm = document.getElementById('approve-form');

    showApproveModalButton.addEventListener('click', () => {
        approveModal.classList.remove('hidden');
        setTimeout(() => approveModal.classList.remove('opacity-0'), 10);
    });

    hideApproveModalButton.addEventListener('click', () => {
        approveModal.classList.add('opacity-0');
        setTimeout(() => approveModal.classList.add('hidden'), 300);
    });

    approveConfirmBtn.addEventListener('click', () => {
        // Capture the approve reason
        const reason = approveReasonInput.value.trim();

        // If there's a reason, set it in the form input and submit
        if (reason) {
            document.getElementById('approve-reason-input').value = reason;
            approveForm.submit();
        } else {
            alert('Please provide a reason for the approve.');
        }
    });

    // Decline Modal
    const showDeclineModalButton = document.getElementById('show-decline-modal');
    const hideDeclineModalButton = document.getElementById('hide-decline-modal');
    const declineModal = document.getElementById('decline-modal');
    const declineConfirmBtn = document.getElementById('decline-confirm-btn');
    const declineReasonInput = document.getElementById('decline-reason');
    const declineForm = document.getElementById('decline-form');

    showDeclineModalButton.addEventListener('click', () => {
        declineModal.classList.remove('hidden');
        setTimeout(() => declineModal.classList.remove('opacity-0'), 10);
    });

    hideDeclineModalButton.addEventListener('click', () => {
        declineModal.classList.add('opacity-0');
        setTimeout(() => declineModal.classList.add('hidden'), 300);
    });

    declineConfirmBtn.addEventListener('click', () => {
        // Capture the decline reason
        const reason = declineReasonInput.value.trim();

        // If there's a reason, set it in the form input and submit
        if (reason) {
            document.getElementById('decline-reason-input').value = reason;
            declineForm.submit();
        } else {
            alert('Please provide a reason for the decline.');
        }
    });
</script>
