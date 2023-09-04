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
        User::create([
            'surname' => 'Sacedon',
            'first_name' => 'Christian',
            'email' => 'admin@example.com',
            'password' => bcrypt('password'), // Hash the password using Bcrypt
            'role' => 'admin',
        ]);
    }
}
