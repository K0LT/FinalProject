"use client";

import React, { useState, useRef, useEffect } from "react";
import { Send, Bot, User, Trash2, Copy, Check, Loader2, MessageSquare, Settings, Sparkles, X } from "lucide-react";

export default function AIChatbotPage() {
    const [messages, setMessages] = useState([
        {
            id: 1,
            role: "assistant",
            content:
                "Olá! Sou o seu assistente virtual. Posso ajudá-lo com informações sobre clientes, tratamentos, consultas e muito mais. Como posso ajudar hoje?",
            timestamp: new Date(),
        },
    ]);
    const [input, setInput] = useState("");
    const [isLoading, setIsLoading] = useState(false);
    const [copiedId, setCopiedId] = useState(null);
    const [showSettings, setShowSettings] = useState(false);
    const messagesEndRef = useRef(null);
    const textareaRef = useRef(null);

    const scrollToBottom = () => {
        messagesEndRef.current?.scrollIntoView({ behavior: "smooth" });
    };

    useEffect(() => {
        scrollToBottom();
    }, [messages]);

    useEffect(() => {
        if (textareaRef.current) {
            textareaRef.current.style.height = "auto";
            textareaRef.current.style.height = `${textareaRef.current.scrollHeight}px`;
        }
    }, [input]);

    const predefinedPrompts = {
        "Quantos clientes tenho registados?": "Atualmente temos 250 clientes registados.",
        "Quais os tratamentos mais populares?": "Os tratamentos mais populares são: Acupuntura, Massagem Terapêutica e Terapia de Reabilitação.",
        "Mostre-me o resumo das consultas desta semana": "Esta semana temos 20 consultas agendadas, 5 já realizadas e 15 programadas para os próximos dias.",
        "Como posso adicionar um novo cliente?": "Para adicionar um novo cliente, vá até a seção 'Clientes' no painel de administração e clique em 'Adicionar Cliente'. Preencha os dados necessários e salve.",
        // Adicione mais prompts aqui
        "Qual é o horário de funcionamento da clínica?": "A clínica está aberta de segunda a sexta-feira, das 9h às 18h.",
        "Quais são os preços dos tratamentos?": "Os preços variam dependendo do tratamento. A acupuntura custa 60€, e a massagem terapêutica custa 80€.",
    };

    const handleSend = async () => {
        if (!input.trim() || isLoading) return;

        const userMessage = {
            id: Date.now(),
            role: "user",
            content: input.trim(),
            timestamp: new Date(),
        };

        setMessages((prev) => [...prev, userMessage]);
        setInput("");
        setIsLoading(true);

        const promptResponse = predefinedPrompts[input.trim()];

        if (promptResponse) {
            const assistantMessage = {
                id: Date.now() + 1,
                role: "assistant",
                content: promptResponse,
                timestamp: new Date(),
            };

            setMessages((prev) => [...prev, assistantMessage]);
            setIsLoading(false);
        } else {
            const assistantMessage = {
                id: Date.now() + 1,
                role: "assistant",
                content: "Desculpe, não tenho uma resposta para essa pergunta. Por favor, tente algo relacionado aos nossos serviços.",
                timestamp: new Date(),
            };

            setMessages((prev) => [...prev, assistantMessage]);
            setIsLoading(false);
        }
    };

    const handleKeyDown = (e) => {
        if (e.key === "Enter" && !e.shiftKey) {
            e.preventDefault();
            handleSend();
        }
    };

    const copyToClipboard = (text, id) => {
        navigator.clipboard.writeText(text);
        setCopiedId(id);
        setTimeout(() => setCopiedId(null), 2000);
    };

    const clearChat = () => {
        setMessages([
            {
                id: 1,
                role: "assistant",
                content:
                    "Olá! Sou o seu assistente virtual. Posso ajudá-lo com informações sobre clientes, tratamentos, consultas e muito mais. Como posso ajudar hoje?",
                timestamp: new Date(),
            },
        ]);
    };

    return (
        <div className="flex flex-col h-screen max-h-screen bg-background">
            {/* Header */}
            <div className="border-b bg-card px-6 py-4 flex items-center justify-between">
                <div className="flex items-center gap-3">
                    <div className="p-2 rounded-lg bg-primary/10">
                        <Sparkles className="w-6 h-6 text-primary" />
                    </div>
                    <div>
                        <h1 className="text-xl font-bold">Assistente</h1>
                        <p className="text-sm text-muted-foreground">Sempre pronto para ajudar</p>
                    </div>
                </div>

                <div className="flex gap-2">

                    <button
                        onClick={clearChat}
                        className="inline-flex items-center justify-center whitespace-nowrap text-sm font-medium transition-all h-9 rounded-md px-3 border bg-background hover:bg-accent"
                    >
                        <Trash2 className="w-4 h-4 mr-2" />
                        Limpar
                    </button>
                </div>
            </div>

            <div className="flex-1 overflow-y-auto px-6 py-6 space-y-6">
                {messages.map((message) => (
                    <div
                        key={message.id}
                        className={`flex gap-3 ${message.role === "user" ? "flex-row-reverse" : "flex-row"}`}
                    >
                        <div
                            className={`flex-shrink-0 w-8 h-8 rounded-full flex items-center justify-center ${
                                message.role === "user" ? "bg-primary text-primary-foreground" : "bg-muted"
                            }`}
                        >
                            {message.role === "user" ? (
                                <User className="w-4 h-4" />
                            ) : (
                                <Bot className="w-4 h-4" />
                            )}
                        </div>

                        <div
                            className={`flex-1 max-w-[80%] ${
                                message.role === "user" ? "flex justify-end" : ""
                            }`}
                        >
                            <div
                                className={`rounded-2xl px-4 py-3 ${
                                    message.role === "user" ? "bg-primary text-primary-foreground" : "bg-card border"
                                }`}
                            >
                                <p className="text-sm whitespace-pre-wrap leading-relaxed">
                                    {message.content}
                                </p>
                                <div className="flex items-center justify-between mt-2 gap-2">
                  <span className="text-xs opacity-70">
                    {message.timestamp.toLocaleTimeString("pt-PT", {
                        hour: "2-digit",
                        minute: "2-digit",
                    })}
                  </span>
                                    {message.role === "assistant" && (
                                        <button
                                            onClick={() => copyToClipboard(message.content, message.id)}
                                            className="opacity-0 group-hover:opacity-100 hover:bg-accent rounded p-1 transition-all"
                                        >
                                            {copiedId === message.id ? (
                                                <Check className="w-3 h-3" />
                                            ) : (
                                                <Copy className="w-3 h-3" />
                                            )}
                                        </button>
                                    )}
                                </div>
                            </div>
                        </div>
                    </div>
                ))}

                {isLoading && (
                    <div className="flex gap-3">
                        <div className="flex-shrink-0 w-8 h-8 rounded-full bg-muted flex items-center justify-center">
                            <Bot className="w-4 h-4" />
                        </div>
                        <div className="flex-1 max-w-[80%]">
                            <div className="rounded-2xl px-4 py-3 bg-card border">
                                <div className="flex items-center gap-2">
                                    <Loader2 className="w-4 h-4 animate-spin" />
                                    <span className="text-sm text-muted-foreground">A pensar...</span>
                                </div>
                            </div>
                        </div>
                    </div>
                )}

                <div ref={messagesEndRef} />
            </div>

            {messages.length === 1 && !isLoading && (
                <div className="px-6 pb-4">
                    <p className="text-sm text-muted-foreground mb-3">Sugestões:</p>
                    <div className="grid grid-cols-1 md:grid-cols-2 gap-2">
                        {Object.keys(predefinedPrompts).map((question, i) => (
                            <button
                                key={i}
                                onClick={() => setInput(question)}
                                className="text-left text-sm p-3 rounded-lg border bg-card hover:bg-accent transition-colors"
                            >
                                <MessageSquare className="w-4 h-4 inline mr-2 text-muted-foreground" />
                                {question}
                            </button>
                        ))}
                    </div>
                </div>
            )}

            <div className="border-t bg-card px-6 py-4">
                <div className="flex gap-3 items-end">
                    <div className="flex-1 relative">
            <textarea
                ref={textareaRef}
                value={input}
                onChange={(e) => setInput(e.target.value)}
                onKeyDown={handleKeyDown}
                placeholder="Escreva a sua mensagem... (Enter para enviar, Shift+Enter para nova linha)"
                rows="1"
                disabled={isLoading}
                className="w-full rounded-lg border bg-background px-4 py-3 text-sm outline-none focus-visible:border-ring focus-visible:ring-ring/50 focus-visible:ring-[3px] resize-none max-h-32 disabled:opacity-50"
            />
                    </div>
                    <button
                        onClick={handleSend}
                        disabled={!input.trim() || isLoading}
                        className="inline-flex items-center justify-center whitespace-nowrap text-sm font-medium transition-all disabled:pointer-events-none disabled:opacity-50 h-10 w-10 rounded-lg bg-primary text-primary-foreground hover:bg-primary/90"
                    >
                        {isLoading ? (
                            <Loader2 className="w-4 h-4 animate-spin" />
                        ) : (
                            <Send className="w-4 h-4" />
                        )}
                    </button>
                </div>
                <p className="text-xs text-muted-foreground mt-2 text-center">
                    Este assistente usa IA e pode cometer erros. Verifique informações importantes.
                </p>
            </div>
        </div>
    );
}
