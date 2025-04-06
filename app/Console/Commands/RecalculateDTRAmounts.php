<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\DailyTimeRecord;

class RecalculateDTRAmounts extends Command
{
    protected $signature = 'dtr:recalculate';
    protected $description = 'Recalculate net amounts for all DTR records based on salary data';

    public function handle()
    {
        $this->info('Starting DTR recalculation...');

        $records = DailyTimeRecord::with(['employee.salaries' => function($query) {
            $query->where('status', 'active')
                  ->orderBy('effective_date', 'desc');
        }])->get();

        $bar = $this->output->createProgressBar(count($records));
        $bar->start();

        foreach ($records as $record) {
            $record->calculateNetAmount();
            $record->save();
            $bar->advance();
        }

        $bar->finish();
        $this->newLine();
        $this->info('DTR recalculation completed!');
    }
}
