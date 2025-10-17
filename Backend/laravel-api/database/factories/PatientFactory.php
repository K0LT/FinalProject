<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Patient>
 */
class PatientFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            //

            'name' => $this->faker->firstName(),
            'surname' => $this->faker->lastName(),
            'phone_number' => $this->faker->phoneNumber(),
            'address' => $this->faker->address(),
            'birth_date' => $this->faker->date('Y-m-d', '2005-01-01'),
            'emergency_contact_name' => $this->faker->name(),
            'emergency_contact_phone' => $this->faker->phoneNumber(),
            'emergency_contact_relation' => $this->faker->randomElement(['Parent', 'Sibling', 'Friend', 'Spouse']),
            'client_since' => $this->faker->date('Y-m-d', 'now'),
            'last_visit' => $this->faker->date('Y-m-d', 'now'),
            'next_appointment' => $this->faker->date('Y-m-d', '+1 year'),
        ];
    }
}
