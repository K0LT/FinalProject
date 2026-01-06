"use client";

import React, { useState, useMemo } from "react";
import {
    FileText,
    Users,
    Activity,
    Calendar,
    TrendingUp,
    Search,
    Download,
    Filter,
    BarChart3,
    PieChart,
    LineChart,
    X,
    ChevronRight,
} from "lucide-react";

export default function ReportsPage() {
    const [searchTerm, setSearchTerm] = useState("");
    const [selectedCategory, setSelectedCategory] = useState("all");
    const [dateFrom, setDateFrom] = useState("");
    const [dateTo, setDateTo] = useState("");
    const [selectedReport, setSelectedReport] = useState(null);

    const reportCategories = [
        { id: "all", name: "Todos", icon: FileText },
        { id: "clients", name: "Clientes", icon: Users },
        { id: "treatments", name: "Tratamentos", icon: Activity },
        { id: "appointments", name: "Consultas", icon: Calendar },
        { id: "financial", name: "Financeiro", icon: TrendingUp },
    ];

    const allReports = [
        // Relatórios de Clientes
        {
            id: "clients-registered",
            category: "clients",
            name: "Clientes Registados",
            description: "Total de clientes registados no sistema",
            icon: Users,
            color: "text-blue-500",
            bgColor: "bg-blue-500/10",
        },
        {
            id: "clients-active",
            category: "clients",
            name: "Clientes Ativos",
            description: "Clientes com consultas nos últimos 3 meses",
            icon: Users,
            color: "text-green-500",
            bgColor: "bg-green-500/10",
        },
        {
            id: "clients-inactive",
            category: "clients",
            name: "Clientes Inativos",
            description: "Clientes sem atividade recente",
            icon: Users,
            color: "text-orange-500",
            bgColor: "bg-orange-500/10",
        },
        {
            id: "clients-by-age",
            category: "clients",
            name: "Clientes por Faixa Etária",
            description: "Distribuição de clientes por idade",
            icon: PieChart,
            color: "text-purple-500",
            bgColor: "bg-purple-500/10",
        },
        {
            id: "clients-new",
            category: "clients",
            name: "Novos Clientes",
            description: "Clientes registados por período",
            icon: TrendingUp,
            color: "text-teal-500",
            bgColor: "bg-teal-500/10",
        },

        // Relatórios de Tratamentos
        {
            id: "treatments-popular",
            category: "treatments",
            name: "Tratamentos Mais Usados",
            description: "Top tratamentos por número de sessões",
            icon: BarChart3,
            color: "text-blue-500",
            bgColor: "bg-blue-500/10",
        },
        {
            id: "treatments-least",
            category: "treatments",
            name: "Tratamentos Menos Usados",
            description: "Tratamentos com menor procura",
            icon: BarChart3,
            color: "text-orange-500",
            bgColor: "bg-orange-500/10",
        },
        {
            id: "treatments-revenue",
            category: "treatments",
            name: "Receita por Tratamento",
            description: "Valor gerado por cada tipo de tratamento",
            icon: TrendingUp,
            color: "text-green-500",
            bgColor: "bg-green-500/10",
        },
        {
            id: "treatments-duration",
            category: "treatments",
            name: "Duração Média dos Tratamentos",
            description: "Tempo médio de cada tratamento",
            icon: Activity,
            color: "text-purple-500",
            bgColor: "bg-purple-500/10",
        },
        {
            id: "treatments-completion",
            category: "treatments",
            name: "Taxa de Conclusão",
            description: "Tratamentos completados vs. interrompidos",
            icon: PieChart,
            color: "text-teal-500",
            bgColor: "bg-teal-500/10",
        },

        // Relatórios de Consultas
        {
            id: "appointments-total",
            category: "appointments",
            name: "Total de Consultas",
            description: "Número total de consultas agendadas",
            icon: Calendar,
            color: "text-blue-500",
            bgColor: "bg-blue-500/10",
        },
        {
            id: "appointments-completed",
            category: "appointments",
            name: "Consultas Realizadas",
            description: "Consultas concluídas com sucesso",
            icon: Calendar,
            color: "text-green-500",
            bgColor: "bg-green-500/10",
        },
        {
            id: "appointments-cancelled",
            category: "appointments",
            name: "Consultas Canceladas",
            description: "Taxa de cancelamento de consultas",
            icon: Calendar,
            color: "text-red-500",
            bgColor: "bg-red-500/10",
        },
        {
            id: "appointments-by-day",
            category: "appointments",
            name: "Consultas por Dia da Semana",
            description: "Distribuição semanal de consultas",
            icon: BarChart3,
            color: "text-purple-500",
            bgColor: "bg-purple-500/10",
        },
        {
            id: "appointments-peak-hours",
            category: "appointments",
            name: "Horários de Pico",
            description: "Horários mais agendados",
            icon: LineChart,
            color: "text-orange-500",
            bgColor: "bg-orange-500/10",
        },
        {
            id: "appointments-no-show",
            category: "appointments",
            name: "Faltas",
            description: "Clientes que faltaram às consultas",
            icon: Calendar,
            color: "text-red-500",
            bgColor: "bg-red-500/10",
        },

        // Relatórios Financeiros
        {
            id: "financial-revenue",
            category: "financial",
            name: "Receita Total",
            description: "Receita total por período",
            icon: TrendingUp,
            color: "text-green-500",
            bgColor: "bg-green-500/10",
        },
        {
            id: "financial-monthly",
            category: "financial",
            name: "Receita Mensal",
            description: "Evolução da receita por mês",
            icon: LineChart,
            color: "text-blue-500",
            bgColor: "bg-blue-500/10",
        },
        {
            id: "financial-payment-methods",
            category: "financial",
            name: "Métodos de Pagamento",
            description: "Distribuição por forma de pagamento",
            icon: PieChart,
            color: "text-purple-500",
            bgColor: "bg-purple-500/10",
        },
        {
            id: "financial-pending",
            category: "financial",
            name: "Pagamentos Pendentes",
            description: "Valores em aberto",
            icon: TrendingUp,
            color: "text-orange-500",
            bgColor: "bg-orange-500/10",
        },
        {
            id: "financial-top-clients",
            category: "financial",
            name: "Clientes Top",
            description: "Clientes com maior volume de pagamentos",
            icon: Users,
            color: "text-teal-500",
            bgColor: "bg-teal-500/10",
        },
    ];

    const filteredReports = useMemo(() => {
        return allReports.filter((report) => {
            const matchesSearch =
                report.name.toLowerCase().includes(searchTerm.toLowerCase()) ||
                report.description.toLowerCase().includes(searchTerm.toLowerCase());
            const matchesCategory =
                selectedCategory === "all" || report.category === selectedCategory;
            return matchesSearch && matchesCategory;
        });
    }, [searchTerm, selectedCategory]);

    const stats = [
        { label: "Total de Relatórios", value: allReports.length, color: "text-blue-500" },
        { label: "Clientes", value: allReports.filter(r => r.category === "clients").length, color: "text-green-500" },
        { label: "Tratamentos", value: allReports.filter(r => r.category === "treatments").length, color: "text-purple-500" },
        { label: "Financeiro", value: allReports.filter(r => r.category === "financial").length, color: "text-orange-500" },
    ];

    const generateMockData = (reportId) => {
        const mockData = {
            "clients-registered": {
                total: 156,
                trend: "+12%",
                chart: [45, 52, 61, 73, 89, 102, 124, 138, 145, 152, 156],
            },
            "clients-active": {
                total: 98,
                trend: "+8%",
                chart: [62, 68, 71, 75, 82, 85, 88, 91, 94, 96, 98],
            },
            "treatments-popular": {
                data: [
                    { name: "Fisioterapia", value: 85, color: "bg-blue-500" },
                    { name: "Massagem", value: 72, color: "bg-green-500" },
                    { name: "Acupuntura", value: 58, color: "bg-purple-500" },
                    { name: "Osteopatia", value: 45, color: "bg-orange-500" },
                    { name: "Reabilitação", value: 32, color: "bg-teal-500" },
                ],
            },
            "financial-revenue": {
                total: "€24,850",
                trend: "+15%",
                chart: [12000, 14500, 16200, 18400, 19800, 21200, 22500, 23100, 23800, 24300, 24850],
            },
        };
        return mockData[reportId] || null;
    };

    const renderReportPreview = (report) => {
        const data = generateMockData(report.id);
        if (!data) return null;

        if (data.total && data.chart) {
            const max = Math.max(...data.chart);
            return (
                <div className="mt-4 space-y-3">
                    <div className="flex items-end justify-between">
                        <div>
                            <p className="text-2xl font-bold">{data.total}</p>
                            <p className="text-sm text-green-500">{data.trend} vs. período anterior</p>
                        </div>
                    </div>
                    <div className="flex items-end gap-1 h-24">
                        {data.chart.map((value, i) => (
                            <div
                                key={i}
                                className="flex-1 bg-primary rounded-t transition-all hover:opacity-80"
                                style={{ height: `${(value / max) * 100}%` }}
                            />
                        ))}
                    </div>
                </div>
            );
        }

        if (data.data) {
            const max = Math.max(...data.data.map(d => d.value));
            return (
                <div className="mt-4 space-y-2">
                    {data.data.map((item, i) => (
                        <div key={i} className="space-y-1">
                            <div className="flex justify-between text-sm">
                                <span>{item.name}</span>
                                <span className="font-medium">{item.value}</span>
                            </div>
                            <div className="h-2 rounded-full bg-muted overflow-hidden">
                                <div
                                    className={`h-full ${item.color} transition-all`}
                                    style={{ width: `${(item.value / max) * 100}%` }}
                                />
                            </div>
                        </div>
                    ))}
                </div>
            );
        }

        return null;
    };

    return (
        <div className="space-y-6 p-6">
            <div className="flex items-center justify-between">
                <div>
                    <h1 className="text-3xl font-bold flex items-center gap-2">
                        Relatórios
                    </h1>
                    <p className="text-muted-foreground mt-1">
                        Visualize e exporte relatórios detalhados do sistema
                    </p>
                </div>
            </div>

            <div className="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
                {stats.map((stat, i) => (
                    <div key={i} className="bg-card text-card-foreground flex flex-col gap-3 rounded-xl border p-5">
                        <p className="text-sm text-muted-foreground">{stat.label}</p>
                        <p className={`text-3xl font-semibold ${stat.color}`}>{stat.value}</p>
                    </div>
                ))}
            </div>

            <div className="bg-card text-card-foreground rounded-xl border p-5 space-y-4">
                <div className="flex flex-col sm:flex-row gap-3">
                    <div className="flex-1 relative">
                        <Search className="absolute left-3 top-1/2 -translate-y-1/2 w-4 h-4 text-muted-foreground" />
                        <input
                            type="text"
                            placeholder="Pesquisar relatórios..."
                            value={searchTerm}
                            onChange={(e) => setSearchTerm(e.target.value)}
                            className="h-10 w-full rounded-md border bg-background pl-10 pr-3 text-sm outline-none focus-visible:border-ring focus-visible:ring-ring/50 focus-visible:ring-[3px]"
                        />
                    </div>

                    <div className="flex gap-2">
                        <div className="relative">
                            <Filter className="absolute left-3 top-1/2 -translate-y-1/2 w-4 h-4 text-muted-foreground pointer-events-none" />
                            <select
                                value={selectedCategory}
                                onChange={(e) => setSelectedCategory(e.target.value)}
                                className="h-10 rounded-md border bg-background pl-10 pr-8 text-sm outline-none focus-visible:border-ring focus-visible:ring-ring/50 focus-visible:ring-[3px] appearance-none"
                            >
                                {reportCategories.map((cat) => (
                                    <option key={cat.id} value={cat.id}>
                                        {cat.name}
                                    </option>
                                ))}
                            </select>
                        </div>

                        <input
                            type="date"
                            value={dateFrom}
                            onChange={(e) => setDateFrom(e.target.value)}
                            placeholder="Data início"
                            className="h-10 rounded-md border bg-background px-3 text-sm outline-none focus-visible:border-ring focus-visible:ring-ring/50 focus-visible:ring-[3px]"
                        />

                        <input
                            type="date"
                            value={dateTo}
                            onChange={(e) => setDateTo(e.target.value)}
                            placeholder="Data fim"
                            className="h-10 rounded-md border bg-background px-3 text-sm outline-none focus-visible:border-ring focus-visible:ring-ring/50 focus-visible:ring-[3px]"
                        />
                    </div>
                </div>

                {(searchTerm || selectedCategory !== "all" || dateFrom || dateTo) && (
                    <div className="flex items-center gap-2 flex-wrap">
                        <span className="text-sm text-muted-foreground">Filtros ativos:</span>
                        {searchTerm && (
                            <span className="inline-flex items-center gap-1 rounded-md border px-2 py-1 text-xs font-medium border-transparent bg-secondary text-secondary-foreground">
                Pesquisa: {searchTerm}
                                <X className="w-3 h-3 cursor-pointer" onClick={() => setSearchTerm("")} />
              </span>
                        )}
                        {selectedCategory !== "all" && (
                            <span className="inline-flex items-center gap-1 rounded-md border px-2 py-1 text-xs font-medium border-transparent bg-secondary text-secondary-foreground">
                {reportCategories.find((c) => c.id === selectedCategory)?.name}
                                <X className="w-3 h-3 cursor-pointer" onClick={() => setSelectedCategory("all")} />
              </span>
                        )}
                        {dateFrom && (
                            <span className="inline-flex items-center gap-1 rounded-md border px-2 py-1 text-xs font-medium border-transparent bg-secondary text-secondary-foreground">
                De: {dateFrom}
                                <X className="w-3 h-3 cursor-pointer" onClick={() => setDateFrom("")} />
              </span>
                        )}
                        {dateTo && (
                            <span className="inline-flex items-center gap-1 rounded-md border px-2 py-1 text-xs font-medium border-transparent bg-secondary text-secondary-foreground">
                Até: {dateTo}
                                <X className="w-3 h-3 cursor-pointer" onClick={() => setDateTo("")} />
              </span>
                        )}
                    </div>
                )}
            </div>

            <div className="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                {filteredReports.map((report) => {
                    const Icon = report.icon;
                    return (
                        <div
                            key={report.id}
                            className="bg-card text-card-foreground rounded-xl border p-5 hover:shadow-lg transition-all cursor-pointer group"
                            onClick={() => setSelectedReport(report)}
                        >
                            <div className="flex items-start justify-between mb-3">
                                <div className={`p-3 rounded-lg ${report.bgColor}`}>
                                    <Icon className={`w-6 h-6 ${report.color}`} />
                                </div>
                                <ChevronRight className="w-5 h-5 text-muted-foreground group-hover:text-foreground transition-colors" />
                            </div>

                            <h3 className="font-semibold mb-1">{report.name}</h3>
                            <p className="text-sm text-muted-foreground mb-3">{report.description}</p>

                            <div className="flex gap-2">
                                <button className="flex-1 inline-flex items-center justify-center whitespace-nowrap text-xs font-medium transition-all h-8 rounded-md px-3 border bg-background hover:bg-accent">
                                    <BarChart3 className="w-3.5 h-3.5 mr-1.5" />
                                    Ver
                                </button>
                                <button className="inline-flex items-center justify-center whitespace-nowrap text-xs font-medium transition-all h-8 rounded-md px-3 border bg-background hover:bg-accent">
                                    <Download className="w-3.5 h-3.5" />
                                </button>
                            </div>
                        </div>
                    );
                })}
            </div>

            {filteredReports.length === 0 && (
                <div className="text-center py-12">
                    <FileText className="w-12 h-12 text-muted-foreground mx-auto mb-3" />
                    <p className="text-muted-foreground">Nenhum relatório encontrado</p>
                </div>
            )}

            {selectedReport && (
                <div className="fixed inset-0 z-50 flex items-center justify-center p-4">
                    <div className="absolute inset-0 bg-black/40 backdrop-blur-sm" onClick={() => setSelectedReport(null)} />

                    <div className="relative w-full max-w-2xl bg-card text-card-foreground rounded-xl border shadow-lg max-h-[90vh] overflow-y-auto">
                        <div className="sticky top-0 bg-card border-b px-6 py-4 flex items-start justify-between">
                            <div className="flex items-start gap-3">
                                <div className={`p-3 rounded-lg ${selectedReport.bgColor}`}>
                                    <selectedReport.icon className={`w-6 h-6 ${selectedReport.color}`} />
                                </div>
                                <div>
                                    <h3 className="font-semibold text-lg">{selectedReport.name}</h3>
                                    <p className="text-sm text-muted-foreground">{selectedReport.description}</p>
                                </div>
                            </div>
                            <button
                                onClick={() => setSelectedReport(null)}
                                className="inline-flex items-center justify-center rounded-full p-1.5 hover:bg-accent transition-colors"
                            >
                                <X className="w-4 h-4" />
                            </button>
                        </div>

                        <div className="p-6">
                            <div className="space-y-4">
                                <div className="flex gap-3">
                                    <div className="flex-1">
                                        <label className="text-sm font-medium block mb-2">Data Início</label>
                                        <input
                                            type="date"
                                            className="h-9 w-full rounded-md border bg-background px-3 text-sm outline-none focus-visible:border-ring focus-visible:ring-ring/50 focus-visible:ring-[3px]"
                                        />
                                    </div>
                                    <div className="flex-1">
                                        <label className="text-sm font-medium block mb-2">Data Fim</label>
                                        <input
                                            type="date"
                                            className="h-9 w-full rounded-md border bg-background px-3 text-sm outline-none focus-visible:border-ring focus-visible:ring-ring/50 focus-visible:ring-[3px]"
                                        />
                                    </div>
                                </div>

                                <div className="rounded-lg border bg-background p-4">
                                    <h4 className="font-medium mb-3">Pré-visualização</h4>
                                    {renderReportPreview(selectedReport)}
                                </div>
                            </div>
                        </div>

                        <div className="sticky bottom-0 bg-card border-t px-6 py-4 flex gap-3 justify-end">
                            <button
                                onClick={() => setSelectedReport(null)}
                                className="inline-flex items-center justify-center whitespace-nowrap text-sm font-medium transition-all h-9 rounded-md px-4 border bg-background hover:bg-accent"
                            >
                                Cancelar
                            </button>
                            <button className="inline-flex items-center justify-center whitespace-nowrap text-sm font-medium transition-all h-9 rounded-md px-4 bg-primary text-primary-foreground hover:bg-primary/90">
                                <Download className="w-4 h-4 mr-2" />
                                Exportar PDF
                            </button>
                        </div>
                    </div>
                </div>
            )}
        </div>
    );
}