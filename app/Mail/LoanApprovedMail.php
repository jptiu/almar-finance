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
        if (file_exists(storage_path('app/loan_documents/' . $this->loan->id . '/affidavit_form.docx'))) {
            $message->attach(storage_path('app/loan_documents/' . $this->loan->id . '/affidavit_form.docx'), [
                'as' => 'Affidavit_Form_' . $this->loan->id . '.docx',
                'mime' => 'application/vnd.openxmlformats-officedocument.wordprocessingml.document'
            ]);
        }

        if (file_exists(storage_path('app/loan_documents/' . $this->loan->id . '/agreement.docx'))) {
            $message->attach(storage_path('app/loan_documents/' . $this->loan->id . '/agreement.docx'), [
                'as' => 'Agreement_' . $this->loan->id . '.docx',
                'mime' => 'application/vnd.openxmlformats-officedocument.wordprocessingml.document'
            ]);
        }

        if (file_exists(storage_path('app/loan_documents/' . $this->loan->id . '/cash-breakdown.docx'))) {
            $message->attach(storage_path('app/loan_documents/' . $this->loan->id . '/cash-breakdown.docx'), [
                'as' => 'Cash_Breakdown_' . $this->loan->id . '.docx',
                'mime' => 'application/vnd.openxmlformats-officedocument.wordprocessingml.document'
            ]);
        }

        if (file_exists(storage_path('app/loan_documents/' . $this->loan->id . '/disclosure-statement.docx'))) {
            $message->attach(storage_path('app/loan_documents/' . $this->loan->id . '/disclosure-statement.docx'), [
                'as' => 'Disclosure_Statement_' . $this->loan->id . '.docx',
                'mime' => 'application/vnd.openxmlformats-officedocument.wordprocessingml.document'
            ]);
        }

        if (file_exists(storage_path('app/loan_documents/' . $this->loan->id . '/promissory-atm-1.docx'))) {
            $message->attach(storage_path('app/loan_documents/' . $this->loan->id . '/promissory-atm-1.docx'), [
                'as' => 'Promissory_ATM_1_' . $this->loan->id . '.docx',
                'mime' => 'application/vnd.openxmlformats-officedocument.wordprocessingml.document'
            ]);
        }

        if (file_exists(storage_path('app/loan_documents/' . $this->loan->id . '/promissory-atm-2.docx'))) {
            $message->attach(storage_path('app/loan_documents/' . $this->loan->id . '/promissory-atm-2.docx'), [
                'as' => 'Promissory_ATM_2_' . $this->loan->id . '.docx',
                'mime' => 'application/vnd.openxmlformats-officedocument.wordprocessingml.document'
            ]);
        }

        if (file_exists(storage_path('app/loan_documents/' . $this->loan->id . '/spa.docx'))) {
            $message->attach(storage_path('app/loan_documents/' . $this->loan->id . '/spa.docx'), [
                'as' => 'SPA_' . $this->loan->id . '.docx',
                'mime' => 'application/vnd.openxmlformats-officedocument.wordprocessingml.document'
            ]);
        }

        if (file_exists(storage_path('app/loan_documents/' . $this->loan->id . '/voucher.docx'))) {
            $message->attach(storage_path('app/loan_documents/' . $this->loan->id . '/voucher.docx'), [
                'as' => 'Voucher_' . $this->loan->id . '.docx',
                'mime' => 'application/vnd.openxmlformats-officedocument.wordprocessingml.document'
            ]);
        }

        return $message;
    }
}