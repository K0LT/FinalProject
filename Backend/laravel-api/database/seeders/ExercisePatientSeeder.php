<?php

namespace Database\Seeders;

use App\Models\ExercisePatient;
use Database\Factories\ExercisePatientFactory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ExercisePatientSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        ExercisePatient::factory(100)->create();
    }
}
