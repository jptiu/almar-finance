<?php

namespace App\Console\Commands;

use App\Models\LeaveCredit;
use App\Models\User;
use Illuminate\Console\Command;

class AddLeaveCredits extends Command
{
    protected $signature = 'leave:credits:add {--force : Force recreation of existing credits}';
    protected $description = 'Add default leave credits for all employees';

    public function handle()
    {
        $employees = User::all();
        
        foreach ($employees as $employee) {
            $this->info("Processing employee: {$employee->name}");
            
            if (!$this->option('force')) {
                $existingCredits = LeaveCredit::where('employee_id', $employee->id)->exists();
                if ($existingCredits) {
                    $this->warn("Skipping {$employee->name} - Credits already exist");
                    continue;
                }
            }

            LeaveCredit::createDefaultCredits($employee);
            $this->info("Added default credits for {$employee->name}");
        }

        $this->info('Leave credits processing completed');
    }
}
