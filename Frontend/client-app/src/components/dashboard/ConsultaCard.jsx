"use client";

import React from "react";
import { Calendar, Clock } from "lucide-react";

const statusConfig = {
    agendada: {
        color: "bg-[#fff9e8] text-[#7a5c06]",
        label: "Agendada",
    },
    concluida: {
        color: "bg-emerald-50 text-emerald-700",
        label: "Concluída",
    },
    pendente: {
        color: "bg-amber-50 text-amber-700",
        label: "Pendente",
    },
};

export default function ConsultaCard({ cliente, data, hora, tipo, status }) {
    const config = statusConfig[status] ?? statusConfig.pendente;

    return (
        <div className="border border-gray-200 rounded-lg p-4 sm:p-5 hover:shadow-md transition-all hover:border-[#f1c04b] bg-white">
            <div className="flex flex-col sm:flex-row sm:items-start sm:justify-between gap-2 mb-3">
                <div className="min-w-0">
                    <h4 className="font-semibold text-gray-900 text-sm sm:text-base truncate">
                        {cliente}
                    </h4>
                    <p className="text-xs sm:text-sm text-gray-600 truncate">{tipo}</p>
                </div>
                <span
                    className={`px-3 py-1 rounded-full text-[11px] sm:text-xs font-medium self-start ${config.color}`}
                >
          {config.label}
        </span>
            </div>
            <div className="flex flex-wrap items-center gap-3 text-xs sm:text-sm text-gray-600">
        <span className="flex items-center gap-1">
          <Calendar className="w-4 h-4 text-[#b8860b]" />
            {data}
        </span>
                <span className="flex items-center gap-1">
          <Clock className="w-4 h-4 text-[#b8860b]" />
                    {hora}
        </span>
            </div>
        </div>
    );
}
