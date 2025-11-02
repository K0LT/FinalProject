"use client";
import React from "react";
import { cn } from "./Button";

export function Separator({ className, orientation="horizontal", ...p }) {
    return (
        <div
            role="separator"
            data-orientation={orientation}
            className={cn(
                "bg-border shrink-0",
                orientation === "horizontal" ? "h-px w-full" : "h-full w-px",
                className
            )}
            {...p}
        />
    );
}
