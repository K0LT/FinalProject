<?php

namespace Database\Seeders;

use Database\Factories\ExercisePatientFactory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ExercisePatientSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        ExercisePatientFactory::factory(30)->create();
    }
}
