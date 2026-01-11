@extends('admin.layout')

@section('admin-content')
<div class="p-8">
    <div class="mb-8 flex items-center justify-between">
        <div>
            <h1 class="text-3xl font-bold text-gray-900">Exercícios - {{ $patient->name }} {{ $patient->surname }}</h1>
            <p class="text-gray-600 mt-2">{{ $exercises->count() }} exercício(s)</p>
        </div>
        <div class="flex gap-2">
            <button type="button" onclick="openExerciseModal()" class="inline-flex items-center gap-2 bg-blue-600 text-white hover:bg-blue-700 px-4 py-2 rounded-lg font-medium transition-all">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <line x1="12" y1="5" x2="12" y2="19"></line>
                    <line x1="5" y1="12" x2="19" y2="12"></line>
                </svg>
                Atribuir Exercício
            </button>
            <a href="{{ route('admin.patient.detail', $patient->id) }}" class="inline-flex items-center gap-2 bg-gray-200 text-gray-900 hover:bg-gray-300 px-4 py-2 rounded-lg font-medium transition-all">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <line x1="19" y1="12" x2="5" y2="12"></line>
                    <polyline points="12 19 5 12 12 5"></polyline>
                </svg>
                Voltar
            </a>
        </div>
    </div>

    @if($exercises->count() > 0)
        <div class="space-y-4">
            @foreach($exercises as $exercise)
                <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6 hover:shadow-md transition-all">
                    <div class="mb-4">
                        <h3 class="text-lg font-semibold text-gray-900">{{ $exercise->name }}</h3>
                        <p class="text-sm text-gray-600 mt-1">
                            Prescrito em: {{ \Carbon\Carbon::parse($exercise->pivot->prescribed_date)->format('d/m/Y') }}
                        </p>
                    </div>

                    @if($exercise->description)
                        <div class="mb-4 p-3 bg-gray-50 rounded border border-gray-200">
                            <p class="text-sm text-gray-700">{{ $exercise->description }}</p>
                        </div>
                    @endif

                    <div class="grid grid-cols-3 gap-4 mb-4">
                        <div class="bg-gray-50 rounded p-3">
                            <p class="text-xs font-medium text-gray-600">Alvo</p>
                            <p class="text-lg font-semibold text-gray-900">{{ $exercise->pivot->target_number }}</p>
                        </div>
                        <div class="bg-gray-50 rounded p-3">
                            <p class="text-xs font-medium text-gray-600">Realizado</p>
                            <p class="text-lg font-semibold text-gray-900">{{ $exercise->pivot->actual_number }}</p>
                        </div>
                        <div class="bg-gray-50 rounded p-3">
                            <p class="text-xs font-medium text-gray-600">Taxa de Conformidade</p>
                            <p class="text-lg font-semibold text-gray-900">
                                @if($exercise->pivot->target_number > 0)
                                    {{ round(($exercise->pivot->actual_number / $exercise->pivot->target_number) * 100) }}%
                                @else
                                    0%
                                @endif
                            </p>
                        </div>
                    </div>

                    <div class="pt-4 border-t border-gray-100">
                        <div class="flex items-center justify-between mb-2">
                            <label class="block text-sm font-semibold text-gray-700">Progresso</label>
                            <span class="text-sm font-semibold text-gray-900">
                                @if($exercise->pivot->target_number > 0)
                                    {{ round(($exercise->pivot->actual_number / $exercise->pivot->target_number) * 100) }}%
                                @else
                                    0%
                                @endif
                            </span>
                        </div>
                        <div class="w-full bg-gray-200 rounded-full h-2">
                            <div class="bg-gradient-to-r from-green-500 to-emerald-500 h-2 rounded-full transition-all" style="width: @if($exercise->pivot->target_number > 0){{ round(($exercise->pivot->actual_number / $exercise->pivot->target_number) * 100) }}@else 0 @endif%;"></div>
                        </div>
                    </div>

                    @if($exercise->pivot->last_performed)
                        <div class="mt-4 text-sm text-gray-600">
                            <p>Última execução: {{ \Carbon\Carbon::parse($exercise->pivot->last_performed)->format('d/m/Y') }}</p>
                        </div>
                    @endif
                </div>
            @endforeach
        </div>
    @else
        <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6">
            <p class="text-gray-500 text-center py-8">Nenhum exercício prescrito</p>
        </div>
    @endif
</div>

<!-- Exercise Modal -->
<div id="exerciseModal" class="hidden fixed inset-0 bg-black bg-opacity-50 z-50 flex items-center justify-center p-4">
    <div class="bg-white rounded-lg shadow-lg max-w-md w-full">
        <div class="border-b border-gray-200 p-6 flex items-center justify-between">
            <h2 class="text-2xl font-bold text-gray-900">Atribuir Exercício</h2>
            <button type="button" onclick="closeExerciseModal()" class="text-gray-500 hover:text-gray-700">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <line x1="18" y1="6" x2="6" y2="18"></line>
                    <line x1="6" y1="6" x2="18" y2="18"></line>
                </svg>
            </button>
        </div>

        <form action="{{ route('admin.patient.exercises.attach', $patient->id) }}" method="POST" class="p-6 space-y-4">
            @csrf
            
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Exercício</label>
                <select name="exercise_id" required class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                    <option value="">Selecione um exercício</option>
                    @foreach($allExercises as $exercise)
                        <option value="{{ $exercise->id }}">{{ $exercise->name }}</option>
                    @endforeach
                </select>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Data de Prescrição</label>
                <input type="date" name="prescribed_date" required class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Frequência</label>
                <input type="text" name="frequency" placeholder="Ex: 3x por semana" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Número Alvo</label>
                <input type="number" name="target_number" required min="1" placeholder="Ex: 10" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Status</label>
                <select name="status" required class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                    <option value="">Selecione um status</option>
                    <option value="Em progresso">Em progresso</option>
                    <option value="Concluído">Concluído</option>
                    <option value="Cancelado">Cancelado</option>
                </select>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Notas</label>
                <textarea name="notes" rows="2" placeholder="Adicione notas..." class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"></textarea>
            </div>

            <div class="flex gap-2 pt-4">
                <button type="submit" class="flex-1 bg-blue-600 text-white hover:bg-blue-700 px-4 py-2 rounded-lg font-medium transition-all">
                    Atribuir
                </button>
                <button type="button" onclick="closeExerciseModal()" class="flex-1 bg-gray-200 text-gray-900 hover:bg-gray-300 px-4 py-2 rounded-lg font-medium transition-all">
                    Cancelar
                </button>
            </div>
        </form>
    </div>
</div>

<script>
function openExerciseModal() {
    document.getElementById('exerciseModal').classList.remove('hidden');
}

function closeExerciseModal() {
    document.getElementById('exerciseModal').classList.add('hidden');
}

document.getElementById('exerciseModal').addEventListener('click', function(e) {
    if (e.target === this) {
        closeExerciseModal();
    }
});
</script>

@endsection
