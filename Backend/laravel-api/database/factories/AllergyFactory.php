<?php

namespace Database\Factories;

use App\Models\Patient;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Allergy>
 */
class AllergyFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $allergens = [
            'Pólen', 'Amendoim', 'Leite', 'Ovos', 'Frutos do mar',
            'Glúten', 'Soja', 'Penicilina', 'Poeira', 'Pelo de gato'
        ];

        $reactionTypes = [
            'Erupção cutânea', 'Inchaço', 'Dificuldade respiratória',
            'Náusea', 'Comichão', 'Choque anafilático', 'Tosse'
        ];

        $severities = ['Leve', 'Moderada', 'Grave'];

        $notes = [
            'Reação controlada com anti-histamínico.',
            'Paciente necessita de acompanhamento.',
            'Evitar contacto direto com o alergénio.',
            'Sem ocorrência recente de sintomas.',
            'Reação ligeira observada durante teste clínico.'
        ];

        return [
            'allergen' => $this->faker->randomElement($allergens),
            'description' => $this->faker->text(),
            'created_at' => $this->faker->dateTimeBetween('-6 months', 'now'),
        ];
    }
}
