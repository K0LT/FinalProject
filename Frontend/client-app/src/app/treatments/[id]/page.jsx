'use client';

import { useEffect, useState } from "react";
import { useParams } from "next/navigation";
import ClientDashLayout from "@/components/clientDashboard/ClientDashLayout";
import { AuthGuard } from "@/components/Auth/AuthGuard";
import { useAuth } from "@/context/AuthContext";
import { getUserTreatmentGoals } from "@/services/userServices";
import TreatmentsCard from "@/components/treatments/Treatments";
import { getTreatments } from "@/services/treatments";

function TreatmentsPage() {
    const params = useParams();
    const { user } = useAuth();

    const [treatments, setTreatments] = useState([]);
    const [treatmentGoals, setTreatmentGoals] = useState([]);
    const [loading, setLoading] = useState(true);
    const [error, setError] = useState(null);

    useEffect(() => {
        const loadData = async () => {
            try {
                const patientId = params?.id || user?.patient?.id;

                if (!patientId) {
                    setError(new Error('ID do paciente não encontrado'));
                    setLoading(false);
                    return;
                }

                const [treatmentsData, goalsData] = await Promise.all([
                    getTreatments(patientId),
                    getUserTreatmentGoals()
                ]);

                setTreatments(Array.isArray(treatmentsData) ? treatmentsData : []);
                setTreatmentGoals(Array.isArray(goalsData) ? goalsData : []);
            } catch (e) {
                console.error('Error loading treatments:', e);
                setError(e);
            } finally {
                setLoading(false);
            }
        };

        loadData();
    }, [params?.id, user?.patient?.id]);

    if (loading) return <div className="p-6">A carregar...</div>;
    if (error) return <div className="p-6 text-red-600">Falha ao carregar: {error.message}</div>;

    return (
        <div className="space-y-6">
            <div className="flex justify-between items-center">
                <h1 className="text-2xl font-bold">Objectivos do Tratamento</h1>
            </div>

            {/* Treatment Goals Section */}
            <section>
                <h2 className="text-lg font-semibold mb-4">Objectivos Actuais</h2>
                {treatmentGoals.length > 0 ? (
                    <div className="grid gap-4 md:grid-cols-2">
                        {treatmentGoals.map((goal) => (
                            <div key={goal.id} className="rounded-2xl border border-amber-100 p-4 bg-white">
                                <h3 className="font-medium">{goal.goal_description || goal.name}</h3>
                                <p className="text-sm text-gray-500 mt-1">
                                    Estado: {goal.status || 'Em progresso'}
                                </p>
                                {goal.target_date && (
                                    <p className="text-sm text-gray-500">
                                        Data alvo: {new Date(goal.target_date).toLocaleDateString('pt-PT')}
                                    </p>
                                )}
                            </div>
                        ))}
                    </div>
                ) : (
                    <p className="text-gray-500">Nenhum objectivo de tratamento definido.</p>
                )}
            </section>

            {/* Treatments Section */}
            <section>
                <h2 className="text-lg font-semibold mb-4">Tratamentos</h2>
                {treatments.length > 0 ? (
                    <div className="grid gap-4 md:grid-cols-2">
                        {treatments.map((treatment, idx) => {
                            const acupoints = Array.isArray(treatment.acupoints_used)
                                ? treatment.acupoints_used
                                : typeof treatment.acupoints_used === 'string'
                                    ? treatment.acupoints_used.split(',').map(s => s.trim()).filter(Boolean)
                                    : [];

                            return (
                                <TreatmentsCard
                                    key={treatment.id || idx}
                                    session_date_time={treatment.session_date_time || ''}
                                    treatment_methods={treatment.treatment_methods || ''}
                                    acupoints_used={acupoints}
                                    duration={treatment.duration || 0}
                                    notes={treatment.notes || ''}
                                    next_session={treatment.next_session || 'Não agendada'}
                                />
                            );
                        })}
                    </div>
                ) : (
                    <p className="text-gray-500">Nenhum tratamento registado.</p>
                )}
            </section>
        </div>
    );
}

export default function Page() {
    return (
        <AuthGuard requireAuth={true}>
            <ClientDashLayout>
                <TreatmentsPage />
            </ClientDashLayout>
        </AuthGuard>
    );
}
