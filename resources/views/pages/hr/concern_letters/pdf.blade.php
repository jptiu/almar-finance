<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Employee Concern Letter</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
            background-color: white;
            color: #1f2937;
            font-size: 10pt;
        }

        .header {
            text-align: center;
            margin-bottom: 30px;
            padding-top: 15px;
            border-bottom: 2px solid #000;
        }

        .company-info {
            text-align: center;
            margin-bottom: 20px;
        }

        .letter-body {
            margin-bottom: 20px;
        }

        .letter-content {
            margin: 20px 0;
        }

        .signature {
            margin-top: 50px;
            text-align: right;
            padding-top: 30px;
            border-top: 2px solid #000;
        }

        .signature p {
            margin: 5px 0;
            color: #374151;
        }

        .table {
            width: 100%;
            border-collapse: collapse;
            margin: 10px 0;
        }

        .table th, .table td {
            border: 1px solid #000;
            padding: 8px;
            text-align: left;
            vertical-align: top;
        }

        .table th {
            font-weight: bold;
            background-color: #f3f4f6;
        }

        .date {
            text-align: right;
            margin-bottom: 20px;
        }
    </style>
</head>
<body>
    <div class="header">
        <div class="company-info">
            <h1>ALMAR FREEMILE FINANCE CORP</h1>
            <p>{{ $letter->user->branch->location }}</p>
        </div>
    </div>

    <div class="letter-body">
        <div class="date">
            <p>Date: {{ $letter->date_issued->format('F d, Y') }}</p>
        </div>

        {{-- <p>Dear {{ $letter->user->name }},</p> --}}

        <div class="letter-content">
            {{-- <p>This letter is to formally notify you regarding the following concern:</p> --}}

            <table class="table">
                <tr>
                    <th>Subject:</th>
                    <td>{{ $letter->subject }}</td>
                </tr>
                <tr>
                    <th>Status:</th>
                    <td>{{ ucfirst($letter->status) }}</td>
                </tr>
                <tr>
                    <th>Employee:</th>
                    <td>{{ $letter->user->name }} ({{ $letter->user->email }})</td>
                </tr>
                <tr>
                    <th>Department:</th>
                    <td>{{ $letter->user->department }}</td>
                </tr>
                <tr>
                    <th>Date Issued:</th>
                    <td>{{ $letter->date_issued->format('F d, Y') }}</td>
                </tr>
                <tr>
                    <th>Return Date:</th>
                    <td>{{ $letter->return_date ? $letter->return_date->format('F d, Y') : 'N/A' }}</td>
                </tr>
                <tr>
                    <th>Description:</th>
                    <td>{{ $letter->description }}</td>
                </tr>
            </table>

        </div>

        {{-- <p>Sincerely,</p> --}}
        <div class="signature">
            <p>_______________________</p>
            <p>{{ $letter->issuer->name }}</p>
            <p>{{ $letter->issuer->position }}</p>
            <p>Date: {{ now()->format('F d, Y') }}</p>
        </div>

        @if($letter->status === 'accepted')
        <div class="signature">
            <p>_______________________</p>
            <p>{{ $letter->approver->name }}</p>
            <p>{{ $letter->approver->position }}</p>
            <p>Date: {{ now()->format('F d, Y') }}</p>
        </div>
        @endif
    </div>
</body>
</html>
