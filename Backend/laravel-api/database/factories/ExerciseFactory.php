<?php

namespace Database\Factories;

use App\Models\Patient;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Exercise>
 */
class ExerciseFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        // <editor-fold desc="Creation of fakeData / Arrays">
        $exercises = [
            [
                'name' => 'Alongamento de Pescoço',
                'description' => 'Exercício simples para aliviar tensões no pescoço e ombros.',
                'category' => 'Alongamento',
                'difficulty_level' => 'Fácil',
                'duration' => 10,
                'frequency' => 'Diária',
                'instructions' => 'Mover lentamente a cabeça para os lados e para frente, sem forçar.',
                'benefits' => 'Reduz rigidez muscular e melhora a mobilidade do pescoço.',
                'precautions' => 'Evitar movimentos bruscos e parar se sentir dor.',
                'video_url' => 'https://www.youtube.com/watch?v=123abc',
                'image_url' => 'https://example.com/images/alongamento-pescoco.jpg',
            ],
            [
                'name' => 'Rotação de Ombros',
                'description' => 'Movimento circular dos ombros para melhorar a mobilidade e aliviar tensões.',
                'category' => 'Mobilidade',
                'difficulty_level' => 'Fácil',
                'duration' => 10,
                'frequency' => 'Diária',
                'instructions' => 'Girar os ombros lentamente para frente e para trás, 10 vezes cada.',
                'benefits' => 'Melhora a circulação e reduz rigidez nos ombros.',
                'precautions' => 'Evitar se tiver lesão recente nos ombros.',
                'video_url' => 'https://www.youtube.com/watch?v=456def',
                'image_url' => 'https://example.com/images/rotacao-ombros.jpg',
            ],
            [
                'name' => 'Prancha Abdominal',
                'description' => 'Exercício para fortalecer o abdómen e melhorar a postura corporal.',
                'category' => 'Fortalecimento',
                'difficulty_level' => 'Moderado',
                'duration' => 15,
                'frequency' => '3 vezes por semana',
                'instructions' => 'Manter o corpo reto apoiado nos cotovelos e pontas dos pés por 30 segundos.',
                'benefits' => 'Fortalece o core e melhora o equilíbrio corporal.',
                'precautions' => 'Evitar se houver dor lombar ou lesões abdominais.',
                'video_url' => 'https://www.youtube.com/watch?v=789ghi',
                'image_url' => 'https://example.com/images/prancha.jpg',
            ],
            [
                'name' => 'Alongamento de Costas',
                'description' => 'Ajuda a reduzir dores nas costas e alongar a coluna vertebral.',
                'category' => 'Alongamento',
                'difficulty_level' => 'Fácil',
                'duration' => 10,
                'frequency' => 'Diária',
                'instructions' => 'Inclinar o corpo para frente lentamente, mantendo os joelhos ligeiramente dobrados.',
                'benefits' => 'Melhora a flexibilidade e alivia dores na região lombar.',
                'precautions' => 'Evitar curvar em excesso se sentir dor lombar intensa.',
                'video_url' => 'https://www.youtube.com/watch?v=101jkl',
                'image_url' => 'https://example.com/images/alongamento-costas.jpg',
            ],
            [
                'name' => 'Agachamento Suave',
                'description' => 'Exercício básico para tonificar pernas e glúteos.',
                'category' => 'Fortalecimento',
                'difficulty_level' => 'Moderado',
                'duration' => 15,
                'frequency' => '3 vezes por semana',
                'instructions' => 'Descer lentamente até formar um ângulo de 90º nos joelhos e subir devagar.',
                'benefits' => 'Fortalece pernas, glúteos e melhora a estabilidade corporal.',
                'precautions' => 'Evitar se tiver dor nos joelhos ou problemas de equilíbrio.',
                'video_url' => 'https://www.youtube.com/watch?v=112mno',
                'image_url' => 'https://example.com/images/agachamento.jpg',
            ],
            [
                'name' => 'Respiração Profunda',
                'description' => 'Técnica de respiração para relaxamento e redução do stress.',
                'category' => 'Respiração',
                'difficulty_level' => 'Fácil',
                'duration' => 5,
                'frequency' => 'Diária',
                'instructions' => 'Inspirar profundamente pelo nariz e expirar lentamente pela boca.',
                'benefits' => 'Diminui a ansiedade e melhora a oxigenação do corpo.',
                'precautions' => 'Evitar ambientes com ar poluído.',
                'video_url' => 'https://www.youtube.com/watch?v=998abc',
                'image_url' => 'https://example.com/images/respiracao.jpg',
            ],
            [
                'name' => 'Ponte de Glúteos',
                'description' => 'Exercício para fortalecer glúteos e músculos lombares.',
                'category' => 'Fortalecimento',
                'difficulty_level' => 'Moderado',
                'duration' => 12,
                'frequency' => '3 vezes por semana',
                'instructions' => 'Deitar de costas e elevar o quadril até formar uma linha reta com o corpo.',
                'benefits' => 'Fortalece o core e reduz dores lombares.',
                'precautions' => 'Evitar arquear excessivamente a lombar.',
                'video_url' => 'https://www.youtube.com/watch?v=223bcd',
                'image_url' => 'https://example.com/images/ponte-gluteos.jpg',
            ],
            [
                'name' => 'Marcha Estática',
                'description' => 'Exercício de aquecimento leve para ativar circulação e articulações.',
                'category' => 'Aquecimento',
                'difficulty_level' => 'Fácil',
                'duration' => 5,
                'frequency' => 'Diária',
                'instructions' => 'Marchar no mesmo lugar levantando os joelhos até a altura do quadril.',
                'benefits' => 'Melhora circulação e prepara o corpo para outros exercícios.',
                'precautions' => 'Evitar pisos escorregadios.',
                'video_url' => 'https://www.youtube.com/watch?v=334efg',
                'image_url' => 'https://example.com/images/marcha-estatica.jpg',
            ],
            [
                'name' => 'Alongamento de Pernas',
                'description' => 'Exercício para alongar músculos das pernas e reduzir tensões.',
                'category' => 'Alongamento',
                'difficulty_level' => 'Fácil',
                'duration' => 10,
                'frequency' => 'Diária',
                'instructions' => 'Sentar e estender uma perna, tentando alcançar os pés com as mãos.',
                'benefits' => 'Melhora a flexibilidade e circulação nas pernas.',
                'precautions' => 'Evitar forçar caso sinta dor muscular.',
                'video_url' => 'https://www.youtube.com/watch?v=445ghi',
                'image_url' => 'https://example.com/images/alongamento-pernas.jpg',
            ],
            [
                'name' => 'Torção de Tronco Sentado',
                'description' => 'Exercício para melhorar mobilidade da coluna e aliviar tensão lombar.',
                'category' => 'Mobilidade',
                'difficulty_level' => 'Fácil',
                'duration' => 8,
                'frequency' => 'Diária',
                'instructions' => 'Sentar, cruzar uma perna sobre a outra e girar o tronco suavemente para o lado.',
                'benefits' => 'Aumenta flexibilidade da coluna e melhora a postura.',
                'precautions' => 'Evitar se houver hérnia de disco.',
                'video_url' => 'https://www.youtube.com/watch?v=556jkl',
                'image_url' => 'https://example.com/images/torcao-tronco.jpg',
            ],
        ];

        $exercise = $this->faker->randomElement($exercises);


        // </editor-fold>

        return [
            'name' => $exercise['name'],
            'description' => $exercise['description'],
            'category' => $exercise['category'],
            'difficulty_level' => $exercise['difficulty_level'],
            'instructions' => (rand(0, 7) === 0) ? null :$exercise['instructions'],
            'benefits' => (rand(0, 7) === 0) ? null : $exercise['benefits'],
            'precautions' => (rand(0, 7) === 0) ? null : $exercise['precautions'],
            'video_url' => (rand(0, 7) === 0) ? null : $exercise['video_url'],
            'image_url' => (rand(0, 7) === 0) ? null : $exercise['image_url'],
        ];
    }
}

    /*
     *  $table->string('frequency')->nullable();
            $table->text('instructions')->nullable();
            $table->text('benefits')->nullable();
            $table->text('precautions')->nullable();
            $table->string('video_url')->nullable();
            $table->string('image_url')->nullable();
     */
