<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="p-6">
                    <div class="mb-6">
                        <h2 class="text-2xl font-bold text-gray-800">Submit Social Loan Request</h2>
                    </div>

                    <form action="{{ route('social_loan_requests.store') }}" method="POST">
                        @csrf

                        <div class="space-y-6">
                            <div>
                                <label for="loan_type" class="block text-sm font-medium text-gray-700">Loan Type</label>
                                <select name="loan_type" id="loan_type" 
                                        class="mt-1 block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm rounded-md @error('loan_type') border-red-300 text-red-900 placeholder-red-300 focus:ring-red-500 focus:border-red-500 @enderror"
                                        required>
                                    <option value="">Select Loan Type</option>
                                    <option value="SSS">SSS</option>
                                    <option value="PAGIBIG">Pag-IBIG</option>
                                </select>
                                @error('loan_type')
                                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label for="amount_requested" class="block text-sm font-medium text-gray-700">Amount Requested</label>
                                <input type="number" step="0.01" name="amount_requested" id="amount_requested" 
                                       class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm @error('amount_requested') border-red-300 text-red-900 placeholder-red-300 focus:ring-red-500 focus:border-red-500 @enderror"
                                       required>
                                @error('amount_requested')
                                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label for="purpose" class="block text-sm font-medium text-gray-700">Purpose</label>
                                <textarea name="purpose" id="purpose" 
                                          class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm @error('purpose') border-red-300 text-red-900 placeholder-red-300 focus:ring-red-500 focus:border-red-500 @enderror"
                                          rows="3" required></textarea>
                                @error('purpose')
                                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <button type="submit" 
                                        class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                    Submit Request
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
