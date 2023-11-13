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
            'username' => 'admin',
            'surname' => 'HR',
            'first_name' => 'Administrator',
            'password' => bcrypt('password'), // Hash the password using Bcrypt
            'role' => 'admin',
        ]);


        \App\Models\User::factory(10)->create();
    }
}
