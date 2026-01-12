@extends('admin.layout')

@section('admin-content')
<div class="p-8">
    <div class="mb-8">
        <h1 class="text-3xl font-bold text-gray-900">Clientes com Plano</h1>
        <p class="text-gray-600 mt-2">{{ $clients->total() }} cliente(s)</p>
    </div>

    @if($clients->count() > 0)
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach($clients as $patient)
                <a href="{{ route('admin.patient.detail', $patient->user->id) }}" class="bg-white rounded-lg shadow-sm border border-gray-200 p-6 hover:shadow-lg hover:border-blue-300 transition-all cursor-pointer">
                    <div class="flex items-start justify-between mb-4">
                        <div>
                            <h3 class="text-lg font-semibold text-gray-900">{{ $patient->user->name }} {{ $patient->user->surname }}</h3>
                            <p class="text-sm text-gray-600 mt-1">{{ $patient->user->email }}</p>
                        </div>
                    </div>

                    <div class="space-y-3 text-sm">
                        @if($patient->phone_number)
                            <div class="flex items-center gap-2 text-gray-600">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"></path>
                                </svg>
                                <span>{{ $patient->phone_number }}</span>
                            </div>
                        @endif

                        @if($patient->client_since)
                            <div class="flex items-center gap-2 text-gray-600">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect>
                                    <line x1="16" y1="2" x2="16" y2="6"></line>
                                    <line x1="8" y1="2" x2="8" y2="6"></line>
                                    <line x1="3" y1="10" x2="21" y2="10"></line>
                                </svg>
                                <span>Cliente desde {{ \Carbon\Carbon::parse($patient->client_since)->format('d/m/Y') }}</span>
                            </div>
                        @endif

                        @if($patient->plan_type)
                            <div class="flex items-center gap-2 text-green-600 font-medium">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-2 15l-5-5 1.41-1.41L10 14.17l7.59-7.59L19 8l-9 9z"></path>
                                </svg>
                                <span>{{ $patient->plan_type }}</span>
                            </div>
                        @endif

                        @if($patient->expiring_subscription_date)
                            <div class="flex items-center gap-2 text-gray-600">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <circle cx="12" cy="12" r="10"></circle>
                                    <polyline points="12 6 12 12 16 14"></polyline>
                                </svg>
                                <span>Expira em {{ \Carbon\Carbon::parse($patient->expiring_subscription_date)->format('d/m/Y') }}</span>
                            </div>
                        @endif

                        @if($patient->appointments->count() > 0)
                            <div class="flex items-center gap-2 text-gray-600">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M8 2v4m8-4v4M3 10h18v10a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V10z"></path>
                                </svg>
                                <span>{{ $patient->appointments->count() }} consulta(s)</span>
                            </div>
                        @endif

                        @if($patient->treatmentGoals->count() > 0)
                            <div class="flex items-center gap-2 text-gray-600">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <circle cx="12" cy="12" r="10"></circle>
                                    <polyline points="12 6 12 12 16 14"></polyline>
                                </svg>
                                <span>{{ $patient->treatmentGoals->count() }} objetivo(s)</span>
                            </div>
                        @endif
                    </div>

                    <div class="mt-4 pt-4 border-t border-gray-200">
                        <p class="text-xs text-gray-500">Clique para ver detalhes completos</p>
                    </div>
                </a>
            @endforeach
        </div>

        <!-- Pagination -->
        <div class="mt-8 flex items-center justify-between">
            <div class="text-sm text-gray-600">
                Mostrando {{ $clients->firstItem() }} a {{ $clients->lastItem() }} de {{ $clients->total() }} clientes
            </div>
            <div class="flex gap-2">
                @if($clients->onFirstPage())
                    <button disabled class="px-4 py-2 rounded-lg bg-gray-200 text-gray-500 cursor-not-allowed">
                        Anterior
                    </button>
                @else
                    <a href="{{ $clients->previousPageUrl() }}" class="px-4 py-2 rounded-lg bg-blue-600 text-white hover:bg-blue-700 transition-all">
                        Anterior
                    </a>
                @endif

                @foreach($clients->getUrlRange(1, $clients->lastPage()) as $page => $url)
                    @if($page == $clients->currentPage())
                        <button disabled class="px-4 py-2 rounded-lg bg-blue-600 text-white font-medium">
                            {{ $page }}
                        </button>
                    @else
                        <a href="{{ $url }}" class="px-4 py-2 rounded-lg bg-gray-200 text-gray-900 hover:bg-gray-300 transition-all">
                            {{ $page }}
                        </a>
                    @endif
                @endforeach

                @if($clients->hasMorePages())
                    <a href="{{ $clients->nextPageUrl() }}" class="px-4 py-2 rounded-lg bg-blue-600 text-white hover:bg-blue-700 transition-all">
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
            <p class="text-gray-500 text-center py-8">Nenhum cliente com plano ativo</p>
        </div>
    @endif
</div>

@endsection
