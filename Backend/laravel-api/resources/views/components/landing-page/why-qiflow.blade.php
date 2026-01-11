<!-- Why QiFlow Section -->
<section class="py-20 bg-gray-50">
    <div class="container mx-auto px-4">
        <div class="text-center mb-16">
            <h2 class="text-3xl lg:text-4xl mb-4">Por que escolher o QiFlow?</h2>
            <p class="text-lg lg:text-xl text-gray-600 max-w-2xl mx-auto">
                Metodologia única que combina tradição oriental com tecnologia moderna
            </p>
        </div>
        <div class="flex flex-col md:flex-row gap-6 md:gap-8 max-w-6xl mx-auto">
            @foreach([
                ['icon' => 'target', 'title' => 'Acompanhamento Personalizado', 'desc' => 'Planos de tratamento individualizados com foco na perda de peso sustentável'],
                ['icon' => 'chart', 'title' => 'Análise Detalhada', 'desc' => 'Monitorização completa da composição corporal e progresso semanal'],
                ['icon' => 'users', 'title' => 'Experiência Comprovada', 'desc' => 'Mais de 15 anos de experiência em medicina tradicional chinesa'],
                ['icon' => 'award', 'title' => 'Resultados Garantidos', 'desc' => 'Metodologia testada com 95% de taxa de sucesso dos pacientes']
            ] as $item)
            <div class="text-card-foreground flex flex-col gap-6 rounded-xl text-center border-0 shadow-lg bg-white hover:shadow-xl transition-shadow flex-1">
                <div class="px-6 pt-8 pb-6">
                    <div class="w-16 h-16 bg-[#B8860B]/10 rounded-full flex items-center justify-center mx-auto mb-4">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-8 h-8 text-[#B8860B]">
                            @if($item['icon'] == 'target')
                                <circle cx="12" cy="12" r="10"></circle>
                                <circle cx="12" cy="12" r="6"></circle>
                                <circle cx="12" cy="12" r="2"></circle>
                            @elseif($item['icon'] == 'chart')
                                <path d="M3 3v16a2 2 0 0 0 2 2h16"></path>
                                <path d="M18 17V9"></path>
                                <path d="M13 17V5"></path>
                                <path d="M8 17v-3"></path>
                            @elseif($item['icon'] == 'users')
                                <path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"></path>
                                <circle cx="9" cy="7" r="4"></circle>
                            @else
                                <path d="m15.477 12.89 1.515 8.526a.5.5 0 0 1-.81.47l-3.58-2.687a1 1 0 0 0-1.197 0l-3.586 2.686a.5.5 0 0 1-.81-.469l1.514-8.526"></path>
                                <circle cx="12" cy="8" r="6"></circle>
                            @endif
                        </svg>
                    </div>
                    <h3 class="text-lg mb-3">{{ $item['title'] }}</h3>
                    <p class="text-gray-600 text-sm">{{ $item['desc'] }}</p>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>
