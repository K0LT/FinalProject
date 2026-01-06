import React from "react";
import Header from "@/components/booking/Header";

export default function BookingLayout({ children }) {
    return (
        <div className="min-h-screen bg-white">
            <Header />

            <div className="max-w-4xl mx-auto mt-6 px-4">
                {children}
            </div>
        </div>
    );
}
