@extends('client.layout')

@section('title', 'Consultas - QiFlow')

@section('content')
<div class="p-8">
    <!-- Header -->
    <div class="mb-8">
        <h1 class="text-3xl font-bold text-gray-900">Consultas</h1>
        <p class="text-gray-600 mt-2">Histórico e detalhes das suas consultas</p>
    </div>

    <!-- Request Appointment Button -->
    <div class="mb-8">
        <a 
            href="{{ route('user.request-appointment') }}" 
            class="inline-flex items-center gap-2 bg-[#B8860B] text-white hover:bg-[#B8860B]/90 px-6 py-2 rounded-lg font-medium transition-all"
        >
            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <path d="M12 5v14M5 12h14"></path>
            </svg>
            Pedir Consulta
        </a>
    </div>

    <!-- Appointments List -->
    @if($appointments && count($appointments) > 0)
        <div class="space-y-4">
            @foreach($appointments as $appointment)
                <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6 hover:shadow-md transition-shadow">
                    <!-- Appointment Header -->
                    <div class="flex items-start justify-between mb-4">
                        <div class="flex-1">
                            <!-- Date and Time -->
                            <div class="flex items-center gap-3 mb-2">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-[#B8860B]" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M8 2v4" />
                                    <path d="M16 2v4" />
                                    <rect width="18" height="18" x="3" y="4" rx="2" />
                                    <path d="M3 10h18" />
                                </svg>
                                <span class="text-lg font-semibold text-gray-900">
                                    {{ \Carbon\Carbon::parse($appointment->appointment_date_time)->format('d/m/Y H:i') }}
                                </span>
                            </div>

                            <!-- Type -->
                            @if($appointment->type)
                                <div class="flex items-center gap-2 text-sm text-gray-600">
                                    <span class="inline-block px-2 py-1 bg-blue-100 text-blue-800 rounded text-xs font-medium">
                                        {{ $appointment->type }}
                                    </span>
                                </div>
                            @endif
                        </div>

                        <!-- Status Badge -->
                        <div class="ml-4">
                            @php
                                $statusColors = [
                                    'Pendente' => 'bg-yellow-100 text-yellow-800',
                                    'Confirmado' => 'bg-green-100 text-green-800',
                                    'Cancelado' => 'bg-red-100 text-red-800',
                                    'Concluído' => 'bg-blue-100 text-blue-800',
                                ];
                                $statusColor = $statusColors[$appointment->status] ?? 'bg-gray-100 text-gray-800';
                            @endphp
                            <span class="inline-block px-3 py-1 {{ $statusColor }} rounded-full text-sm font-medium">
                                {{ $appointment->status }}
                            </span>
                        </div>
                    </div>

                    <!-- Appointment Details -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 pt-4 border-t border-gray-100">
                        <!-- Duration -->
                        @if($appointment->duration)
                            <div>
                                <label class="block text-xs font-semibold text-gray-600 uppercase tracking-widest mb-1">Duração</label>
                                <p class="text-gray-900">{{ $appointment->duration }} minutos</p>
                            </div>
                        @endif

                        <!-- Type Info -->
                        @if($appointment->type)
                            <div>
                                <label class="block text-xs font-semibold text-gray-600 uppercase tracking-widest mb-1">Tipo de Consulta</label>
                                <p class="text-gray-900">{{ $appointment->type }}</p>
                            </div>
                        @endif
                    </div>

                    <!-- Notes -->
                    @if($appointment->notes)
                        <div class="mt-4 pt-4 border-t border-gray-100">
                            <label class="block text-xs font-semibold text-gray-600 uppercase tracking-widest mb-2">Notas</label>
                            <p class="text-gray-700 text-sm leading-relaxed">{{ $appointment->notes }}</p>
                        </div>
                    @endif
                </div>
            @endforeach
        </div>
    @else
        <!-- Empty State -->
        <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-12 text-center">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-16 w-16 text-gray-300 mx-auto mb-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <path d="M8 2v4" />
                <path d="M16 2v4" />
                <rect width="18" height="18" x="3" y="4" rx="2" />
                <path d="M3 10h18" />
            </svg>
            <h3 class="text-lg font-semibold text-gray-900 mb-2">Nenhuma consulta registada</h3>
            <p class="text-gray-600">Não tem consultas agendadas ou concluídas no momento.</p>
        </div>
    @endif
</div>
@endsection
