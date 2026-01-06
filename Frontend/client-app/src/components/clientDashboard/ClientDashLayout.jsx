"use client";

import React, { useState } from "react";
import Sidebar from "@/components/clientDashboard/Sidebar";
import Topbar from "@/components/clientDashboard/Topbar";
import Footer from "@/components/clientDashboard/Footer";

export default function ClientDashLayout({ children, userId = "default-user" }) {
    const [sidebarOpen, setSidebarOpen] = useState(false);
    const [currentPath, setCurrentPath] = useState("/clientDashboard");

    return (
        <div className="min-h-screen bg-secondary text-foreground flex">
            <Sidebar
                isOpen={sidebarOpen}
                onClose={() => setSidebarOpen(false)}
                currentPath={currentPath}
                onNavigate={setCurrentPath}
                userId={userId}
            />

            <div className="flex-1 flex flex-col min-w-0">
                <Topbar
                    onMenuClick={() => setSidebarOpen(true)}
                    userName="Márcia Leite" //TODO: Ligar nome a BD
                />

                <main className="flex-1 overflow-y-auto bg-background">
                    <div className="max-w-7xl mx-auto p-4 sm:p-6 lg:p-8">
                        {children}
                    </div>
                </main>

                <Footer />
            </div>
        </div>
    );
}
