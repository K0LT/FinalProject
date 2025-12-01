"use client";

import React from "react";

export default function StatCard({ title, value, subtitle, icon: Icon }) {
    return (
        <div className="rounded-xl border border-gray-200 bg-white p-4 shadow-sm">
            <div className="flex items-start justify-between gap-3">
                <div className="flex-1 min-w-0">
                    <p className="text-xs font-semibold uppercase tracking-wide text-gray-500">
                        {title}
                    </p>
                    <p className="mt-1 text-2xl font-bold text-gray-900">{value}</p>
                    {subtitle && (
                        <p className="mt-1 text-xs text-gray-500">{subtitle}</p>
                    )}
                </div>
                <div className="inline-flex h-9 w-9 items-center justify-center rounded-lg bg-amber-50 text-amber-700">
                    <Icon className="h-4 w-4" />
                </div>
            </div>
        </div>
    );
}
