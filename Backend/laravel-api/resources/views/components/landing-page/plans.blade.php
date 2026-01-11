<!-- Plans Section -->
<section class="py-20 bg-white">
    <div class="container mx-auto px-4">
        <div class="text-center mb-16">
            <span class="inline-flex items-center justify-center rounded-md border px-2 py-0.5 text-xs font-medium w-fit whitespace-nowrap shrink-0 gap-1 mb-4 bg-[#B8860B]/10 text-[#B8860B] border-[#B8860B]/20">
                <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="mr-1">
                    <path d="M4 14a1 1 0 0 1-.78-1.63l9.9-10.2a.5.5 0 0 1 .86.46l-1.92 6.02A1 1 0 0 0 13 10h7a1 1 0 0 1 .78 1.63l-9.9 10.2a.5.5 0 0 1-.86-.46l1.92-6.02A1 1 0 0 0 11 14z" />
                </svg>
                Planos de Tratamento
            </span>
            <h2 class="text-4xl mb-4">Escolha o seu plano ideal</h2>
            <p class="text-xl text-gray-600 max-w-2xl mx-auto">
                Opções flexíveis para todos os objetivos e orçamentos
            </p>
        </div>

        <div class="flex flex-col md:flex-row justify-center mx-auto max-w-[1000px] w-full gap-6 md:gap-0">
            <!-- Plan 1: Consulta Individual -->
            <div class="w-full md:w-1/3 bg-white text-gray-900 flex flex-col gap-6 rounded-xl border border-gray-200 p-6 shadow-sm hover:shadow-md transition-all">
                <h4 class="text-2xl text-center">Consulta Individual</h4>
                <div class="text-center mt-2">
                    <span class="text-4xl text-[#B8860B]">80€</span>
                    <span class="text-gray-600"> /por consulta</span>
                </div>
                <p class="text-gray-600 text-center">
                    Perfeito para quem quer experimentar
                </p>

                <div class="mt-4 space-y-3">
                    <div class="flex items-center gap-3">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="text-[#B8860B] shrink-0">
                            <path d="M21.801 10A10 10 0 1 1 17 3.335"></path>
                            <path d="m9 11 3 3L22 4"></path>
                        </svg>
                        <span class="text-sm">Consulta de 90 minutos</span>
                    </div>
                    <div class="flex items-center gap-3">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="text-[#B8860B] shrink-0">
                            <path d="M21.801 10A10 10 0 1 1 17 3.335"></path>
                            <path d="m9 11 3 3L22 4"></path>
                        </svg>
                        <span class="text-sm">Avaliação completa MTC</span>
                    </div>
                    <div class="flex items-center gap-3">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="text-[#B8860B] shrink-0">
                            <path d="M21.801 10A10 10 0 1 1 17 3.335"></path>
                            <path d="m9 11 3 3L22 4"></path>
                        </svg>
                        <span class="text-sm">Plano nutricional básico</span>
                    </div>
                    <div class="flex items-center gap-3">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="text-[#B8860B] shrink-0">
                            <path d="M21.801 10A10 10 0 1 1 17 3.335"></path>
                            <path d="m9 11 3 3L22 4"></path>
                        </svg>
                        <span class="text-sm">Sessão de acupunctura</span>
                    </div>
                    <div class="flex items-center gap-3">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="text-[#B8860B] shrink-0">
                            <path d="M21.801 10A10 10 0 1 1 17 3.335"></path>
                            <path d="m9 11 3 3L22 4"></path>
                        </svg>
                        <span class="text-sm">Relatório de progresso</span>
                    </div>
                </div>

                <a href="{{ route('web.login') }}" class="mt-auto inline-flex items-center justify-center gap-2 w-full border border-gray-200 rounded-md text-sm font-medium px-4 py-2 hover:bg-gray-50 transition-all">
                    Saber Mais
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="ml-2">
                        <path d="M5 12h14" />
                        <path d="m12 5 7 7-7 7" />
                    </svg>
                </a>
            </div>

            <!-- Plan 2: Plano Transformação (Most Popular) -->
            <div class="w-full md:w-1/3 bg-white text-gray-900 flex flex-col gap-6 rounded-xl border border-[#B8860B] shadow-2xl relative p-6 md:scale-105">
                <span class="absolute -top-3 left-1/2 -translate-x-1/2 inline-flex items-center justify-center rounded-md border px-2 py-0.5 text-xs font-medium bg-[#B8860B] text-white">
                    Mais Popular
                </span>

                <h4 class="text-2xl text-center">Plano Transformação</h4>
                <div class="text-center mt-2">
                    <span class="text-4xl text-[#B8860B]">280€</span>
                    <span class="text-gray-600"> /por mês</span>
                </div>
                <p class="text-gray-600 text-center">
                    Mais popular para resultados sustentáveis
                </p>

                <div class="mt-4 space-y-3">
                    <div class="flex items-center gap-3">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="text-[#B8860B] shrink-0">
                            <path d="M21.801 10A10 10 0 1 1 17 3.335"></path>
                            <path d="m9 11 3 3L22 4"></path>
                        </svg>
                        <span class="text-sm">4 consultas mensais</span>
                    </div>
                    <div class="flex items-center gap-3">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="text-[#B8860B] shrink-0">
                            <path d="M21.801 10A10 10 0 1 1 17 3.335"></path>
                            <path d="m9 11 3 3L22 4"></path>
                        </svg>
                        <span class="text-sm">Acompanhamento semanal</span>
                    </div>
                    <div class="flex items-center gap-3">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="text-[#B8860B] shrink-0">
                            <path d="M21.801 10A10 10 0 1 1 17 3.335"></path>
                            <path d="m9 11 3 3L22 4"></path>
                        </svg>
                        <span class="text-sm">Plano nutricional personalizado</span>
                    </div>
                    <div class="flex items-center gap-3">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="text-[#B8860B] shrink-0">
                            <path d="M21.801 10A10 10 0 1 1 17 3.335"></path>
                            <path d="m9 11 3 3L22 4"></path>
                        </svg>
                        <span class="text-sm">Prescrição de exercícios</span>
                    </div>
                    <div class="flex items-center gap-3">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="text-[#B8860B] shrink-0">
                            <path d="M21.801 10A10 10 0 1 1 17 3.335"></path>
                            <path d="m9 11 3 3L22 4"></path>
                        </svg>
                        <span class="text-sm">Suporte via WhatsApp</span>
                    </div>
                    <div class="flex items-center gap-3">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="text-[#B8860B] shrink-0">
                            <path d="M21.801 10A10 10 0 1 1 17 3.335"></path>
                            <path d="m9 11 3 3L22 4"></path>
                        </svg>
                        <span class="text-sm">Análise composição corporal</span>
                    </div>
                    <div class="flex items-center gap-3">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="text-[#B8860B] shrink-0">
                            <path d="M21.801 10A10 10 0 1 1 17 3.335"></path>
                            <path d="m9 11 3 3L22 4"></path>
                        </svg>
                        <span class="text-sm">Relatórios mensais detalhados</span>
                    </div>
                </div>

                <a href="{{ route('web.register') }}" class="mt-auto inline-flex items-center justify-center gap-2 w-full bg-[#B8860B] text-white hover:bg-[#B8860B]/90 rounded-md text-sm font-medium px-4 py-2 transition-all">
                    Começar Agora
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="ml-2">
                        <path d="M5 12h14" />
                        <path d="m12 5 7 7-7 7" />
                    </svg>
                </a>
            </div>

            <!-- Plan 3: Programa Completo -->
            <div class="w-full md:w-1/3 bg-white text-gray-900 flex flex-col gap-6 rounded-xl border border-gray-200 p-6 shadow-sm hover:shadow-md transition-all">
                <h4 class="text-2xl text-center">Programa Completo</h4>
                <div class="text-center mt-2">
                    <span class="text-4xl text-[#B8860B]">720€</span>
                    <span class="text-gray-600"> /3 meses</span>
                </div>
                <p class="text-gray-600 text-center">
                    Transformação completa garantida
                </p>

                <div class="mt-4 space-y-3">
                    <div class="flex items-center gap-3">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="text-[#B8860B] shrink-0">
                            <path d="M21.801 10A10 10 0 1 1 17 3.335"></path>
                            <path d="m9 11 3 3L22 4"></path>
                        </svg>
                        <span class="text-sm">Tudo do Plano Transformação</span>
                    </div>
                    <div class="flex items-center gap-3">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="text-[#B8860B] shrink-0">
                            <path d="M21.801 10A10 10 0 1 1 17 3.335"></path>
                            <path d="m9 11 3 3L22 4"></path>
                        </svg>
                        <span class="text-sm">12 consultas em 3 meses</span>
                    </div>
                    <div class="flex items-center gap-3">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="text-[#B8860B] shrink-0">
                            <path d="M21.801 10A10 10 0 1 1 17 3.335"></path>
                            <path d="m9 11 3 3L22 4"></path>
                        </svg>
                        <span class="text-sm">Sessões de coaching</span>
                    </div>
                    <div class="flex items-center gap-3">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="text-[#B8860B] shrink-0">
                            <path d="M21.801 10A10 10 0 1 1 17 3.335"></path>
                            <path d="m9 11 3 3L22 4"></path>
                        </svg>
                        <span class="text-sm">Plano de manutenção</span>
                    </div>
                    <div class="flex items-center gap-3">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="text-[#B8860B] shrink-0">
                            <path d="M21.801 10A10 10 0 1 1 17 3.335"></path>
                            <path d="m9 11 3 3L22 4"></path>
                        </svg>
                        <span class="text-sm">Garantia de resultados*</span>
                    </div>
                    <div class="flex items-center gap-3">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="text-[#B8860B] shrink-0">
                            <path d="M21.801 10A10 10 0 1 1 17 3.335"></path>
                            <path d="m9 11 3 3L22 4"></path>
                        </svg>
                        <span class="text-sm">Acompanhamento pós-tratamento</span>
                    </div>
                    <div class="flex items-center gap-3">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="text-[#B8860B] shrink-0">
                            <path d="M21.801 10A10 10 0 1 1 17 3.335"></path>
                            <path d="m9 11 3 3L22 4"></path>
                        </svg>
                        <span class="text-sm">Programa VIP prioritário</span>
                    </div>
                </div>

                <a href="{{ route('web.login') }}" class="mt-auto inline-flex items-center justify-center gap-2 w-full border border-gray-200 rounded-md text-sm font-medium px-4 py-2 hover:bg-gray-50 transition-all">
                    Saber Mais
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="ml-2">
                        <path d="M5 12h14" />
                        <path d="m12 5 7 7-7 7" />
                    </svg>
                </a>
            </div>
        </div>

        <div class="text-center mt-12">
            <p class="text-sm text-gray-600 mb-4">
                * Garantia válida mediante cumprimento do plano de tratamento
            </p>
            <a href="{{ route('web.register') }}" class="inline-flex items-center justify-center gap-2 text-sm font-medium bg-[#B8860B] text-white hover:bg-[#B8860B]/90 h-10 rounded-md px-6 transition-all">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="mr-2">
                    <path d="M8 2v4" />
                    <path d="M16 2v4" />
                    <rect width="18" height="18" x="3" y="4" rx="2" />
                    <path d="M3 10h18" />
                </svg>
                Marcar Consulta Gratuita de Avaliação
            </a>
        </div>
    </div>
</section>
