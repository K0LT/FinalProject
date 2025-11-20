import React from "react";
import { StethoscopeIcon } from "./icons";

export default function BookingHeader() {
    return (
        <div className="mb-8 text-center">
      <span
          data-slot="badge"
          className="mb-4 inline-flex w-fit items-center justify-center gap-1 overflow-hidden whitespace-nowrap rounded-md border border-primary/20 bg-primary/10 px-2 py-0.5 text-xs font-medium text-primary transition-[color,box-shadow] [&>svg]:size-3 [&>svg]:pointer-events-none"
      >
        <StethoscopeIcon className="mr-1 h-3 w-3" />
        Marcação Online
      </span>

            <h2 className="mb-4 text-4xl text-primary">Marcar Consulta</h2>
            <p className="mx-auto max-w-2xl text-xl text-muted-foreground">
                Escolha o melhor horário para a sua consulta. Responderemos em 24 horas
                para confirmar.
            </p>
        </div>
    );
}
