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
                size: 8.5in 5.5in;
                margin: 0;
            }
            body {
                margin: 0;
                padding: 0;
                width: 100%;
            }
            .print-container {
                width: 8.5in;
                height: 5.5in;
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
            justify-content: space-between;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 0.5em;
        }

        th, td {
            padding: 0.4em;
            border: 1px solid #ccc;
            text-align: left;
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
                    <div class="text-md font-semibold">{{$branchAddress->location ?? 'Branch Location'}}</div>
                </div>
            </div>
            <div class="flex items-center">
                <div class="text-gray-600">
                    <div class="text-md font-bold">Date: {{$withdraw->tran_date}}</div>
                </div>
            </div>
        </div>

        <div class="text-center text-lg font-bold uppercase mb-2 mt-6">
            Savings Withdrawal Form
        </div>

        <!-- Customer Details -->
        <div class="mb-4">
            <div><strong>Account Holder Name:</strong> {{$customer->first_name ?? ''}} {{$customer->middle_name ?? ''}} {{$customer->last_name ?? ''}}</div>
            <div><strong>Address:</strong> {{$customer->house ?? ''}}, {{$customer->street ?? ''}}, {{$customer->barangay ?? ''}}, {{$customer->city ?? ''}}</div>
            <div><strong>Agency:</strong> {{$customer->agency_name ?? ''}}</div>
            <div><strong>Company:</strong> {{$customer->comp_name ?? ''}}</div>
            <div><strong>Amount:</strong> {{$withdraw->amount ?? ''}}</div>
        </div>

        <!-- Transactions Table -->
        <table>
            <thead>
                <tr>
                    <th>Transaction Date</th>
                    <th>Amount Withdrawn</th>
                </tr>
            </thead>
            
            <tbody>
            @foreach ($deposits as $list)
                <tr>
                    <td>{{$list->tran_date}}</td>
                    <td>{{number_format($list->amount, 2)}}</td>
                </tr>
            @endforeach
            </tbody>
        </table>

        <!-- Summary -->
        <div class="mt-4 mb-4 text-gray-600">
            <p class="font-semibold">Total No. of Transactions: {{$deposits->count() }}</p>
            <p class="font-semibold">Total Deposited Amount: {{number_format($total_deposit ?? 0, 2)}}</p>
            <p class="font-semibold">Interest Rate(5%): {{number_format($totalDeposited ?? 0, 2)}}</p>
            <p class="font-semibold">Net Amount Withdrawn: {{number_format($withdraw->net_amount ?? 0, 2)}}</p>
        </div>
    </div>

    <!-- Signatures -->
    <div class="flex justify-between items-center mt-12">
        <div class="text-center">
            <hr class="w-48 mx-auto border-t-2 border-gray-500">
            <p class="mt-1 font-semibold">Received By</p>
        </div>
        <div class="text-center">
            <hr class="w-48 mx-auto border-t-2 border-gray-500">
            <p class="mt-1 font-semibold">Cashier</p>
        </div>
    </div>
</div>

</body>
</html>
