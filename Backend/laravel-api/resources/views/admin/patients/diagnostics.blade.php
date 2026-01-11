@extends('admin.layout')

@section('admin-content')
<div class="p-8">
    <div class="mb-8 flex items-center justify-between">
        <div>
            <h1 class="text-3xl font-bold text-gray-900">Diagnósticos - {{ $patient->name }} {{ $patient->surname }}</h1>
            <p class="text-gray-600 mt-2">{{ $diagnostics->count() }} diagnóstico(s)</p>
        </div>
        <div class="flex gap-2">
            <button type="button" onclick="openDiagnosticModal()" class="inline-flex items-center gap-2 bg-blue-600 text-white hover:bg-blue-700 px-4 py-2 rounded-lg font-medium transition-all">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <line x1="12" y1="5" x2="12" y2="19"></line>
                    <line x1="5" y1="12" x2="19" y2="12"></line>
                </svg>
                Criar Diagnóstico
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

    @if($diagnostics->count() > 0)
        <div class="space-y-4">
            @foreach($diagnostics as $diagnostic)
                <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6 hover:shadow-md transition-all">
                    <div class="mb-4">
                        <h3 class="text-lg font-semibold text-gray-900">
                            @if($diagnostic->western_diagnosis)
                                {{ $diagnostic->western_diagnosis }}
                            @elseif($diagnostic->tcm_diagnosis)
                                {{ $diagnostic->tcm_diagnosis }}
                            @else
                                Diagnóstico
                            @endif
                        </h3>
                        <p class="text-sm text-gray-600 mt-1">
                            Data do Diagnóstico: {{ \Carbon\Carbon::parse($diagnostic->diagnostic_date)->format('d/m/Y') }}
                        </p>
                    </div>

                    <div class="grid grid-cols-2 gap-4 mb-4">
                        @if($diagnostic->western_diagnosis)
                            <div class="p-3 bg-blue-50 rounded border border-blue-200">
                                <p class="text-xs font-medium text-blue-700">Diagnóstico Ocidental</p>
                                <p class="text-sm text-gray-900 mt-1">{{ $diagnostic->western_diagnosis }}</p>
                            </div>
                        @endif
                        
                        @if($diagnostic->tcm_diagnosis)
                            <div class="p-3 bg-green-50 rounded border border-green-200">
                                <p class="text-xs font-medium text-green-700">Diagnóstico TCM</p>
                                <p class="text-sm text-gray-900 mt-1">{{ $diagnostic->tcm_diagnosis }}</p>
                            </div>
                        @endif
                    </div>

                    @if($diagnostic->severity)
                        <div class="mb-4 p-3 bg-gray-50 rounded border border-gray-200">
                            <p class="text-xs font-medium text-gray-600">Severidade</p>
                            <p class="text-sm text-gray-900 mt-1">{{ $diagnostic->severity }}</p>
                        </div>
                    @endif

                    @if($diagnostic->symptoms->count() > 0)
                        <div class="mt-4">
                            <p class="text-sm font-medium text-gray-700 mb-2">Sintomas:</p>
                            <div class="space-y-2">
                                @foreach($diagnostic->symptoms as $symptom)
                                    <div class="flex items-start gap-2 p-2 rounded bg-yellow-50">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-yellow-600 mt-0.5" viewBox="0 0 24 24" fill="currentColor">
                                            <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm1 15h-2v-2h2v2zm0-4h-2V7h2v6z"></path>
                                        </svg>
                                        <div>
                                            <p class="text-sm font-medium text-gray-900">{{ $symptom->name }}</p>
                                            @if($symptom->description)
                                                <p class="text-xs text-gray-600 mt-0.5">{{ $symptom->description }}</p>
                                            @endif
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endif

                    @if($diagnostic->treatments->count() > 0)
                        <div class="mt-4">
                            <p class="text-sm font-medium text-gray-700 mb-2">Tratamentos Associados:</p>
                            <div class="space-y-2">
                                @foreach($diagnostic->treatments as $treatment)
                                    <button type="button" onclick="openTreatmentModal({{ $treatment->id }}, '{{ $treatment->session_date_time ? \Carbon\Carbon::parse($treatment->session_date_time)->format('d/m/Y H:i') : 'Sem data' }}', '{{ $treatment->treatment_methods ?? '' }}', '{{ $treatment->acupoints_used ?? '' }}', '{{ $treatment->duration ?? '' }}', '{{ $treatment->notes ?? '' }}', '{{ $treatment->next_session ? \Carbon\Carbon::parse($treatment->next_session)->format('d/m/Y') : '' }}')" class="w-full text-left flex items-start gap-2 p-3 rounded bg-blue-50 hover:bg-blue-100 transition-all cursor-pointer border border-blue-200">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-blue-600 mt-0.5 flex-shrink-0" viewBox="0 0 24 24" fill="currentColor">
                                            <path d="M10 15.172l9.192-9.193a1 1 0 1 1 1.415 1.414l-10.606 10.606a1 1 0 0 1-1.414 0l-4.243-4.243a1 1 0 1 1 1.414-1.414l3.242 3.243z"></path>
                                        </svg>
                                        <div class="flex-1">
                                            <p class="text-sm font-medium text-gray-900">{{ $treatment->session_date_time ? \Carbon\Carbon::parse($treatment->session_date_time)->format('d/m/Y H:i') : 'Sem data' }}</p>
                                            @if($treatment->treatment_methods)
                                                <p class="text-xs text-gray-600 mt-0.5">{{ $treatment->treatment_methods }}</p>
                                            @endif
                                        </div>
                                    </button>
                                @endforeach
                            </div>
                        </div>
                    @endif
                </div>
            @endforeach
        </div>
    @else
        <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6">
            <p class="text-gray-500 text-center py-8">Nenhum diagnóstico registado</p>
        </div>
    @endif
