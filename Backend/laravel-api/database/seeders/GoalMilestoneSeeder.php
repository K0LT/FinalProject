<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\GoalMilestone;
use App\Models\TreatmentGoal;
class GoalMilestoneSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $treatment_goals = TreatmentGoal::all();

        foreach ($treatment_goals as $treatment_goal) {
            GoalMilestone::factory(4)->create();
        }

    }
}
