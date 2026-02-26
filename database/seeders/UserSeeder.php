<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::updateOrCreate(
            ['email' => 'admin@perpusku.com'],
            [
                'name' => 'Admin PerpusKu',
                'password' => 'password',
                'role' => 'admin',
                'is_active' => true,
            ]
        );

        User::updateOrCreate(
            ['email' => 'petugas@perpusku.com'],
            [
                'name' => 'Petugas PerpusKu',
                'password' => 'password',
                'role' => 'petugas',
                'is_active' => true,
            ]
        );

        User::updateOrCreate(
            ['email' => 'user@perpusku.com'],
            [
                'name' => 'User PerpusKu',
                'password' => 'password',
                'role' => 'user',
                'is_active' => true,
            ]
        );
    }
}
