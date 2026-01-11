@extends('client.layout')

@section('title', 'Assistente IA - QiFlow')

@section('content')
<div class="p-8">
    <!-- Header -->
    <div class="mb-8">
        <h1 class="text-3xl font-bold text-gray-900">Assistente IA</h1>
        <p class="text-gray-600 mt-2">Converse com o seu assistente de IA pessoal para dúvidas sobre saúde e bem-estar</p>
    </div>

    <!-- Chat Container -->
    <div class="bg-white rounded-lg shadow-sm border border-gray-200 overflow-hidden flex flex-col h-[600px]">
        <!-- Chat Messages Area -->
        <div id="chatMessages" class="flex-1 overflow-y-auto p-6 space-y-4 bg-gray-50">
            <!-- Welcome Message -->
            <div class="flex gap-3">
                <div class="flex-shrink-0">
                    <div class="flex items-center justify-center h-8 w-8 rounded-full bg-[#B8860B]">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-white" viewBox="0 0 24 24" fill="currentColor">
                            <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm0 18c-4.42 0-8-3.58-8-8s3.58-8 8-8 8 3.58 8 8-3.58 8-8 8zm3.5-9c.83 0 1.5-.67 1.5-1.5S16.33 8 15.5 8 14 8.67 14 9.5s.67 1.5 1.5 1.5zm-7 0c.83 0 1.5-.67 1.5-1.5S9.33 8 8.5 8 7 8.67 7 9.5 7.67 11 8.5 11zm3.5 6.5c2.33 0 4.31-1.46 5.11-3.5H6.89c.8 2.04 2.78 3.5 5.11 3.5z"></path>
                        </svg>
                    </div>
                </div>
                <div class="flex-1">
                    <div class="bg-white rounded-lg p-4 border border-gray-200">
                        <p class="text-gray-900">Olá! Sou o seu assistente de IA. Posso ajudá-lo com dúvidas sobre a sua saúde, bem-estar, exercícios, nutrição e muito mais. Como posso ajudá-lo hoje?</p>
                    </div>
                    <p class="text-xs text-gray-500 mt-2">Assistente IA • Agora</p>
                </div>
            </div>
        </div>

        <!-- Input Area -->
        <div class="border-t border-gray-200 bg-white p-4">
            <form id="chatForm" class="flex gap-3">
                <input 
                    type="text" 
                    id="messageInput" 
                    placeholder="Digite sua mensagem..." 
                    class="flex-1 px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-[#B8860B] focus:border-transparent"
                    autocomplete="off"
                >
                <button 
                    type="submit" 
                    class="inline-flex items-center gap-2 bg-[#B8860B] text-white hover:bg-[#B8860B]/90 px-6 py-2 rounded-lg font-medium transition-all"
                >
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <line x1="22" y1="2" x2="11" y2="13"></line>
                        <polygon points="22 2 15 22 11 13 2 9 22 2"></polygon>
                    </svg>
                    Enviar
                </button>
            </form>
        </div>
    </div>

    <!-- Quick Actions -->
    <div class="mt-8">
        <h3 class="text-lg font-semibold text-gray-900 mb-4">Perguntas Frequentes</h3>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <button class="quickAction text-left p-4 rounded-lg border border-gray-200 hover:border-[#B8860B] hover:bg-[#B8860B]/5 transition-all" data-question="Quais são os benefícios da acupuntura?">
                <p class="font-medium text-gray-900">Benefícios da Acupuntura</p>
                <p class="text-sm text-gray-600 mt-1">Saiba mais sobre os benefícios da acupuntura</p>
            </button>
            <button class="quickAction text-left p-4 rounded-lg border border-gray-200 hover:border-[#B8860B] hover:bg-[#B8860B]/5 transition-all" data-question="Como devo fazer os exercícios prescritos?">
                <p class="font-medium text-gray-900">Exercícios Prescritos</p>
                <p class="text-sm text-gray-600 mt-1">Dúvidas sobre como realizar os exercícios</p>
            </button>
            <button class="quickAction text-left p-4 rounded-lg border border-gray-200 hover:border-[#B8860B] hover:bg-[#B8860B]/5 transition-all" data-question="Qual é a melhor alimentação para minha condição?">
                <p class="font-medium text-gray-900">Recomendações Nutricionais</p>
                <p class="text-sm text-gray-600 mt-1">Dúvidas sobre nutrição e alimentação</p>
            </button>
            <button class="quickAction text-left p-4 rounded-lg border border-gray-200 hover:border-[#B8860B] hover:bg-[#B8860B]/5 transition-all" data-question="Como posso melhorar meu bem-estar geral?">
                <p class="font-medium text-gray-900">Bem-estar Geral</p>
                <p class="text-sm text-gray-600 mt-1">Dicas para melhorar seu bem-estar</p>
            </button>
        </div>
    </div>
