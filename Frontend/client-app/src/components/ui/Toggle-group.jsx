"use client";
import React from "react";
import { cn } from "./Button";
import { Toggle } from "./Toggle";

const TG = React.createContext(null);

export function ToggleGroup({ value, onValueChange, className, children }) {
    return (
        <TG.Provider value={{ value, onValueChange }}>
            <div className={cn("flex rounded-md border divide-x", className)}>{children}</div>
        </TG.Provider>
    );
}

export function ToggleGroupItem({ value, children, className }) {
    const { value: cur, onValueChange } = React.useContext(TG);
    const active = cur === value;
    return (
        <Toggle pressed={active} onPressedChange={()=>onValueChange?.(value)} className={cn("flex-1", className)}>
            {children}
        </Toggle>
    );
}
