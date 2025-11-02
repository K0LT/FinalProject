"use client";
import React from "react";
import { cn } from "./Button";

const TT = React.createContext(null);

export function TooltipProvider({ children }) { return children; }

export const Tooltip = ({ children }) => <>{children}</>;

export function TooltipTrigger({ children }) {
    const [show, setShow] = React.useState(false);
    return (
        <span
            className="relative inline-block"
            onMouseEnter={()=>setShow(true)}
            onMouseLeave={()=>setShow(false)}
        >
      {React.cloneElement(children, { "data-show": show })}
    </span>
    );
}

export function TooltipContent({ children, className }) {
    return (
        <span
            className={cn(
                "absolute left-1/2 -translate-x-1/2 mt-1 whitespace-nowrap rounded-md bg-primary px-2 py-1 text-xs text-primary-foreground shadow",
                className
            )}
        >
      {children}
    </span>
    );
}
