<?php

namespace Database\Seeders;

// use App\Models\Role;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Role::create([
            'name' => 'admin',
            'guard_name' => 'web'
        ]);

        Role::create([
            'name' => 'operator',
            'guard_name' => 'web'
        ]);
        Role::create([
            'name' => 'guru',
            'guard_name' => 'web'
        ]);

        Role::create([
            'name' => 'tendik',
            'guard_name' => 'web'
        ]);

        // Role::create([
        //     'name' => 'Keuangan',
        // ]);

        // Role::create([
        //     'name' => 'Sarpras',
        // ]);

        // Role::create([
        //     'name' => 'Pustaka',
        // ]);
    }
}
