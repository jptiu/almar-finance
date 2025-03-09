<!DOCTYPE html>
<html>
<head>
    <title>Loan Pending Approval</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            color: #333;
            background-color: #f9f9f9;
            margin: 0;
            padding: 0;
        }
        .email-container {
            max-width: 600px;
            margin: 20px auto;
            background-color: #fff;
            border: 1px solid #ddd;
            border-radius: 8px;
            padding: 20px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }
        h2 {
            color: #0056b3;
        }
        p {
            margin: 10px 0;
        }
        .button {
            display: inline-block;
            background-color: #0056b3;
            color: #fff;
            text-decoration: none;
            padding: 10px 20px;
            border-radius: 5px;
            margin-top: 20px;
        }
        .button:hover {
            background-color: #003d80;
        }
        .footer {
            font-size: 12px;
            color: #666;
            text-align: center;
            margin-top: 20px;
            border-top: 1px solid #ddd;
            padding-top: 10px;
        }
    </style>
</head>
<body>
    <div class="email-container">
        <h2>New Loan Pending Approval</h2>
        <p>Dear HR,</p>
        <p>A new loan request has been submitted by <strong>{{ $loan->customer->first_name.' '.$loan->customer->last_name }}</strong>.</p>
        <p><strong>Loan Details:</strong></p>
        <ul>
            <li><strong>Amount:</strong> {{ number_format($loan->principal_amount, 2) }}</li>
            <li><strong>Date:</strong> {{ $loan->date_of_loan }}</li>
        </ul>
        <p>Please log in to the system to review and take action on this loan request.</p>
        <a href="#" class="button">Review and Approve Loan</a>
        <p>Thank you for your prompt attention to this matter!</p>
        <div class="footer">
            <p>If you have any questions, please contact the support team.</p>
            <p>&copy; {{ date('Y') }} Almar Freemile Financing Corporation. All rights reserved.</p>
        </div>
    </div>
</body>
</html>
