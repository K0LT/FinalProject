"use client";

import React from "react";
import { Calendar, Menu } from "lucide-react";

export default function Topbar({ onMenuClick, userName }) {
    const today = new Date().toLocaleDateString("pt-PT", {
        weekday: "long",
        day: "numeric",
        month: "long",
        year: "numeric",
    });

    return (
        <header className="h-16 bg-white border-b border-gray-200 flex items-center px-4 sm:px-6 justify-between">
            <div className="flex items-center gap-3">
                <button
                    onClick={onMenuClick}
                    className="lg:hidden p-2 rounded-lg hover:bg-gray-100"
                >
                    <Menu className="w-5 h-5" />
                </button>
                <div className="hidden sm:flex items-center gap-2 text-sm text-gray-600">
                    <Calendar className="w-4 h-4" />
                    <span className="capitalize">{today}</span>
                </div>
            </div>

            <div className="flex items-center gap-3">
                <div className="text-right hidden sm:block">
                    <div className="text-sm font-medium text-gray-900">{userName}</div>
                </div>
            </div>
        </header>
    );
}
