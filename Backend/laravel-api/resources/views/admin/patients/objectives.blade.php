@extends('admin.layout')

@section('admin-content')
<div class="p-8">
    <div class="mb-8 flex items-center justify-between">
        <div>
            <h1 class="text-3xl font-bold text-gray-900">Objetivos de Tratamento - {{ $patient->name }} {{ $patient->surname }}</h1>
            <p class="text-gray-600 mt-2">{{ $objectives->count() }} objetivo(s)</p>
        </div>
        <div class="flex gap-2">
            <button type="button" onclick="openObjectiveModal()" class="inline-flex items-center gap-2 bg-blue-600 text-white hover:bg-blue-700 px-4 py-2 rounded-lg font-medium transition-all">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <line x1="12" y1="5" x2="12" y2="19"></line>
                    <line x1="5" y1="12" x2="19" y2="12"></line>
                </svg>
                Criar Objetivo
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

    @if($objectives->count() > 0)
        <div class="space-y-4">
            @foreach($objectives as $objective)
                <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6 hover:shadow-md transition-all">
                    <div class="mb-4">
                        <h3 class="text-lg font-semibold text-gray-900">{{ $objective->title }}</h3>
                        <p class="text-sm text-gray-600 mt-1">
                            Criado em: {{ \Carbon\Carbon::parse($objective->created_at)->format('d/m/Y') }}
                        </p>
                    </div>

                    @if($objective->description)
                        <div class="mb-4 p-3 bg-gray-50 rounded border border-gray-200">
                            <p class="text-sm text-gray-700">{{ $objective->description }}</p>
                        </div>
                    @endif

                    <div class="mb-4">
                        <p class="text-sm font-medium text-gray-700 mb-2">Marcos de Progresso:</p>
                        @if($objective->goalMilestones->count() > 0)
                    <div class="space-y-2">
                                @foreach($objective->goalMilestones as $milestone)
                                    <form action="{{ route('admin.patient.objectives.milestone.toggle', [$patient->id, $milestone->id]) }}" method="POST" class="inline-block w-full">
                                        @csrf
                                        <button type="submit" class="w-full text-left flex items-start gap-3 p-3 rounded bg-gray-50 hover:bg-gray-100 transition-colors">
                                            <div class="flex-shrink-0 mt-0.5">
                                                @if($milestone->completed)
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-green-600" viewBox="0 0 24 24" fill="currentColor">
                                                        <path d="M10 15.172l9.192-9.193a1 1 0 1 1 1.415 1.414l-10.606 10.606a1 1 0 0 1-1.414 0l-4.243-4.243a1 1 0 1 1 1.414-1.414l3.242 3.243z"></path>
                                                    </svg>
                                                @else
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                                        <circle cx="12" cy="12" r="10"></circle>
                                                    </svg>
                                                @endif
                                            </div>
                                            <div class="flex-1">
                                                <p class="text-sm font-medium {{ $milestone->completed ? 'text-gray-500 line-through' : 'text-gray-900' }}">{{ $milestone->description }}</p>
                                                @if($milestone->target_date)
                                                    <p class="text-xs text-gray-600 mt-1">
                                                        Data: {{ \Carbon\Carbon::parse($milestone->target_date)->format('d/m/Y') }}
                                                    </p>
                                                @endif
                                            </div>
                                        </button>
                                    </form>
                                @endforeach
                            </div>
                        @else
                            <p class="text-sm text-gray-500">Nenhum marco registado</p>
                        @endif
                        <button type="button" onclick="openMilestoneModal({{ $objective->id }})" class="mt-3 inline-flex items-center gap-1 text-sm text-blue-600 hover:text-blue-700 font-medium">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <line x1="12" y1="5" x2="12" y2="19"></line>
                                <line x1="5" y1="12" x2="19" y2="12"></line>
                            </svg>
                            Adicionar Marco
                        </button>
                    </div>

                    <div class="pt-4 border-t border-gray-100">
                        <div class="flex items-center justify-between mb-2">
                            <label class="block text-sm font-semibold text-gray-700">Progresso Geral</label>
                            <span class="text-sm font-semibold text-gray-900">
                                @if($objective->goalMilestones->count() > 0)
                                    {{ round(($objective->goalMilestones->where('completed', true)->count() / $objective->goalMilestones->count()) * 100) }}%
                                @else
                                    0%
                                @endif
                            </span>
                        </div>
                        <div class="w-full bg-gray-200 rounded-full h-2">
                            <div class="bg-gradient-to-r from-blue-500 to-cyan-500 h-2 rounded-full transition-all" style="width: @if($objective->goalMilestones->count() > 0){{ round(($objective->goalMilestones->where('completed', true)->count() / $objective->goalMilestones->count()) * 100) }}@else 0 @endif%;"></div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @else
        <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6">
            <p class="text-gray-500 text-center py-8">Nenhum objetivo de tratamento registado</p>
        </div>
    @endif
