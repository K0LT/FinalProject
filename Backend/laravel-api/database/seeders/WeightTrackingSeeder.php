<?php

namespace Database\Seeders;

use App\Models\Patient;
use App\Models\WeightTracking;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class WeightTrackingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $patients = Patient::all();

        foreach ($patients as $patient) {
            WeightTracking::factory(rand(0,6))->create([
                'patient_id' => $patient->id,
            ]);
        }
    }
}
