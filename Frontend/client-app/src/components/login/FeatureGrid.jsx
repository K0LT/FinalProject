import { Target, Users, ChartColumn, Calendar } from "lucide-react";

export default function FeatureGrid() {
    const features = [
        {
            Icon: Target,
            color: "text-blue-600",
            title: "Gestão de Objetivos",
            desc: "Acompanhe metas de perda de peso e bem-estar com precisão",
        },
        {
            Icon: Users,
            color: "text-green-600",
            title: "Perfis de Pacientes",
            desc: "Gerencie informações completas de cada paciente",
        },
        {
            Icon: ChartColumn,
            color: "text-purple-600",
            title: "Analytics Avançados",
            desc: "Relatórios detalhados de progresso e resultados",
        },
        {
            Icon: Calendar,
            color: "text-orange-600",
            title: "Agendamento Inteligente",
            desc: "Sistema automatizado de marcação de consultas",
        },
    ];

    return (
        <div className="grid grid-cols-2 gap-4">
            {features.map(({ Icon, color, title, desc }) => (
                <div key={title} className="p-4 bg-white/50 rounded-lg border">
                    <Icon className={`w-6 h-6 mb-2 ${color}`} aria-hidden="true" />
                    <h4 className="text-sm mb-1">{title}</h4>
                    <p className="text-xs text-muted-foreground">{desc}</p>
                </div>
            ))}
        </div>
    );
}
