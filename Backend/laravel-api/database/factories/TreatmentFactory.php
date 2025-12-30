<?php

namespace Database\Factories;

use App\Models\Diagnostic;
use App\Models\Patient;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Treatment>
 */
class TreatmentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        // <editor-fold desc="Creation of fakeData / Arrays">

        $treatment_methods = [
            'Acupuntura',
            'Massagem terapêutica',
            'Fitoterapia',
            'Ventosas',
            'Tui Na',
            'Auriculoterapia',
            'Alongamentos',
            'Exercícios de respiração'
        ];

        $acupoints_used = [
            'LI4, ST36, SP6',
            'GV20, LI11, GB20',
            'LU7, HT7, PC6',
            'KI3, BL23, SP9',
            'ST25, CV12, LI10',
            'LV3, GB34, SP10',
            'HT5, LU9, ST40',
            'CV4, BL32, SP6'
        ];

        $notes_examples = [
            'Paciente respondeu bem, relaxado.',
            'Alguma dor ao manipular determinados pontos.',
            'Sessão curta, paciente cansado.',
            'Recomendada hidratação após tratamento.',
            'Paciente apresentou melhora nos sintomas.',
            'Exercícios de respiração ajudaram a reduzir ansiedade.',
            'Observou-se melhora da mobilidade articular.',
            'Paciente sentiu leve tontura, monitorar próxima sessão.'
        ];

        $durations = [30,60,90];




        // </editor-fold>
        return [
            'patient_id' => Patient::inRandomOrder()->first()->id,
            'diagnostic_id' => Diagnostic::inRandomOrder()->first()->id,
            'session_date_time' => $this->faker->dateTimeBetween('-1 year', '+1 year')->format('Y-m-d H:i:s'),
            'treatment_methods' => (rand(0, 7) === 0) ? null : $this->faker->randomElement($treatment_methods),
            'acupoints_used' => (rand(0, 7) === 0) ? null :$this->faker->randomElement($acupoints_used),
            'duration' => $this->faker->randomElement($durations),
            'notes' => (rand(0, 7) === 0) ? null : $this->faker->randomElement($notes_examples),
            'next_session' => (rand(0, 2) === 0) ? null : $this->faker->dateTimeBetween('-1 year', '+1 year')->format('Y-m-d'),
        ];
    }
}

/*
 *  $table->foreignId('diagnosis_id')->constrained();
            $table->foreignId('patient_id')->constrained();
            $table->date('session_date');
            $table->string('treatment_methods')->nullable();
            $table->string('acupoints_used')->nullable();
            $table->integer('duration')->nullable();
            $table->text('notes')->nullable();
            $table->date('next_session')->nullable();
 */
