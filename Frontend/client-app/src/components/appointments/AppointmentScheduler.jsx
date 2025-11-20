'use client'

import { useState, useEffect } from "react";
import Card from "@/components/ui/Card";
import Calendar from "@/components/ui/Calendar";
import {
    getUpcomingAppointments,
    getAvailableSlots,
    createAppointment
} from "@/services/appointments";

export default function AppointmentScheduler() {
    const [selectedDate, setSelectedDate] = useState(new Date(2025, 9, 16)); // Oct 16, 2025
    const [selectedTime, setSelectedTime] = useState(null);
    const [appointments, setAppointments] = useState([]);
    const [availableSlots, setAvailableSlots] = useState([]);
    const [loading, setLoading] = useState({
        appointments: true,
        slots: false
    });
    const [error, setError] = useState(null);

    // ALTERAR POR DADOS DE API
    const MOCK_SLOTS = [
        { time: "09:00", available: true },
        { time: "10:00", available: true },
        { time: "11:00", available: false },
        { time: "13:00", available: true },
        { time: "14:00", available: true },
        { time: "15:00", available: true },
        { time: "16:00", available: true },
        { time: "17:00", available: true },
    ];

    const MOCK_APPOINTMENTS = [
        {
            id: 1,
            patient_name: "Inez Borges",
            type: "Consulta Inicial",
            appointment_date: "2024-09-20T14:00:00",
            duration: 60,
            status: "confirmed"
        },
        {
            id: 2,
            patient_name: "Miguel Rodrigues",
            type: "Tratamento de Seguimento",
            appointment_date: "2024-09-20T15:30:00",
            duration: 45,
            status: "confirmed"
        },
        {
            id: 3,
            patient_name: "Ana Santos",
            type: "Gestão da Dor",
            appointment_date: "2024-09-21T10:00:00",
            duration: 60,
            status: "pending"
        }
    ];

    // Fetch appointments
    useEffect(() => {
        const fetchAppointments = async () => {
            try {
                setLoading(prev => ({ ...prev, appointments: true }));

                await new Promise(resolve => setTimeout(resolve, 500));
                setAppointments(MOCK_APPOINTMENTS);
            } catch (err) {
                console.error("Error:", err);
                setError(err.message);
            } finally {
                setLoading(prev => ({ ...prev, appointments: false }));
            }
        };

        fetchAppointments();
    }, []);

    // Fetch slots when date changes
    useEffect(() => {
        const fetchSlots = async () => {
            try {
                setLoading(prev => ({ ...prev, slots: true }));
                setSelectedTime(null);

                await new Promise(resolve => setTimeout(resolve, 300));
                setAvailableSlots(MOCK_SLOTS);
            } catch (err) {
                console.error("Error:", err);
                setAvailableSlots([]);
            } finally {
                setLoading(prev => ({ ...prev, slots: false }));
            }
        };

        fetchSlots();
    }, [selectedDate]);

    const handleDateChange = (date) => {
        setSelectedDate(date);
    };

    const handleTimeSelect = (time) => {
        setSelectedTime(time);
    };

    const handleNewAppointment = async () => {
        if (!selectedDate || !selectedTime) {
            alert("Por favor selecione uma data e hora");
            return;
        }
        alert(`Nova consulta: ${selectedDate.toLocaleDateString('pt-PT')} às ${selectedTime}`);
    };

    const appointmentDates = appointments.map(apt => new Date(apt.appointment_date));

    if (error) {
        return (
            <div className="p-6">
                <div className="bg-red-50 border border-red-200 rounded-lg p-4">
                    <h3 className="text-red-800 font-semibold">Erro ao carregar dados</h3>
                    <p className="text-red-600 text-sm">{error}</p>
                </div>
            </div>
        );
    }

    return (
        <div className="space-y-6">
            {/* BookingHeader */}
            <div className="flex items-center justify-between">
                <h1 className="text-2xl font-semibold">Agendamento de Consultas</h1>
                <button
                    onClick={handleNewAppointment}
                    disabled={!selectedDate || !selectedTime}
                    className="px-4 py-2 bg-yellow-600 text-white rounded-md hover:bg-yellow-700 disabled:opacity-50 disabled:cursor-not-allowed font-medium transition-all"
                >
                    + Nova Consulta
                </button>
            </div>

            {/* Main Grid */}
            <div className="grid grid-cols-1 lg:grid-cols-12 gap-6">
                {/* Calendar */}
                <div className="lg:col-span-7">
                    <Card>
                        <div className="flex items-center gap-2 mb-3">
                            <svg className="w-5 h-5 text-gray-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path strokeLinecap="round" strokeLinejoin="round" strokeWidth={2} d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                            </svg>
                            <h3 className="font-semibold text-gray-900">Calendário</h3>
                        </div>
                        <p className="text-sm text-gray-600 mb-4">
                            Selecione uma data para ver as consultas
                        </p>

                        <Calendar
                            value={selectedDate}
                            onChange={handleDateChange}
                            markedDates={appointmentDates}
                            minDate={new Date()}
                        />
                    </Card>
                </div>

                {/* Available Times */}
                <div className="lg:col-span-5">
                    <Card>
                        <div className="flex items-center gap-2 mb-3">
                            <svg className="w-5 h-5 text-gray-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path strokeLinecap="round" strokeLinejoin="round" strokeWidth={2} d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            <h3 className="font-semibold text-gray-900">Horários Disponíveis</h3>
                        </div>
                        <p className="text-sm text-gray-600 mb-4">
                            {selectedDate.toLocaleDateString('pt-PT', {
                                day: '2-digit',
                                month: '2-digit',
                                year: 'numeric'
                            })}
                        </p>

                        {loading.slots ? (
                            <div className="text-center py-8 text-gray-500 text-sm">
                                A carregar horários...
                            </div>
                        ) : availableSlots.length === 0 ? (
                            <div className="text-center py-8 text-gray-500 text-sm">
                                Sem horários disponíveis
                            </div>
                        ) : (
                            <div className="grid grid-cols-2 gap-2">
                                {availableSlots.map((slot, index) => (
                                    <button
                                        key={index}
                                        onClick={() => slot.available && handleTimeSelect(slot.time)}
                                        disabled={!slot.available}
                                        className={`py-3 px-4 rounded-lg text-sm font-medium transition-all ${
                                            selectedTime === slot.time
                                                ? 'bg-yellow-600 text-white shadow-md'
                                                : slot.available
                                                    ? 'bg-yellow-600 text-white hover:bg-yellow-700 hover:shadow-md'
                                                    : 'bg-gray-100 text-gray-400 cursor-not-allowed'
                                        }`}
                                    >
                                        {slot.time}
                                    </button>
                                ))}
                            </div>
                        )}
                    </Card>
                </div>
            </div>

            {/* Upcoming Appointments */}
            <Card>
                <h3 className="font-semibold text-lg mb-1">Próximas Consultas</h3>
                <p className="text-sm text-gray-600 mb-4">
                    As suas consultas agendadas para os próximos dias
                </p>

                {loading.appointments ? (
                    <div className="text-center py-8 text-gray-500 text-sm">
                        A carregar consultas...
                    </div>
                ) : appointments.length === 0 ? (
                    <div className="text-center py-8 text-gray-500 text-sm">
                        Nenhuma consulta agendada
                    </div>
                ) : (
                    <div className="space-y-3">
                        {appointments.map((apt) => (
                            <AppointmentCard key={apt.id} appointment={apt} />
                        ))}
                    </div>
                )}
            </Card>
        </div>
    );
}

