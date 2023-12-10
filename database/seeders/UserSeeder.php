<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // User
        User::create([
            'name' => 'admin',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('password'),
            'role_id' => 1
        ]);
        User::create([
            'name' => 'operator',
            'email' => 'operator@gmail.com',
            'password' => Hash::make('password'),
            'role_id' => 1
        ]);
        User::create([
            'name' => 'teacher',
            'email' => 'teacher@gmail.com',
            'password' => Hash::make('password'),
            'role_id' => 2
        ]);
        User::create([
            'name' => 'student',
            'email' => 'student@gmail.com',
            'password' => Hash::make('password'),
            'nis' => '1234',
            'role_id' => 3
        ]);
        User::create([
            'name' => 'keuangan',
            'email' => 'keuangan@gmail.com',
            'password' => Hash::make('password'),
            'role_id' => 4
        ]);
        User::create([
            'name' => 'sarpras',
            'email' => 'sarpras@gmail.com',
            'password' => Hash::make('password'),
            'role_id' => 5
        ]);
        User::create([
            'name' => 'pustaka',
            'email' => 'pustaka@gmail.com',
            'password' => Hash::make('password'),
            'role_id' => 6
        ]);
    }
}
