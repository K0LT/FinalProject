'use client';

import { AuthGuard} from "@/components/Auth/AuthGuard";

import Weight from "@/components/weight/Weight";

export default function AppointmentsPage() {
    return (
        <AuthGuard>
            <Weight />;
        </AuthGuard>
    );
}