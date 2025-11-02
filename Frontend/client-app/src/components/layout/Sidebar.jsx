"use client";

import React from "react";
import Link from "next/link";
import { usePathname } from "next/navigation";
import {
    SidebarProvider,
    Sidebar,
    SidebarInset,
    SidebarItem,
    SidebarTrigger,
} from "@/components/ui/Sidebar";

const menu = [
    { label: "Perfil do Cliente", href: "/patient" },
    { label: "Consultas", href: "/appointments" },
    { label: "Diagnóstico Energético", href: "/diagnoses" },
    { label: "Objectivos do Tratamento", href: "/treatments" },
    { label: "Prescrição de Exercícios", href: "/exercises" },
    { label: "Controlo de Peso", href: "/weight" },
    { label: "Assistente IA", href: "/ai-assistant" },
];

export default function DashboardLayout({ children }) {
    const pathname = usePathname();

    return (
        <SidebarProvider>
            <Sidebar
                header={
                    <Link href="/" className="flex items-center gap-3">
                        <div className="flex h-10 w-10 items-center justify-center rounded-full bg-yellow-500 text-white font-bold">Q</div>
                        <div className="hidden md:block">
                            <div className="font-semibold text-gray-900">QiFlow</div>
                            <div className="text-xs text-gray-500">MESTRE JOSÉ MACHADO</div>
                        </div>
                    </Link>
                }
                footer={
                    <button className="w-full rounded-lg px-3 py-2.5 text-left text-sm text-gray-700 hover:bg-gray-50">
                        <span className="mr-2">🚪</span> Terminar Sessão
                    </button>
                }
            >
                <nav className="p-2 space-y-1">
                    {menu.map((item) => (
                        <SidebarItem key={item.href} href={item.href}>
                            {item.label}
                        </SidebarItem>
                    ))}
                </nav>
            </Sidebar>

            <SidebarInset>
                <header className="flex h-16 items-center gap-3 border-b px-3">
                    <SidebarTrigger />
                    <div className="text-sm text-gray-600">{pathname}</div>
                </header>
                <div className="p-4">{children}</div>
            </SidebarInset>
        </SidebarProvider>
    );
}
