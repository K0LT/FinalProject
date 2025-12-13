"use client";

import React from "react";
import ClientDashboard from "@/components/clientDashboard/ClientDashboard";
import ClientDashLayout from "@/components/clientDashboard/ClientDashLayout";
export default function ClientDashboardPage() {
    return <ClientDashLayout>
                <ClientDashboard />;
            </ClientDashLayout>
}
/*
* //TODO: Lógicas matemáticas relativas ao peso, à soma do peso para calculos de progresso.
*         Todos os Links de navegação devem estar a ir para a página correta
*         Todos os labels personalizados (nomes, pesos, etc) devem estar a renderizar corretamente
* */

