<?php

namespace Database\Factories;

use App\Models\Patient;
use App\Models\Profile;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Diagnostic>
 */
class DiagnosticFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        // <editor-fold desc="Creation of fakeData / Arrays">
        $western_diagnosis = [
            'Hipertensão',
            'Diabetes tipo 2',
            'Hiperlipidemia',
            'Asma',
            'Doença Pulmonar Obstrutiva Crónica (DPOC)',
            'Enxaqueca',
            'Osteoartrite',
            'Artrite Reumatoide',
            'Doença do Refluxo Gastroesofágico (DRGE)',
            'Síndrome do Intestino Irritável (SII)',
            'Transtorno de Ansiedade',
            'Depressão',
            'Bronquite Aguda',
            'Rinite Alérgica Sazonal',
            'Infecção do Trato Urinário (ITU)',
            'Sinusite Aguda',
            'Hipotireoidismo',
            'Anemia',
            'Doença Renal Crónica (DRC)',
            'Fibromialgia'
        ];
        $tcm_diagnosis = [
            'Estagnação de Qi do Fígado',
            'Deficiência de Qi do Baço',
            'Deficiência de Yin dos Rins',
            'Deficiência de Yang do Coração',
            'Deficiência de Qi dos Pulmões',
            'Fogo do Fígado em Ascensão',
            'Deficiência de Yang do Baço',
            'Deficiência de Yang dos Rins',
            'Deficiência de Yin do Coração',
            'Deficiência de Sangue do Fígado',
            'Qi do Baço em Afundamento',
            'Deficiência de Yin dos Pulmões',
            'Qi dos Rins Fraco',
            'Calor Úmido no Fígado e Vesícula Biliar',
            'Acúmulo de Fleuma e Umidade',
            'Calor no Estômago',
            'Estase de Sangue',
            'Deficiência de Yin do Fígado',
            'Deficiência de Qi e Sangue',
            'Obstrução por Frio e Umidade'
        ];
        $severities = ['Leve',
            'Moderada',
            'Grave'];
        $pulse_quality = [
            'Forte',
            'Fraco',
            'Rápido',
            'Lento',
            'Regular',
            'Irregular',
            'Cheio',
            'Vazio',
            'Tenso',
            'Suave'
        ];
        $tongue_description = [
                'Língua levemente vermelha',
                'Língua pálida',
                'Língua com saburra amarela',
                'Língua com saburra branca',
                'Língua com saburra fina',
                'Língua inchada',
                'Língua com fissuras',
                'Língua seca',
                'Língua úmida',
                'Língua com bordas avermelhadas',
                'Língua com ponta avermelhada',
                'Língua com pontas pálidas',
                'Língua com manchas roxas',
                'Língua com revestimento espesso',
                'Língua com revestimento fino'
            ];

        // </editor-fold>

        return [
            'patient_id' => Patient::inRandomOrder()->first()->id,
            'profile_id' => Profile::inRandomOrder()->first()->id,
            'diagnostic_date' => $this->faker->dateTimeBetween('-1 year', '+1 year')->format('Y-m-d'),
            'western_diagnosis' => (rand(0, 3) === 0) ? null : $this->faker->randomElement($western_diagnosis),
            'tcm_diagnosis' => (rand(0, 3) === 0) ? null : $this->faker->randomElement($tcm_diagnosis),
            'severity' => $this->faker->randomElement($severities),
            'pulse_quality' => (rand(0, 9) === 0) ? null : $this->faker->randomElement($pulse_quality),
            'tongue_description' => (rand(0, 9) === 0) ? null : $this->faker->randomElement($tongue_description),
        ];
    }
}
