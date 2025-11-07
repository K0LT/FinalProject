<?php

namespace Database\Seeders;

use App\Models\Diagnostic;
use App\Models\Symptom;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DiagnosticSymptomSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $diagnostics = Diagnostic::all();
        $symptoms = Symptom::all();

        foreach ($diagnostics as $diagnostic){
            $ranNum = rand(1, 4);
            for ($i = 0; $i < $ranNum; $i++){
                $symptom = $symptoms->random();

                \DB::table('diagnostic_symptom')->insert([
                    'diagnostic_id' => $diagnostic->id,
                    'symptom_id' => $symptom->id,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }

        }
    }
}
