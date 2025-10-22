<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        if (! User::where('email', 'admin@kosatech.com')->exists()) {
            User::factory()->create([
                'name' => 'Admin',
                'email' => 'admin@kosatec.com',
                'password' => 'password',
                'is_admin' => true,
                'is_manager' => true,
                'two_factor_secret' => null,
                'two_factor_confirmed_at' => null,
                'two_factor_recovery_codes' => null,
            ]);
        }
    }
}
