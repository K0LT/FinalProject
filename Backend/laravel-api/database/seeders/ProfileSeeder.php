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
            'specialty' => 'Administração',
            'license_number' => '1001XD',
            'phone' => '912345678',
            'address' => 'Rua das Flores, 10',
            'bio' => 'Administrador do sistema.'
        ]);


        Profile::create([
            'user_id' => 2,
            'specialty' => 'Fisioterapia',
            'license_number' => '2001DW',
            'phone' => '913456789',
            'address' => 'Avenida Central, 45',
            'bio' => 'Terapeuta especialista em reabilitação.'
        ]);


        Profile::create([
            'user_id' => 1,
            'specialty' => 'Acupuntura',
            'license_number' => 'DWAWDAWF',
            'phone' => '914567890',
            'address' => 'Rua Nova, 78',
            'bio' => 'Terapeuta com 10 anos de experiência em acupuntura.'
        ]);


        Profile::create([
            'user_id' => 2,
            'specialty' => 'Nutrição',
            'license_number' => 'Disorder',
            'phone' => '915678901',
            'address' => 'Praça da Saúde, 12',
            'bio' => 'Nutricionista clínica.'
        ]);


    }
}
