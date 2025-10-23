<?php

namespace Database\Seeders;

use App\Models\DailyNutrition;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DailyNutritionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        DailyNutrition::factory(100)->create();
    }
}
