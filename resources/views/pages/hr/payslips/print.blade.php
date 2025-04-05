<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Payslip - ALMAR FINANCE</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
            background-color: white;
            color: #1f2937;
        }

        .header {
            text-align: center;
            margin-bottom: 30px;
        }

        .company-info {
            text-align: center;
            margin-bottom: 20px;
        }

        .payslip-info {
            margin-bottom: 20px;
        }

        .payslip-info h2 {
            margin-bottom: 10px;
        }

        .table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        .table th, .table td {
            border: 1px solid #000;
            padding: 8px;
            text-align: left;
        }

        .table th {
            background-color: #f5f5f5;
        }

        .total {
            font-weight: bold;
            text-align: right;
        }

        .signature {
            margin-top: 50px;
            text-align: right;
        }

        .print-only {
            display: block;
        }

        .no-print {
            display: none;
        }

        @media print {
            .print-only {
                display: block !important;
            }
            .no-print {
                display: none !important;
            }
        }
    </style>
</head>
<body>
    <div class="header">
        <div class="company-info">
            <h1>ALMAR FINANCE</h1>
            <p>Address Line 1</p>
            <p>Manila, Philippines</p>
        </div>
    </div>

    <div class="payslip-info">
        <h2>Payslip</h2>
        <table class="table">
            <tr>
                <td>Employee Name:</td>
                <td>{{ $payslip->employee->name }}</td>
            </tr>
            <tr>
                <td>Employee ID:</td>
                <td>{{ $payslip->employee->id }}</td>
            </tr>
            <tr>
                <td>Pay Period:</td>
                <td>{{ $payslip->pay_period_start->format('M d') }} - {{ $payslip->pay_period_end->format('M d') }}</td>
            </tr>
            <tr>
                <td>Date:</td>
                <td>{{ now()->format('M d') }}</td>
            </tr>
        </table>
    </div>

    <table class="table">
        <thead>
            <tr>
                <th colspan="2">Earnings</th>
                <th>Amount</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td colspan="2">Basic Salary</td>
                <td class="total">₱{{ number_format($payslip->basic_salary, 2) }}</td>
            </tr>
            <tr>
                <td colspan="2">Overtime Pay</td>
                <td class="total">₱{{ number_format($payslip->overtime_pay, 2) }}</td>
            </tr>
            <tr>
                <td colspan="2">Allowances</td>
                <td class="total">₱{{ number_format($payslip->allowances, 2) }}</td>
            </tr>
            <tr>
                <td colspan="2" class="total">Total Earnings</td>
                <td class="total">₱{{ number_format($payslip->basic_salary + $payslip->overtime_pay + $payslip->allowances, 2) }}</td>
            </tr>
        </tbody>
    </table>

    <table class="table">
        <thead>
            <tr>
                <th colspan="2">Deductions</th>
                <th>Amount</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td colspan="2">SSS Contribution</td>
                <td class="total">₱{{ number_format($payslip->sss_contribution, 2) }}</td>
            </tr>
            <tr>
                <td colspan="2">PhilHealth</td>
                <td class="total">₱{{ number_format($payslip->philhealth_contribution, 2) }}</td>
            </tr>
            <tr>
                <td colspan="2">Pag-IBIG</td>
                <td class="total">₱{{ number_format($payslip->pagibig_contribution, 2) }}</td>
            </tr>
            <tr>
                <td colspan="2">Tax Deduction</td>
                <td class="total">₱{{ number_format($payslip->tax_deduction, 2) }}</td>
            </tr>
            <tr>
                <td colspan="2">Cash Advance</td>
                <td class="total">₱{{ number_format($payslip->cash_advance, 2) }}</td>
            </tr>
            <tr>
                <td colspan="2">Other Deductions</td>
                <td class="total">₱{{ number_format($payslip->other_deductions, 2) }}</td>
            </tr>
            <tr>
                <td colspan="2" class="total">Total Deductions</td>
                <td class="total">₱{{ number_format($payslip->calculateTotalDeductions(), 2) }}</td>
            </tr>
        </tbody>
    </table>

    <table class="table">
        <thead>
            <tr>
                <th colspan="2">Summary</th>
                <th>Amount</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td colspan="2" class="total">Net Pay</td>
                <td class="total">₱{{ number_format($payslip->net_pay, 2) }}</td>
            </tr>
        </tbody>
    </table>

    <div class="signature">
        <p>_______________________</p>
        <p>Authorized Signatory</p>
    </div>

    <div class="text-center no-print">
        <button onclick="window.print()" class="print-only">
            Print
        </button>
        <a href="{{ route('payslips.pdf', $payslip) }}" class="print-only ml-4">
            Download PDF
        </a>
    </div>
</body>
</html>
