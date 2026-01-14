'use client';

import { AuthGuard } from "@/components/Auth/AuthGuard";
import AppointmentScheduler from "@/components/appointments/AppointmentScheduler";
import ClientDashLayout from "@/components/clientDashboard/ClientDashLayout";

export default function AppointmentsPage({params}) {
    return (
        <AuthGuard requireAuth={true}>
            <ClientDashLayout>
                <AppointmentScheduler params={params}/>
            </ClientDashLayout>
        </AuthGuard>
    );
}
