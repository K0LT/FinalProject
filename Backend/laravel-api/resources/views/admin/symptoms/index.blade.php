@extends('admin.layout')

@section('admin-content')
<div class="p-8">
    <div class="mb-8 flex items-center justify-between">
        <div>
            <h1 class="text-3xl font-bold text-gray-900">Sintomas</h1>
            <p class="text-gray-600 mt-2">{{ $symptoms->count() }} sintoma(s)</p>
        </div>
        <button type="button" onclick="openSymptomModal()" class="inline-flex items-center gap-2 bg-blue-600 text-white hover:bg-blue-700 px-4 py-2 rounded-lg font-medium transition-all">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <line x1="12" y1="5" x2="12" y2="19"></line>
                <line x1="5" y1="12" x2="19" y2="12"></line>
            </svg>
            Adicionar Sintoma
        </button>
    </div>

    @if($symptoms->count() > 0)
        <div class="space-y-3">
            @foreach($symptoms as $symptom)
                <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-4 hover:shadow-md transition-all">
                    <div class="flex items-start justify-between">
                        <div class="flex-1">
                            <h3 class="text-lg font-semibold text-gray-900">{{ $symptom->name }}</h3>
                            @if($symptom->description)
                                <p class="text-gray-600 mt-2">{{ $symptom->description }}</p>
                            @endif
                        </div>
                        <form action="{{ route('admin.symptoms.delete', $symptom->id) }}" method="POST" style="display: inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-600 hover:text-red-700 font-medium" onclick="return confirm('Tem a certeza que deseja remover este sintoma?')">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <polyline points="3 6 5 6 21 6"></polyline>
                                    <path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path>
                                    <line x1="10" y1="11" x2="10" y2="17"></line>
                                    <line x1="14" y1="11" x2="14" y2="17"></line>
                                </svg>
                            </button>
                        </form>
                    </div>
                </div>
            @endforeach
        </div>
    @else
        <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6">
            <p class="text-gray-500 text-center py-8">Nenhum sintoma registado</p>
        </div>
    @endif
</div>

<!-- Symptom Modal -->
<div id="symptomModal" class="hidden fixed inset-0 bg-black bg-opacity-50 z-50 flex items-center justify-center p-4">
    <div class="bg-white rounded-lg shadow-lg max-w-md w-full">
        <div class="border-b border-gray-200 p-6 flex items-center justify-between">
            <h2 class="text-2xl font-bold text-gray-900">Adicionar Sintoma</h2>
            <button type="button" onclick="closeSymptomModal()" class="text-gray-500 hover:text-gray-700">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <line x1="18" y1="6" x2="6" y2="18"></line>
                    <line x1="6" y1="6" x2="18" y2="18"></line>
                </svg>
            </button>
        </div>

        <form action="{{ route('admin.symptoms.store') }}" method="POST" class="p-6 space-y-4">
            @csrf
            
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Nome do Sintoma *</label>
                <input type="text" name="name" required placeholder="Ex: Dor de Cabeça" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Descrição</label>
                <textarea name="description" rows="3" placeholder="Descreva o sintoma..." class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"></textarea>
            </div>

            <div class="flex gap-2 pt-4">
                <button type="submit" class="flex-1 bg-blue-600 text-white hover:bg-blue-700 px-4 py-2 rounded-lg font-medium transition-all">
                    Adicionar
                </button>
                <button type="button" onclick="closeSymptomModal()" class="flex-1 bg-gray-200 text-gray-900 hover:bg-gray-300 px-4 py-2 rounded-lg font-medium transition-all">
                    Cancelar
                </button>
            </div>
        </form>
    </div>
</div>

<script>
function openSymptomModal() {
    document.getElementById('symptomModal').classList.remove('hidden');
}

function closeSymptomModal() {
    document.getElementById('symptomModal').classList.add('hidden');
}

document.getElementById('symptomModal').addEventListener('click', function(e) {
    if (e.target === this) {
        closeSymptomModal();
    }
});
</script>

@endsection
