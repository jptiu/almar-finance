<html lang="en">

<head>
    <title>Print Statement</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body>

    <div class="px-2 py-1 max-w-5xl mx-auto">

        <div class="flex justify-between items-center">
            <div class="flex items-center">
                <div class="text-gray-600">
                    <img class="h-auto" src="/images/almarlogo.png" alt="almar suites">
                    <div class="text-md font-semibold">Almar Freemile Financing Corporation,</div>
                    <div class="text-md font-semibold">Therese Joy's Arcade, Pusok</div>
                    <div class="text-md font-semibold">Lapu-Lapu City, Cebu, 6015</div>
                </div>
            </div>
            <div class="flex items-center">
                <div class="text-gray-600">
                    <div class="text-md font-bold">{{ now()->format('F j, Y') }}</div>
                </div>
            </div>
        </div>

        <div class="flex items-center justify-between mb-2 mt-8 border-b-2 border-gray-300 pb-2">
            <div class="flex items-center">
                <div class="text-gray-600">
                    <div class="text-md font-normal uppercase">Customer ID: <span
                            class="text-md font-semibold">{{ $loan->customer->id }}</span></div>
                    <div class="text-md font-normal uppercase">Customer Name: <span
                            class="text-md font-semibold">{{ $loan->customer->first_name }} {{ $loan->customer->last_name }}</span>
                    </div>
                    <div class="text-md font-normal uppercase">Customer Address: <span
                            class="text-md font-semibold">{{ $loan->customer->house }} {{ $loan->customer->street }}
                            {{ $loan->customer->bry->barangay_name }} {{ $loan->customer->cty->city_town }}</span></div>
                </div>
            </div>
            <div class="flex items-center">
            </div>
        </div>

        <div class="flex justify-between items-center mt-2 mb-8">
            <div class="flex items-center">
                <div class="text-gray-600">
                    <div class="text-md font-normal py-4">Position: <span
                            class="text-md font-semibold">{{ $loan->customer->job_position }}</span></div>
                    <div class="text-md font-normal uppercase">Type of Loan: <span
                            class="text-md font-semibold">{{ $loan->loan_type }}</span></div>
                    <div class="text-md font-normal uppercase">Amount Release: <span
                            class="text-md font-semibold"></span></div>
                    <div class="text-md font-normal uppercase">Interest Rate: <span
                            class="text-md font-semibold">{{ $loan->interest }}%</span></div>
                    <div class="text-md font-normal uppercase">Penalty Rate: <span class="text-md font-semibold"></span>
                    </div>
                    <div class="text-md font-normal uppercase">Interest Amount: <span
                            class="text-md font-semibold">{{ number_format($loan->interest_amount, 2) }}</span>
                    </div>
                    <div class="text-md font-normal uppercase">Total Payable Amount: <span
                            class="text-md font-semibold">{{ number_format($loan->payable_amount,2) }}</span>
                    </div>
                </div>
            </div>
            <div class="flex items-center">
                <div class="text-gray-600">
                    <div class="text-md font-normal uppercase">Date Release: <span class="text-md font-semibold"></span>
                    </div>
                    <div class="text-md font-normal uppercase">Due Date: <span
                            class="text-md font-semibold">{{ $loan->latestDue->loan_due_date ?? ''}}</span></div>
                    <div class="text-md font-normal uppercase">Terms: <span class="text-md font-semibold"></span></div>
                    <div class="text-md font-normal uppercase">Mode of Payment: <span
                            class="text-md font-semibold"></span></div>
                    <div class="text-md font-normal py-4">Starting Payments: <span
                            class="text-md font-semibold">{{ optional($loan->startDue)->first()?->loan_due_date ?? '' }}
                        </span>
                    </div>
                </div>
            </div>
        </div>

        <table class="w-full text-center mb-4 mt-4 border">
            <div class="text-md font-semibold uppercase">Computation</div>
            <div class="text-center text-lg font-semibold">Outstanding Accounts</div>
            <thead class="border-b-2 border-gray-200 pb-4 bg-slate-200 text-black">
                <tr>
                    <th class="font-semibold p-2">Regular Balance</th>
                    <th class="font-semibold p-2">Cash Advance</th>
                </tr>
            </thead>
            <tbody>
                <tr class="border-b-2 border-gray-200">
                    <td class="text-black p-2 border w-1/2">
                        @if ($loan->transaction_type !== 'CA')
                            Interest {{ $loan->interest }}% 
                            <span class="font-semibold">
                                per month ({{ $loan->months_to_pay }} mos. Past Due)
                            </span><br>
                            Total Regular Over Due
                        @else
                            N/A
                        @endif
                    </td>
                    <td class="text-black p-2 border">
                        @if ($loan->transaction_type === 'CA')
                            Interest 5%:
                            <span class="font-semibold">
                                {{ $loan->months_to_pay }} mo. Only
                            </span><br>
                            Total Interest Over Due:
                            <span class="font-semibold">17 mos</span>
                        @else
                            N/A
                        @endif
                    </td>
                </tr>
            </tbody>
        </table>
        

        <div class="text-right">
            OVERALL TOTAL BALANCE: <strong>{{number_format($loan->details->sum('loan_due_amount'), 2)}}</strong>
        </div>

        <div class="mb-2">
            <div class="flex items-center">
                <div class="text-gray-600">
                    <div class="text-md font-semibold uppercase py-4">Co-maker:</div>
                    <div class="text-md font-normal uppercase">1. <span class="text-md font-semibold"></span></div>
                    <div class="text-md font-normal uppercase">2. <span class="text-md font-semibold"></span></div>
                </div>
            </div>
        </div>

        <div class="py-8">
            <div class="text-gray-600 text-md font-semibold uppercase">Note:</div>
            <p>
                w/ Print Out Support
            </p>
        </div>

        <div class="flex items-center justify-center">
            <div class="flex items-center">
                <div class="text-gray-600">
                    <div class="text-md font-semibold">Prepared by:</div>
                    <img class="h-auto w-1/2" src="/images/sample signature.png" alt="almar suites">
                    <div class="text-lg font-bold">Estrellada, Michelle</div>
                    <div class="text-md font-normal">Clerk</div>
                </div>
            </div>
            <div class="flex items-center">
                <div class="text-gray-600">
                    <div class="text-md font-semibold">Approved by:</div>
                    <img class="h-auto w-1/2" src="/images/sample signature.png" alt="almar suites">
                    <div class="text-lg font-bold">Cabahug, Lleyn</div>
                    <div class="text-md font-normal">Manager</div>
                </div>
            </div>
        </div>

    </div>

</body>

</html>
