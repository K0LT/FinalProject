<!-- Ready to Start Section -->
<section class="py-20 bg-[#B8860B] text-white">
    <div class="container mx-auto px-4 text-center">
        <div class="max-w-3xl mx-auto">
            <h2 class="text-3xl lg:text-4xl mb-4 font-semibold">
                Pronto para Começar a sua Transformação?
            </h2>

            <p class="text-lg lg:text-xl mb-8 opacity-90">
                Marque a sua consulta gratuita e descubra como pode alcançar os seus
                objetivos de forma natural
            </p>

            <div class="flex flex-col sm:flex-row gap-4 justify-center mb-8">
                <a href="{{ route('web.login') }}" class="inline-flex items-center justify-center gap-2 whitespace-nowrap font-medium transition-all bg-white text-[#B8860B] hover:bg-gray-100 h-10 rounded-md text-base lg:text-lg px-6 lg:px-8">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="mr-2">
                        <path d="M8 2v4" />
                        <path d="M16 2v4" />
                        <rect width="18" height="18" x="3" y="4" rx="2" />
                        <path d="M3 10h18" />
                    </svg>
                    Marcar Consulta Gratuita
                </a>

                <a href="{{ route('web.register') }}" class="inline-flex items-center justify-center gap-2 whitespace-nowrap font-medium transition-all border border-white text-white hover:bg-white hover:text-[#B8860B] h-10 rounded-md text-base lg:text-lg px-6 lg:px-8">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="mr-2">
                        <path d="M2 9.5a5.5 5.5 0 0 1 9.591-3.676.56.56 0 0 0 .818 0A5.49 5.49 0 0 1 22 9.5c0 2.29-1.5 4-3 5.5l-5.492 5.313a2 2 0 0 1-3 .019L5 15c-1.5-1.5-3-3.2-3-5.5" />
                    </svg>
                    Registar-me Agora
                </a>
            </div>

            <div class="flex flex-wrap items-center justify-center gap-4 lg:gap-6 text-sm opacity-80 max-w-[1000px] mx-auto">
                <div class="flex items-center gap-2">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"></path>
                    </svg>
                    <span>Dados 100% seguros</span>
                </div>
                <div class="flex items-center gap-2">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <circle cx="12" cy="12" r="10"></circle>
                        <polyline points="12 6 12 12 16 14"></polyline>
                    </svg>
                    <span>Resposta em 24h</span>
                </div>
                <div class="flex items-center gap-2">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M21.801 10A10 10 0 1 1 17 3.335"></path>
                        <path d="m9 11 3 3L22 4"></path>
                    </svg>
                    <span>Sem compromisso</span>
                </div>
            </div>
        </div>
    </div>
</section>
