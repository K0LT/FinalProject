<?php

namespace Database\Seeders;

use App\Models\ProgressNote;
use Database\Factories\ProgressNoteFactory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProgressNoteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        ProgressNote::factory(100)->create();
    }
}
