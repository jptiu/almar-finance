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
            font-size: 9pt;
        }

        .header {
            text-align: center;
            margin-bottom: 30px;
            padding-top: 15px;
            border-bottom: 2px solid #000;
        }

        .company-info {
            text-align: center;
            margin-bottom: 15px;
        }

        .company-info h1 {
            font-size: 18pt;
            margin-bottom: 3px;
            color: #111827;
        }

        .company-info p {
            margin: 3px 0;
            color: #4b5563;
        }

        .payslip-info {
            margin-bottom: 20px;
            border: 1px solid #e5e7eb;
            padding: 15px;
            background-color: #f9fafb;
        }

        .payslip-info h2 {
            margin-bottom: 10px;
            color: #111827;
            font-size: 14pt;
        }

        .payslip-info table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 0;
        }

        .payslip-info td {
            padding: 6px;
            border-bottom: 1px solid #e5e7eb;
        }

        .table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        .table th, .table td {
            border: 1px solid #e5e7eb;
            padding: 8px;
            text-align: left;
            vertical-align: middle;
            font-size: 8pt;
        }

        .table th {
            background-color: #f3f4f6;
            color: #111827;
            font-weight: 600;
            text-transform: uppercase;
            font-size: 9pt;
            letter-spacing: 0.5px;
        }

        .total {
            font-weight: 600;
            text-align: right;
            color: #111827;
        }

        .total-cell {
            background-color: #f3f4f6;
            font-weight: 600;
            color: #111827;
        }

        .signature {
            margin-top: 40px;
            text-align: right;
            padding-top: 20px;
            border-top: 2px solid #000;
        }

        .signature p {
            margin: 3px 0;
            color: #374151;
            font-size: 8pt;
        }

        /* PDF-specific styles */
        @page {
            size: A4;
            margin: 20mm;
        }

        body {
            margin: 0;
            padding: 0;
        }

        /* Print-specific styles */
        @media print {
            body {
                background-color: white;
            }
        }
    </style>
</head>
<body>
    <div class="header">
        <div class="company-info">
            <h1>ALMAR FREEMILE FINANCE CORP</h1>
            <p>{{ $branchLocation }}</p>
        </div>
    </div>

    <div class="payslip-info">
        <h2>Payslip</h2>
        <table>
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
                <th>Item</th>
                <th>Description</th>
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
            <tr class="total-cell">
                <td colspan="2">Total Earnings</td>
                <td class="total">₱{{ number_format($payslip->basic_salary + $payslip->overtime_pay + $payslip->allowances, 2) }}</td>
            </tr>
        </tbody>
    </table>

    <table class="table">
        <thead>
            <tr>
                <th>Item</th>
                <th>Description</th>
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
            <tr class="total-cell">
                <td colspan="2">Total Deductions</td>
                <td class="total">₱{{ number_format($payslip->calculateTotalDeductions(), 2) }}</td>
            </tr>
        </tbody>
    </table>

    <table class="table">
        <thead>
            <tr>
                <th>Summary</th>
                <th></th>
                <th>Amount</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td colspan="2">Net Pay</td>
                <td class="total">₱{{ number_format($payslip->net_pay, 2) }}</td>
            </tr>
        </tbody>
    </table>

    <div class="signature">
        <p>_______________________</p>
        <p>Authorized Signatory</p>
    </div>
</body>
</html>
