"use client";

import React from "react";
import { useEffect } from "react";
import { useRouter, usePathname } from "next/navigation";
import {
    Calendar,
    Users,
    Activity,
    BarChart3,
    User,
    Dumbbell,
    Scale,
} from "lucide-react";
import { useAuth } from "@/context/AuthContext";
import { AuthGuard } from "@/components/Auth/AuthGuard";

export default function DashboardSidebarLayout({ children }) {
    const { userAuth, isAuthenticated, isLoading, logout } = useAuth();
    const user = localStorage.getItem('user_data');
    debugger;
    const router = useRouter();
    const pathname = usePathname();

    const quickActions = [
        { label: "Nova Consulta", icon: Calendar, href: `/appointments/${user.id}` },
        { label: "Adicionar Paciente", icon: Users, href: `/patients/new` },
        { label: "Diagnóstico", icon: Activity, href: `/diagnoses/${user.id}` },
        { label: "Relatórios", icon: BarChart3, href: `/reports/${user.id}` },
        { label: "Perfil do Cliente", icon: User, href: `/patient/${user.id}` },
        { label: "Prescrição de Exercícios", icon: Dumbbell, href: `/exercises/${user.id}` },
        { label: "Controlo de Peso", icon: Scale, href: `/weight/${user.id}` },
    ];

    return (
        <AuthGuard requireAuth={true}>
            <div className="min-h-screen bg-white flex flex-col lg:flex-row">
                <aside className="w-full lg:w-72 border-b lg:border-b-0 lg:border-r border-gray-200 bg-[#fffcf5]">
                    <div className="px-4 py-4 sm:px-5 sm:py-6">
                        <h2 className="text-sm font-semibold text-gray-900 mb-3">
                            Ações Rápidas
                        </h2>
                        <p className="text-xs text-gray-600 mb-4">
                            Aceda rapidamente às principais tarefas do dia a dia.
                        </p>

                        <div className="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-1 gap-3">
                            {quickActions.map(({ label, icon: Icon, href }) => {
                                const isActive = pathname === href;

                                return (
                                    <button
                                        key={label}
                                        type="button"
                                        onClick={() => router.push(href)}
                                        className={
                                            "group flex items-center gap-2 p-3 rounded-lg border transition-all text-left " +
                                            "bg-[#fff9e8] hover:bg-[#fdf4d7] border-[#f1dca3] hover:shadow-md " +
                                            (isActive ? "ring-1 ring-[#b8860b]/50" : "")
                                        }
                                    >
                                        <span className="inline-flex items-center justify-center w-8 h-8 rounded-md bg-white/70 text-[#b8860b]">
                                            <Icon className="w-4 h-4" />
                                        </span>
                                        <span className="text-xs sm:text-sm font-medium text-gray-900">
                                            {label}
                                        </span>
                                    </button>
                                );
                            })}
                        </div>
                    </div>
                </aside>

                <main className="flex-1 p-6">
                    {children}
                </main>
            </div>
        </AuthGuard>
    );
}