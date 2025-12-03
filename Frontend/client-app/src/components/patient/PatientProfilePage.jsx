'use client'
import {useEffect, useState} from "react";
import {getPatient} from "@/services/patients";
import InfoRow from "@/components/ui/InfoRow";
import Card from "@/components/ui/Card";
import {useParams} from "next/navigation";
import UpdatePatientModal from "@/components/patient/UpdatePatientModal";

export function PatientProfilePage() {
    const [patient, setPatient] = useState([]);
    const [error, setError] = useState(null);
    const [loading, setLoading] = useState(true);
    const [open, setOpen] = useState(false);

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
        <div className="flex flex-col gap-4">
            {open ? <UpdatePatientModal patient={safePatient} onClose={() => setOpen(false)} open={open} patientId={params.id} /> : " "}

            <div className="flex flex-col lg:flex-row gap-4">
                <div className="flex-1">
                    <PatientCard patient={safePatient} setOpen={setOpen}/>
                </div>
                <div className="lg:w-80">
                    <PatientAppointmentInfoCard patient={safePatient}/>
                </div>
            </div>
            <div className="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                <PatientConditions patient={safePatient}/>
                <PatientAllergies patient={safePatient}/>
                <PatientEmergencyContact patient={safePatient}/>
            </div>
        </div>
    );
}

function PatientAppointmentInfoCard({patient}){
    return <div className="flex flex-col rounded-2xl border border-amber-100 p-6 bg-white h-full">
        <span className="font-semibold mb-6">Informações da Consulta</span>
        <div className="flex flex-col gap-6">
            <div className="flex flex-col gap-1">
                <span className="text-sm text-gray-500">Cliente Desde</span>
                <span className="font-medium">{patient.client_since ? patient.client_since : "data-cliente-desde"}</span>
            </div>
            <div className="flex flex-col gap-1">
                <span className="text-sm text-gray-500">Última Visita</span>
                <span className="font-medium">{patient.last_visit ? patient.last_visit : "data-ultima-visita"}</span>
            </div>
            <div className="flex flex-col gap-1">
                <span className="text-sm text-gray-500">Próxima Consulta</span>
                <span className="font-medium">{patient.next_appointment ? patient.next_appointment : "data-proxima-consulta"}</span>
            </div>
        </div>
    </div>
}

function PatientConditions({patient}){
    return <div className="flex flex-col rounded-2xl border border-amber-100 p-6 bg-white">
        <span className="font-semibold mb-4">Condições Atuais</span>
        <div className="flex flex-wrap gap-2">{patient.conditions && patient.conditions.length > 0 ?
            patient.conditions.map((condition) => (
                <div key={condition.id} className="border rounded-lg border-amber-200 bg-amber-50 text-sm px-3 py-1.5">{condition.name}</div>
            )) : <div key="no-conditions" className="border rounded-lg border-amber-200 bg-amber-50 text-sm px-3 py-1.5">Nenhuma registada</div> }</div>
    </div>
}

function PatientAllergies({patient}){
    return <div className="flex flex-col rounded-2xl border border-amber-100 p-6 bg-white">
        <span className="font-semibold mb-4">Alergias</span>
        <div className="flex flex-wrap gap-2">{patient.allergies && patient.allergies.length > 0 ?
            patient.allergies.map((allergy) => (
                <div key={allergy.id} className="border rounded-lg border-amber-200 bg-amber-50 text-sm px-3 py-1.5">{allergy.allergen}</div>
            )) : <div key="no-allergies" className="border rounded-lg border-amber-200 bg-amber-50 text-sm px-3 py-1.5">Nenhuma registada</div> }</div>
    </div>
}

function PatientEmergencyContact({patient}){
    return <div className="flex flex-col rounded-2xl border border-amber-100 p-6 bg-white gap-3">
        <span className="font-semibold mb-2">Contacto de Emergência</span>
        <span className="font-medium">{patient.emergency_contact_name}</span>
        <span className="text-sm text-gray-500">{patient.emergency_contact_relation}</span>
        <span className="text-sm">{patient.emergency_contact_phone}</span>
    </div>
}

function PatientCard({ patient, setOpen }) {
    return (
        <Card className="h-full">
            <div className="flex gap-4">
                <div className="size-14 rounded-full bg-gray-200 flex items-center justify-center font-medium flex-shrink-0">
                    {patient.user.name.slice(0,1)}
                </div>

                <div className="flex-1 min-w-0">
                    <div className="flex items-start justify-between gap-4 mb-3">
                        <div>
                            <div className="text-lg font-semibold">{patient.user.name}</div>
                            <div className="text-sm opacity-70">ID do Paciente: #{patient.id}</div>
                        </div>
                        <button className="rounded-md border px-3 py-2 text-sm whitespace-nowrap" onClick={() => setOpen(true)}>Editar Perfil</button>
                    </div>

                    <div className="grid grid-cols-2 gap-2">
                        <InfoRow icon={<span>✉️</span>}>{patient.user.email}</InfoRow>
                        <InfoRow icon={<span>📞</span>}>{patient.phone_number}</InfoRow>
                        <InfoRow icon={<span>📍</span>}>{patient.address}</InfoRow>
                        <InfoRow icon={<span>📅</span>}>Nascimento: {patient.birth_date}</InfoRow>
                    </div>
                </div>
            </div>
        </Card>
    );
}