<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        User::create([
            'name' => 'Admin Jose Machado',
            'email' => 'admin@example.com',
            'password' => Hash::make('atec123'),
            'role_id' => 1, // Admin
        ]);

        User::create([
            'name' => 'Terapeuta John Doe',
            'email' => 'terapeuta@example.com',
            'password' => Hash::make('atec123'),
            'role_id' => 2,
        ]);

        User::create([
            'name' => 'User paciente',
            'email' => 'user@example.com',
            'password' => Hash::make('atec123'),
            'role_id' => 3,
        ]);

        User::factory(30)->create();
    }
}
