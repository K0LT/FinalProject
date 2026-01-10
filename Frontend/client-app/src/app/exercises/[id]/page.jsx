'use client';

import { useEffect, useState } from "react";
import { useParams } from "next/navigation";
import ClientDashLayout from "@/components/clientDashboard/ClientDashLayout";
import { AuthGuard } from "@/components/Auth/AuthGuard";
import { useAuth } from "@/context/AuthContext";
import { getUserExercises } from "@/services/userServices";
import { Dumbbell, Calendar, CheckCircle, Clock } from "lucide-react";

function ExercisesPage() {
    const params = useParams();
    const { user } = useAuth();

    const [exercises, setExercises] = useState([]);
    const [loading, setLoading] = useState(true);
    const [error, setError] = useState(null);

    useEffect(() => {
        const loadData = async () => {
            try {
                const exercisesData = await getUserExercises();
                setExercises(Array.isArray(exercisesData) ? exercisesData : []);
            } catch (e) {
                console.error('Error loading exercises:', e);
                setError(e);
            } finally {
                setLoading(false);
            }
        };

        loadData();
    }, []);

    if (loading) return <div className="p-6">A carregar...</div>;
    if (error) return <div className="p-6 text-red-600">Falha ao carregar: {error.message}</div>;

    return (
        <div className="space-y-6">
            <div className="flex justify-between items-center">
                <h1 className="text-2xl font-bold">Prescrição de Exercícios</h1>
            </div>

            {exercises.length > 0 ? (
                <div className="grid gap-4 md:grid-cols-2 lg:grid-cols-3">
                    {exercises.map((exercise, idx) => (
                        <div key={exercise.id || idx} className="rounded-2xl border border-amber-100 p-5 bg-white">
                            <div className="flex items-start gap-3">
                                <div className="p-2 rounded-lg bg-amber-50">
                                    <Dumbbell className="w-5 h-5 text-amber-600" />
                                </div>
                                <div className="flex-1">
                                    <h3 className="font-semibold">{exercise.name || 'Exercício'}</h3>
                                    {exercise.description && (
                                        <p className="text-sm text-gray-600 mt-1">{exercise.description}</p>
                                    )}
                                </div>
                            </div>

                            <div className="mt-4 space-y-2">
                                {exercise.pivot?.frequency && (
                                    <div className="flex items-center gap-2 text-sm text-gray-600">
                                        <Clock className="w-4 h-4" />
                                        <span>Frequência: {exercise.pivot.frequency}</span>
                                    </div>
                                )}
                                {exercise.pivot?.prescribed_date && (
                                    <div className="flex items-center gap-2 text-sm text-gray-600">
                                        <Calendar className="w-4 h-4" />
                                        <span>Prescrito: {new Date(exercise.pivot.prescribed_date).toLocaleDateString('pt-PT')}</span>
                                    </div>
                                )}
                                {exercise.pivot?.status && (
                                    <div className="flex items-center gap-2 text-sm">
                                        <CheckCircle className="w-4 h-4 text-green-500" />
                                        <span className="text-green-600">{exercise.pivot.status}</span>
                                    </div>
                                )}
                            </div>

                            {exercise.pivot?.notes && (
                                <div className="mt-3 pt-3 border-t border-amber-100">
                                    <p className="text-sm text-gray-500">{exercise.pivot.notes}</p>
                                </div>
                            )}
                        </div>
                    ))}
                </div>
            ) : (
                <div className="text-center py-12">
                    <Dumbbell className="w-12 h-12 text-gray-300 mx-auto mb-4" />
                    <p className="text-gray-500">Nenhum exercício prescrito.</p>
                    <p className="text-sm text-gray-400 mt-1">Os exercícios prescritos pelo seu terapeuta aparecerão aqui.</p>
                </div>
            )}
        </div>
    );
}

export default function Page() {
    return (
        <AuthGuard requireAuth={true}>
            <ClientDashLayout>
                <ExercisesPage />
            </ClientDashLayout>
        </AuthGuard>
    );
}
