"use client";

import React from "react";

export default function ObjectiveProgress({ titulo, progresso, meta }) {
    return (
        <div className="space-y-1">
            <div className="flex items-center justify-between text-xs">
                <span className="font-medium text-gray-800">{titulo}</span>
                <span className="rounded-md bg-amber-50 px-2 py-0.5 text-[11px] font-semibold text-amber-800">
          {progresso}%
        </span>
            </div>
            <div className="h-2 rounded-full bg-gray-100">
                <div
                    className="h-2 rounded-full bg-amber-500"
                    style={{ width: `${progresso}%` }}
                />
            </div>
            <p className="text-[11px] text-gray-500">{meta}</p>
        </div>
    );
}
