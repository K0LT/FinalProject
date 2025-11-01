'use client'

import { useState } from "react";

/**
 * Reusable Calendar Component
 *
 * @param {Date} value - Currently selected date
 * @param {Function} onChange - Callback when date is selected
 * @param {Date[]} markedDates - Optional: Array of dates to mark (e.g., appointments)
 * @param {Date} minDate - Optional: Minimum selectable date
 * @param {Date} maxDate - Optional: Maximum selectable date
 */
export default function Calendar({
                                     value,
                                     onChange,
                                     markedDates = [],
                                     minDate = null,
                                     maxDate = null
                                 }) {
    const [currentMonth, setCurrentMonth] = useState(value || new Date());

    // ============================================
    // DATE HELPER FUNCTIONS
    // ============================================

    const getDaysInMonth = (date) => {
        return new Date(date.getFullYear(), date.getMonth() + 1, 0).getDate();
    };

    const getFirstDayOfMonth = (date) => {
        return new Date(date.getFullYear(), date.getMonth(), 1).getDay();
    };

    const getMonthYear = (date) => {
        return date.toLocaleDateString('en-US', { month: 'long', year: 'numeric' });
    };

    const isSameDay = (date1, date2) => {
        if (!date1 || !date2) return false;
        return (
            date1.getDate() === date2.getDate() &&
            date1.getMonth() === date2.getMonth() &&
            date1.getFullYear() === date2.getFullYear()
        );
    };

    const isToday = (date) => {
        return isSameDay(date, new Date());
    };

    const isMarked = (date) => {
        return markedDates.some(markedDate => isSameDay(date, markedDate));
    };

    const isDisabled = (date) => {
        if (minDate && date < minDate) return true;
        return maxDate && date > maxDate; // simplified if statement
    };

    // ============================================
    // NAVIGATION
    // ============================================

    const goToPreviousMonth = () => {
        setCurrentMonth(new Date(currentMonth.getFullYear(), currentMonth.getMonth() - 1));
    };

    const goToNextMonth = () => {
        setCurrentMonth(new Date(currentMonth.getFullYear(), currentMonth.getMonth() + 1));
    };

    // ============================================
    // BUILD CALENDAR DAYS
    // ============================================

    const buildCalendarDays = () => {
        const daysInMonth = getDaysInMonth(currentMonth);
        const firstDay = getFirstDayOfMonth(currentMonth);
        const days = [];

        // Previous month days
        const prevMonth = new Date(currentMonth.getFullYear(), currentMonth.getMonth() - 1);
        const daysInPrevMonth = getDaysInMonth(prevMonth);

        for (let i = firstDay - 1; i >= 0; i--) {
            days.push({
                day: daysInPrevMonth - i,
                isCurrentMonth: false,
                date: new Date(prevMonth.getFullYear(), prevMonth.getMonth(), daysInPrevMonth - i)
            });
        }

        // Current month days
        for (let day = 1; day <= daysInMonth; day++) {
            days.push({
                day: day,
                isCurrentMonth: true,
                date: new Date(currentMonth.getFullYear(), currentMonth.getMonth(), day)
            });
        }

        // Next month days
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

    // ============================================
    // RENDER
    // ============================================

    return (
        <div className="w-full">
            {/* Header */}
            <div className="flex items-center justify-between mb-4">
                <button
                    onClick={goToPreviousMonth}
                    className="p-2 hover:bg-gray-100 rounded-lg transition-colors"
                    aria-label="Previous month"
                >
                    <svg className="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path strokeLinecap="round" strokeLinejoin="round" strokeWidth={2} d="M15 19l-7-7 7-7" />
                    </svg>
                </button>

                <h3 className="font-semibold text-lg">
                    {getMonthYear(currentMonth)}
                </h3>

                <button
                    onClick={goToNextMonth}
                    className="p-2 hover:bg-gray-100 rounded-lg transition-colors"
                    aria-label="Next month"
                >
                    <svg className="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path strokeLinecap="round" strokeLinejoin="round" strokeWidth={2} d="M9 5l7 7-7 7" />
                    </svg>
                </button>
            </div>

            {/* Week days */}
            <div className="grid grid-cols-7 gap-2 mb-2">
                {weekDays.map((day) => (
                    <div key={day} className="text-center text-sm font-medium text-gray-600 py-2">
                        {day}
                    </div>
                ))}
            </div>

            {/* Days grid */}
            <div className="grid grid-cols-7 gap-2">
                {calendarDays.map((dayObj, index) => {
                    const isSelected = value && isSameDay(dayObj.date, value);
                    const isTodayDate = isToday(dayObj.date);
                    const isMarkedDate = isMarked(dayObj.date);
                    const isDisabledDate = isDisabled(dayObj.date);

                    return (
                        <button
                            key={index}
                            onClick={() => !isDisabledDate && onChange(dayObj.date)}
                            disabled={isDisabledDate}
                            className={`
                                relative aspect-square p-2 rounded-lg text-sm font-medium
                                transition-all
                                ${!dayObj.isCurrentMonth
                                ? 'text-gray-300'
                                : isDisabledDate
                                    ? 'text-gray-400 cursor-not-allowed opacity-50'
                                    : 'text-gray-900 hover:bg-gray-100 cursor-pointer'
                            }
                                ${isSelected
                                ? 'bg-yellow-500 text-white hover:bg-yellow-600'
                                : ''
                            }
                                ${isTodayDate && !isSelected
                                ? 'bg-yellow-100 font-bold'
                                : ''
                            }
                            `}
                        >
                            {dayObj.day}

                            {/* Dot indicator for marked dates */}
                            {isMarkedDate && dayObj.isCurrentMonth && (
                                <span className="absolute bottom-1 left-1/2 -translate-x-1/2 w-1 h-1 bg-yellow-500 rounded-full" />
                            )}
                        </button>
                    );
                })}
            </div>
        </div>
    );
}