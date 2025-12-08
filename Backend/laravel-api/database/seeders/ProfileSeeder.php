<?php

namespace Database\Seeders;

use App\Models\Profile;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProfileSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Profile::create([
            'user_id' => 1,
            'speciality' => 'Administração',
            'license_number' => '1001XD',
            'phone' => '912345678',
            'address' => 'Rua das Flores, 10',
            'bio' => 'Administrador do sistema.'
        ]);
    }
}
