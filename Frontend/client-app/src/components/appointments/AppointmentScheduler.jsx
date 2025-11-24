'use client';

import { useState, useEffect } from 'react';
import { useAuth } from '@/context/AuthContext';
import { useApi } from '@/hooks/useApi';
import Calendar from '@/components/ui/Calendar';

export default function AppointmentScheduler() {
    const { user, isAuthenticated } = useAuth();
    const { post, get, loading, error } = useApi();

    const [selectedDate, setSelectedDate] = useState(new Date());
    const [selectedTime, setSelectedTime] = useState('');
    const [availableSlots, setAvailableSlots] = useState([]);
    const [appointments, setAppointments] = useState([]);
    const [isSubmitting, setIsSubmitting] = useState(false);


    useEffect(() => {
        if (isAuthenticated) {
            loadUserAppointments();
        }
    }, [isAuthenticated]);


    useEffect(() => {
        if (selectedDate) {
            loadAvailableSlots();
        }
    }, [selectedDate]);

    const loadUserAppointments = async () => {
        try {
            const response = await get('/appointments');


            const userAppointments = Array.isArray(response) ? response :
                response?.data ? response.data :
                    response?.appointments ? response.appointments : [];

            setAppointments(userAppointments);

            const markedDates = userAppointments.map(apt => new Date(apt.appointment_date));

        } catch (err) {
            console.error('Erro ao carregar appointments:', err);
            // Set empty array as fallback
            setAppointments([]);
        }
    };

    const loadAvailableSlots = async () => {
        try {

            const slots = ['09:00', '10:00', '11:00', '14:00', '15:00', '16:00', '17:00'];
            setAvailableSlots(slots);
        } catch (err) {
            console.error('Erro ao carregar horários:', err);
        }
    };

    const handleDateSelect = (date) => {
        setSelectedDate(date);
        setSelectedTime('');
    };

    const handleTimeSelect = (time) => {
        setSelectedTime(time);
    };

    const handleSubmitAppointment = async () => {
        if (!selectedDate || !selectedTime) {
            alert('Por favor selecione uma data e horário');
            return;
        }

        try {
            setIsSubmitting(true);

            const appointmentData = {
                appointment_date: selectedDate.toISOString().split('T')[0],
                appointment_time: selectedTime,
                patient_id: user?.patient?.id,

                status: 'scheduled',
                type: 'consultation'
            };

            console.log('📤 Marcando appointment:', appointmentData);

            const newAppointment = await post('/appointments', appointmentData);

            console.log('✅ Appointment marcado:', newAppointment);


            setAppointments(prev => [...prev, newAppointment]);


            setSelectedTime('');

            alert('Consulta marcada com sucesso!');

        } catch (err) {
            console.error('Erro ao marcar consulta:', err);
            alert('Erro ao marcar consulta. Tente novamente.');
        } finally {
            setIsSubmitting(false);
        }
    };


    if (!isAuthenticated) {
        return (
            <div className="min-h-screen flex items-center justify-center">
                <div className="text-center">
                    <div className="animate-spin rounded-full h-12 w-12 border-b-2 border-blue-600 mx-auto mb-4"></div>
                    <p>A redirecionar para login...</p>
                </div>
            </div>
        );
    }

    return (
        <div className="min-h-screen bg-gray-50 py-8">
            <div className="max-w-6xl mx-auto px-4">
                {/* Header */}
                <div className="mb-8">
                    <h1 className="text-3xl font-bold text-gray-900">Marcar Consulta</h1>
                    <p className="text-gray-600 mt-2">
                        Olá <strong>{user?.name}</strong>, selecione uma data e horário para a sua consulta
                    </p>
                </div>

                <div className="grid grid-cols-1 lg:grid-cols-2 gap-8">
                    {/* Calendar Section */}
                    <div className="bg-white p-6 rounded-lg shadow-lg">
                        <h2 className="text-xl font-semibold mb-4">Selecionar Data</h2>
                        <Calendar
                            value={selectedDate}
                            onChange={handleDateSelect}
                            markedDates={Array.isArray(appointments) ? appointments.map(apt => new Date(apt.appointment_date)) : []}
                            minDate={new Date()}
                        />
                    </div>

                    {/* Time Selection & Details */}
                    <div className="bg-white p-6 rounded-lg shadow-lg">
                        <h2 className="text-xl font-semibold mb-4">Detalhes da Consulta</h2>

                        {selectedDate ? (
                            <div className="space-y-6">
                                {/* Selected Date Display */}
                                <div className="p-4 bg-blue-50 rounded-lg border border-blue-200">
                                    <p className="font-medium text-blue-900 mb-1">Data selecionada:</p>
                                    <p className="text-lg font-semibold">
                                        {selectedDate.toLocaleDateString('pt-PT', {
                                            weekday: 'long',
                                            year: 'numeric',
                                            month: 'long',
                                            day: 'numeric'
                                        })}
                                    </p>
                                </div>

                                {/* Time Selection */}
                                <div>
                                    <h3 className="font-semibold mb-3 text-gray-800">
                                        Horários Disponíveis {loading && '(a carregar...)'}
                                    </h3>
                                    <div className="grid grid-cols-2 gap-3">
                                        {availableSlots.map(time => (
                                            <button
                                                key={time}
                                                onClick={() => handleTimeSelect(time)}
                                                className={`p-3 border rounded-lg transition-all duration-200 ${
                                                    selectedTime === time
                                                        ? 'bg-blue-600 text-white border-blue-600 shadow-md'
                                                        : 'border-gray-300 hover:bg-blue-50 hover:border-blue-500 text-gray-700'
                                                }`}
                                            >
                                                {time}
                                            </button>
                                        ))}
                                    </div>

                                    {availableSlots.length === 0 && !loading && (
                                        <p className="text-gray-500 text-center py-4">
                                            Não há horários disponíveis para esta data.
                                        </p>
                                    )}
                                </div>

                                {/* Submit Button */}
                                <button
                                    onClick={handleSubmitAppointment}
                                    disabled={!selectedTime || isSubmitting || loading}
                                    className={`w-full py-3 rounded-lg font-semibold transition-colors ${
                                        selectedTime && !isSubmitting && !loading
                                            ? 'bg-green-600 text-white hover:bg-green-700 shadow-md'
                                            : 'bg-gray-400 text-gray-200 cursor-not-allowed'
                                    }`}
                                >
                                    {isSubmitting ? (
                                        <div className="flex items-center justify-center">
                                            <div className="animate-spin rounded-full h-4 w-4 border-b-2 border-white mr-2"></div>
                                            A marcar consulta...
                                        </div>
                                    ) : (
                                        'Confirmar Consulta'
                                    )}
                                </button>
                            </div>
                        ) : (
                            <p className="text-gray-500 text-center py-8">
                                Selecione uma data no calendário para ver os horários disponíveis.
                            </p>
                        )}
                    </div>
                </div>

                {/* User Info & Existing Appointments */}
                <div className="grid grid-cols-1 lg:grid-cols-2 gap-8 mt-8">
                    {/* User Information */}
                    {user?.patient && (
                        <div className="bg-white p-6 rounded-lg shadow-lg">
                            <h3 className="text-lg font-semibold mb-4 text-gray-800">Suas Informações</h3>
                            <div className="space-y-3">
                                <div className="flex justify-between border-b pb-2">
                                    <span className="font-medium">Nome:</span>
                                    <span>{user.name} {user.surname}</span>
                                </div>
                                <div className="flex justify-between border-b pb-2">
                                    <span className="font-medium">Email:</span>
                                    <span>{user.email}</span>
                                </div>
                                <div className="flex justify-between border-b pb-2">
                                    <span className="font-medium">Telefone:</span>
                                    <span>{user.patient.phone_number}</span>
                                </div>
                                {user.patient.age && (
                                    <div className="flex justify-between border-b pb-2">
                                        <span className="font-medium">Idade:</span>
                                        <span>{user.patient.age} anos</span>
                                    </div>
                                )}
                            </div>
                        </div>
                    )}

                    {/* Existing Appointments */}
                    <div className="bg-white p-6 rounded-lg shadow-lg">
                        <h3 className="text-lg font-semibold mb-4 text-gray-800">Suas Consultas</h3>
                        {appointments.length > 0 ? (
                            <div className="space-y-3">
                                {appointments.slice(0, 3).map(appointment => (
                                    <div key={appointment.id} className="border-l-4 border-blue-500 pl-4 py-2">
                                        <p className="font-medium">
                                            {new Date(appointment.appointment_date).toLocaleDateString('pt-PT')}
                                        </p>
                                        <p className="text-sm text-gray-600">
                                            {appointment.appointment_time} • {appointment.status}
                                        </p>
                                    </div>
                                ))}
                                {appointments.length > 3 && (
                                    <p className="text-sm text-gray-500 text-center">
                                        +{appointments.length - 3} mais consultas
                                    </p>
                                )}
                            </div>
                        ) : (
                            <p className="text-gray-500 text-center py-4">
                                Ainda não tem consultas marcadas.
                            </p>
                        )}
                    </div>
                </div>

                {/* Error Display */}
                {error && (
                    <div className="mt-6 p-4 bg-red-50 border border-red-200 rounded-lg">
                        <div className="flex items-center">
                            <div className="flex-shrink-0">
                                <svg className="h-5 w-5 text-red-400" viewBox="0 0 20 20" fill="currentColor">
                                    <path fillRule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.28 7.22a.75.75 0 00-1.06 1.06L8.94 10l-1.72 1.72a.75.75 0 101.06 1.06L10 11.06l1.72 1.72a.75.75 0 101.06-1.06L11.06 10l1.72-1.72a.75.75 0 00-1.06-1.06L10 8.94 8.28 7.22z" clipRule="evenodd" />
                                </svg>
                            </div>
                            <div className="ml-3">
                                <h3 className="text-sm font-medium text-red-800">Erro</h3>
                                <div className="mt-1 text-sm text-red-700">{error}</div>
                            </div>
                        </div>
                    </div>
                )}
            </div>
        </div>
    );
}