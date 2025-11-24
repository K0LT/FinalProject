"use client";

import React, { useState } from "react";
import {
    Calendar,
    Activity,
    Target,
    Dumbbell,
    Weight,
    AlertCircle,
    CheckCircle2,
    Clock,
    Users,
} from "lucide-react";

import StatCard from "@/components/dashboard/StatCard";
import ConsultaCard from "@/components/dashboard/ConsultaCard";
import ObjectiveProgress from "@/components/dashboard/ObjectiveProgress";

export default function DashboardPage() {
    const [selectedPeriod, setSelectedPeriod] = useState("hoje");

    const periodLabel = (p) => {
        if (p === "hoje") return "Hoje";
        if (p === "semana") return "Semana";
        if (p === "mes") return "Mês";
        return p;
    };

    return (
            <div className="max-w-7xl mx-auto space-y-8">
                <div>
                    <h1 className="text-2xl sm:text-3xl font-bold text-gray-900 mb-1">
                        José Machado
                    </h1>
                    <p className="text-sm sm:text-base text-gray-600">
                        Medicina Tradicional Chinesa
                    </p>
                </div>

                <div className="flex flex-wrap gap-2">
                    {["hoje", "semana", "mes"].map((period) => (
                        <button
                            key={period}
                            onClick={() => setSelectedPeriod(period)}
                            className={`px-4 py-2 rounded-lg text-sm sm:text-base font-medium transition-all ${
                                selectedPeriod === period
                                    ? "bg-gradient-to-r from-[#f1c04b] to-[#b8860b] text-white shadow-md"
                                    : "bg-white border border-gray-200 text-gray-700 hover:bg-[#fff8e1]"
                            }`}
                        >
                            {periodLabel(period)}
                        </button>
                    ))}
                </div>

                <div className="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                    <StatCard
                        title="Consultas Hoje"
                        value={8}
                        subtitle="3 concluídas, 5 pendentes"
                        icon={Calendar}
                        color="gold"
                        trend={{ value: 12, isPositive: true }}
                    />
                    <StatCard
                        title="Total de Pacientes"
                        value={156}
                        subtitle="12 novos este mês"
                        icon={Users}
                        color="green"
                        trend={{ value: 8, isPositive: true }}
                    />
                    <StatCard
                        title="Taxa de Conclusão"
                        value="94%"
                        subtitle="Objetivos alcançados"
                        icon={Target}
                        color="gold"
                        trend={{ value: 5, isPositive: true }}
                    />
                    <StatCard
                        title="Avaliações"
                        value="4.9"
                        subtitle="Média de satisfação"
                        icon={Activity}
                        color="purple"
                        trend={{ value: 2, isPositive: true }}
                    />
                </div>

                <div className="grid grid-cols-1 lg:grid-cols-3 gap-6">
                    <div className="lg:col-span-2 bg-white rounded-xl shadow-md p-4 sm:p-6 border border-gray-100">
                        <div className="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3 mb-6">
                            <h2 className="text-lg sm:text-xl font-bold text-gray-900 flex items-center gap-2">
                                <Calendar className="w-5 h-5 text-[#b8860b]" />
                                Próximas Consultas
                            </h2>
                            <button className="text-sm font-medium text-[#b8860b] hover:text-[#9c7309] self-start">
                                Ver todas →
                            </button>
                        </div>
                        <div className="space-y-3">
                            <ConsultaCard
                                cliente="Maria Silva"
                                data="20 Nov 2024"
                                hora="09:00"
                                tipo="Acupuntura"
                                status="agendada"
                            />
                            <ConsultaCard
                                cliente="João Santos"
                                data="20 Nov 2024"
                                hora="10:30"
                                tipo="Diagnóstico Energético"
                                status="agendada"
                            />
                            <ConsultaCard
                                cliente="Ana Costa"
                                data="20 Nov 2024"
                                hora="14:00"
                                tipo="Fitoterapia"
                                status="pendente"
                            />
                            <ConsultaCard
                                cliente="Pedro Oliveira"
                                data="19 Nov 2024"
                                hora="16:00"
                                tipo="Massagem Tui Na"
                                status="concluida"
                            />
                        </div>
                    </div>

                    <div className="bg-white rounded-xl shadow-md p-4 sm:p-6 border border-gray-100">
                        <h2 className="text-lg sm:text-xl font-bold text-gray-900 mb-6 flex items-center gap-2">
                            <AlertCircle className="w-5 h-5 text-[#b8860b]" />
                            Alertas
                        </h2>
                        <div className="space-y-3">
                            <div className="p-3 bg-red-50 border border-red-200 rounded-lg">
                                <div className="flex items-start gap-2">
                                    <AlertCircle className="w-4 h-4 text-red-600 mt-0.5" />
                                    <div>
                                        <p className="text-sm font-medium text-red-900">
                                            Consulta urgente
                                        </p>
                                        <p className="text-xs text-red-700 mt-1">
                                            Maria Silva solicitou reagendamento
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <div className="p-3 bg-[#fff9e8] border border-[#f1c04b] rounded-lg">
                                <div className="flex items-start gap-2">
                                    <Clock className="w-4 h-4 text-[#b8860b] mt-0.5" />
                                    <div>
                                        <p className="text-sm font-medium text-[#7a5c06]">
                                            Lembrete
                                        </p>
                                        <p className="text-xs text-[#9c7309] mt-1">
                                            Atualizar receitas de fitoterapia
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <div className="p-3 bg-emerald-50 border border-emerald-200 rounded-lg">
                                <div className="flex items-start gap-2">
                                    <CheckCircle2 className="w-4 h-4 text-emerald-600 mt-0.5" />
                                    <div>
                                        <p className="text-sm font-medium text-emerald-900">
                                            Sucesso
                                        </p>
                                        <p className="text-xs text-emerald-700 mt-1">
                                            5 pacientes atingiram as suas metas
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div className="grid grid-cols-1 lg:grid-cols-2 gap-6">
                    <div className="bg-white rounded-xl shadow-md p-4 sm:p-6 border border-gray-100">
                        <h2 className="text-lg sm:text-xl font-bold text-gray-900 mb-6 flex items-center gap-2">
                            <Target className="w-5 h-5 text-[#b8860b]" />
                            Progresso dos Tratamentos
                        </h2>
                        <ObjectiveProgress
                            titulo="Redução de Dores Crónicas"
                            progresso={85}
                            meta="90% até fim do mês"
                        />
                        <ObjectiveProgress
                            titulo="Melhoria do Sono"
                            progresso={70}
                            meta="80% até fim do mês"
                        />
                        <ObjectiveProgress
                            titulo="Equilíbrio Energético"
                            progresso={92}
                            meta="Meta atingida"
                        />
                        <ObjectiveProgress
                            titulo="Controle de Peso"
                            progresso={65}
                            meta="75% até fim do mês"
                        />
                    </div>

                    <div className="bg-white rounded-xl shadow-md p-4 sm:p-6 border border-gray-100">
                        <h2 className="text-lg sm:text-xl font-bold text-gray-900 mb-6 flex items-center gap-2">
                            <Activity className="w-5 h-5 text-[#b8860b]" />
                            Atividades Recentes
                        </h2>
                        <div className="space-y-4">
                            {[
                                {
                                    acao: "Nova consulta agendada",
                                    paciente: "Carlos Mendes",
                                    tempo: "há 5 minutos",
                                    icon: Calendar,
                                    colorBg: "bg-[#fff9e8]",
                                    colorIcon: "text-[#b8860b]",
                                },
                                {
                                    acao: "Diagnóstico energético atualizado",
                                    paciente: "Sofia Rodrigues",
                                    tempo: "há 1 hora",
                                    icon: Activity,
                                    colorBg: "bg-emerald-50",
                                    colorIcon: "text-emerald-600",
                                },
                                {
                                    acao: "Prescrição de exercícios",
                                    paciente: "Miguel Ferreira",
                                    tempo: "há 2 horas",
                                    icon: Dumbbell,
                                    colorBg: "bg-[#f5f3ff]",
                                    colorIcon: "text-purple-600",
                                },
                                {
                                    acao: "Atualização de peso",
                                    paciente: "Beatriz Lima",
                                    tempo: "há 3 horas",
                                    icon: Weight,
                                    colorBg: "bg-[#eff6ff]",
                                    colorIcon: "text-blue-600",
                                },
                            ].map((atividade, i) => {
                                const Icon = atividade.icon;
                                return (
                                    <div
                                        key={i}
                                        className="flex items-start gap-3 pb-3 border-b border-gray-100 last:border-0"
                                    >
                                        <div
                                            className={`p-2 rounded-lg ${atividade.colorBg} ${atividade.colorIcon}`}
                                        >
                                            <Icon className="w-4 h-4" />
                                        </div>
                                        <div className="flex-1 min-w-0">
                                            <p className="text-sm font-medium text-gray-900 truncate">
                                                {atividade.acao}
                                            </p>
                                            <p className="text-xs text-gray-600 truncate">
                                                {atividade.paciente}
                                            </p>
                                            <p className="text-xs text-gray-500 mt-1">
                                                {atividade.tempo}
                                            </p>
                                        </div>
                                    </div>
                                );
                            })}
                        </div>
                    </div>
                </div>
            </div>
    );
}
