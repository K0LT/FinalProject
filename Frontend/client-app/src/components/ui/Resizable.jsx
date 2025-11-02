"use client";
import React from "react";
import { cn } from "./Button";

export function ResizablePanelGroup({ className, children }) {
    return <div className={cn("flex w-full h-full", className)}>{children}</div>;
}

export const ResizablePanel = ({ className, children, style }) => (
    <div className={cn("flex-1 min-w-[100px] overflow-auto", className)} style={style}>{children}</div>
);

export function ResizableHandle({ className }) {
    const ref = React.useRef(null);
    return (
        <div
            ref={ref}
            className={cn("w-1 bg-gray-200 cursor-col-resize hover:bg-gray-400", className)}
            draggable="true"
        />
    );
}
