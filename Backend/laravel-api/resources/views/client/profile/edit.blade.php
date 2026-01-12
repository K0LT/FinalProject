@extends('client.layout')

@section('title', 'Editar Perfil - QiFlow')

@section('content')
<div class="p-8">
    <!-- Header -->
    <div class="mb-8">
        <h1 class="text-3xl font-bold text-gray-900">Editar Perfil</h1>
        <p class="text-gray-600 mt-2">Atualize as suas informações pessoais</p>
    </div>

    <!-- Edit Form -->
    <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-8 max-w-2xl">
        @if ($errors->any())
            <div class="mb-6 p-4 bg-red-50 border border-red-200 rounded-lg">
                <div class="flex items-start gap-3">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-red-600 flex-shrink-0 mt-0.5" viewBox="0 0 24 24" fill="currentColor">
                        <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm1 15h-2v-2h2v2zm0-4h-2V7h2v6z"></path>
                    </svg>
                    <div>
                        <h3 class="font-semibold text-red-900 mb-2">Erros encontrados</h3>
                        <ul class="text-sm text-red-800 space-y-1">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        @endif

        <form method="POST" action="{{ route('user.profile.update') }}" class="space-y-6">
            @csrf

            <!-- Personal Information Section -->
            <div class="space-y-4">
                <h3 class="text-lg font-semibold text-gray-900">Informações Pessoais</h3>

                <!-- Name and Surname -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label for="name" class="block text-sm font-medium text-gray-700 mb-2">Nome *</label>
                        <input 
                            type="text" 
                            id="name" 
                            name="name"
                            value="{{ old('name', $user->name) }}"
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-[#B8860B] focus:border-transparent @error('name') border-red-500 @enderror"
                            required
                        >
                        @error('name')
                            <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="surname" class="block text-sm font-medium text-gray-700 mb-2">Sobrenome *</label>
                        <input 
                            type="text" 
                            id="surname" 
                            name="surname"
                            value="{{ old('surname', $user->surname) }}"
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-[#B8860B] focus:border-transparent @error('surname') border-red-500 @enderror"
                            required
                        >
                        @error('surname')
                            <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <!-- Email and Phone -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label for="email" class="block text-sm font-medium text-gray-700 mb-2">Email *</label>
                        <input 
                            type="email" 
                            id="email" 
                            name="email"
                            value="{{ old('email', $user->email) }}"
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-[#B8860B] focus:border-transparent @error('email') border-red-500 @enderror"
                            required
                        >
                        @error('email')
                            <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="phone_number" class="block text-sm font-medium text-gray-700 mb-2">Telefone</label>
                        <input 
                            type="tel" 
                            id="phone_number" 
                            name="phone_number"
                            value="{{ old('phone_number', $patient->phone_number) }}"
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-[#B8860B] focus:border-transparent @error('phone_number') border-red-500 @enderror"
                        >
                        @error('phone_number')
                            <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <!-- Address -->
                <div>
                    <label for="address" class="block text-sm font-medium text-gray-700 mb-2">Morada</label>
                    <input 
                        type="text" 
                        id="address" 
                        name="address"
                        value="{{ old('address', $patient->address) }}"
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-[#B8860B] focus:border-transparent @error('address') border-red-500 @enderror"
                    >
                    @error('address')
                        <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Birth Date and Gender -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label for="birth_date" class="block text-sm font-medium text-gray-700 mb-2">Data de Nascimento</label>
                        <input 
                            type="date" 
                            id="birth_date" 
                            name="birth_date"
                            value="{{ old('birth_date', $patient->birth_date) }}"
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-[#B8860B] focus:border-transparent @error('birth_date') border-red-500 @enderror"
                        >
                        @error('birth_date')
                            <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="gender" class="block text-sm font-medium text-gray-700 mb-2">Género</label>
                        <select 
                            id="gender" 
                            name="gender"
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-[#B8860B] focus:border-transparent @error('gender') border-red-500 @enderror"
                        >
                            <option value="">Selecionar</option>
                            <option value="female" @selected(old('gender', $patient->gender) === 'female')>Feminino</option>
                            <option value="male" @selected(old('gender', $patient->gender) === 'male')>Masculino</option>
                            <option value="other" @selected(old('gender', $patient->gender) === 'other')>Outro</option>
                        </select>
                        @error('gender')
                            <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
            </div>

            <!-- Emergency Contact Section -->
            <div class="space-y-4">
                <h3 class="text-lg font-semibold text-gray-900">Contacto de Emergência</h3>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                    <div>
                        <label for="emergency_contact_name" class="block text-sm font-medium text-gray-700 mb-2">Nome</label>
                        <input 
                            type="text" 
                            id="emergency_contact_name" 
                            name="emergency_contact_name"
                            value="{{ old('emergency_contact_name', $patient->emergency_contact_name) }}"
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-[#B8860B] focus:border-transparent @error('emergency_contact_name') border-red-500 @enderror"
                        >
                        @error('emergency_contact_name')
                            <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="emergency_contact_phone" class="block text-sm font-medium text-gray-700 mb-2">Telefone</label>
                        <input 
                            type="tel" 
                            id="emergency_contact_phone" 
                            name="emergency_contact_phone"
                            value="{{ old('emergency_contact_phone', $patient->emergency_contact_phone) }}"
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-[#B8860B] focus:border-transparent @error('emergency_contact_phone') border-red-500 @enderror"
                        >
                        @error('emergency_contact_phone')
                            <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="emergency_contact_relation" class="block text-sm font-medium text-gray-700 mb-2">Relação</label>
                        <input 
                            type="text" 
                            id="emergency_contact_relation" 
                            name="emergency_contact_relation"
                            placeholder="Ex: Cônjuge, Filho, Amigo"
                            value="{{ old('emergency_contact_relation', $patient->emergency_contact_relation) }}"
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-[#B8860B] focus:border-transparent @error('emergency_contact_relation') border-red-500 @enderror"
                        >
                        @error('emergency_contact_relation')
                            <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
            </div>

            <!-- Buttons -->
            <div class="flex gap-3 pt-4">
                <button 
                    type="submit" 
                    class="inline-flex items-center gap-2 bg-[#B8860B] text-white hover:bg-[#B8860B]/90 px-6 py-2 rounded-lg font-medium transition-all"
                >
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M19 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11l5 5v11a2 2 0 0 1-2 2z"></path>
                        <polyline points="17 21 17 13 7 13 7 21"></polyline>
                        <polyline points="7 3 7 8 15 8"></polyline>
                    </svg>
                    Guardar Alterações
                </button>
                <a 
                    href="{{ route('user.profile') }}" 
                    class="inline-flex items-center gap-2 bg-gray-200 text-gray-900 hover:bg-gray-300 px-6 py-2 rounded-lg font-medium transition-all"
                >
                    Cancelar
                </a>
            </div>
        </form>
    </div>
</div>
@endsection
