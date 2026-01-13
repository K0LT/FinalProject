@extends('client.layout')

@section('title', 'Diagnósticos e Tratamentos - QiFlow')

@section('content')
<div class="p-8">
    <!-- Header -->
    <div class="mb-8">
        <h1 class="text-3xl font-bold text-gray-900">Diagnósticos e Tratamentos</h1>
        <p class="text-gray-600 mt-2">Histórico completo de diagnósticos, tratamentos e progresso</p>
    </div>

    @if($diagnostics && count($diagnostics) > 0)
        <div class="space-y-6">
            @foreach($diagnostics as $diagnostic)
                <!-- Diagnostic Card -->
                <div class="bg-white rounded-lg shadow-sm border border-gray-200 overflow-hidden">
                    <!-- Diagnostic Header -->
                    <div class="bg-gradient-to-r from-[#B8860B]/10 to-[#B8860B]/5 p-6 border-b border-gray-200">
                        <div class="flex items-start justify-between mb-4">
                            <div>
                                <h3 class="text-xl font-semibold text-gray-900 mb-2">Diagnóstico</h3>
                                <p class="text-sm text-gray-600">
                                    {{ \Carbon\Carbon::parse($diagnostic->diagnostic_date)->format('d/m/Y') }}
                                </p>
                            </div>
                            @if($diagnostic->severity)
                                <span class="inline-block px-3 py-1 bg-orange-100 text-orange-800 rounded-full text-sm font-medium">
                                    Severidade: {{ $diagnostic->severity }}
                                </span>
                            @endif
                        </div>
                    </div>

                    <!-- Diagnostic Details -->
                    <div class="p-6 space-y-6">
                        <!-- Western and TCM Diagnosis -->
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            @if($diagnostic->western_diagnosis)
                                <div>
                                    <label class="block text-sm font-semibold text-gray-700 mb-2">Diagnóstico Ocidental</label>
                                    <p class="text-gray-900">{{ $diagnostic->western_diagnosis }}</p>
                                </div>
                            @endif

                            @if($diagnostic->tcm_diagnosis)
                                <div>
                                    <label class="block text-sm font-semibold text-gray-700 mb-2">Diagnóstico TCM</label>
                                    <p class="text-gray-900">{{ $diagnostic->tcm_diagnosis }}</p>
                                </div>
                            @endif
                        </div>

                        <!-- Pulse and Tongue -->
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 pt-4 border-t border-gray-100">
                            @if($diagnostic->pulse_quality)
                                <div>
                                    <label class="block text-sm font-semibold text-gray-700 mb-2">Qualidade do Pulso</label>
                                    <p class="text-gray-900">{{ $diagnostic->pulse_quality }}</p>
                                </div>
                            @endif

                            @if($diagnostic->tongue_description)
                                <div>
                                    <label class="block text-sm font-semibold text-gray-700 mb-2">Descrição da Língua</label>
                                    <p class="text-gray-900">{{ $diagnostic->tongue_description }}</p>
                                </div>
                            @endif
                        </div>

                        <!-- Treatments Section -->
                        @if($diagnostic->treatments && count($diagnostic->treatments) > 0)
                            <div class="pt-6 border-t border-gray-200">
                                <h4 class="text-lg font-semibold text-gray-900 mb-4">Tratamentos</h4>
                                <div class="space-y-4">
                                    @foreach($diagnostic->treatments as $treatment)
                                        <div class="bg-blue-50 rounded-lg p-4 border border-blue-100">
                                            <!-- Treatment Header -->
                                            <div class="flex items-start justify-between mb-3">
                                                <div>
                                                    <p class="font-semibold text-gray-900">
                                                        {{ \Carbon\Carbon::parse($treatment->session_date_time)->format('d/m/Y H:i') }}
                                                    </p>
                                                    <p class="text-sm text-gray-600">Sessão de Tratamento</p>
                                                </div>
                                                @if($treatment->duration)
                                                    <span class="text-sm font-medium text-gray-700">
                                                        {{ $treatment->duration }} min
                                                    </span>
                                                @endif
                                            </div>

                                            <!-- Treatment Details -->
                                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 text-sm">
                                                @if($treatment->treatment_methods)
                                                    <div>
                                                        <label class="block font-medium text-gray-700 mb-1">Métodos de Tratamento</label>
                                                        <p class="text-gray-900">{{ $treatment->treatment_methods }}</p>
                                                    </div>
                                                @endif

                                                @if($treatment->acupoints_used)
                                                    <div>
                                                        <label class="block font-medium text-gray-700 mb-1">Pontos de Acupuntura</label>
                                                        <p class="text-gray-900">{{ $treatment->acupoints_used }}</p>
                                                    </div>
                                                @endif
                                            </div>

                                            @if($treatment->notes)
                                                <div class="mt-3 pt-3 border-t border-blue-200">
                                                    <label class="block text-sm font-medium text-gray-700 mb-1">Notas</label>
                                                    <p class="text-gray-900 text-sm">{{ $treatment->notes }}</p>
                                                </div>
                                            @endif

                                            @if($treatment->next_session)
                                                <div class="mt-3 pt-3 border-t border-blue-200">
                                                    <label class="block text-sm font-medium text-gray-700 mb-1">Próxima Sessão</label>
                                                    <p class="text-gray-900 text-sm">
                                                        {{ \Carbon\Carbon::parse($treatment->next_session)->format('d/m/Y') }}
                                                    </p>
                                                </div>
                                            @endif
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        @endif

                        <!-- Progress Notes Section -->
                        @if($diagnostic->progressNotes && count($diagnostic->progressNotes) > 0)
                            <div class="pt-6 border-t border-gray-200">
                                <h4 class="text-lg font-semibold text-gray-900 mb-4">Notas de Progresso</h4>
                                <div class="space-y-4">
                                    @foreach($diagnostic->progressNotes as $note)
                                        <div class="bg-green-50 rounded-lg p-4 border border-green-100">
                                            <!-- Note Header -->
                                            <div class="mb-3">
                                                <p class="font-semibold text-gray-900">
                                                    {{ \Carbon\Carbon::parse($note->note_date)->format('d/m/Y') }}
                                                </p>
                                            </div>

                                            <!-- SOAP Notes -->
                                            <div class="space-y-3 text-sm">
                                                @if($note->subjective)
                                                    <div>
                                                        <label class="block font-medium text-gray-700 mb-1">Subjetivo (S)</label>
                                                        <p class="text-gray-900">{{ $note->subjective }}</p>
                                                    </div>
                                                @endif

                                                @if($note->objective)
                                                    <div>
                                                        <label class="block font-medium text-gray-700 mb-1">Objetivo (O)</label>
                                                        <p class="text-gray-900">{{ $note->objective }}</p>
                                                    </div>
                                                @endif

                                                @if($note->assessment)
                                                    <div>
                                                        <label class="block font-medium text-gray-700 mb-1">Avaliação (A)</label>
                                                        <p class="text-gray-900">{{ $note->assessment }}</p>
                                                    </div>
                                                @endif

                                                @if($note->plan)
                                                    <div>
                                                        <label class="block font-medium text-gray-700 mb-1">Plano (P)</label>
                                                        <p class="text-gray-900">{{ $note->plan }}</p>
                                                    </div>
                                                @endif
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            @endforeach
        </div>

        <!-- Progress Notes Section (Separate) -->
        @if($progressNotes && count($progressNotes) > 0)
            <div class="mt-8 pt-8 border-t-2 border-gray-300">
                <h2 class="text-2xl font-bold text-gray-900 mb-6">Todas as Notas de Progresso</h2>
                <div class="space-y-4">
                    @foreach($progressNotes as $note)
                        <div class="bg-green-50 rounded-lg p-6 border border-green-100">
                            <!-- Note Header -->
                            <div class="flex items-start justify-between mb-4">
                                <div>
                                    <p class="font-semibold text-gray-900">
                                        {{ \Carbon\Carbon::parse($note->note_date)->format('d/m/Y') }}
                                    </p>
                                    @if($note->appointment)
                                        <p class="text-sm text-gray-600">
                                            Consulta: {{ \Carbon\Carbon::parse($note->appointment->appointment_date_time)->format('d/m/Y H:i') }}
                                        </p>
                                    @endif
                                </div>
                            </div>

                            <!-- SOAP Notes -->
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                @if($note->subjective)
                                    <div class="bg-white rounded p-3 border border-green-200">
                                        <label class="block font-semibold text-gray-700 mb-2 text-sm">Subjetivo (S)</label>
                                        <p class="text-gray-900 text-sm">{{ $note->subjective }}</p>
                                    </div>
                                @endif

                                @if($note->objective)
                                    <div class="bg-white rounded p-3 border border-green-200">
                                        <label class="block font-semibold text-gray-700 mb-2 text-sm">Objetivo (O)</label>
                                        <p class="text-gray-900 text-sm">{{ $note->objective }}</p>
                                    </div>
                                @endif

                                @if($note->assessment)
                                    <div class="bg-white rounded p-3 border border-green-200">
                                        <label class="block font-semibold text-gray-700 mb-2 text-sm">Avaliação (A)</label>
                                        <p class="text-gray-900 text-sm">{{ $note->assessment }}</p>
                                    </div>
                                @endif

                                @if($note->plan)
                                    <div class="bg-white rounded p-3 border border-green-200">
                                        <label class="block font-semibold text-gray-700 mb-2 text-sm">Plano (P)</label>
                                        <p class="text-gray-900 text-sm">{{ $note->plan }}</p>
                                    </div>
                                @endif
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        @endif
    @else
        <!-- Empty State -->
        <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-12 text-center">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-16 w-16 text-gray-300 mx-auto mb-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2z"></path>
                <path d="M12 6v6l4 2"></path>
            </svg>
            <h3 class="text-lg font-semibold text-gray-900 mb-2">Nenhum diagnóstico registado</h3>
            <p class="text-gray-600">Não tem diagnósticos ou tratamentos registados no momento.</p>
        </div>
    @endif
</div>
@endsection
