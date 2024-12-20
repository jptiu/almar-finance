<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class LoanDueNotification extends Mailable
{
    use Queueable, SerializesModels;

    public $loan;

    public function __construct($loan)
    {
        $this->loan = $loan;
    }

    public function build()
    {
        return $this->subject('Loan Due Reminder')
                    ->markdown('emails.loan_due_notification')
                    ->with('loan', $this->loan);
    }
}
