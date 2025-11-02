"use client";
import React from "react";
import { cn } from "./Button";

export function Input({ className, type="text", ...props }) {
    return (
        <input
            type={type}
            className={cn(
                "border-input bg-input-background file:text-foreground placeholder:text-muted-foreground selection:bg-primary selection:text-primary-foreground flex h-9 w-full min-w-0 rounded-md border px-3 py-1 text-base outline-none transition-[color,box-shadow] file:inline-flex file:h-7 file:border-0 file:bg-transparent file:text-sm file:font-medium disabled:pointer-events-none disabled:opacity-50 md:text-sm",
                "focus-visible:border-ring focus-visible:ring-[3px] focus-visible:ring-ring/50 aria-invalid:border-red-500",
                className
            )}
            {...props}
        />
    );
}
