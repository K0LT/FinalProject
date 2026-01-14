'use client';

import ClientDashLayout from "@/components/clientDashboard/ClientDashLayout";
import { AuthGuard } from "@/components/Auth/AuthGuard";
import { Bot, MessageSquare, Sparkles } from "lucide-react";

function AIAssistantPage() {
    return (
        <div className="space-y-6">
            <div className="flex justify-between items-center">
                <h1 className="text-2xl font-bold">Assistente IA</h1>
            </div>

            {/* Coming Soon Card */}
            <div className="rounded-2xl border border-amber-100 bg-white p-8 text-center">
                <div className="mx-auto w-16 h-16 rounded-full bg-amber-50 flex items-center justify-center mb-4">
                    <Bot className="w-8 h-8 text-amber-600" />
                </div>

                <h2 className="text-xl font-semibold mb-2">Em Breve</h2>
                <p className="text-gray-500 max-w-md mx-auto mb-6">
                    O assistente de inteligência artificial estará disponível em breve para ajudá-lo
                    com questões sobre o seu tratamento e bem-estar.
                </p>

                {/* Feature Preview */}
                <div className="grid gap-4 md:grid-cols-3 mt-8">
                    <div className="p-4 rounded-xl bg-amber-50">
                        <MessageSquare className="w-6 h-6 text-amber-600 mx-auto mb-2" />
                        <h3 className="font-medium text-sm">Chat Interativo</h3>
                        <p className="text-xs text-gray-500 mt-1">
                            Converse sobre o seu tratamento
                        </p>
                    </div>

                    <div className="p-4 rounded-xl bg-amber-50">
                        <Sparkles className="w-6 h-6 text-amber-600 mx-auto mb-2" />
                        <h3 className="font-medium text-sm">Recomendações</h3>
                        <p className="text-xs text-gray-500 mt-1">
                            Dicas personalizadas de saúde
                        </p>
                    </div>

                    <div className="p-4 rounded-xl bg-amber-50">
                        <Bot className="w-6 h-6 text-amber-600 mx-auto mb-2" />
                        <h3 className="font-medium text-sm">Suporte 24/7</h3>
                        <p className="text-xs text-gray-500 mt-1">
                            Disponível a qualquer momento
                        </p>
                    </div>
                </div>
            </div>
        </div>
    );
}

export default function Page() {
    return (
        <AuthGuard requireAuth={true}>
            <ClientDashLayout>
                <AIAssistantPage />
            </ClientDashLayout>
        </AuthGuard>
    );
}
