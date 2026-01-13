@extends('client.layout')

@section('title', 'Objetivos de Tratamento - QiFlow')

@section('content')
<div class="p-8">
    <!-- Header -->
    <div class="mb-8">
        <h1 class="text-3xl font-bold text-gray-900">Objetivos de Tratamento</h1>
        <p class="text-gray-600 mt-2">Acompanhe o progresso dos seus objetivos de saúde</p>
    </div>

    @if($treatmentGoals && count($treatmentGoals) > 0)
        <div class="space-y-6">
            @foreach($treatmentGoals as $goal)
                <!-- Treatment Goal Card -->
                <div class="bg-white rounded-lg shadow-sm border border-gray-200 overflow-hidden">
                    <!-- Goal Header -->
                    <div class="bg-gradient-to-r from-[#B8860B]/10 to-[#B8860B]/5 p-6 border-b border-gray-200">
                        <div class="flex items-start justify-between mb-4">
                            <div class="flex-1">
                                <h3 class="text-2xl font-semibold text-gray-900 mb-2">{{ $goal->title }}</h3>
                                @if($goal->description)
                                    <p class="text-gray-600">{{ $goal->description }}</p>
                                @endif
                            </div>
                            <div class="ml-4 flex gap-2">
                                <!-- Priority Badge -->
                                @php
                                    $priorityColors = [
                                        'Mínima' => 'bg-blue-100 text-blue-800',
                                        'Média' => 'bg-yellow-100 text-yellow-800',
                                        'Alta' => 'bg-red-100 text-red-800',
                                    ];
                                    $priorityColor = $priorityColors[$goal->priority] ?? 'bg-gray-100 text-gray-800';
                                @endphp
                                <span class="inline-block px-3 py-1 {{ $priorityColor }} rounded-full text-sm font-medium whitespace-nowrap">
                                    {{ $goal->priority }}
                                </span>

                                <!-- Status Badge -->
                                @php
                                    $statusColors = [
                                        'Em progresso' => 'bg-blue-100 text-blue-800',
                                        'Concluído' => 'bg-green-100 text-green-800',
                                        'Cancelado' => 'bg-red-100 text-red-800',
                                    ];
                                    $statusColor = $statusColors[$goal->status] ?? 'bg-gray-100 text-gray-800';
                                @endphp
                                <span class="inline-block px-3 py-1 {{ $statusColor }} rounded-full text-sm font-medium whitespace-nowrap">
                                    {{ $goal->status }}
                                </span>
                            </div>
                        </div>
                    </div>

                    <!-- Goal Details -->
                    <div class="p-6 space-y-6">
                        <!-- Progress Bar -->
                        <div>
                            <div class="flex items-center justify-between mb-2">
                                <label class="block text-sm font-semibold text-gray-700">Progresso</label>
                                <span class="text-sm font-semibold text-gray-900">
                                    {{ $goal->progress_percentage }}%
                                    @if($goal->goalMilestones && count($goal->goalMilestones) > 0)
                                        <span class="text-gray-600 font-normal">
                                            ({{ $goal->goalMilestones->where('completed', true)->count() }}/{{ $goal->goalMilestones->count() }} marcos)
                                        </span>
                                    @endif
                                </span>
                            </div>
                            <div class="w-full bg-gray-200 rounded-full h-3">
                                <div class="bg-gradient-to-r from-[#B8860B] to-[#996F00] h-3 rounded-full transition-all" style="width: {{ $goal->progress_percentage }}%"></div>
                            </div>
                        </div>

                        <!-- Goal Info Grid -->
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-4 pt-4 border-t border-gray-100">
                            @if($goal->target_date)
                                <div>
                                    <label class="block text-xs font-semibold text-gray-600 uppercase tracking-widest mb-1">Data Alvo</label>
                                    <p class="text-gray-900">
                                        {{ \Carbon\Carbon::parse($goal->target_date)->format('d/m/Y') }}
                                    </p>
                                </div>
                            @endif

                            @if($goal->treatment_methods)
                                <div>
                                    <label class="block text-xs font-semibold text-gray-600 uppercase tracking-widest mb-1">Métodos de Tratamento</label>
                                    <p class="text-gray-900">{{ $goal->treatment_methods }}</p>
                                </div>
                            @endif

                            <div>
                                <label class="block text-xs font-semibold text-gray-600 uppercase tracking-widest mb-1">Estado</label>
                                <p class="text-gray-900">{{ $goal->status }}</p>
                            </div>
                        </div>

                        <!-- Milestones Section -->
                        @if($goal->goalMilestones && count($goal->goalMilestones) > 0)
                            <div class="pt-6 border-t border-gray-200">
                                <h4 class="text-lg font-semibold text-gray-900 mb-4">Marcos do Objetivo</h4>
                                <div class="space-y-3">
                                    @foreach($goal->goalMilestones as $milestone)
                                        <div class="flex items-start gap-4 p-4 rounded-lg border {{ $milestone->completed ? 'bg-green-50 border-green-200' : 'bg-gray-50 border-gray-200' }}">
                                            <!-- Checkbox Icon -->
                                            <div class="flex-shrink-0 mt-1">
                                                @if($milestone->completed)
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-green-600" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                                        <polyline points="20 6 9 17 4 12"></polyline>
                                                    </svg>
                                                @else
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-gray-400" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                                        <circle cx="12" cy="12" r="10"></circle>
                                                    </svg>
                                                @endif
                                            </div>

                                            <!-- Milestone Content -->
                                            <div class="flex-1">
                                                @if($milestone->description)
                                                    <p class="font-medium text-gray-900 mb-2">{{ $milestone->description }}</p>
                                                @endif

                                                <div class="flex items-center gap-4 text-sm text-gray-600">
                                                    <div class="flex items-center gap-1">
                                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                                            <path d="M8 2v4" />
                                                            <path d="M16 2v4" />
                                                            <rect width="18" height="18" x="3" y="4" rx="2" />
                                                            <path d="M3 10h18" />
                                                        </svg>
                                                        <span>
                                                            @if($milestone->completed && $milestone->completion_date)
                                                                Concluído em {{ \Carbon\Carbon::parse($milestone->completion_date)->format('d/m/Y') }}
                                                            @else
                                                                Alvo: {{ \Carbon\Carbon::parse($milestone->target_date)->format('d/m/Y') }}
                                                            @endif
                                                        </span>
                                                    </div>
                                                </div>

                                                @if($milestone->notes)
                                                    <div class="mt-3 pt-3 border-t border-gray-200">
                                                        <label class="block text-xs font-semibold text-gray-600 uppercase tracking-widest mb-1">Notas</label>
                                                        <p class="text-gray-900 text-sm">{{ $milestone->notes }}</p>
                                                    </div>
                                                @endif
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        @else
                            <div class="pt-6 border-t border-gray-200">
                                <p class="text-gray-500 text-sm">Nenhum marco definido para este objetivo.</p>
                            </div>
                        @endif
                    </div>
                </div>
            @endforeach
        </div>
    @else
        <!-- Empty State -->
        <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-12 text-center">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-16 w-16 text-gray-300 mx-auto mb-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <circle cx="12" cy="12" r="10"></circle>
                <polyline points="12 6 12 12 16 14"></polyline>
            </svg>
            <h3 class="text-lg font-semibold text-gray-900 mb-2">Nenhum objetivo de tratamento</h3>
            <p class="text-gray-600">Não tem objetivos de tratamento definidos no momento.</p>
        </div>
    @endif
</div>
@endsection
