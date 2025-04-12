<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\User::factory()->create([
            'name' => 'Super Admin',
            'email' => 'super@almarfinance.com',
            'email_verified_at' => now(),
            'password' => Hash::make('password'),
            'created_at' => now(),
            'updated_at' => now()
        ]);
        \App\Models\User::factory()->create([
            'name' => 'Admin Admin',
            'email' => 'admin@almarfinance.com',
            'email_verified_at' => now(),
            'password' => Hash::make('password'),
            'created_at' => now(),
            'updated_at' => now()
        ]);
        \App\Models\User::factory()->create([
            'name' => 'HR Admin',
            'email' => 'hr@almarfinance.com',
            'email_verified_at' => now(),
            'password' => Hash::make('password'),
            'created_at' => now(),
            'updated_at' => now()
        ]);
        \App\Models\User::factory()->create([
            'name' => 'Branch Manager 1',
            'email' => 'branch1@almarfinance.com',
            'email_verified_at' => now(),
            'password' => Hash::make('password'),
            'created_at' => now(),
            'updated_at' => now()
        ]);
        \App\Models\User::factory()->create([
            'name' => 'Branch Manager 2',
            'email' => 'branch2@almarfinance.com',
            'email_verified_at' => now(),
            'password' => Hash::make('password'),
            'created_at' => now(),
            'updated_at' => now()
        ]);
        \App\Models\User::factory()->create([
            'name' => 'Loan Officer',
            'email' => 'officer@almarfinance.com',
            'email_verified_at' => now(),
            'password' => Hash::make('password'),
            'created_at' => now(),
            'updated_at' => now()
        ]);
        \App\Models\User::factory()->create([
            'name' => 'Auditor Admin',
            'email' => 'auditor@almarfinance.com',
            'email_verified_at' => now(),
            'password' => Hash::make('password'),
            'created_at' => now(),
            'updated_at' => now()
        ]);
        \App\Models\User::factory()->create([
            'name' => 'James',
            'email' => 'collector@almarfinance.com',
            'email_verified_at' => now(),
            'password' => Hash::make('password'),
            'created_at' => now(),
            'updated_at' => now()
        ]);
        \App\Models\User::factory()->create([
            'name' => 'Kent',
            'email' => 'collector2@almarfinance.com',
            'email_verified_at' => now(),
            'password' => Hash::make('password'),
            'created_at' => now(),
            'updated_at' => now()
        ]);

        // Create regularized onboarding records for all users
        \App\Models\User::all()->each(function ($user) {
            $onboarding = new \App\Models\EmployeeOnboarding([
                'probation_start_date' => now()->subMonths(3),
                'probation_end_date' => now()->subMonths(2),
                'probation_status' => \App\Models\EmployeeOnboarding::PROBATION_STATUS_COMPLETED,
                'performance_metrics' => 'Exceeded expectations in all key metrics',
                'training_requirements' => 'Completed all required training programs',
                'probation_evaluation' => 'Excellent performance during probation period',
                'regularization_notes' => 'Regularized due to excellent performance',
                'probation_duration' => 30,
                'is_regularized' => true,
                'regularization_date' => now()->subMonths(1)
            ]);
            
            $user->onboarding()->save($onboarding);
            
            // Update user's employment type
            $user->update([
                'employment_type' => 'regular'
            ]);
        });

        $this->call([
            DashboardTableSeeder::class,
            PermissionsTableSeeder::class,
            RolesTableSeeder::class,
            PermissionRoleTableSeeder::class,
            RoleUserTableSeeder::class,
            LeaveCreditSeeder::class,
            // BarangayTableSeeder::class,
            // CityTownTableSeeder::class,
            // CustomerTypeTableSeeder::class,
        ]);
    }
}
