'use client';

import { AuthGuard} from "@/components/Auth/AuthGuard";

import AppointmentScheduler from "@/components/appointments/AppointmentScheduler";

export default function AppointmentsPage() {
    return (
        <AuthGuard>
            <AppointmentScheduler />;
        </AuthGuard>
    );
}