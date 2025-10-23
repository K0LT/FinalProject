'use client'

import Link from "next/link";
import { usePathname } from "next/navigation";

export default function Sidebar() {
    const pathname = usePathname();

    const menuItems = [
        { label: "Perfil do Cliente", href: "/clientProfile"},
        { label: "Consultas", href: "/appointments"},
        { label: "Diagnóstico Energético", href: "/diagnoses"},
        { label: "Objectivos do Tratamento", href: "/treatments"},
        { label: "Prescrição de Exercícios", href: "/exercises"},
        { label: "Controlo de Peso", href: "/weight"},
        { label: "Assistente IA", href: "/ai-assistant"},
    ];

    return (
        <div className="h-full flex flex-col bg-white">
            {/* Logo/Header */}
            <div className="h-16 px-4 border-b flex items-center gap-3">
                <div className="w-10 h-10 rounded-full bg-yellow-500 flex items-center justify-center text-white font-bold text-lg">
                    Q
                </div>
                <div>
                    <div className="font-semibold text-gray-900">QiFlow</div>
                    <div className="text-xs text-gray-500">MESTRE JOSÉ MACHADO</div>
                </div>
            </div>

            {/* Menu Items */}
            <nav className="flex-1 overflow-y-auto space-y-1">
                {menuItems.map((item) => {
                    const isActive = pathname === item.href;
                    return (
                        <Link
                            key={item.href}
                            href={item.href}
                            className={`
                                flex gap-3 py-1 rounded-lg text-sm
                                transition-colors text-gray-800
                                ${isActive
                                ? 'bg-gray-50 font-medium'
                                : 'hover:bg-gray-50'
                            }
                            `}
                        >
                            <span className="text-lg">{item.icon}</span>
                            <span>{item.label}</span>
                        </Link>
                    );
                })}
            </nav>

            {/* Footer - Logout */}
            <div className="p-3 border-t">
                <button className="w-full flex items-center gap-3 px-3 py-2.5 rounded-lg text-sm text-gray-700 hover:bg-gray-50 transition-colors">
                    <span className="text-lg">🚪</span>
                    <span>Terminar Sessão</span>
                </button>
            </div>
        </div>
    );
}