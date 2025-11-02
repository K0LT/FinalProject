"use client";

import { useEffect, useState } from "react";
import {Card} from "../ui/Card";
import Badge from "../ui/Badge";
import InfoRow from "../ui/InfoRow";
import { getClients } from "@/services/clients";

export default function ClientProfilePage() {
    const [clients, setClients] = useState([]);
    const [error, setError] = useState(null);
    const [loading, setLoading] = useState(true);
    const [currentPage, setCurrentPage] = useState(1);
    const clientsPerPage = 6;

    useEffect(() => {
        const ctrl = new AbortController();
        (async () => {
            try {
                setLoading(true);
                setError(null);
                const data = await getClients();
                setClients(Array.isArray(data) ? data : []);
            } catch (e) {
                if (e?.name !== "CanceledError") setError(e);
                // console.error(e);
            } finally {
                setLoading(false);
            }
        })();
        return () => ctrl.abort();
    }, []);

    if (loading) return <div className="p-6">A carregar…</div>;
    if (error) return <div className="p-6 text-red-600">Falha ao carregar.</div>;
    if (!clients?.length) return <div className="p-6">Nenhum Cliente.</div>;

    const totalPages = Math.ceil(clients.length / clientsPerPage);
    const indexOfLast = currentPage * clientsPerPage;
    const indexOfFirst = indexOfLast - clientsPerPage;
    const currentClients = clients.slice(indexOfFirst, indexOfLast);

    return (
        <div className="grid grid-cols-12 gap-6">
            {currentClients.map((client) => (
                <div key={client.id ?? client.email} className="col-span-12 lg:col-span-8">
                    <ClientHeaderCard client={client} />
                </div>
            ))}

            {currentClients[0] && (
                <>
                    <div className="col-span-12 md:col-span-6 lg:col-span-4">
                        <ConsultationInfoCard client={currentClients[0]} />
                    </div>
                    <div className="col-span-12 md:col-span-6 lg:col-span-4">
                        <ConditionsCard items={currentClients[0].conditions} />
                    </div>
                    <div className="col-span-12 md:col-span-6 lg:col-span-4">
                        <AllergiesCard items={currentClients[0].allergies} />
                    </div>
                </>
            )}

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
    const pages = Array.from({ length: totalPages }, (_, i) => i + 1);

    return (
        <div className="mt-4 flex items-center justify-center gap-2">
            <button
                onClick={() => onPageChange(currentPage - 1)}
                disabled={currentPage === 1}
                className="rounded-md border px-3 py-2 hover:bg-gray-50 disabled:cursor-not-allowed disabled:opacity-50"
            >
                Anterior
            </button>

            {pages.map((p) => (
                <button
                    key={p}
                    onClick={() => onPageChange(p)}
                    aria-current={currentPage === p ? "page" : undefined}
                    className={[
                        "rounded-md border px-3 py-2",
                        currentPage === p ? "border-yellow-500 bg-yellow-500 text-white" : "hover:bg-gray-50",
                    ].join(" ")}
                >
                    {p}
                </button>
            ))}

            <button
                onClick={() => onPageChange(currentPage + 1)}
                disabled={currentPage === totalPages}
                className="rounded-md border px-3 py-2 hover:bg-gray-50 disabled:cursor-not-allowed disabled:opacity-50"
            >
                Próximo
            </button>
        </div>
    );
}

function initialsOf(name = "") {
    return name
        .trim()
        .split(/\s+/)
        .map((s) => s[0])
        .join("")
        .toUpperCase()
        .slice(0, 2) || "—";
}

function ClientHeaderCard({ client }) {
    return (
        <Card>
            <div className="flex gap-4">
                <div className="flex size-14 items-center justify-center rounded-full bg-gray-200 font-medium">
                    {initialsOf(client.full_name)}
                </div>

                <div className="grid flex-1 grid-cols-2 gap-y-2">
                    <div>
                        <div className="text-lg font-semibold">{client.full_name || "Sem nome"}</div>
                        <div className="text-sm opacity-70">ID do Paciente: #{client.id ?? "—"}</div>
                    </div>

                    <div className="col-span-2 mt-2 grid grid-cols-2 gap-2">
                        <InfoRow icon={<span>✉️</span>}>{client.email || "—"}</InfoRow>
                        <InfoRow icon={<span>📞</span>}>{client.phone_number || "—"}</InfoRow>
                        <InfoRow icon={<span>📍</span>}>{client.address || "—"}</InfoRow>
                        <InfoRow icon={<span>📅</span>}>
                            Nascimento: {client.birth_date || "—"}
                        </InfoRow>
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
                <InfoRow>
                    <b>Cliente Desde</b> {client.since || "—"}
                </InfoRow>
                <InfoRow>
                    <b>Última Visita</b> {client.lastVisit || "—"}
                </InfoRow>
                <InfoRow>
                    <b>Próxima Consulta</b> {client.nextVisit || "—"}
                </InfoRow>
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
