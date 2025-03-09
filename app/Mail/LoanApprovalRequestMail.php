<?php
namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class LoanApprovalRequestMail extends Mailable
{
    use Queueable, SerializesModels;

    public $loan;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($loan)
    {
        $this->loan = $loan;
        // $this->customer = $loan->customer->first_name.' '.$loan->customer->last_name;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('New Loan Pending Approval')
                    ->view('emails.loan_approval_request');
    }
}
