'use client'

import Link from "next/link";
import { usePathname } from "next/navigation";

export default function Sidebar() {
    const pathname = usePathname();

    const menuItems = [
        { label: "Dashboard", href: "/dashboard"},
        { label: "Perfil do Cliente", href: "/clientProfile"},
        { label: "Consultas", href: "/appointments"},
        { label: "Tratamentos", href: "/treatments"},
        { label: "Diagnóstico Energético", href: "/diagnoses"},
        { label: "Prescrição de Exercícios", href: "/exercises"},
        { label: "Controlo de Peso", href: "/weight"},
        { label: "Nutrição", href: "/nutrition"},
        { label: "Assistente IA", href: "/ai-assistant"},
    ];

    return (
        <div className="h-full flex flex-col">
            <div className="h-16 px-4 border-b flex items-center gap-2">
                <div className="size-8 rounded-full bg-yellow-500" />
                <span className="font-semibold">QiFlow</span>
            </div>

            <nav className="flex-1 min-h-0 overflow-y-auto p-3 space-y-1 text-sm">
                {menuItems.map((item) => {
                    const isActive = pathname === item.href;
                    return (
                        <Link
                            key={item.href}
                            href={item.href}
                            className={`flex items-center gap-3 rounded-md px-3 py-2 transition-colors ${
                                isActive
                                    ? 'bg-yellow-100 text-yellow-900 font-medium'
                                    : 'hover:bg-gray-100'
                            }`}
                        >
                            <span>{item.icon}</span>
                            <span>{item.label}</span>
                        </Link>
                    );
                })}
            </nav>

            <div className="p-3 border-t">
                <button className="w-full rounded-md border px-3 py-2 text-left text-sm hover:bg-gray-50">
                    Terminar Sessão
                </button>
            </div>
        </div>
    );
}