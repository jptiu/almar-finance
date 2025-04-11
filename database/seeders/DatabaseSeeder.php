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
