"use client";
import React from "react";

const cn = (...xs) => xs.filter(Boolean).join(" ");

const variants = {
    default: "bg-gray-900 text-white hover:bg-gray-800",
    outline: "border bg-white hover:bg-gray-50",
    ghost: "bg-transparent hover:bg-gray-100",
};

export function Button({ variant = "default", className, ...props }) {
    const Comp = props.href ? "a" : "button";
    return (
        <Comp
            className={cn(
                "inline-flex items-center justify-center gap-2 rounded-md px-3 py-2 text-sm",
                "transition focus:outline-none focus:ring-2 focus:ring-gray-300 disabled:opacity-50",
                variants[variant] || variants.default,
                className
            )}
            {...props}
        />
    );
}

export default Button;
