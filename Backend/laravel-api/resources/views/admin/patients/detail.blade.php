@extends('admin.layout')

@section('admin-content')
<div class="p-8">
    <!-- Header -->
    <div class="mb-8 flex items-center justify-between">
        <div>
            <h1 class="text-3xl font-bold text-gray-900">{{ $patient->name }} {{ $patient->surname }}</h1>
            <p class="text-gray-600 mt-2">Informações do paciente</p>
        </div>
        <a href="{{ route('admin.patients') }}" class="inline-flex items-center gap-2 bg-gray-200 text-gray-900 hover:bg-gray-300 px-4 py-2 rounded-lg font-medium transition-all">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <line x1="19" y1="12" x2="5" y2="12"></line>
                <polyline points="12 19 5 12 12 5"></polyline>
            </svg>
            Voltar
        </a>
    </div>

    <!-- Personal Information -->
    <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6 mb-6">
        <h2 class="text-xl font-semibold text-gray-900 mb-4">Informações Pessoais</h2>
        
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Nome Completo</label>
                <p class="text-gray-900">{{ $patient->name }} {{ $patient->surname }}</p>
            </div>
            
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Email</label>
                <p class="text-gray-900">{{ $patient->email }}</p>
            </div>
            
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Telefone</label>
                <p class="text-gray-900">{{ $patientData->phone_number ?? 'N/A' }}</p>
            </div>
            
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Data de Registo</label>
                <p class="text-gray-900">{{ \Carbon\Carbon::parse($patient->created_at)->format('d/m/Y H:i') }}</p>
            </div>
            
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Morada</label>
                <p class="text-gray-900">{{ $patientData->address ?? 'N/A' }}</p>
            </div>
            
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Data de Nascimento</label>
                <p class="text-gray-900">
                    @if($patientData->birth_date)
                        {{ \Carbon\Carbon::parse($patientData->birth_date)->format('d/m/Y') }}
                    @else
                        N/A
                    @endif
                </p>
            </div>
            
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Género</label>
                <p class="text-gray-900">{{ $patientData->gender ?? 'N/A' }}</p>
            </div>
            
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Cliente Desde</label>
                <p class="text-gray-900">
                    @if($patientData->client_since)
                        {{ \Carbon\Carbon::parse($patientData->client_since)->format('d/m/Y') }}
                    @else
                        N/A
                    @endif
                </p>
            </div>
        </div>
    </div>

    <!-- Emergency Contact -->
    <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6 mb-6">
        <h2 class="text-xl font-semibold text-gray-900 mb-4">Contacto de Emergência</h2>
        
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Nome</label>
                <p class="text-gray-900">{{ $patientData->emergency_contact_name ?? 'N/A' }}</p>
            </div>
            
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Telefone</label>
                <p class="text-gray-900">{{ $patientData->emergency_contact_phone ?? 'N/A' }}</p>
            </div>
            
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Relação</label>
                <p class="text-gray-900">{{ $patientData->emergency_contact_relation ?? 'N/A' }}</p>
            </div>
        </div>
    </div>

    <!-- Statistics -->
    <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-6">
        <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6">
            <p class="text-sm font-medium text-gray-600">Próxima Consulta</p>
            <p class="text-3xl font-bold text-gray-900 mt-2">
                @if($nextAppointment)
                    {{ \Carbon\Carbon::parse($nextAppointment->appointment_date_time)->format('d/m/Y H:i') }}
                @else
                    N/A
                @endif
            </p>
        </div>
        
        <a href="{{ route('admin.patient.appointments', $patient->id) }}" class="bg-white rounded-lg shadow-sm border border-gray-200 p-6 hover:shadow-md hover:border-gray-300 transition-all cursor-pointer">
            <p class="text-sm font-medium text-gray-600">Consultas</p>
            <p class="text-3xl font-bold text-gray-900 mt-2">{{ $patientData->appointments->count() }}</p>
        </a>
        
        <a href="{{ route('admin.patient.diagnostics', $patient->id) }}" class="bg-white rounded-lg shadow-sm border border-gray-200 p-6 hover:shadow-md hover:border-gray-300 transition-all cursor-pointer">
            <p class="text-sm font-medium text-gray-600">Diagnósticos</p>
            <p class="text-3xl font-bold text-gray-900 mt-2">{{ $patientData->diagnostics->count() }}</p>
        </a>
        
        <a href="{{ route('admin.patient.exercises', $patient->id) }}" class="bg-white rounded-lg shadow-sm border border-gray-200 p-6 hover:shadow-md hover:border-gray-300 transition-all cursor-pointer">
            <p class="text-sm font-medium text-gray-600">Exercícios</p>
            <p class="text-3xl font-bold text-gray-900 mt-2">{{ $patientData->exercises->count() }}</p>
        </a>
    </div>

    <!-- Additional Statistics -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">
        <a href="{{ route('admin.patient.objectives', $patient->id) }}" class="bg-white rounded-lg shadow-sm border border-gray-200 p-6 hover:shadow-md hover:border-gray-300 transition-all cursor-pointer">
            <p class="text-sm font-medium text-gray-600">Objetivos</p>
            <p class="text-3xl font-bold text-gray-900 mt-2">{{ $patientData->treatmentGoals->count() }}</p>
        </a>
        
        <a href="{{ route('admin.patient.progress-notes', $patient->id) }}" class="bg-white rounded-lg shadow-sm border border-gray-200 p-6 hover:shadow-md hover:border-gray-300 transition-all cursor-pointer">
            <p class="text-sm font-medium text-gray-600">Notas de Progresso</p>
            <p class="text-3xl font-bold text-gray-900 mt-2">{{ $patientData->progressNotes->count() }}</p>
        </a>
        
        <a href="{{ route('admin.patient.health-control', $patient->id) }}" class="bg-white rounded-lg shadow-sm border border-gray-200 p-6 hover:shadow-md hover:border-gray-300 transition-all cursor-pointer">
            <p class="text-sm font-medium text-gray-600">Controlo de Saúde</p>
            <p class="text-3xl font-bold text-gray-900 mt-2">{{ $patientData->weightTrackings->count() }}</p>
        </a>
    </div>

    <!-- Conditions and Allergies -->
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <!-- Conditions -->
        <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6">
            <div class="flex items-center justify-between mb-4">
                <h2 class="text-xl font-semibold text-gray-900">Condições</h2>
                <button type="button" onclick="openConditionModal()" class="inline-flex items-center gap-1 text-sm text-blue-600 hover:text-blue-700 font-medium">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <line x1="12" y1="5" x2="12" y2="19"></line>
                        <line x1="5" y1="12" x2="19" y2="12"></line>
                    </svg>
                    Adicionar
                </button>
            </div>
            
            @if($patientData->conditions->count() > 0)
                <div class="space-y-2">
                    @foreach($patientData->conditions as $condition)
                      <div class="flex items-center gap-2 p-2 rounded bg-gray-50">
    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-blue-600" viewBox="0 0 24 24" fill="currentColor">
        <path d="M10 15.172l9.192-9.193a1 1 0 1 1 1.415 1.414l-10.606 10.606a1 1 0 0 1-1.414 0l-4.243-4.243a1 1 0 1 1 1.414-1.414l3.242 3.243z"></path>
    </svg>

    <span class="text-gray-900">{{ $condition->name }}</span>

    <span class="ml-auto text-gray-900">
        {{ $condition->status }}
    </span>
