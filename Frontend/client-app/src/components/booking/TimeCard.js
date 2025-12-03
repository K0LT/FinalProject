import React from "react";
import CardBooking from "./CardBooking";
import { ClockIcon } from "./icons";

const timeSlots = [
    "09:00",
    "10:00",
    "11:00",
    "14:00",
    "15:00",
    "16:00",
    "17:00",
    "18:00",
];

export default function TimeCard() {
    return (
        <CardBooking
            title={
                <>
                    <ClockIcon className="h-5 w-5" />
                    3. Escolha a Hora
                </>
            }
            description="Horários disponíveis para 14/11/2025"
        >
            <div className="grid grid-cols-2 gap-3 md:grid-cols-4">
                {timeSlots.map((slot) => (
                    <button
                        key={slot}
                        type="button"
                        data-slot="button"
                        className="inline-flex h-9 items-center justify-center gap-2 whitespace-nowrap rounded-md border bg-background px-4 py-2 text-sm font-medium text-foreground transition-all hover:bg-accent hover:text-accent-foreground"
                    >
                        {slot}
                    </button>
                ))}
            </div>
        </CardBooking>
    );
}