</div>

<!-- Treatment Modal -->
<div id="treatmentModal" class="hidden fixed inset-0 bg-black bg-opacity-50 z-50 flex items-center justify-center p-4">
    <div class="bg-white rounded-lg shadow-lg max-w-2xl w-full max-h-96 overflow-y-auto">
        <div class="sticky top-0 bg-white border-b border-gray-200 p-6 flex items-center justify-between">
            <h2 class="text-2xl font-bold text-gray-900">Detalhes do Tratamento</h2>
            <button type="button" onclick="closeTreatmentModal()" class="text-gray-500 hover:text-gray-700">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <line x1="18" y1="6" x2="6" y2="18"></line>
                    <line x1="6" y1="6" x2="18" y2="18"></line>
                </svg>
            </button>
        </div>

        <div class="p-6 space-y-4">
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Métodos de Tratamento</label>
                <p class="text-gray-900" id="modalTreatmentMethods">-</p>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Pontos de Acupuntura</label>
                <p class="text-gray-900" id="modalAcupointsUsed">-</p>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Duração</label>
                <p class="text-gray-900" id="modalDuration">-</p>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Notas</label>
                <p class="text-gray-900 whitespace-pre-wrap" id="modalNotes">-</p>
            </div>
        </div>
    </div>
</div>

<script>
function openTreatmentModal(id, sessionDate, treatmentMethods, acupointsUsed, duration, notes, nextSession) {
    document.getElementById('modalTreatmentMethods').textContent = treatmentMethods || '-';
    document.getElementById('modalAcupointsUsed').textContent = acupointsUsed || '-';
    document.getElementById('modalDuration').textContent = duration ? duration + ' min' : '-';
    document.getElementById('modalNotes').textContent = notes || '-';
    document.getElementById('treatmentModal').classList.remove('hidden');
}

function closeTreatmentModal() {
    document.getElementById('treatmentModal').classList.add('hidden');
}

document.getElementById('treatmentModal').addEventListener('click', function(e) {
    if (e.target === this) {
        closeTreatmentModal();
    }
});
</script>

<!-- Diagnostic Modal -->
<div id="diagnosticModal" class="hidden fixed inset-0 bg-black bg-opacity-50 z-50 flex items-center justify-center p-4">
    <div class="bg-white rounded-lg shadow-lg max-w-md w-full">
        <div class="border-b border-gray-200 p-6 flex items-center justify-between">
            <h2 class="text-2xl font-bold text-gray-900">Criar Diagnóstico</h2>
            <button type="button" onclick="closeDiagnosticModal()" class="text-gray-500 hover:text-gray-700">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <line x1="18" y1="6" x2="6" y2="18"></line>
                    <line x1="6" y1="6" x2="18" y2="18"></line>
                </svg>
            </button>
        </div>

        <form action="{{ route('admin.patient.diagnostics.store', $patient->id) }}" method="POST" class="p-6 space-y-4 max-h-96 overflow-y-auto">
            @csrf
            
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Data do Diagnóstico</label>
                <input type="date" name="diagnostic_date" required class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Diagnóstico Ocidental</label>
                <input type="text" name="western_diagnosis" placeholder="Ex: Hipertensão" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Diagnóstico TCM</label>
                <input type="text" name="tcm_diagnosis" placeholder="Ex: Deficiência de Yin" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Severidade</label>
                <input type="text" name="severity" placeholder="Ex: Moderada" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Qualidade do Pulso</label>
                <input type="text" name="pulse_quality" placeholder="Ex: Rápido e Fraco" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Descrição da Língua</label>
                <textarea name="tongue_description" rows="2" placeholder="Descreva a língua..." class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"></textarea>
            </div>

            <div class="flex gap-2 pt-4">
                <button type="submit" class="flex-1 bg-blue-600 text-white hover:bg-blue-700 px-4 py-2 rounded-lg font-medium transition-all">
                    Criar
                </button>
                <button type="button" onclick="closeDiagnosticModal()" class="flex-1 bg-gray-200 text-gray-900 hover:bg-gray-300 px-4 py-2 rounded-lg font-medium transition-all">
                    Cancelar
                </button>
            </div>
        </form>
    </div>
</div>

<script>
function openDiagnosticModal() {
    document.getElementById('diagnosticModal').classList.remove('hidden');
}

function closeDiagnosticModal() {
    document.getElementById('diagnosticModal').classList.add('hidden');
}

document.getElementById('diagnosticModal').addEventListener('click', function(e) {
    if (e.target === this) {
        closeDiagnosticModal();
    }
});
</script>

@endsection

