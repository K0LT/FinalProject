import React from "react";
import CardBooking from "./CardBooking";
import { StethoscopeIcon } from "./icons";

function ConsultationOption({
                                title,
                                duration,
                                priceLabel,
                                priceVariant,
                                description,
                            }) {
    return (
        <div className="cursor-pointer rounded-lg border border-gray-200 p-4 transition-all hover:border-gray-300">
            <div className="mb-2 flex items-center justify-between">
                <h3 className="font-medium">{title}</h3>
                <div className="flex items-center gap-2">
          <span
              data-slot="badge"
              className="inline-flex w-fit shrink-0 items-center justify-center gap-1 whitespace-nowrap rounded-md border px-2 py-0.5 text-xs font-medium text-foreground transition-[color,box-shadow] [&>svg]:size-3 [&>svg]:pointer-events-none"
          >
            {duration}
          </span>

                    <span
                        data-slot="badge"
                        className={`inline-flex w-fit shrink-0 items-center justify-center gap-1 whitespace-nowrap rounded-md border px-2 py-0.5 text-xs font-medium transition-[color,box-shadow] [&>svg]:size-3 [&>svg]:pointer-events-none ${
                            priceVariant === "primary"
                                ? "border-transparent bg-primary text-primary-foreground hover:bg-primary/90"
                                : "border-transparent bg-secondary text-secondary-foreground hover:bg-secondary/90"
                        }`}
                    >
            {priceLabel}
          </span>
                </div>
            </div>

            <p className="text-sm text-muted-foreground">{description}</p>
        </div>
    );
}

export default function ConsultationTypeCard() {
    return (
        <CardBooking
            title={
                <>
                    <StethoscopeIcon className="h-5 w-5" />
                    1. Escolha o Tipo de Consulta
                </>
            }
            description="Selecione o serviço que melhor se adequa às suas necessidades"
        >
            <div className="space-y-4">
                <ConsultationOption
                    title="Consulta de Avaliação Gratuita"
                    duration="90 min"
                    priceLabel="Gratuita"
                    priceVariant="primary"
                    description="Avaliação completa do seu estado de saúde e objetivos"
                />
                <ConsultationOption
                    title="Consulta de Tratamento"
                    duration="60 min"
                    priceLabel="80€"
                    priceVariant="secondary"
                    description="Sessão de acupunctura com plano personalizado"
                />
                <ConsultationOption
                    title="Consulta de Seguimento"
                    duration="45 min"
                    priceLabel="60€"
                    priceVariant="secondary"
                    description="Acompanhamento de progresso e ajustes"
                />
            </div>
        </CardBooking>
    );
}
