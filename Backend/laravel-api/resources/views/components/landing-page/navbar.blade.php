<!-- Navigation -->
<nav class="sticky top-0 z-50 border-b bg-white/90 backdrop-blur-sm">
    <div class="container mx-auto px-4 py-4">
        <div class="flex items-center justify-between">
            <div class="flex items-center gap-3">
                <div class="relative flex h-8 w-8 items-center justify-center">
                    <svg viewBox="0 0 100 100" class="w-full h-full" xmlns="http://www.w3.org/2000/svg"><circle cx="50" cy="50" r="48" fill="#B8860B" stroke="#996F00" stroke-width="2" class="drop-shadow-lg"></circle><defs><radialGradient id="premiumGradient" cx="30%" cy="30%"><stop offset="0%" stop-color="#FFD700" stop-opacity="0.9"></stop><stop offset="100%" stop-color="#B8860B" stop-opacity="1"></stop></radialGradient></defs><circle cx="50" cy="50" r="42" fill="url(#premiumGradient)"></circle><pattern id="premium-pattern" x="0" y="0" width="6" height="6" patternUnits="userSpaceOnUse"><circle cx="3" cy="3" r="0.4" fill="#FFFACD" opacity="0.3"></circle></pattern><circle cx="50" cy="50" r="38" fill="url(#premium-pattern)"></circle><g fill="white" stroke="white" stroke-width="1" stroke-linecap="round" stroke-linejoin="round"><path d="M 28 25 L 72 25" stroke-width="2.5" opacity="0.95"></path><path d="M 50 25 L 50 75" stroke-width="2" opacity="0.9"></path><path d="M 32 35 Q 38 40 32 45 Q 26 50 32 55" fill="none" stroke-width="2" opacity="0.85"></path><path d="M 68 35 Q 62 40 68 45 Q 74 50 68 55" fill="none" stroke-width="2" opacity="0.85"></path><path d="M 42 40 Q 50 35 58 40 Q 50 50 42 40" fill="none" stroke-width="1.8" opacity="0.8"></path><path d="M 35 65 L 65 65" stroke-width="2" opacity="0.85"></path><circle cx="38" cy="32" r="1" fill="white" opacity="0.9"></circle><circle cx="50" cy="30" r="1" fill="white" opacity="0.9"></circle><circle cx="62" cy="32" r="1" fill="white" opacity="0.9"></circle></g><circle cx="50" cy="50" r="47" fill="none" stroke="#FFD700" stroke-width="0.8" opacity="0.7"></circle><circle cx="50" cy="50" r="44" fill="none" stroke="#FFFACD" stroke-width="0.5" opacity="0.5"></circle></svg>
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
