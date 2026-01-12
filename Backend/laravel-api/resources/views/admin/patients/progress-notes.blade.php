@extends('admin.layout')

@section('admin-content')
<div class="p-8">
    <div class="mb-8 flex items-center justify-between">
        <div>
            <h1 class="text-3xl font-bold text-gray-900">Notas de Progresso - {{ $patient->name }} {{ $patient->surname }}</h1>
            <p class="text-gray-600 mt-2">{{ $progressNotes->count() }} nota(s)</p>
        </div>
        <a href="{{ route('admin.patient.detail', $patient->id) }}" class="inline-flex items-center gap-2 bg-gray-200 text-gray-900 hover:bg-gray-300 px-4 py-2 rounded-lg font-medium transition-all">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <line x1="19" y1="12" x2="5" y2="12"></line>
                <polyline points="12 19 5 12 12 5"></polyline>
            </svg>
            Voltar
        </a>
    </div>

    @if($progressNotes->count() > 0)
        <div class="space-y-4">
            @foreach($progressNotes as $note)
                <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6 hover:shadow-md transition-all">
                    <div class="mb-4">
                        <h3 class="text-lg text-gray-900">Nota de Progresso</h3>
                        <div class="flex items-center gap-4 mt-2">
                            <p class="text-sm text-gray-600">
                                Data: {{ \Carbon\Carbon::parse($note->note_date)->format('d/m/Y') }}
                            </p>
                            @if($note->appointment)
                                <p class="text-sm text-gray-600">
                                    Consulta: {{ \Carbon\Carbon::parse($note->appointment->appointment_date_time)->format('d/m/Y H:i') }}
                                </p>
                                @if($note->appointment->type)
                                    <p class="text-sm text-gray-600">
                                        Tipo: {{ $note->appointment->type }}
                                    </p>
                                @endif
                            @endif
                        </div>
                    </div>

                    @if($note->subjective)
                        <div class="mb-4">
                            <h4 class="text-sm text-gray-700 mb-2">Subjetivo</h4>
                            <div class="p-3 bg-blue-50 rounded border border-blue-200">
                                <p class="text-sm text-gray-700">{{ $note->subjective }}</p>
                            </div>
                        </div>
                    @endif

                    @if($note->objective)
                        <div class="mb-4">
                            <h4 class="text-sm text-gray-700 mb-2">Objetivo</h4>
                            <div class="p-3 bg-green-50 rounded border border-green-200">
                                <p class="text-sm text-gray-700">{{ $note->objective }}</p>
                            </div>
                        </div>
                    @endif

                    @if($note->assessment)
                        <div class="mb-4">
                            <h4 class="text-sm text-gray-700 mb-2">Avaliação</h4>
                            <div class="p-3 bg-yellow-50 rounded border border-yellow-200">
                                <p class="text-sm text-gray-700">{{ $note->assessment }}</p>
                            </div>
                        </div>
                    @endif

                    @if($note->plan)
                        <div class="mb-4">
                            <h4 class="text-sm text-gray-700 mb-2">Plano</h4>
                            <div class="p-3 bg-purple-50 rounded border border-purple-200">
                                <p class="text-sm text-gray-700">{{ $note->plan }}</p>
                            </div>
                        </div>
                    @endif

                    <div class="mt-4 text-xs text-gray-500">
                        Registada em: {{ \Carbon\Carbon::parse($note->created_at)->format('d/m/Y H:i') }}
                    </div>
                </div>
            @endforeach
        </div>
    @else
        <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6">
            <p class="text-gray-500 text-center py-8">Nenhuma nota de progresso registada</p>
        </div>
    @endif
</div>
@endsection
