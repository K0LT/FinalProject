<!-- Client Sidebar -->
<aside class="w-64 bg-white border-r border-gray-200 min-h-screen">
    <div class="p-6">
        <!-- Logo -->
        <div class="flex items-center gap-3 mb-8">
            <div class="relative flex h-8 w-8 items-center justify-center">
                <svg viewBox="0 0 100 100" class="w-full h-full" xmlns="http://www.w3.org/2000/svg"><circle cx="50" cy="50" r="48" fill="#B8860B" stroke="#996F00" stroke-width="2" class="drop-shadow-lg"></circle><defs><radialGradient id="premiumGradient" cx="30%" cy="30%"><stop offset="0%" stop-color="#FFD700" stop-opacity="0.9"></stop><stop offset="100%" stop-color="#B8860B" stop-opacity="1"></stop></radialGradient></defs><circle cx="50" cy="50" r="42" fill="url(#premiumGradient)"></circle><pattern id="premium-pattern" x="0" y="0" width="6" height="6" patternUnits="userSpaceOnUse"><circle cx="3" cy="3" r="0.4" fill="#FFFACD" opacity="0.3"></circle></pattern><circle cx="50" cy="50" r="38" fill="url(#premium-pattern)"></circle><g fill="white" stroke="white" stroke-width="1" stroke-linecap="round" stroke-linejoin="round"><path d="M 28 25 L 72 25" stroke-width="2.5" opacity="0.95"></path><path d="M 50 25 L 50 75" stroke-width="2" opacity="0.9"></path><path d="M 32 35 Q 38 40 32 45 Q 26 50 32 55" fill="none" stroke-width="2" opacity="0.85"></path><path d="M 68 35 Q 62 40 68 45 Q 74 50 68 55" fill="none" stroke-width="2" opacity="0.85"></path><path d="M 42 40 Q 50 35 58 40 Q 50 50 42 40" fill="none" stroke-width="1.8" opacity="0.8"></path><path d="M 35 65 L 65 65" stroke-width="2" opacity="0.85"></path><circle cx="38" cy="32" r="1" fill="white" opacity="0.9"></circle><circle cx="50" cy="30" r="1" fill="white" opacity="0.9"></circle><circle cx="62" cy="32" r="1" fill="white" opacity="0.9"></circle></g><circle cx="50" cy="50" r="47" fill="none" stroke="#FFD700" stroke-width="0.8" opacity="0.7"></circle><circle cx="50" cy="50" r="44" fill="none" stroke="#FFFACD" stroke-width="0.5" opacity="0.5"></circle></svg>
            </div>
            <div>
                <h2 class="font-semibold text-[#B8860B]">QiFlow</h2>
                <p class="text-xs text-gray-600">Portal do Paciente</p>
            </div>
        </div>

        <!-- Navigation Menu -->
        <nav class="space-y-2">
            <!-- Profile -->
            <a href="{{ route('user.profile') }}" class="flex items-center gap-3 px-4 py-3 rounded-lg text-sm font-medium transition-all {{ request()->routeIs('user.profile') ? 'bg-[#B8860B]/10 text-[#B8860B]' : 'text-gray-700 hover:bg-gray-100' }}">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"></path>
                    <circle cx="9" cy="7" r="4"></circle>
                </svg>
                <span>Perfil</span>
            </a>

            <!-- Appointments -->
            <a href="{{ route('user.appointments') }}" class="flex items-center gap-3 px-4 py-3 rounded-lg text-sm font-medium transition-all {{ request()->routeIs('user.appointments') ? 'bg-[#B8860B]/10 text-[#B8860B]' : 'text-gray-700 hover:bg-gray-100' }}">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M8 2v4" />
                    <path d="M16 2v4" />
                    <rect width="18" height="18" x="3" y="4" rx="2" />
                    <path d="M3 10h18" />
                </svg>
                <span>Consultas</span>
            </a>

            <!-- Diagnostics & Treatments -->
            <a href="{{ route('user.diagnostics') }}" class="flex items-center gap-3 px-4 py-3 rounded-lg text-sm font-medium transition-all {{ request()->routeIs('user.diagnostics') ? 'bg-[#B8860B]/10 text-[#B8860B]' : 'text-gray-700 hover:bg-gray-100' }}">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2z"></path>
                    <path d="M12 6v6l4 2"></path>
                </svg>
                <span>Diagnósticos</span>
            </a>

            <!-- Treatment Objectives -->
            <a href="{{ route('user.objectives') }}" class="flex items-center gap-3 px-4 py-3 rounded-lg text-sm font-medium transition-all {{ request()->routeIs('user.objectives') ? 'bg-[#B8860B]/10 text-[#B8860B]' : 'text-gray-700 hover:bg-gray-100' }}">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <circle cx="12" cy="12" r="10"></circle>
                    <circle cx="12" cy="12" r="6"></circle>
                    <circle cx="12" cy="12" r="2"></circle>
                </svg>
                <span>Objetivos</span>
            </a>

            <!-- Exercises -->
            <a href="{{ route('user.exercises') }}" class="flex items-center gap-3 px-4 py-3 rounded-lg text-sm font-medium transition-all {{ request()->routeIs('user.exercises') ? 'bg-[#B8860B]/10 text-[#B8860B]' : 'text-gray-700 hover:bg-gray-100' }}">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M6 4h12v2H6z"></path>
                    <path d="M6 10h12v2H6z"></path>
                    <path d="M6 16h12v2H6z"></path>
                </svg>
                <span>Exercícios</span>
            </a>

            <!-- Weight Control -->
            <a href="{{ route('user.weight-control') }}" class="flex items-center gap-3 px-4 py-3 rounded-lg text-sm font-medium transition-all {{ request()->routeIs('user.weight-control') ? 'bg-[#B8860B]/10 text-[#B8860B]' : 'text-gray-700 hover:bg-gray-100' }}">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M3 12h18"></path>
                    <path d="M5 8h14v8H5z"></path>
                </svg>
                <span>Controlo de Peso</span>
            </a>

            <!-- AI Assistant -->
            <a href="{{ route('user.ai-assistant') }}" class="flex items-center gap-3 px-4 py-3 rounded-lg text-sm font-medium transition-all {{ request()->routeIs('user.ai-assistant') ? 'bg-[#B8860B]/10 text-[#B8860B]' : 'text-gray-700 hover:bg-gray-100' }}">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2z"></path>
                    <path d="M12 6v6l4 2"></path>
                </svg>
                <span>Perguntas Frequentes</span>
            </a>
        </nav>

        <!-- Divider -->
        <div class="my-6 border-t border-gray-200"></div>

        <!-- User Info & Logout -->
        <div class="space-y-3">
            <div class="px-4 py-3 bg-gray-50 rounded-lg">
                <p class="text-xs text-gray-600 uppercase tracking-widest">Utilizador</p>
                <p class="text-sm font-medium text-gray-900 truncate">{{ Auth::user()->name }}</p>
                <p class="text-xs text-gray-600 truncate">{{ Auth::user()->email }}</p>
            </div>

            <form method="POST" action="{{ route('web.logout') }}" class="w-full">
                @csrf
                <button type="submit" class="w-full flex items-center gap-2 px-4 py-2 text-sm font-medium text-red-600 hover:bg-red-50 rounded-lg transition-all">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"></path>
                        <polyline points="16 17 21 12 16 7"></polyline>
                        <line x1="21" y1="12" x2="9" y2="12"></line>
                    </svg>
                    <span>Sair</span>
                </button>
            </form>
        </div>
    </div>
</aside>
