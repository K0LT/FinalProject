"use client";
import React from "react";
import { cn } from "./Button";

export function ScrollArea({ className, children }) {
    return (
        <div className={cn("relative overflow-auto", className)}>
            {children}
        </div>
    );
}

export const ScrollBar = () => null;
