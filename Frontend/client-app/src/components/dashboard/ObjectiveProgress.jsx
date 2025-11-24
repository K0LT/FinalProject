"use client";

import React from "react";

export default function ObjectiveProgress({ titulo, progresso, meta }) {
    return (
        <div className="mb-4">
            <div className="flex items-center justify-between mb-1.5">
        <span className="text-sm font-medium text-gray-900 truncate">
          {titulo}
        </span>
                <span className="text-xs sm:text-sm font-semibold text-[#b8860b]">
          {progresso}%
        </span>
            </div>
            <div className="h-2 bg-gray-200 rounded-full overflow-hidden">
                <div
                    className="h-full bg-gradient-to-r from-[#b8860b] to-[#f1c04b] transition-all duration-500"
                    style={{ width: `${progresso}%` }}
                />
            </div>
            <p className="text-[11px] sm:text-xs text-gray-600 mt-1">
                Meta: {meta}
            </p>
        </div>
    );
}
