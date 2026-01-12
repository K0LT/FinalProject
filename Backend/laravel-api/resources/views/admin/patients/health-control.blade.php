@extends('admin.layout')

@section('admin-content')
<div class="p-8">
    <div class="mb-8 flex items-center justify-between">
        <div>
            <h1 class="text-3xl font-bold text-gray-900">Controlo de Saúde - {{ $patient->name }} {{ $patient->surname }}</h1>
            <p class="text-gray-600 mt-2">Peso e Nutrição</p>
        </div>
        <a href="{{ route('admin.patient.detail', $patient->id) }}" class="inline-flex items-center gap-2 bg-gray-200 text-gray-900 hover:bg-gray-300 px-4 py-2 rounded-lg font-medium transition-all">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <line x1="19" y1="12" x2="5" y2="12"></line>
                <polyline points="12 19 5 12 12 5"></polyline>
            </svg>
            Voltar
        </a>
    </div>

    <!-- Current Weight -->
    <div class="mb-8">
        <div class="bg-green-50 rounded-lg shadow-sm border border-green-200 p-6">
            <p class="text-sm text-gray-600">Peso Atual</p>
            <p class="text-4xl text-gray-900 mt-2">
                @if($weightTrackings->count() > 0)
                    {{ $weightTrackings->first()->weight }} kg
                @else
                    N/A
                @endif
            </p>
        </div>
    </div>

    <!-- Weight Tracking Section -->
    <div class="mb-8">
        <h2 class="text-2xl text-gray-900 mb-4">Histórico de Peso</h2>
        
        @if($weightTrackings->count() > 0)
            <div class="space-y-3">
                @foreach($weightTrackings as $tracking)
                    <div class="bg-gray-50 rounded-lg shadow-sm border border-gray-200 p-4 flex items-center justify-between">
                        <div>
                            <p class="text-sm text-gray-600">{{ \Carbon\Carbon::parse($tracking->measurement_date)->format('d/m/Y') }}</p>
                            <p class="text-lg text-gray-900 mt-1">{{ $tracking->weight }} kg</p>
                        </div>
                        @if($tracking->body_fat_percentage)
                            <div class="bg-gray-100 border border-gray-300 rounded-lg p-3">
                                <p class="text-xs text-gray-700">Gordura: {{ $tracking->body_fat_percentage }}%</p>
                            </div>
                        @endif
                    </div>
                @endforeach
            </div>
        @else
            <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6">
                <p class="text-gray-500 text-center py-8">Nenhum registo de peso</p>
            </div>
        @endif
    </div>

    <!-- Daily Nutrition Section -->
    <div>
        <h2 class="text-2xl text-gray-900 mb-4">Registos de Nutrição Diária</h2>
        
        @if($dailyNutrition->count() > 0)
            <div class="space-y-4">
                @foreach($dailyNutrition as $nutrition)
                    <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6">
                        <div class="mb-4">
                            <h3 class="text-lg text-gray-900">
                                {{ \Carbon\Carbon::parse($nutrition->date)->format('d/m/Y') }}
                            </h3>
                        </div>

                        <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                            <div class="bg-gray-50 border border-gray-300 rounded-lg p-4">
                                <p class="text-xs text-gray-700">Calorias</p>
                                <p class="text-2xl text-gray-900 mt-2">{{ $nutrition->calories_consumed ?? 0 }}</p>
                                <p class="text-xs text-gray-600 mt-1">kcal</p>
                            </div>

                            <div class="bg-gray-50 border border-gray-300 rounded-lg p-4">
                                <p class="text-xs text-gray-700">Proteína</p>
                                <p class="text-2xl text-gray-900 mt-2">{{ $nutrition->protein_consumed ?? 0 }}</p>
                                <p class="text-xs text-gray-600 mt-1">g</p>
                            </div>

                            <div class="bg-gray-50 border border-gray-300 rounded-lg p-4">
                                <p class="text-xs text-gray-700">Carboidratos</p>
                                <p class="text-2xl text-gray-900 mt-2">{{ $nutrition->carbs_consumed ?? 0 }}</p>
                                <p class="text-xs text-gray-600 mt-1">g</p>
                            </div>

                            <div class="bg-gray-50 border border-gray-300 rounded-lg p-4">
                                <p class="text-xs text-gray-700">Gordura</p>
                                <p class="text-2xl text-gray-900 mt-2">{{ $nutrition->fat_consumed ?? 0 }}</p>
                                <p class="text-xs text-gray-600 mt-1">g</p>
                            </div>
                        </div>

                        <div class="grid grid-cols-2 md:grid-cols-4 gap-4 mt-4">
                            @if($nutrition->water_intake)
                                <div class="bg-gray-50 border border-gray-300 rounded-lg p-4">
                                    <p class="text-xs text-gray-700">Água</p>
                                    <p class="text-2xl text-gray-900 mt-2">{{ $nutrition->water_intake }}</p>
                                    <p class="text-xs text-gray-600 mt-1">L</p>
                                </div>
                            @endif

                            @if($nutrition->steps)
                                <div class="bg-gray-50 border border-gray-300 rounded-lg p-4">
                                    <p class="text-xs text-gray-700">Passos</p>
                                    <p class="text-2xl text-gray-900 mt-2">{{ $nutrition->steps }}</p>
                                    <p class="text-xs text-gray-600 mt-1">passos</p>
                                </div>
                            @endif

                            @if($nutrition->sleep_hours)
                                <div class="bg-gray-50 border border-gray-300 rounded-lg p-4">
                                    <p class="text-xs text-gray-700">Sono</p>
                                    <p class="text-2xl text-gray-900 mt-2">{{ $nutrition->sleep_hours }}</p>
                                    <p class="text-xs text-gray-600 mt-1">h</p>
                                </div>
                            @endif

                            @if($nutrition->calories_burned)
                                <div class="bg-gray-50 border border-gray-300 rounded-lg p-4">
                                    <p class="text-xs text-gray-700">Calorias Queimadas</p>
                                    <p class="text-2xl text-gray-900 mt-2">{{ $nutrition->calories_burned }}</p>
                                    <p class="text-xs text-gray-600 mt-1">kcal</p>
                                </div>
                            @endif
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- Pagination -->
            <div class="mt-6">
                {{ $dailyNutrition->links() }}
            </div>
        @else
            <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6">
                <p class="text-gray-500 text-center py-8">Nenhum registo de nutrição</p>
            </div>
        @endif
    </div>
</div>
@endsection
