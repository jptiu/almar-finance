<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Print Withdrawal</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        /* General Styling */
        body {
            font-family: Arial, sans-serif;
        }

        /* Page Layout for Print */
        @media print {
            @page {
                size: 8.5in auto;
                margin: 0;
            }
            body {
                margin: 0;
                padding: 0;
                width: 100%;
            }
            .print-container {
                width: 8.5in;
                min-height: 5.5in;
                padding: 0.4in;
                box-sizing: border-box;
                overflow: hidden;
            }
        }

        /* Desktop Styling (Preview) */
        .print-container {
            max-width: 8.5in;
            min-height: 5.5in;
            padding: 0.5in;
            margin: auto;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            display: flex;
            flex-direction: column;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 0.5em;
        }

        th, td {
            padding: 0.4em;
            border: 1px solid #ccc;
            text-align: center;
        }

        th {
            background-color: #f5f5f5;
        }

        .footer {
            text-align: center;
            margin-top: auto;
            font-size: 0.9rem;
        }
    </style>
</head>
<body>

<div class="print-container">
    <div>

        <div class="flex justify-between items-center">
            <div class="flex items-center">
                <div class="text-gray-600">
                    <img class="h-auto" src="/images/almarlogo.png" alt="Almar Suites">
                    <div class="text-md font-semibold">Almar Freemile Financing Corporation</div>
                    {{-- <div class="text-md font-semibold">{{$company->location}}</div> --}}
                </div>
            </div>
            <div class="flex items-center">
                <div class="text-gray-600">
                    <div class="text-md font-bold">Trans. No: {{ $loan->id }}</div>
                </div>
            </div>
        </div>

        <div class="text-center text-lg font-bold uppercase mb-2 mt-6">
            Customer Loan History
        </div>

        <div class="mb-4">
            <div><strong>ID:</strong> {{ $loan->id }}</div>
            <div><strong>Customer Name:</strong> {{ $loan->customer->first_name }}
            {{ $loan->customer->last_name }}</div>
            <div><strong>Address:</strong> {{ $loan->customer->house ?? '' }}, {{ $loan->customer->street ?? '' }},  
            {{ $loan->customer->barangay ?? '' }}, {{ $loan->customer->city ?? '' }}</div>
            <div><strong>Debit Amount:</strong> {{ number_format($loan->principal_amount,2)}} LND</div>
            <div><strong>Interest Amount:</strong> {{ $loan->interest_amount }} INT</div>
            <div><strong>Date of loan:</strong> {{ $loan->date_of_loan }}</div>
        </div>

        <table>
            <thead>
            <tr>
                <th>Line</th>
                <th>Date</th>
                <th>Credit</th>
                <th>Balance</th>
                <th>Particular</th>
            </tr>
            </thead>
            <tbody
                class="bg-white divide-y divide-gray-200 dark:divide-gray-500 dark:bg-gray-900">
                @foreach ($loan->details as $details)
                    <tr>
                        <td
                            class="px-4 py-4 text-sm font-medium text-gray-500 dark:text-gray-200 whitespace-nowrap">
                            {{ $details->loan_day_no }}
                        </td>
                        <td class="px-4 py-4 text-sm text-gray-500 dark:text-gray-300 whitespace-nowrap due-date"
                            data-detail-id="{{ $details->id }}"
                            data-due-date="{{ $details->loan_due_date }}">
                            {{ $details->loan_due_date }}
                        </td>
                        <td
                            class="px-4 py-4 text-sm text-gray-500 dark:text-gray-300 whitespace-nowrap">
                            {{ $details->loan_due_amount }}
                        </td>
                        <td
                            class="px-4 py-4 text-sm text-gray-500 dark:text-gray-300 whitespace-nowrap">
                            {{ $details->loan_running_balance }}
                        </td>
                      
                        <td
                            class="px-4 py-4 text-sm text-gray-500 dark:text-gray-300 whitespace-nowrap">
                            PMT {{ $loan->transaction_type }}
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    {{-- <div class="flex justify-between items-center">
        <div class="items-center">
            <hr class="w-full mt-2" />
            <div class="text-center mt-2">Account Holder's Signature</div>
        </div>
        <div class="items-center">
            <hr class="w-full mt-2" />
            <div class="text-center mt-2">Processed By:</div>
        </div>
    </div> --}}
</div>

</body>
</html>
