<?php

namespace Database\Factories;

use App\Models\TreatmentGoal;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\GoalMillestone>
 */
class GoalMillestoneFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $descriptions = [
            'Reduzir dor lombar em 50%',
            'Melhorar flexibilidade da coluna',
            'Aumentar a força muscular da região lombar',
            'Atingir 8 horas de sono diário',
            'Completar programa de exercícios sem faltas'
        ];

        $notes = [
            'Marco alcançado com sucesso.',
            'Paciente precisa melhorar a adesão.',
            'Revisar plano na próxima sessão.',
            'Meta parcialmente concluída.',
            'Observações gerais sobre o progresso do paciente.'
        ];

        $completed = $this->faker->boolean(50); // 50% chance de estar completo
        $completion_date = $completed
            ? $this->faker->dateTimeBetween('-1 month', 'now')->format('Y-m-d')
            : null;

        return [
            'treatment_goal_id' => TreatmentGoal::inRandomOrder()->first()->id,
            'description' => (rand(0, 7) === 0) ? null :$this->faker->randomElement($descriptions),
            'target_date' => $this->faker->dateTimeBetween('now', '+3 months')->format('Y-m-d'),
            'completed' => $completed,
            'completion_date' => $completion_date,
            'notes' => (rand(0, 7) === 0) ? null :$this->faker->randomElement($notes),];
    }
}
