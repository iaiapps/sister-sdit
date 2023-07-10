<?php

namespace Database\Seeders;

use App\Models\School;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SchoolSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        School::create([
            'icon' => 'bi bi-buildings',
            'name' => 'Sekolah',
            'description' => 'SDIT Harapan Umat Jember',
        ]);
        School::create([
            'icon' => 'bi bi-123',
            'name' => 'NPSN',
            'description' => '20554128',
        ]);
        School::create([
            'icon' => 'bi bi-geo-alt',
            'name' => 'Alamat Sekolah',
            'description' => 'Jl. Danau Toba, Gg. Islamic Center, Tegalgede, Kec. Sumbersari, Kabupaten Jember, Jawa Timur 68124',
        ]);
        School::create([
            'icon' => 'bi bi-globe2',
            'name' => 'web',
            'description' => 'www.sditharum.id',
        ]);
        School::create([
            'icon' => 'bi bi-envelope',
            'name' => 'Email',
            'description' => 'sditharum@gmail.com',
        ]);
    }
}
