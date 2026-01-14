'use client';

import DiagnosesPage from "@/components/diagnoses/DiagnosesPage";
import ClientDashLayout from "@/components/clientDashboard/ClientDashLayout";
import { AuthGuard } from "@/components/Auth/AuthGuard";

export default function Page(){
    return (
        <AuthGuard requireAuth={true}>
            <ClientDashLayout>
                <DiagnosesPage />
            </ClientDashLayout>
        </AuthGuard>
    );
}