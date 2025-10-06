'use client'

import Card from "../ui/Card";
import Badge from "../ui/Badge";
import InfoRow from "../ui/InfoRow";
import {getClient} from "@/services/clients";
import {useState} from "react";
import {useEffect} from "react";

export default function ClientProfilePage() {
    const [client, setClient] = useState(null);
    const [error, setError] = useState(null);

    useEffect(() => {
        const ctrl = new AbortController();
        (async () => {
            try {
                const data = await getClient(6);
                setClient(data);
                console.log("Fetched client:", data);
            } catch (e) {
                if (e.name !== "CanceledError") setError(e);
            }
        })();
        return () => ctrl.abort();
    }, []);


    useEffect(() => {
        if (client) console.log("State updated:", client);
    }, [client]);

    if (error) return <div className="p-6 text-red-600">Falha ao carregar.</div>;
    if (!client) return <div className="p-6">A carregar…</div>;

    return (
        <div className="grid grid-cols-12 gap-6">
            <div className="col-span-8">
                <ClientHeaderCard client={client} />
            </div>
        </div>
    );
}

function ClientHeaderCard({ client }) {
    return (
        <Card>
            <div className="flex gap-4">
                <div className="size-14 rounded-full bg-gray-200 flex items-center justify-center font-medium">
                    {client.full_name.split(" ").map(s => s[0]).join("").slice(0,2)}
                </div>

                <div className="flex-1 grid grid-cols-2 gap-y-2">
                    <div>
                        <div className="text-lg font-semibold">{client.full_name}</div>
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