<?php

namespace Database\Seeders;

use App\Models\Patient;
use App\Models\Profile;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Psy\Util\Str;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call(RoleSeeder::class);

        // <editor-fold desc="Creation of users and profiles manually.">
        $profile1 = Profile::create([
            'specialty' => 'Acupunturista',
            'license_number' => '111111',
            'phone' => '912345678',
            'address' => 'Rua ABC, 123',
            'bio' => 'Especialista em medicina chinesa',

        ]);
        $user1 = User::create([
            'name' => 'Denys Drogachov',
            'email' => 'denys@example.com',
            'password' => bcrypt('password'),
            'role_id' => 1,
            'remember_token' => '1234567890'
        ]);
        $user1->profiles()->attach($profile1->id);

        $profile2 = Profile::create([
            'specialty' => 'Nutricionista',
            'license_number' => '222222',
            'phone' => '987654321',
            'address' => 'Rua XYZ, 456',
            'bio' => 'Foco em dietas personalizadas',
        ]);
        $user2 = User::create([
            'name' => 'Diogo Morais',
            'email' => 'maria@example.com',
            'password' => bcrypt('password'),
            'role_id' => 2,
            'remember_token' => '1234567890'
        ]);
        $user2->profiles()->attach($profile2->id);

        $profile3 = Profile::create([
            'specialty' => 'Treinador Pessoal',
            'license_number' => '333333',
            'phone' => '911223344',
            'address' => 'Rua QWE, 789',
            'bio' => 'Treinos personalizados',
        ]);
        $user3 = User::create([
            'name' => 'Marcia Leite',
            'email' => 'marcia@example.com',
            'password' => bcrypt('password'),
            'role_id' => 2,
            'remember_token' => '1234567890'
        ]);
        $user3->profiles()->attach($profile3->id);

        $profile4 = Profile::create([
            'specialty' => 'Medico',
            'license_number' => '444444',
            'phone' => '922334455',
            'address' => 'Rua RTY, 321',
            'bio' => 'Consultas médicas gerais',
        ]);
        $user4 = User::create([
            'name' => 'Rui Matoso',
            'email' => 'rui@example.com',
            'password' => bcrypt('password'),
            'role_id' => 2,
            'remember_token' => '1234567890'
        ]);
        $user4->profiles()->attach($profile4->id);

        $profile4 = Profile::create([
            'specialty' => 'Dono',
            'license_number' => '111111',
            'phone' => '912345678',
            'address' => 'Rua ABC, 123',
            'bio' => 'Dono da empresa',
        ]);

        $user1->profiles()->attach($profile4->id);

        // </editor-fold>


        $this->call(UserSeeder::class);
        $this->call(PatientSeeder::class);
        $this->call(AppointmentSeeder::class);
        $this->call(DiagnosticSeeder::class);
        $this->call(TreatmentSeeder::class);
        $this->call(TreatmentGoalSeeder::class);
        $this->call(ExerciseSeeder::class);


    }
}
