@extends('client.layout')

@section('title', 'Pedir Consulta - QiFlow')

@section('content')
<div class="p-8">
    <!-- Header -->
    <div class="mb-8">
        <h1 class="text-3xl font-bold text-gray-900">Pedir Consulta</h1>
        <p class="text-gray-600 mt-2">Solicite uma nova consulta com o seu terapeuta</p>
    </div>

    <!-- Form Container -->
    <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-8 max-w-2xl">
        <form method="POST" action="{{ route('user.request-appointment.store') }}" class="space-y-6">
            @csrf

            <!-- Date -->
            <div>
                <label for="appointment_date" class="block text-sm font-medium text-gray-700 mb-2">
                    Data da Consulta *
                </label>
                <input 
                    type="date" 
                    id="appointment_date" 
                    name="appointment_date"
                    value="{{ old('appointment_date') }}"
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-[#B8860B] focus:border-transparent @error('appointment_date_time') border-red-500 @enderror"
                    required
                >
            </div>

            <!-- Time -->
            <div>
                <label for="appointment_time" class="block text-sm font-medium text-gray-700 mb-2">
                    Hora da Consulta *
                </label>
                <select 
                    id="appointment_time" 
                    name="appointment_time"
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-[#B8860B] focus:border-transparent @error('appointment_date_time') border-red-500 @enderror"
                    required
                >
                    <option value="">Selecione uma hora</option>
                    <option value="09" {{ old('appointment_time') === '09' ? 'selected' : '' }}>09:00</option>
                    <option value="10" {{ old('appointment_time') === '10' ? 'selected' : '' }}>10:00</option>
                    <option value="11" {{ old('appointment_time') === '11' ? 'selected' : '' }}>11:00</option>
                    <option value="12" {{ old('appointment_time') === '12' ? 'selected' : '' }}>12:00</option>
                    <option value="13" {{ old('appointment_time') === '13' ? 'selected' : '' }}>13:00</option>
                    <option value="14" {{ old('appointment_time') === '14' ? 'selected' : '' }}>14:00</option>
                    <option value="15" {{ old('appointment_time') === '15' ? 'selected' : '' }}>15:00</option>
                    <option value="16" {{ old('appointment_time') === '16' ? 'selected' : '' }}>16:00</option>
                    <option value="17" {{ old('appointment_time') === '17' ? 'selected' : '' }}>17:00</option>
                </select>
                @error('appointment_date_time')
                    <p class="text-red-600 text-sm mt-2">{{ $message }}</p>
                @enderror
                <p class="text-xs text-gray-500 mt-2">Horário disponível entre as 09:00 e as 17:00</p>
            </div>

            <!-- Type -->
            <div>
                <label for="type" class="block text-sm font-medium text-gray-700 mb-2">
                    Tipo de Consulta
                </label>
                <select 
                    id="type" 
                    name="type"
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-[#B8860B] focus:border-transparent @error('type') border-red-500 @enderror"
                >
                    <option value="">Selecione um tipo</option>
                    <option value="Acupuntura" {{ old('type') === 'Acupuntura' ? 'selected' : '' }}>Acupuntura</option>
                    <option value="Massagem" {{ old('type') === 'Massagem' ? 'selected' : '' }}>Massagem</option>
                    <option value="Consulta" {{ old('type') === 'Consulta' ? 'selected' : '' }}>Consulta</option>
                    <option value="Avaliação" {{ old('type') === 'Avaliação' ? 'selected' : '' }}>Avaliação</option>
                    <option value="Seguimento" {{ old('type') === 'Seguimento' ? 'selected' : '' }}>Seguimento</option>
                </select>
                @error('type')
                    <p class="text-red-600 text-sm mt-2">{{ $message }}</p>
                @enderror
            </div>

            <!-- Notes -->
            <div>
                <label for="notes" class="block text-sm font-medium text-gray-700 mb-2">
                    Notas Adicionais
                </label>
                <textarea 
                    id="notes" 
                    name="notes"
                    rows="4"
                    placeholder="Descreva qualquer informação relevante para a consulta..."
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-[#B8860B] focus:border-transparent @error('notes') border-red-500 @enderror"
                >{{ old('notes') }}</textarea>
                @error('notes')
                    <p class="text-red-600 text-sm mt-2">{{ $message }}</p>
                @enderror
            </div>

            <!-- Info Box -->
            <div class="p-4 rounded-lg border border-blue-200 bg-blue-50">
                <p class="text-sm text-blue-900">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 inline mr-2" viewBox="0 0 24 24" fill="currentColor">
                        <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm1 15h-2v-2h2v2zm0-4h-2V7h2v6z"></path>
                    </svg>
                    A sua consulta será criada com o estado "Pendente" e será confirmada pelo terapeuta.
                </p>
            </div>

            <!-- Buttons -->
            <div class="flex gap-3 pt-4">
                <button 
                    type="submit" 
                    class="inline-flex items-center gap-2 bg-[#B8860B] text-white hover:bg-[#B8860B]/90 px-6 py-2 rounded-lg font-medium transition-all"
                >
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M12 5v14M5 12h14"></path>
                    </svg>
                    Solicitar Consulta
                </button>
                <a 
                    href="{{ route('user.appointments') }}" 
                    class="inline-flex items-center gap-2 bg-gray-200 text-gray-900 hover:bg-gray-300 px-6 py-2 rounded-lg font-medium transition-all"
                >
                    Cancelar
                </a>
            </div>
        </form>
    </div>
</div>

<script>
    // Set minimum date to tomorrow
    const dateInput = document.getElementById('appointment_date');
    const tomorrow = new Date();
    tomorrow.setDate(tomorrow.getDate() + 1);
    
    const minDate = tomorrow.toISOString().split('T')[0];
    dateInput.min = minDate;
</script>
@endsection
