import React from "react";
import Header from "@/components/login/Header";

export default function RegistrationLayout({ children }) {
    return (
        <div className="min-h-screen bg-gradient-to-br from-red-50 via-white to-orange-50">
            <Header />

                <div className="max-w-6xl mx-auto space-y-8">
                    {children}
                </div>

        </div>
    );
}
