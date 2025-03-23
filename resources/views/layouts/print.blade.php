<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Loan Summary Report</title>
    <style>
        @media print {
            @page {
                margin: 1cm;
            }
            body {
                margin: 0;
                padding: 0;
            }
            table {
                width: 100%;
                border-collapse: collapse;
            }
            th, td {
                border: 1px solid #ddd;
                padding: 8px;
            }
            th {
                background-color: #f5f5f5;
            }
            h1 {
                font-size: 24px;
            }
            p {
                font-size: 16px;
            }
        }
    </style>
</head>
<body>
    <div class="container mx-auto px-4 py-8">
        <div class="text-center mb-8">
            <h1 class="text-2xl font-bold">ALMAR FREEMILE FINANCING CORPORATION</h1>
            <p class="text-xl font-bold">{{ auth()->user()->branch->location }}</p>
            <p class="text-lg font-semibold">Loan Summary Report</p>
            <p class="text-lg font-semibold">Date Range: {{ $startDate }} to {{ $endDate }}</p>
        </div>

        <table class="w-full border-collapse border border-gray-300">
            <thead>
                <tr class="bg-gray-100">
                    <th class="border border-gray-300 p-2 text-left">Trans #</th>
                    <th class="border border-gray-300 p-2 text-left">Customer Name</th>
                    <th class="border border-gray-300 p-2 text-left">Customer Type</th>
                    <th class="border border-gray-300 p-2 text-left">Mos</th>
                    <th class="border border-gray-300 p-2 text-left">Type</th>
                    <th class="border border-gray-300 p-2 text-left">Address</th>
                    <th class="border border-gray-300 p-2 text-left">Loan Amount</th>
                    <th class="border border-gray-300 p-2 text-left">Interest Rate</th>
                    <th class="border border-gray-300 p-2 text-left">Interest Amount</th>
                    <th class="border border-gray-300 p-2 text-left">Net Release</th>
                </tr>
            </thead>
            <tbody>
                @foreach($loans as $loan)
                <tr>
                    <td class="border border-gray-300 p-2">{{ $loan->id }}</td>
                    <td class="border border-gray-300 p-2">{{ $loan->customer->first_name }} {{ $loan->customer->last_name }}</td>
                    <td class="border border-gray-300 p-2">{{ $loan->customer->customerType->description }}</td>
                    <td class="border border-gray-300 p-2">{{ $loan->months_to_pay }}</td>
                    <td class="border border-gray-300 p-2">{{ $loan->transaction_type }}</td>
                    <td class="border border-gray-300 p-2">
                        {{ $loan->customer->house }}, {{ $loan->customer->street }}, 
                        {{ $loan->customer->barangay_name }}, {{ $loan->customer->city_town }}
                    </td>
                    <td class="border border-gray-300 p-2">{{ number_format($loan->principal_amount, 2) }}</td>
                    <td class="border border-gray-300 p-2">{{ $loan->interest_rate }}</td>
                    <td class="border border-gray-300 p-2">{{ number_format($loan->interest_amount, 2) }}</td>
                    <td class="border border-gray-300 p-2">{{ number_format($loan->principal_amount - $loan->interest_amount, 2) }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</body>
</html>
