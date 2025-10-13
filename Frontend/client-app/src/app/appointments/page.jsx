'use client'

import { useState, useEffect } from "react";
import Card from "@/components/ui/Card";
import { getAppointments } from "@/services/appointments";
import {mockAppointments} from "@/mocks/appointment";

export default function AppointmentsPage() {
    const [appointments, setAppointments] = useState([]);
    const [loading, setLoading] = useState(true);
    const [error, setError] = useState(null);
    const [filter, setFilter] = useState('all');
    const [currentPage, setCurrentPage] = useState(1);
    const appointmentsPerPage = 10;

    useEffect(() => {
        const ctrl = new AbortController();
        (async () => {
            try {
                //const data = await getAppointments();
                //setAppointments(data);*}
                await new Promise(resolve => setTimeout(resolve, 800));
                setAppointments(mockAppointments);
            } catch (e) {
                if (e.name !== "CanceledError") setError(e);
            } finally {
                setLoading(false);
            }
        })();
        return () => ctrl.abort();
    }, []);

    if (loading) return <div className="p-6">A carregar consultas…</div>;
    if (error) return <div className="p-6 text-red-600">Erro ao carregar consultas.</div>;

    // Filtrar consultas
    const filteredAppointments = appointments.filter(apt => {
        const aptDate = new Date(apt.appointment_date);
        const today = new Date();
        today.setHours(0, 0, 0, 0);

        switch(filter) {
            case 'today':
                return aptDate.toDateString() === today.toDateString();
            case 'upcoming':
                return aptDate >= today;
            case 'past':
                return aptDate < today;
            default:
                return true;
        }
    });

    // Paginação
    const indexOfLast = currentPage * appointmentsPerPage;
    const indexOfFirst = indexOfLast - appointmentsPerPage;
    const currentAppointments = filteredAppointments.slice(indexOfFirst, indexOfLast);
    const totalPages = Math.ceil(filteredAppointments.length / appointmentsPerPage);

    return (
        <div className="space-y-6">
            {/* Header */}
            <div className="flex items-center justify-between">
                <div>
                    <h1 className="text-2xl font-semibold">Consultas</h1>
                    <p className="text-sm text-gray-600">
                        {filteredAppointments.length} consulta(s) encontrada(s)
                    </p>
                </div>
                <button className="px-4 py-2 bg-yellow-500 text-white rounded-md hover:bg-yellow-600">
                    + Nova Consulta
                </button>
            </div>

            {/* Filtros */}
            <div className="flex gap-2">
                <FilterButton
                    active={filter === 'all'}
                    onClick={() => setFilter('all')}
                >
                    Todas
                </FilterButton>
                <FilterButton
                    active={filter === 'today'}
                    onClick={() => setFilter('today')}
                >
                    Hoje
                </FilterButton>
                <FilterButton
                    active={filter === 'upcoming'}
                    onClick={() => setFilter('upcoming')}
                >
                    Próximas
                </FilterButton>
                <FilterButton
                    active={filter === 'past'}
                    onClick={() => setFilter('past')}
                >
                    Passadas
                </FilterButton>
            </div>

            {/* Lista de Consultas */}
            <div className="space-y-3">
                {currentAppointments.map((appointment) => (
                    <AppointmentCard key={appointment.id} appointment={appointment} />
                ))}
            </div>

            {/* Paginação */}
            {totalPages > 1 && (
                <Pagination
                    currentPage={currentPage}
                    totalPages={totalPages}
                    onPageChange={setCurrentPage}
                />
            )}
        </div>
    );
}

function FilterButton({ active, onClick, children }) {
    return (
        <button
            onClick={onClick}
            className={`px-4 py-2 rounded-md text-sm transition-colors ${
                active
                    ? 'bg-yellow-500 text-white'
                    : 'bg-white border hover:bg-gray-50'
            }`}
        >
            {children}
        </button>
    );
}

function AppointmentCard({ appointment }) {
    const date = new Date(appointment.appointment_date);
    const isToday = date.toDateString() === new Date().toDateString();
    const isPast = date < new Date();

    return (
        <Card>
            <div className="flex items-center gap-4">
                {/* Data */}
                <div className={`flex flex-col items-center justify-center w-16 h-16 rounded-lg ${
                    isToday ? 'bg-yellow-100' : 'bg-gray-100'
                }`}>
                    <div className="text-xs opacity-70">
                        {date.toLocaleDateString('pt-PT', { month: 'short' })}
                    </div>
                    <div className="text-2xl font-semibold">
                        {date.getDate()}
                    </div>
                </div>

                {/* Info */}
                <div className="flex-1">
                    <div className="flex items-center gap-2">
                        <h3 className="font-semibold">
                            {appointment.patient_name || 'Cliente não especificado'}
                        </h3>
                        <StatusBadge status={appointment.status} />
                    </div>
                    <div className="text-sm text-gray-600 flex items-center gap-3 mt-1">
                        <span>🕐 {date.toLocaleTimeString('pt-PT', { hour: '2-digit', minute: '2-digit' })}</span>
                        {appointment.practitioner_name && (
                            <span>👤 {appointment.practitioner_name}</span>
                        )}
                    </div>
                    {appointment.notes && (
                        <p className="text-sm text-gray-500 mt-2 line-clamp-1">
                            {appointment.notes}
                        </p>
                    )}
                </div>

                {/* Ações */}
                <div className="flex gap-2">
                    <button className="px-3 py-1.5 text-sm border rounded-md hover:bg-gray-50">
                        Ver
                    </button>
                    <button className="px-3 py-1.5 text-sm border rounded-md hover:bg-gray-50">
                        Editar
                    </button>
                </div>
            </div>
        </Card>
    );
}

function StatusBadge({ status }) {
    const styles = {
        scheduled: 'bg-blue-100 text-blue-700',
        completed: 'bg-green-100 text-green-700',
        cancelled: 'bg-red-100 text-red-700',
        no_show: 'bg-gray-100 text-gray-700'
    };

    const labels = {
        scheduled: 'Agendada',
        completed: 'Concluída',
        cancelled: 'Cancelada',
        no_show: 'Faltou'
    };

    return (
        <span className={`px-2 py-0.5 text-xs rounded-full ${styles[status] || styles.scheduled}`}>
            {labels[status] || status}
        </span>
    );
}

function Pagination({ currentPage, totalPages, onPageChange }) {
    if (totalPages <= 1) return null;

    return (
        <div className="flex items-center justify-center gap-2">
            <button
                onClick={() => onPageChange(currentPage - 1)}
                disabled={currentPage === 1}
                className="px-3 py-2 rounded-md border disabled:opacity-50 disabled:cursor-not-allowed hover:bg-gray-50"
            >
                Anterior
            </button>

            <span className="text-sm text-gray-600">
                Página {currentPage} de {totalPages}
            </span>

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