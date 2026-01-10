'use client';

import { useEffect, useState } from "react";
import { useParams } from "next/navigation";
import ClientDashLayout from "@/components/clientDashboard/ClientDashLayout";
import { AuthGuard } from "@/components/Auth/AuthGuard";
import { useAuth } from "@/context/AuthContext";
import { getUserWeightTrackings } from "@/services/userServices";
import { Scale, TrendingUp, TrendingDown, Minus, Calendar } from "lucide-react";

function WeightTrackingPage() {
    const params = useParams();
    const { user } = useAuth();

    const [weightRecords, setWeightRecords] = useState([]);
    const [loading, setLoading] = useState(true);
    const [error, setError] = useState(null);

    useEffect(() => {
        const loadData = async () => {
            try {
                const data = await getUserWeightTrackings();
                // Sort by date descending (most recent first)
                const sorted = (Array.isArray(data) ? data : []).sort((a, b) =>
                    new Date(b.recorded_at || b.created_at) - new Date(a.recorded_at || a.created_at)
                );
                setWeightRecords(sorted);
            } catch (e) {
                console.error('Error loading weight records:', e);
                setError(e);
            } finally {
                setLoading(false);
            }
        };

        loadData();
    }, []);

    // Calculate stats
    const latestWeight = weightRecords[0]?.weight;
    const previousWeight = weightRecords[1]?.weight;
    const weightChange = latestWeight && previousWeight ? (latestWeight - previousWeight).toFixed(1) : null;

    const getTrendIcon = () => {
        if (!weightChange) return <Minus className="w-5 h-5 text-gray-400" />;
        if (parseFloat(weightChange) > 0) return <TrendingUp className="w-5 h-5 text-red-500" />;
        if (parseFloat(weightChange) < 0) return <TrendingDown className="w-5 h-5 text-green-500" />;
        return <Minus className="w-5 h-5 text-gray-400" />;
    };

    if (loading) return <div className="p-6">A carregar...</div>;
    if (error) return <div className="p-6 text-red-600">Falha ao carregar: {error.message}</div>;

    return (
        <div className="space-y-6">
            <div className="flex justify-between items-center">
                <h1 className="text-2xl font-bold">Controlo de Peso</h1>
            </div>

            {/* Stats Cards */}
            <div className="grid gap-4 md:grid-cols-3">
                <div className="rounded-2xl border border-amber-100 p-5 bg-white">
                    <div className="flex items-center gap-3">
                        <div className="p-2 rounded-lg bg-amber-50">
                            <Scale className="w-5 h-5 text-amber-600" />
                        </div>
                        <div>
                            <p className="text-sm text-gray-500">Peso Actual</p>
                            <p className="text-2xl font-bold">
                                {latestWeight ? `${latestWeight} kg` : '—'}
                            </p>
                        </div>
                    </div>
                </div>

                <div className="rounded-2xl border border-amber-100 p-5 bg-white">
                    <div className="flex items-center gap-3">
                        {getTrendIcon()}
                        <div>
                            <p className="text-sm text-gray-500">Variação</p>
                            <p className="text-2xl font-bold">
                                {weightChange ? `${weightChange > 0 ? '+' : ''}${weightChange} kg` : '—'}
                            </p>
                        </div>
                    </div>
                </div>

                <div className="rounded-2xl border border-amber-100 p-5 bg-white">
                    <div className="flex items-center gap-3">
                        <div className="p-2 rounded-lg bg-amber-50">
                            <Calendar className="w-5 h-5 text-amber-600" />
                        </div>
                        <div>
                            <p className="text-sm text-gray-500">Total de Registos</p>
                            <p className="text-2xl font-bold">{weightRecords.length}</p>
                        </div>
                    </div>
                </div>
            </div>

            {/* Weight History */}
            <section>
                <h2 className="text-lg font-semibold mb-4">Histórico de Peso</h2>
                {weightRecords.length > 0 ? (
                    <div className="rounded-2xl border border-amber-100 bg-white overflow-hidden">
                        <table className="w-full">
                            <thead className="bg-amber-50">
                                <tr>
                                    <th className="px-4 py-3 text-left text-sm font-medium text-gray-600">Data</th>
                                    <th className="px-4 py-3 text-left text-sm font-medium text-gray-600">Peso</th>
                                    <th className="px-4 py-3 text-left text-sm font-medium text-gray-600">Notas</th>
                                </tr>
                            </thead>
                            <tbody className="divide-y divide-amber-100">
                                {weightRecords.map((record, idx) => (
                                    <tr key={record.id || idx} className="hover:bg-amber-50/50">
                                        <td className="px-4 py-3 text-sm">
                                            {new Date(record.recorded_at || record.created_at).toLocaleDateString('pt-PT', {
                                                year: 'numeric',
                                                month: 'long',
                                                day: 'numeric'
                                            })}
                                        </td>
                                        <td className="px-4 py-3 text-sm font-medium">{record.weight} kg</td>
                                        <td className="px-4 py-3 text-sm text-gray-500">{record.notes || '—'}</td>
                                    </tr>
                                ))}
                            </tbody>
                        </table>
                    </div>
                ) : (
                    <div className="text-center py-12">
                        <Scale className="w-12 h-12 text-gray-300 mx-auto mb-4" />
                        <p className="text-gray-500">Nenhum registo de peso.</p>
                        <p className="text-sm text-gray-400 mt-1">Os registos de peso aparecerão aqui.</p>
                    </div>
                )}
            </section>
        </div>
    );
}

export default function Page() {
    return (
        <AuthGuard requireAuth={true}>
            <ClientDashLayout>
                <WeightTrackingPage />
            </ClientDashLayout>
        </AuthGuard>
    );
}
