export default function Sidebar() {
    return (
        <div className="h-full flex flex-col">
            <div className="h-16 px-4 border-b flex items-center gap-2">
                <div className="size-8 rounded-full bg-yellow-500" />
                <span className="font-semibold">QiFlow</span>
            </div>
            <nav className="flex-1 min-h-0 overflow-y-auto p-3 space-y-1 text-sm">
                {[
                    "Perfil do Cliente",
                    "Consultas",
                    "Diagnóstico Energético",
                    "Objectivos do Tratamento",
                    "Prescrição de Exercícios",
                    "Controlo de Peso",
                    "Assistente IA",
                ].map((label) => (
                    <a key={label} className="block rounded-md px-3 py-2 hover:bg-gray-100">
                        {label}
                    </a>
                ))}
            </nav>
            <div className="p-3 border-t">
                <button className="w-full rounded-md border px-3 py-2 text-left text-sm">
                    Terminar Sessão
                </button>
            </div>
        </div>
    );
}