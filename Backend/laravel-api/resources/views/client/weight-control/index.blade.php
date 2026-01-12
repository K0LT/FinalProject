@extends('client.layout')

@section('title', 'Controlo de Peso - QiFlow')

@section('content')
<div class="p-8">
    <!-- Header -->
    <div class="mb-8">
        <h1 class="text-3xl font-bold text-gray-900">Controlo de Peso</h1>
        <p class="text-gray-600 mt-2">Acompanhe o seu progresso de peso e nutrição</p>
    </div>

    <!-- Add Weight and Nutrition Forms -->
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
        <!-- Add Weight Form -->
        <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6">
            <h3 class="text-lg font-semibold text-gray-900 mb-4">Adicionar Peso</h3>
            <form method="POST" action="{{ route('user.weight-control.add-weight') }}" class="space-y-4">
                @csrf

                <div>
                    <label for="weight" class="block text-sm font-medium text-gray-700 mb-1">Peso (kg) *</label>
                    <input
                        type="number"
                        id="weight"
                        name="weight"
                        step="0.1"
                        min="20"
                        max="300"
                        placeholder="Ex: 75.5"
                        class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-[#B8860B] focus:border-transparent"
                        required
                    >
                </div>

                <div>
                    <label for="weight_notes" class="block text-sm font-medium text-gray-700 mb-1">Notas</label>
                    <textarea
                        id="weight_notes"
                        name="notes"
                        rows="2"
                        placeholder="Notas adicionais..."
                        class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-[#B8860B] focus:border-transparent"
                    ></textarea>
                </div>

                <button
                    type="submit"
                    class="w-full inline-flex items-center justify-center gap-2 bg-[#B8860B] text-white hover:bg-[#B8860B]/90 px-4 py-2 rounded-lg font-medium transition-all"
                >
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M12 5v14M5 12h14"></path>
                    </svg>
                    Adicionar Peso
                </button>
            </form>
        </div>

        <!-- Add Nutrition Form -->
        <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6">
            <h3 class="text-lg font-semibold text-gray-900 mb-4">Adicionar Nutrição Hoje</h3>
            <form method="POST" action="{{ route('user.weight-control.add-nutrition') }}" class="space-y-4">
                @csrf

                <div class="grid grid-cols-2 gap-3">
                    <div>
                        <label for="calories_consumed" class="block text-xs font-medium text-gray-700 mb-1">Calorias</label>
                        <input
                            type="number"
                            id="calories_consumed"
                            name="calories_consumed"
                            min="0"
                            placeholder="kcal"
                            class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-[#B8860B] focus:border-transparent text-sm"
                        >
                    </div>
                    <div>
                        <label for="protein_consumed" class="block text-xs font-medium text-gray-700 mb-1">Proteína</label>
                        <input
                            type="number"
                            id="protein_consumed"
                            name="protein_consumed"
                            step="0.1"
                            min="0"
                            placeholder="g"
                            class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-[#B8860B] focus:border-transparent text-sm"
                        >
                    </div>
                    <div>
                        <label for="carbs_consumed" class="block text-xs font-medium text-gray-700 mb-1">Carboidratos</label>
                        <input
                            type="number"
                            id="carbs_consumed"
                            name="carbs_consumed"
                            step="0.1"
                            min="0"
                            placeholder="g"
                            class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-[#B8860B] focus:border-transparent text-sm"
                        >
                    </div>
                    <div>
                        <label for="fat_consumed" class="block text-xs font-medium text-gray-700 mb-1">Gordura</label>
                        <input
                            type="number"
                            id="fat_consumed"
                            name="fat_consumed"
                            step="0.1"
                            min="0"
                            placeholder="g"
                            class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-[#B8860B] focus:border-transparent text-sm"
                        >
                    </div>
                    <div>
                        <label for="water_intake" class="block text-xs font-medium text-gray-700 mb-1">Água</label>
                        <input
                            type="number"
                            id="water_intake"
                            name="water_intake"
                            step="0.1"
                            min="0"
                            placeholder="L"
                            class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-[#B8860B] focus:border-transparent text-sm"
                        >
                    </div>
                    <div>
                        <label for="steps" class="block text-xs font-medium text-gray-700 mb-1">Passos</label>
                        <input
                            type="number"
                            id="steps"
                            name="steps"
                            min="0"
                            placeholder="passos"
                            class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-[#B8860B] focus:border-transparent text-sm"
                        >
                    </div>
                    <div>
                        <label for="sleep_hours" class="block text-xs font-medium text-gray-700 mb-1">Sono</label>
                        <input
                            type="number"
                            id="sleep_hours"
                            name="sleep_hours"
                            step="0.5"
                            min="0"
                            max="24"
                            placeholder="horas"
                            class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-[#B8860B] focus:border-transparent text-sm"
                        >
                    </div>
                    <div>
                        <label for="calories_burned" class="block text-xs font-medium text-gray-700 mb-1">Calorias Queimadas</label>
                        <input
                            type="number"
                            id="calories_burned"
                            name="calories_burned"
                            min="0"
                            placeholder="kcal"
                            class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-[#B8860B] focus:border-transparent text-sm"
                        >
                    </div>
                </div>

                <button
                    type="submit"
                    class="w-full inline-flex items-center justify-center gap-2 bg-[#B8860B] text-white hover:bg-[#B8860B]/90 px-4 py-2 rounded-lg font-medium transition-all"
                >
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M12 5v14M5 12h14"></path>
                    </svg>
                    Adicionar Nutrição
                </button>
            </form>
        </div>
    </div>

    <!-- Summary Cards -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-8">
        <!-- Current Weight -->
        <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6">
            <label class="block text-xs font-semibold text-gray-600 uppercase tracking-widest mb-2">Peso Atual</label>
            <p class="text-3xl font-bold text-gray-900">
                @if($currentWeight)
                    {{ $currentWeight }} kg
                @else
                    <span class="text-gray-400">---</span>
                @endif
            </p>
            @if($currentWeight && $weightTrackings->count() > 1)
                <p class="text-sm text-gray-600 mt-2">
                    Última medição: {{ \Carbon\Carbon::parse($weightTrackings->first()->measurement_date)->format('d/m/Y') }}
                </p>
            @endif
        </div>

        <!-- Weight Change -->
        <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6">
            <label class="block text-xs font-semibold text-gray-600 uppercase tracking-widest mb-2">Mudança de Peso</label>
            <p class="text-3xl font-bold {{ $weightChange < 0 ? 'text-green-600' : ($weightChange > 0 ? 'text-red-600' : 'text-gray-900') }}">
                @if($weightChange != 0)
                    {{ $weightChange > 0 ? '+' : '' }}{{ $weightChange }} kg
                @else
                    <span class="text-gray-400">---</span>
                @endif
            </p>
            @if($weightTrackings->count() > 1)
                <p class="text-sm text-gray-600 mt-2">
                    De {{ $weightTrackings->last()->weight }} kg
                </p>
            @endif
        </div>

        <!-- Target Weight -->
        <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6">
            <label class="block text-xs font-semibold text-gray-600 uppercase tracking-widest mb-2">Peso Alvo</label>
            <p class="text-3xl font-bold text-gray-900">
                @if($nutritionalGoals && $nutritionalGoals->target_weight)
                    {{ $nutritionalGoals->target_weight }} kg
                @else
                    <span class="text-gray-400">---</span>
                @endif
            </p>
            @if($nutritionalGoals && $nutritionalGoals->target_date)
                <p class="text-sm text-gray-600 mt-2">
                    Alvo: {{ \Carbon\Carbon::parse($nutritionalGoals->target_date)->format('d/m/Y') }}
                </p>
            @endif
        </div>
    </div>

    <!-- Nutritional Goals Section -->
    @if($nutritionalGoals)
        <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6 mb-8">
            <h2 class="text-xl font-semibold text-gray-900 mb-6">Objetivos Nutricionais</h2>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
                @if($nutritionalGoals->daily_calories_goal)
                    <div class="p-4 rounded-lg bg-blue-50 border border-blue-200">
                        <label class="block text-xs font-semibold text-gray-600 uppercase tracking-widest mb-2">Calorias Diárias</label>
                        <p class="text-2xl font-bold text-blue-900">{{ $nutritionalGoals->daily_calories_goal }}</p>
                        <p class="text-xs text-blue-700 mt-1">kcal/dia</p>
                    </div>
                @endif

                @if($nutritionalGoals->daily_protein_goal)
                    <div class="p-4 rounded-lg bg-red-50 border border-red-200">
                        <label class="block text-xs font-semibold text-gray-600 uppercase tracking-widest mb-2">Proteína</label>
                        <p class="text-2xl font-bold text-red-900">{{ $nutritionalGoals->daily_protein_goal }}</p>
                        <p class="text-xs text-red-700 mt-1">g/dia</p>
                    </div>
                @endif

                @if($nutritionalGoals->daily_carbs_goal)
                    <div class="p-4 rounded-lg bg-yellow-50 border border-yellow-200">
                        <label class="block text-xs font-semibold text-gray-600 uppercase tracking-widest mb-2">Carboidratos</label>
                        <p class="text-2xl font-bold text-yellow-900">{{ $nutritionalGoals->daily_carbs_goal }}</p>
                        <p class="text-xs text-yellow-700 mt-1">g/dia</p>
                    </div>
                @endif

                @if($nutritionalGoals->daily_fat_goal)
                    <div class="p-4 rounded-lg bg-orange-50 border border-orange-200">
                        <label class="block text-xs font-semibold text-gray-600 uppercase tracking-widest mb-2">Gordura</label>
                        <p class="text-2xl font-bold text-orange-900">{{ $nutritionalGoals->daily_fat_goal }}</p>
                        <p class="text-xs text-orange-700 mt-1">g/dia</p>
                    </div>
                @endif
            </div>
        </div>
    @endif

    <!-- Weight Tracking History -->
    @if($weightTrackings && count($weightTrackings) > 0)
        <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6 mb-8">
            <h2 class="text-xl font-semibold text-gray-900 mb-6">Histórico de Peso</h2>

            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead>
                        <tr class="border-b border-gray-200">
                            <th class="text-left py-3 px-4 text-sm font-semibold text-gray-700">Data</th>
                            <th class="text-left py-3 px-4 text-sm font-semibold text-gray-700">Peso (kg)</th>
                            <th class="text-left py-3 px-4 text-sm font-semibold text-gray-700">Notas</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($weightTrackings as $tracking)
                            <tr class="border-b border-gray-100 hover:bg-gray-50">
                                <td class="py-3 px-4 text-sm text-gray-900">
                                    {{ \Carbon\Carbon::parse($tracking->measurement_date)->format('d/m/Y') }}
                                </td>
                                <td class="py-3 px-4 text-sm font-semibold text-gray-900">
                                    {{ $tracking->weight }} kg
                                </td>
                                <td class="py-3 px-4 text-sm text-gray-600">
                                    @if($tracking->notes)
                                        {{ Str::limit($tracking->notes, 50) }}
                                    @else
                                        <span class="text-gray-400">---</span>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    @else
        <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6 mb-8">
            <p class="text-gray-500 text-center py-8">Nenhum registo de peso disponível</p>
        </div>
    @endif

    <!-- Daily Nutrition Records -->
    @if($dailyNutrition && count($dailyNutrition) > 0)
        <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6">
            <h2 class="text-xl font-semibold text-gray-900 mb-6">Registos de Nutrição Diária</h2>

            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead>
                        <tr class="border-b border-gray-200">
                            <th class="text-left py-3 px-4 text-sm font-semibold text-gray-700">Data</th>
                            <th class="text-left py-3 px-4 text-sm font-semibold text-gray-700">Calorias</th>
                            <th class="text-left py-3 px-4 text-sm font-semibold text-gray-700">Proteína</th>
                            <th class="text-left py-3 px-4 text-sm font-semibold text-gray-700">Carboidratos</th>
                            <th class="text-left py-3 px-4 text-sm font-semibold text-gray-700">Gordura</th>
                            <th class="text-left py-3 px-4 text-sm font-semibold text-gray-700">Água</th>
                            <th class="text-left py-3 px-4 text-sm font-semibold text-gray-700">Passos</th>
                            <th class="text-left py-3 px-4 text-sm font-semibold text-gray-700">Sono</th>
                            <th class="text-left py-3 px-4 text-sm font-semibold text-gray-700">Calorias Queimadas</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($dailyNutrition as $nutrition)
                            <tr class="border-b border-gray-100 hover:bg-gray-50">
                                <td class="py-3 px-4 text-sm text-gray-900">
                                    {{ \Carbon\Carbon::parse($nutrition->date)->format('d/m/Y') }}
                                </td>
                                <td class="py-3 px-4 text-sm text-gray-600">
                                    @if($nutrition->calories_consumed)
                                        {{ $nutrition->calories_consumed }} kcal
                                    @else
                                        <span class="text-gray-400">---</span>
                                    @endif
                                </td>
                                <td class="py-3 px-4 text-sm text-gray-600">
                                    @if($nutrition->protein_consumed)
                                        {{ $nutrition->protein_consumed }}g
                                    @else
                                        <span class="text-gray-400">---</span>
                                    @endif
                                </td>
                                <td class="py-3 px-4 text-sm text-gray-600">
                                    @if($nutrition->carbs_consumed)
                                        {{ $nutrition->carbs_consumed }}g
                                    @else
                                        <span class="text-gray-400">---</span>
                                    @endif
                                </td>
                                <td class="py-3 px-4 text-sm text-gray-600">
                                    @if($nutrition->fat_consumed)
                                        {{ $nutrition->fat_consumed }}g
                                    @else
                                        <span class="text-gray-400">---</span>
                                    @endif
                                </td>
                                <td class="py-3 px-4 text-sm text-gray-600">
                                    @if($nutrition->water_intake)
                                        {{ $nutrition->water_intake }}L
                                    @else
                                        <span class="text-gray-400">---</span>
                                    @endif
                                </td>
                                <td class="py-3 px-4 text-sm text-gray-600">
                                    @if($nutrition->steps)
                                        {{ number_format($nutrition->steps) }}
                                    @else
                                        <span class="text-gray-400">---</span>
                                    @endif
                                </td>
                                <td class="py-3 px-4 text-sm text-gray-600">
                                    @if($nutrition->sleep_hours)
                                        {{ $nutrition->sleep_hours }}h
                                    @else
                                        <span class="text-gray-400">---</span>
                                    @endif
                                </td>
                                <td class="py-3 px-4 text-sm text-gray-600">
                                    @if($nutrition->calories_burned)
                                        {{ $nutrition->calories_burned }} kcal
                                    @else
                                        <span class="text-gray-400">---</span>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <!-- Pagination Links -->
            <div class="mt-6 pt-6 border-t border-gray-200">
                {{ $dailyNutrition->links() }}
            </div>
        </div>
    @else
        <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6">
            <p class="text-gray-500 text-center py-8">Nenhum registo de nutrição disponível</p>
        </div>
    @endif
</div>
@endsection
