<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Client>
 */
class ClientFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $healthObjectives = ['Manutenção de Peso', 'Bem-Estar Geral', 'Gestão da Dor', 'Alivio do Stress', 'Melhoria do Sono'];
        return [
            'full_name' => $this->faker->name(),
            'phone_number' => $this->faker->phoneNumber(),
            'address' => $this->faker->address(),
            'birth_date' => $this->faker->dateTimeBetween($startDate = '-100 years', $endDate = 'now', $timezone = 'GMT'),
            'gender' => $this->faker->randomElement(['M', 'F', 'O']),
            'weight' => $this->faker->randomFloat($min = 30, $max = 400),
            'height' => $this->faker->numberBetween($min = 100, $max = 230),
            'emergency_contact_number' => $this->faker->phoneNumber(),
            'health_objective' => $this->faker->randomElement($healthObjectives),
            //
        ];
    }
}
