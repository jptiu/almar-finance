<!DOCTYPE html>
<html>
<head>
    <title>{{ config('app.name') }} - Loan Approved</title>
</head>
<body class="bg-gray-100 flex items-center justify-center min-h-screen">
    <div class="bg-white shadow-lg rounded-lg p-6 max-w-lg w-full">
        <h2 class="text-xl font-bold text-gray-800">🎉 Your Loan Has Been Approved</h2>
        <p class="mt-3 text-gray-700">Dear <span class="font-semibold">{{ $loan->customer->first_name }} {{ $loan->customer->last_name }}</span>,</p>
        <p class="mt-2 text-gray-600">
            We are pleased to inform you that your loan request has been approved. Below are the loan details:
        </p>
        
        <div class="mt-4 border rounded-lg overflow-hidden">
            <table class="w-full border-collapse">
                <thead class="bg-blue-500 text-white">
                    <tr>
                        <th class="p-3 text-left">Loan ID</th>
                        <th class="p-3 text-left">Amount</th>
                        <th class="p-3 text-left">Status</th>
                    </tr>
                </thead>
                <tbody class="text-gray-700">
                    <tr class="border-t">
                        <td class="p-3">{{ $loan->id }}</td>
                        <td class="p-3">₱{{ number_format($loan->principal_amount, 2) }}</td>
                        <td class="p-3 text-green-600 font-semibold">
                            {{ $loan->status !== null ? 'Approved' : 'Pending' }}
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>

        <p class="mt-4 text-gray-700">Thank you for choosing our service.</p>
        <p class="font-semibold text-gray-800">Best regards,</p>
        <p class="text-gray-700">{{ config('app.name') }}</p>

        <p class="mt-4 text-sm text-gray-500 border-t pt-2">
            This is a system-generated email. Please do not reply.
        </p>
    </div>
</body>
</html>




<!-- <body>
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
</body> -->