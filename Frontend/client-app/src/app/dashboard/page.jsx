'use client';

import Dashboard from "@/components/dashboard/Dashboard";
import DashboardSidebarLayout from "@/components/dashboard/DashboardLayout";
import { AuthGuard } from "@/components/Auth/AuthGuard";
import { RoleGuard } from "@/components/Auth/RoleGuard";
import { ROLES } from "@/lib/roleHelpers";

export default function DashboardPage() {
    return (
        <AuthGuard requireAuth={true}>
            <RoleGuard allowedRoles={[ROLES.ADMIN, ROLES.FUNCIONARIO]}>
                <DashboardSidebarLayout>
                    <Dashboard />
                </DashboardSidebarLayout>
            </RoleGuard>
        </AuthGuard>
    );
}
