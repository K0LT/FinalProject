@extends('layouts.app')

@section('title', 'Client Dashboard - QiFlow')

@section('content')
<div class="min-h-screen bg-gray-50">
    <!-- Topbar -->
    <header class="h-16 bg-white border-b border-gray-200 flex items-center px-4 sm:px-6 justify-between sticky top-0 z-40">
        <div class="flex items-center gap-3">
            <div class="hidden sm:flex items-center gap-2 text-sm text-gray-600">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M8 2v4" />
                    <path d="M16 2v4" />
                    <rect width="18" height="18" x="3" y="4" rx="2" />
                    <path d="M3 10h18" />
                </svg>
                <span class="capitalize">{{ now()->format('l, d F Y') }}</span>
            </div>
        </div>

        <div class="flex items-center gap-3">
            <div class="text-right hidden sm:block">
                <div class="text-sm font-medium text-gray-900">{{ Auth::user()->name }}</div>
            </div>
                                              <form method="POST" action="{{ route('web.logout') }}" class="inline">
                @csrf
                <button type="submit" class="text-sm text-red-600 hover:text-red-700 font-medium">
                    Sair
                </button>
            </form>
        </div>
    </header>

    <div class="flex">
        <!-- Sidebar -->
        <aside class="hidden lg:block w-72 bg-white border-r border-gray-200 h-[calc(100vh-64px)] overflow-y-auto">
            <div class="p-4 space-y-6">
                <!-- Brand -->
                <div class="px-2">
                    <div class="flex items-center gap-2 mb-1">
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
                            <h3 class="font-semibold text-[#B8860B]">QiFlow</h3>
                            <p class="text-xs text-gray-600">Portal do Paciente</p>
                        </div>
                    </div>
                </div>

                <!-- Menu -->
                <nav class="space-y-4">
                    <div class="space-y-2">
                        <p class="px-2 text-xs font-semibold text-gray-500 uppercase tracking-widest">Geral</p>
                        <div class="space-y-1">
                            <a href="#" class="flex items-center gap-3 px-3 py-2 rounded-lg text-sm hover:bg-gray-100 transition-all">
                                <span class="flex items-center justify-center w-8 h-8 rounded-lg border border-gray-200 bg-white">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"></path>
                                        <circle cx="9" cy="7" r="4"></circle>
                                    </svg>
                                </span>
                                <span>Perfil do Cliente</span>
                            </a>
                            <a href="#" class="flex items-center gap-3 px-3 py-2 rounded-lg text-sm bg-[#B8860B]/10 text-[#B8860B] font-medium transition-all">
                                <span class="flex items-center justify-center w-8 h-8 rounded-lg border border-gray-200 bg-white text-[#B8860B]">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <path d="M8 2v4" />
                                        <path d="M16 2v4" />
                                        <rect width="18" height="18" x="3" y="4" rx="2" />
                                        <path d="M3 10h18" />
                                    </svg>
                                </span>
                                <span>Consultas</span>
                            </a>
                        </div>
                    </div>
                </nav>
            </div>
        </aside>

        <!-- Main Content -->
        <main class="flex-1 overflow-y-auto">
            <div class="max-w-7xl mx-auto p-4 sm:p-6 lg:p-8 space-y-6 lg:space-y-8 pb-8">
                <!-- Welcome Section -->
                <section class="rounded-2xl border border-gray-200 bg-gradient-to-r from-gray-50 via-white to-gray-50 px-5 py-6 sm:px-8 sm:py-8 shadow-sm">
                    <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-6">
                        <div>
                            <p class="text-xs font-semibold uppercase tracking-widest text-gray-600 mb-2">Portal do Paciente</p>
                            <h1 class="text-2xl sm:text-3xl font-bold tracking-tight text-gray-900 mb-2">
                                Olá, {{ Auth::user()->name }}
                            </h1>
                            <p class="text-sm sm:text-base text-gray-600 max-w-xl leading-relaxed">
                                Bem-vindo(a) ao seu espaço pessoal. Aqui pode acompanhar o seu progresso e consultas.
                            </p>
                        </div>

                        <div class="w-full lg:w-auto">
                            <div class="rounded-xl border border-gray-200 bg-white px-4 py-3 shadow-sm flex items-center justify-between gap-3">
                                <div class="flex items-center gap-3">
                                    <span class="inline-flex items-center justify-center rounded-lg bg-[#B8860B]/10 text-[#B8860B] p-2">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                            <path d="M8 2v4" />
                                            <path d="M16 2v4" />
                                            <rect width="18" height="18" x="3" y="4" rx="2" />
                                            <path d="M3 10h18" />
                                        </svg>
                                    </span>
                                    <div class="space-y-0.5">
                                        <p class="text-xs font-medium text-gray-600 uppercase tracking-widest">Próxima consulta</p>
                                        <p class="text-sm font-semibold text-gray-900">
                                            @if($patient && $patient->next_appointment_date)
                                                {{ \Carbon\Carbon::parse($patient->next_appointment_date)->diffForHumans() }}
                                            @else
                                                A agendar
                                            @endif
                                        </p>
                                    </div>
                                </div>
                                <button class="inline-flex items-center gap-1.5 text-xs font-medium text-[#B8860B] hover:underline">
                                    Ver detalhes
                                    <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <polyline points="9 18 15 12 9 6"></polyline>
                                    </svg>
                                </button>
                            </div>
                        </div>
                    </div>
                </section>

                <!-- Stats Grid -->
                <section class="grid grid-cols-1 lg:grid-cols-[2fr_1fr] gap-6">
                    <!-- Consultas Card -->
                    <div class="rounded-2xl border border-gray-200 bg-white shadow-sm p-5 sm:p-6 h-full flex flex-col">
                        <div class="flex flex-wrap items-center justify-between gap-3 mb-6">
                            <h2 class="text-sm sm:text-base font-semibold text-gray-900 flex items-center gap-2.5">
                                <span class="inline-flex items-center justify-center p-2 rounded-lg bg-[#B8860B]/5 text-[#B8860B]">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <path d="M8 2v4" />
                                        <path d="M16 2v4" />
                                        <rect width="18" height="18" x="3" y="4" rx="2" />
                                        <path d="M3 10h18" />
                                    </svg>
                                </span>
                                Minhas Consultas
                            </h2>
                            <button class="inline-flex items-center gap-1 text-xs font-medium text-[#B8860B] hover:underline">
                                Ver todas
                                <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <polyline points="9 18 15 12 9 6"></polyline>
                                </svg>
                            </button>
                        </div>

                        @if($appointments && count($appointments) > 0)
                            <div class="space-y-3">
                                @foreach($appointments->slice(0, 3) as $appointment)
                                    <div class="p-4 rounded-lg border border-gray-100 hover:border-[#B8860B]/30 transition-all">
                                        <div class="flex items-start justify-between gap-3">
                                            <div class="flex-1 min-w-0">
                                                <p class="text-sm font-semibold text-gray-900">{{ $appointment->doctor_name ?? 'Consulta' }}</p>
                                                <p class="text-xs text-gray-600 mt-1">{{ \Carbon\Carbon::parse($appointment->appointment_date_time ?? $appointment->appointment_date)->format('l, d F Y H:i') }}</p>
                                                <p class="text-xs text-gray-500 mt-0.5">{{ $appointment->notes ?? 'Sem notas' }}</p>
                                            </div>
                                            @php
                                                $statusClass = match($appointment->status) {
                                                    'Concluída', 'completed' => 'bg-emerald-50 text-emerald-700',
                                                    'Confirmada', 'Confirmado', 'scheduled' => 'bg-blue-50 text-blue-700',
                                                    'Cancelada', 'Cancelado', 'cancelled' => 'bg-red-50 text-red-700',
                                                    default => 'bg-gray-50 text-gray-700'
                                                };
                                                $statusLabel = match($appointment->status) {
                                                    'Concluída', 'completed' => 'Concluída',
                                                    'Confirmada', 'Confirmado', 'scheduled' => 'Confirmada',
                                                    'Cancelada', 'Cancelado', 'cancelled' => 'Cancelada',
                                                    default => $appointment->status
                                                };
                                            @endphp
                                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium {{ $statusClass }}">
                                                {{ $statusLabel }}
                                            </span>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @else
                            <div class="text-center py-12">
                                <svg xmlns="http://www.w3.org/2000/svg" width="48" height="48" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="text-gray-300 mx-auto mb-3">
                                    <path d="M8 2v4" />
                                    <path d="M16 2v4" />
                                    <rect width="18" height="18" x="3" y="4" rx="2" />
                                    <path d="M3 10h18" />
                                </svg>
                                <p class="text-gray-600">Nenhuma consulta agendada</p>
                            </div>
                        @endif
                    </div>

                    <!-- Stats Cards -->
                    <div class="grid grid-rows-4 gap-4">
                        <!-- Próxima Consulta -->
                        <div class="rounded-xl border border-gray-200 bg-white p-4 shadow-sm hover:shadow-md transition-all">
                            <div class="flex items-start justify-between gap-3">
                                <div class="flex-1 min-w-0">
                                    <p class="text-xs font-semibold mb-1 text-gray-600 uppercase tracking-widest">Próxima Consulta</p>
                                    @php
                                        $nextAppointment = $appointments ? $appointments->filter(fn($a) => \Carbon\Carbon::parse($a->appointment_date_time ?? $a->appointment_date) > now())->first() : null;
                                        $daysUntil = $nextAppointment ? ceil((\Carbon\Carbon::parse($nextAppointment->appointment_date_time ?? $nextAppointment->appointment_date)->diffInDays(now()))) : null;
                                    @endphp
                                    <p class="text-2xl font-bold text-gray-900 mb-0.5">{{ $daysUntil ? $daysUntil . ' dias' : '---' }}</p>
                                    <p class="text-xs text-gray-600">{{ $daysUntil ? 'Até à próxima consulta' : 'Sem consultas agendadas' }}</p>
                                </div>
                                <div class="inline-flex items-center justify-center p-2 rounded-lg bg-[#B8860B]/10 text-[#B8860B]">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <path d="M8 2v4" />
                                        <path d="M16 2v4" />
                                        <rect width="18" height="18" x="3" y="4" rx="2" />
                                        <path d="M3 10h18" />
                                    </svg>
                                </div>
                            </div>
                        </div>

                        <!-- Sessões Realizadas -->
                        <div class="rounded-xl border border-gray-200 bg-white p-4 shadow-sm hover:shadow-md transition-all">
                            <div class="flex items-start justify-between gap-3">
                                <div class="flex-1 min-w-0">
                                    <p class="text-xs font-semibold mb-1 text-gray-600 uppercase tracking-widest">Sessões Realizadas</p>
                                    @php
                                        $completedCount = $appointments ? $appointments->filter(fn($a) => \Carbon\Carbon::parse($a->appointment_date_time ?? $a->appointment_date)->year === now()->year && \Carbon\Carbon::parse($a->appointment_date_time ?? $a->appointment_date) <= now() && in_array($a->status, ['Concluída', 'completed']))->count() : 0;
                                    @endphp
                                    <p class="text-2xl font-bold text-gray-900 mb-0.5">{{ $completedCount }}</p>
                                    <p class="text-xs text-gray-600">Este ano</p>
                                </div>
                                <div class="inline-flex items-center justify-center p-2 rounded-lg bg-emerald-50 text-emerald-600">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path>
                                        <polyline points="22 4 12 14.01 9 11.01"></polyline>
                                    </svg>
                                </div>
                            </div>
                        </div>

                        <!-- Progresso Geral -->
                        <div class="rounded-xl border border-gray-200 bg-white p-4 shadow-sm hover:shadow-md transition-all">
                            <div class="flex items-start justify-between gap-3">
                                <div class="flex-1 min-w-0">
                                    <p class="text-xs font-semibold mb-1 text-gray-600 uppercase tracking-widest">Progresso Geral</p>
                                    @php
                                        $totalProgress = 0;
                                        if($treatmentGoals && count($treatmentGoals) > 0) {
                                            foreach($treatmentGoals as $goal) {
                                                if($goal->goal_milestones && count($goal->goal_milestones) > 0) {
                                                    $completed = $goal->goal_milestones->filter(fn($m) => in_array($m->status, ['completed', 'Concluído']))->count();
                                                    $progress = ($completed / count($goal->goal_milestones)) * 100;
                                                    $totalProgress += $progress;
                                                }
                                            }
                                            $totalProgress = count($treatmentGoals) > 0 ? round($totalProgress / count($treatmentGoals)) : 0;
                                        }
                                    @endphp
                                    <p class="text-2xl font-bold text-gray-900 mb-0.5">{{ $totalProgress }}%</p>
                                    <p class="text-xs text-gray-600">Objetivos atingidos</p>
                                </div>
                                <div class="inline-flex items-center justify-center p-2 rounded-lg bg-blue-50 text-blue-600">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <circle cx="12" cy="12" r="10"></circle>
                                        <circle cx="12" cy="12" r="6"></circle>
                                        <circle cx="12" cy="12" r="2"></circle>
                                    </svg>
                                </div>
                            </div>
                        </div>

                        <!-- Objetivos Ativos -->
                        <div class="rounded-xl border border-gray-200 bg-white p-4 shadow-sm hover:shadow-md transition-all">
                            <div class="flex items-start justify-between gap-3">
                                <div class="flex-1 min-w-0">
                                    <p class="text-xs font-semibold mb-1 text-gray-600 uppercase tracking-widest">Objetivos Ativos</p>
                                    @php
                                        $activeGoalsCount = $treatmentGoals ? $treatmentGoals->filter(fn($g) => in_array($g->status, ['active', 'Ativo']))->count() : 0;
                                    @endphp
                                    <p class="text-2xl font-bold text-gray-900 mb-0.5">{{ $activeGoalsCount }}</p>
                                    <p class="text-xs text-gray-600">Em acompanhamento</p>
                                </div>
                                <div class="inline-flex items-center justify-center p-2 rounded-lg bg-purple-50 text-purple-600">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <polyline points="22 12 18 12 15 21 9 3 6 12 2 12"></polyline>
                                    </svg>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>

                <!-- Progress and Recommendations -->
                <section class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                    <!-- Progresso -->
                    <div class="rounded-2xl border border-gray-200 bg-white shadow-sm p-5 sm:p-6 space-y-5">
                        <h2 class="text-lg sm:text-xl font-semibold text-gray-900 flex items-center gap-2.5">
                            <span class="inline-flex items-center justify-center p-2 rounded-lg bg-[#B8860B]/5 text-[#B8860B]">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <circle cx="12" cy="12" r="10"></circle>
                                    <circle cx="12" cy="12" r="6"></circle>
                                    <circle cx="12" cy="12" r="2"></circle>
                                </svg>
                            </span>
                            Meu Progresso
                        </h2>

                        @if($treatmentGoals && count($treatmentGoals) > 0)
                            <div class="space-y-3">
                                @foreach($treatmentGoals as $goal)
                                    @php
                                        $progress = 0;
                                        if($goal->goal_milestones && count($goal->goal_milestones) > 0) {
                                            $completed = $goal->goal_milestones->filter(fn($m) => in_array($m->status, ['completed', 'Concluído']))->count();
                                            $progress = round(($completed / count($goal->goal_milestones)) * 100);
                                        }
                                    @endphp
                                    <div class="p-4 rounded-lg border border-gray-100 hover:border-[#B8860B]/30 transition-all">
                                        <div class="flex items-start justify-between gap-3 mb-2">
                                            <p class="text-sm font-semibold text-gray-900">{{ $goal->goal_name }}</p>
                                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-50 text-blue-700">{{ $goal->status ?? 'Ativo' }}</span>
                                        </div>
                                        <p class="text-xs text-gray-600">{{ $goal->description ?? 'Sem descrição' }}</p>
                                        <div class="mt-3 w-full bg-gray-200 rounded-full h-2">
                                            <div class="bg-[#B8860B] h-2 rounded-full transition-all" style="width: {{ $progress }}%"></div>
                                        </div>
                                        <p class="text-xs text-gray-500 mt-1">{{ $progress }}% concluído</p>
                                    </div>
                                @endforeach
                            </div>
                        @else
                            <div class="text-center py-8">
                                <svg xmlns="http://www.w3.org/2000/svg" width="48" height="48" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="text-gray-300 mx-auto mb-3">
                                    <circle cx="12" cy="12" r="10"></circle>
                                    <circle cx="12" cy="12" r="6"></circle>
                                    <circle cx="12" cy="12" r="2"></circle>
                                </svg>
                                <p class="text-gray-600">Nenhum objetivo definido</p>
                            </div>
                        @endif
                    </div>

                    <!-- Recomendações -->
                    <div class="rounded-2xl border border-gray-200 bg-white shadow-sm p-5 sm:p-6 space-y-5">
                        <h2 class="text-lg sm:text-xl font-semibold text-gray-900 flex items-center gap-2.5">
                            <span class="inline-flex items-center justify-center p-2 rounded-lg bg-red-50 text-red-600">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M2 9.5a5.5 5.5 0 0 1 9.591-3.676.56.56 0 0 0 .818 0A5.49 5.49 0 0 1 22 9.5c0 2.29-1.5 4-3 5.5l-5.492 5.313a2 2 0 0 1-3 .019L5 15c-1.5-1.5-3-3.2-3-5.5" />
                                </svg>
                            </span>
                            Recomendações
                        </h2>

                        <div class="space-y-3">
                            <div class="p-4 rounded-xl border border-emerald-100 bg-emerald-50/80 text-xs sm:text-sm">
                                <p class="font-semibold text-gray-900 mb-1">Exercícios Diários</p>
                                <p class="text-gray-700 leading-snug">Mantenha a rotina de Qi Gong pela manhã para estimular o fluxo energético.</p>
                            </div>
                            <div class="p-4 rounded-xl border border-amber-100 bg-amber-50/80 text-xs sm:text-sm">
                                <p class="font-semibold text-gray-900 mb-1">Hidratação</p>
                                <p class="text-gray-700 leading-snug">Beba água morna ao longo do dia.</p>
                            </div>
                            <div class="p-4 rounded-xl border border-blue-100 bg-blue-50/80 text-xs sm:text-sm">
                                <p class="font-semibold text-gray-900 mb-1">Horário de Sono</p>
                                <p class="text-gray-700 leading-snug">Mantenha um horário consistente entre as 23h e as 7h.</p>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
        </main>
    </div>

    <!-- Footer -->
    <footer class="h-12 border-t bg-white flex items-center justify-between px-4 sm:px-6 text-xs sm:text-sm text-gray-600">
        <span>© {{ now()->year }} QiFlow - Medicina Tradicional Chinesa</span>
        <span class="opacity-70">v1.0</span>
    </footer>
</div>
@endsection
