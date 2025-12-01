"use client";

import React from "react";
import {
    Calendar,
    Target,
    TrendingUp,
    Clock,
    CheckCircle2,
    Heart,
    ChevronRight,
} from "lucide-react";

function StatCard({ title, value, subtitle, icon: Icon, tone = "primary" }) {
    const variants = {
        primary: { iconWrap: "bg-primary/10 text-primary" },
        success: { iconWrap: "bg-emerald-50 text-emerald-600" },
        info: { iconWrap: "bg-blue-50 text-blue-600" },
        accent: { iconWrap: "bg-purple-50 text-purple-600" },
    };

    const v = variants[tone] || variants.primary;

    return (
        <div className="rounded-xl border border-border bg-card/80 backdrop-blur-sm p-4 shadow-sm hover:shadow-md transition-all duration-200">
            <div className="flex items-start justify-between gap-3">
                <div className="flex-1 min-w-0">
                    <p className="text-[11px] font-semibold mb-1 text-muted-foreground uppercase tracking-[0.14em]">
                        {title}
                    </p>
                    <p className="text-2xl font-bold text-foreground mb-0.5 truncate">
                        {value}
                    </p>
                    {subtitle && (
                        <p className="text-xs text-muted-foreground">
                            {subtitle}
                        </p>
                    )}
                </div>
                <div
                    className={`inline-flex items-center justify-center p-2 rounded-xl shadow-xs ${v.iconWrap}`}
                >
                    <Icon className="w-4 h-4" />
                </div>
            </div>
        </div>
    );
}

function ConsultaCard({ data, hora, tipo, status, terapeuta }) {
    const statusConfig = {
        agendada: {
            label: "Agendada",
            badge: "bg-blue-50 text-blue-700",
        },
        concluida: {
            label: "Concluída",
            badge: "bg-emerald-50 text-emerald-700",
        },
        pendente: {
            label: "Pendente",
            badge: "bg-amber-50 text-amber-700",
        },
    };

    const config = statusConfig[status] || statusConfig.pendente;

    return (
        <div className="relative rounded-xl border border-border bg-card p-4 hover:border-primary/30 hover:shadow-md transition-all duration-200">
            <div className="flex items-start justify-between gap-3 mb-3">
                <div className="flex-1 min-w-0">
                    <h4 className="font-semibold text-sm text-foreground mb-0.5">
                        {tipo}
                    </h4>
                    <p className="text-xs text-muted-foreground">{terapeuta}</p>
                </div>
                <span
                    className={`inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-[11px] font-medium border border-border ${config.badge}`}
                >
                    <span className="inline-block w-1.5 h-1.5 rounded-full bg-current" />
                    {config.label}
                </span>
            </div>

            <div className="flex flex-wrap items-center gap-2 text-xs text-muted-foreground">
                <span className="inline-flex items-center gap-1.5 bg-muted px-2.5 py-1.5 rounded-lg">
                    <Calendar className="w-3.5 h-3.5 text-primary" />
                    {data}
                </span>
                <span className="inline-flex items-center gap-1.5 bg-muted px-2.5 py-1.5 rounded-lg">
                    <Clock className="w-3.5 h-3.5 text-primary" />
                    {hora}
                </span>
            </div>
        </div>
    );
}

function ProgressBar({ titulo, progresso, meta }) {
    return (
        <div className="space-y-1.5">
            <div className="flex items-center justify-between">
                <span className="text-xs font-medium text-foreground">
                    {titulo}
                </span>
                <span className="text-[11px] font-semibold text-primary bg-primary/5 px-2 py-0.5 rounded-full">
                    {progresso}%
                </span>
            </div>
            <div className="h-2.5 bg-muted rounded-full overflow-hidden">
                <div
                    className="h-full bg-gradient-to-r from-primary via-primary/80 to-primary/60 rounded-full transition-all duration-500"
                    style={{ width: `${progresso}%` }}
                />
            </div>
            {meta && (
                <p className="text-[11px] text-muted-foreground mt-0.5">
                    {meta}
                </p>
            )}
        </div>
    );
}

function RecommendationCard({ title, description, tone = "green" }) {
    const variants = {
        green: "bg-emerald-50/80 border-emerald-100",
        amber: "bg-amber-50/80 border-amber-100",
        blue: "bg-blue-50/80 border-blue-100",
    };

    const cls = variants[tone] || variants.green;

    return (
        <div className={`p-4 rounded-xl border text-xs sm:text-[13px] ${cls}`}>
            <p className="font-semibold text-foreground mb-1">{title}</p>
            <p className="text-muted-foreground leading-snug">{description}</p>
        </div>
    );
}

