<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Category::create([
            'nama_kategori' => 'Religius',
        ]);
        Category::create([
            'nama_kategori' => 'Beradab',
        ]);
        Category::create([
            'nama_kategori' => 'Pembelajar',
        ]);
        Category::create([
            'nama_kategori' => 'Model',
        ]);
        Category::create([
            'nama_kategori' => 'Cinta Lingkungan',
        ]);
        Category::create([
            'nama_kategori' => 'Profesional',
        ]);
        Category::create([
            'nama_kategori' => 'Sejahera',
        ]);
    }
}
