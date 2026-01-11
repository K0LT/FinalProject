@extends('admin.layout')

@section('admin-content')
<div class="p-8">
    <div class="mb-8 flex items-center justify-between">
        <div>
            <h1 class="text-3xl font-bold text-gray-900">Consultas - {{ $patient->name }} {{ $patient->surname }}</h1>
            <p class="text-gray-600 mt-2">{{ $appointments->count() }} consulta(s)</p>
        </div>
        <div class="flex gap-2">
            <button type="button" onclick="openAppointmentModal()" class="inline-flex items-center gap-2 bg-blue-600 text-white hover:bg-blue-700 px-4 py-2 rounded-lg font-medium transition-all">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <line x1="12" y1="5" x2="12" y2="19"></line>
                    <line x1="5" y1="12" x2="19" y2="12"></line>
                </svg>
                Criar Consulta
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

    @if($appointments->count() > 0)
        <div class="space-y-4">
            @foreach($appointments as $appointment)
                <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6 hover:shadow-md transition-all">
                    <div class="flex items-start justify-between mb-4">
                        <div>
                            <h3 class="text-lg font-semibold text-gray-900">
                                {{ \Carbon\Carbon::parse($appointment->appointment_date_time)->format('d/m/Y H:i') }}
                            </h3>
                            <p class="text-sm text-gray-600 mt-1">
                                @if($appointment->type)
                                    Tipo: {{ $appointment->type }}
                                @else
                                    Tipo: Consulta Geral
                                @endif
                            </p>
                        </div>
                        <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium
                            @if($appointment->status === 'Pendente')
                                bg-yellow-100 text-yellow-800
                            @elseif($appointment->status === 'Confirmado')
                                bg-green-100 text-green-800
                            @elseif($appointment->status === 'Cancelada')
                                bg-red-100 text-red-800
                            @else
                                bg-gray-100 text-gray-800
                            @endif
                        ">
                            {{ $appointment->status }}
                        </span>
                    </div>

                    @if($appointment->notes)
                        <div class="mb-4 p-3 bg-gray-50 rounded border border-gray-200">
                            <p class="text-sm text-gray-700">{{ $appointment->notes }}</p>
                        </div>
                    @endif

                    <div class="flex items-center justify-between pt-4 border-t border-gray-100">
                        <p class="text-sm text-gray-600">Criada em: {{ \Carbon\Carbon::parse($appointment->created_at)->format('d/m/Y H:i') }}</p>
                        <button type="button" onclick="openProgressNoteModal({{ $appointment->id }}, '{{ \Carbon\Carbon::parse($appointment->appointment_date_time)->format('d/m/Y H:i') }}')" class="inline-flex items-center gap-1 text-sm text-blue-600 hover:text-blue-700 font-medium">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path>
                                <path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path>
                            </svg>
                            Criar Nota
                        </button>
                    </div>
                </div>
            @endforeach
        </div>
    @else
        <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6">
            <p class="text-gray-500 text-center py-8">Nenhuma consulta registada</p>
        </div>
    @endif
</div>

<!-- Appointment Modal -->
<div id="appointmentModal" class="hidden fixed inset-0 bg-black bg-opacity-50 z-50 flex items-center justify-center p-4">
    <div class="bg-white rounded-lg shadow-lg max-w-md w-full">
        <div class="border-b border-gray-200 p-6 flex items-center justify-between">
            <h2 class="text-2xl font-bold text-gray-900">Criar Consulta</h2>
            <button type="button" onclick="closeAppointmentModal()" class="text-gray-500 hover:text-gray-700">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <line x1="18" y1="6" x2="6" y2="18"></line>
                    <line x1="6" y1="6" x2="18" y2="18"></line>
                </svg>
            </button>
        </div>

        <form action="{{ route('admin.patient.appointments.store', $patient->id) }}" method="POST" class="p-6 space-y-4">
            @csrf
            
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Data da Consulta</label>
                <input type="date" name="appointment_date" required class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" min="{{ now()->addDay()->format('Y-m-d') }}">
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Hora</label>
                <select name="appointment_time" required class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                    <option value="">Selecione uma hora</option>
                    <option value="09">09:00</option>
                    <option value="10">10:00</option>
                    <option value="11">11:00</option>
                    <option value="12">12:00</option>
                    <option value="13">13:00</option>
                    <option value="14">14:00</option>
                    <option value="15">15:00</option>
                    <option value="16">16:00</option>
                    <option value="17">17:00</option>
                </select>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Tipo de Consulta</label>
                <input type="text" name="type" placeholder="Ex: Consulta Geral" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Notas</label>
                <textarea name="notes" rows="3" placeholder="Adicione notas..." class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"></textarea>
            </div>

            <div class="flex gap-2 pt-4">
                <button type="submit" class="flex-1 bg-blue-600 text-white hover:bg-blue-700 px-4 py-2 rounded-lg font-medium transition-all">
                    Criar
                </button>
                <button type="button" onclick="closeAppointmentModal()" class="flex-1 bg-gray-200 text-gray-900 hover:bg-gray-300 px-4 py-2 rounded-lg font-medium transition-all">
                    Cancelar
                </button>
            </div>
        </form>
    </div>
