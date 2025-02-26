<html lang="en">

<head>
    <title>Print Statement</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body>

    <div class="px-2 py-1 max-w-5xl mx-auto">
        <div class="text-center mb-2 mt-2">
            <div class="text-gray-600">
                <div class="text-base font-bold border-b-2 border-gray-300 pb-2">Customer Profile Report</div>
            </div>
        </div>

        <div class="flex justify-between items-center mb-12">
            <div class="flex items-center">
                <div class="text-gray-600">
                    <img class="h-auto" src="/images/almarlogo.png" alt="almar suites">
                    <div class="text-base font-semibold">Almar Freemile Financing Corporation,</div>
                    <div class="text-base font-semibold"></div>
                    {{-- <div class="text-md font-semibold">Lapu-Lapu City, Cebu, 6015</div> --}}
                </div>
            </div>
            <div class="flex items-center">
                <div class="text-gray-600">
                    <div class="text-base font-bold"></div>
                </div>
            </div>
        </div>

        <!-- Date Filed and Customer ID -->
        <!-- <div class="flex justify-between mb-4">
            <p><span class="font-bold">Date Filed:</span> 11/13/24</p>
            <p><span class="font-bold">Date Released:</span> 11/14/24</p>
            <p><span class="font-bold">Customer ID:</span> 10257</p>
        </div> -->

        <!-- Section Template -->
        <!-- <div>
            <button class="w-full text-left font-bold bg-gray-200 px-4 py-2 rounded-md focus:outline-none">
                Loan Details
            </button>
            <div id="loan-details" class="p-4 bg-gray-50 rounded-md ">
                <div class="grid grid-cols-2 gap-4">
                    <p><span class="font-bold">Proposed Loan:</span> ₱20,000.00</p>
                    <p><span class="font-bold">Terms:</span> 4 months</p>
                    <p><span class="font-bold">Interest:</span> 4%</p>
                </div>
            </div>
        </div> -->

        <div class="mt-4 border-2 border-gray-500">
            <div class="flex flex-col justify-start p-4">
                <div class="leading-loose mb-6">
                    <p><span class="font-bold text-gray-900 text-base">Full Name:</span> {{$loan->customer->first_name ?? 'N/A'}} {{$loan->customer->middle_name ?? ''}} {{$loan->customer->last_name ?? ""}}</p>
                    <p><span class="font-bold text-gray-900 text-base">Customer Type:</span> {{$loan->customer->type?? 'N/A'}}</p>
                    <p><span class="font-bold text-gray-900 text-base">Status:</span> {{$loan->customer->status ?? 'N/A'}}</p>
                    <p><span class="font-bold text-gray-900 text-base">ID:</span> {{$loan->customer->id?? 'N/A'}}</p>
                </div>
                <div class="relative">
                    <h2 class="text-2xl md:text-2xl text-slate-800 dark:text-slate-100 font-bold mb-2">Loan Payment Details</h2>
                    <hr class="h-px my-4 mb-4 bg-gray-200 border-0 dark:bg-gray-700">
                </div>
                <div class="mb-6">
                    <div class="grid grid-cols-2 gap-8 mt-4 mb-12 text-sm text-gray-500">
                        <div>
                            <p class="text-gray-900 text-sm">Transaction No.</p>
                            <p class="font-bold text-gray-900 text-base">{{$loan->trans_no?? 'N/A'}}</p>
                        </div>
                        <div>
                            <p class="text-gray-900 text-sm">Date of Loan </p>
                            <p class="font-bold text-gray-900 text-base">{{$loan->date_of_loan}}</p>
                        </div>
                        <div>
                            <p class="text-gray-900 text-sm">Loan Type</p>
                            <p class="font-bold text-gray-900 text-base">{{$loan->loan_type ?? 'N/A'}}</p>
                        </div>
                        <div>
                            <p class="text-gray-900 text-sm">Transaction Type</p>
                            <p class="font-bold text-gray-900 text-base">{{$loan->transaction_type ?? 'N/A'}}</p>
                        </div>
                    </div>
                </div>
                <div class="relative">
                    <h2 class="text-2xl md:text-2xl text-slate-800 dark:text-slate-100 font-bold mb-2">Terms of Payment</h2>
                    <hr class="h-px my-4 mb-4 bg-gray-200 border-0 dark:bg-gray-700">
                </div>
                <div class="">
                    <div class="grid grid-cols-2 gap-8 mt-4 mb-12 text-sm text-gray-500">
                        <div>
                            <p class="text-gray-900 text-sm">Principal Amount</p>
                            <p class="font-bold text-gray-900 text-base">{{$loan->principal_amount??'N/A'}}</p>
                        </div>
                        <div>
                            <p class="text-gray-900 text-sm">Interest</p>
                            <p class="font-bold text-gray-900 text-base">{{$loan->interest?? 'N/A'}}</p>
                        </div>
                        <div>
                            <p class="text-gray-900 text-sm">Interest Amount</p>
                            <p class="font-bold text-gray-900 text-base"value="" placeholder="₱">{{$loan->interest_amount?? 'N/A'}}</p>
                        </div>
                        <div>
                            <p class="text-gray-900 text-sm">Service Charge</p>
                            <p class="font-bold text-gray-900 text-base">{{$loan->svc_charge?? 'N/A'}}</p>
                        </div>
                        <div>
                            <p class="text-gray-900 text-sm">Payable Amount</p>
                            <p class="font-bold text-gray-900 text-base">{{$loan->payable_amount?? 'N/A'}}</p>
                        </div>
                        <div>
                            <p class="text-gray-900 text-sm">Days to Pay</p>
                            <p class="font-bold text-gray-900 text-base">{{$loan->days_to_pay}}</p>
                        </div>
                        <div>
                            <p class="text-gray-900 text-sm">Months to Pay</p>
                            <p class="font-bold text-gray-900 text-base">{{$loan->months_to_pay?? 'N/A'}}</p>
                        </div>
                        <div>
                            <p class="text-gray-900 text-sm">Actual Record </p>
                            <p class="font-bold text-gray-900 text-base">{{$loan->actual_record?? 'N/A'}}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

</body>

</html>
