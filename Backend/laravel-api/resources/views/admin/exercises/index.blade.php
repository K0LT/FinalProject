@extends('admin.layout')

@section('admin-content')
<div class="p-8">
    <div class="mb-8 flex items-center justify-between">
        <div>
            <h1 class="text-3xl font-bold text-gray-900">Exercícios</h1>
            <p class="text-gray-600 mt-2">{{ $exercises->count() }} exercício(s)</p>
        </div>
        <button type="button" onclick="openExerciseModal()" class="inline-flex items-center gap-2 bg-blue-600 text-white hover:bg-blue-700 px-4 py-2 rounded-lg font-medium transition-all">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <line x1="12" y1="5" x2="12" y2="19"></line>
                <line x1="5" y1="12" x2="19" y2="12"></line>
            </svg>
            Criar Exercício
        </button>
    </div>

    @if($exercises->count() > 0)
        <div class="space-y-4">
            @foreach($exercises as $exercise)
                <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6 hover:shadow-md transition-all">
                    <div class="flex items-start justify-between mb-4">
                        <div>
                            <h3 class="text-lg font-semibold text-gray-900">{{ $exercise->name }}</h3>
                            <div class="flex gap-2 mt-2">
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                                    {{ $exercise->category }}
                                </span>
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium 
                                    @if($exercise->difficulty_level === 'Fácil') bg-green-100 text-green-800
                                    @elseif($exercise->difficulty_level === 'Moderado') bg-yellow-100 text-yellow-800
                                    @else bg-red-100 text-red-800
                                    @endif">
                                    {{ $exercise->difficulty_level }}
                                </span>
                            </div>
                        </div>
                        <form action="{{ route('admin.exercises.delete', $exercise->id) }}" method="POST" style="display: inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-600 hover:text-red-700 font-medium" onclick="return confirm('Tem a certeza que deseja remover este exercício?')">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <polyline points="3 6 5 6 21 6"></polyline>
                                    <path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path>
                                    <line x1="10" y1="11" x2="10" y2="17"></line>
                                    <line x1="14" y1="11" x2="14" y2="17"></line>
                                </svg>
                            </button>
                        </form>
                    </div>
                    
                    @if($exercise->description)
                        <div class="mb-4">
                            <p class="text-sm font-medium text-gray-700 mb-1">Descrição:</p>
                            <p class="text-gray-600">{{ $exercise->description }}</p>
                        </div>
                    @endif
                    
                    @if($exercise->instructions)
                        <div class="mb-4 p-3 bg-blue-50 rounded border border-blue-200">
                            <p class="text-sm font-medium text-blue-900 mb-1">Instruções:</p>
                            <p class="text-sm text-blue-800 whitespace-pre-wrap">{{ $exercise->instructions }}</p>
                        </div>
                    @endif

                    @if($exercise->benefits)
                        <div class="mb-4 p-3 bg-green-50 rounded border border-green-200">
                            <p class="text-sm font-medium text-green-900 mb-1">Benefícios:</p>
                            <p class="text-sm text-green-800 whitespace-pre-wrap">{{ $exercise->benefits }}</p>
                        </div>
                    @endif

                    @if($exercise->precautions)
                        <div class="mb-4 p-3 bg-orange-50 rounded border border-orange-200">
                            <p class="text-sm font-medium text-orange-900 mb-1">Precauções:</p>
                            <p class="text-sm text-orange-800 whitespace-pre-wrap">{{ $exercise->precautions }}</p>
                        </div>
                    @endif
                </div>
            @endforeach
        </div>
    @else
        <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6">
            <p class="text-gray-500 text-center py-8">Nenhum exercício registado</p>
        </div>
    @endif
</div>

<!-- Exercise Modal -->
<div id="exerciseModal" class="hidden fixed inset-0 bg-black bg-opacity-50 z-50 flex items-center justify-center p-4">
    <div class="bg-white rounded-lg shadow-lg max-w-md w-full">
        <div class="border-b border-gray-200 p-6 flex items-center justify-between">
            <h2 class="text-2xl font-bold text-gray-900">Criar Exercício</h2>
            <button type="button" onclick="closeExerciseModal()" class="text-gray-500 hover:text-gray-700">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <line x1="18" y1="6" x2="6" y2="18"></line>
                    <line x1="6" y1="6" x2="18" y2="18"></line>
                </svg>
            </button>
        </div>

        <form action="{{ route('admin.exercises.store') }}" method="POST" class="p-6 space-y-4 max-h-96 overflow-y-auto">
            @csrf
            
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Nome do Exercício *</label>
                <input type="text" name="name" required placeholder="Ex: Alongamento de Ombros" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Categoria *</label>
                <input type="text" name="category" required placeholder="Ex: Alongamento, Fortalecimento" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Nível de Dificuldade *</label>
                <select name="difficulty_level" required class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                    <option value="">Selecione um nível</option>
                    <option value="Fácil">Fácil</option>
                    <option value="Moderado">Moderado</option>
                    <option value="Difícil">Difícil</option>
                </select>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Descrição</label>
                <textarea name="description" rows="2" placeholder="Descreva o exercício..." class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"></textarea>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Instruções</label>
                <textarea name="instructions" rows="3" placeholder="Instruções passo a passo..." class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"></textarea>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Benefícios</label>
                <textarea name="benefits" rows="2" placeholder="Benefícios do exercício..." class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"></textarea>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Precauções</label>
                <textarea name="precautions" rows="2" placeholder="Precauções e contraindicações..." class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"></textarea>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">URL do Vídeo</label>
                <input type="url" name="video_url" placeholder="https://..." class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">URL da Imagem</label>
                <input type="url" name="image_url" placeholder="https://..." class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>

            <div class="flex gap-2 pt-4">
                <button type="submit" class="flex-1 bg-blue-600 text-white hover:bg-blue-700 px-4 py-2 rounded-lg font-medium transition-all">
                    Criar
                </button>
                <button type="button" onclick="closeExerciseModal()" class="flex-1 bg-gray-200 text-gray-900 hover:bg-gray-300 px-4 py-2 rounded-lg font-medium transition-all">
                    Cancelar
                </button>
            </div>
        </form>
    </div>
</div>

<script>
function openExerciseModal() {
    document.getElementById('exerciseModal').classList.remove('hidden');
}

function closeExerciseModal() {
    document.getElementById('exerciseModal').classList.add('hidden');
}

document.getElementById('exerciseModal').addEventListener('click', function(e) {
    if (e.target === this) {
        closeExerciseModal();
    }
});
</script>

@endsection
