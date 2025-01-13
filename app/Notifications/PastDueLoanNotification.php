<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class PastDueLoanNotification extends Notification implements ShouldQueue
{
    use Queueable;

    protected $loanDetails;

    public function __construct($loanDetails)
    {
        $this->loanDetails = $loanDetails;
    }

    public function via($notifiable)
    {
        return ['mail'];
    }

    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->subject('Loan Past Due Notification')
            ->greeting('Hello ' . $notifiable->first_name . ',')
            ->line('Your loan is past due!')
            ->line('Loan Due Date: ' . $this->loanDetails)
            ->line('Please settle your dues as soon as possible.')
            ->action('View Loan Details', url('/loans/' . $this->loanDetails->id))
            ->line('Thank you for using our service!');
    }
}
