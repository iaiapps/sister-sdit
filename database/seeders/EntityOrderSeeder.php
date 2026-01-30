<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\EntityOrder;

class EntityOrderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $roles = ['guru', 'tendik', 'karyawan'];
        $order = 1;

        foreach ($roles as $role) {
            $users = User::role($role)
                ->orderBy('id')
                ->get();

            foreach ($users as $user) {
                EntityOrder::updateOrCreate(
                    ['user_id' => $user->id],
                    [
                        'role' => $role,
                        'order' => $order++
                    ]
                );
            }
        }
    }
}
