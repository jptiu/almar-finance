<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class LoanApprovedMail extends Mailable
{
    use Queueable, SerializesModels;

    public $loan;

    /**
     * Create a new message instance.
     *
     * @param $loan
     */
    public function __construct($loan)
    {
        $this->loan = $loan;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $message = $this->subject('Loan Approved')
            ->view('emails.loan_approved')
            ->with(['loan' => $this->loan]);

        // Add application form attachment  
        if (file_exists(storage_path('app/loan_documents/' . $this->loan->id . '/application_form.docx'))) {
            $message->attach(storage_path('app/loan_documents/' . $this->loan->id . '/application_form.docx'), [
                'as' => 'Application_Form_' . $this->loan->id . '.docx',
                'mime' => 'application/vnd.openxmlformats-officedocument.wordprocessingml.document'
            ]);
        }

        // Add loan agreement PDF attachment
        if (file_exists(storage_path('app/loan_documents/' . $this->loan->id . '/voucher_form.xlsx'))) {
            $message->attach(storage_path('app/loan_documents/' . $this->loan->id . '/voucher_form.xlsx'), [
                'as' => 'Voucher_Form_' . $this->loan->id . '.xlsx',
                'mime' => 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet'
            ]);
        }

        // Add amortization schedule attachment
        if (file_exists(storage_path('app/loan_documents/' . $this->loan->id . '/amortization_schedule.pdf'))) {
            $message->attach(storage_path('app/loan_documents/' . $this->loan->id . '/amortization_schedule.pdf'), [
                'as' => 'Amortization_Schedule_' . $this->loan->id . '.pdf',
                'mime' => 'application/pdf'
            ]);
        }

        return $message;
    }
}