<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Client;
use App\Models\User;

class ClientSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $users = User::all();

        foreach ($users as $user) {
            Client::factory(1)->create([
                'user_id' => $user->id,
            'email' => $user->email,
            ]);
        }
    }
}
