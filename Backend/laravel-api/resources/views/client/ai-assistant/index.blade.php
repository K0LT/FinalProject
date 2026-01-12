@extends('client.layout')

@section('title', 'Perguntas Frequentes - QiFlow')

@section('content')
<div class="p-8">
    <!-- Header -->
    <div class="mb-8">
        <h1 class="text-3xl font-bold text-gray-900">Perguntas Frequentes</h1>
        <p class="text-gray-600 mt-2">Clique em uma pergunta para obter informações</p>
    </div>

    <!-- Questions List -->
    <div class="space-y-4">
        <button class="faqButton text-left w-full p-6 rounded-lg border border-gray-200 hover:border-[#B8860B] hover:bg-[#B8860B]/5 transition-all bg-white" data-question-id="1">
            <p class="font-semibold text-gray-900 text-lg">Benefícios da Acupuntura</p>
            <p class="text-sm text-gray-600 mt-1">Saiba mais sobre os benefícios da acupuntura para sua saúde</p>
        </button>

        <button class="faqButton text-left w-full p-6 rounded-lg border border-gray-200 hover:border-[#B8860B] hover:bg-[#B8860B]/5 transition-all bg-white" data-question-id="2">
            <p class="font-semibold text-gray-900 text-lg">Como Fazer os Exercícios Prescritos</p>
            <p class="text-sm text-gray-600 mt-1">Instruções detalhadas sobre como realizar seus exercícios</p>
        </button>

        <button class="faqButton text-left w-full p-6 rounded-lg border border-gray-200 hover:border-[#B8860B] hover:bg-[#B8860B]/5 transition-all bg-white" data-question-id="3">
            <p class="font-semibold text-gray-900 text-lg">Recomendações Nutricionais</p>
            <p class="text-sm text-gray-600 mt-1">Dicas de alimentação adequada para sua condição</p>
        </button>

        <button class="faqButton text-left w-full p-6 rounded-lg border border-gray-200 hover:border-[#B8860B] hover:bg-[#B8860B]/5 transition-all bg-white" data-question-id="4">
            <p class="font-semibold text-gray-900 text-lg">Melhorar Bem-estar Geral</p>
            <p class="text-sm text-gray-600 mt-1">Estratégias para melhorar seu bem-estar e qualidade de vida</p>
        </button>

        <button class="faqButton text-left w-full p-6 rounded-lg border border-gray-200 hover:border-[#B8860B] hover:bg-[#B8860B]/5 transition-all bg-white" data-question-id="5">
            <p class="font-semibold text-gray-900 text-lg">Quem é o José Machado</p>
            <p class="text-sm text-gray-600 mt-1">Conheça o criador do método QiFlow</p>
        </button>

        <button class="faqButton text-left w-full p-6 rounded-lg border border-gray-200 hover:border-[#B8860B] hover:bg-[#B8860B]/5 transition-all bg-white" data-question-id="6">
            <p class="font-semibold text-gray-900 text-lg">Horário Disponível</p>
            <p class="text-sm text-gray-600 mt-1">Conheça os horários de atendimento</p>
        </button>

        <button class="faqButton text-left w-full p-6 rounded-lg border border-gray-200 hover:border-[#B8860B] hover:bg-[#B8860B]/5 transition-all bg-white" data-question-id="7">
            <p class="font-semibold text-gray-900 text-lg">Como Marcar uma Consulta</p>
            <p class="text-sm text-gray-600 mt-1">Passo a passo para agendar sua consulta</p>
        </button>

        <button class="faqButton text-left w-full p-6 rounded-lg border border-gray-200 hover:border-[#B8860B] hover:bg-[#B8860B]/5 transition-all bg-white" data-question-id="8">
            <p class="font-semibold text-gray-900 text-lg">Porquê uma Subscrição</p>
            <p class="text-sm text-gray-600 mt-1">Conheça os benefícios dos nossos planos</p>
        </button>

        <button class="faqButton text-left w-full p-6 rounded-lg border border-gray-200 hover:border-[#B8860B] hover:bg-[#B8860B]/5 transition-all bg-white" data-question-id="9">
            <p class="font-semibold text-gray-900 text-lg">Tipos de Consultas</p>
            <p class="text-sm text-gray-600 mt-1">Descubra os diferentes tipos de consultas disponíveis</p>
        </button>
    </div>

    <!-- Answer Display -->
    <div id="answerContainer" class="mt-8 hidden">
        <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-8">
            <div class="flex items-start justify-between mb-6">
                <div>
                    <h2 id="answerTitle" class="text-2xl font-bold text-gray-900"></h2>
                </div>
                <button id="closeAnswer" class="text-gray-400 hover:text-gray-600 transition-colors">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <line x1="18" y1="6" x2="6" y2="18"></line>
                        <line x1="6" y1="6" x2="18" y2="18"></line>
                    </svg>
                </button>
            </div>
            <div id="answerContent" class="text-gray-700 leading-relaxed space-y-4"></div>
        </div>
    </div>
