<?php

namespace Database\Seeders;
use App\Models\Owner;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    
    public function run(): void
    {
        Owner::create([
            'firstname' => 'Bikman',
            'lastname' =>'Djuma',
            'gender' => 'male',
            'phone' => '0785389000',
            'email' => 'ntiruhungwab@gmail.com',
            'role' => 'superAdmin',
            'image' => 'user.png',
            'dob' => '1994-12-20',
            'password' => bcrypt('bugarama'),
        ]);
    }
}
