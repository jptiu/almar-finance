<x-app-layout>
    <div class="px-4 sm:px-6 lg:px-8 py-8 w-full max-w-9xl mx-auto">
        <div class="w-full bg-white rounded-xl p-6">
            <div class="flex items-center justify-between mb-6">
                <h2 class="text-2xl font-bold text-gray-900">Pending Edit Requests</h2>
            </div>

            @if(session('success'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4">
                    {{ session('success') }}
                </div>
            @endif

            @if(session('error'))
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4">
                    {{ session('error') }}
                </div>
            @endif

            <div class="overflow-x-auto">
                <table class="w-full border-collapse text-left text-sm rounded-md overflow-hidden border border-black">
                    <thead class="bg-bgbody-100 rounded-2xl">
                        <tr>
                            <th class="p-4 text-fonts-100 font-normal">Loan ID</th>
                            <th class="p-4 text-fonts-100 font-normal">Customer</th>
                            <th class="p-4 text-fonts-100 font-normal">Request Date</th>
                            <th class="p-4 text-fonts-100 font-normal">Request Time</th>
                            <th class="p-4 text-fonts-100 font-normal">Reason</th>
                            <th class="p-4 text-fonts-100 font-normal">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="text-gray-600 font-semibold text-sm">
                        @foreach($editRequests as $request)
                            <tr class="border-b hover:bg-gray-50">
                                <td class="px-4 py-4 text-sm  dark:text-gray-200 whitespace-nowrap">{{ $request->loan->trans_no ?? 'N/A' }}</td>
                                <td class="px-4 py-4 text-sm  dark:text-gray-200 whitespace-nowrap">{{ $request->loan->customer->first_name }} {{ $request->loan->customer->last_name }}</td>
                                <td class="px-4 py-4 text-sm  dark:text-gray-200 whitespace-nowrap">{{ $request->requested_date }}</td>
                                <td class="px-4 py-4 text-sm  dark:text-gray-200 whitespace-nowrap">{{ $request->requested_time }}</td>
                                <td class="px-4 py-4 text-sm  dark:text-gray-200 whitespace-nowrap">{{ $request->reason }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                    <div class="flex space-x-2">
                                        <button onclick="openModal('approveModal-{{ $request->id }}')" class="bg-indigo-500 hover:bg-indigo-600 text-white hover:bg-green-600 flex items-center px-4 py-2 font-semibold rounded-full">Approve</button>
                                        <button onclick="openModal('declineModal-{{ $request->id }}')" class="bg-bgbody-100 border border-bgbody-200  text-red hover:bg-red-600 hover:text-white flex items-center px-4 py-2 font-semibold rounded-full">Decline</button>
                                    </div>

                                    <!-- Approve Modal -->
                                    <div id="approveModal-{{ $request->id }}" class="fixed inset-0 hidden z-50 overflow-y-auto bg-gray-900 bg-opacity-50 flex items-center justify-center">
                                        <div class="bg-white rounded-lg p-6 max-w-lg w-full">
                                            <h3 class="text-lg font-semibold mb-4">Approve Loan Request</h3>
                                            <form action="{{ route('loan.edit-requests.approve', $request->id) }}" method="POST">
                                                @csrf
                                                <div class="space-y-4">
                                                    <div>
                                                        <label class="block text-sm font-medium">Principal Amount</label>
                                                        <input type="number" step="0.01" name="principal_amount" value="{{ $request->loan->principal_amount }}" class="w-full mt-1 border-gray-300 rounded-md shadow-sm">
                                                    </div>
                                                    <div>
                                                        <label class="block text-sm font-medium">Interest Rate</label>
                                                        <input type="number" step="0.01" name="interest" value="{{ $request->loan->interest }}" class="w-full mt-1 border-gray-300 rounded-md shadow-sm">
                                                    </div>
                                                    <div>
                                                        <label class="block text-sm font-medium">Months to Pay</label>
                                                        <input type="number" name="months_to_pay" value="{{ $request->loan->months_to_pay }}" class="w-full mt-1 border-gray-300 rounded-md shadow-sm">
                                                    </div>
                                                </div>
                                                <div class="mt-6 flex justify-end space-x-4">
                                                    <button type="button" onclick="closeModal('approveModal-{{ $request->id }}')" class="text-gray-600">Cancel</button>
                                                    <button type="submit" class="bg-green-600 text-white px-4 py-2 rounded">Submit</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>

                                    <!-- Decline Modal -->
                                    <div id="declineModal-{{ $request->id }}" class="fixed inset-0 hidden z-50 overflow-y-auto bg-gray-900 bg-opacity-50 flex items-center justify-center">
                                        <div class="bg-white rounded-lg p-6 max-w-lg w-full">
                                            <h3 class="text-lg font-semibold mb-4">Decline Loan Request</h3>
                                            <form action="{{ route('loan.edit-requests.decline', $request->id) }}" method="POST">
                                                @csrf
                                                <div>
                                                    <label class="block text-sm font-medium">Decline Reason</label>
                                                    <textarea name="declined_reason" rows="4" class="w-full mt-1 border-gray-300 rounded-md shadow-sm"></textarea>
                                                </div>
                                                <div class="mt-6 flex justify-end space-x-4">
                                                    <button type="button" onclick="closeModal('declineModal-{{ $request->id }}')" class="text-gray-600">Cancel</button>
                                                    <button type="submit" class="bg-red-600 text-white px-4 py-2 rounded">Submit</button>
                                                </div>
                                            </form>
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

    <script>
        function openModal(id) {
            document.getElementById(id).classList.remove('hidden');
        }

        function closeModal(id) {
            document.getElementById(id).classList.add('hidden');
        }
    </script>
</x-app-layout>
