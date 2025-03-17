<?php

// app/Mail/RenewalApproved.php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class RenewalApproved extends Mailable
{
    use Queueable, SerializesModels;

    public $customerName;
    public $renewalDate;
    public $expirationDate;
    public $totalAmount;

    public function __construct($customerName, $renewalDate, $expirationDate, $totalAmount)
    {
        $this->customerName = $customerName;
        $this->renewalDate = $renewalDate;
        $this->expirationDate = $expirationDate;
        $this->totalAmount = $totalAmount;
    }

    public function build()
    {
        return $this->view('emails.renewal_approved')
            ->subject('Your Renewal Has Been Approved');
    }
}