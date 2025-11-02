"use client";
import React from "react";

const cn = (...xs) => xs.filter(Boolean).join(" ");

const variants = {
    default: "bg-gray-900 text-white hover:bg-gray-800",
    secondary: "bg-gray-100 text-gray-900 hover:bg-gray-200",
    outline: "border border-gray-200 text-gray-700",
    destructive: "bg-red-600 text-white hover:bg-red-700",
};

export function Badge({ variant = "default", className, ...props }) {
    return (
        <span
            className={cn(
                "inline-flex items-center rounded-md px-2 py-0.5 text-xs font-medium",
                variants[variant] || variants.default,
                className
            )}
            {...props}
        />
    );
}

export default Badge;