</div>

<!-- Objective Modal -->
<div id="objectiveModal" class="hidden fixed inset-0 bg-black bg-opacity-50 z-50 flex items-center justify-center p-4">
    <div class="bg-white rounded-lg shadow-lg max-w-md w-full">
        <div class="border-b border-gray-200 p-6 flex items-center justify-between">
            <h2 class="text-2xl font-bold text-gray-900">Criar Objetivo</h2>
            <button type="button" onclick="closeObjectiveModal()" class="text-gray-500 hover:text-gray-700">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <line x1="18" y1="6" x2="6" y2="18"></line>
                    <line x1="6" y1="6" x2="18" y2="18"></line>
                </svg>
            </button>
        </div>

        <form action="{{ route('admin.patient.objectives.store', $patient->id) }}" method="POST" class="p-6 space-y-4 max-h-96 overflow-y-auto">
            @csrf
            
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Título</label>
                <input type="text" name="title" required placeholder="Ex: Reduzir pressão arterial" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Descrição</label>
                <textarea name="description" rows="2" placeholder="Descreva o objetivo..." class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"></textarea>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Prioridade</label>
                <select name="priority" required class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                    <option value="">Selecione uma prioridade</option>
                    <option value="Mínima">Mínima</option>
                    <option value="Média">Média</option>
                    <option value="Alta">Alta</option>
                </select>
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
                <label class="block text-sm font-medium text-gray-700 mb-1">Data Alvo</label>
                <input type="date" name="target_date" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Métodos de Tratamento</label>
                <input type="text" name="treatment_methods" placeholder="Ex: Acupuntura, Fitoenergética" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>

            <div class="flex gap-2 pt-4">
                <button type="submit" class="flex-1 bg-blue-600 text-white hover:bg-blue-700 px-4 py-2 rounded-lg font-medium transition-all">
                    Criar
                </button>
                <button type="button" onclick="closeObjectiveModal()" class="flex-1 bg-gray-200 text-gray-900 hover:bg-gray-300 px-4 py-2 rounded-lg font-medium transition-all">
                    Cancelar
                </button>
            </div>
        </form>
    </div>
</div>

<script>
function openObjectiveModal() {
    document.getElementById('objectiveModal').classList.remove('hidden');
}

function closeObjectiveModal() {
    document.getElementById('objectiveModal').classList.add('hidden');
}

document.getElementById('objectiveModal').addEventListener('click', function(e) {
    if (e.target === this) {
        closeObjectiveModal();
    }
});

function openMilestoneModal(objectiveId) {
    const form = document.getElementById('milestoneForm');
    const patientId = '{{ $patient->id }}';
    form.action = `/admin/patients/${patientId}/objectives/${objectiveId}/milestones`;
    document.getElementById('milestoneModal').classList.remove('hidden');
}

function closeMilestoneModal() {
    document.getElementById('milestoneModal').classList.add('hidden');
}

document.getElementById('milestoneModal').addEventListener('click', function(e) {
    if (e.target === this) {
        closeMilestoneModal();
    }
});
</script>

<!-- Milestone Modal -->
<div id="milestoneModal" class="hidden fixed inset-0 bg-black bg-opacity-50 z-50 flex items-center justify-center p-4">
    <div class="bg-white rounded-lg shadow-lg max-w-md w-full">
        <div class="border-b border-gray-200 p-6 flex items-center justify-between">
            <h2 class="text-2xl font-bold text-gray-900">Adicionar Marco</h2>
            <button type="button" onclick="closeMilestoneModal()" class="text-gray-500 hover:text-gray-700">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <line x1="18" y1="6" x2="6" y2="18"></line>
                    <line x1="6" y1="6" x2="18" y2="18"></line>
                </svg>
            </button>
        </div>

        <form id="milestoneForm" method="POST" class="p-6 space-y-4">
            @csrf
            
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Descrição do Marco</label>
                <textarea name="description" required rows="2" placeholder="Descreva o marco de progresso..." class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"></textarea>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Data Alvo</label>
                <input type="date" name="target_date" required class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>

            <div class="flex gap-2 pt-4">
                <button type="submit" class="flex-1 bg-blue-600 text-white hover:bg-blue-700 px-4 py-2 rounded-lg font-medium transition-all">
                    Adicionar
                </button>
                <button type="button" onclick="closeMilestoneModal()" class="flex-1 bg-gray-200 text-gray-900 hover:bg-gray-300 px-4 py-2 rounded-lg font-medium transition-all">
                    Cancelar
                </button>
            </div>
        </form>
    </div>
</div>

@endsection
