'use client';

import { AuthGuard} from "@/components/Auth/AuthGuard";

import ReportsPage from "@/components/reports/ReportsPage";

export default function AppointmentsPage() {
    return (
        <AuthGuard>
            <ReportsPage />;
        </AuthGuard>
    );
}