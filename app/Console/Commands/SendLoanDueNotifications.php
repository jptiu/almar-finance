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

        $loans = Loan::with([
            'details' => function ($query) {
                $now = Carbon::now();
                $nextWeek = $now->addWeek();
                $query->whereDate('loan_due_date', '=', $nextWeek->toDateString());
            }
        ])->get();
        \Log::info($loans);

        foreach ($loans as $loan) {
            Mail::to('jhonpatricktiu@gmail.com')->send(new LoanDueNotification($loan));
            $this->info('Notification sent to ' . 'jhonpatricktiu@gmail.com');
        }

        $this->info('Loan due notifications completed.');
    }
}