export default function ClientDashboard({ patientName = "X" }) {
    return (
        <div className="space-y-6 lg:space-y-8 pb-8 bg-background text-foreground">
            <section className="rounded-2xl border border-border bg-gradient-to-r from-background via-card to-background px-5 py-6 sm:px-8 sm:py-8 shadow-sm">
                <div className="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-6">
                    <div>
                        <p className="text-[11px] font-semibold uppercase tracking-[0.2em] text-muted-foreground mb-2">
                            Portal do Paciente
                        </p>
                        <h1 className="text-2xl sm:text-3xl font-bold tracking-tight text-foreground mb-2">
                            Olá, {patientName}
                        </h1>
                        <p className="text-sm sm:text-[15px] text-muted-foreground max-w-xl leading-relaxed">
                            Bem-vindo(a) ao seu espaço pessoal.
                        </p>
                    </div>

                    <div className="w-full lg:w-auto">
                        <div className="rounded-xl border border-border bg-card/90 px-4 py-3 shadow-xs flex items-center justify-between gap-3">
                            <div className="flex items-center gap-3">
                                <span className="inline-flex items-center justify-center rounded-lg bg-primary/10 text-primary p-2">
                                    <Calendar className="w-4 h-4" />
                                </span>
                                <div className="space-y-0.5">
                                    <p className="text-xs font-medium text-muted-foreground uppercase tracking-[0.16em]">
                                        Próxima consulta
                                    </p>
                                    <p className="text-sm font-semibold text-foreground">
                                        20 Nov às 09:00
                                    </p>
                                </div>
                            </div>
                            <button className="inline-flex items-center gap-1.5 text-xs font-medium text-primary hover:underline">
                                Ver detalhes
                                <ChevronRight className="w-3.5 h-3.5" />
                            </button>
                        </div>
                    </div>
                </div>
            </section>

            <section className="grid grid-cols-1 lg:grid-cols-[2fr_1fr] gap-6">
                <div className="rounded-2xl border border-border bg-card shadow-sm p-5 sm:p-6 h-full flex flex-col">
                    <div className="flex flex-wrap items-center justify-between gap-3 mb-6">
                        <h2 className="text-sm sm:text-base font-semibold text-foreground flex items-center gap-2.5">
                            <span className="inline-flex items-center justify-center p-2 rounded-lg bg-primary/5 text-primary">
                                <Calendar className="w-4 h-4" />
                            </span>
                            Minhas Consultas
                        </h2>
                        <button className="inline-flex items-center gap-1 text-[11px] font-medium text-primary hover:underline">
                            Ver todas
                            <ChevronRight className="w-3 h-3" />
                        </button>
                    </div>

                    <div className="space-y-3">
                        <ConsultaCard
                            data="20 Nov 2024"
                            hora="09:00"
                            tipo="Acupuntura"
                            status="agendada"
                            terapeuta="Mestre José Machado"
                        />
                        <ConsultaCard
                            data="27 Nov 2024"
                            hora="10:30"
                            tipo="Massagem Tui Na"
                            status="agendada"
                            terapeuta="Mestre José Machado"
                        />
                        <ConsultaCard
                            data="13 Nov 2024"
                            hora="14:00"
                            tipo="Fitoterapia"
                            status="concluida"
                            terapeuta="Mestre José Machado"
                        />
                    </div>
                </div>

                <div className="grid grid-rows-4 gap-4">
                    <StatCard
                        title="Próxima Consulta"
                        value="2 dias"
                        subtitle="20 Nov às 09:00"
                        icon={Calendar}
                        tone="primary"
                    />
                    <StatCard
                        title="Sessões Realizadas"
                        value="24"
                        subtitle="Este ano"
                        icon={CheckCircle2}
                        tone="success"
                    />
                    <StatCard
                        title="Progresso Geral"
                        value="78%"
                        subtitle="Objetivos atingidos"
                        icon={Target}
                        tone="info"
                    />
                    <StatCard
                        title="Próximo Objetivo"
                        value="85%"
                        subtitle="Equilíbrio energético"
                        icon={TrendingUp}
                        tone="accent"
                    />
                </div>
            </section>

            <section className="grid grid-cols-1 lg:grid-cols-2 gap-6">
                <div className="rounded-2xl border border-border bg-card shadow-sm p-5 sm:p-6 space-y-5">
                    <h2 className="text-lg sm:text-xl font-semibold text-foreground flex items-center gap-2.5">
                        <span className="inline-flex items-center justify-center p-2 rounded-lg bg-primary/5 text-primary">
                            <Target className="w-4 h-4" />
                        </span>
                        Meu Progresso
                    </h2>

                    <div className="space-y-4">
                        <ProgressBar
                            titulo="Redução de Dores"
                            progresso={85}
                            meta="Objetivo: 90% até ao fim do mês."
                        />
                        <ProgressBar
                            titulo="Qualidade do Sono"
                            progresso={70}
                            meta="Objetivo: 80% até ao fim do mês."
                        />
                        <ProgressBar
                            titulo="Níveis de Energia"
                            progresso={92}
                            meta="Meta atingida."
                        />
                        <ProgressBar
                            titulo="Controlo de Peso"
                            progresso={65}
                            meta="Objetivo: 75% até ao fim do mês."
                        />
                    </div>
                </div>

                <div className="rounded-2xl border border-border bg-card shadow-sm p-5 sm:p-6 space-y-5">
                    <h2 className="text-lg sm:text-xl font-semibold text-foreground mb-2 flex items-center gap-2.5">
                        <span className="inline-flex items-center justify-center p-2 rounded-lg bg-primary/5 text-primary">
                            <Heart className="w-4 h-4" />
                        </span>
                        Recomendações
                    </h2>

                    <div className="space-y-3">
                        <RecommendationCard
                            tone="green"
                            title="Exercícios Diários"
                            description="Mantenha a rotina de Qi Gong pela manhã para estimular o fluxo energético."
                        />
                        <RecommendationCard
                            tone="amber"
                            title="Hidratação"
                            description="Beba água morna ao longo do dia."
                        />
                        <RecommendationCard
                            tone="blue"
                            title="Horário de Sono"
                            description="Mantenha um horário consistente entre as 23h e as 7h."
                        />
                    </div>
                </div>
            </section>
        </div>
    );
}
