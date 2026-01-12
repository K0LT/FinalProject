@extends('admin.layout')

@section('admin-content')
<div class="p-8">
    <!-- Header -->
    <div class="mb-8">
        <h1 class="text-3xl font-bold text-gray-900">Dashboard Admin</h1>
        <p class="text-gray-600 mt-2">Bem-vindo ao painel de administração</p>
    </div>

    <!-- Stats Cards -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
        <!-- Today's Appointments -->
        <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-gray-600">Consultas Hoje</p>
                    <p class="text-3xl font-bold text-gray-900 mt-2">{{ $todayAppointments->count() }}</p>
                </div>
                <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 text-blue-500 opacity-20" viewBox="0 0 24 24" fill="currentColor">
                    <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm0 18c-4.41 0-8-3.59-8-8s3.59-8 8-8 8 3.59 8 8-3.59 8-8 8zm3.5-9c.83 0 1.5-.67 1.5-1.5S16.33 8 15.5 8 14 8.67 14 9.5s.67 1.5 1.5 1.5zm-7 0c.83 0 1.5-.67 1.5-1.5S9.33 8 8.5 8 7 8.67 7 9.5 7.67 11 8.5 11zm3.5 6.5c2.33 0 4.31-1.46 5.11-3.5H6.89c.8 2.04 2.78 3.5 5.11 3.5z"/>
                </svg>
            </div>
        </div>

        <!-- Pending Appointments -->
        <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-gray-600">Consultas Pendentes</p>
                    <p class="text-3xl font-bold text-gray-900 mt-2">{{ $pendingAppointmentsCount }}</p>
                </div>
                <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 text-yellow-500 opacity-20" viewBox="0 0 24 24" fill="currentColor">
                    <path d="M8 2v4m8-4v4M3 10h18v10a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V10z"/>
                </svg>
            </div>
        </div>

        <!-- New Users (Last 30 days) -->
        <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-gray-600">Novos Utilizadores (30 dias)</p>
                    <p class="text-3xl font-bold text-gray-900 mt-2">{{ $newUsersCount }}</p>
                </div>
                <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 text-green-500 opacity-20" viewBox="0 0 24 24" fill="currentColor">
                    <path d="M16 11c1.66 0 2.99-1.34 2.99-3S17.66 5 16 5c-1.66 0-3 1.34-3 3s1.34 3 3 3zm-8 0c1.66 0 2.99-1.34 2.99-3S9.66 5 8 5C6.34 5 5 6.34 5 8s1.34 3 3 3zm0 2c-2.33 0-7 1.17-7 3.5V19h14v-2.5c0-2.33-4.67-3.5-7-3.5zm8 0c-.29 0-.62.02-.97.05 1.16.84 1.97 1.97 1.97 3.45V19h6v-2.5c0-2.33-4.67-3.5-7-3.5z"/>
                </svg>
            </div>
        </div>
    </div>

    <!-- Today's Appointments Section -->
    <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6 mb-8">
        <h2 class="text-xl font-semibold text-gray-900 mb-6">Consultas de Hoje</h2>
        
        @if($todayAppointments->count() > 0)
            <div class="space-y-3">
                @foreach($todayAppointments as $appointment)
                    <a href="{{ route('admin.patient.detail', $appointment->patient->user->id) }}" class="flex items-center justify-between p-4 rounded-lg border border-gray-200 hover:border-gray-300 hover:bg-gray-50 transition-colors cursor-pointer">
                        <div class="flex-1">
                            <p class="font-semibold text-gray-900">
                                {{ $appointment->patient->user->name }} {{ $appointment->patient->user->surname }}
                            </p>
                            <p class="text-sm text-gray-600 mt-1">
                                {{ \Carbon\Carbon::parse($appointment->appointment_date_time)->format('H:i') }}
                                @if($appointment->type)
                                    • {{ $appointment->type }}
                                @endif
                            </p>
                            <div class="text-sm text-gray-500 mt-2 space-y-1">
                                <p>📧 {{ $appointment->patient->user->email }}</p>
                                <p>📱 {{ $appointment->patient->phone_number ?? 'N/A' }}</p>
                            </div>
                        </div>
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
                    </a>
                @endforeach
            </div>
        @else
            <p class="text-gray-500 text-center py-8">Nenhuma consulta hoje</p>
        @endif
    </div>

    <!-- Pending Appointments Section -->
    <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6 mb-8">
        <h2 class="text-xl font-semibold text-gray-900 mb-6">Consultas Pendentes (Hoje em diante)</h2>
        
        @if($pendingAppointments->count() > 0)
            <div class="space-y-3">
                @foreach($pendingAppointments as $appointment)
                    <a href="{{ route('admin.patient.detail', $appointment->patient->user->id) }}" class="flex items-center justify-between p-4 rounded-lg border border-gray-200 hover:border-gray-300 hover:bg-gray-50 transition-colors cursor-pointer">
                        <div class="flex-1">
                            <p class="font-semibold text-gray-900">
                                {{ $appointment->patient->user->name }} {{ $appointment->patient->user->surname }}
                            </p>
                            <p class="text-sm text-gray-600 mt-1">
                                {{ \Carbon\Carbon::parse($appointment->appointment_date_time)->format('d/m/Y H:i') }}
                                @if($appointment->type)
                                    • {{ $appointment->type }}
                                @endif
                            </p>
                            <div class="text-sm text-gray-500 mt-2 space-y-1">
                                <p>📧 {{ $appointment->patient->user->email }}</p>
                                <p>📱 {{ $appointment->patient->phone_number ?? 'N/A' }}</p>
                            </div>
                        </div>
                        <span class="inline-block px-3 py-1 bg-yellow-100 text-yellow-800 rounded-full text-sm font-medium">
                            Pendente
                        </span>
                    </a>
                @endforeach
            </div>

            <!-- Pagination -->
            <div class="mt-6 flex items-center justify-between">
                <div class="text-sm text-gray-600">
                    Mostrando {{ $pendingAppointments->firstItem() }} a {{ $pendingAppointments->lastItem() }} de {{ $pendingAppointments->total() }} consultas
                </div>
                <div class="flex gap-2">
                    @if($pendingAppointments->onFirstPage())
                        <button disabled class="px-3 py-1 rounded border border-gray-300 text-gray-400 cursor-not-allowed">Anterior</button>
                    @else
                        <a href="{{ $pendingAppointments->previousPageUrl() }}" class="px-3 py-1 rounded border border-gray-300 text-gray-700 hover:bg-gray-50">Anterior</a>
                    @endif

                    @foreach($pendingAppointments->getUrlRange(1, $pendingAppointments->lastPage()) as $page => $url)
                        @if($page == $pendingAppointments->currentPage())
                            <button disabled class="px-3 py-1 rounded bg-blue-600 text-white">{{ $page }}</button>
                        @else
                            <a href="{{ $url }}" class="px-3 py-1 rounded border border-gray-300 text-gray-700 hover:bg-gray-50">{{ $page }}</a>
                        @endif
                    @endforeach

                    @if($pendingAppointments->hasMorePages())
                        <a href="{{ $pendingAppointments->nextPageUrl() }}" class="px-3 py-1 rounded border border-gray-300 text-gray-700 hover:bg-gray-50">Próxima</a>
                    @else
                        <button disabled class="px-3 py-1 rounded border border-gray-300 text-gray-400 cursor-not-allowed">Próxima</button>
                    @endif
                </div>
            </div>
        @else
            <p class="text-gray-500 text-center py-8">Nenhuma consulta pendente</p>
        @endif
    </div>

    <!-- New Users Section -->
    <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6">
        <h2 class="text-xl font-semibold text-gray-900 mb-6">Novos Utilizadores (Últimos 30 dias)</h2>
        
        @if($newUsers->count() > 0)
            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead>
                        <tr class="border-b border-gray-200">
                            <th class="text-left py-3 px-4 text-sm font-semibold text-gray-700">Nome</th>
                            <th class="text-left py-3 px-4 text-sm font-semibold text-gray-700">Email</th>
                            <th class="text-left py-3 px-4 text-sm font-semibold text-gray-700">Data de Registo</th>
                            <th class="text-left py-3 px-4 text-sm font-semibold text-gray-700">Role</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($newUsers as $newUser)
                            <tr class="border-b border-gray-100 hover:bg-gray-50 cursor-pointer">
                                <td class="py-3 px-4 text-sm">
                                    <a href="{{ route('admin.patient.detail', $newUser->id) }}" class="text-gray-900 hover:text-blue-600 font-medium">
                                        {{ $newUser->name }} {{ $newUser->surname }}
                                    </a>
                                </td>
                                <td class="py-3 px-4 text-sm text-gray-600">
                                    {{ $newUser->email }}
                                </td>
                                <td class="py-3 px-4 text-sm text-gray-600">
                                    {{ \Carbon\Carbon::parse($newUser->created_at)->format('d/m/Y H:i') }}
                                </td>
                                <td class="py-3 px-4 text-sm">
                                    <span class="inline-block px-2 py-1 bg-blue-100 text-blue-800 rounded text-xs font-medium">
                                        {{ $newUser->role->name ?? 'N/A' }}
                                    </span>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @else
            <p class="text-gray-500 text-center py-8">Nenhum utilizador novo nos últimos 30 dias</p>
        @endif
    </div>
</div>
@endsection
