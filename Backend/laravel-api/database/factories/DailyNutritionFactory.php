<?php

namespace Database\Factories;

use App\Models\Patient;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\DailyNutrition>
 */
class DailyNutritionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $isEmptyDay = $this->faker->boolean(20);

        return [
            'patient_id' => Patient::inRandomOrder()->first()?->id ?? Patient::factory(),
            'date' => $this->faker->dateTimeBetween('-1 month', 'now')->format('Y-m-d'),

            'calories_consumed' => $isEmptyDay ? null : (rand(0, 6) === 0 ? null : $this->faker->numberBetween(1500, 3500)),
            'protein_consumed' => $isEmptyDay ? null : (rand(0, 5) === 0 ? null : $this->faker->numberBetween(50, 200)),
            'carbs_consumed' => $isEmptyDay ? null : (rand(0, 5) === 0 ? null : $this->faker->numberBetween(100, 400)),
            'fat_consumed' => $isEmptyDay ? null : (rand(0, 5) === 0 ? null : $this->faker->numberBetween(30, 120)),

            'water_intake' => $isEmptyDay ? null : (rand(0, 4) === 0 ? null : $this->faker->randomFloat(1, 0.5, 4.0)),
            'steps' => $isEmptyDay ? null : (rand(0, 6) === 0 ? null : $this->faker->numberBetween(1000, 15000)),
            'sleep_hours' => $isEmptyDay ? null : (rand(0, 5) === 0 ? null : $this->faker->randomFloat(1, 4, 10)),
            'calories_burned' => $isEmptyDay ? null : (rand(0, 5) === 0 ? null : $this->faker->numberBetween(150, 900)),
        ];
    }
}
