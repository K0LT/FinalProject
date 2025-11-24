'use client';
import React, { useEffect, useState } from 'react';
import Card from '@/components/treatmentGoal/Card';


export default function Page({ params }) {
    console.log("Aqui:" + params);
    //Dá erro mas nao está a estragar nada.
    const { id } = params;

    const [cardsData, setCardsData] = useState([]);
    const [loading, setLoading] = useState(true);

    useEffect(() => {
        async function fetchGoals() {
            try {
                const res = await fetch(`http://127.0.0.1:8000/api/patients/${id}/treatmentGoals`);
                const data = await res.json();

                const transformed = data.map(goal => ({
                    title: goal.title,
                    description: goal.description,
                    badges: [
                        { label: goal.priority, variant: 'primary' },
                        { label: goal.status, variant: 'secondary' }
                    ],
                    targetDate: goal.target_date,
                    progress: parseFloat(goal.progress_percentage),
                    treatmentMethods: goal.treatment_methods.split(','),
                    milestones: goal.goal_milestones.map(m => ({
                        title: m.description || 'Sem descrição',
                        date: m.target_date,
                        completed: !!m.completed
                    }))
                }));

                setCardsData(transformed);
            } catch (err) {
                console.error('error', err);
            } finally {
                setLoading(false);
            }
        }

        fetchGoals();
    }, [id]);

    if (loading) return <p>Loading...</p>;
    if (!cardsData.length) return <p>Meter aqui algo default</p>;


    //Fazer aqui os calculos ou no backend
    const activeObjectives = cardsData.length;
    const averageProgress = Math.round(
        cardsData.reduce((sum, c) => sum + c.progress, 0) / cardsData.length
    );
    const nearlyComplete = cardsData.filter(c => c.progress >= 90).length;

    return (
        <div className="flex flex-col gap-8 p-12">


            <div className="grid grid-cols-3 gap-6">
                <div className="bg-card text-card-foreground flex flex-col gap-6 rounded-xl border p-6">
                    <div className="flex items-center justify-between">
                        <div>
                            <p className="text-2xl">{activeObjectives}</p>
                            <p className="text-sm text-muted-foreground">Active Objectives</p>
                        </div>
                        <svg
                            xmlns="http://www.w3.org/2000/svg"
                            width="24"
                            height="24"
                            viewBox="0 0 24 24"
                            fill="none"
                            stroke="currentColor"
                            strokeWidth="2"
                            strokeLinecap="round"
                            strokeLinejoin="round"
                            className="lucide lucide-target w-8 h-8 text-muted-foreground"
                            aria-hidden="true"
                        >
                            <circle cx="12" cy="12" r="10"></circle>
                            <circle cx="12" cy="12" r="6"></circle>
                            <circle cx="12" cy="12" r="2"></circle>
                        </svg>
                    </div>
                </div>

                <div className="bg-card text-card-foreground flex flex-col gap-6 rounded-xl border p-6">
                    <div className="flex items-center justify-between">
                        <div>
                            <p className="text-2xl">{averageProgress}%</p>
                            <p className="text-sm text-muted-foreground">Average Progress</p>
                        </div>
                        <div className="w-8 h-8 bg-primary/10 rounded-full flex items-center justify-center">
                            <span className="text-sm">📊</span>
                        </div>
                    </div>
                </div>

                <div className="bg-card text-card-foreground flex flex-col gap-6 rounded-xl border p-6">
                    <div className="flex items-center justify-between">
                        <div>
                            <p className="text-2xl">{nearlyComplete}</p>
                            <p className="text-sm text-muted-foreground">Nearly Complete</p>
                        </div>
                        <svg
                            xmlns="http://www.w3.org/2000/svg"
                            width="24"
                            height="24"
                            viewBox="0 0 24 24"
                            fill="none"
                            stroke="currentColor"
                            strokeWidth="2"
                            strokeLinecap="round"
                            strokeLinejoin="round"
                            className="lucide lucide-circle-check-big w-8 h-8 text-green-500"
                            aria-hidden="true"
                        >
                            <path d="M21.801 10A10 10 0 1 1 17 3.335"></path>
                            <path d="m9 11 3 3L22 4"></path>
                        </svg>
                    </div>
                </div>
            </div>

            {cardsData.map((card, idx) => (
                <Card key={idx} {...card} />
            ))}
        </div>
    );
}
