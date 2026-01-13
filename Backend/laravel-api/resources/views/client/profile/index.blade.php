@extends('client.layout')

@section('title', 'Perfil - QiFlow')

@section('content')
<div class="p-8">
    <!-- Header -->
    <div class="mb-8">
        <h1 class="text-3xl font-bold text-gray-900">Perfil</h1>
        <p class="text-gray-600 mt-2">Gerencie as suas informações pessoais</p>
    </div>

    <!-- Patient Data Section -->
    <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-8 mb-6">
        <h2 class="text-xl font-semibold text-gray-900 mb-6 flex items-center gap-2">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-[#B8860B]" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"></path>
                <circle cx="9" cy="7" r="4"></circle>
            </svg>
            Dados Pessoais
        </h2>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <!-- Name -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Nome Completo</label>
                <p class="text-gray-900">{{ $user->name }}</p>
            </div>

            <!-- Email -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Email</label>
                <p class="text-gray-900">{{ $user->email }}</p>
            </div>

            <!-- Address -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Morada</label>
                <p class="text-gray-900">
                    @if($patient && $patient->address)
                        {{ $patient->address }}
                    @else
                        <span class="text-gray-500">Não informado</span>
                    @endif
                </p>
            </div>

            <!-- Birth Date -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Data de Nascimento</label>
                <p class="text-gray-900">
                    @if($patient && $patient->birth_date)
                        {{ \Carbon\Carbon::parse($patient->birth_date)->format('d/m/Y') }}
                    @else
                        <span class="text-gray-500">Não informado</span>
                    @endif
                </p>
            </div>
        </div>
    </div>

    <!-- Appointment Information Section -->
    <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-8 mb-6">
        <h2 class="text-xl font-semibold text-gray-900 mb-6 flex items-center gap-2">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-[#B8860B]" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <path d="M8 2v4" />
                <path d="M16 2v4" />
                <rect width="18" height="18" x="3" y="4" rx="2" />
                <path d="M3 10h18" />
            </svg>
            Informações de Consultas
        </h2>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <!-- Client Since -->
            <div class="p-4 rounded-lg border border-gray-100 bg-gray-50">
                <p class="text-xs font-semibold text-gray-600 uppercase tracking-widest mb-2">Cliente desde</p>
                <p class="text-lg font-semibold text-gray-900">
                    @if($patient && $patient->client_since)
                        {{ \Carbon\Carbon::parse($patient->client_since)->format('d/m/Y') }}
                    @else
                        <span class="text-gray-500">---</span>
                    @endif
                </p>
            </div>

            <!-- Last Visit -->
            <div class="p-4 rounded-lg border border-gray-100 bg-gray-50">
                <p class="text-xs font-semibold text-gray-600 uppercase tracking-widest mb-2">Última visita</p>
                <p class="text-lg font-semibold text-gray-900">
                    @if($lastVisit)
                        {{ \Carbon\Carbon::parse($lastVisit->appointment_date_time)->format('d/m/Y') }}
                    @else
                        <span class="text-gray-500">---</span>
                    @endif
                </p>
            </div>

            <!-- Next Appointment -->
            <div class="p-4 rounded-lg border border-gray-100 bg-gray-50">
                <p class="text-xs font-semibold text-gray-600 uppercase tracking-widest mb-2">Próxima consulta</p>
                <p class="text-lg font-semibold text-gray-900">
                    @if($nextAppointment)
                        {{ \Carbon\Carbon::parse($nextAppointment->appointment_date_time)->format('d/m/Y') }}
                    @else
                        <span class="text-gray-500">A agendar</span>
                    @endif
                </p>
            </div>
        </div>
    </div>

    <!-- Conditions Section -->
    <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-8 mb-6">
        <h2 class="text-xl font-semibold text-gray-900 mb-6 flex items-center gap-2">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-[#B8860B]" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2z"></path>
                <path d="M12 6v6l4 2"></path>
            </svg>
            Condições
        </h2>

        @if($conditions && count($conditions) > 0)
            <div class="space-y-2">
                @foreach($conditions as $condition)
                    <div class="flex items-center gap-3 p-3 rounded-lg border border-gray-100 bg-gray-50">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-[#B8860B]" viewBox="0 0 24 24" fill="currentColor">
                            <path d="M10 15.172l9.192-9.193a1 1 0 1 1 1.415 1.414l-10.606 10.606a1 1 0 0 1-1.414 0l-4.243-4.243a1 1 0 1 1 1.414-1.414l3.242 3.243z"></path>
                        </svg>
                        <span class="text-gray-900">{{ $condition->name }}</span>
                    </div>
                @endforeach
            </div>
        @else
            <p class="text-gray-500">Nenhuma condição registada</p>
        @endif
    </div>

    <!-- Allergies Section -->
    <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-8 mb-6">
        <h2 class="text-xl font-semibold text-gray-900 mb-6 flex items-center gap-2">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-[#B8860B]" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <path d="M2 9.5a5.5 5.5 0 0 1 9.591-3.676.56.56 0 0 0 .818 0A5.49 5.49 0 0 1 22 9.5c0 2.29-1.5 4-3 5.5l-5.492 5.313a2 2 0 0 1-3 .019L5 15c-1.5-1.5-3-3.2-3-5.5" />
            </svg>
            Alergias
        </h2>

        @if($allergies && count($allergies) > 0)
            <div class="space-y-2">
                @foreach($allergies as $allergy)
                    <div class="flex items-center gap-3 p-3 rounded-lg border border-gray-100 bg-gray-50">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-[#B8860B]" viewBox="0 0 24 24" fill="currentColor">
                            <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm1 15h-2v-2h2v2zm0-4h-2V7h2v6z"></path>
                        </svg>
                        <div class="flex-1">
                            <p class="text-gray-900 font-medium">{{ $allergy->allergen }}</p>
                            @if($allergy->description)
                                <p class="text-gray-600 text-sm">{{ $allergy->description }}</p>
                            @endif
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <p class="text-gray-500">Nenhuma alergia registada</p>
        @endif
    </div>

    <!-- Emergency Contact Section -->
    <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-8 mb-6">
        <h2 class="text-xl font-semibold text-gray-900 mb-6 flex items-center gap-2">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-[#B8860B]" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <path d="M13.832 16.568a1 1 0 0 0 1.213-.303l.355-.465A2 2 0 0 1 17 15h3a2 2 0 0 1 2 2v3a2 2 0 0 1-2 2A18 18 0 0 1 2 4a2 2 0 0 1 2-2h3a2 2 0 0 1 2 2v3a2 2 0 0 1-.8 1.6l-.468.351a1 1 0 0 0-.292 1.233 14 14 0 0 0 6.392 6.384"></path>
            </svg>
            Contacto de Emergência
        </h2>

        @if($patient && $patient->emergency_contact_name)
            <div class="space-y-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Nome</label>
                    <p class="text-gray-900">{{ $patient->emergency_contact_name ?? 'Não informado' }}</p>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Telefone</label>
                    <p class="text-gray-900">{{ $patient->emergency_contact_phone ?? 'Não informado' }}</p>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Relação</label>
                    <p class="text-gray-900">{{ $patient->emergency_contact_relation ?? 'Não informado' }}</p>
                </div>
            </div>
        @else
            <p class="text-gray-500">Nenhum contacto de emergência registado</p>
        @endif
    </div>

    <!-- Subscription Section -->
    <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-8 mb-6">
        <h2 class="text-xl font-semibold text-gray-900 mb-6 flex items-center gap-2">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-[#B8860B]" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"></path>
            </svg>
            Subscrição
        </h2>

        @if($patient && $patient->has_subscription)
            <div class="space-y-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Tipo de Plano</label>
                    <p class="text-lg font-semibold text-green-600">{{ $patient->plan_type }}</p>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Data de Expiração</label>
                    <p class="text-gray-900">{{ \Carbon\Carbon::parse($patient->expiring_subscription_date)->format('d/m/Y') }}</p>
                </div>
                <div class="p-3 rounded-lg bg-green-50 border border-green-200">
                    <p class="text-sm text-green-700 font-medium">✓ Subscrição ativa</p>
                </div>
            </div>
        @else
            <div class="p-3 rounded-lg bg-gray-50 border border-gray-200">
                <p class="text-sm text-gray-600">Nenhuma subscrição ativa</p>
            </div>
        @endif
    </div>

    <!-- Edit Button -->
    <div class="flex gap-3">
        <a href="{{ route('user.profile.edit') }}" class="inline-flex items-center gap-2 bg-[#B8860B] text-white hover:bg-[#B8860B]/90 px-6 py-2 rounded-md font-medium transition-all">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path>
                <path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path>
            </svg>
            Editar Perfil
        </a>
        <button onclick="document.getElementById('allergiesModal').showModal()" class="inline-flex items-center gap-2 bg-[#B8860B] text-white hover:bg-[#B8860B]/90 px-6 py-2 rounded-md font-medium transition-all">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <path d="M2 9.5a5.5 5.5 0 0 1 9.591-3.676.56.56 0 0 0 .818 0A5.49 5.49 0 0 1 22 9.5c0 2.29-1.5 4-3 5.5l-5.492 5.313a2 2 0 0 1-3 .019L5 15c-1.5-1.5-3-3.2-3-5.5" />
            </svg>
            Gerir Alergias
        </button>
    </div>

    <!-- Allergies Modal -->
    <dialog id="allergiesModal" class="rounded-lg shadow-lg p-0 max-w-md w-full">
        <div class="p-6">
            <div class="flex items-center justify-between mb-4">
                <h2 class="text-xl font-semibold text-gray-900">Gerir Alergias</h2>
                <button onclick="document.getElementById('allergiesModal').close()" class="text-gray-500 hover:text-gray-700">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <line x1="18" y1="6" x2="6" y2="18"></line>
                        <line x1="6" y1="6" x2="18" y2="18"></line>
                    </svg>
                </button>
            </div>

            <!-- Add Allergy Form -->
            <form method="POST" action="{{ route('user.allergies.add') }}" class="mb-6">
                @csrf
                <div class="flex gap-2">
                    <select 
                        name="allergy_id"
                        class="flex-1 px-3 py-1 text-sm border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-[#B8860B] focus:border-transparent"
                        required
                        size="1"
                    >
                        <option value="">Selecionar uma alergia...</option>
                        @foreach($allAllergies as $allergy)
                            <option value="{{ $allergy->id }}">{{ $allergy->allergen }}</option>
                        @endforeach
                    </select>
                    <button 
                        type="submit" 
                        class="px-4 py-2 bg-[#B8860B] text-white rounded-lg hover:bg-[#B8860B]/90 transition-all font-medium"
                    >
                        Adicionar
                    </button>
                </div>
            </form>

            <!-- Allergies List -->
            <div class="space-y-2 max-h-64 overflow-y-auto">
                @forelse($allergies as $allergy)
                    <div class="flex items-center justify-between p-3 rounded-lg border border-gray-100 bg-gray-50">
                        <div class="flex-1">
                            <p class="text-gray-900 font-medium">{{ $allergy->allergen }}</p>
                            @if($allergy->description)
                                <p class="text-gray-600 text-sm">{{ $allergy->description }}</p>
                            @endif
                        </div>
                        <form method="POST" action="{{ route('user.allergies.remove') }}" class="inline ml-2">
                            @csrf
                            <input type="hidden" name="allergy_id" value="{{ $allergy->id }}">
                            <button 
                                type="submit" 
                                class="text-red-600 hover:text-red-800 transition-all"
                                onclick="return confirm('Remover esta alergia?')"
                            >
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <polyline points="3 6 5 6 21 6"></polyline>
                                    <path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path>
                                </svg>
                            </button>
                        </form>
                    </div>
                @empty
                    <p class="text-gray-500 text-center py-4">Nenhuma alergia registada</p>
                @endforelse
            </div>
        </div>
    </dialog>
</div>
@endsection
