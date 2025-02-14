<html lang="en">

<head>
    <title>Print Statement</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body>

    <div class="px-2 py-1 max-w-5xl mx-auto">
        <div class="text-center mb-2 mt-2">
            <div class="text-gray-600">
                <div class="text-base font-bold border-b-2 border-gray-300 pb-2">Cashier's Shortage / Overage Report
                </div>
            </div>
        </div>

        <div class="flex justify-between items-center mb-12">
            <div class="flex items-center">
                <div class="text-gray-600">
                    <img class="h-auto" src="/images/almarlogo.png" alt="almar suites">
                    <div class="text-base font-semibold">Almar Freemile Financing Corporation,</div>
                    <div class="text-base font-semibold">{{ $branchlocation }}</div>
                    {{-- <div class="text-md font-semibold">Lapu-Lapu City, Cebu, 6015</div> --}}
                </div>
            </div>
            <div class="flex items-center">
                <div class="text-gray-600">
                    <div class="text-base font-bold">{{ now()->format('F j, Y') }}</div>
                </div>
            </div>
        </div>

        <div class="flex gap-4">
            <div class="w-1/2 overflow-hidden">
                <div class="text-center text-base font-medium border">Expenses</div>
                <table class="w-full text-center border">
                    <thead class="bg-slate-200 text-black">
                        <tr>
                            <th class="p-2 text-xs">Account Title</th>
                            <th class="p-2 text-xs">Justification</th>
                            <th class="p-2 text-xs">Amount</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($expenses as $exp)
                            <tr>
                                <td class="p-2 text-xs">{{ $exp->acc_title }}</td>
                                <td class="p-2 text-xs">{{ $exp->justification }}</td>
                                <td class="p-2 text-xs">{{ $exp->amount }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class="text-right border bg-gray-100 p-2 text-xs">Total:
                    {{ number_format($expenses->sum('amount'), 2) }}</div>
                <div class="text-right border bg-gray-100 p-2 text-xs">Grand Total Expenses:
                    <strong>{{ number_format($expenses->sum('amount'), 2) }}</strong>
                </div>
            </div>

            <div class="w-1/2 overflow-hidden">
                <div class="text-center text-base font-medium border">Breakdown of Cash Bills</div>
                <table class="w-full text-center border">
                    <thead class="bg-slate-200 text-black">
                        <tr>
                            <th class="p-2 text-xs">Denomination</th>
                            <th class="p-2 text-xs">Type</th>
                            <th class="p-2 text-xs">Qty</th>
                            <th class="p-2 text-xs">Amount</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $grandTotal = 0; // Initialize a variable to hold the grand total sum
                        @endphp

                        @foreach ($cashBillData as $denomination => $data)
                            @if ($data['count'] > 0)
                                <tr>
                                    <td class="p-2 text-xs">{{ number_format((float) $data['denomination'], 2) }}</td>
                                    <td class="p-2 text-xs">{{ $data['type'] }}</td>
                                    <td class="p-2 text-xs">{{ $data['count'] }}</td>
                                    <td class="p-2 text-xs">{{ number_format($data['sum'], 2) }}</td>
                                </tr>

                                @php
                                    $grandTotal += $data['sum']; // Add the sum of each row to the grand total
                                @endphp
                            @endif
                        @endforeach
                    </tbody>
                </table>

                <div class="text-right border bg-gray-100 p-2 text-xs">
                    Grand Total Cash: <strong>{{ number_format($grandTotal, 2) }}</strong>
                </div>

            </div>
        </div>

        <div class="flex gap-4 mt-4">
            <div class="w-1/2 overflow-hidden">
                <div class="text-center text-base font-medium border">For Savings Customers</div>
                <table class="w-full text-center border">
                    <thead class="bg-slate-200 text-black">
                        <tr>
                            <th class="p-2 text-xs">Charge Swipe</th>
                            <th class="p-2 text-xs">Savings</th>
                            <th class="p-2 text-xs">Death Aid</th>
                            <th class="p-2 text-xs">Photocopy</th>
                            <th class="p-2 text-xs">Withdraw</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr class="">
                            <td class="p-2 text-xs">{{ $comps->charge_swipe ?? '0.00' }}</td>
                            <td class="p-2 text-xs">{{ $comps->savings ?? '0.00' }}</td>
                            <td class="p-2 text-xs">{{ $comps->death_aid ?? '0.00' }}</td>
                            <td class="p-2 text-xs">{{ $comps->photocopy ?? '0.00' }}</td>
                            <td class="p-2 text-xs">{{ $comps->withdraw ?? '0.00' }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <div class="w-1/2 overflow-hidden">
                <div class="text-center text-base font-medium border">Compute Cash on Hand</div>
                <table class="w-full text-center border">
                    <thead class="bg-slate-200 text-black">
                        <tr>
                            <th class="p-2 text-xs">Ref No.</th>
                            <th class="p-2 text-xs">Cash Beginning</th>
                            <th class="p-2 text-xs">Collections</th>
                            <th class="p-2 text-xs">Add Cash</th>
                            <th class="p-2 text-xs">Add Cash (2nd)</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr class="">
                            <td class="p-2 text-xs">{{ $comps->id ?? 0 }}</td>
                            <td class="p-2 text-xs">{{ $comps->cash_beginning ?? '0.00' }}</td>
                            <td class="p-2 text-xs">{{ $comps->collection ?? '0.00' }}</td>
                            <td class="p-2 text-xs">{{ $comps->add_cash ?? '0.00' }}</td>
                            <td class="p-2 text-xs">{{ $comps->add_cash_2 ?? '0.00' }}</td>
                        </tr>
                        <tr class="border-b-2 border-gray-200 text-left">
                            <td colspan="2" class="text-black p-2 border text-xs"><strong>Total:
                                    {{ number_format(($comps->cash_beginning ?? 0) + ($comps->collection ?? 0) + ($comps->add_cash ?? 0) + ($comps->add_cash_2 ?? 0), 2) }}</strong>
                            </td>
                            <td class="text-black p-2 border text-xs"><strong>Releases:
                                    {{ number_format($comps->loan_releases ?? 0, 2) }}</strong></td>
                            <td class="text-black p-2 border text-xs"><strong>Expenses:
                                    {{ number_format($comps->expenses ?? 0, 2) }}</strong></td>
                            <td class="text-black p-2 border text-xs"><strong>Less:
                                    {{ number_format(($comps->cash_beginning ?? 0) + ($comps->collection ?? 0) + ($comps->add_cash ?? 0) + ($comps->add_cash_2 ?? 0) - ($comps->loan_releases ?? 0) - ($comps->expenses ?? 0), 2) }}</strong>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

        <div class="text-left text-base font-semibold py-2 uppercase mt-2">Regular Accounts</div>
        <div class="flex">
            <div class="w-1/2 overflow-hidden">
                <table class="w-full text-center border">
                    <thead class="border-b-2 border-gray-200 pb-4 bg-slate-200 text-black">
                        <tr>
                            <th class="font-semibold text-base uppercase" colspan="4">Regular Loan</th>
                        </tr>
                        <tr>
                            <th class="font-semibold p-2 text-xs"></th>
                            <th class="font-semibold p-2 text-xs">No. of Cust</th>
                            <th class="font-semibold p-2 text-xs">Rec Amt</th>
                            <th class="font-semibold p-2 text-xs">Actual Collections</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr class="border-b-2 border-gray-200">
                            <td class="text-black p-2 border text-xs">Joyce</td>
                            <td class="text-black p-2 border text-xs">{{ $customerCountRegular }}</td>
                            <td class="text-black p-2 border text-xs">{{ number_format($receivableAmountRegular, 2) }}
                            </td>
                            <td class="text-black p-2 border text-xs">{{ number_format($collectionAmountRegular, 2) }}
                            </td>
                        </tr>
                        {{-- <tr class="border-b-2 border-gray-200 font-bold">
                            <td class="text-black p-2 border text-xs">Total</td>
                            <td class="text-black p-2 border text-xs">323,424.00</td>
                            <td class="text-black p-2 border text-xs">3,722.00</td>
                            <td class="text-black p-2 border text-xs">63,324.00</td>
                        </tr> --}}
                    </tbody>
                </table>
            </div>

            <div class="w-1/2 overflow-hidden">
                <table class="w-full text-center border">
                    <thead class="border-b-2 border-gray-200 pb-4 bg-slate-200 text-black">
                        <tr>
                            <th class="font-semibold text-base uppercase" colspan="3">C/A Monthly</th>
                        </tr>
                        <tr>
                            <th class="font-semibold p-2 text-xs">No. of Cust</th>
                            <th class="font-semibold p-2 text-xs">Receivable Amt</th>
                            <th class="font-semibold p-2 text-xs">Actual Collections</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr class="border-b-2 border-gray-200">
                            <td class="text-black p-2 border text-xs">{{ $customerCountCA }}</td>
                            <td class="text-black p-2 border text-xs">{{ number_format($receivableAmountCA, 2) }}</td>
                            <td class="text-black p-2 border text-xs">{{ number_format($collectionAmountCA, 2) }}</td>
                        </tr>
                        {{-- <tr class="border-b-2 border-gray-200 font-bold">
                            <td class="text-black p-2 border text-xs">323,424.00</td>
                            <td class="text-black p-2 border text-xs">3,722.00</td>
                            <td class="text-black p-2 border text-xs">63,324.00</td>
                        </tr> --}}
                    </tbody>
                </table>
            </div>
        </div>

        <div class="text-left text-base font-semibold py-2 uppercase mt-2">Bad Accounts</div>
        <div class="flex">
            <div class="w-1/2 overflow-hidden">
                <table class="w-full text-center border">
                    <thead class="border-b-2 border-gray-200 pb-4 bg-slate-200 text-black">
                        <tr>
                            <th class="font-semibold text-base uppercase" colspan="4">Active</th>
                        </tr>
                        <tr>
                            <th class="font-semibold p-2 text-xs"></th>
                            <th class="font-semibold p-2 text-xs">No. of Cust</th>
                            <th class="font-semibold p-2 text-xs">Rec. Amt</th>
                            <th class="font-semibold p-2 text-xs">Actual Collections</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr class="border-b-2 border-gray-200">
                            <td class="text-black p-2 border text-xs">Joyce</td>
                            <td class="text-black p-2 border text-xs">{{ $customerCountBad }}</td>
                            <td class="text-black p-2 border text-xs">{{ number_format($receivableAmountBA, 2) }}</td>
                            <td class="text-black p-2 border text-xs">{{ number_format($collectionAmountBA, 2) }}</td>
                        </tr>
                        {{-- <tr class="border-b-2 border-gray-200 font-bold">
                            <td class="text-black p-2 border text-xs">Total</td>
                            <td class="text-black p-2 border text-xs">323,424.00</td>
                            <td class="text-black p-2 border text-xs">3,722.00</td>
                            <td class="text-black p-2 border text-xs">63,324.00</td>
                        </tr> --}}
                    </tbody>
                </table>
            </div>

            <div class="w-1/2 overflow-hidden">
                <table class="w-full text-center border">
                    <thead class="border-b-2 border-gray-200 pb-4 bg-slate-200 text-black">
                        <tr>
                            <th class="font-semibold text-base uppercase" colspan="3">C/A Becomes BA</th>
                        </tr>
                        <tr>
                            <th class="font-semibold p-2 text-xs">No. of Cust</th>
                            <th class="font-semibold p-2 text-xs">Receivable Amt</th>
                            <th class="font-semibold p-2 text-xs">Actual Collections</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr class="border-b-2 border-gray-200">
                            <td class="text-black p-2 border text-xs">{{ $customerCountCABad }}</td>
                            <td class="text-black p-2 border text-xs">{{ number_format($receivableAmountCABA, 2) }}
                            </td>
                            <td class="text-black p-2 border text-xs">{{ number_format($collectionAmountCABA, 2) }}
                            </td>
                        </tr>
                        {{-- <tr class="border-b-2 border-gray-200 font-bold">
                            <td class="text-black p-2 border text-xs">323,424.00</td>
                            <td class="text-black p-2 border text-xs">3,722.00</td>
                            <td class="text-black p-2 border text-xs">63,324.00</td>
                        </tr> --}}
                    </tbody>
                </table>
            </div>
        </div>

        <div class="py-8">
            {{-- <div class="text-gray-600 text-lg font-semibold uppercase">Additional Notes:</div>
            <p>
                Test Note
            </p> --}}
        </div>

    </div>

</body>

</html>
