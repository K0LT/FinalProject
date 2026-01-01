<?php

namespace Database\Factories;

use App\Models\Exercise;
use App\Models\Patient;
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

        $lastPerformed = $this->faker->optional()->dateTimeBetween('-1 month', 'now');

        return [
            'exercise_id'      => Exercise::inRandomOrder()->value('id'),
            'prescribed_date'  => $this->faker->dateTimeBetween('-3 months', 'now')->format('Y-m-d'),
            'frequency'        => $this->faker->randomElement($frequencies),
            'status'           => $this->faker->randomElement($statuses),
            'compliance_rate'  => $this->faker->numberBetween(0, 100),
            'last_performed' => $lastPerformed ? $lastPerformed->format('Y-m-d') : null,
            'notes'            => $this->faker->optional()->randomElement($notes),

        ];
    }
}
