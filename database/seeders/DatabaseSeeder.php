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

        User::create([
            'username' => 'supervisor1',
            'surname' => 'CAST',
            'first_name' => 'Department Head',
            'password' => bcrypt('password'), // Hash the password using Bcrypt
            'role' => 'supervisor',
        ]);

        User::create([
            'username' => 'supervisor2',
            'surname' => 'CCJ',
            'first_name' => 'Department Head',
            'password' => bcrypt('password'), // Hash the password using Bcrypt
            'role' => 'supervisor',
        ]);

        User::create([
            'username' => 'supervisor3',
            'surname' => 'COE',
            'first_name' => 'Department Head',
            'password' => bcrypt('password'), // Hash the password using Bcrypt
            'role' => 'supervisor',
        ]);

        User::create([
            'username' => 'supervisor4',
            'surname' => 'CON',
            'first_name' => 'Department Head',
            'password' => bcrypt('password'), // Hash the password using Bcrypt
            'role' => 'supervisor',
        ]);

        User::create([
            'username' => 'supervisor5',
            'surname' => 'CABM-H',
            'first_name' => 'Department Head',
            'password' => bcrypt('password'), // Hash the password using Bcrypt
            'role' => 'supervisor',
        ]);

        User::create([
            'username' => 'supervisor6',
            'surname' => 'CABM-M',
            'first_name' => 'Department Head',
            'password' => bcrypt('password'), // Hash the password using Bcrypt
            'role' => 'supervisor',
        ]);
    }
}
