@component('mail::message')
# Loan Due Reminder

Dear {{ $loan->customer->first_name }},

This is a friendly reminder that your loan (Loan ID: {{ $loan->id }}) is due on {{ $loan->details }}.

Please make arrangements to settle the payment on or before the due date.

Thanks,  
{{ config('app.name') }}
@endcomponent
