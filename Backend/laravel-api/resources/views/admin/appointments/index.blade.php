@extends('admin.layout')

@section('admin-content')
<div class="p-8">
    <div class="mb-8">
        <h1 class="text-3xl font-bold text-gray-900">Consultas</h1>
        <p class="text-gray-600 mt-2">Visão geral de todas as consultas</p>
    </div>

    <!-- Today's Appointments -->
    <div class="mb-8">
        <h2 class="text-2xl font-bold text-gray-900 mb-4">Consultas de Hoje</h2>
        @if($todayAppointments->count() > 0)
            <div class="space-y-3">
                @foreach($todayAppointments as $appointment)
                    <a href="{{ route('admin.patient.appointments', $appointment->patient->user->id) }}" class="block bg-white rounded-lg shadow-sm border border-gray-200 p-4 hover:shadow-md transition-all cursor-pointer">
                        <div class="flex items-start justify-between">
                            <div class="flex-1">
                                <div class="flex items-center gap-3">
                                    <h3 class="text-lg text-gray-900">
                                        {{ $appointment->patient->user->name }} {{ $appointment->patient->user->surname }}
                                    </h3>
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs
                                        @if($appointment->status === 'Pendente') bg-yellow-100 text-yellow-800
                                        @elseif($appointment->status === 'Confirmado') bg-green-100 text-green-800
                                        @elseif($appointment->status === 'Cancelado') bg-red-100 text-red-800
                                        @else bg-blue-100 text-blue-800
                                        @endif">
                                        {{ $appointment->status }}
                                    </span>
                                </div>
                                <div class="mt-2 grid grid-cols-2 gap-4 text-sm text-gray-600">
                                    <div>
                                        <p class="text-gray-700">Data/Hora:</p>
                                        <p>{{ \Carbon\Carbon::parse($appointment->appointment_date_time)->format('d/m/Y H:i') }}</p>
                                    </div>
                                    <div>
                                        <p class="text-gray-700">Tipo:</p>
                                        <p>{{ $appointment->type ?? '-' }}</p>
                                    </div>
                                </div>
                                @if($appointment->notes)
                                    <div class="mt-2 p-2 bg-gray-50 rounded">
                                        <p class="text-xs text-gray-700">Notas:</p>
                                        <p class="text-sm text-gray-600">{{ $appointment->notes }}</p>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </a>
                @endforeach
            </div>
        @else
            <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6">
                <p class="text-gray-500 text-center py-4">Nenhuma consulta agendada para hoje</p>
            </div>
        @endif
    </div>

    <!-- Pending Appointments -->
    <div class="mb-8">
        <h2 class="text-2xl font-bold text-gray-900 mb-4">Consultas Pendentes (Hoje em diante)</h2>
        @if($pendingAppointments->count() > 0)
            <div class="space-y-3">
                @foreach($pendingAppointments as $appointment)
                    <a href="{{ route('admin.patient.appointments', $appointment->patient->user->id) }}" class="block bg-white rounded-lg shadow-sm border border-yellow-200 p-4 hover:shadow-md transition-all cursor-pointer">
                        <div class="flex items-start justify-between">
                            <div class="flex-1">
                                <div class="flex items-center gap-3">
                                    <h3 class="text-lg text-gray-900">
                                        {{ $appointment->patient->user->name }} {{ $appointment->patient->user->surname }}
                                    </h3>
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs bg-yellow-100 text-yellow-800">
                                        Pendente
                                    </span>
                                </div>
                                <div class="mt-2 grid grid-cols-2 gap-4 text-sm text-gray-600">
                                    <div>
                                        <p class="text-gray-700">Data/Hora:</p>
                                        <p>{{ \Carbon\Carbon::parse($appointment->appointment_date_time)->format('d/m/Y H:i') }}</p>
                                    </div>
                                    <div>
                                        <p class="text-gray-700">Tipo:</p>
                                        <p>{{ $appointment->type ?? '-' }}</p>
                                    </div>
                                </div>
                                @if($appointment->notes)
                                    <div class="mt-2 p-2 bg-gray-50 rounded">
                                        <p class="text-xs text-gray-700">Notas:</p>
                                        <p class="text-sm text-gray-600">{{ $appointment->notes }}</p>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </a>
                @endforeach
            </div>
        @else
            <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6">
                <p class="text-gray-500 text-center py-4">Nenhuma consulta pendente</p>
            </div>
        @endif
    </div>

    <!-- Completed Appointments -->
    <div class="mb-8">
        <h2 class="text-2xl font-bold text-gray-900 mb-4">Consultas Concluídas (Hoje para trás)</h2>
        @if($completedAppointments->count() > 0)
            <div class="space-y-3">
                @foreach($completedAppointments as $appointment)
                    <a href="{{ route('admin.patient.appointments', $appointment->patient->user->id) }}" class="block bg-white rounded-lg shadow-sm border border-blue-200 p-4 hover:shadow-md transition-all cursor-pointer">
                        <div class="flex items-start justify-between">
                            <div class="flex-1">
                                <div class="flex items-center gap-3">
                                    <h3 class="text-lg text-gray-900">
                                        {{ $appointment->patient->user->name }} {{ $appointment->patient->user->surname }}
                                    </h3>
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs bg-blue-100 text-blue-800">
                                        Concluído
                                    </span>
                                </div>
                                <div class="mt-2 grid grid-cols-2 gap-4 text-sm text-gray-600">
                                    <div>
                                        <p class="text-gray-700">Data/Hora:</p>
                                        <p>{{ \Carbon\Carbon::parse($appointment->appointment_date_time)->format('d/m/Y H:i') }}</p>
                                    </div>
                                    <div>
                                        <p class="text-gray-700">Tipo:</p>
                                        <p>{{ $appointment->type ?? '-' }}</p>
                                    </div>
                                </div>
                                @if($appointment->notes)
                                    <div class="mt-2 p-2 bg-gray-50 rounded">
                                        <p class="text-xs text-gray-700">Notas:</p>
                                        <p class="text-sm text-gray-600">{{ $appointment->notes }}</p>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </a>
                @endforeach
            </div>

            <!-- Pagination -->
            <div class="mt-6 flex items-center justify-between">
                <div class="text-sm text-gray-600">
                    Mostrando {{ $completedAppointments->firstItem() }} a {{ $completedAppointments->lastItem() }} de {{ $completedAppointments->total() }} consultas
                </div>
                <div class="flex gap-2">
                    @if($completedAppointments->onFirstPage())
                        <button disabled class="px-4 py-2 rounded-lg bg-gray-200 text-gray-500 cursor-not-allowed">
                            Anterior
                        </button>
                    @else
                        <a href="{{ $completedAppointments->previousPageUrl() }}" class="px-4 py-2 rounded-lg bg-blue-600 text-white hover:bg-blue-700 transition-all">
                            Anterior
                        </a>
                    @endif

                    @foreach($completedAppointments->getUrlRange(1, $completedAppointments->lastPage()) as $page => $url)
                        @if($page == $completedAppointments->currentPage())
                            <button disabled class="px-4 py-2 rounded-lg bg-blue-600 text-white font-medium">
                                {{ $page }}
                            </button>
                        @else
                            <a href="{{ $url }}" class="px-4 py-2 rounded-lg bg-gray-200 text-gray-900 hover:bg-gray-300 transition-all">
                                {{ $page }}
                            </a>
                        @endif
                    @endforeach

                    @if($completedAppointments->hasMorePages())
                        <a href="{{ $completedAppointments->nextPageUrl() }}" class="px-4 py-2 rounded-lg bg-blue-600 text-white hover:bg-blue-700 transition-all">
                            Próximo
                        </a>
                    @else
                        <button disabled class="px-4 py-2 rounded-lg bg-gray-200 text-gray-500 cursor-not-allowed">
                            Próximo
                        </button>
                    @endif
                </div>
            </div>
        @else
            <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6">
                <p class="text-gray-500 text-center py-4">Nenhuma consulta concluída</p>
            </div>
        @endif
    </div>
</div>

@endsection
