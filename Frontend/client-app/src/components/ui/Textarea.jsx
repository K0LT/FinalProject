"use client";
import React from "react";
import { cn } from "./Button";

export function Textarea({ className, ...p }) {
    return (
        <textarea
            className={cn(
                "min-h-20 w-full rounded-md border px-3 py-2 text-sm outline-none focus:ring-2 focus:ring-primary",
                className
            )}
            {...p}
        />
    );
}
