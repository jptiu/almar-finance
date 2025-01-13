<!DOCTYPE html>
<html>
<head>
    <title>Loan Pending Approval</title>
</head>
<body>
    <h2>New Loan Pending Approval</h2>
    <p>Dear HR,</p>
    <p>A new loan request has been submitted by {{ $loan->customer_id }}.</p>
    <p><strong>Loan Amount:</strong> {{ number_format($loan->principal_amount, 2) }}</p>
    <p><strong>Loan Date:</strong> {{ $loan->date_of_loan }}</p>
    <p>Please log in to the system to review and approve the loan.</p>
    <p>Thank you!</p>
</body>
</html>
