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

        @if (session()->has('category_added'))
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
                        <span class="font-medium">{{ session()->get('category_added') }}</span>
                    </div>
                </div>
            </div>
        @endif

        <!-- Dashboard actions -->
        <div class="sm:flex sm:justify-between sm:items-center mb-8">
            <div>
                <h1 class="text-2xl md:text-2xl text-slate-800 dark:text-slate-100 font-bold">Expenses Data Entry</h1>
                <ol class="inline-flex items-center space-x-2">
                    <!-- Home -->
                    <li>
                        <a href="/" class="text-gray-500 hover:text-gray-700">
                            <svg xmlns="http://www.w3.org/2000/svg" height="20px" viewBox="0 -960 960 960" width="20px"
                                fill="#A9A9A9">
                                <path
                                    d="M264-216h96v-240h240v240h96v-348L480-726 264-564v348Zm-72 72v-456l288-216 288 216v456H528v-240h-96v240H192Zm288-327Z" />
                            </svg>
                        </a>
                    </li>
                    <!-- Separator -->
                    <li>
                        <span class="text-gray-500">/</span>
                    </li>
                    <!-- Page -->
                    <li>
                        <a href="#" class="text-sm text-gray-500">Expenses Data Entry</a>
                    </li>
                    <!-- Separator -->
                    <li>
                        <span class="text-gray-500">/</span>
                    </li>
                    <!-- Current Page -->
                    <li>
                        <span class="text-sm text-black font-medium">Create</span>
                    </li>
                </ol>
            </div>

            <!-- Right: Actions -->
            <div class="grid grid-flow-col sm:auto-cols-max justify-start sm:justify-end gap-2">
            </div>

        </div>

        <form action="{{ route('expenses.store') }}" method="POST">
            @csrf
            <div class="bg-white rounded shadow-lg p-4 px-4 md:p-8 mb-6">
                <div class="flex items-center text-gray-600 mb-12">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                        xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7">
                        </path>
                    </svg>
                    <a href="{{ route('expenses.index') }}" class="text-base font-semibold">Back</a>
                </div>
                <div>
                    <div class="grid gap-4 gap-y-2 text-sm grid-cols-1 lg:grid-cols-1">
                        <div class="lg:col-span-2">
                            <div class="grid gap-4 gap-y-2 text-sm grid-cols-1 md:grid-cols-8">

                                <div class="md:col-span-2">
                                    <label for="exp_date" class="text-black font-medium">Expiry Date</label>
                                    <input type="date" name="exp_date" id="exp_date"
                                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-2 p-2.5"
                                        value="" placeholder="" required />
                                </div>
                                <div class="md:col-span-2">
                                    <label for="category" class="text-black font-medium">Category</label>
                                    <div class="flex gap-2">
                                        <select name="category" id="category"
                                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-2 p-2.5">
                                            <option value="">Select Category</option>
                                            @foreach($categories as $category)
                                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                                            @endforeach
                                            <option value="new_category" class="font-medium text-blue-600">+ Add New
                                                Category</option>
                                        </select>
                                        <button type="button" data-modal-target="editCategoryModal"
                                            id="editCategoryButton" onclick="openEditCategoryModal()"
                                            data-modal-toggle="editCategoryModal"
                                            class="px-3 py-2 text-sm font-medium text-white bg-blue-500 rounded-lg hover:bg-blue-600">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                                stroke-linecap="round" stroke-linejoin="round">
                                                <path d="M17 3a2.85 2.83 0 1 1 4 4L7.5 20.5 2 22l1.5-5.5Z" />
                                                <path d="m15 5 4 4" />
                                            </svg>
                                        </button>
                                        <button type="button" data-modal-target="deleteCategoryModal"
                                            id="deleteCategoryButton" onclick="openDeleteCategoryModal()"
                                            data-modal-toggle="deleteCategoryModal"
                                            class="px-3 py-2 text-sm font-medium text-white bg-red-500 rounded-lg hover:bg-red-600">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                                stroke-linecap="round" stroke-linejoin="round">
                                                <path d="M3 6h18" />
                                                <path d="M19 6v14c0 1-1 2-2 2H7c-1 0-2-1-2-2V6" />
                                                <path d="M8 6V4c0-1 1-2 2-2h4c1 0 2 1 2 2v2" />
                                            </svg>
                                        </button>
                                        <button type="button" data-modal-target="confirmationModal"
                                            id="confirmationButton" onclick="openConfirmationModal()"
                                            data-modal-toggle="confirmationModal"
                                            class="px-3 py-2 text-sm font-medium text-white bg-blue-500 rounded-lg hover:bg-blue-600">
                                            Confirm
                                        </button>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>

                <x-section-border />

                <div>
                    <div class="grid gap-4 gap-y-2 text-sm grid-cols-1 lg:grid-cols-1">
                        <div class="lg:col-span-2">
                            <div class="grid gap-4 gap-y-2 text-sm grid-cols-1 md:grid-cols-8">

                                <div class="md:col-span-2">
                                    <label for="exp_ref_no" class="text-black font-medium">Exp Ref No.</label>
                                    <input type="text" name="exp_ref_no" id="exp_ref_no"
                                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-2 p-2.5"
                                        value="" placeholder="" required />
                                </div>

                                <div class="md:col-span-2">
                                    <label for="acc_no" class="text-black font-medium">Account No.</label>
                                    <select name="acc_no" id="acc_no"
                                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-2 p-2.5">
                                        <option value>Select</option>
                                        @foreach ($lists as $list)
                                            <option value="{{ $list->acc_no }}">{{ $list->acc_no }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="md:col-span-2">
                                    <label for="acc_class" class="text-black font-medium">Account Class</label>
                                    <input type="text" name="acc_class" id="acc_class"
                                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-2 p-2.5"
                                        value="" placeholder="" required />
                                </div>

                                <div class="md:col-span-2">
                                    <label for="acc_type" class="text-black font-medium">Account Type</label>
                                    <input type="text" name="acc_type" id="acc_type"
                                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-2 p-2.5"
                                        value="" placeholder="" required />
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <x-section-border />

                <div>
                    <div class="grid gap-4 gap-y-2 text-sm grid-cols-1 lg:grid-cols-1">
                        <div class="lg:col-span-2">
                            <div class="grid gap-4 gap-y-2 text-sm grid-cols-1 md:grid-cols-8">

                                <div class="md:col-span-2">
                                    <label for="acc_title" class="text-black font-medium">Account Title</label>
                                    <input type="text" name="acc_title" id="acc_title"
                                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-2 p-2.5"
                                        value="" placeholder="" required />
                                </div>

                                <div class="md:col-span-2">
                                    <label for="justification" class="text-black font-medium">Justification</label>
                                    <input type="text" name="justification" id="justification"
                                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-2 p-2.5"
                                        value="" placeholder="" required />
                                </div>

                                <div class="md:col-span-2">
                                    <label for="or_no" class="text-black font-medium">O.R No.</label>
                                    <input type="text" name="or_no" id="or_no"
                                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-2 p-2.5"
                                        value="" placeholder="" required />
                                </div>

                                <div class="md:col-span-2">
                                    <label for="amount" class="text-black font-medium">Amount</label>
                                    <input type="number" name="amount" id="amount"
                                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-2 p-2.5"
                                        value="" placeholder="₱" />
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <x-section-border />

                <!-- Cards -->
                <section class="container mx-auto mb-12">
                    <div class="flex flex-col">
                        <div class="-mx-4 -my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                            <div class="inline-block min-w-full py-2 align-middle md:px-6 lg:px-8">
                                <div class="overflow-hidden border border-gray-200 dark:border-gray-700 md:rounded-lg">
                                    <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                                        <div
                                            class="px-4 py-3.5 text-sm font-normal text-left rtl:text-right text-white dark:text-white bg-blue-700 dark:bg-gray-800">
                                            <h1 class="text-lg font-normal">Charge to</h1>
                                        </div>
                                        <tbody
                                            class="bg-white divide-y divide-gray-200 dark:divide-gray-500 dark:bg-gray-900">
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>

                <div>
                    <div class="grid gap-4 gap-y-2 text-sm grid-cols-1 lg:grid-cols-3">
                        <div class="text-gray-600">
                            <p class="font-medium text-lg"></p>
                        </div>

                        <div class="lg:col-span-2">
                            <div class="grid gap-4 gap-y-2 text-sm grid-cols-1 md:grid-cols-5">
                                <div class="md:col-span-5 text-right">
                                    <div class="inline-flex items-end">
                                        <button type="submit"
                                            class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Detail</button>
                                        <button type="submit"
                                            class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded ml-2">Save</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>

        <!-- New Category Modal -->
        <div id="newCategoryModal" tabindex="-1" aria-hidden="true"
            class="fixed top-0 left-0 right-0 z-50 hidden w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] max-h-full bg-gray-500 bg-opacity-75">
            <div
                class="relative w-full max-w-md max-h-full top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2">
                <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                    <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                        <h3 class="text-lg font-semibold text-gray-900 dark:text-white">
                            Add New Category
                        </h3>
                        <button type="button" id="closeNewCategoryModal" onclick="closeNewCategoryModal()"
                            class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white"
                            data-modal-toggle="newCategoryModal">
                            <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                                viewBox="0 0 14 14">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                    stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                            </svg>
                            <span class="sr-only">Close modal</span>
                        </button>
                    </div>
                    <form action="{{ route('category-expenses.store') }}" method="POST">
                        @csrf
                        <div class="p-4 md:p-5">
                            <div class="mb-4">
                                <label for="name"
                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Category
                                    Name</label>
                                <input type="text" name="name" id="name"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                                    required>
                            </div>
                            <button type="submit"
                                class="text-white inline-flex items-center bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center">
                                Save Category
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Edit Category Modal -->
        <div id="editCategoryModal" tabindex="-1" aria-hidden="true"
            class="fixed top-0 left-0 right-0 z-50 hidden w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] max-h-full bg-gray-500 bg-opacity-75">
            <div
                class="relative w-full max-w-md max-h-full top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2">
                <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                    <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                        <h3 class="text-lg font-semibold text-gray-900 dark:text-white">
                            Edit Category
                        </h3>
                        <button type="button" id="closeEditCategoryModal" onclick="closeEditCategoryModal()"
                            class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white"
                            data-modal-toggle="editCategoryModal">
                            <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                                viewBox="0 0 14 14">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                    stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                            </svg>
                            <span class="sr-only">Close modal</span>
                        </button>
                    </div>

                    @if(isset($category) && $category)
                        <form id="editCategoryForm" action="{{ route('category-expenses.update', $category) }}"
                            method="POST">
                            @csrf
                            <div class="p-4 md:p-5">
                                <input type="hidden" name="id" id="categoryId" value="{{ $category->id }}">
                                <div class="mb-4">
                                    <label for="name"
                                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Category
                                        Name</label>
                                    <input type="text" name="name" id="categoryName"
                                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                                        required>
                                </div>
                                <button type="submit"
                                    class="text-white inline-flex items-center bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center">
                                    Update Category
                                </button>
                            </div>
                        </form>
                    @else
                        <div class="p-4 md:p-5 text-center">
                            <p class="text-gray-500 dark:text-gray-400">No category selected to edit.</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>

        <!-- Delete Category Modal -->
        <div id="deleteCategoryModal" tabindex="-1" aria-hidden="true"
            class="fixed top-0 left-0 right-0 z-50 hidden w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] max-h-full bg-gray-500 bg-opacity-75">
            <div
                class="relative w-full max-w-md max-h-full top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2">
                <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                    <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                        <h3 class="text-lg font-semibold text-gray-900 dark:text-white">
                            Delete Category
                        </h3>
                        <button type="button"
                            class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white"
                            data-modal-toggle="deleteCategoryModal">
                            <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                                viewBox="0 0 14 14">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                    stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                            </svg>
                            <span class="sr-only">Close modal</span>
                        </button>
                    </div>
                    @if(isset($category) && $category)
                        <form id="deleteCategoryForm" action="{{ route('category-expenses.destroy', $category->id) }}"
                            method="POST">
                            @csrf
                            @method('DELETE')
                            <div class="p-4 md:p-5 text-center">
                                <svg class="mx-auto mb-4 text-gray-400 w-12 h-12 dark:text-gray-200" aria-hidden="true"
                                    xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                        stroke-width="2" d="M10 11V6m0 8h.01M19 10a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                                </svg>
                                <h3 class="mb-5 text-lg font-normal text-gray-500 dark:text-gray-400">Are you sure you want
                                    to delete this category?</h3>
                                <button type="submit"
                                    class="text-white bg-red-600 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 dark:focus:ring-red-800 font-medium rounded-lg text-sm inline-flex items-center px-5 py-2.5 text-center me-2">
                                    Yes, I'm sure
                                </button>
                                <button type="submit" id="cancelDeleteCategoryButton" onclick="closeDeleteCategoryModal()"
                                    class="text-gray-500 bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-gray-200 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-500 dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-gray-600"
                                    data-modal-toggle="deleteCategoryModal">
                                    No, cancel
                                </button>
                            </div>
                        </form>
                    @endif
                </div>
            </div>
        </div>

    </div>
</x-app-layout>
<script>
    // Require category field
    document.addEventListener('DOMContentLoaded', function () {
        const categorySelect = document.getElementById('category');
        const form = categorySelect.closest('form');

        form.addEventListener('submit', function (e) {
            if (!categorySelect.value || categorySelect.value === '') {
                e.preventDefault();
                alert('Please select a category');
                return false;
            }
        });
    });

    document.getElementById('acc_no').addEventListener('input', function () {
        var acctNo = this.value;

        if (acctNo) {
            fetch(`/get-account-data/${acctNo}`)
                .then(response => response.json())
                .then(data => {
                    if (data) {
                        document.getElementById('acc_class').value = data.account_class;
                        document.getElementById('acc_type').value = data.account_type;
                        document.getElementById('acc_title').value = data.account_title;
                    }
                })
                .catch(error => console.error('Error:', error));
        }
    });

    document.getElementById('category').addEventListener('change', function () {
        if (this.value === 'new_category') {
            const modal = document.getElementById('newCategoryModal');
            modal.classList.remove('hidden');
        }
    });

    document.addEventListener('DOMContentLoaded', function () {
        const editButtons = document.querySelectorAll('[data-modal-target="editCategoryModal"]');

        editButtons.forEach(button => {
            button.addEventListener('click', function () {
                const categoryId = document.getElementById('category').value;
                const categoryName = document.getElementById('category').options[document.getElementById('category').selectedIndex].text;

                document.getElementById('categoryName').value = categoryName;
            });
        });
    });

    function closeNewCategoryModal() {
        const modal = document.getElementById('newCategoryModal');
        modal.classList.add('hidden');
    }

    function openEditCategoryModal() {
        const modal = document.getElementById('editCategoryModal');
        modal.classList.remove('hidden');
    }

    function closeEditCategoryModal() {
        const modal = document.getElementById('editCategoryModal');
        modal.classList.add('hidden');
    }

    // Show edit/delete buttons only when a valid category is selected
    document.getElementById('category').addEventListener('change', function () {
        const editButton = document.getElementById('editCategoryButton');
        const deleteButton = document.querySelector('[data-modal-target="deleteCategoryModal"]');

        if (this.value && this.value !== 'new_category') {
            editButton.style.display = 'block';
            deleteButton.style.display = 'block';
        } else {
            editButton.style.display = 'none';
            deleteButton.style.display = 'none';
        }
    });

    // Hide buttons initially on page load
    document.addEventListener('DOMContentLoaded', function () {
        const editButton = document.getElementById('editCategoryButton');
        const deleteButton = document.querySelector('[data-modal-target="deleteCategoryModal"]');

        editButton.style.display = 'none';
        deleteButton.style.display = 'none';
    });

    function closeDeleteCategoryModal() {
        const modal = document.getElementById('deleteCategoryModal');
        modal.classList.add('hidden');
    }

    function openDeleteCategoryModal() {
        const modal = document.getElementById('deleteCategoryModal');
        modal.classList.remove('hidden');
    }

    function cancelDeleteCategory() {
        const modal = document.getElementById('deleteCategoryModal');
        modal.classList.add('hidden');
    }
</script>