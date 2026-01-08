<?php

namespace Database\Seeders;

use App\Models\Exercise;
use App\Models\ExercisePatient;
use App\Models\Patient;
use Database\Factories\ExercisePatientFactory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;


class ExercisePatientSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $patients = Patient::all();

        foreach ($patients as $patient) {

            $count = rand(1, 4);
            ExercisePatient::factory()->count($count)->create([
                    'patient_id' => $patient->id,
                ]);
        }
    }
}
