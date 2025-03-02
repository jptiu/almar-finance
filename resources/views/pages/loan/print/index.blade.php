<html lang="en">

<head>
    <title>Print Statement</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 20px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        th, td {
            padding: 10px;
            border: 1px solid #ddd;
            text-align: left;
            text-align: center;
        }
        th {
            background-color: #f4f4f4;
        }
        .label-column {
            width: 30%;
        }
        .data-column {
            width: 70%;
        }
        @media print {
            body {
                font-size: 12pt;
            }
            table {
                page-break-inside: avoid;
            }
        }
    </style>
</head>

<body>

    <div class="px-2 py-1 max-w-5xl mx-auto">
        <div class="flex justify-center items-center mb-4">
            <div class="flex items-center">
                <div class="text-gray-600">
                    <img class="h-auto" src="/images/almarlogo.png" alt="almar suites">
                    <div class="text-base font-semibold">Almar Freemile Financing Corporation</div>
                    <div class="text-base font-semibold"></div>
                </div>
            </div>
            <div class="flex items-center">
                <div class="text-gray-600">
                    <div class="text-base font-bold"></div>
                </div>
            </div>
        </div>

        <hr class="h-px mb-12 bg-gray-200 border-0 dark:bg-gray-700">

        <div class="relative text-center">
            <h2 class="text-2xl md:text-2xl text-slate-800 dark:text-slate-100 font-bold mb-2">Data and Information of the Borrower</h2>
        </div>

        <table>
            <tr>
                <th class="label-column">Subject Matter</th>
                <th class="data-column">Particulars</th>
            </tr>
            <tr>
                <td class="label-column">Full Name</td>
                <td class="data-column">{{$loan->customer->first_name ?? 'N/A'}} {{$loan->customer->middle_name ?? ''}} {{$loan->customer->last_name ?? ""}}</td>
            </tr>
            <tr>
                <td class="label-column">Customer Type</td>
                <td class="data-column">{{$loan->customer->type?? 'N/A'}}</td>
            </tr>
            <tr>
                <td class="label-column">ID</td>
                <td class="data-column">{{$loan->customer->id?? 'N/A'}}</td>
            </tr>
            <tr>
                <td class="label-column">Phone Number</td>
                <td class="data-column">{{$loan->customer->cell_number?? 'N/A'}}</td>
            </tr>
            <tr>
                <td class="label-column">Email Address</td>
                <td class="data-column">{{$loan->customer->email?? 'N/A'}}</td>
            </tr>
            <tr>
                <td class="label-column">Status:</td>
                <td class="data-column">{{$loan->customer->status ?? 'N/A'}}</td>
            </tr>
        </table>

        <div class="relative text-center pt-4">
            <h2 class="text-2xl md:text-2xl text-slate-800 dark:text-slate-100 font-bold mb-2">Loan Details</h2>
        </div>

        <table>
            <tr>
                <th class="label-column">Subject Matter</th>
                <th class="data-column">Particulars</th>
            </tr>
            <tr>
                <td class="label-column">Transaction No.</td>
                <td class="data-column">{{$loan->trans_no?? 'N/A'}}</td>
            </tr>
            <tr>
                <td class="label-column">Loan Type</td>
                <td class="data-column">{{$loan->loan_type ?? 'N/A'}}</td>
            </tr>
            <tr>
                <td class="label-column">Date of Loan</td>
                <td class="data-column">{{$loan->date_of_loan}}</td>
            </tr>
            <tr>
                <td class="label-column">Transaction Type</td>
                <td class="data-column">{{$loan->transaction_type ?? 'N/A'}}</td>
            </tr>
        </table>

        <div class="relative text-center pt-4">
            <h2 class="text-2xl md:text-2xl text-slate-800 dark:text-slate-100 font-bold mb-2">Terms of Payment</h2>
        </div>

        <table>
            <tr>
                <th class="label-column">Subject Matter</th>
                <th class="data-column">Particulars</th>
            </tr>
            <tr>
                <td class="label-column">Principal Amount</td>
                <td class="data-column">{{$loan->principal_amount??'N/A'}}</td>
            </tr>
            <tr>
                <td class="label-column">Interest ( % )</td>
                <td class="data-column">{{$loan->interest?? 'N/A'}}</td>
            </tr>
            <tr>
                <td class="label-column">Interest Amount</td>
                <td class="data-column">{{$loan->interest_amount?? 'N/A'}}</td>
            </tr>
            <tr>
                <td class="label-column">Service Charge</td>
                <td class="data-column">{{$loan->svc_charge?? 'N/A'}}</td>
            </tr>
            <tr>
                <td class="label-column">Payable Amount</td>
                <td class="data-column">{{$loan->payable_amount?? 'N/A'}}</td>
            </tr>
            <tr>
                <td class="label-column">Days to Pay</td>
                <td class="data-column">{{$loan->days_to_pay}}</td>
            </tr>
            <tr>
                <td class="label-column">Months to Pay</td>
                <td class="data-column">{{$loan->months_to_pay?? 'N/A'}}</td>
            </tr>
            <tr>
                <td class="label-column">Actual Record</td>
                <td class="data-column">{{$loan->actual_record?? 'N/A'}}</td>
            </tr>
        </table>


</body>

</html>
