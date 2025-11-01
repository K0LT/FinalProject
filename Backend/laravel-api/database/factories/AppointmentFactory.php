<?php

namespace Database\Factories;

use App\Models\Patient;
use App\Models\Profile;
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
        $statuses = ['Pendente', 'Confirmado', 'Cancelado', 'Concluído'];
        $durations = [30, 60, 90];
        $notes = [
            'Paciente apresentou sintomas leves de fadiga.',
            'Consulta de acompanhamento de dieta e hábitos alimentares.',
            'Treino personalizado focado em resistência e mobilidade.',
            'Sessão de acupuntura para dores musculares.',
            'Avaliação médica de rotina e exames preventivos.',
            'Orientações nutricionais e plano alimentar atualizado.',
            'Revisão de progresso físico e ajustes no treino.',
            'Consulta de retorno para acompanhamento de tratamento.',
            'Sessão de aconselhamento sobre estilo de vida saudável.',
            'Acompanhamento de sintomas e ajustes no tratamento.',
        ];
        return [

            'patient_id' => Patient::inRandomOrder()->first()->id,
            'profile_id' => Profile::inRandomOrder()->first()->id,
            'appointment_date_time' => $this->faker->dateTimeBetween('+1 day', '+1 month')->format('Y-m-d H:i:s'),
            'duration' => $this->faker->randomElement($durations),
            'type' => $this->faker->randomElement($types),
            'notes' => $this->faker->randomElement($notes),
            'status' => $this->faker->randomElement($statuses),
        ];
    }
}
