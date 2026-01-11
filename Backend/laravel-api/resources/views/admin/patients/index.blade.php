@extends('admin.layout')

@section('admin-content')
<div class="p-8">
    <!-- Header -->
    <div class="mb-8">
        <h1 class="text-3xl font-bold text-gray-900">Pacientes</h1>
        <p class="text-gray-600 mt-2">Gerencie todos os pacientes do sistema</p>
    </div>

    <!-- Patients Grid -->
    @if($patients->count() > 0)
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mb-8">
            @foreach($patients as $patientUser)
                <a href="{{ route('admin.patient.detail', $patientUser->id) }}" class="bg-white rounded-lg shadow-sm border border-gray-200 p-6 hover:shadow-md hover:border-gray-300 transition-all cursor-pointer">
                    <div class="flex items-start justify-between mb-4">
                        <div class="flex-1">
                            <h3 class="text-lg font-semibold text-gray-900">{{ $patientUser->name }} {{ $patientUser->surname }}</h3>
                            <p class="text-sm text-gray-600 mt-1">{{ $patientUser->email }}</p>
                        </div>
                    </div>

                    <div class="space-y-3 text-sm">
                        <div class="flex items-center gap-2 text-gray-600">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"></path>
                            </svg>
                            <span>{{ $patientUser->patient->phone_number ?? 'N/A' }}</span>
                        </div>

                        <div class="flex items-center gap-2 text-gray-600">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M8 2v4m8-4v4M3 10h18v10a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V10z"></path>
                            </svg>
                            <span>{{ \Carbon\Carbon::parse($patientUser->created_at)->format('d/m/Y') }}</span>
                        </div>

                        <div class="flex items-center gap-2 text-gray-600">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"></path>
                                <circle cx="9" cy="7" r="4"></circle>
                            </svg>
                            <span>Cliente desde {{ \Carbon\Carbon::parse($patientUser->patient->client_since)->format('d/m/Y') }}</span>
                        </div>
                    </div>

                    <div class="mt-4 pt-4 border-t border-gray-100">
                        <p class="text-xs text-gray-500">Clique para ver detalhes</p>
                    </div>
                </a>
            @endforeach
        </div>

        <!-- Pagination -->
        <div class="flex justify-center">
            {{ $patients->links() }}
        </div>
    @else
        <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-12 text-center">
            <p class="text-gray-500">Nenhum paciente encontrado</p>
        </div>
    @endif
</div>
@endsection
