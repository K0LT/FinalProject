<?php

namespace Database\Factories;

use App\Models\Patient;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Appointment>
 */
class AppointmentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */


    public function definition(): array
    {
        $types = ['Acupunturista', 'Nutricionista', 'Treinador Pessoal', 'Medico'];
        $statuses = ['Canceled', 'Done', 'Scheduled'];
        $durations = [30, 60, 90];
        return [

            'patient_id' => Patient::inRandomOrder()->whereBetween('id', [1, 25])->first()->id,
            'user_id' => User::inRandomOrder()->whereBetween('id', [1, 4])->first()->id,
            'appointment_date' => $this->faker->dateTimeBetween('-1 month', '+1 month')->format('Y-m-d'),
            'duration' => $this->faker->randomElement($durations),
            'type' => $this->faker->randomElement($types),
            'notes' => $this->faker->paragraph(),
            'status' => $this->faker->randomElement($statuses),
        ];
    }
}
