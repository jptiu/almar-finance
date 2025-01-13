<?php
namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Loan;
use App\Mail\LoanDueNotification;
use Illuminate\Support\Facades\Mail;
use Carbon\Carbon;

class SendLoanDueNotifications extends Command
{
    protected $signature = 'loan:notify-due';
    protected $description = 'Send email notifications for loans due in the next 7 days';

    public function handle()
    {

        /* The code snippet ` = Loan::with([...])->get();` is using Eloquent's `with` method to
        eager load the relationship named 'details' for the 'Loan' model. Within the closure
        function passed to 'details', it is filtering the related 'details' based on the
        'loan_due_date' field being equal to the date one week from the current date. */
        $loans = Loan::with([
            'details' => function ($query) {
                $now = Carbon::now();
                $nextWeek = $now->addWeek();
                $query->whereDate('loan_due_date', '=', $nextWeek->toDateString());
            }
        ])->get();

        foreach ($loans as $loan) {
            Mail::to($loan->customer->email)->send(new LoanDueNotification($loan));
            $this->info('Notification sent to ' . $loan->customer->email);
        }

        $this->info('Loan due notifications completed.');
    }
}
