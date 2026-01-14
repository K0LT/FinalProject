"use client";

import React, { useState, useEffect } from "react";
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
import { useAuth } from "@/context/AuthContext";
import { useApi } from "@/hooks/useApi";
import StatCard from "@/components/dashboard/StatCard";
import ConsultaCard from "@/components/dashboard/ConsultaCard";
import ObjectiveProgress from "@/components/dashboard/ObjectiveProgress";

const periodLabel = (p) =>
    p === "hoje" ? "Hoje" : p === "semana" ? "Semana" : "Mês";

export default function Dashboard() {
    const { user, isAuthenticated } = useAuth();
    const { get, loading } = useApi();

    const [selectedPeriod, setSelectedPeriod] = useState("hoje");
    const [patients, setPatients] = useState([]);
    const [appointments, setAppointments] = useState([]);
    const [treatmentGoals, setTreatmentGoals] = useState([]);
    const [progressNotes, setProgressNotes] = useState([]);
    const [diagnostics, setDiagnostics] = useState([]);
    const [exercises, setExercises] = useState([]);

    useEffect(() => {
        if (isAuthenticated && user) {
            loadAllData();
        }
    }, [isAuthenticated, user]);

    const loadAllData = async () => {
        try {

            const [
                patientsRes,
                appointmentsRes,
                goalsRes,
                notesRes,
                diagnosticsRes,
                exercisesRes
            ] = await Promise.all([
                get('/api/patients'),
                get('/api/appointments'),
                get('/api/treatment_goals'),
                get('/api/progress_notes'),
                get('/api/diagnostics'),
                get('/api/exercises')
            ]);


            // Extract data from responses - some return {data: [...]}, some return arrays directly
            const patients = patientsRes?.data || patientsRes || [];
            const appointments = Array.isArray(appointmentsRes) ? appointmentsRes : [];
            const goals = goalsRes?.data || goalsRes || [];
            const notes = notesRes?.data || notesRes || [];
            const diagnostics = diagnosticsRes?.data || diagnosticsRes || [];
            const exercises = exercisesRes?.data || exercisesRes || [];

            setPatients(Array.isArray(patients) ? patients : []);
            setAppointments(appointments);
            setTreatmentGoals(Array.isArray(goals) ? goals : []);
            setProgressNotes(Array.isArray(notes) ? notes : []);
            setDiagnostics(Array.isArray(diagnostics) ? diagnostics : []);
            setExercises(Array.isArray(exercises) ? exercises : []);

        } catch (err) {
            console.error('Erro ao carregar dados:', err);
        }
    };

    // Calcular estatísticas
    const calculateStats = () => {
        const today = new Date();
        today.setHours(0, 0, 0, 0);

        let startDate;
        switch(selectedPeriod) {
            case "hoje":
                startDate = new Date(today);
                break;
            case "semana":
                startDate = new Date(today);
                startDate.setDate(today.getDate() - 7);
                break;
            case "mes":
                startDate = new Date(today.getFullYear(), today.getMonth() - 1, today.getDate());
                break;
        }

        // Consultas no período
        const periodAppointments = appointments.filter(app => {
            if (!app.date) return false;
            const appDate = new Date(app.date);
            return appDate >= startDate;
        });



        // Pacientes novos no período
        const newPatients = patients.filter(patient => {
            if (!patient.created_at) return false;
            const createdDate = new Date(patient.created_at);
            return createdDate >= startDate;
        });

        // Consultas concluídas no período
        const completedAppointments = periodAppointments.filter(app =>
            app.status === 'completed' || app.status === 'concluida' || app.status === 'finished'
        ).length;

        // Taxa de conclusão
        const completionRate = periodAppointments.length > 0
            ? Math.round((completedAppointments / periodAppointments.length) * 100)
            : 0;

        return {
            consultas: periodAppointments.length,
            pacientes: patients.length,
            novosPacientes: newPatients.length,
            conclusao: `${completionRate}%`,
            avaliacao: "0.0",
        };
    };

    // Próximas consultas
    const getUpcomingAppointments = () => {
        const today = new Date();
        today.setHours(0, 0, 0, 0);

        return appointments
            .filter(app => {
                if (!app.date) return false;
                const appDate = new Date(app.date);
                return appDate >= today;
            })
            .sort((a, b) => new Date(a.date) - new Date(b.date))
            .slice(0, 4);
    };


    const getAlerts = () => {
        const alerts = [];


        const urgentAppointments = appointments.filter(app =>
            app.status === 'urgent' || app.priority === 'high'
        );
        if (urgentAppointments.length > 0) {
            alerts.push({
                type: 'urgent',
                title: 'Consultas urgentes',
                message: `${urgentAppointments.length} consulta(s) marcada(s) como urgente`
            });
        }

        // Consultas para hoje sem confirmação
        const today = new Date().toDateString();
        const todayAppointments = appointments.filter(app => {
            if (!app.date) return false;
            const appDate = new Date(app.date).toDateString();
            return appDate === today && (app.status === 'pending' || !app.status);
        });
        if (todayAppointments.length > 0) {
            alerts.push({
                type: 'warning',
                title: 'Confirmações pendentes',
                message: `${todayAppointments.length} consulta(s) para hoje precisa(m) confirmação`
            });
        }

        // Objetivos próximos da conclusão
        const goalsNearCompletion = treatmentGoals.filter(goal =>
            (goal.progress || goal.completion_percentage || 0) >= 90
        );
        if (goalsNearCompletion.length > 0) {
            alerts.push({
                type: 'success',
                title: 'Metas próximas',
                message: `${goalsNearCompletion.length} objetivo(s) perto de conclusão`
            });
        }

        return alerts;
    };

    // Atividades recentes
    const getRecentActivities = () => {
        const activities = [];

        // Combinar todas as atividades
        const allActivities = [
            // Progress notes
            ...progressNotes.map(note => ({
                id: `note_${note.id}`,
                action: "Nota de progresso registada",
                paciente: note.patient?.name || "Paciente",
                created_at: note.created_at,
                icon: Activity,
                colorBg: "bg-emerald-50",
                colorIcon: "text-emerald-600",
            })),

            // Diagnostics
            ...diagnostics.map(diag => ({
                id: `diag_${diag.id}`,
                action: "Diagnóstico registado",
                paciente: diag.patient?.name || "Paciente",
                created_at: diag.created_at,
                icon: Activity,
                colorBg: "bg-emerald-50",
                colorIcon: "text-emerald-600",
            })),

            // Exercises
            ...exercises.map(ex => ({
                id: `ex_${ex.id}`,
                action: "Exercício prescrito",
                paciente: ex.patient?.name || "Paciente",
                created_at: ex.created_at,
                icon: Dumbbell,
                colorBg: "bg-[#f5f3ff]",
                colorIcon: "text-purple-600",
            }))
        ];


        allActivities.sort((a, b) =>
            new Date(b.created_at || 0) - new Date(a.created_at || 0)
        );


        const recent = allActivities.slice(0, 4);

        // Se não houver atividades suficientes, criar placeholder vazio
        while (recent.length < 4) {
            recent.push({
                id: `placeholder_${recent.length}`,
                action: "Sem atividade registada",
                paciente: "---",
                created_at: null,
                icon: Activity,
                colorBg: "bg-gray-50",
                colorIcon: "text-gray-400",
            });
        }


        return recent.map(activity => {
            let tempo = "---";
            if (activity.created_at) {
                const now = new Date();
                const created = new Date(activity.created_at);
                const diffHours = Math.floor((now - created) / (1000 * 60 * 60));

                if (diffHours === 0) {
                    tempo = "há poucos minutos";
                } else if (diffHours === 1) {
                    tempo = "há 1 hora";
                } else if (diffHours < 24) {
                    tempo = `há ${diffHours} horas`;
                } else {
                    const diffDays = Math.floor(diffHours / 24);
                    tempo = diffDays === 1 ? "há 1 dia" : `há ${diffDays} dias`;
                }
            }

            return {
                ...activity,
                tempo
            };
        });
    };

    if (loading) {
        return (
            <div className="flex items-center justify-center min-h-[400px]">
                <div className="animate-spin rounded-full h-12 w-12 border-b-2 border-blue-600"></div>
            </div>
        );
    }

    const stats = calculateStats();
    const upcomingAppointments = getUpcomingAppointments();
    const alerts = getAlerts();
    const recentActivities = getRecentActivities();

    return (
        <div className="max-w-7xl mx-auto space-y-8">
            {/* Header - NOME REAL do usuário */}
            <div className="flex flex-col gap-2 sm:flex-row sm:items-end sm:justify-between">
                <div>
                    <h1 className="text-2xl sm:text-3xl font-bold text-gray-900 mb-1">
                        {user?.name || ''} {user?.surname || ''}
                    </h1>
                    <p className="text-sm sm:text-base text-gray-600">
                        {user?.role?.name || 'Utilizador'} · Painel de Actividade
                    </p>
                </div>
                <div className="flex flex-col items-start sm:items-end gap-1 text-xs">
                    <span className="inline-flex items-center gap-2 rounded-full bg-gray-100 px-3 py-1 font-medium text-gray-700">
                        <Clock className="w-3 h-3" />
                        Resumo do período: {periodLabel(selectedPeriod)}
                    </span>
                    <p className="text-[11px] text-gray-500">
                        {patients.length} pacientes · {appointments.length} consultas
                    </p>
                </div>
            </div>

            {/* Selector de período */}
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

            {/* Estatísticas REAIS */}
            <div className="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                <StatCard
                    title="Consultas no período"
                    value={stats.consultas}
                    subtitle="Agendadas"
                    icon={Calendar}
                    color="gold"
                    trend={{
                        value: 0,
                        isPositive: false,
                    }}
                />
                <StatCard
                    title="Total de Pacientes"
                    value={stats.pacientes}
                    subtitle={`${stats.novosPacientes} novos`}
                    icon={Users}
                    color="green"
                    trend={{
                        value: 0,
                        isPositive: false
                    }}
                />
                <StatCard
                    title="Taxa de Conclusão"
                    value={stats.conclusao}
                    subtitle="Consultas concluídas"
                    icon={Target}
                    color="gold"
                    trend={{
                        value: 0,
                        isPositive: false
                    }}
                />
                <StatCard
                    title="Avaliação Média"
                    value={stats.avaliacao}
                    subtitle="Sem avaliações registadas"
                    icon={Activity}
                    color="purple"
                    trend={{
                        value: 0,
                        isPositive: false
                    }}
                />
            </div>

            {/* Próximas Consultas REAIS */}
            <div className="grid grid-cols-1 lg:grid-cols-3 gap-6">
                <div className="lg:col-span-2 bg-white rounded-xl shadow-md p-4 sm:p-6 border border-gray-100">
                    <div className="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3 mb-6">
                        <div>
                            <h2 className="text-lg sm:text-xl font-bold text-gray-900 flex items-center gap-2">
                                <Calendar className="w-5 h-5 text-[#b8860b]" />
                                Próximas Consultas
                            </h2>
                            <p className="text-xs text-gray-500 mt-1">
                                {upcomingAppointments.length} consultas agendadas
                            </p>
                        </div>
                        <button
                            onClick={() => window.location.href = '/appointments'}
                            className="text-sm font-medium text-[#b8860b] hover:text-[#9c7309] self-start"
                        >
                            Ver agenda completa →
                        </button>
                    </div>

                    {upcomingAppointments.length > 0 ? (
                        <div className="space-y-3">
                            {upcomingAppointments.map((appointment) => (
                                <ConsultaCard
                                    key={appointment.id}
                                    cliente={`${appointment.patient?.name || 'Paciente'} ${appointment.patient?.surname || ''}`}
                                    data={appointment.date ? new Date(appointment.date).toLocaleDateString('pt-PT', {
                                        day: 'numeric',
                                        month: 'short',
                                        year: 'numeric'
                                    }) : '--/--/----'}
                                    hora={appointment.time || '--:--'}
                                    tipo={appointment.type || appointment.service_type || 'Consulta'}
                                    status={appointment.status || 'agendada'}
                                />
                            ))}
                        </div>
                    ) : (
                        <div className="text-center py-8">
                            <Calendar className="w-12 h-12 text-gray-300 mx-auto mb-3" />
                            <p className="text-gray-500">Nenhuma consulta agendada</p>
                        </div>
                    )}
                </div>

                {/* Alertas REAIS */}
                <div className="bg-white rounded-xl shadow-md p-4 sm:p-6 border border-gray-100">
                    <h2 className="text-lg sm:text-xl font-bold text-gray-900 mb-6 flex items-center gap-2">
                        <AlertCircle className="w-5 h-5 text-[#b8860b]" />
                        Alertas ({alerts.length})
                    </h2>

                    {alerts.length > 0 ? (
                        <div className="space-y-3">
                            {alerts.map((alert, index) => (
                                <div
                                    key={index}
                                    className={`p-3 ${
                                        alert.type === 'urgent'
                                            ? 'bg-red-50 border border-red-200 rounded-lg'
                                            : alert.type === 'warning'
                                                ? 'bg-[#fff9e8] border border-[#f1c04b] rounded-lg'
                                                : 'bg-emerald-50 border border-emerald-200 rounded-lg'
                                    }`}
                                >
                                    <div className="flex items-start gap-2">
                                        {alert.type === 'urgent' ? (
                                            <AlertCircle className="w-4 h-4 text-red-600 mt-0.5" />
                                        ) : alert.type === 'warning' ? (
                                            <Clock className="w-4 h-4 text-[#b8860b] mt-0.5" />
                                        ) : (
                                            <CheckCircle2 className="w-4 h-4 text-emerald-600 mt-0.5" />
                                        )}
                                        <div>
                                            <p className={`text-sm font-medium ${
                                                alert.type === 'urgent' ? 'text-red-900' :
                                                    alert.type === 'warning' ? 'text-[#7a5c06]' :
                                                        'text-emerald-900'
                                            }`}>
                                                {alert.title}
                                            </p>
                                            <p className={`text-xs mt-1 ${
                                                alert.type === 'urgent' ? 'text-red-700' :
                                                    alert.type === 'warning' ? 'text-[#9c7309]' :
                                                        'text-emerald-700'
                                            }`}>
                                                {alert.message}
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            ))}
                        </div>
                    ) : (
                        <div className="text-center py-8">
                            <CheckCircle2 className="w-12 h-12 text-green-300 mx-auto mb-3" />
                            <p className="text-gray-500">Nenhum alerta pendente</p>
                        </div>
                    )}
                </div>
            </div>

            {/* Objetivos REAIS e Atividades REAIS */}
            <div className="grid grid-cols-1 lg:grid-cols-2 gap-6">
                {/* Objetivos de Tratamento REAIS */}
                <div className="bg-white rounded-xl shadow-md p-4 sm:p-6 border border-gray-100">
                    <h2 className="text-lg sm:text-xl font-bold text-gray-900 mb-6 flex items-center gap-2">
                        <Target className="w-5 h-5 text-[#b8860b]" />
                        Progresso dos Tratamentos ({treatmentGoals.length})
                    </h2>

                    {treatmentGoals.length > 0 ? (
                        <div className="space-y-4">
                            {treatmentGoals.slice(0, 4).map((goal) => (
                                <ObjectiveProgress
                                    key={goal.id}
                                    titulo={goal.title || goal.description || `Objetivo ${goal.id}`}
                                    progresso={goal.progress || goal.completion_percentage || 0}
                                    meta={goal.target_date ?
                                        `Até ${new Date(goal.target_date).toLocaleDateString('pt-PT')}` :
                                        (goal.target_value || "Meta em andamento")}
                                />
                            ))}
                        </div>
                    ) : (
                        <div className="text-center py-8">
                            <Target className="w-12 h-12 text-gray-300 mx-auto mb-3" />
                            <p className="text-gray-500">Nenhum objetivo de tratamento definido</p>
                        </div>
                    )}
                </div>

                {/* Atividades Recentes REAIS */}
                <div className="bg-white rounded-xl shadow-md p-4 sm:p-6 border border-gray-100">
                    <h2 className="text-lg sm:text-xl font-bold text-gray-900 mb-6 flex items-center gap-2">
                        <Activity className="w-5 h-5 text-[#b8860b]" />
                        Atividades Recentes
                    </h2>

                    <div className="space-y-4">
                        {recentActivities.map((atividade, i) => {
                            const Icon = atividade.icon;
                            return (
                                <div
                                    key={atividade.id || i}
                                    className="flex items-start gap-3 pb-3 border-b border-gray-100 last:border-0"
                                >
                                    <div
                                        className={`p-2 rounded-lg ${atividade.colorBg} ${atividade.colorIcon}`}
                                    >
                                        <Icon className="w-4 h-4" />
                                    </div>
                                    <div className="flex-1 min-w-0">
                                        <p className={`text-sm font-medium truncate ${
                                            atividade.action === "Sem atividade registada"
                                                ? "text-gray-400"
                                                : "text-gray-900"
                                        }`}>
                                            {atividade.action}
                                        </p>
                                        <p className={`text-xs truncate ${
                                            atividade.paciente === "---"
                                                ? "text-gray-400"
                                                : "text-gray-600"
                                        }`}>
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