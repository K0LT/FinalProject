<?php

namespace Database\Seeders;

use App\Models\Allergy;
use App\Models\Patient;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AllergyPatientSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $allergies = Allergy::all();
        $patients = Patient::all();

        foreach ($patients as $patient) {
            $ranNum = rand(1, 4);
            for ($i = 0; $i < $ranNum; $i++){
                $allergy = $allergies->random();

                \DB::table('allergy_patient')->insert([
                    'patient_id' => $patient->id,
                    'allergy_id' => $allergy->id,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        }

    }
}
