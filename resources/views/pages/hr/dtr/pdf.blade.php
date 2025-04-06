<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <style>
        body {
            font-family: DejaVu Sans, sans-serif;
            padding: 20px;
        }
        .header {
            text-align: center;
            margin-bottom: 20px;
        }
        .company-name {
            font-size: 18px;
            font-weight: bold;
            margin-bottom: 5px;
        }
        .title {
            font-size: 16px;
            margin-bottom: 15px;
        }
        .info {
            margin-bottom: 20px;
        }
        .info-row {
            margin-bottom: 5px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
            font-size: 12px;
        }
        th, td {
            border: 1px solid #000;
            padding: 5px;
            text-align: left;
        }
        th {
            background-color: #f0f0f0;
        }
        .summary {
            margin-top: 20px;
        }
        .signature-line {
            margin-top: 50px;
            border-top: 1px solid #000;
            width: 200px;
            text-align: center;
            float: right;
        }
    </style>
</head>
<body>
    <div class="header">
        <div class="company-name">ALMAR FINANCE</div>
        <div class="title">DAILY TIME RECORD</div>
    </div>

    <div class="info">
        <div class="info-row">
            <strong>Employee:</strong> {{ $employee->name }}
        </div>
        <div class="info-row">
            <strong>Period:</strong> {{ $startDate->format('F d, Y') }} - {{ $endDate->format('F d, Y') }}
        </div>
        <div class="info-row">
            <strong>Branch:</strong> {{ $employee->branch->location ?? 'N/A' }}
        </div>
    </div>

    <table>
        <thead>
            <tr>
                <th>Date</th>
                <th>Clock In</th>
                <th>Clock Out</th>
                <th>Hours</th>
                <th>Late</th>
                <th>Undertime</th>
                <th>Status</th>
                <th>Deductions</th>
                <th>Net Amount</th>
            </tr>
        </thead>
        <tbody>
            @foreach($records as $record)
                <tr>
                    <td>
                        {{ $record->attendance_date->format('M d, Y') }}
                        @if($record->is_sunday)
                            (Sunday)
                        @elseif($record->is_branch_meeting)
                            (Branch Meeting)
                        @endif
                    </td>
                    <td>{{ $record->clock_in_formatted }}</td>
                    <td>{{ $record->clock_out_formatted }}</td>
                    <td>{{ number_format($record->working_hours, 2) }}</td>
                    <td>{{ $record->late_minutes }}</td>
                    <td>{{ $record->undertime_minutes }}</td>
                    <td>{{ ucfirst($record->status) }}</td>
                    <td>₱{{ number_format($record->deductions, 2) }}</td>
                    <td>₱{{ number_format($record->net_amount, 2) }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <div class="summary">
        <p><strong>Summary:</strong></p>
        <p>Total Late Minutes: {{ $totalLateMinutes }}</p>
        <p>Total Undertime Minutes: {{ $totalUndertimeMinutes }}</p>
        <p>Total Deductions: ₱{{ number_format($totalDeductions, 2) }}</p>
        <p>Total Net Amount: ₱{{ number_format($totalNetAmount, 2) }}</p>
    </div>

    <div class="signature-line">
        <p>Employee Signature</p>
    </div>
</body>
</html>
