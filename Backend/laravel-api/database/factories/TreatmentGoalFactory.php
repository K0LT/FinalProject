<?php

namespace Database\Factories;

use App\Models\Patient;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\TreatmentGoal>
 */
class TreatmentGoalFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        // <editor-fold desc="Creation of fakeData / Arrays">
        $titles = [
            'Melhorar qualidade do sono',
            'Reduzir dores lombares',
            'Aumentar energia diária',
            'Diminuir ansiedade',
            'Fortalecer sistema imunitário',
            'Melhorar digestão',
            'Reduzir stress',
            'Controlar dores de cabeça',
            'Aumentar mobilidade articular',
            'Melhorar circulação sanguínea',
            'Recuperar após cirurgia',
            'Melhorar respiração',
            'Aliviar tensão muscular',
            'Reduzir sintomas de fadiga',
            'Melhorar postura corporal',
        ];

        $descriptions = [
            'O paciente apresenta dificuldades em adormecer e acorda várias vezes durante a noite.',
            'Queixas de dor lombar contínua, agravada após longos períodos sentado.',
            'Relata falta de energia ao longo do dia e sensação de cansaço constante.',
            'Apresenta episódios frequentes de ansiedade e inquietação.',
            'Deseja fortalecer o sistema imunitário e prevenir infeções recorrentes.',
            'Tem digestões lentas e sensação de peso após as refeições.',
            'Sente-se frequentemente tenso e stressado no trabalho.',
            'Relata dores de cabeça recorrentes, especialmente ao fim do dia.',
            'Apresenta rigidez nas articulações e dificuldade de movimento matinal.',
            'Queixas de má circulação nas pernas, especialmente durante o inverno.',
            'Recuperação pós-operatória com necessidade de melhorar a vitalidade geral.',
            'Dificuldade em respirar profundamente devido a tensão torácica.',
            'Tensão acumulada nos ombros e pescoço, com dor ocasional.',
            'Sente-se esgotado mesmo após dormir adequadamente.',
            'Problemas de postura devido a longas horas em frente ao computador.',
        ];

        $priorities = ['Mínima', 'Média', 'Alta'];

        $statuses = ['Em progresso', 'Concluído', 'Cancelado'];

        $progressPercentages = [0,10,20,30,40,50,60,70,80,90,100];

        $treatmentMethods = [
            'Acupuntura tradicional',
            'Massagem terapêutica',
            'Fitoterapia chinesa',
            'Moxabustão',
            'Ventosas',
            'Eletroacupuntura',
            'Auriculoterapia',
            'Técnicas de respiração',
            'Dieta terapêutica',
            'Qi Gong e exercícios suaves',
        ];

        // </editor-fold>
        return [
            'patient_id' => Patient::inRandomOrder()->first()->id,
            'title' => $this->faker->randomElement($titles),
            'description' => $this->faker->randomElement($descriptions),
            'priority' => $this->faker->randomElement($priorities),
            'status' => $this->faker->randomElement($statuses),
            'progress_percentage' => $this->faker->randomElement($progressPercentages),
            'target_date' => (rand(0, 7) === 0) ? null : $this->faker->dateTimeBetween('+1 weeks', '+3 months')->format('Y-m-d'),
            'treatment_methods' => $this->faker->randomElement($treatmentMethods),
        ];
    }
}

/*
 * Schema::create('treatment_goals', function (Blueprint $table) {
            $table->id();
            $table->foreignId('patient_id')->constrained();
            $table->string('title');
            $table->text('description')->nullable();
            $table->string('priority')->default('Minima');
            $table->string('status')->default('Em progresso');
            $table->string('progress_percentage')->default(0);
            $table->date('target_date')->nullable();
            $table->string('treatment_methods')->nullable();
            $table->timestamps();
 */
