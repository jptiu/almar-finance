<!DOCTYPE html>
<html>
<head>
    <title>{{ config('app.name') }} - Loan Approved</title>
</head>
<body>
    <h1 style="font-weight: bold; font-size: 24px;">Your Loan Has Been Approved</h1>
    <p style="font-size: 18px;">Dear {{ $loan->customer->first_name }} {{ $loan->customer->last_name }},</p>
    <p style="font-size: 18px;">We are pleased to inform you that your loan request has been approved. Below are the loan details:</p>
    <table style="border-collapse: collapse; width: 100%;" border="1">
        <tr>
            <th style="padding: 8px;">Loan ID</th>
            <th style="padding: 8px;">Amount</th>
            <th style="padding: 8px;">Status</th>
        </tr>
        <tr>
            <td style="padding: 8px;">{{ $loan->id }}</td>
            <td style="padding: 8px;">{{ number_format($loan->principal_amount, 2) }}</td>
            <td style="padding: 8px;">{{ $loan->status!==null ? 'Approved' : 'Pending' }}</td>
        </tr>
    </table>
    <p style="font-size: 18px;">Thank you for choosing our service.</p>
    <p style="font-size: 18px;">Best regards,</p>
    <p style="font-size: 18px;">{{ config('app.name') }}</p>
    <br>
    <p style="font-size: 14px;">This is a system-generated e-mail. Please do not reply.</p>
</body>
</html>
