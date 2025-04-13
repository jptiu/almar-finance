<?php

namespace Database\Seeders;

use App\Models\LeaveCredit;
use Illuminate\Database\Seeder;

class LeaveCreditSeeder extends Seeder
{
    public function run()
    {
        // Create default leave credits for all employees
        $employees = \App\Models\User::get();
        
        foreach ($employees as $employee) {
            LeaveCredit::createDefaultCredits($employee);
        }
    }
}
