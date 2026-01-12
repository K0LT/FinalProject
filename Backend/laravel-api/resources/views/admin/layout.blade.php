@extends('layouts.app')

@section('content')
<div class="flex h-screen bg-gray-50">
    <!-- Sidebar -->
    <aside class="w-64 bg-white border-r border-gray-200 min-h-screen">
        <div class="p-6">
            <!-- Logo -->
            <div class="flex items-center gap-3 mb-8">
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
                <div>
                    <h2 class="font-semibold text-[#B8860B]">QiFlow</h2>
                    <p class="text-xs text-gray-600">Painel Admin</p>
                </div>
            </div>

            <!-- Navigation Menu -->
            <nav class="space-y-2">
                <!-- Dashboard -->
                <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-3 px-4 py-3 rounded-lg text-sm font-medium transition-all {{ request()->routeIs('admin.dashboard') ? 'bg-[#B8860B]/10 text-[#B8860B]' : 'text-gray-700 hover:bg-gray-100' }}">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path>
                        <polyline points="9 22 9 12 15 12 15 22"></polyline>
                    </svg>
                    <span>Dashboard</span>
                </a>

                <!-- Patients -->
                <a href="{{ route('admin.patients') }}" class="flex items-center gap-3 px-4 py-3 rounded-lg text-sm font-medium transition-all {{ request()->routeIs('admin.patients*') ? 'bg-[#B8860B]/10 text-[#B8860B]' : 'text-gray-700 hover:bg-gray-100' }}">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"></path>
                        <circle cx="9" cy="7" r="4"></circle>
                        <path d="M22 16v-2a4 4 0 0 0-2.5-3.74"></path>
                        <path d="M14 14h8v2h-8z"></path>
                    </svg>
                    <span>Pacientes</span>
                </a>

                <!-- Appointments -->
                <a href="{{ route('admin.appointments') }}" class="flex items-center gap-3 px-4 py-3 rounded-lg text-sm font-medium transition-all {{ request()->routeIs('admin.appointments*') ? 'bg-[#B8860B]/10 text-[#B8860B]' : 'text-gray-700 hover:bg-gray-100' }}">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M8 2v4m8-4v4M3 10h18v10a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V10z"></path>
                    </svg>
                    <span>Consultas</span>
                </a>

                <!-- Exercises -->
                <a href="{{ route('admin.exercises') }}" class="flex items-center gap-3 px-4 py-3 rounded-lg text-sm font-medium transition-all {{ request()->routeIs('admin.exercises*') ? 'bg-[#B8860B]/10 text-[#B8860B]' : 'text-gray-700 hover:bg-gray-100' }}">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M6 4h12v16H6z"></path>
                        <path d="M10 9h4"></path>
                        <path d="M10 13h4"></path>
                        <path d="M10 17h4"></path>
                    </svg>
                    <span>Exercícios</span>
                </a>

                <!-- Clients with Plan -->
                <a href="{{ route('admin.clients-with-plan') }}" class="flex items-center gap-3 px-4 py-3 rounded-lg text-sm font-medium transition-all {{ request()->routeIs('admin.clients-with-plan*') ? 'bg-[#B8860B]/10 text-[#B8860B]' : 'text-gray-700 hover:bg-gray-100' }}">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                        <circle cx="12" cy="7" r="4"></circle>
                        <path d="M16 11h6"></path>
                        <path d="M16 15h6"></path>
                    </svg>
                    <span>Clientes com Plano</span>
                </a>

                <!-- Symptoms -->
                <a href="{{ route('admin.symptoms') }}" class="flex items-center gap-3 px-4 py-3 rounded-lg text-sm font-medium transition-all {{ request()->routeIs('admin.symptoms*') ? 'bg-[#B8860B]/10 text-[#B8860B]' : 'text-gray-700 hover:bg-gray-100' }}">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm0 18c-4.41 0-8-3.59-8-8s3.59-8 8-8 8 3.59 8 8-3.59 8-8 8zm3.5-9c.83 0 1.5-.67 1.5-1.5S16.33 8 15.5 8 14 8.67 14 9.5s.67 1.5 1.5 1.5zm-7 0c.83 0 1.5-.67 1.5-1.5S9.33 8 8.5 8 7 8.67 7 9.5 7.67 11 8.5 11zm3.5 6.5c2.33 0 4.31-1.46 5.11-3.5H6.89c.8 2.04 2.78 3.5 5.11 3.5z"></path>
                    </svg>
                    <span>Sintomas</span>
                </a>

                <!-- Allergies -->
                <a href="{{ route('admin.allergies') }}" class="flex items-center gap-3 px-4 py-3 rounded-lg text-sm font-medium transition-all {{ request()->routeIs('admin.allergies*') ? 'bg-[#B8860B]/10 text-[#B8860B]' : 'text-gray-700 hover:bg-gray-100' }}">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M2 9.5a5.5 5.5 0 0 1 9.591-3.676.56.56 0 0 0 .818 0A5.49 5.49 0 0 1 22 9.5c0 2.29-1.5 4-3 5.5l-5.492 5.313a2 2 0 0 1-3 .019L5 15c-1.5-1.5-3-3.2-3-5.5"></path>
                    </svg>
                    <span>Alergias</span>
                </a>
            </nav>

            <!-- Divider -->
            <div class="my-6 border-t border-gray-200"></div>

            <!-- User Info & Logout -->
            <div class="space-y-3">
                <div class="px-4 py-3 bg-gray-50 rounded-lg">
                    <p class="text-xs text-gray-600 uppercase tracking-widest">Administrador</p>
                    <p class="text-sm text-gray-900 truncate">{{ Auth::user()->name }} {{ Auth::user()->surname }}</p>
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

    <!-- Main Content -->
    <div class="flex-1 overflow-auto">
        @yield('admin-content')
    </div>
</div>
@endsection
