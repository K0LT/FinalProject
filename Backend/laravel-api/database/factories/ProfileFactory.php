<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Profile>
 */
class ProfileFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'specialty' => $this->faker->randomElement(['Nutricionista','Medico', 'Treinador Pessoal', 'Acunpulturista']),
            'license_number' => $this->faker->randomNumber(),
            'phone' => $this->faker->phoneNumber(),
            'address' => $this->faker->address(),
            'bio' => $this->faker->text(),
        ];
    }
}