</div>

<script>
    const faqButtons = document.querySelectorAll('.faqButton');
    const answerContainer = document.getElementById('answerContainer');
    const answerTitle = document.getElementById('answerTitle');
    const answerContent = document.getElementById('answerContent');
    const closeAnswer = document.getElementById('closeAnswer');

    // Respostas pré-guardadas
    const answers = {
        1: {
            title: 'Benefícios da Acupuntura',
            content: `
                <p>A acupuntura é uma prática milenar que oferece diversos benefícios para a saúde:</p>
                <ul class="list-disc list-inside space-y-2 mt-3">
                    <li><strong>Alívio da Dor:</strong> Reduz dores crónicas, articulares e musculares</li>
                    <li><strong>Relaxamento:</strong> Diminui o stress e a ansiedade</li>
                    <li><strong>Melhoria da Circulação:</strong> Aumenta o fluxo sanguíneo e energético</li>
                    <li><strong>Equilíbrio Energético:</strong> Restaura o equilíbrio do corpo</li>
                    <li><strong>Melhoria do Sono:</strong> Ajuda a regular o ciclo do sono</li>
                    <li><strong>Fortalecimento Imunológico:</strong> Reforça as defesas do organismo</li>
                </ul>
                <p class="mt-4">Para melhores resultados, recomenda-se realizar sessões regulares conforme prescrito pelo seu terapeuta.</p>
            `
        },
        2: {
            title: 'Como Fazer os Exercícios Prescritos',
            content: `
                <p>Siga estas orientações para realizar seus exercícios de forma segura e eficaz:</p>
                <ol class="list-decimal list-inside space-y-2 mt-3">
                    <li><strong>Aquecimento:</strong> Comece com 5-10 minutos de aquecimento leve</li>
                    <li><strong>Postura Correta:</strong> Mantenha a postura adequada durante todo o exercício</li>
                    <li><strong>Respiração:</strong> Respire de forma controlada e contínua</li>
                    <li><strong>Intensidade Gradual:</strong> Aumente a intensidade progressivamente</li>
                    <li><strong>Frequência:</strong> Realize os exercícios conforme prescrito</li>
                    <li><strong>Descanso:</strong> Respeite os períodos de descanso recomendados</li>
                </ol>
                <p class="mt-4 text-yellow-700 bg-yellow-50 p-3 rounded">⚠️ Se sentir dor ou desconforto, pare imediatamente e contacte seu terapeuta.</p>
            `
        },
        3: {
            title: 'Recomendações Nutricionais',
            content: `
                <p>Uma alimentação adequada é fundamental para o seu bem-estar:</p>
                <div class="mt-4 space-y-3">
                    <div class="p-3 bg-green-50 rounded border border-green-200">
                        <p class="font-semibold text-green-900">✓ Alimentos Recomendados:</p>
                        <p class="text-sm text-green-800 mt-1">Frutas, vegetais, proteínas magras, grãos integrais, legumes</p>
                    </div>
                    <div class="p-3 bg-red-50 rounded border border-red-200">
                        <p class="font-semibold text-red-900">✗ Alimentos a Evitar:</p>
                        <p class="text-sm text-red-800 mt-1">Alimentos processados, açúcares refinados, gorduras saturadas</p>
                    </div>
                    <div class="p-3 bg-blue-50 rounded border border-blue-200">
                        <p class="font-semibold text-blue-900">💧 Hidratação:</p>
                        <p class="text-sm text-blue-800 mt-1">Beba pelo menos 2 litros de água por dia</p>
                    </div>
                </div>
                <p class="mt-4">Consulte seu terapeuta para um plano nutricional personalizado.</p>
            `
        },
        4: {
            title: 'Melhorar Bem-estar Geral',
            content: `
                <p>Aqui estão estratégias práticas para melhorar seu bem-estar:</p>
                <div class="mt-4 space-y-3">
                    <div class="p-3 bg-purple-50 rounded border border-purple-200">
                        <p class="font-semibold text-purple-900">🧘 Meditação e Mindfulness</p>
                        <p class="text-sm text-purple-800 mt-1">Dedique 10-15 minutos diários a práticas de relaxamento</p>
                    </div>
                    <div class="p-3 bg-orange-50 rounded border border-orange-200">
                        <p class="font-semibold text-orange-900">🚶 Atividade Física</p>
                        <p class="text-sm text-orange-800 mt-1">Caminhe 30 minutos por dia ou pratique exercícios leves</p>
                    </div>
                    <div class="p-3 bg-indigo-50 rounded border border-indigo-200">
                        <p class="font-semibold text-indigo-900">😴 Sono de Qualidade</p>
                        <p class="text-sm text-indigo-800 mt-1">Mantenha uma rotina regular de sono (7-8 horas)</p>
                    </div>
                    <div class="p-3 bg-pink-50 rounded border border-pink-200">
                        <p class="font-semibold text-pink-900">🤝 Conexões Sociais</p>
                        <p class="text-sm text-pink-800 mt-1">Passe tempo com família e amigos regularmente</p>
                    </div>
                </div>
            `
        },
        5: {
            title: 'Conheça o José Machado',
            content: `
                <div class="space-y-6">
                    <div class="p-4 bg-[#B8860B]/10 rounded-lg border border-[#B8860B]/20">
                        <p class="text-gray-900 leading-relaxed">Com mais de 15 anos de experiência combinando Medicina Tradicional Chinesa, treino personalizado e nutrição, especializei-me na transformação completa de corpo e mente.</p>
                    </div>

                    <div>
                        <h3 class="font-semibold text-gray-900 mb-3">Qualificações</h3>
                        <ul class="space-y-2">
                            <li class="flex gap-2">
                                <span class="text-[#B8860B]">✓</span>
                                <div>
                                    <p class="font-medium text-gray-900">Licenciatura em Medicina Tradicional Chinesa</p>
                                    <p class="text-sm text-gray-600">Universidade de Medicina Tradicional de Beijing</p>
                                </div>
                            </li>
                            <li class="flex gap-2">
                                <span class="text-[#B8860B]">✓</span>
                                <div>
                                    <p class="font-medium text-gray-900">Certificação em Personal Training e Nutrição</p>
                                    <p class="text-sm text-gray-600">Especialização em Transformação Corporal e Performance</p>
                                </div>
                            </li>
                        </ul>
                    </div>

                    <div>
                        <h3 class="font-semibold text-gray-900 mb-2">Método Inovador QiFlow</h3>
                        <p class="text-gray-700">Criador do método que une tradição oriental e ciência moderna para resultados transformadores.</p>
                    </div>

                    <div class="p-4 bg-gray-50 rounded-lg border border-gray-200">
                        <p class="font-semibold text-gray-900 mb-3">Contacte-nos</p>
                        <div class="space-y-2 text-sm">
                            <p><span class="font-medium">Telefone:</span> +351 912 345 678</p>
                            <p><span class="font-medium">Email:</span> jose@qiflow.pt</p>
                        </div>
                    </div>

                    <a href="{{ route('user.request-appointment') }}" class="inline-flex items-center gap-2 bg-[#B8860B] text-white hover:bg-[#B8860B]/90 px-6 py-2 rounded-lg font-medium transition-all">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M8 2v4" />
                            <path d="M16 2v4" />
                            <rect width="18" height="18" x="3" y="4" rx="2" />
                            <path d="M3 10h18" />
                        </svg>
                        Agendar Consulta
                    </a>
                </div>
            `
        },
        6: {
            title: 'Horário Disponível',
            content: `
                <div class="space-y-4">
                    <div class="p-4 bg-blue-50 rounded-lg border border-blue-200">
                        <p class="font-semibold text-blue-900 mb-2">📅 Horário de Atendimento</p>
                        <p class="text-blue-800">Segunda a Sexta, fora feriados</p>
                        <p class="text-lg font-bold text-blue-900 mt-2">09:00 - 18:00</p>
                    </div>
                    <p class="text-gray-700">Estamos disponíveis para atendê-lo durante estes horários. Para agendar uma consulta fora deste período, contacte-nos diretamente.</p>
                </div>
            `
        },
        7: {
            title: 'Como Marcar uma Consulta',
            content: `
                <p>Siga estes passos simples para agendar sua consulta:</p>
                <ol class="list-decimal list-inside space-y-3 mt-4">
                    <li>
                        <strong>Aceda à secção "Pedir Consulta"</strong>
                        <p class="text-sm text-gray-600 mt-1">Clique no botão "Pedir Consulta" no menu principal</p>
                    </li>
                    <li>
                        <strong>Selecione a Data e Hora</strong>
                        <p class="text-sm text-gray-600 mt-1">Escolha uma data (mínimo 1 dia a partir de hoje) e hora disponível (09:00-17:00)</p>
                    </li>
                    <li>
                        <strong>Escolha o Tipo de Consulta</strong>
                        <p class="text-sm text-gray-600 mt-1">Selecione o tipo de consulta que deseja (Avaliação, Sessão Terapêutica, etc.)</p>
                    </li>
                    <li>
                        <strong>Adicione Notas (Opcional)</strong>
                        <p class="text-sm text-gray-600 mt-1">Descreva qualquer informação relevante para sua consulta</p>
                    </li>
                    <li>
                        <strong>Confirme o Pedido</strong>
                        <p class="text-sm text-gray-600 mt-1">Clique em "Solicitar Consulta" e aguarde confirmação</p>
                    </li>
                </ol>
                <p class="mt-4 text-yellow-700 bg-yellow-50 p-3 rounded">ℹ️ Sua consulta será criada com o estado "Pendente" e será confirmada pelo terapeuta.</p>
            `
        },
        8: {
            title: 'Porquê uma Subscrição',
            content: `
                <p class="mb-4">Conheça os nossos planos de subscrição e escolha o que melhor se adequa aos seus objetivos:</p>
                
                <div class="space-y-4">
                    <div class="p-4 bg-blue-50 rounded-lg border border-blue-200">
                        <div class="flex items-start justify-between mb-3">
                            <div>
                                <p class="font-bold text-blue-900 text-lg">Plano Transformação</p>
                                <p class="text-sm text-blue-800">Mais popular para resultados sustentáveis</p>
                            </div>
                            <p class="font-bold text-blue-900 text-xl">280€<span class="text-sm">/mês</span></p>
                        </div>
                        <ul class="space-y-1 text-sm text-blue-800">
                            <li>✓ 4 consultas mensais</li>
                            <li>✓ Acompanhamento semanal</li>
                            <li>✓ Plano nutricional personalizado</li>
                            <li>✓ Prescrição de exercícios</li>
                            <li>✓ Suporte via WhatsApp</li>
                            <li>✓ Análise composição corporal</li>
                            <li>✓ Relatórios mensais detalhados</li>
                        </ul>
                    </div>

                    <div class="p-4 bg-green-50 rounded-lg border border-green-200">
                        <div class="flex items-start justify-between mb-3">
                            <div>
                                <p class="font-bold text-green-900 text-lg">Programa Completo</p>
                                <p class="text-sm text-green-800">Transformação completa garantida</p>
                            </div>
                            <p class="font-bold text-green-900 text-xl">720€<span class="text-sm">/3 meses</span></p>
                        </div>
                        <ul class="space-y-1 text-sm text-green-800">
                            <li>✓ Tudo do Plano Transformação</li>
                            <li>✓ 12 consultas em 3 meses</li>
                            <li>✓ Sessões de coaching</li>
                            <li>✓ Plano de manutenção</li>
                            <li>✓ Garantia de resultados*</li>
                            <li>✓ Acompanhamento pós-tratamento</li>
                            <li>✓ Programa VIP prioritário</li>
                        </ul>
                    </div>
                </div>

                <p class="mt-4 text-gray-700">Ambos os planos oferecem suporte completo para sua transformação. Escolha o que melhor se adequa ao seu estilo de vida e objetivos.</p>
            `
        },
        9: {
            title: 'Tipos de Consultas',
            content: `
                <p class="mb-4">Conheça os diferentes tipos de consultas disponíveis:</p>
                
                <div class="space-y-3">
                    <div class="p-3 bg-purple-50 rounded border border-purple-200">
                        <p class="font-semibold text-purple-900">Avaliação e Diagnóstico</p>
                        <p class="text-sm text-purple-800 mt-1">Avaliação completa da sua condição de saúde e diagnóstico personalizado</p>
                    </div>

                    <div class="p-3 bg-blue-50 rounded border border-blue-200">
                        <p class="font-semibold text-blue-900">Sessões Terapêuticas</p>
                        <p class="text-sm text-blue-800 mt-1">Sessões de acupuntura, massagem e outras terapias tradicionais</p>
                    </div>

                    <div class="p-3 bg-green-50 rounded border border-green-200">
                        <p class="font-semibold text-green-900">Sessões Especializadas</p>
                        <p class="text-sm text-green-800 mt-1">Sessões focadas em áreas específicas (dor, stress, performance)</p>
                    </div>

                    <div class="p-3 bg-orange-50 rounded border border-orange-200">
                        <p class="font-semibold text-orange-900">Técnicas Complementares</p>
                        <p class="text-sm text-orange-800 mt-1">Técnicas complementares para potenciar resultados</p>
                    </div>

                    <div class="p-3 bg-pink-50 rounded border border-pink-200">
                        <p class="font-semibold text-pink-900">Programas e Planos</p>
                        <p class="text-sm text-pink-800 mt-1">Programas estruturados para transformação completa</p>
                    </div>

                    <div class="p-3 bg-yellow-50 rounded border border-yellow-200">
                        <p class="font-semibold text-yellow-900">Consulta de Avaliação Gratuita</p>
                        <p class="text-sm text-yellow-800 mt-1">Primeira consulta gratuita para conhecer o método QiFlow</p>
                    </div>
                </div>

                <p class="mt-4 text-gray-700">Cada tipo de consulta é personalizado conforme suas necessidades específicas. Contacte-nos para mais informações.</p>
            `
        }
    };

    // Event listeners para os botões
    faqButtons.forEach(button => {
        button.addEventListener('click', (e) => {
            e.preventDefault();
            const questionId = button.getAttribute('data-question-id');
            const answer = answers[questionId];
            
            if (answer) {
                answerTitle.textContent = answer.title;
                answerContent.innerHTML = answer.content;
                answerContainer.classList.remove('hidden');
                answerContainer.scrollIntoView({ behavior: 'smooth', block: 'start' });
            }
        });
    });

    // Fechar resposta
    closeAnswer.addEventListener('click', () => {
        answerContainer.classList.add('hidden');
    });
</script>
@endsection
