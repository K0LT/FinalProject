'use client';

import { AuthGuard} from "@/components/Auth/AuthGuard";

import Treatments from "@/components/treatments/Treatments";

export default function AppointmentsPage() {
    return (
        <AuthGuard>
            <Treatments />;
        </AuthGuard>
    );
}