'use client'
import {use, useEffect, useState} from "react";
import {getPatient} from "@/services/clients";
import InfoRow from "@/components/ui/InfoRow";
import Card from "@/components/ui/Card";

export function PatientProfilePage({params}) {
    const [patient, setPatient] = useState([]);
    const [user, setUser] = useState([]);
    const [error, setError] = useState(null);
    const [loading, setLoading] = useState(true);

    const slug = use(params);

    useEffect(() => {
        const ctrl = new AbortController();
        (async () => {
            try {
                const data = await getPatient(slug.id);
                setPatient(data);
                console.log("Fetched patient:", data);
            } catch (e) {
                if (e.name !== "CanceledError") setError(e);
                console.error("Error:", e);
                
            } finally {
                setLoading(false);
            }
        })();
        return () => ctrl.abort();
    }, []);


    useEffect(() => {
        if (patient) console.log("State updated:", patient);
    }, [patient]);

    if (error) return <div className="p-6 text-red-600">Falha ao carregar.</div>;
    if (loading) return <div className="p-6">A carregar…</div>;
    if (!patient) return <div className="p-6">PATIENT LOADING ERROR</div>;

    const safePatient = { ...patient, user: { name: "", ...(patient.user || {}) } };

    return (
        <div>
            <PatientCard patient={safePatient} />
        </div>
    );
}

function PatientHeaderCard({ patient }) {
    return (
        <div className="flex flex-col">
            <div className="flex flex-row space-x-2">
                <div id="patientIcon" className="flex">ICON</div>
                <div className="flex flex-col w-full">
                    <span className="flex">FIRST NAME</span>
                    <span className="flex">Patient ID info</span>
                </div>
            </div>
        </div>
    );
}

function PatientCard({ patient }) {
    return (
        <Card>
            <div className="flex gap-4">
                <div className="size-14 rounded-full bg-gray-200 flex items-center justify-center font-medium">
                    {patient.user.name.slice(0,1)}
                </div>

                <div className="flex-1 grid grid-cols-2 gap-y-2">
                    <div>
                        <div className="text-lg font-semibold">{patient.user.name}</div>
                        <div className="text-sm opacity-70">ID do Paciente: #{patient.id}</div>
                    </div>

                    <div className="col-span-2 mt-2 grid grid-cols-2 gap-2">
                        <InfoRow icon={<span>✉️</span>}>{patient.user.email}</InfoRow>
                        <InfoRow icon={<span>📞</span>}>{patient.phone_number}</InfoRow>
                        <InfoRow icon={<span>📍</span>}>{patient.address}</InfoRow>
                        <InfoRow icon={<span>📅</span>}>Nascimento: {patient.birth_date}</InfoRow>
                    </div>
                </div>

                <div className="self-start">
                    <button className="rounded-md border px-3 py-2 text-sm">Editar Perfil</button>
                </div>
            </div>
        </Card>
    );
}