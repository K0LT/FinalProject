<?php

namespace Database\Factories;

use App\Models\Patient;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Condition>
 */
class ConditionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $names = ['Hipertensão', 'Diabetes', 'Asma', 'Artrite', 'Depressão'];
        $statuses = ['Ativa', 'Resolvida', 'Crônica'];

        return [
            'patient_id' => Patient::inRandomOrder()->first()->id,
            'name' => $this->faker->randomElement($names),
            'diagnosed_date' => $this->faker->dateTimeBetween('-10 years', 'now')->format('Y-m-d'),
            'status' => $this->faker->randomElement($statuses),
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
