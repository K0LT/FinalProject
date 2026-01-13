@extends('layouts.app')

@section('title', 'Registar - QiFlow')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-gray-50 to-gray-100 py-12 px-4">
    <div class="max-w-7xl mx-auto">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-12">
            <!-- Left Column: Registration Form -->
            <div class="space-y-8">
                <!-- Intro -->
                <div class="text-center lg:text-left">
                    <h2 class="text-4xl text-[#B8860B] mb-4">Comece a sua Transformação</h2>
                    <p class="text-xl text-gray-600">
                        Preencha os seus dados para criarmos o seu perfil personalizado
                    </p>
                </div>

                <!-- Registration Form Card -->
                <div class="bg-white/70 backdrop-blur-sm rounded-xl shadow-lg border-0">
                    <div class="px-6 pt-6">
                        <h4 class="text-2xl mb-2">Criar Conta</h4>
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
                                        <h3 class="text-sm font-medium text-red-800">Erro</h3>
                                        <div class="mt-1 text-sm text-red-700">
                                            @foreach ($errors->all() as $error)
                                                <div>{{ $error }}</div>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif

                        <form method="POST" action="{{ route('web.register.post') }}" class="space-y-6" novalidate>
                            @csrf

                            <!-- Personal Information Section -->
                            <div class="space-y-4">
                                <h3 class="text-lg font-semibold">Informações Pessoais</h3>

                                <!-- Name -->
                                <div class="space-y-2">
                                    <label for="name" class="flex items-center gap-2 text-sm leading-none font-medium">Nome *</label>
                                    <input
                                        id="name"
                                        name="name"
                                        type="text"
                                        autocomplete="given-name"
                                        class="flex h-9 w-full rounded-md border border-gray-300 px-3 py-1 text-base bg-white transition-all outline-none focus:border-[#B8860B] focus:ring-2 focus:ring-[#B8860B]/20 @error('name') border-red-500 border-2 @enderror"
                                        placeholder="Seu nome"
                                        value="{{ old('name') }}"
                                        required
                                    />
                                    @error('name')
                                        <p class="text-xs text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>

                                <!-- Surname -->
                                <div class="space-y-2">
                                    <label for="surname" class="flex items-center gap-2 text-sm leading-none font-medium">Sobrenome *</label>
                                    <input
                                        id="surname"
                                        name="surname"
                                        type="text"
                                        autocomplete="family-name"
                                        class="flex h-9 w-full rounded-md border border-gray-300 px-3 py-1 text-base bg-white transition-all outline-none focus:border-[#B8860B] focus:ring-2 focus:ring-[#B8860B]/20 @error('surname') border-red-500 border-2 @enderror"
                                        placeholder="Seu sobrenome"
                                        value="{{ old('surname') }}"
                                        required
                                    />
                                    @error('surname')
                                        <p class="text-xs text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>

                                <!-- Email and Phone -->
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                    <div class="space-y-2">
                                        <label for="email" class="flex items-center gap-2 text-sm leading-none font-medium">Email *</label>
                                        <input
                                            id="email"
                                            name="email"
                                            type="email"
                                            autocomplete="email"
                                            class="flex h-9 w-full rounded-md border border-gray-300 px-3 py-1 text-base bg-white transition-all outline-none focus:border-[#B8860B] focus:ring-2 focus:ring-[#B8860B]/20 @error('email') border-red-500 border-2 @enderror"
                                            placeholder="seu@email.com"
                                            value="{{ old('email') }}"
                                            required
                                        />
                                        @error('email')
                                            <p class="text-xs text-red-600">{{ $message }}</p>
                                        @enderror
                                    </div>

                                    <div class="space-y-2">
                                        <label for="phone_number" class="flex items-center gap-2 text-sm leading-none font-medium">Telefone *</label>
                                        <input
                                            id="phone_number"
                                            name="phone_number"
                                            type="tel"
                                            autocomplete="tel"
                                            class="flex h-9 w-full rounded-md border border-gray-300 px-3 py-1 text-base bg-white transition-all outline-none focus:border-[#B8860B] focus:ring-2 focus:ring-[#B8860B]/20 @error('phone_number') border-red-500 border-2 @enderror"
                                            placeholder="+351 912 345 678"
                                            value="{{ old('phone_number') }}"
                                            required
                                        />
                                        @error('phone_number')
                                            <p class="text-xs text-red-600">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>

                                <!-- Password -->
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                    <div class="space-y-2">
                                        <label for="password" class="flex items-center gap-2 text-sm leading-none font-medium">Password *</label>
                                        <input
                                            id="password"
                                            name="password"
                                            type="password"
                                            autocomplete="new-password"
                                            class="flex h-9 w-full rounded-md border border-gray-300 px-3 py-1 text-base bg-white transition-all outline-none focus:border-[#B8860B] focus:ring-2 focus:ring-[#B8860B]/20 @error('password') border-red-500 border-2 @enderror"
                                            placeholder="Sua password"
                                            required
                                        />
                                        @error('password')
                                            <p class="text-xs text-red-600">{{ $message }}</p>
                                        @enderror
                                        <p class="text-xs text-gray-500 mt-1">
                                            Mínimo 6 caracteres
                                        </p>
                                    </div>

                                    <div class="space-y-2">
                                        <label for="password_confirmation" class="flex items-center gap-2 text-sm leading-none font-medium">Confirmar Password *</label>
                                        <input
                                            id="password_confirmation"
                                            name="password_confirmation"
                                            type="password"
                                            autocomplete="new-password"
                                            class="flex h-9 w-full rounded-md border border-gray-300 px-3 py-1 text-base bg-white transition-all outline-none focus:border-[#B8860B] focus:ring-2 focus:ring-[#B8860B]/20"
                                            placeholder="Repita a password"
                                            required
                                        />
                                    </div>
                                </div>

                                <!-- Age and Gender -->
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                    <div class="space-y-2">
                                        <label for="age" class="flex items-center gap-2 text-sm leading-none font-medium">Idade</label>
                                        <input
                                            id="age"
                                            name="age"
                                            type="number"
                                            class="flex h-9 w-full rounded-md border border-gray-300 px-3 py-1 text-base bg-white transition-all outline-none focus:border-[#B8860B] focus:ring-2 focus:ring-[#B8860B]/20"
                                            placeholder="35"
                                            value="{{ old('age') }}"
                                        />
                                    </div>

                                    <div class="space-y-2">
                                        <label for="gender" class="flex items-center gap-2 text-sm leading-none font-medium">Género</label>
                                        <select
                                            id="gender"
                                            name="gender"
                                            class="flex w-full items-center justify-between gap-2 rounded-md border border-gray-300 bg-white px-3 py-2 text-sm transition-all outline-none focus:border-[#B8860B] focus:ring-2 focus:ring-[#B8860B]/20 h-9"
                                        >
                                            <option value="">Selecionar</option>
                                            <option value="female" @selected(old('gender') === 'female')>Feminino</option>
                                            <option value="male" @selected(old('gender') === 'male')>Masculino</option>
                                            <option value="other" @selected(old('gender') === 'other')>Outro</option>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <!-- Health Information Section -->
                            <div class="space-y-4">
                                <h3 class="text-lg font-semibold">Informações de Saúde</h3>

                                <!-- Weight and Height -->
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                    <div class="space-y-2">
                                        <label for="weight" class="flex items-center gap-2 text-sm leading-none font-medium">Peso Atual (kg)</label>
                                        <input
                                            id="weight"
                                            name="weight"
                                            type="number"
                                            step="0.1"
                                            class="flex h-9 w-full rounded-md border border-gray-300 px-3 py-1 text-base bg-white transition-all outline-none focus:border-[#B8860B] focus:ring-2 focus:ring-[#B8860B]/20"
                                            placeholder="70"
                                            value="{{ old('weight') }}"
                                        />
                                    </div>

                                    <div class="space-y-2">
                                        <label for="height" class="flex items-center gap-2 text-sm leading-none font-medium">Altura (cm)</label>
                                        <input
                                            id="height"
                                            name="height"
                                            type="number"
                                            class="flex h-9 w-full rounded-md border border-gray-300 px-3 py-1 text-base bg-white transition-all outline-none focus:border-[#B8860B] focus:ring-2 focus:ring-[#B8860B]/20"
                                            placeholder="170"
                                            value="{{ old('height') }}"
                                        />
                                    </div>
                                </div>

                                <!-- Goals -->
                                <div class="space-y-2">
                                    <label for="goals" class="flex items-center gap-2 text-sm leading-none font-medium">Objetivos de Saúde</label>
                                    <select
                                        id="goals"
                                        name="goals"
                                        class="flex w-full items-center justify-between gap-2 rounded-md border border-gray-300 bg-white px-3 py-2 text-sm transition-all outline-none focus:border-[#B8860B] focus:ring-2 focus:ring-[#B8860B]/20 h-9"
                                    >
                                        <option value="">Qual é o seu principal objetivo?</option>
                                        <option value="weight-loss" @selected(old('goals') === 'weight-loss')>Perda de Peso</option>
                                        <option value="maintenance" @selected(old('goals') === 'maintenance')>Manutenção de Peso</option>
                                        <option value="wellness" @selected(old('goals') === 'wellness')>Bem-estar Geral</option>
                                        <option value="pain-management" @selected(old('goals') === 'pain-management')>Gestão da Dor</option>
                                        <option value="stress-relief" @selected(old('goals') === 'stress-relief')>Alívio do Stress</option>
                                        <option value="sleep-improvement" @selected(old('goals') === 'sleep-improvement')>Melhoria do Sono</option>
                                    </select>
                                </div>
                            </div>

                            <!-- Terms and Conditions -->
                            <div class="space-y-4">
                                <div class="flex items-start gap-3">
                                    <input
                                        id="terms"
                                        name="terms"
                                        type="checkbox"
                                        class="size-4 shrink-0 rounded border border-gray-300 bg-white focus:ring-2 focus:ring-[#B8860B]/20 focus:border-[#B8860B] mt-1 @error('terms') border-red-500 @enderror"
                                        @checked(old('terms'))
                                        required
                                    />
                                    <div class="text-sm leading-relaxed">
                                        <label for="terms" class="flex items-center gap-2 text-sm leading-relaxed font-medium select-none cursor-pointer">
                                            Aceito os
                                            <a href="#" class="text-[#B8860B] underline underline-offset-4">
                                                Termos e Condições
                                            </a>
                                            e a
                                            <a href="#" class="text-[#B8860B] underline underline-offset-4">
                                                Política de Privacidade
                                            </a>.
                                        </label>

                                        @error('terms')
                                            <p class="text-xs text-red-600 mt-1">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <!-- Submit Button -->
                            <button
                                type="submit"
                                class="inline-flex items-center justify-center gap-2 whitespace-nowrap text-sm font-medium transition-all h-10 rounded-md px-6 w-full bg-green-600 text-white hover:bg-green-700"
                            >
                                Criar Conta e Agendar Consulta Gratuita
                            </button>

                            <!-- Login Link -->
                            <p class="text-center text-sm text-gray-600">
                                Já tem conta?
                                <a href="{{ route('web.login') }}" class="text-[#B8860B] underline underline-offset-4">
                                    Entrar aqui
                                </a>
                            </p>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Right Column: Benefits, Testimonials, Help -->
            <div class="space-y-8">
                <!-- Benefits Card -->
                <div class="flex flex-col gap-6 rounded-xl border-0 bg-gradient-to-r from-[#B8860B] to-red-600 text-white p-8">
                    <h3 class="text-2xl">O que está incluído</h3>
                    <div class="space-y-4">
                        <div class="flex items-center gap-3">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="text-green-300 flex-shrink-0">
                                <path d="M21.801 10A10 10 0 1 1 17 3.335"></path>
                                <path d="m9 11 3 3L22 4"></path>
                            </svg>
                            <span class="text-sm">Acesso completo à plataforma QiFlow</span>
                        </div>
                        <div class="flex items-center gap-3">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="text-green-300 flex-shrink-0">
                                <path d="M21.801 10A10 10 0 1 1 17 3.335"></path>
                                <path d="m9 11 3 3L22 4"></path>
                            </svg>
                            <span class="text-sm">Acompanhamento personalizado</span>
                        </div>
                        <div class="flex items-center gap-3">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="text-green-300 flex-shrink-0">
                                <path d="M21.801 10A10 10 0 1 1 17 3.335"></path>
                                <path d="m9 11 3 3L22 4"></path>
                            </svg>
                            <span class="text-sm">Relatórios de progresso detalhados</span>
                        </div>
                        <div class="flex items-center gap-3">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="text-green-300 flex-shrink-0">
                                <path d="M21.801 10A10 10 0 1 1 17 3.335"></path>
                                <path d="m9 11 3 3L22 4"></path>
                            </svg>
                            <span class="text-sm">Suporte via WhatsApp</span>
                        </div>
                        <div class="flex items-center gap-3">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="text-green-300 flex-shrink-0">
                                <path d="M21.801 10A10 10 0 1 1 17 3.335"></path>
                                <path d="m9 11 3 3L22 4"></path>
                            </svg>
                            <span class="text-sm">Consulta de avaliação gratuita</span>
                        </div>
                        <div class="flex items-center gap-3">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="text-green-300 flex-shrink-0">
                                <path d="M21.801 10A10 10 0 1 1 17 3.335"></path>
                                <path d="m9 11 3 3L22 4"></path>
                            </svg>
                            <span class="text-sm">Planos de exercício personalizados</span>
                        </div>
                    </div>
                </div>

                <!-- Testimonial Card -->
                <div class="bg-white/70 backdrop-blur-sm rounded-xl border-0 p-6">
                    <h3 class="text-lg mb-4 font-semibold">Resultado Real</h3>
                    <div class="space-y-4">
                        <div class="flex items-center gap-1 mb-2">
                            @for($i = 0; $i < 5; $i++)
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="currentColor" class="text-yellow-400">
                                    <path d="M11.525 2.295a.53.53 0 0 1 .95 0l2.31 4.679a2.123 2.123 0 0 0 1.595 1.16l5.166.756a.53.53 0 0 1 .294.904l-3.736 3.638a2 2 0 0 0-.611 1.878l.882 5.14a.53.53 0 0 1-.771.56l-4.618-2.428a2.122 2.122 0 0 0-1.973 0L6.396 21.01a.53.53 0 0 1-.77-.56l.881-5.139a2.122 2.122 0 0 0-.611-1.879L2.16 9.795a.53.53 0 0 1 .294-.906l5.165-.755a2.122 2.122 0 0 0 1.597-1.16z"></path>
                                </svg>
                            @endfor
                        </div>
                        <p class="text-sm italic">"Em 4 meses perdi 15kg e melhorei completamente a minha qualidade de vida. O Dr. José é excepcional!"</p>
                        <div class="flex items-center gap-3">
                            <div class="w-10 h-10 bg-[#B8860B]/10 rounded-full flex items-center justify-center">
                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="text-[#B8860B]">
                                    <path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"></path>
                                    <circle cx="9" cy="7" r="4"></circle>
                                </svg>
                            </div>
                            <div>
                                <p class="text-sm font-medium">Maria Santos</p>
                                <p class="text-xs text-gray-600">Paciente desde 2023</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Help Card -->
                <div class="space-y-4">
                    <div class="flex items-center gap-3 p-4 bg-green-50 rounded-lg border border-green-200">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="text-green-600">
                            <path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"></path>
                        </svg>
                        <div>
                            <p class="text-sm font-medium text-green-800">Dados 100% seguros</p>
                            <p class="text-xs text-green-600">Conformidade RGPD garantida</p>
                        </div>
                    </div>

                    <div class="bg-white/70 backdrop-blur-sm rounded-xl border-0 p-6">
                        <h3 class="text-lg mb-4 font-semibold">Precisa de Ajuda?</h3>
                        <div class="space-y-3">
                            <div class="flex items-center gap-3">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="text-[#B8860B]">
                                    <path d="M13.832 16.568a1 1 0 0 0 1.213-.303l.355-.465A2 2 0 0 1 17 15h3a2 2 0 0 1 2 2v3a2 2 0 0 1-2 2A18 18 0 0 1 2 4a2 2 0 0 1 2-2h3a2 2 0 0 1 2 2v3a2 2 0 0 1-.8 1.6l-.468.351a1 1 0 0 0-.292 1.233 14 14 0 0 0 6.392 6.384"></path>
                                </svg>
                                <div>
                                    <p class="text-sm font-medium">+351 912 345 678</p>
                                    <p class="text-xs text-gray-600">Segunda a Sexta: 9h-19h</p>
                                </div>
                            </div>
                            <div class="flex items-center gap-3">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="text-[#B8860B]">
                                    <path d="m22 7-8.991 5.727a2 2 0 0 1-2.009 0L2 7"></path>
                                    <rect x="2" y="4" width="20" height="16" rx="2"></rect>
                                </svg>
                                <div>
                                    <p class="text-sm font-medium">jose@qiflow.pt</p>
                                    <p class="text-xs text-gray-600">Resposta em 24h</p>
                                </div>
                            </div>
                            <div class="flex items-center gap-3">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="text-[#B8860B]">
                                    <path d="M20 10c0 7-3 9-8 9s-8-2-8-9a4 4 0 0 1 8-8c.5 0 1 .005 1.5 .005"></path>
                                    <path d="M12 17v4"></path>
                                    <path d="M9 20h6"></path>
                                </svg>
                                <div>
                                    <p class="text-sm font-medium">Rua do Bem-Estar, 123</p>
                                    <p class="text-xs text-gray-600">1200-001 Lisboa</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
