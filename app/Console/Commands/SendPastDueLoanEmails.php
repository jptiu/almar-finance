<?php

namespace App\Console\Commands;

use App\Mail\LoanPastDueNotification;
use App\Models\Loan;
use Illuminate\Console\Command;
use App\Models\LoanDetails;
use App\Notifications\PastDueLoanNotification;
use Carbon\Carbon;
use Mail;

class SendPastDueLoanEmails extends Command
{
    protected $signature = 'loans:send-past-due-emails';
    protected $description = 'Send email notifications for past-due loans';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        $today = Carbon::now();
        dd($today->toDateString());
        // Query loans past due and not marked as paid
        $loans = Loan::with([
            'customer',
            'details' => function ($query) {
                $today = Carbon::now();
                $query->whereDate('loan_due_date', '<', $today);
            }
        ])->get();

        foreach ($loans as $loan) {
            Mail::to($loan->customer->email)->send(new LoanPastDueNotification($loan));
            $this->info('Notification sent to ' . $loan->customer->email);
        }

        $this->info('Past-due loan email notifications have been sent.');
    }
}
