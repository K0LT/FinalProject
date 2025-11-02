"use client";
import React from "react";
import { cn } from "./Button";

export function Label({ className, ...props }) {
    return (
        <label
            className={cn(
                "flex items-center gap-2 text-sm font-medium leading-none select-none",
                "peer-disabled:cursor-not-allowed peer-disabled:opacity-50",
                className
            )}
            {...props}
        />
    );
}
