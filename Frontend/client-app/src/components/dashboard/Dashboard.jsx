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

function getStatsByPeriod(period) {
    if (period === "hoje") {
        return {
            consultas: 8,
            pacientes: 156,
            novosPacientes: 3,
            conclusao: "94%",
            avaliacao: "4.9",
        };
    }
    if (period === "semana") {
        return {
            consultas: 32,
            pacientes: 156,
            novosPacientes: 8,
            conclusao: "92%",
            avaliacao: "4.8",
        };
    }
    return {
        consultas: 110,
        pacientes: 156,
        novosPacientes: 12,
        conclusao: "90%",
        avaliacao: "4.9",
    };
}

const periodLabel = (p) =>
    p === "hoje" ? "Hoje" : p === "semana" ? "Semana" : "Mês";

export default function Dashboard() {
    const [selectedPeriod, setSelectedPeriod] = useState("hoje");
    const stats = getStatsByPeriod(selectedPeriod);

    return (
        <div className="max-w-7xl mx-auto space-y-8">
            <div className="flex flex-col gap-2 sm:flex-row sm:items-end sm:justify-between">
                <div>
                    <h1 className="text-2xl sm:text-3xl font-bold text-gray-900 mb-1">
                        José Machado
                    </h1>
                    <p className="text-sm sm:text-base text-gray-600">
                        Medicina Tradicional Chinesa · Painel de Actividade
                    </p>
                </div>
                <div className="flex flex-col items-start sm:items-end gap-1 text-xs">
          <span className="inline-flex items-center gap-2 rounded-full bg-gray-100 px-3 py-1 font-medium text-gray-700">
            <Clock className="w-3 h-3" />
            Resumo do período: {periodLabel(selectedPeriod)}
          </span>
                    <p className="text-[11px] text-gray-500">
                        Use o selector abaixo para analisar o desempenho em diferentes
                        períodos.
                    </p>
                </div>
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
                    title="Consultas no período"
                    value={stats.consultas}
                    subtitle="Inclui presenciais e online"
                    icon={Calendar}
                    color="gold"
                    trend={{
                        value: selectedPeriod === "hoje" ? 12 : 18,
                        isPositive: true,
                    }}
                />
                <StatCard
                    title="Total de Pacientes"
                    value={stats.pacientes}
                    subtitle={`${stats.novosPacientes} novos neste ${periodLabel(
                        selectedPeriod
                    ).toLowerCase()}`}
                    icon={Users}
                    color="green"
                    trend={{ value: 8, isPositive: true }}
                />
                <StatCard
                    title="Taxa de Conclusão"
                    value={stats.conclusao}
                    subtitle="Objetivos terapêuticos concluídos"
                    icon={Target}
                    color="gold"
                    trend={{ value: 5, isPositive: true }}
                />
                <StatCard
                    title="Avaliação Média"
                    value={stats.avaliacao}
                    subtitle="Classificação dos pacientes"
                    icon={Activity}
                    color="purple"
                    trend={{ value: 2, isPositive: true }}
                />
            </div>

            <div className="grid grid-cols-1 lg:grid-cols-3 gap-6">
                <div className="lg:col-span-2 bg-white rounded-xl shadow-md p-4 sm:p-6 border border-gray-100">
                    <div className="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3 mb-6">
                        <div>
                            <h2 className="text-lg sm:text-xl font-bold text-gray-900 flex items-center gap-2">
                                <Calendar className="w-5 h-5 text-[#b8860b]" />
                                Próximas Consultas
                            </h2>
                            <p className="text-xs text-gray-500 mt-1">
                                Organização das consultas previstas para o período actual.
                            </p>
                        </div>
                        <button className="text-sm font-medium text-[#b8860b] hover:text-[#9c7309] self-start">
                            Ver agenda completa →
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
                                        Maria Silva solicitou reagendamento para esta semana.
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
                                        Rever plano de fitoterapia de João Santos.
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div className="p-3 bg-emerald-50 border border-emerald-200 rounded-lg">
                            <div className="flex items-start gap-2">
                                <CheckCircle2 className="w-4 h-4 text-emerald-600 mt-0.5" />
                                <div>
                                    <p className="text-sm font-medium text-emerald-900">
                                        Sucessos recentes
                                    </p>
                                    <p className="text-xs text-emerald-700 mt-1">
                                        5 pacientes atingiram as metas de tratamento este{" "}
                                        {periodLabel(selectedPeriod).toLowerCase()}.
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
                        titulo="Controlo de Peso"
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
                                acao: "Prescrição de exercícios definida",
                                paciente: "Miguel Ferreira",
                                tempo: "há 2 horas",
                                icon: Dumbbell,
                                colorBg: "bg-[#f5f3ff]",
                                colorIcon: "text-purple-600",
                            },
                            {
                                acao: "Peso registado",
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
