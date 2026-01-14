'use client';

import DiagnosesPage from "@/components/diagnoses/DiagnosesPage";
import ClientDashLayout from "@/components/clientDashboard/ClientDashLayout";
import { AuthGuard } from "@/components/Auth/AuthGuard";

export default function Page({params}){
    return (
        <AuthGuard requireAuth={true}>
            <ClientDashLayout>
                <DiagnosesPage params={params}/>
            </ClientDashLayout>
        </AuthGuard>
    );
}