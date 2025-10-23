<?php

namespace Database\Seeders;

use App\Models\GoalMillestone;
use App\Models\TreatmentGoal;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class GoalMillestoneSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $treatment_goals = TreatmentGoal::all();

        foreach ($treatment_goals as $treatment_goal) {
            GoalMillestone::factory(4)->create();
        }

    }
}