</div>

<script>
    const chatForm = document.getElementById('chatForm');
    const messageInput = document.getElementById('messageInput');
    const chatMessages = document.getElementById('chatMessages');
    const quickActionButtons = document.querySelectorAll('.quickAction');

    // Handle quick action buttons
    quickActionButtons.forEach(button => {
        button.addEventListener('click', (e) => {
            e.preventDefault();
            const question = button.getAttribute('data-question');
            messageInput.value = question;
            chatForm.dispatchEvent(new Event('submit'));
        });
    });

    // Handle form submission
    chatForm.addEventListener('submit', async (e) => {
        e.preventDefault();
        const message = messageInput.value.trim();
        
        if (!message) return;

        // Add user message to chat
        addMessage(message, 'user');
        messageInput.value = '';

        // Simulate AI response (placeholder)
        setTimeout(() => {
            const responses = [
                'Essa é uma ótima pergunta! Deixe-me ajudá-lo com mais informações sobre este tópico.',
                'Entendo sua dúvida. Com base no seu perfil de saúde, posso sugerir algumas recomendações personalizadas.',
                'Essa é uma questão importante para o seu bem-estar. Aqui estão algumas informações úteis.',
                'Ótimo! Vou fornecer informações detalhadas sobre este assunto.'
            ];
            const randomResponse = responses[Math.floor(Math.random() * responses.length)];
            addMessage(randomResponse, 'ai');
        }, 500);
    });

    function addMessage(text, sender) {
        const messageDiv = document.createElement('div');
        messageDiv.className = 'flex gap-3';

        if (sender === 'user') {
            messageDiv.innerHTML = `
                <div class="flex-1 flex justify-end">
                    <div class="bg-[#B8860B] text-white rounded-lg p-4 max-w-xs">
                        <p>${escapeHtml(text)}</p>
                    </div>
                </div>
                <div class="flex-shrink-0">
                    <div class="flex items-center justify-center h-8 w-8 rounded-full bg-gray-300">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-600" viewBox="0 0 24 24" fill="currentColor">
                            <path d="M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm0 2c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4z"></path>
                        </svg>
                    </div>
                </div>
            `;
        } else {
            messageDiv.innerHTML = `
                <div class="flex-shrink-0">
                    <div class="flex items-center justify-center h-8 w-8 rounded-full bg-[#B8860B]">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-white" viewBox="0 0 24 24" fill="currentColor">
                            <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm0 18c-4.42 0-8-3.58-8-8s3.58-8 8-8 8 3.58 8 8-3.58 8-8 8zm3.5-9c.83 0 1.5-.67 1.5-1.5S16.33 8 15.5 8 14 8.67 14 9.5s.67 1.5 1.5 1.5zm-7 0c.83 0 1.5-.67 1.5-1.5S9.33 8 8.5 8 7 8.67 7 9.5 7.67 11 8.5 11zm3.5 6.5c2.33 0 4.31-1.46 5.11-3.5H6.89c.8 2.04 2.78 3.5 5.11 3.5z"></path>
                        </svg>
                    </div>
                </div>
                <div class="flex-1">
                    <div class="bg-white rounded-lg p-4 border border-gray-200">
                        <p class="text-gray-900">${escapeHtml(text)}</p>
                    </div>
                    <p class="text-xs text-gray-500 mt-2">Assistente IA • Agora</p>
                </div>
            `;
        }

        chatMessages.appendChild(messageDiv);
        chatMessages.scrollTop = chatMessages.scrollHeight;
    }

    function escapeHtml(text) {
        const div = document.createElement('div');
        div.textContent = text;
        return div.innerHTML;
    }
</script>
@endsection
