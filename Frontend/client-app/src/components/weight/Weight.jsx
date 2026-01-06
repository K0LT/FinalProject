"use client";

import React, { useEffect, useMemo, useState } from "react";
import { Plus, TrendingDown, TrendingUp, Target, Pencil, Save, X } from "lucide-react";

export default function WeightProgressPage() {
    const [entries, setEntries] = useState([
        { date: "2024-10-01", weight: 78.4 },
        { date: "2024-10-15", weight: 77.6 },
        { date: "2024-11-01", weight: 76.9 },
        { date: "2024-11-15", weight: 76.2 },
        { date: "2024-12-01", weight: 75.8 },
    ]);

    const [goalWeight, setGoalWeight] = useState(74.0);

    const [isModalOpen, setIsModalOpen] = useState(false);
    const [editingIndex, setEditingIndex] = useState(null);

    const [formDate, setFormDate] = useState("");
    const [formWeight, setFormWeight] = useState("");

    const [isMobile, setIsMobile] = useState(false);

    useEffect(() => {
        const mq = window.matchMedia("(max-width: 639px)");
        const update = () => setIsMobile(mq.matches);
        update();
        mq.addEventListener?.("change", update);
        return () => mq.removeEventListener?.("change", update);
    }, []);

    const sortedEntries = useMemo(() => {
        return [...entries].sort((a, b) => (a.date > b.date ? 1 : -1));
    }, [entries]);

    const latest = sortedEntries[sortedEntries.length - 1];
    const first = sortedEntries[0];

    const stats = useMemo(() => {
        const current = latest?.weight ?? 0;
        const start = first?.weight ?? 0;

        const diff = Number((current - start).toFixed(1));
        const remaining = Number((current - goalWeight).toFixed(1));
        const trend = diff < 0 ? "down" : diff > 0 ? "up" : "flat";

        const minW = Math.min(...sortedEntries.map((e) => e.weight));
        const maxW = Math.max(...sortedEntries.map((e) => e.weight));

        const avgW =
            sortedEntries.reduce((acc, e) => acc + e.weight, 0) /
            (sortedEntries.length || 1);

        return {
            current,
            start,
            diff,
            remaining,
            trend,
            minW,
            maxW,
            avgW: Number(avgW.toFixed(1)),
        };
    }, [sortedEntries, goalWeight, latest, first]);

    const progressToGoal = useMemo(() => {
        const start = stats.start || 0;
        const current = stats.current || 0;
        const goal = goalWeight || 0;

        const total = start - goal;
        const done = start - current;

        if (total <= 0) return 0;

        const pct = Math.max(0, Math.min(100, (done / total) * 100));
        return Math.round(pct);
    }, [stats.start, stats.current, goalWeight]);

    const openAdd = () => {
        setEditingIndex(null);
        setFormDate(new Date().toISOString().slice(0, 10));
        setFormWeight("");
        setIsModalOpen(true);
    };

    const openEdit = (idx) => {
        const row = sortedEntries[idx];
        setEditingIndex(idx);
        setFormDate(row.date);
        setFormWeight(String(row.weight));
        setIsModalOpen(true);
    };

    const closeModal = () => {
        setIsModalOpen(false);
        setEditingIndex(null);
        setFormDate("");
        setFormWeight("");
    };

    const upsertEntry = () => {
        const w = Number(formWeight);
        if (!formDate || !Number.isFinite(w) || w <= 0) return;

        const existingIdx = entries.findIndex((e) => e.date === formDate);
        const next = [...entries];

        if (editingIndex !== null) {
            const originalDate = sortedEntries[editingIndex]?.date;
            const originalIdx = next.findIndex((e) => e.date === originalDate);

            if (originalIdx !== -1) {
                next[originalIdx] = { date: formDate, weight: w };
            } else if (existingIdx !== -1) {
                next[existingIdx] = { date: formDate, weight: w };
            } else {
                next.push({ date: formDate, weight: w });
            }
        } else if (existingIdx !== -1) {
            next[existingIdx] = { date: formDate, weight: w };
        } else {
            next.push({ date: formDate, weight: w });
        }

        next.sort((a, b) => (a.date > b.date ? 1 : -1));
        setEntries(next);
        closeModal();
    };

    const chartData = useMemo(() => {
        if (!sortedEntries?.length) return null;

        const ys = sortedEntries.map((e) => e.weight);
        const minY = Math.min(...ys);
        const maxY = Math.max(...ys);

        const minYWithGoal = Math.min(minY, goalWeight);
        const maxYWithGoal = Math.max(maxY, goalWeight);

        return { minY: minYWithGoal, maxY: maxYWithGoal };
    }, [sortedEntries, goalWeight]);

    const lineChart = useMemo(() => {
        if (!sortedEntries || sortedEntries.length < 2 || !chartData) return null;

        const width = isMobile ? 360 : 900;
        const height = isMobile ? 300 : 260;
        const pad = isMobile ? 10 : 30;

        const xs = sortedEntries.map((_, i) => i);
        const minX = 0;
        const maxX = Math.max(...xs);

        const minY = chartData.minY;
        const maxY = chartData.maxY;

        const xScale = (x) =>
            pad + ((x - minX) / (maxX - minX || 1)) * (width - pad * 2);

        const yScale = (y) =>
            pad + (1 - (y - minY) / (maxY - minY || 1)) * (height - pad * 2);

        const points = sortedEntries
            .map((e, i) => `${xScale(i)},${yScale(e.weight)}`)
            .join(" ");

        const lastX = xScale(sortedEntries.length - 1);
        const lastY = yScale(sortedEntries[sortedEntries.length - 1].weight);

        const goalY = yScale(goalWeight);

        const minLabel = minY.toFixed(1);
        const maxLabel = maxY.toFixed(1);

        const fs = isMobile ? 22 : 14;
        const goalFs = isMobile ? 20 : 14;

        return (
            <svg
                viewBox={`0 0 ${width} ${height}`}
                className="w-full h-[260px] sm:h-[300px]"
                role="img"
                aria-label="Gráfico de evolução do peso"
            >
                <g className="text-border">
                    <line
                        x1={pad}
                        y1={height - pad}
                        x2={width - pad}
                        y2={height - pad}
                        stroke="currentColor"
                        strokeWidth="1"
                    />
                    <line
                        x1={pad}
                        y1={pad}
                        x2={pad}
                        y2={height - pad}
                        stroke="currentColor"
                        strokeWidth="1"
                    />
                    <line
                        x1={pad}
                        y1={pad}
                        x2={width - pad}
                        y2={pad}
                        stroke="currentColor"
                        strokeWidth="1"
                        opacity="0.35"
                    />
                    <line
                        x1={pad}
                        y1={(height - pad + pad) / 2}
                        x2={width - pad}
                        y2={(height - pad + pad) / 2}
                        stroke="currentColor"
                        strokeWidth="1"
                        opacity="0.25"
                    />
                </g>

                <g className="text-muted-foreground" fontSize={fs}>
                    <text x={pad} y={pad - 14} fill="currentColor">
                        {maxLabel} kg
                    </text>
                    <text x={pad} y={height - pad + fs + 10} fill="currentColor">
                        {minLabel} kg
                    </text>
                </g>

                <g className="text-muted-foreground">
                    <line
                        x1={pad}
                        y1={goalY}
                        x2={width - pad}
                        y2={goalY}
                        stroke="currentColor"
                        strokeWidth="2"
                        opacity="0.55"
                        strokeDasharray="6 6"
                    />
                    <text
                        x={width - pad}
                        y={goalY - 12}
                        textAnchor="end"
                        fontSize={goalFs}
                        fill="currentColor"
                    >
                        Objetivo: {goalWeight.toFixed(1)} kg
                    </text>
                </g>

                <g className="text-primary">
                    <polyline
                        points={points}
                        fill="none"
                        stroke="currentColor"
                        strokeWidth="3"
                        strokeLinejoin="round"
                        strokeLinecap="round"
                    />
                    <circle cx={lastX} cy={lastY} r={isMobile ? 7 : 5} fill="currentColor" />
                </g>
            </svg>
        );
    }, [sortedEntries, goalWeight, chartData, isMobile]);

    const deltaBarChart = useMemo(() => {
        if (!sortedEntries || sortedEntries.length < 2) return null;

        const width = isMobile ? 360 : 900;
        const height = isMobile ? 420 : 280;

        const padX = isMobile ? 10 : 30;
        const padY = isMobile ? 90 : 34;

        const deltas = sortedEntries.slice(1).map((e, i) => {
            const prev = sortedEntries[i].weight;
            const delta = Number((e.weight - prev).toFixed(1));
            return { date: e.date, delta };
        });

        const maxAbs = Math.max(...deltas.map((d) => Math.abs(d.delta)), 0.1);

        const plotW = width - padX * 2;
        const plotH = height - padY * 2;
        const yMid = padY + plotH / 2;

        const yScale = (delta) => yMid - (delta / maxAbs) * (plotH / 2);

        const step = plotW / deltas.length;
        const barWBase = Math.min(60, Math.max(24, step * 0.72));
        const barW = isMobile ? barWBase * 1.15 : barWBase;

        const fmt = (v) => `${v > 0 ? "+" : ""}${v.toFixed(1)} kg`;

        const axisFs = isMobile ? 22 : 14;
        const valueFs = isMobile ? 22 : 13;
        const valueOffset = isMobile ? 36 : 18;

        return (
            <svg
                viewBox={`0 0 ${width} ${height}`}
                className="w-full h-[280px] sm:h-[320px]"
                role="img"
                aria-label="Variação entre registos"
            >
                <line
                    x1={padX}
                    y1={yMid}
                    x2={width - padX}
                    y2={yMid}
                    stroke="currentColor"
                    className="text-border"
                    strokeWidth="2"
                    opacity="0.65"
                />

                <g className="text-muted-foreground" fontSize={axisFs}>
                    <text x={padX} y={padY - 22} fill="currentColor">
                        +{maxAbs.toFixed(1)} kg
                    </text>
                    <text x={padX} y={yMid - 12} fill="currentColor">
                        0 kg
                    </text>
                    <text x={padX} y={height - 16} fill="currentColor">
                        -{maxAbs.toFixed(1)} kg
                    </text>
                </g>

                {deltas.map((d, i) => {
                    const cx = padX + step * i + step / 2;
                    const x = cx - barW / 2;
                    const y = yScale(d.delta);

                    let rectY, rectH;
                    if (d.delta >= 0) {
                        rectY = y;
                        rectH = yMid - y;
                    } else {
                        rectY = yMid;
                        rectH = y - yMid;
                    }

                    rectH = Math.max(isMobile ? 10 : 6, Math.abs(rectH));

                    const isDown = d.delta < 0;

                    return (
                        <g key={d.date}>
                            <rect
                                x={x}
                                y={rectY}
                                width={barW}
                                height={rectH}
                                rx={isMobile ? 14 : 12}
                                className={isDown ? "text-primary" : "text-muted-foreground"}
                                fill="currentColor"
                                opacity={isDown ? 0.9 : 0.55}
                            />

                            <text
                                x={cx}
                                y={isDown ? rectY + rectH + valueOffset : rectY - valueOffset / 2}
                                textAnchor="middle"
                                fontSize={valueFs}
                                fill="currentColor"
                                className="text-foreground"
                            >
                                {fmt(d.delta)}
                            </text>
                        </g>
                    );
                })}
            </svg>
        );
    }, [sortedEntries, isMobile]);

    return (
        <div className="space-y-6 p-6">
            <div className="flex items-center justify-between">
                <div>
                    <h1 className="text-3xl font-bold flex items-center gap-2">Controlo de Peso</h1>
                </div>

                <button
                    onClick={openAdd}
                    className="inline-flex items-center justify-center whitespace-nowrap text-sm font-medium transition-all disabled:pointer-events-none disabled:opacity-50 outline-none focus-visible:border-ring focus-visible:ring-ring/50 focus-visible:ring-[3px] h-8 rounded-md gap-1.5 px-3 bg-primary text-primary-foreground hover:bg-primary/90"
                >
                    <Plus className="w-4 h-4 mr-2" />
                    Adicionar Peso
                </button>
            </div>

            <div className="grid grid-cols-1 md:grid-cols-4 gap-4">
                <div className="bg-card text-card-foreground flex flex-col gap-3 rounded-xl border p-5">
                    <p className="text-sm text-muted-foreground">Peso Atual</p>
                    <div className="flex items-end justify-between">
                        <p className="text-3xl font-semibold">{stats.current.toFixed(1)} kg</p>
                        <span className="inline-flex items-center justify-center rounded-md border px-2 py-0.5 text-xs font-medium w-fit whitespace-nowrap border-transparent bg-primary text-primary-foreground">
              Hoje
            </span>
                    </div>
                </div>

                <div className="bg-card text-card-foreground flex flex-col gap-3 rounded-xl border p-5">
                    <p className="text-sm text-muted-foreground">Variação Total</p>
                    <div className="flex items-center justify-between">
                        <p className="text-3xl font-semibold">
                            {stats.diff > 0 ? "+" : ""}
                            {stats.diff.toFixed(1)} kg
                        </p>
                        {stats.trend === "down" ? (
                            <TrendingDown className="w-5 h-5 text-foreground" />
                        ) : stats.trend === "up" ? (
                            <TrendingUp className="w-5 h-5 text-foreground" />
                        ) : (
                            <span className="text-muted-foreground text-sm">-</span>
                        )}
                    </div>
                    <p className="text-xs text-muted-foreground">
                        Desde {first?.date} até {latest?.date}
                    </p>
                </div>

                <div className="bg-card text-card-foreground flex flex-col gap-3 rounded-xl border p-5">
                    <p className="text-sm text-muted-foreground">Média</p>
                    <p className="text-3xl font-semibold">{stats.avgW.toFixed(1)} kg</p>
                    <p className="text-xs text-muted-foreground">
                        Min {stats.minW.toFixed(1)} kg · Max {stats.maxW.toFixed(1)} kg
                    </p>
                </div>

                <div className="bg-card text-card-foreground flex flex-col gap-3 rounded-xl border p-5">
                    <div className="flex items-center justify-between">
                        <p className="text-sm text-muted-foreground">Objetivo</p>
                        <span className="inline-flex items-center gap-1 rounded-md border px-2 py-0.5 text-xs font-medium border-transparent bg-secondary text-secondary-foreground">
              <Target className="w-3.5 h-3.5" />
                            {goalWeight.toFixed(1)} kg
            </span>
                    </div>

                    <div className="space-y-2">
                        <div className="h-2 rounded-full bg-muted overflow-hidden">
                            <div className="h-full bg-primary" style={{ width: `${progressToGoal}%` }} />
                        </div>
                        <p className="text-xs text-muted-foreground">
                            {progressToGoal}% concluído · faltam{" "}
                            <span className="font-medium text-foreground">
                {Math.max(0, stats.remaining).toFixed(1)} kg
              </span>
                        </p>
                    </div>

                    <div className="pt-2">
                        <label className="text-xs text-muted-foreground">Atualizar objetivo</label>
                        <div className="flex gap-2 mt-1">
                            <input
                                value={goalWeight}
                                onChange={(e) => setGoalWeight(Number(e.target.value))}
                                type="number"
                                step="0.1"
                                className="h-8 w-full rounded-md border bg-background px-3 text-sm outline-none focus-visible:border-ring focus-visible:ring-ring/50 focus-visible:ring-[3px]"
                            />
                        </div>
                    </div>
                </div>
            </div>

            <div className="grid grid-cols-1 lg:grid-cols-2 gap-4 items-stretch">
                <div className="bg-card text-card-foreground flex flex-col gap-4 rounded-xl border p-5 min-h-[360px]">
                    <div className="flex items-center justify-between">
                        <div>
                            <h3 className="font-semibold">Progresso do Peso</h3>
                            <p className="text-sm text-muted-foreground">Evolução por registos (linha) + objetivo.</p>
                        </div>
                        <span className="inline-flex items-center justify-center rounded-md border px-2 py-0.5 text-xs font-medium w-fit whitespace-nowrap border-transparent bg-secondary text-secondary-foreground">
              {sortedEntries.length} registos
            </span>
                    </div>

                    <div className="rounded-xl border bg-background p-3 flex-1 flex items-center">
                        <div className="w-full">{lineChart}</div>
                    </div>
                </div>

                <div className="bg-card text-card-foreground flex flex-col gap-4 rounded-xl border p-5 min-h-[360px]">
                    <div>
                        <h3 className="font-semibold">Variação entre registos</h3>
                        <p className="text-sm text-muted-foreground">
                            Barras por intervalo (positivo = subiu, negativo = desceu).
                        </p>
                    </div>

                    <div className="rounded-xl border bg-background p-3 flex-1 flex items-center">
                        <div className="w-full">{deltaBarChart}</div>
                    </div>
                </div>
            </div>

            <div className="bg-card text-card-foreground flex flex-col gap-4 rounded-xl border">
                <div className="px-6 pt-6">
                    <div>
                        <h3 className="font-semibold">Histórico de Registos</h3>
                        <p className="text-sm text-muted-foreground">
                            Edita ou adiciona registos para manter o progresso atualizado.
                        </p>
                    </div>
                </div>

                <div className="px-6 pb-6">
                    <div className="overflow-x-auto rounded-xl border">
                        <table className="w-full text-sm">
                            <thead className="bg-muted text-muted-foreground">
                            <tr>
                                <th className="text-left font-medium px-4 py-3">Data</th>
                                <th className="text-left font-medium px-4 py-3">Peso (kg)</th>
                                <th className="text-right font-medium px-4 py-3">Ações</th>
                            </tr>
                            </thead>
                            <tbody>
                            {sortedEntries
                                .slice()
                                .reverse()
                                .map((row, revIdx) => {
                                    const idx = sortedEntries.length - 1 - revIdx;
                                    return (
                                        <tr key={`${row.date}-${revIdx}`} className="border-t">
                                            <td className="px-4 py-3">{row.date}</td>
                                            <td className="px-4 py-3">{row.weight.toFixed(1)}</td>
                                            <td className="px-4 py-3 text-right">
                                                <button
                                                    onClick={() => openEdit(idx)}
                                                    className="inline-flex items-center justify-center whitespace-nowrap text-sm font-medium transition-all disabled:pointer-events-none disabled:opacity-50 outline-none focus-visible:border-ring focus-visible:ring-ring/50 focus-visible:ring-[3px] h-8 rounded-md gap-1.5 px-3 border bg-background text-foreground hover:bg-accent hover:text-accent-foreground dark:bg-input/30 dark:border-input dark:hover:bg-input/50"
                                                >
                                                    <Pencil className="w-4 h-4 mr-2" />
                                                    Editar
                                                </button>
                                            </td>
                                        </tr>
                                    );
                                })}
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            {isModalOpen && (
                <div className="fixed inset-0 z-50 flex items-center justify-center">
                    <div className="absolute inset-0 bg-black/40 backdrop-blur-sm" onClick={closeModal} />

                    <div className="relative w-full max-w-md mx-4 bg-card text-card-foreground rounded-xl border shadow-lg">
                        <div className="px-6 pt-6 flex items-start justify-between">
                            <div className="space-y-1">
                                <h3 className="font-semibold">
                                    {editingIndex !== null ? "Atualizar Peso" : "Adicionar Peso"}
                                </h3>
                                <p className="text-sm text-muted-foreground">Regista a data e o peso em kg.</p>
                            </div>

                            <button
                                onClick={closeModal}
                                className="inline-flex items-center justify-center rounded-full p-1.5 hover:bg-accent transition-colors"
                            >
                                <X className="w-4 h-4" />
                            </button>
                        </div>

                        <div className="px-6 py-5 space-y-4">
                            <div className="space-y-2">
                                <label className="text-sm font-medium">Data</label>
                                <input
                                    type="date"
                                    value={formDate}
                                    onChange={(e) => setFormDate(e.target.value)}
                                    className="h-9 w-full rounded-md border bg-background px-3 text-sm outline-none focus-visible:border-ring focus-visible:ring-ring/50 focus-visible:ring-[3px]"
                                />
                            </div>

                            <div className="space-y-2">
                                <label className="text-sm font-medium">Peso (kg)</label>
                                <input
                                    type="number"
                                    step="0.1"
                                    value={formWeight}
                                    onChange={(e) => setFormWeight(e.target.value)}
                                    placeholder="Ex: 75.8"
                                    className="h-9 w-full rounded-md border bg-background px-3 text-sm outline-none focus-visible:border-ring focus-visible:ring-ring/50 focus-visible:ring-[3px]"
                                />
                            </div>
                        </div>

                        <div className="px-6 pb-6 flex gap-2 justify-end">
                            <button
                                onClick={closeModal}
                                className="inline-flex items-center justify-center whitespace-nowrap text-sm font-medium transition-all disabled:pointer-events-none disabled:opacity-50 outline-none focus-visible:border-ring focus-visible:ring-ring/50 focus-visible:ring-[3px] h-9 rounded-md gap-1.5 px-3 border bg-background text-foreground hover:bg-accent hover:text-accent-foreground dark:bg-input/30 dark:border-input dark:hover:bg-input/50"
                            >
                                <X className="w-4 h-4 mr-2" />
                                Cancelar
                            </button>

                            <button
                                onClick={upsertEntry}
                                className="inline-flex items-center justify-center whitespace-nowrap text-sm font-medium transition-all disabled:pointer-events-none disabled:opacity-50 outline-none focus-visible:border-ring focus-visible:ring-ring/50 focus-visible:ring-[3px] h-9 rounded-md gap-1.5 px-3 bg-primary text-primary-foreground hover:bg-primary/90"
                            >
                                <Save className="w-4 h-4 mr-2" />
                                Guardar
                            </button>
                        </div>
                    </div>
                </div>
            )}
        </div>
    );
}
