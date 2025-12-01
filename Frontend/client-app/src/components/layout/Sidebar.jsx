"use client";

import Link from "next/link";
import { usePathname } from "next/navigation";
import QiFlowBrand from "@/components/ui/QiFlowBrand";
export default function Sidebar({ userId, onClose }) {
    const pathname = usePathname();

    const menuItems = [
        { label: "Perfil do Cliente", href: "/patient/" + userId },
        { label: "Consultas", href: "/appointments/" + userId },
        { label: "Diagnóstico Energético", href: "/diagnoses/" + userId },
        { label: "Objectivos do Tratamento", href: "/treatments/" + userId },
        { label: "Prescrição de Exercícios", href: "/exercises/" + userId },
        { label: "Controlo de Peso", href: "/weight/" + userId },
        { label: "Assistente IA", href: "/ai-assistant" },
    ];

    return (
        <div className="h-full flex flex-col bg-white">
            <div className="h-16 px-4 border-b flex items-center">
                <QiFlowBrand
                    title="QiFlow"
                    subtitle="Portal Cliente"
                    size="md"
                    className="ml-0"
                />

            </div>

            <nav className="flex-1 overflow-y-auto space-y-1 p-3">
                {menuItems.map((item) => {
                    const isActive = pathname === item.href;
                    return (
                        <Link
                            key={item.href}
                            href={item.href}
                            onClick={onClose}
                            className={`flex gap-3 px-3 py-2 rounded-lg text-sm transition-colors text-gray-800 ${
                                isActive ? "bg-gray-50 font-medium" : "hover:bg-gray-50"
                            }`}
                        >
                            <span>{item.label}</span>
                        </Link>
                    );
                })}
            </nav>

            <div className="p-3 border-t">
                <button className="w-full flex items-center gap-3 px-3 py-2.5 rounded-lg text-sm text-gray-700 hover:bg-gray-50 transition-colors">
                    <span className="text-lg">🚪</span>
                    <span>Terminar Sessão</span>
                </button>
            </div>
        </div>
    );
}
