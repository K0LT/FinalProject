'use client'

import { useState } from "react";
import Callendar from '@components/ui/callendar/callendar';
import styles from './appointments.module.css'; // Vamos criar este ficheiro

export default function AppointmentsPage() {
    const [appointments, setAppointments] = useState([
        // Exemplo de estrutura de dados
        // { id: 1, date: '2024-01-15', title: 'Reunião', time: '10:00' }
    ]);

    const [selectedDate, setSelectedDate] = useState(null);

    const addAppointment = (appointment) => {
        setAppointments([...appointments, {
            ...appointment,
            id: Date.now()
        }]);
    };



    const removeAppointment = (id) => {
        setAppointments(appointments.filter(apt => apt.id !== id));
    };


    const getAppointmentsForDate = (date) => {
        return appointments.filter(apt => apt.date === date);
    };

    return (
        <main className={styles.container}>
            <div className={styles.header}>
                <h1>Meu Calendário de Compromissos</h1>
            </div>

            <div className={styles.content}>
                <div className={styles.calendarSection}>
                    <Callendar
                        appointments={appointments}
                        onDateSelect={setSelectedDate}
                        selectedDate={selectedDate}
                    />
                </div>

                <div className={styles.appointmentsSection}>
                    <h2>
                        {selectedDate
                            ? `Compromissos para ${selectedDate}`
                            : 'Selecione uma data'}
                    </h2>

                    {selectedDate && (
                        <>
                            <AppointmentForm
                                onAdd={addAppointment}
                                selectedDate={selectedDate}
                            />

                            <AppointmentsList
                                appointments={getAppointmentsForDate(selectedDate)}
                                onRemove={removeAppointment}
                            />
                        </>
                    )}
                </div>
            </div>
        </main>
    );
}


function AppointmentForm({ onAdd, selectedDate }) {
    const [title, setTitle] = useState('');
    const [time, setTime] = useState('');
    const [description, setDescription] = useState('');

    const handleSubmit = (e) => {
        e.preventDefault();

        if (!title || !time) {
            alert('Por favor, preenche todos os campos obrigatórios');
            return;
        }

        onAdd({
            date: selectedDate,
            title,
            time,
            description
        });

        // Limpar formulário
        setTitle('');
        setTime('');
        setDescription('');
    };

    return (
        <form onSubmit={handleSubmit} className={styles.form}>
            <input
                type="text"
                placeholder="Título do compromisso"
                value={title}
                onChange={(e) => setTitle(e.target.value)}
                required
            />

            <input
                type="time"
                value={time}
                onChange={(e) => setTime(e.target.value)}
                required
            />

            <textarea
                placeholder="Descrição (opcional)"
                value={description}
                onChange={(e) => setDescription(e.target.value)}
                rows="3"
            />

            <button type="submit">Adicionar Compromisso</button>
        </form>
    );
}

// Componente para listar compromissos
function AppointmentsList({ appointments, onRemove }) {
    if (appointments.length === 0) {
        return <p className={styles.noAppointments}>Nenhum compromisso para este dia</p>;
    }

    return (
        <div className={styles.appointmentsList}>
            {appointments.map(apt => (
                <div key={apt.id} className={styles.appointmentItem}>
                    <div className={styles.appointmentTime}>{apt.time}</div>
                    <div className={styles.appointmentDetails}>
                        <h3>{apt.title}</h3>
                        {apt.description && <p>{apt.description}</p>}
                    </div>
                    <button
                        onClick={() => onRemove(apt.id)}
                        className={styles.removeButton}
                    >
                        ✕
                    </button>
                </div>
            ))}
        </div>
    );
}