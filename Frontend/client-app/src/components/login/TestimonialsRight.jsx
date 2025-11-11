export default function TestimonialsRight() {
    const cards = [
        {
            quote:
                "O QiFlow revolucionou a minha prática. Consigo acompanhar o progresso dos meus pacientes de forma muito mais eficiente.",
            name: "José Machado",
            role: "Acupunturista",
        },
        {
            quote:
                "Excelente ferramenta para gestão de clínica. A integração de controlo de peso é fantástica.",
            name: "Dr. João Santos",
            role: "Medicina Tradicional Chinesa",
        },
    ];

    return (
        <div className="space-y-4">
            <h3 className="text-xl text-center">O que dizem os nossos utilizadores</h3>
            {cards.map((c) => (
                <div key={c.name} className="text-card-foreground flex flex-col gap-4 rounded-xl border-0 bg-white/70 backdrop-blur-sm p-6">
                    <div className="flex items-center gap-1 mb-1">
                        {Array.from({ length: 5 }).map((_, i) => (
                            <svg key={i} className="w-4 h-4 fill-yellow-400 text-yellow-400" viewBox="0 0 24 24">
                                <path d="M11.525 2.295a.53.53 0 0 1 .95 0l2.31 4.679a2.123 2.123 0 0 0 1.595 1.16l5.166.756a.53.53 0 0 1 .294.904l-3.736 3.638a2.123 2.123 0 0 0-.611 1.878l.882 5.14a.53.53 0 0 1-.771.56l-4.618-2.428a2.122 2.122 0 0 0-1.973 0L6.396 21.01a.53.53 0 0 1-.77-.56l.881-5.139a2.122 2.122 0 0 0-.611-1.879L2.16 9.795a.53.53 0 0 1 .294-.906l5.165-.755a2.122 2.122 0 0 0 1.597-1.16z" />
                            </svg>
                        ))}
                    </div>
                    <p className="text-sm italic mb-3">"{c.quote}"</p>
                    <div>
                        <p className="text-sm">{c.name}</p>
                        <p className="text-xs text-muted-foreground">{c.role}</p>
                    </div>
                </div>
            ))}
        </div>
    );
}
