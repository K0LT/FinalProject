<?php

namespace Database\Seeders;

use App\Models\Allergie;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AllergieSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Allergie::factory(200)->create();
    }
}
