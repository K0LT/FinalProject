@extends('layouts.app')

@section('content')
<div class="flex h-screen bg-gray-100">
    <!-- Sidebar -->
    <div class="w-64 bg-gray-900 text-white shadow-lg">
        <div class="p-6 border-b border-gray-800">
            <h1 class="text-2xl font-bold text-[#B8860B]">QiFlow Admin</h1>
        </div>

        <nav class="mt-6">
            <!-- Dashboard -->
            <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-3 px-6 py-3 {{ request()->routeIs('admin.dashboard') ? 'bg-gray-800 border-l-4 border-[#B8860B]' : 'hover:bg-gray-800' }} transition-colors">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path>
                    <polyline points="9 22 9 12 15 12 15 22"></polyline>
                </svg>
                <span>Dashboard</span>
            </a>

            <!-- Patients -->
            <a href="{{ route('admin.patients') }}" class="flex items-center gap-3 px-6 py-3 {{ request()->routeIs('admin.patients*') ? 'bg-gray-800 border-l-4 border-[#B8860B]' : 'hover:bg-gray-800' }} transition-colors">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"></path>
                    <circle cx="9" cy="7" r="4"></circle>
                    <path d="M22 16v-2a4 4 0 0 0-2.5-3.74"></path>
                    <path d="M14 14h8v2h-8z"></path>
                </svg>
                <span>Pacientes</span>
            </a>

            <!-- Exercises -->
            <a href="{{ route('admin.exercises') }}" class="flex items-center gap-3 px-6 py-3 {{ request()->routeIs('admin.exercises*') ? 'bg-gray-800 border-l-4 border-[#B8860B]' : 'hover:bg-gray-800' }} transition-colors">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M6 4h12v16H6z"></path>
                    <path d="M10 9h4"></path>
                    <path d="M10 13h4"></path>
                    <path d="M10 17h4"></path>
                </svg>
                <span>Exercícios</span>
            </a>

            <!-- Appointments -->
            <a href="{{ route('admin.appointments') }}" class="flex items-center gap-3 px-6 py-3 {{ request()->routeIs('admin.appointments*') ? 'bg-gray-800 border-l-4 border-[#B8860B]' : 'hover:bg-gray-800' }} transition-colors">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M8 2v4m8-4v4M3 10h18v10a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V10z"></path>
                </svg>
                <span>Consultas</span>
            </a>

            <!-- Conditions -->
            <a href="{{ route('admin.conditions') }}" class="flex items-center gap-3 px-6 py-3 {{ request()->routeIs('admin.conditions*') ? 'bg-gray-800 border-l-4 border-[#B8860B]' : 'hover:bg-gray-800' }} transition-colors">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm1 15h-2v-2h2v2zm0-4h-2V7h2v6z"></path>
                </svg>
                <span>Condições</span>
            </a>

            <!-- Symptoms -->
            <a href="{{ route('admin.symptoms') }}" class="flex items-center gap-3 px-6 py-3 {{ request()->routeIs('admin.symptoms*') ? 'bg-gray-800 border-l-4 border-[#B8860B]' : 'hover:bg-gray-800' }} transition-colors">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm0 18c-4.41 0-8-3.59-8-8s3.59-8 8-8 8 3.59 8 8-3.59 8-8 8zm3.5-9c.83 0 1.5-.67 1.5-1.5S16.33 8 15.5 8 14 8.67 14 9.5s.67 1.5 1.5 1.5zm-7 0c.83 0 1.5-.67 1.5-1.5S9.33 8 8.5 8 7 8.67 7 9.5 7.67 11 8.5 11zm3.5 6.5c2.33 0 4.31-1.46 5.11-3.5H6.89c.8 2.04 2.78 3.5 5.11 3.5z"></path>
                </svg>
                <span>Sintomas</span>
            </a>

            <!-- Allergies -->
            <a href="{{ route('admin.allergies') }}" class="flex items-center gap-3 px-6 py-3 {{ request()->routeIs('admin.allergies*') ? 'bg-gray-800 border-l-4 border-[#B8860B]' : 'hover:bg-gray-800' }} transition-colors">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M2 9.5a5.5 5.5 0 0 1 9.591-3.676.56.56 0 0 0 .818 0A5.49 5.49 0 0 1 22 9.5c0 2.29-1.5 4-3 5.5l-5.492 5.313a2 2 0 0 1-3 .019L5 15c-1.5-1.5-3-3.2-3-5.5"></path>
                </svg>
                <span>Alergias</span>
            </a>

            <!-- Divider -->
            <div class="my-6 border-t border-gray-800"></div>

            <!-- Logout -->
            <form method="POST" action="{{ route('web.logout') }}" class="px-6">
                @csrf
                <button type="submit" class="flex items-center gap-3 w-full px-0 py-3 text-red-400 hover:text-red-300 transition-colors">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"></path>
                        <polyline points="16 17 21 12 16 7"></polyline>
                        <line x1="21" y1="12" x2="9" y2="12"></line>
                    </svg>
                    <span>Sair</span>
                </button>
            </form>
        </nav>
    </div>

    <!-- Main Content -->
    <div class="flex-1 overflow-auto">
        @yield('admin-content')
    </div>
</div>
@endsection
