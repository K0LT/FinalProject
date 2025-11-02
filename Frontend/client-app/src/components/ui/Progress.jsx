"use client";
import React from "react";
import { cn } from "./Button";

export function Progress({ className, value=0, ...p }) {
    return (
        <div
            data-slot="progress"
            className={cn("bg-primary/20 relative h-2 w-full overflow-hidden rounded-full", className)}
            {...p}
        >
            <div
                data-slot="progress-indicator"
                className="bg-primary h-full transition-all"
                style={{ width: `${Math.max(0, Math.min(100, value))}%` }}
            />
        </div>
    );
}
