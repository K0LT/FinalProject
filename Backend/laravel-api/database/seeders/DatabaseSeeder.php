<?php

namespace Database\Seeders;

use App\Models\NutritionalGoal;
use App\Models\Patient;
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
        $this->call(UserSeeder::class);
        $this->call(PatientSeeder::class);
        $this->call(AppointmentSeeder::class);
        $this->call(DiagnosticSeeder::class);
        $this->call(TreatmentSeeder::class);
        $this->call(TreatmentGoalSeeder::class);
        $this->call(ExerciseSeeder::class);
        $this->call(ExercisePatientSeeder::class);
        $this->call(WeightTrackingSeeder::class);
        $this->call(NutritionalGoalSeeder::class);
        $this->call(DailyNutritionSeeder::class);
        $this->call(AllergySeeder::class);
        $this->call(ProgressNoteSeeder::class);
        $this->call(ConditionSeeder::class);
        $this->call(GoalMilestoneSeeder::class);
        $this->call(SymptomSeeder::class);
        $this->call(DiagnosticSymptomSeeder::class);
    }
}
