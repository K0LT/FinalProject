"use client";
import React from "react";
import { cn } from "./Button";

export function Toggle({ pressed=false, onPressedChange, className, children }) {
    return (
        <button
            aria-pressed={pressed}
            onClick={()=>onPressedChange?.(!pressed)}
            className={cn(
                "inline-flex items-center justify-center rounded-md border px-3 py-1 text-sm",
                pressed ? "bg-accent text-accent-foreground" : "hover:bg-gray-100",
                className
            )}
        >
            {children}
        </button>
    );
}
