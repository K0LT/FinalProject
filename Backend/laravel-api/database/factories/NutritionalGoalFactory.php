<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\NutritionalGoal>
 */
class NutritionalGoalFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'target_weight' => (rand(0, 2) === 0) ? null : $this->faker->numberBetween(50, 100),
            'target_body_fat' => (rand(0, 10) === 0) ? null : $this->faker->randomFloat(2, 15, 35),
            'daily_calories_goal' => (rand(0, 3) === 0) ? null : $this->faker->numberBetween(1500, 3000),
            'daily_protein_goal' => (rand(0, 3) === 0) ? null : $this->faker->numberBetween(50, 200),
            'daily_carbs_goal' => (rand(0, 3) === 0) ? null : $this->faker->numberBetween(100, 400),
            'daily_fat_goal' => (rand(0, 3) === 0) ? null : $this->faker->numberBetween(30, 120),
            'start_date' => (rand(0, 3) === 0) ? null : $this->faker->dateTimeBetween('-3 months', 'now')->format('Y-m-d'),
            'target_date' => (rand(0, 9) === 0) ? null : $this->faker->dateTimeBetween('now', '+3 months')->format('Y-m-d'),
        ];

    }
}
