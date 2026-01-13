@extends('client.layout')

@section('title', 'Exercícios - QiFlow')

@section('content')
<div class="p-8">
    <!-- Header -->
    <div class="mb-8">
        <h1 class="text-3xl font-bold text-gray-900">Exercícios Prescritos</h1>
        <p class="text-gray-600 mt-2">Acompanhe os exercícios recomendados para o seu tratamento</p>
    </div>

    @if($exercises && count($exercises) > 0)
        <div class="space-y-6">
            @foreach($exercises as $exercise)
                <!-- Exercise Card -->
                <div class="bg-white rounded-lg shadow-sm border border-gray-200 overflow-hidden hover:shadow-md transition-shadow">
                    <!-- Exercise Header -->
                    <div class="bg-gradient-to-r from-[#B8860B]/10 to-[#B8860B]/5 p-6 border-b border-gray-200">
                        <div class="flex items-start justify-between mb-4">
                            <div class="flex-1">
                                <h3 class="text-2xl font-semibold text-gray-900 mb-2">{{ $exercise->name }}</h3>
                                @if($exercise->description)
                                    <p class="text-gray-600">{{ $exercise->description }}</p>
                                @endif
                            </div>
                            <div class="ml-4 flex gap-2">
                                <!-- Difficulty Badge -->
                                @php
                                    $difficultyColors = [
                                        'Fácil' => 'bg-green-100 text-green-800',
                                        'Moderado' => 'bg-yellow-100 text-yellow-800',
                                        'Difícil' => 'bg-red-100 text-red-800',
                                    ];
                                    $difficultyColor = $difficultyColors[$exercise->difficulty_level] ?? 'bg-gray-100 text-gray-800';
                                @endphp
                                <span class="inline-block px-3 py-1 {{ $difficultyColor }} rounded-full text-sm font-medium whitespace-nowrap">
                                    {{ $exercise->difficulty_level }}
                                </span>

                                <!-- Status Badge -->
                                @php
                                    $statusColors = [
                                        'Pendente' => 'bg-gray-100 text-gray-800',
                                        'Em progresso' => 'bg-blue-100 text-blue-800',
                                        'Concluído' => 'bg-green-100 text-green-800',
                                    ];
                                    $statusColor = $statusColors[$exercise->pivot->status] ?? 'bg-gray-100 text-gray-800';
                                @endphp
                                <span class="inline-block px-3 py-1 {{ $statusColor }} rounded-full text-sm font-medium whitespace-nowrap">
                                    {{ $exercise->pivot->status }}
                                </span>
                            </div>
                        </div>
                    </div>

                    <!-- Exercise Details -->
                    <div class="p-6 space-y-6">
                        <!-- Category and Compliance -->
                        <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
                            <div>
                                <label class="block text-xs font-semibold text-gray-600 uppercase tracking-widest mb-1">Categoria</label>
                                <p class="text-gray-900">{{ $exercise->category }}</p>
                            </div>

                            <div>
                                <label class="block text-xs font-semibold text-gray-600 uppercase tracking-widest mb-1">Data Prescrita</label>
                                <p class="text-gray-900">
                                    {{ \Carbon\Carbon::parse($exercise->pivot->prescribed_date)->format('d/m/Y') }}
                                </p>
                            </div>

                            @if($exercise->pivot->frequency)
                                <div>
                                    <label class="block text-xs font-semibold text-gray-600 uppercase tracking-widest mb-1">Frequência</label>
                                    <p class="text-gray-900">{{ $exercise->pivot->frequency }}</p>
                                </div>
                            @endif

                            <div>
                                <label class="block text-xs font-semibold text-gray-600 uppercase tracking-widest mb-1">Progresso</label>
                                <p class="text-gray-900">
                                    @if($exercise->pivot->actual_number !== null && $exercise->pivot->target_number !== null)
                                        {{ $exercise->pivot->actual_number }}/{{ $exercise->pivot->target_number }}
                                    @else
                                        <span class="text-gray-400">---</span>
                                    @endif
                                </p>
                            </div>
                        </div>

                        <!-- Progress Bar -->
                        @if($exercise->pivot->target_number > 0)
                            <div class="pt-4 border-t border-gray-100">
                                <div class="flex items-center justify-between mb-2">
                                    <label class="block text-sm font-semibold text-gray-700">Cumprimento</label>
                                    <span class="text-sm font-semibold text-gray-900">{{ $exercise->pivot->compliance_rate ?? 0 }}%</span>
                                </div>
                                <div class="w-full bg-gray-200 rounded-full h-2">
                                    <div class="bg-gradient-to-r from-[#B8860B] to-[#996F00] h-2 rounded-full transition-all" style="width: {{ $exercise->pivot->compliance_rate ?? 0 }}%"></div>
                                </div>
                            </div>
                        @endif

                        <!-- Last Performed -->
                        @if($exercise->pivot->last_performed)
                            <div class="pt-4 border-t border-gray-100">
                                <label class="block text-xs font-semibold text-gray-600 uppercase tracking-widest mb-1">Última Realização</label>
                                <p class="text-gray-900">
                                    {{ \Carbon\Carbon::parse($exercise->pivot->last_performed)->format('d/m/Y') }}
                                </p>
                            </div>
                        @endif

                        <!-- Instructions -->
                        @if($exercise->instructions)
                            <div class="pt-4 border-t border-gray-100">
                                <label class="block text-sm font-semibold text-gray-700 mb-2">Instruções</label>
                                <div class="bg-gray-50 rounded-lg p-4 border border-gray-100">
                                    <p class="text-gray-900 text-sm leading-relaxed">{{ $exercise->instructions }}</p>
                                </div>
                            </div>
                        @endif

                        <!-- Benefits -->
                        @if($exercise->benefits)
                            <div class="pt-4 border-t border-gray-100">
                                <label class="block text-sm font-semibold text-gray-700 mb-2">Benefícios</label>
                                <div class="bg-gray-50 rounded-lg p-4 border border-gray-100">
                                    <p class="text-gray-900 text-sm leading-relaxed">{{ $exercise->benefits }}</p>
                                </div>
                            </div>
                        @endif

                        <!-- Precautions -->
                        @if($exercise->precautions)
                            <div class="pt-4 border-t border-gray-100">
                                <label class="block text-sm font-semibold text-gray-700 mb-2">Precauções</label>
                                <div class="bg-gray-50 rounded-lg p-4 border border-gray-100">
                                    <p class="text-gray-900 text-sm leading-relaxed">{{ $exercise->precautions }}</p>
                                </div>
                            </div>
                        @endif

                        <!-- Notes -->
                        @if($exercise->pivot->notes)
                            <div class="pt-4 border-t border-gray-100">
                                <label class="block text-sm font-semibold text-gray-700 mb-2">Notas</label>
                                <div class="bg-gray-50 rounded-lg p-4 border border-gray-200">
                                    <p class="text-gray-900 text-sm leading-relaxed">{{ $exercise->pivot->notes }}</p>
                                </div>
                            </div>
                        @endif

                        <!-- Video Link -->
                        @if($exercise->video_url)
                            <div class="pt-4 border-t border-gray-100">
                                <a href="{{ $exercise->video_url }}" target="_blank" class="inline-flex items-center gap-2 px-4 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700 transition-all font-medium">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 24 24" fill="currentColor">
                                        <path d="M8 5v14l11-7z"></path>
                                    </svg>
                                    Ver Vídeo
                                </a>
                            </div>
                        @endif

                        <!-- Complete Exercise Button -->
                        <div class="pt-4 border-t border-gray-100">
                            <form method="POST" action="{{ route('user.exercise.complete', $exercise->id) }}" class="inline">
                                @csrf
                                <button type="submit" class="inline-flex items-center gap-2 px-4 py-2 bg-[#B8860B] text-white rounded-lg hover:bg-[#B8860B]/90 transition-all font-medium">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <polyline points="20 6 9 17 4 12"></polyline>
                                    </svg>
                                    Feito!
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @else
        <!-- Empty State -->
        <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-12 text-center">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-16 w-16 text-gray-300 mx-auto mb-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <path d="M6 4h12v16H6z"></path>
                <path d="M10 9h4"></path>
                <path d="M10 13h4"></path>
            </svg>
            <h3 class="text-lg font-semibold text-gray-900 mb-2">Nenhum exercício prescrito</h3>
            <p class="text-gray-600">Não tem exercícios prescritos no momento.</p>
        </div>
    @endif
</div>
@endsection
