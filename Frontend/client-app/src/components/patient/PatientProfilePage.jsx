'use client'
import {use, useEffect, useState} from "react";
import {getPatient} from "@/services/patients";
import InfoRow from "@/components/ui/InfoRow";
import Card from "@/components/ui/Card";
import {useParams} from "next/navigation";

export function PatientProfilePage() {
    const [patient, setPatient] = useState([]);
    const [error, setError] = useState(null);
    const [loading, setLoading] = useState(true);

    const params = useParams();

    useEffect(() => {
        const ctrl = new AbortController();
        (async () => {
            try {
                const data = await getPatient(params.id);
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

        <div className="flex flex-col space-x-2 gap-4">
            <div className="flex flex-row gap-4">
                <PatientCard patient={safePatient} />
                <PatientAppointmentInfoCard patient={safePatient}/>
            </div>
            <div className="flex flex-row gap-4">
                <PatientConditions patient={safePatient}/>
                <PatientAllergies patient={safePatient}/>
                <PatientEmergencyContact patient={safePatient}/>
            </div>
        </div>
        );
}

function PatientAppointmentInfoCard({patient}){
    return <div className="flex flex-col justify-between rounded-2xl border border-amber-100 p-4 bg-white gap-4">
        <span>Informações da Consulta</span>
        <div className="flex flex-col mt-6">
            <span className="text-gray-500">Cliente Desde</span>
            <span>{patient.client_since ? patient.client_since : "data-cliente-desde"}</span>
        </div>
        <div className="flex flex-col">
            <span className="text-gray-500">Última Visita</span>
            <span>{patient.last_visit ? patient.last_visit : "data-ultima-visita"}</span>
        </div>
        <div className="flex flex-col">
            <span className="text-gray-500">Próxima Consulta</span>
            <span>{patient.next_appointment ? patient.next_appointment : "data-proxima-consulta"}</span>
        </div>
    </div>
}

function PatientConditions({patient}){
    return <div className="flex flex-col justify-between rounded-2xl border border-amber-100 p-4 bg-white gap-2">
        <span>Condições Atuais</span>
        <div className="flex flex-col mt-2">
            <div className="flex flex-row space-x-2 pt-1.5">{patient.conditions ?
                patient.conditions.map((condition) => (
                <div key={condition.id} className="border rounded-lg border-amber-200 text-sm px-1.5">{condition.name}</div>
            )) : <div key="no-conditions" className="border rounded-lg border-amber-200 text-sm px-1.5">Nenhuma registada</div> }</div>
        </div>
    </div>
}

function PatientAllergies({patient}){
    return <div className="flex flex-col justify-between rounded-2xl border border-amber-100 p-4 bg-white gap-2">
        <span>Alergias</span>
        <div className="flex flex-col mt-2">
            <div className="flex flex-row space-x-2 pt-1.5">{patient.allergies ?
                patient.allergies.map((allergy) => (
                    <div key={allergy.id} className="border rounded-lg border-amber-200 text-sm px-1.5">{allergy.allergen}</div>
                )) : <div key="no-conditions" className="border rounded-lg border-amber-200 text-sm px-1.5">Nenhuma registada</div> }</div>
        </div>
    </div>
}

function PatientEmergencyContact({patient}){
    return <div className="flex flex-col justify-between rounded-2xl border border-amber-100 p-4 bg-white gap-2">
        <span>Contacto de Emergência</span>
        <span>{patient.emergency_contact_name}</span>
        <span className="text-gray-500">{patient.emergency_contact_relation}</span>
        <span>{patient.emergency_contact_phone}</span>
    </div>
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