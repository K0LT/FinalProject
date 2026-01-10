"use client";

import Link from "next/link";
import { usePathname } from "next/navigation";
import {
    User,
    Calendar,
    Activity,
    ClipboardList,
    Dumbbell,
    Scale,
    Bot,
    X,
} from "lucide-react";
import QiFlowBrand from "@/components/ui/QiFlowBrand";
import {useAuth} from "@/context/AuthContext";
import {useRouter} from "next/navigation";

export default function Sidebar({
                                    isOpen,
                                    onClose,
                                    currentPath,
                                    onNavigate,
                                    userId = "default-user",
                                    brandTitle = "QiFlow",
                                    brandSubtitle = "Portal do Paciente",
                                }) {
    const pathname = usePathname() || currentPath;
    const router = useRouter();

    const {logout} = useAuth();

    const handleLogout = async () => {
        await logout();
        router.push('/login');
    }
    const menuItems = [
        {
            label: "Perfil do Cliente",
            href: "/patient/" + userId,
            icon: User,
            group: "Geral",
        },
        {
            label: "Consultas",
            href: "/appointments/" + userId,
            icon: Calendar,
            group: "Geral",
        },
        {
            label: "Diagnóstico",
            href: "/diagnoses/" + userId,
            icon: Activity,
            group: "Plano de Tratamento",
        },
        {
            label: "Objectivos do Tratamento",
            href: "/treatments/" + userId,
            icon: ClipboardList,
            group: "Plano de Tratamento",
        },
        {
            label: "Prescrição de Exercícios",
            href: "/exercises/" + userId,
            icon: Dumbbell,
            group: "Plano de Tratamento",
        },
        {
            label: "Controlo de Peso",
            href: "/weight/" + userId,
            icon: Scale,
            group: "Monitorização",
        },
        {
            label: "Assistente IA",
            href: "/ai-assistant",
            icon: Bot,
            group: "Ferramentas",
        },
    ];

    const groups = Array.from(new Set(menuItems.map((i) => i.group)));

    const content = (
        <aside className="h-screen w-72 bg-sidebar text-sidebar-foreground border-r border-sidebar-border shadow-xs flex flex-col">
            <div className="h-16 px-4 flex items-center justify-between border-b border-sidebar-border">
                <QiFlowBrand
                    title="QiFlow"
                    subtitle={brandSubtitle}
                    size="md"
                />

                <button
                    type="button"
                    onClick={onClose}
                    className="lg:hidden inline-flex items-center justify-center rounded-full p-1.5 hover:bg-sidebar-accent hover:text-sidebar-accent-foreground transition-colors"
                >
                    <X className="w-4 h-4" />
                </button>
            </div>

            <nav className="flex-1 overflow-y-auto px-3 py-4 space-y-4">
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
                                    const isActive =
                                        pathname === item.href || currentPath === item.href;

                                    return (
                                        <Link
                                            key={item.href}
                                            href={item.href}
                                            onClick={() => {
                                                onNavigate?.(item.href);
                                                onClose?.();
                                            }}
                                            className={`group flex items-center gap-3 px-3 py-2 rounded-xl text-sm transition-all
                        ${
                                                isActive
                                                    ? "bg-primary/10 text-primary font-medium shadow-sm"
                                                    : "hover:bg-sidebar-accent hover:text-sidebar-accent-foreground"
                                            }`}
                                        >
                      <span
                          className={`flex items-center justify-center w-8 h-8 rounded-lg border border-sidebar-border bg-white/70 shadow-xs
                          ${
                              isActive
                                  ? "text-primary"
                                  : "text-muted-foreground group-hover:text-primary"
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

            <div className="border-t border-sidebar-border px-3 py-3">
                <button
                    type="button"
                    onClick={handleLogout}
                    className="w-full flex items-center px-3 py-2.5 rounded-xl text-sm text-muted-foreground hover:bg-sidebar-accent hover:text-sidebar-accent-foreground transition-all sticky bottom-0"
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
        <>
            {isOpen && (
                <div
                    className="fixed inset-0 z-40 bg-black/40 backdrop-blur-sm lg:hidden"
                    onClick={onClose}
                />
            )}

            <div
                className={`fixed z-50 inset-y-0 left-0 transform transition-transform duration-300 lg:static lg:translate-x-0 ${
                    isOpen ? "translate-x-0" : "-translate-x-full lg:translate-x-0"
                }`}
            >
                {content}
            </div>
        </>
    );
}
