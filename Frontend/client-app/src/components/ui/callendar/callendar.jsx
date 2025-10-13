'use client';


import { useState } from 'react';
import styles from "./callendar.css";

export default function Calendar() {
    const [currentDate, setCurrentDate] = useState(new Date());


    const year = currentDate.getFullYear();
    const month = currentDate.getMonth();


    const firstDayOfMonth = new Date(year, month, 1);
    const lastDayOfMonth = new Date(year, month + 1, 0);
    const daysInMonth = lastDayOfMonth.getDate();
    const startingDayOfWeek = firstDayOfMonth.getDay();


    const monthNames = [
        'Janeiro', 'Fevereiro', 'Março', 'Abril', 'Maio', 'Junho',
        'Julho', 'Agosto', 'Setembro', 'Outubro', 'Novembro', 'Dezembro'
    ];
    const dayNames = ['Dom', 'Seg', 'Ter', 'Qua', 'Qui', 'Sex', 'Sáb'];


    const previousMonth = () => {
        setCurrentDate(new Date(year, month - 1, 1));
    };

    const nextMonth = () => {
        setCurrentDate(new Date(year, month + 1, 1));
    };

    // Criar array de dias
    const days = [];

    // Adicionar espaços vazios antes do primeiro dia
    for (let i = 0; i < startingDayOfWeek; i++) {
        days.push(<div key={`empty-${i}`} className={styles.emptyDay}></div>);
    }

    // Adicionar os dias do mês
    for (let day = 1; day <= daysInMonth; day++) {
        const isToday =
            day === new Date().getDate() &&
            month === new Date().getMonth() &&
            year === new Date().getFullYear();

        days.push(
            <div
                key={day}
                className={`${styles.day} ${isToday ? styles.today : ''}`}
            >
                {day}
            </div>
        );
    }

    return (
        <div className={styles.calendar}>
            <div className={styles.header}>
                <button onClick={previousMonth} className={styles.navButton}>
                    ◀
                </button>
                <h2 className={styles.monthYear}>
                    {monthNames[month]} {year}
                </h2>
                <button onClick={nextMonth} className={styles.navButton}>
                    ▶
                </button>
            </div>

            <div className={styles.daysOfWeek}>
                {dayNames.map(day => (
                    <div key={day} className={styles.dayName}>
                        {day}
                    </div>
                ))}
            </div>

            <div className={styles.daysGrid}>
                {days}
            </div>
        </div>
    );
}