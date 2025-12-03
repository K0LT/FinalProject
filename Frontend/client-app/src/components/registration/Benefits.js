import React from 'react';
import { CircleCheckBig } from 'lucide-react';

const Benefits = () => {
    return (
        <div className="flex flex-col gap-6 rounded-xl border-0 bg-gradient-to-r from-primary to-red-600 text-white">
            <div className="[&:last-child]:pb-6 p-8">
                <h3 className="text-2xl mb-6">O que está incluído</h3>
                <div className="space-y-4">
                    <div className="flex items-center gap-3">
                        <CircleCheckBig className="w-5 h-5 text-green-300 flex-shrink-0" />
                        <span className="text-sm">Acesso completo à plataforma QiFlow</span>
                    </div>
                    <div className="flex items-center gap-3">
                        <CircleCheckBig className="w-5 h-5 text-green-300 flex-shrink-0" />
                        <span className="text-sm">Acompanhamento personalizado</span>
                    </div>
                    <div className="flex items-center gap-3">
                        <CircleCheckBig className="w-5 h-5 text-green-300 flex-shrink-0" />
                        <span className="text-sm">Relatórios de progresso detalhados</span>
                    </div>
                    <div className="flex items-center gap-3">
                        <CircleCheckBig className="w-5 h-5 text-green-300 flex-shrink-0" />
                        <span className="text-sm">Suporte via WhatsApp</span>
                    </div>
                    <div className="flex items-center gap-3">
                        <CircleCheckBig className="w-5 h-5 text-green-300 flex-shrink-0" />
                        <span className="text-sm">Consulta de avaliação gratuita</span>
                    </div>
                    <div className="flex items-center gap-3">
                        <CircleCheckBig className="w-5 h-5 text-green-300 flex-shrink-0" />
                        <span className="text-sm">Planos de exercício personalizados</span>
                    </div>
                </div>
            </div>
        </div>
    );
};

export default Benefits;