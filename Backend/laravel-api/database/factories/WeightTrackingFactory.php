<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\WeightTracking>
 */
class WeightTrackingFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $notes = [
            'Paciente se sentiu bem no dia da medição.',
            'Paciente apresentou leve aumento de peso.',
            'Redução de gordura corporal observada.',
            'Paciente relatou dificuldades na dieta.',
            'Sem alterações significativas desde a última medição.'
        ];

        return [
            'weight' => $this->faker->randomFloat(1, 30, 400),
            'body_fat_percentage' => (rand(0, 7) === 0) ? null :$this->faker->randomFloat(2,6,40),
            'measurement_date' => $this->faker->dateTimeBetween('-3 months', 'now')->format('Y-m-d'),
            'notes' => (rand(0, 7) === 0) ? null :$this->faker->optional()->randomElement($notes),
        ];
    }
}
