'use client'

import {PatientProfilePage} from "@/components/patient/PatientProfilePage";
import ClientDashLayout from "@/components/clientDashboard/ClientDashLayout";
import { AuthGuard } from "@/components/Auth/AuthGuard";

export default function Page({params}){
    return (
        <AuthGuard requireAuth={true}>
            <ClientDashLayout>
                <PatientProfilePage params={params}/>
            </ClientDashLayout>
        </AuthGuard>
    );
}

