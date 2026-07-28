<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    /**
     * Creates one starter account per role so you can log in and test
     * each dashboard immediately after migrating. Change these passwords
     * (or delete these accounts) before deploying anywhere real.
     */
    public function run(): void
    {
        User::firstOrCreate(
            ['email' => 'admin@umutekano.test'],
            [
                'full_name' => 'RIB Administrator',
                'name' => 'RIB Administrator',
                'phone' => '0780000001',
                'role' => 'admin',
                'is_active' => true,
                'email_verified_at' => now(),
                'password' => Hash::make('password'),
            ]
        );

        User::firstOrCreate(
            ['email' => 'investigator@umutekano.test'],
            [
                'full_name' => 'Jean Investigator',
                'name' => 'Jean Investigator',
                'phone' => '0780000002',
                'role' => 'investigator',
                'is_active' => true,
                'email_verified_at' => now(),
                'password' => Hash::make('password'),
            ]
        );

        User::firstOrCreate(
            ['email' => 'witness@umutekano.test'],
            [
                'full_name' => 'Sample Witness',
                'name' => 'Sample Witness',
                'phone' => '0780000003',
                'role' => 'witness',
                'is_active' => true,
                'email_verified_at' => now(),
                'password' => Hash::make('password'),
            ]
        );
    }
}
