"use client";

import React, { useMemo, useState } from "react";
import Link from "next/link";
import { useRouter, usePathname } from "next/navigation";
import {
    User as UserIcon,
    Calendar,
    Activity,
    ClipboardList,
    Dumbbell,
    Scale,
    Bot,
    X,
    Users,
    BarChart3,
    Menu,
} from "lucide-react";

import { useAuth } from "@/context/AuthContext";
import { AuthGuard } from "@/components/Auth/AuthGuard";
import QiFlowBrand from "@/components/ui/QiFlowBrand";

export default function DashboardSidebarLayout({ children }) {
    const { logout } = useAuth();

    const router = useRouter();
    const pathname = usePathname() || "/";

    const [sidebarOpen, setSidebarOpen] = useState(false);
    const [currentPath, setCurrentPath] = useState(pathname);

    const brandSubtitle = "Portal do Paciente";

    const today = useMemo(() => {
        try {
            return new Date().toLocaleDateString("pt-PT", {
                weekday: "long",
                day: "numeric",
                month: "long",
                year: "numeric",
            });
        } catch {
            return "";
        }
    }, []);

    const menuItems = useMemo(
        () => [
            { label: "Perfil", href: "/profile", icon: UserIcon, group: "Geral" },
            { label: "Consultas", href: "/appointments", icon: Calendar, group: "Geral" },
            { label: "Adicionar Paciente", href: "/patients", icon: Users, group: "Geral" },

            { label: "Diagnóstico", href: "/diagnoses", icon: Activity, group: "Plano de Tratamento" },
            { label: "Relatórios", href: "/reports", icon: BarChart3, group: "Plano de Tratamento" },
            { label: "Objectivos do Tratamento", href: "/treatments", icon: ClipboardList, group: "Plano de Tratamento" },
            { label: "Prescrição de Exercícios", href: "/exercises", icon: Dumbbell, group: "Plano de Tratamento" },

            { label: "Controlo de Peso", href: "/weight", icon: Scale, group: "Monitorização" },

            { label: "Assistente", href: "/assistant", icon: Bot, group: "Ferramentas" },
        ],
        []
    );

    const groups = useMemo(
        () => Array.from(new Set(menuItems.map((i) => i.group))),
        [menuItems]
    );

    const sidebarContent = (
        <aside className="h-auto w-72 bg-sidebar text-sidebar-foreground border-r border-sidebar-border shadow-xs flex flex-col overflow-hidden">
            <div className="h-16 px-4 flex items-center justify-between border-b border-sidebar-border shrink-0">
                <QiFlowBrand title="QiFlow" subtitle={brandSubtitle} size="md" />

                <button
                    type="button"
                    onClick={() => setSidebarOpen(false)}
                    className="lg:hidden inline-flex items-center justify-center rounded-full p-1.5 hover:bg-sidebar-accent hover:text-sidebar-accent-foreground transition-colors"
                    aria-label="Fechar menu"
                >
                    <X className="w-4 h-4" />
                </button>
            </div>

            <nav className="px-3 py-4 space-y-4 overflow-hidden">
                {groups.map((group) => (
                    <div key={group} className="space-y-2">
                        <p className="px-2 text-[0.7rem] font-semibold text-muted-foreground uppercase tracking-widest">
                            {group}
                        </p>

                        <div className="space-y-1">
                            {menuItems
                                .filter((item) => item.group === group)
                                .map((item) => {
                                    const Icon = item.icon;
                                    const isActive = pathname === item.href || currentPath === item.href;

                                    return (
                                        <Link
                                            key={item.href}
                                            href={item.href}
                                            onClick={() => {
                                                setCurrentPath(item.href);
                                                setSidebarOpen(false);
                                            }}
                                            className={`group flex items-center gap-3 px-3 py-2 rounded-xl text-sm transition-all ${
                                                isActive
                                                    ? "bg-primary/10 text-primary font-medium shadow-sm"
                                                    : "hover:bg-sidebar-accent hover:text-sidebar-accent-foreground"
                                            }`}
                                        >
                      <span
                          className={`flex items-center justify-center w-8 h-8 rounded-lg border border-sidebar-border bg-white/70 shadow-xs ${
                              isActive ? "text-primary" : "text-muted-foreground group-hover:text-primary"
                          }`}
                      >
                        <Icon className="w-4 h-4" />
                      </span>

                                            <span className="truncate">{item.label}</span>
                                        </Link>
                                    );
                                })}
                        </div>
                    </div>
                ))}
            </nav>

            <div className="border-t border-sidebar-border px-3 py-3 shrink-0">
                <button
                    type="button"
                    onClick={() => {
                        logout?.();
                        router.push("/login");
                    }}
                    className="w-full flex items-center justify-between px-3 py-2.5 rounded-xl text-sm text-muted-foreground hover:bg-sidebar-accent hover:text-sidebar-accent-foreground transition-all"
                >
          <span className="flex items-center gap-2">
            <span className="inline-flex items-center justify-center w-7 h-7 rounded-lg bg-destructive/10 text-destructive">
              🚪
            </span>
            <span>Terminar Sessão</span>
          </span>
                </button>
            </div>
        </aside>
    );

    return (
        <AuthGuard requireAuth={true}>
            <div className="min-h-screen bg-secondary text-foreground flex">
                {sidebarOpen && (
                    <div
                        className="fixed inset-0 z-40 bg-black/40 backdrop-blur-sm lg:hidden"
                        onClick={() => setSidebarOpen(false)}
                    />
                )}

                <div
                    className={`fixed z-50 inset-y-0 left-0 transform transition-transform duration-300 lg:static lg:translate-x-0 ${
                        sidebarOpen ? "translate-x-0" : "-translate-x-full lg:translate-x-0"
                    }`}
                >
                    {sidebarContent}
                </div>

                <div className="flex-1 min-w-0 flex flex-col">
                    <header className="h-16 bg-white border-b border-gray-200 flex items-center justify-between px-4 sm:px-6 shrink-0">
                        <div className="flex items-center gap-3">
                            <button
                                type="button"
                                onClick={() => setSidebarOpen(true)}
                                className="lg:hidden p-2 rounded-lg hover:bg-gray-100"
                                aria-label="Abrir menu"
                            >
                                <Menu className="w-5 h-5" />
                            </button>

                            <div className="hidden sm:flex items-center gap-2 text-sm text-gray-600">
                                <Calendar className="w-4 h-4" />
                                <span className="capitalize">{today}</span>
                            </div>
                        </div>

                        <div className="flex items-center gap-3" />
                    </header>

                    <main className="flex-1 p-4 sm:p-6 lg:p-8 overflow-visible">{children}</main>
                </div>
            </div>
        </AuthGuard>
    );
}
