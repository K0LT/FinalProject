"use client";
import React from "react";
import { cn } from "./Button";

export function Slider({ value=50, min=0, max=100, step=1, onChange, className }) {
    return (
        <input
            type="range"
            min={min}
            max={max}
            step={step}
            value={value}
            onChange={(e)=>onChange?.(Number(e.target.value))}
            className={cn(
                "w-full accent-primary cursor-pointer",
                "h-2 bg-gray-200 rounded-lg appearance-none",
                className
            )}
        />
    );
}
