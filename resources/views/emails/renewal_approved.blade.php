# Your Renewal Has Been Approved

Dear {{ $customerName }},

We are pleased to inform you that your renewal request has been approved. Below are the details of your renewed subscription:

<table cellpadding="0" cellspacing="0" border="0" width="100%" style="border-collapse: collapse;">
    <tr>
        <td style="padding: 10px; border: 1px solid #ddd; background-color: #fff;">Renewal Date</td>
        <td style="padding: 10px; border: 1px solid #ddd; background-color: #fff;">{{ $renewalDate }}</td>
    </tr>
    <tr>
        <td style="padding: 10px; border: 1px solid #ddd; background-color: #fff;">Expiration Date</td>
        <td style="padding: 10px; border: 1px solid #ddd; background-color: #fff;">{{ $expirationDate }}</td>
    </tr>
    <tr>
        <td style="padding: 10px; border: 1px solid #ddd; background-color: #fff;">Total Amount</td>
        <td style="padding: 10px; border: 1px solid #ddd; background-color: #fff;">{{ $totalAmount }}</td>
    </tr>
</table>

Your account has been updated, and you can continue to enjoy our services without any interruption. If you have any questions or concerns, please don't hesitate to reach out to us.

Thank you for choosing our service, and we look forward to continuing to serve you.

Best regards,
{{ config('app.name') }}

