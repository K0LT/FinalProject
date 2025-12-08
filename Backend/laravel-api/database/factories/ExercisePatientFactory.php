<?php

namespace Database\Factories;

use App\Models\Exercise;
use App\Models\Patient;
use App\Models\Profile;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ExercisePatient>
 */
class ExercisePatientFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {

        $statuses = ['Em progresso', 'Concluído', 'Pendente'];
        $notes = [
            'Paciente realizou o exercício corretamente.',
            'Paciente sentiu leve desconforto durante o exercício.',
            'Necessário supervisionar o próximo treino.',
            'Paciente apresentou boa evolução.',
            'Paciente não completou o exercício hoje.'
        ];

        $frequencies = [
            'Daily',
            'Once a week',
            'Fortnight',
            'Once a month',
        ];


        return [

            'patient_id' => Patient::inRandomOrder()->first()->id,
            'exercise_id' => Exercise::inRandomOrder()->first()->id,
            'prescribed_date' => now()->subDays(rand(0,30)),
            'status' => $this->faker->randomElement($statuses),
            'frequency' => $this->faker->randomElement($frequencies),
            'compliance_rate' => rand(0,100),
            'last_performed' => now()->subDays(rand(0,30)),
            'notes' => $this->faker->randomElement($notes),

        ];
    }
}
