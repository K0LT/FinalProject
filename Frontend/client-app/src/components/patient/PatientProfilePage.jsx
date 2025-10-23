'use client'

import Card from "../ui/Card";
import Badge from "../ui/Badge";
import InfoRow from "../ui/InfoRow";
import {getPatients} from "@/services/clients";
import {useState} from "react";
import {useEffect} from "react";

export default function PatientProfilePage() {
    const [patients, setPatients] = useState([]);
    const [error, setError] = useState(null);
    const [loading, setLoading] = useState(true);
    const [currentPage,setCurrentPage] = useState(1);
    const patientsPerPage=6;

    useEffect(() => {
        const ctrl = new AbortController();
        (async () => {
            try {
                const data = await getPatients();
                setPatients(data);
                console.log("Fetched client:", data);
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
        if (patients) console.log("State updated:", patients);
    }, [patients]);

    if (error) return <div className="p-6 text-red-600">Falha ao carregar.</div>;
    if (!patients) return <div className="p-6">A carregar…</div>;
    if (patients.length === 0) return <div className="p-6">Nenhum Cliente.</div>;

    const indexOfLastClient = currentPage * patientsPerPage;
    const indexOfFirstClient = indexOfLastClient - patientsPerPage;
    const currentClients = patients.slice(indexOfFirstClient, indexOfLastClient);
    const totalPages = Math.ceil(patients.length / patientsPerPage);


    return (
        <div className="grid grid-cols-12 gap-6">
            {currentClients.map((client) => (
                <div key={client.id} className="col-span-8">
                    <ClientHeaderCard client={client} />
                </div>
            ))}
            <div className="col-span-12">
                <Pagination
                    currentPage={currentPage}
                    totalPages={totalPages}
                    onPageChange={setCurrentPage}
                />
            </div>
        </div>
    );


}


function Pagination({ currentPage, totalPages, onPageChange }) {
    if (totalPages <= 1) return null;

    const pages = [];
    for (let i = 1; i <= totalPages; i++) {
        pages.push(i);
    }

    return (
        <div className="flex items-center justify-center gap-2 mt-4">
            <button
                onClick={() => onPageChange(currentPage - 1)}
                disabled={currentPage === 1}
                className="px-3 py-2 rounded-md border disabled:opacity-50 disabled:cursor-not-allowed hover:bg-gray-50"
            >
                Anterior
            </button>

            {pages.map((page) => (
                <button
                    key={page}
                    onClick={() => onPageChange(page)}
                    className={`px-3 py-2 rounded-md border ${
                        currentPage === page
                            ? 'bg-yellow-500 text-white border-yellow-500'
                            : 'hover:bg-gray-50'
                    }`}
                >
                    {page}
                </button>
            ))}

            <button
                onClick={() => onPageChange(currentPage + 1)}
                disabled={currentPage === totalPages}
                className="px-3 py-2 rounded-md border disabled:opacity-50 disabled:cursor-not-allowed hover:bg-gray-50"
            >
                Próximo
            </button>
        </div>
    );
}

function ClientHeaderCard({ client }) {
    return (
        <Card>
            <div className="flex gap-4">
                <div className="size-14 rounded-full bg-gray-200 flex items-center justify-center font-medium">
                    {client.name.split(" ").map(s => s[0]).join("").slice(0,2)}
                </div>

                <div className="flex-1 grid grid-cols-2 gap-y-2">
                    <div>
                        <div className="text-lg font-semibold">{client.name}</div>
                        <div className="text-sm opacity-70">ID do Paciente: #{client.id}</div>
                    </div>

                    <div className="col-span-2 mt-2 grid grid-cols-2 gap-2">
                        <InfoRow icon={<span>✉️</span>}>{client.email}</InfoRow>
                        <InfoRow icon={<span>📞</span>}>{client.phone_number}</InfoRow>
                        <InfoRow icon={<span>📍</span>}>{client.address}</InfoRow>
                        <InfoRow icon={<span>📅</span>}>Nascimento: {client.birth_date}</InfoRow>
                    </div>
                </div>

                <div className="self-start">
                    <button className="rounded-md border px-3 py-2 text-sm">Editar Perfil</button>
                </div>
            </div>
        </Card>
    );
}

function ConsultationInfoCard({ client }) {
    return (
        <Card title="Informações da Consulta">
            <div className="space-y-2 text-sm">
                <InfoRow><b>Cliente Desde</b> {client.since}</InfoRow>
                <InfoRow><b>Última Visita</b> {client.lastVisit}</InfoRow>
                <InfoRow><b>Próxima Consulta</b> {client.nextVisit}</InfoRow>
            </div>
        </Card>
    );
}

function ConditionsCard({ items }) {
    return (
        <Card title="Condições Actuais">
            {items?.length ? (
                <div className="flex flex-wrap gap-2">
                    {items.map((c) => (
                        <Badge key={c}>{c}</Badge>
                    ))}
                </div>
            ) : (
                <div className="text-sm opacity-70">Nenhuma</div>
            )}
        </Card>
    );
}

function AllergiesCard({ items }) {
    return (
        <Card title="Alergias">
            {items?.length ? (
                <div className="flex flex-wrap gap-2">
                    {items.map((a) => (
                        <Badge key={a}>{a}</Badge>
                    ))}
                </div>
            ) : (
                <Badge>Nenhuma registada</Badge>
            )}
        </Card>
    );
}

function EmergencyContactCard({ contact }) {
    return (
        <Card title="Contacto de Emergência">
            <div className="space-y-1 text-sm">
                <div className="font-medium">{contact.name}</div>
                <div className="opacity-70">{contact.relation}</div>
                <div>{contact.phone}</div>
            </div>
        </Card>
    );
}