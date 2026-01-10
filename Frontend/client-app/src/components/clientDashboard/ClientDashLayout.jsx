"use client";

import React, { useState, useEffect } from "react";
import Sidebar from "@/components/clientDashboard/Sidebar";
import Topbar from "@/components/clientDashboard/Topbar";
import Footer from "@/components/clientDashboard/Footer";
import { useAuth } from "@/context/AuthContext";
import { getUserPatient } from "@/services/userServices";

export default function ClientDashLayout({ children }) {
    const { user } = useAuth();
    const [sidebarOpen, setSidebarOpen] = useState(false);
    const [currentPath, setCurrentPath] = useState("/clientDashboard");
    const [patientId, setPatientId] = useState('');

    // Build user's full name from auth context
    const userName = user ? `${user.name || ''} ${user.surname || ''}`.trim() : 'Utilizador';

    // Fetch patient data to get patient ID for sidebar navigation
    useEffect(() => {
        const fetchPatient = async () => {
            try {
                const patient = await getUserPatient();
                if (patient?.id) {
                    setPatientId(patient.id);
                }
            } catch (error) {
                console.error('Error fetching patient:', error);
            }
        };

        if (user) {
            fetchPatient();
        }
    }, [user]);

    return (
        <div className="min-h-screen bg-secondary text-foreground flex">
            <Sidebar
                isOpen={sidebarOpen}
                onClose={() => setSidebarOpen(false)}
                currentPath={currentPath}
                onNavigate={setCurrentPath}
                userId={patientId}
            />

            <div className="flex-1 flex flex-col min-w-0">
                <Topbar
                    onMenuClick={() => setSidebarOpen(true)}
                    userName={userName}
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