function AppointmentCard({ appointment }) {
    const statusConfig = {
        scheduled: { label: 'agendada', bg: 'bg-blue-600' },
        confirmed: { label: 'confirmada', bg: 'bg-yellow-600' },
        completed: { label: 'concluída', bg: 'bg-green-600' },
        cancelled: { label: 'cancelada', bg: 'bg-red-600' },
        pending: { label: 'pendente', bg: 'bg-orange-500' }
    };

    const config = statusConfig[appointment.status] || statusConfig.pending;

    const appointmentDate = new Date(appointment.appointment_date);
    const dateStr = appointmentDate.toLocaleDateString('pt-PT', {
        year: 'numeric',
        month: '2-digit',
        day: '2-digit'
    });
    const timeStr = appointmentDate.toLocaleTimeString('pt-PT', {
        hour: '2-digit',
        minute: '2-digit'
    });

    return (
        <div className="flex items-center gap-4 p-4 bg-gray-50 rounded-lg hover:bg-gray-100 transition-colors border border-gray-200">
            {/* Avatar */}
            <div className="w-12 h-12 rounded-full bg-yellow-100 flex items-center justify-center flex-shrink-0">
                <svg className="w-6 h-6 text-yellow-700" fill="currentColor" viewBox="0 0 20 20">
                    <path fillRule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clipRule="evenodd" />
                </svg>
            </div>

            {/* Info */}
            <div className="flex-1 min-w-0">
                <h4 className="font-semibold text-gray-900 truncate">
                    {appointment.patient_name}
                </h4>
                <p className="text-sm text-gray-600 truncate">
                    {appointment.type}
                </p>
            </div>

            {/* Date, Time and Status */}
            <div className="flex items-center gap-3 flex-shrink-0">
                <div className="text-right">
                    <div className="text-sm font-medium text-gray-900 whitespace-nowrap">
                        {dateStr} {timeStr}
                    </div>
                    <div className="text-xs text-gray-500">
                        {appointment.duration} min
                    </div>
                </div>

                <span className={`px-3 py-1 rounded-full text-xs font-medium text-white ${config.bg}`}>
                    {config.label}
                </span>
            </div>
        </div>
    );
}