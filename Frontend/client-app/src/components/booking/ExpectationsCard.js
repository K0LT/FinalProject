import React from "react";
import CardBooking from "./CardBooking";
import { CircleCheckIcon } from "./icons";

function ExpectationItem({ title, description }) {
    return (
        <div className="flex items-start gap-3">
            <CircleCheckIcon className="mt-0.5 h-5 w-5 flex-shrink-0 text-primary" />
            <div>
                <p className="text-sm font-medium">{title}</p>
                <p className="text-xs text-muted-foreground">{description}</p>
            </div>
        </div>
    );
}

export default function ExpectationsCard() {
    return (
        <CardBooking title={<span className="text-base">O que esperar</span>}>
            <div className="space-y-3">
                <ExpectationItem
                    title="Avaliação Completa"
                    description="Análise detalhada do seu histórico e objetivos"
                />
                <ExpectationItem
                    title="Plano Personalizado"
                    description="Estratégia adaptada às suas necessidades"
                />
                <ExpectationItem
                    title="Sem Compromisso"
                    description="Primeira consulta sem obrigações"
                />
            </div>
        </CardBooking>
    );
}
