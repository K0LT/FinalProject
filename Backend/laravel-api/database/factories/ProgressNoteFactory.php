<?php

namespace Database\Factories;

use App\Models\Appointment;
use App\Models\Patient;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ProgressNote>
 */
class ProgressNoteFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {

        $subjectiveSamples = [
            'Paciente refere dor leve nas costas.',
            'Queixa-se de cansaço frequente.',
            'Relata melhora na mobilidade.',
            'Sem queixas relevantes.'
        ];

        $objectiveSamples = [
            'Pressão arterial normal.',
            'Pulso regular.',
            'Postura ligeiramente inclinada.',
            'Amplitude de movimento dentro do esperado.'
        ];

        $assessmentSamples = [
            'Melhora clínica desde a última sessão.',
            'Necessita de reforço no exercício X.',
            'Paciente está estável.',
            'Sinais de fadiga muscular.'
        ];

        $planSamples = [
            'Manter exercícios diários prescritos.',
            'Agendar nova consulta em 1 semana.',
            'Revisar plano nutricional.',
            'Aumentar duração das sessões de fisioterapia.'
        ];

        return [
            //
            'patient_id' => Patient::inRandomOrder()->first()?->id,
            'appointment_id' => Appointment::inRandomOrder()->first()?->id,
            'note_date' => $this->faker->dateTimeBetween('-6 months', 'now')->format('Y-m-d'),
            'subjective' => (rand(0, 3) === 0) ? null : $this->faker->randomElement($subjectiveSamples),
            'objective' => (rand(0, 3) === 0) ? null : $this->faker->randomElement($objectiveSamples),
            'assessment' => (rand(0, 3) === 0) ? null : $this->faker->randomElement($assessmentSamples),
            'plan' => (rand(0, 3) === 0) ? null : $this->faker->randomElement($planSamples),

        ];
    }
}
