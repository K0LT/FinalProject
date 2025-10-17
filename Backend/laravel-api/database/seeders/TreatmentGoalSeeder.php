<?php

namespace Database\Seeders;

use App\Models\TreatmentGoal;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TreatmentGoalSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        TreatmentGoal::factory(30)->create();
    }
}
