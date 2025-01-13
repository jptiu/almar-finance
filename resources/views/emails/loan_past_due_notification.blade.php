@component('mail::message')
    # Loan Due Reminder

    Hello {{ $loan->customer->first_name }},

    Your loan is past due!

    Loan Due Date: {{ $loan->details }}

    Please settle your dues as soon as possible.

    Thank you for using our service!

    Thanks,
    {{ config('app.name') }}
@endcomponent
