'use client'

import Card from "../ui/Card";
import Badge from "../ui/Badge";
import InfoRow from "../ui/InfoRow";
import {getClients} from "@/services/patients";
import {useState, useEffect} from "react";

export default function ClientProfilePage() {
    const [clients, setClients] = useState([]);
    const [filteredClients, setFilteredClients] = useState([]);
    const [error, setError] = useState(null);
    const [loading, setLoading] = useState(true);
    const [currentPage, setCurrentPage] = useState(1);
    const [searchTerm, setSearchTerm] = useState('');
    const [userRole, setUserRole] = useState(null); // 'admin' ou 'patient'
    const clientsPerPage = 6;

    useEffect(() => {
        const ctrl = new AbortController();
        (async () => {
            try {
                const data = await getClients();

                if (data.role === 'admin') {
                    setClients(data.clients || []);
                    setFilteredClients(data.clients || []);
                    setUserRole('admin');
                } else if (data.role === 'patient') {
                    setClients([data.client]);
                    setFilteredClients([data.client]);
                    setUserRole('patient');
                }

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
        if (userRole === 'admin' && searchTerm) {
            const filtered = clients.filter(client =>
                client.full_name.toLowerCase().includes(searchTerm.toLowerCase())
            );
            setFilteredClients(filtered);
            setCurrentPage(1);
        } else {
            setFilteredClients(clients);
        }
    }, [searchTerm, clients, userRole]);

    if (loading) return <div className="p-6">A carregar…</div>;
    if (error) return <div className="p-6 text-red-600">Falha ao carregar.</div>;
    if (!clients || clients.length === 0) return <div className="p-6">Nenhum Cliente.</div>;

    if (userRole === 'patient') {
        const client = clients[0];
        return (
            <div className="grid grid-cols-12 gap-6">
                <div className="col-span-12">
                    <ClientHeaderCard client={client} showEditButton={true} />
                </div>

                <div className="col-span-12 md:col-span-6">
                    <ConsultationInfoCard client={client} />
                </div>

                <div className="col-span-12 md:col-span-6">
                    <EmergencyContactCard contact={client.emergency_contact} />
                </div>

                <div className="col-span-12 md:col-span-6">
                    <ConditionsCard items={client.conditions} />
                </div>

                <div className="col-span-12 md:col-span-6">
                    <AllergiesCard items={client.allergies} />
                </div>
            </div>
        );
    }

    const indexOfLastClient = currentPage * clientsPerPage;
    const indexOfFirstClient = indexOfLastClient - clientsPerPage;
    const currentClients = filteredClients.slice(indexOfFirstClient, indexOfLastClient);
    const totalPages = Math.ceil(filteredClients.length / clientsPerPage);

    return (
        <div className="space-y-6">
            <div className="flex items-center gap-4">
                <div className="flex-1 relative">
                    <input
                        type="text"
                        placeholder="Pesquisar por nome do cliente..."
                        value={searchTerm}
                        onChange={(e) => setSearchTerm(e.target.value)}
                        className="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-yellow-500 focus:border-transparent"
                    />
                    {searchTerm && (
                        <button
                            onClick={() => setSearchTerm('')}
                            className="absolute right-3 top-1/2 -translate-y-1/2 text-gray-400 hover:text-gray-600"
                        >
                            ✕
                        </button>
                    )}
                </div>
                <div className="text-sm text-gray-600">
                    {filteredClients.length} {filteredClients.length === 1 ? 'cliente' : 'clientes'}
                </div>
            </div>

            <div className="grid grid-cols-12 gap-6">
                {currentClients.map((client) => (
                    <div key={client.id} className="col-span-12">
                        <ClientHeaderCard client={client} showEditButton={true} />
                    </div>
                ))}
            </div>

            {filteredClients.length > 0 && (
                <Pagination
                    currentPage={currentPage}
                    totalPages={totalPages}
                    onPageChange={setCurrentPage}
                />
            )}

            {filteredClients.length === 0 && searchTerm && (
                <div className="text-center py-12">
                    <p className="text-gray-500">
                        Nenhum cliente encontrado com o nome "{searchTerm}"
                    </p>
                </div>
            )}
        </div>
    );
}

function Pagination({ currentPage, totalPages, onPageChange }) {
    if (totalPages <= 1) return null;

    const pages = [];
    const maxVisiblePages = 5;

    let startPage = Math.max(1, currentPage - Math.floor(maxVisiblePages / 2));
    let endPage = Math.min(totalPages, startPage + maxVisiblePages - 1);

    if (endPage - startPage < maxVisiblePages - 1) {
        startPage = Math.max(1, endPage - maxVisiblePages + 1);
    }

    for (let i = startPage; i <= endPage; i++) {
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

            {startPage > 1 && (
                <>
                    <button
                        onClick={() => onPageChange(1)}
                        className="px-3 py-2 rounded-md border hover:bg-gray-50"
                    >
                        1
                    </button>
                    {startPage > 2 && <span className="px-2">...</span>}
                </>
            )}

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

            {endPage < totalPages && (
                <>
                    {endPage < totalPages - 1 && <span className="px-2">...</span>}
                    <button
                        onClick={() => onPageChange(totalPages)}
                        className="px-3 py-2 rounded-md border hover:bg-gray-50"
                    >
                        {totalPages}
                    </button>
                </>
            )}

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

function ClientHeaderCard({ client, showEditButton }) {
    return (
        <Card>
            <div className="flex gap-4">
                <div className="size-14 rounded-full bg-gray-200 flex items-center justify-center font-medium">
                    {client.full_name.split(" ").map(s => s[0]).join("").slice(0, 2)}
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

                {showEditButton && (
                    <div className="self-start">
                        <button className="rounded-md border px-3 py-2 text-sm hover:bg-gray-50">
                            Editar Perfil
                        </button>
                    </div>
                )}
            </div>
        </Card>
    );
}

function ConsultationInfoCard({ client }) {
    return (
        <Card title="Informações da Consulta">
            <div className="space-y-2 text-sm">
                <InfoRow><b>Cliente Desde:</b> {client.since || 'N/A'}</InfoRow>
                <InfoRow><b>Última Visita:</b> {client.lastVisit || 'N/A'}</InfoRow>
                <InfoRow><b>Próxima Consulta:</b> {client.nextVisit || 'N/A'}</InfoRow>
            </div>
        </Card>
    );
}

function ConditionsCard({ items }) {
    return (
        <Card title="Condições Actuais">
            {items?.length ? (
                <div className="flex flex-wrap gap-2">
                    {items.map((c, idx) => (
                        <Badge key={idx}>{c}</Badge>
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
                    {items.map((a, idx) => (
                        <Badge key={idx}>{a}</Badge>
                    ))}
                </div>
            ) : (
                <Badge>Nenhuma registada</Badge>
            )}
        </Card>
    );
}

function EmergencyContactCard({ contact }) {
    if (!contact) {
        return (
            <Card title="Contacto de Emergência">
                <div className="text-sm opacity-70">Nenhum contacto registado</div>
            </Card>
        );
    }

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