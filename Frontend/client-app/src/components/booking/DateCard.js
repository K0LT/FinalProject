'use client'

import React, { useState } from "react";
import CardBooking from "./CardBooking";
import { CalendarIcon } from "./icons";
import Calendar from "@/components/ui/Calendar";

export default function DateCard() {
    const [data, setData] = useState(new Date());

    return (
        <CardBooking
            title={
                <>
                    <CalendarIcon className="h-5 w-5" />
                    2. Escolha a Data
                </>
            }
            description="Selecione a data preferida para a sua consulta"
        >
            <div className="rdp w-full rounded-md border p-3">
                <Calendar
                    value={data}
                    onChange={setData}
                    markedDates={[]}
                    minDate={new Date()}
                />
            </div>
        </CardBooking>
    );
}