</div>
                    @endforeach
                </div>
            @else
                <p class="text-gray-500">Nenhuma condição registada</p>
            @endif
        </div>

        <!-- Allergies -->
        <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6">
            <div class="flex items-center justify-between mb-4">
                <h2 class="text-xl font-semibold text-gray-900">Alergias</h2>
                <button type="button" onclick="openAllergyModal()" class="inline-flex items-center gap-1 text-sm text-blue-600 hover:text-blue-700 font-medium">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <line x1="12" y1="5" x2="12" y2="19"></line>
                        <line x1="5" y1="12" x2="19" y2="12"></line>
                    </svg>
                    Adicionar
                </button>
            </div>
            
            @if($patientData->allergies->count() > 0)
                <div class="space-y-2">
                    @foreach($patientData->allergies as $allergy)
                        <div class="flex items-center gap-2 p-2 rounded bg-red-50">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-red-600" viewBox="0 0 24 24" fill="currentColor">
                                <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm1 15h-2v-2h2v2zm0-4h-2V7h2v6z"></path>
                            </svg>
                            <span class="text-gray-900">{{ $allergy->allergen }}</span>
                        </div>
                    @endforeach
                </div>
            @else
                <p class="text-gray-500">Nenhuma alergia registada</p>
            @endif
        </div>
    </div>
