"use client";

import React from "react";
import { Calendar, Users, Activity, BarChart3 } from "lucide-react";

const quickActions = [
    {
        label: "Nova Consulta",
        icon: Calendar,
    },
    {
        label: "Adicionar Paciente",
        icon: Users,
    },
    {
        label: "Diagnóstico",
        icon: Activity,
    },
    {
        label: "Relatórios",
        icon: BarChart3,
    },
];

export default function DashboardLayout({ children }) {
    return (
        <div className="min-h-screen bg-white flex flex-col lg:flex-row">
            <aside className="w-full lg:w-72 border-b lg:border-b-0 lg:border-r border-gray-200 bg-[#fffcf5]">
                <div className="px-4 py-4 sm:px-5 sm:py-6">
                    <h2 className="text-sm font-semibold text-gray-900 mb-3">
                        Ações Rápidas
                    </h2>
                    <p className="text-xs text-gray-600 mb-4">
                        Aceda rapidamente às principais tarefas do dia a dia.
                    </p>

                    <div className="grid grid-cols-2 sm:grid-cols-4 lg:grid-cols-1 gap-3">
                        {quickActions.map(({ label, icon: Icon }) => (
                            <button
                                key={label}
                                className="p-3 bg-[#fff9e8] hover:bg-[#fdf4d7] border border-[#f1dca3] rounded-lg transition-all hover:shadow-md group text-left"
                            >
                                <div className="flex items-center gap-2">
                  <span className="inline-flex items-center justify-center w-8 h-8 rounded-md bg-white/70 text-[#b8860b]">
                    <Icon className="w-4 h-4" />
                  </span>
                                    <span className="text-xs sm:text-sm font-medium text-gray-900">
                    {label}
                  </span>
                                </div>
                            </button>
                        ))}
                    </div>
                </div>
            </aside>

            <main className="flex-1 w-full px-4 py-6 sm:px-6 md:px-8">
                {children}
            </main>
        </div>
    );
}
