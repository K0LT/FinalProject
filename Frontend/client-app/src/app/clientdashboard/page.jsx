"use client";

import React from "react";
import ClientDashboard from "@/components/clientDashboard/ClientDashboard";
import ClientDashLayout from "@/components/clientDashboard/ClientDashLayout";
import { AuthGuard } from "@/components/Auth/AuthGuard";
import { RoleGuard } from "@/components/Auth/RoleGuard";
import { ROLES } from "@/lib/roleHelpers";

export default function ClientDashboardPage() {
    return (
        <AuthGuard requireAuth={true}>
            <RoleGuard allowedRoles={[ROLES.PATIENT]}>
                <ClientDashLayout>
                    <ClientDashboard />
                </ClientDashLayout>
            </RoleGuard>
        </AuthGuard>
    );
}
/*
* //TODO: Lógicas matemáticas relativas ao peso, à soma do peso para calculos de progresso.
*         Todos os Links de navegação devem estar a ir para a página correta
*         Todos os labels personalizados (nomes, pesos, etc) devem estar a renderizar corretamente
* */

