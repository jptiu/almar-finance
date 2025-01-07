<x-app-layout>
<div class="container mx-auto p-6">
    <!-- Page Header -->
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold text-gray-800">Loan Information</h1>
       
    </div>

    <!-- Loan Details Section -->
    <div class="bg-white shadow-md rounded-lg p-6">
        <div class="flex items-center text-gray-600 mb-8">
            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7">
                </path>
            </svg>
            <a href="{{ route('loan.index') }}" class="text-base font-semibold">Back</a>
        </div>
        <h2 class="text-lg font-semibold text-gray-800 mb-4">Customer Information</h2>
        <div class="grid grid-cols-2 gap-4">
            <div>       
                <p class="text-gray-900 text-sm">ID:</p>
                <p class="font-bold text-gray-900 text-base">13567</p>
            </div>
            <div>
                <p class="text-gray-900 text-sm">Customer Name:</p>
                <p class="font-bold text-gray-900 text-base">Lea Mae Ornopia
                </p>
            </div>
            <div>
                <p class="text-gray-900 text-sm">Customer Type:</p>
                <p class="font-bold text-gray-900 text-base">SAL014</p>
            </div>
            <div>
                <p class="text-gray-900 text-sm">Status:</p>
                <p class="font-bold text-gray-900 text-base">AC</p>
            </div>
        </div>
    </div>

    <!-- Loan Payment Details -->
    <div class="bg-white shadow-md rounded-lg p-6 mt-6">
        <h2 class="text-lg font-semibold text-gray-800 mb-4">Loan Payment Details</h2>
        <div class="grid grid-cols-2 gap-4">
            <div>
                <p class="text-gray-900 text-sm">Transaction No.:</p>
                <p class="font-bold text-gray-900 text-base">13567</p>
            </div>
            <div>
                <p class="text-gray-900 text-sm">Date of Loan:</p>
                <p class="font-bold text-gray-900 text-base">2024-12-22</p>
            </div>
            <div>
                <p class="text-gray-900 text-sm">Loan Type:</p>
                <p class="font-bold text-gray-900 text-base">Monthly</p>
            </div>
            <div>
                <p class="text-gray-900 text-sm">Transaction Type:</p>
                <p class="font-bold text-gray-900 text-base">W/COLLAT</p>
            </div>
        </div>
    </div>

    <!-- Terms of Payment -->
    <div class="bg-white shadow-md rounded-lg p-6 mt-6">
        <h2 class="text-lg font-semibold text-gray-800 mb-4">Terms of Payment</h2>
        <div class="grid grid-cols-2 gap-4">
            <div>
                <p class="text-gray-900 text-sm">Principal Amount:</p>
                <p class="font-bold text-gray-900 text-base">20,000.00</p>
            </div>
            <div>
                <p class="text-gray-900 text-sm">Interest:</p>
                <p class="font-bold text-gray-900 text-base">4</p>
            </div>
            <div>
                <p class="text-gray-900 text-sm">Interest Amount:</p>
                <p class="font-bold text-gray-900 text-base">1,600.00</p>
            </div>
            <div>
                <p class="text-gray-900 text-sm">Service Charge:</p>
                <p class="font-bold text-gray-900 text-base">0</p>
            </div>
            <div>
                <p class="text-gray-900 text-sm">Payable Amount:</p>
                <p class="font-bold text-gray-900 text-base">21,600.00</p>
            </div>
            <div>
                <p class="text-gray-900 text-sm">Days to Pay:</p>
                <p class="font-bold text-gray-900 text-base">60</p>
            </div>
            <div>
                <p class="text-gray-900 text-sm">Months to Pay:</p>
                <p class="font-bold text-gray-900 text-base">2</p>
            </div>
            <div>
                <p class="text-gray-900 text-sm">Actual Record:</p>
                <p class="font-bold text-gray-900 text-base">Business</p>
            </div>
        </div>

        <!-- Action Buttons -->
        <div class="flex justify-end mt-6 gap-4">
            <button class="bg-red-500 hover:bg-red-600 text-white py-2 px-4 rounded">
                Decline
            </button>
            <button class="bg-green-500 hover:bg-green-600 text-white py-2 px-4 rounded">
                Approve
            </button>
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
