import React from 'react';
import Card from '@/components/treatmentGoal/Card';

export default function Page() {
    return (
        <div className="flex flex-col gap-8 p-12">

            <Card
                title="Reduzir Dor Lombar"
                description="Diminuir dor lombar crónica de 8/10 para 3/10 ou menos"
                badges={[
                    { label: 'Alta Priority', variant: 'destructive' },
                    { label: 'Em Progresso', variant: 'primary' }
                ]}
                targetDate="2024-12-01"
                progress={65}
                treatmentMethods={['Acupunctura', 'Moxibustão', 'Ventosas']}
                milestones={[
                    { title: 'Avaliação inicial: Nível de dor 8/10', date: '2024-09-01', completed: true },
                    { title: 'Após 4 sessões: Dor reduzida para 5/10', date: '2024-09-15', completed: true },
                    { title: 'Meta: Nível de dor 4/10', date: '2024-10-15', completed: false },
                    { title: 'Objetivo final: Nível de dor 3/10 ou menos', date: '2024-12-01', completed: false }
                ]}
            />

            <Card
                title="Melhorar Postura"
                description="Reduzir dor cervical e melhorar postura em 3 meses"
                badges={[
                    { label: 'Média Priority', variant: 'warning' },
                    { label: 'Em Progresso', variant: 'primary' }
                ]}
                targetDate="2025-01-15"
                progress={40}
                treatmentMethods={['Fisioterapia', 'Exercícios de Core']}
                milestones={[
                    { title: 'Avaliação inicial', date: '2024-11-01', completed: true },
                    { title: 'Primeiro ajuste postural', date: '2024-11-15', completed: true },
                    { title: 'Meta intermédia', date: '2024-12-15', completed: false },
                    { title: 'Objetivo final', date: '2025-01-15', completed: false }
                ]}
            />

            <Card
                title="Aumentar Flexibilidade"
                description="Atingir amplitude de movimento completa nas articulações"
                badges={[
                    { label: 'Baixa Priority', variant: 'secondary' },
                    { label: 'Planejado', variant: 'primary' }
                ]}
                targetDate="2025-03-01"
                progress={10}
                treatmentMethods={['Yoga', 'Alongamentos']}
                milestones={[
                    { title: 'Avaliação inicial', date: '2025-01-10', completed: true },
                    { title: 'Sessão de Yoga 4x', date: '2025-01-20', completed: false },
                    { title: 'Meta intermédia', date: '2025-02-15', completed: false },
                    { title: 'Objetivo final', date: '2025-03-01', completed: false }
                ]}
            />

        </div>
    );
}
