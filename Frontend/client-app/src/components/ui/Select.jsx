"use client";
import React from "react";
import { cn } from "./Button";

export function Select({ value, onValueChange, children }) {
    return <div className="relative inline-block">{children}</div>;
}

export const SelectTrigger = ({ value, placeholder, onClick, className }) => (
    <button onClick={onClick} className={cn("border rounded-md px-3 py-1.5 text-sm bg-white", className)}>
        {value || placeholder}
    </button>
);

export const SelectContent = ({ open, options, onSelect, className }) => {
    if (!open) return null;
    return (
        <div className={cn("absolute z-50 mt-1 min-w-[8rem] rounded-md border bg-white p-1 shadow-md", className)}>
            {options?.map((o) => (
                <div
                    key={o.value}
                    onClick={() => onSelect?.(o.value)}
                    className="cursor-pointer rounded-sm px-2 py-1 text-sm hover:bg-gray-100"
                >
                    {o.label}
                </div>
            ))}
        </div>
    );
};
