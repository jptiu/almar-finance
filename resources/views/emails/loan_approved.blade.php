<!DOCTYPE html>
<html>
<head>
    <title>{{ config('app.name') }} - Loan Approved</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap');
    </style>
</head>
<body class="bg-gray-50 flex items-center justify-center min-h-screen font-[Inter]">
    <div class="bg-white shadow-xl rounded-xl p-8 max-w-2xl w-full mx-4 my-8">
        <!-- Header with Logo -->
        <div class="text-center mb-8">
            <h1 class="text-2xl font-bold text-gray-900 flex items-center justify-center gap-2">
                <span class="text-3xl">🎉</span>
                Congratulations!
            </h1>
            <p class="text-lg text-emerald-600 font-medium">Your Loan Has Been Approved</p>
        </div>

        <!-- Greeting -->
        <p class="text-gray-700 text-lg">
            Dear <span class="font-semibold">{{ $loan->customer->first_name }} {{ $loan->customer->last_name }}</span>,
        </p>
        <p class="mt-4 text-gray-600 leading-relaxed">
            We are pleased to inform you that your loan application has been successfully approved. We've prepared a detailed summary of your loan terms below.
        </p>
        
        <!-- Loan Summary Card -->
        <div class="mt-6 bg-gray-50 rounded-xl p-6 border border-gray-100">
            <h3 class="text-lg font-semibold text-gray-800 mb-4">Loan Details</h3>
            <div class="grid gap-4">
                <div class="grid grid-cols-2 items-center py-2 border-b border-gray-200">
                    <span class="text-gray-600">Loan ID:</span>
                    <span class="font-medium text-gray-800">{{ $loan->id }}</span>
                </div>
                <div class="grid grid-cols-2 items-center py-2 border-b border-gray-200">
                    <span class="text-gray-600">Principal Amount:</span>
                    <span class="font-medium text-gray-800">₱{{ number_format($loan->principal_amount, 2) }}</span>
                </div>
                <div class="grid grid-cols-2 items-center py-2 border-b border-gray-200">
                    <span class="text-gray-600">Interest Rate:</span>
                    <span class="font-medium text-gray-800">{{ number_format($loan->interest_rate, 2) }}%</span>
                </div>
                <div class="grid grid-cols-2 items-center py-2 border-b border-gray-200">
                    <span class="text-gray-600">Term Length:</span>
                    <span class="font-medium text-gray-800">{{ $loan->term_months }} months</span>
                </div>
                <div class="grid grid-cols-2 items-center py-2 border-b border-gray-200">
                    <span class="text-gray-600">Monthly Payment:</span>
                    <span class="font-medium text-gray-800">₱{{ number_format($loan->monthly_payment, 2) }}</span>
                </div>
                <div class="grid grid-cols-2 items-center py-2">
                    <span class="text-gray-600">Status:</span>
                    <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-emerald-100 text-emerald-800">
                        Approved
                    </span>
                </div>
            </div>
        </div>

        <!-- Next Steps -->
        <div class="mt-8 bg-blue-50 rounded-xl p-6">
            <h3 class="text-lg font-semibold text-blue-900 mb-3">Next Steps</h3>
            <ul class="list-disc list-inside space-y-2 text-blue-800">
                <li>Our team will contact you shortly to process the disbursement</li>
                <li>Please prepare your valid ID for verification</li>
                <li>Review the loan agreement that will be sent separately</li>
            </ul>
        </div>

        <!-- Footer -->
        <div class="mt-8 pt-6 border-t border-gray-200">
            <p class="text-gray-700">Thank you for choosing {{ config('app.name') }}. If you have any questions, please don't hesitate to contact our support team.</p>
            <div class="mt-4">
                <p class="font-semibold text-gray-800">Best regards,</p>
                <p class="text-gray-700">The {{ config('app.name') }} Team</p>
            </div>
        </div>

        <div class="mt-8 pt-4 border-t border-gray-200">
            <p class="text-sm text-gray-500 text-center">
                This is an automated message. Please do not reply to this email.
            </p>
        </div>
    </div>
</body>
</html>