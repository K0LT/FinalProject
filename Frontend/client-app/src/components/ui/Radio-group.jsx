"use client";
import React from "react";
import { cn } from "./Button";

const Ctx = React.createContext(null);

export function RadioGroup({ value, onValueChange, className, children }) {
    return (
        <Ctx.Provider value={{ value, onValueChange }}>
            <div className={cn("grid gap-3", className)}>{children}</div>
        </Ctx.Provider>
    );
}

export function RadioGroupItem({ value, className, children }) {
    const { value: cur, onValueChange } = React.useContext(Ctx) || {};
    const active = cur === value;
    return (
        <label className="flex items-center gap-2 cursor-pointer">
            <input
                type="radio"
                className="hidden"
                checked={active}
                onChange={() => onValueChange?.(value)}
            />
            <span
                className={cn(
                    "size-4 rounded-full border flex items-center justify-center",
                    active && "border-primary bg-primary/20"
                )}
            >
        {active && <span className="size-2 rounded-full bg-primary" />}
      </span>
            <span>{children}</span>
        </label>
    );
}
