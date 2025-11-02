"use client";
import React from "react";
import { cn } from "./Button";

/* Ícone check */
const Check = (p)=>(<svg viewBox="0 0 24 24" width="14" height="14" {...p}><path d="M20 6L9 17l-5-5" stroke="currentColor" strokeWidth="2" fill="none"/></svg>);

export function Checkbox({ className, checked, onCheckedChange, ...props }) {
    return (
        <button
            type="button"
            role="checkbox"
            aria-checked={!!checked}
            onClick={() => onCheckedChange && onCheckedChange(!checked)}
            className={cn(
                "size-4 rounded-[4px] border bg-input-background grid place-items-center text-current",
                "data-[state=checked]:bg-primary",
                checked ? "bg-primary text-primary-foreground border-primary" : "",
                "outline-none focus-visible:ring-[3px] focus-visible:ring-ring/50 disabled:opacity-50 disabled:pointer-events-none",
                className
            )}
            {...props}
        >
            {checked ? <Check /> : null}
        </button>
    );
}
