"use client";
import React from "react";
import { cn } from "./Button";

export function Switch({ checked=false, onCheckedChange, className }) {
    return (
        <button
            type="button"
            role="switch"
            aria-checked={checked}
            onClick={()=>onCheckedChange?.(!checked)}
            className={cn(
                "inline-flex h-[1.15rem] w-8 shrink-0 items-center rounded-full transition-all outline-none",
                checked ? "bg-primary justify-end" : "bg-gray-300 justify-start",
                className
            )}
        >
            <span className="size-4 bg-white rounded-full shadow" />
        </button>
    );
}
