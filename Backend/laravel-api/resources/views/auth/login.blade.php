@extends('layouts.app')

@section('title', 'Login - QiFlow')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-gray-50 to-gray-100 py-12 px-4 flex items-center justify-center">
    <div class="w-full max-w-md">
        <!-- Logo and Header -->
        <div class="text-center mb-8">
            <div class="flex items-center justify-center gap-3 mb-4">
                <div class="relative flex h-10 w-10 items-center justify-center">
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
                <h1 class="text-2xl font-semibold text-[#B8860B]">QiFlow</h1>
            </div>
            <h2 class="text-3xl font-bold text-gray-900 mb-2">Bem-vindo de volta</h2>
            <p class="text-gray-600">Aceda à sua conta para continuar a sua transformação</p>
        </div>

        <!-- Login Card -->
        <div class="bg-white/70 backdrop-blur-sm rounded-xl shadow-lg border-0">
            <div class="px-6 pt-6">
                <h4 class="text-2xl mb-2">Entrar</h4>
                <p class="text-gray-600 text-sm">
                    Preencha os seus dados para aceder
                </p>
            </div>

            <div class="px-6 pb-6">
                @if ($errors->any())
                    <div class="mb-4 p-4 bg-red-50 border border-red-200 rounded-md">
                        <div class="flex items-center">
                            <div class="flex-shrink-0">
                                <svg class="h-5 w-5 text-red-400" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.28 7.22a.75.75 0 00-1.06 1.06L8.94 10l-1.72 1.72a.75.75 0 101.06 1.06L10 11.06l1.72 1.72a.75.75 0 101.06-1.06L11.06 10l1.72-1.72a.75.75 0 00-1.06-1.06L10 8.94 8.28 7.22z" clip-rule="evenodd" />
                                </svg>
                            </div>
                            <div class="ml-3">
                                <h3 class="text-sm font-medium text-red-800">Erro no login</h3>
                                <div class="mt-1 text-sm text-red-700">
                                    @foreach ($errors->all() as $error)
                                        <div>{{ $error }}</div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                @endif

                <form method="POST" action="{{ route('web.login.post') }}" class="space-y-6" novalidate>
                    @csrf

                    <!-- Email -->
                    <div class="space-y-2">
                        <label for="email" class="flex items-center gap-2 text-sm leading-none font-medium">Email *</label>
                        <input
                            id="email"
                            name="email"
                            type="email"
                            autocomplete="email"
                            class="flex h-10 w-full rounded-md border border-gray-300 px-3 py-2 text-base bg-white transition-all outline-none focus:border-[#B8860B] focus:ring-2 focus:ring-[#B8860B]/20 @error('email') border-red-500 border-2 @enderror"
                            placeholder="seu@email.com"
                            value="{{ old('email') }}"
                            required
                        />
                        @error('email')
                            <p class="text-xs text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Password -->
                    <div class="space-y-2">
                        <label for="password" class="flex items-center gap-2 text-sm leading-none font-medium">Password *</label>
                        <input
                            id="password"
                            name="password"
                            type="password"
                            autocomplete="current-password"
                            class="flex h-10 w-full rounded-md border border-gray-300 px-3 py-2 text-base bg-white transition-all outline-none focus:border-[#B8860B] focus:ring-2 focus:ring-[#B8860B]/20 @error('password') border-red-500 border-2 @enderror"
                            placeholder="••••••••"
                            required
                        />
                        @error('password')
                            <p class="text-xs text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Remember Me -->
                    <div class="flex items-center gap-3">
                        <input
                            id="remember"
                            name="remember"
                            type="checkbox"
                            class="size-4 shrink-0 rounded border border-gray-300 bg-white focus:ring-2 focus:ring-[#B8860B]/20 focus:border-[#B8860B]"
                        />
                        <label for="remember" class="text-sm leading-none font-medium select-none cursor-pointer">
                            Lembrar-me
                        </label>
                    </div>

                    <!-- Submit Button -->
                    <button
                        type="submit"
                        class="inline-flex items-center justify-center gap-2 whitespace-nowrap text-sm font-medium transition-all h-10 rounded-md px-6 w-full bg-[#B8860B] text-white hover:bg-[#B8860B]/90"
                    >
                        Entrar
                    </button>

                    <!-- Register Link -->
                    <p class="text-center text-sm text-gray-600">
                        Não tem conta?
                        <a href="{{ route('web.register') }}" class="text-[#B8860B] underline underline-offset-4 font-medium">
                            Registar-se aqui
                        </a>
                    </p>
                </form>
            </div>
        </div>

        <!-- Additional Info -->
        <div class="mt-8 text-center">
            <p class="text-sm text-gray-600">
                <a href="{{ route('home') }}" class="text-[#B8860B] underline underline-offset-4">
                    Voltar à página inicial
                </a>
            </p>
        </div>
    </div>
</div>
@endsection