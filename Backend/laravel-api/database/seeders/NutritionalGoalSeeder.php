<?php

namespace Database\Seeders;

use App\Models\NutritionalGoal;
use App\Models\Patient;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class NutritionalGoalSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $patients = Patient::all();
        foreach ($patients as $patient) {
            NutritionalGoal::factory(1)->create(['patient_id' => $patient->id]);
        }
    }
}
