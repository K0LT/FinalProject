"use client";

import React from "react";
import { Calendar, Clock } from "lucide-react";

export default function ConsultaCard({
                                         cliente,
                                         data,
                                         hora,
                                         tipo,
                                         status = "pendente",
                                     }) {
    const map = {
        agendada: "bg-blue-50 text-blue-700",
        pendente: "bg-amber-50 text-amber-700",
        concluida: "bg-emerald-50 text-emerald-700",
    };
    const badge = map[status] || map.pendente;

    return (
        <div className="rounded-xl border border-gray-100 bg-white p-4 shadow-sm">
            <div className="mb-2 flex items-center justify-between gap-2">
                <div>
                    <p className="text-sm font-semibold text-gray-900">{cliente}</p>
                    <p className="text-xs text-gray-500">{tipo}</p>
                </div>
                <span className={`rounded-full px-3 py-1 text-xs font-semibold ${badge}`}>
          {status === "concluida"
              ? "Concluída"
              : status === "agendada"
                  ? "Agendada"
                  : "Pendente"}
        </span>
            </div>
            <div className="mt-2 flex flex-wrap items-center gap-3 text-xs text-gray-600">
        <span className="inline-flex items-center gap-1 rounded-md bg-gray-50 px-2 py-1">
          <Calendar className="h-3 w-3 text-amber-700" />
            {data}
        </span>
                <span className="inline-flex items-center gap-1 rounded-md bg-gray-50 px-2 py-1">
          <Clock className="h-3 w-3 text-amber-700" />
                    {hora}
        </span>
            </div>
        </div>
    );
}
