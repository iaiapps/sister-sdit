<?php

namespace Database\Seeders;

use App\Models\Student;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class StudentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //student
        Student::create([
            'user_id' => 3,
            'full_name' => 'student',
            'nis' => '1234'
        ]);
    }
}
