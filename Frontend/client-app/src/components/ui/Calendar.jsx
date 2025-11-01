'use client'

import { useState } from "react";

export default function Calendar({ value, onChange, markedDates = [], minDate = null, maxDate = null }) {
    const [currentMonth, setCurrentMonth] = useState(value || new Date());

    // calcular dias do mes
    const getDaysInMonth = (date) => {
        return new Date(date.getFullYear(), date.getMonth() + 1, 0).getDate();
    };

    const getFirstDayOfMonth = (date) => {
        return new Date(date.getFullYear(), date.getMonth(), 1).getDay();
    };

    const getMonthYear = (date) => {
        return date.toLocaleDateString('en-US', { month: 'long', year: 'numeric' });
    };

    // verificar se é o mesmo dia
    const isSameDay = (date1, date2) => {
        if (!date1 || !date2) return false;
        return date1.getDate() === date2.getDate() &&
            date1.getMonth() === date2.getMonth() &&
            date1.getFullYear() === date2.getFullYear();
    };

    const isToday = (date) => {
        return isSameDay(date, new Date());
    };

    const isMarked = (date) => {
        return markedDates.some(markedDate => isSameDay(date, markedDate));
    };

    const isDisabled = (date) => {
        if (minDate && date < minDate) return true;
        if (maxDate && date > maxDate) return true;
        return false;
    };

    // salto entre meses
    const goToPreviousMonth = () => {
        setCurrentMonth(new Date(currentMonth.getFullYear(), currentMonth.getMonth() - 1));
    };

    const goToNextMonth = () => {
        setCurrentMonth(new Date(currentMonth.getFullYear(), currentMonth.getMonth() + 1));
    };

    // array dos dias
    const buildCalendarDays = () => {
        const daysInMonth = getDaysInMonth(currentMonth);
        const firstDay = getFirstDayOfMonth(currentMonth);
        const days = [];

        // dias do mes anterior
        const prevMonth = new Date(currentMonth.getFullYear(), currentMonth.getMonth() - 1);
        const daysInPrevMonth = getDaysInMonth(prevMonth);

        for (let i = firstDay - 1; i >= 0; i--) {
            days.push({
                day: daysInPrevMonth - i,
                isCurrentMonth: false,
                date: new Date(prevMonth.getFullYear(), prevMonth.getMonth(), daysInPrevMonth - i)
            });
        }

        // dias do mes atual
        for (let day = 1; day <= daysInMonth; day++) {
            days.push({
                day: day,
                isCurrentMonth: true,
                date: new Date(currentMonth.getFullYear(), currentMonth.getMonth(), day)
            });
        }

        // completar com dias do proximo mes
        const totalCells = 42;
        const remainingDays = totalCells - days.length;
        const nextMonth = new Date(currentMonth.getFullYear(), currentMonth.getMonth() + 1);

        for (let day = 1; day <= remainingDays; day++) {
            days.push({
                day: day,
                isCurrentMonth: false,
                date: new Date(nextMonth.getFullYear(), nextMonth.getMonth(), day)
            });
        }

        return days;
    };

    const calendarDays = buildCalendarDays();
    const weekDays = ['Sun', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat'];

    return (
        <div className="w-full max-w-md">
            {/* header do calendario */}
            <div className="flex items-center justify-between mb-3 px-2">
                <button onClick={goToPreviousMonth} className="p-1 hover:bg-gray-100 rounded transition-colors">
                    <svg className="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path strokeLinecap="round" strokeLinejoin="round" strokeWidth={2} d="M15 19l-7-7 7-7" />
                    </svg>
                </button>

                <h3 className="font-semibold text-base">{getMonthYear(currentMonth)}</h3>

                <button onClick={goToNextMonth} className="p-1 hover:bg-gray-100 rounded transition-colors">
                    <svg className="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path strokeLinecap="round" strokeLinejoin="round" strokeWidth={2} d="M9 5l7 7-7 7" />
                    </svg>
                </button>
            </div>

            {/* dias da semana */}
            <div className="grid grid-cols-7 gap-1 mb-1">
                {weekDays.map((day) => (
                    <div key={day} className="text-center text-xs font-medium text-gray-500 py-1">
                        {day.substring(0, 2)}
                    </div>
                ))}
            </div>

            {/* grid de dias */}
            <div className="grid grid-cols-7 gap-1">
                {calendarDays.map((dayObj, index) => {
                    const selected = value && isSameDay(dayObj.date, value);
                    const today = isToday(dayObj.date);
                    const marked = isMarked(dayObj.date);
                    const disabled = isDisabled(dayObj.date);

                    let classes = "relative aspect-square p-0 rounded-lg text-sm font-normal transition-all flex items-center justify-center ";

                    if (!dayObj.isCurrentMonth) {
                        classes += "text-gray-300 ";
                    } else if (disabled) {
                        classes += "text-gray-400 cursor-not-allowed opacity-50 ";
                    } else {
                        classes += "text-gray-900 hover:bg-gray-100 cursor-pointer ";
                    }

                    if (selected) {
                        classes += "bg-yellow-600 text-white hover:bg-yellow-700 font-semibold ";
                    }

                    if (today && !selected) {
                        classes += "bg-yellow-100 font-semibold ";
                    }

                    return (
                        <button
                            key={index}
                            onClick={() => !disabled && onChange(dayObj.date)}
                            disabled={disabled}
                            className={classes}
                        >
                            {dayObj.day}

                            {marked && dayObj.isCurrentMonth && !selected && (
                                <span className="absolute bottom-0.5 left-1/2 -translate-x-1/2 w-1 h-1 bg-yellow-600 rounded-full" />
                            )}
                        </button>
                    );
                })}
            </div>
        </div>
    );
}