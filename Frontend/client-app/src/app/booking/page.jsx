"use client";

import React from "react";
import BookingHeader from "@/components/booking/BookingHeader";
import ConsultationTypeCard from "@/components/booking/ConsultationTypeCard";
import DateCard from "@/components/booking/DateCard";
import TimeCard from "@/components/booking/TimeCard";
import PatientDataCard from "@/components/booking/PatientDataCard";
import SummaryCard from "@/components/booking/SummaryCard";
import DoctorCard from "@/components/booking/DoctorCard";
import ExpectationsCard from "@/components/booking/ExpectationsCard";
import ContactsCard from "@/components/booking/ContactsCard";

export default function BookingPage() {
    return (
        <div className="container mx-auto px-4 py-8">
            <div className="mx-auto max-w-4xl">
                <BookingHeader />

                <div className="grid grid-cols-1 gap-8 lg:grid-cols-3">
                    <div className="space-y-8 lg:col-span-2">
                        <ConsultationTypeCard />
                        <DateCard />
                        <TimeCard />
                        <PatientDataCard />
                    </div>

                    <div className="space-y-6">
                        <SummaryCard />
                        <DoctorCard />
                        <ExpectationsCard />
                        <ContactsCard />
                    </div>
                </div>
            </div>
        </div>
    );
}
