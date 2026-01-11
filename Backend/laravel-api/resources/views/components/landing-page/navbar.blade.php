<!-- Navigation -->
<nav class="sticky top-0 z-50 border-b bg-white/90 backdrop-blur-sm">
    <div class="container mx-auto px-4 py-4">
        <div class="flex items-center justify-between">
            <div class="flex items-center gap-3">
                <div class="relative flex h-8 w-8 items-center justify-center">
                    <svg viewBox="0 0 100 100" class="h-full w-full" xmlns="http://www.w3.org/2000/svg">
                        <circle cx="50" cy="50" r="48" class="fill-[#B8860B] stroke-[#996F00] stroke-[2px]"></circle>
                        <defs>
                            <radialGradient id="premiumGradient" cx="30%" cy="30%">
                                <stop offset="0%" stop-color="#FFD700" stop-opacity="0.9"></stop>
                                <stop offset="100%" stop-color="#B8860B" stop-opacity="1"></stop>
                            </radialGradient>
                        </defs>
                        <circle cx="50" cy="50" r="42" fill="url(#premiumGradient)"></circle>
                        <g class="fill-white stroke-white" stroke-width="1" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M 28 25 L 72 25" stroke-width="2.5" opacity="0.95" fill="none"></path>
                            <path d="M 50 25 L 50 75" stroke-width="2" opacity="0.9" fill="none"></path>
                        </g>
                    </svg>
                </div>
                <h1 class="text-xl font-semibold text-[#B8860B]">QiFlow</h1>
            </div>
            
            <div class="flex items-center gap-3">
                @auth
                    <a href="{{ route('user.profile') }}" class="inline-flex h-9 items-center justify-center gap-2 whitespace-nowrap rounded-md border bg-background px-4 py-2 text-sm font-medium text-foreground transition-all hover:bg-accent hover:text-accent-foreground">
                        Perfil
                    </a>
                    <form method="POST" action="{{ route('web.logout') }}" class="inline">
                        @csrf
                        <button type="submit" class="inline-flex h-9 items-center justify-center gap-2 whitespace-nowrap rounded-md bg-red-600 px-4 py-2 text-sm font-medium text-white transition-all hover:bg-red-700">
                            Sair
                        </button>
                    </form>
                @else
                    <a href="{{ route('web.login') }}" class="inline-flex h-9 items-center justify-center gap-2 whitespace-nowrap rounded-md border bg-background px-4 py-2 text-sm font-medium text-foreground transition-all hover:bg-accent hover:text-accent-foreground">
                        Entrar
                    </a>
                    <a href="{{ route('web.register') }}" class="inline-flex h-9 items-center justify-center gap-2 whitespace-nowrap rounded-md bg-[#B8860B] px-4 py-2 text-sm font-medium text-white transition-all hover:bg-[#B8860B]/90">
                        Registar-me
                    </a>
                @endauth
            </div>
        </div>
    </div>
</nav>
