"use client";
import React from "react";
import { cn } from "./button";

const TabsCtx = React.createContext(null);

export function Tabs({ defaultValue, children }) {
    const [value, setValue] = React.useState(defaultValue);
    return <TabsCtx.Provider value={{ value, setValue }}>{children}</TabsCtx.Provider>;
}

export const TabsList = ({ className, ...p }) => (
    <div className={cn("flex gap-1 rounded-xl bg-gray-100 p-1", className)} {...p} />
);

export function TabsTrigger({ value, children, className }) {
    const { value: cur, setValue } = React.useContext(TabsCtx);
    const active = cur === value;
    return (
        <button
            onClick={()=>setValue(value)}
            className={cn(
                "flex-1 rounded-lg px-3 py-1 text-sm transition",
                active ? "bg-white shadow" : "hover:bg-gray-200",
                className
            )}
        >
            {children}
        </button>
    );
}

export function TabsContent({ value, children }) {
    const { value: cur } = React.useContext(TabsCtx);
    if (cur !== value) return null;
    return <div className="mt-2">{children}</div>;
}