</div>

<script>
function openAppointmentModal() {
    document.getElementById('appointmentModal').classList.remove('hidden');
}

function closeAppointmentModal() {
    document.getElementById('appointmentModal').classList.add('hidden');
}

document.getElementById('appointmentModal').addEventListener('click', function(e) {
    if (e.target === this) {
        closeAppointmentModal();
    }
});

function openProgressNoteModal(appointmentId, appointmentDate) {
    document.getElementById('appointmentIdInput').value = appointmentId;
    document.getElementById('appointmentDateDisplay').textContent = appointmentDate;
    document.getElementById('progressNoteModal').classList.remove('hidden');
}

function closeProgressNoteModal() {
    document.getElementById('progressNoteModal').classList.add('hidden');
    document.getElementById('progressNoteForm').reset();
}

document.getElementById('progressNoteModal').addEventListener('click', function(e) {
    if (e.target === this) {
        closeProgressNoteModal();
    }
});
</script>

<!-- Progress Note Modal -->
<div id="progressNoteModal" class="hidden fixed inset-0 bg-black bg-opacity-50 z-50 flex items-center justify-center p-4">
    <div class="bg-white rounded-lg shadow-lg max-w-2xl w-full">
        <div class="border-b border-gray-200 p-6 flex items-center justify-between">
            <div>
                <h2 class="text-2xl font-bold text-gray-900">Criar Nota de Progresso</h2>
                <p class="text-sm text-gray-600 mt-1">Consulta: <span id="appointmentDateDisplay"></span></p>
            </div>
            <button type="button" onclick="closeProgressNoteModal()" class="text-gray-500 hover:text-gray-700">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <line x1="18" y1="6" x2="6" y2="18"></line>
                    <line x1="6" y1="6" x2="18" y2="18"></line>
                </svg>
            </button>
        </div>

        <form id="progressNoteForm" action="{{ route('admin.patient.progress-notes.store', $patient->id) }}" method="POST" class="p-6 space-y-4 max-h-96 overflow-y-auto">
            @csrf
            <input type="hidden" id="appointmentIdInput" name="appointment_id">
            
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Subjetivo</label>
                <textarea name="subjective" rows="3" placeholder="O que o paciente relata..." class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"></textarea>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Objetivo</label>
                <textarea name="objective" rows="3" placeholder="Observações clínicas..." class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"></textarea>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Avaliação</label>
                <textarea name="assessment" rows="3" placeholder="Análise e diagnóstico..." class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"></textarea>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Plano</label>
                <textarea name="plan" rows="3" placeholder="Plano de tratamento..." class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"></textarea>
            </div>

            <div class="flex gap-2 pt-4">
                <button type="submit" class="flex-1 bg-blue-600 text-white hover:bg-blue-700 px-4 py-2 rounded-lg font-medium transition-all">
                    Criar Nota
                </button>
                <button type="button" onclick="closeProgressNoteModal()" class="flex-1 bg-gray-200 text-gray-900 hover:bg-gray-300 px-4 py-2 rounded-lg font-medium transition-all">
                    Cancelar
                </button>
            </div>
        </form>
    </div>
</div>

@endsection
