<?php

namespace Database\Seeders;

use App\Models\AboutUs;
use App\Models\User;
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
        User::create([
            'full_name' => 'Admin',
            'birth_date' => '1990-05-07',
            'phone_number' => '0977436542',
            'account_type' => 'admin',
            'gender' => 'male',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('123456789'),
        ]);

        AboutUs::create([
            'details' => 'About Us Text Here',
        ]);
    }
}
