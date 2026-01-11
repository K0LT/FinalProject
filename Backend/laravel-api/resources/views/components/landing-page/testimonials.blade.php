<!-- Testimonials Section -->
<section class="py-20 bg-gradient-to-r from-[#B8860B]/5 to-orange-50">
    <div class="container mx-auto px-4">
        <div class="text-center mb-16">
            <h2 class="text-3xl lg:text-4xl mb-4 font-semibold">Histórias de Sucesso</h2>
            <p class="text-lg lg:text-xl text-gray-600">
                Veja os resultados reais dos nossos pacientes
            </p>
        </div>

        <div class="flex flex-col md:flex-row justify-center items-stretch gap-6 md:gap-12 max-w-[1200px] mx-auto">
            @foreach([
                ['name' => 'Maria Santos', 'result' => '-18kg em 6 meses', 'text' => 'Perdi 18kg em 6 meses com o acompanhamento do Dr. José. A abordagem holística fez toda a diferença!'],
                ['name' => 'Carlos Oliveira', 'result' => '-15kg em 4 meses', 'text' => 'Não só perdi peso como melhorei completamente a minha qualidade de vida. Recomendo vivamente!'],
                ['name' => 'Ana Ferreira', 'result' => '-22kg em 8 meses', 'text' => 'O Dr. José conseguiu onde outros falharam. Finalmente encontrei um método sustentável.']
            ] as $testimonial)
            <div class="flex flex-col bg-white text-gray-900 rounded-xl shadow-lg p-6 flex-1">
                <div class="flex items-center gap-1 mb-4">
                    @for($i = 0; $i < 5; $i++)
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="currentColor" class="text-yellow-400">
                            <path d="M11.525 2.295a.53.53 0 0 1 .95 0l2.31 4.679a2.123 2.123 0 0 0 1.595 1.16l5.166.756a.53.53 0 0 1 .294.904l-3.736 3.638a2 2 0 0 0-.611 1.878l.882 5.14a.53.53 0 0 1-.771.56l-4.618-2.428a2.122 2.122 0 0 0-1.973 0L6.396 21.01a.53.53 0 0 1-.77-.56l.881-5.139a2.122 2.122 0 0 0-.611-1.879L2.16 9.795a.53.53 0 0 1 .294-.906l5.165-.755a2.122 2.122 0 0 0 1.597-1.16z"></path>
                        </svg>
                    @endfor
                </div>

                <p class="text-sm italic mb-4">{{ $testimonial['text'] }}</p>

                <div class="flex items-center justify-between mt-auto">
                    <div>
                        <p class="text-sm font-medium">{{ $testimonial['name'] }}</p>
                        <span class="inline-flex items-center justify-center rounded-md bg-gray-100 text-gray-900 text-xs font-medium px-2 py-0.5 mt-1">
                            {{ $testimonial['result'] }}
                        </span>
                    </div>
                    <div class="w-10 h-10 bg-[#B8860B]/10 rounded-full flex items-center justify-center">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="text-[#B8860B]">
                            <path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"></path>
                            <circle cx="9" cy="7" r="4"></circle>
                        </svg>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>