</div>

<!-- Condition Modal -->
<div id="conditionModal" class="hidden fixed inset-0 bg-black bg-opacity-50 z-50 flex items-center justify-center p-4">
    <div class="bg-white rounded-lg shadow-lg max-w-md w-full">
        <div class="border-b border-gray-200 p-6 flex items-center justify-between">
            <h2 class="text-2xl font-bold text-gray-900">Adicionar Condição</h2>
            <button type="button" onclick="closeConditionModal()" class="text-gray-500 hover:text-gray-700">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <line x1="18" y1="6" x2="6" y2="18"></line>
                    <line x1="6" y1="6" x2="18" y2="18"></line>
                </svg>
            </button>
        </div>

        <form action="{{ route('admin.patient.conditions.store', $patient->id) }}" method="POST" class="p-6 space-y-4">
            @csrf
            
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Nome da Condição</label>
                <input type="text" name="name" required placeholder="Ex: Hipertensão" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Data de Diagnóstico</label>
                <input type="date" name="diagnosed_date" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Status</label>
                <select name="status" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                    <option value="">Selecione um status</option>
                    <option value="Ativa">Ativa</option>
                    <option value="Inativa">Inativa</option>
                    <option value="Resolvida">Resolvida</option>
                </select>
            </div>

            <div class="flex gap-2 pt-4">
                <button type="submit" class="flex-1 bg-blue-600 text-white hover:bg-blue-700 px-4 py-2 rounded-lg font-medium transition-all">
                    Adicionar
                </button>
                <button type="button" onclick="closeConditionModal()" class="flex-1 bg-gray-200 text-gray-900 hover:bg-gray-300 px-4 py-2 rounded-lg font-medium transition-all">
                    Cancelar
                </button>
            </div>
        </form>
    </div>
</div>

<!-- Allergy Modal -->
<div id="allergyModal" class="hidden fixed inset-0 bg-black bg-opacity-50 z-50 flex items-center justify-center p-4">
    <div class="bg-white rounded-lg shadow-lg max-w-md w-full">
        <div class="border-b border-gray-200 p-6 flex items-center justify-between">
            <h2 class="text-2xl font-bold text-gray-900">Adicionar Alergia</h2>
            <button type="button" onclick="closeAllergyModal()" class="text-gray-500 hover:text-gray-700">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <line x1="18" y1="6" x2="6" y2="18"></line>
                    <line x1="6" y1="6" x2="18" y2="18"></line>
                </svg>
            </button>
        </div>

        <form action="{{ route('admin.patient.allergies.store', $patient->id) }}" method="POST" class="p-6 space-y-4">
            @csrf
            
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Alergia</label>
                <select name="allergy_id" required class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                    <option value="">Selecione uma alergia</option>
                    @foreach($allergies as $allergy)
                        <option value="{{ $allergy->id }}">{{ $allergy->allergen }} - {{ $allergy->description }}</option>
                    @endforeach
                </select>
            </div>

            <div class="flex gap-2 pt-4">
                <button type="submit" class="flex-1 bg-blue-600 text-white hover:bg-blue-700 px-4 py-2 rounded-lg font-medium transition-all">
                    Adicionar
                </button>
                <button type="button" onclick="closeAllergyModal()" class="flex-1 bg-gray-200 text-gray-900 hover:bg-gray-300 px-4 py-2 rounded-lg font-medium transition-all">
                    Cancelar
                </button>
            </div>
        </form>
    </div>
</div>

<script>
function openConditionModal() {
    document.getElementById('conditionModal').classList.remove('hidden');
}

function closeConditionModal() {
    document.getElementById('conditionModal').classList.add('hidden');
}

document.getElementById('conditionModal').addEventListener('click', function(e) {
    if (e.target === this) {
        closeConditionModal();
    }
});

function openAllergyModal() {
    document.getElementById('allergyModal').classList.remove('hidden');
}

function closeAllergyModal() {
    document.getElementById('allergyModal').classList.add('hidden');
}

document.getElementById('allergyModal').addEventListener('click', function(e) {
    if (e.target === this) {
        closeAllergyModal();
    }
});
</script>

@endsection
