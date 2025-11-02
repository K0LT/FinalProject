"use client";
import React from "react";
import { cn } from "./Button";

const SheetCtx = React.createContext(null);

export function Sheet({ children }) {
    const [open, setOpen] = React.useState(false);
    return <SheetCtx.Provider value={{ open, setOpen }}>{children}</SheetCtx.Provider>;
}

export const SheetTrigger = ({ children }) => {
    const { setOpen } = React.useContext(SheetCtx);
    return <button onClick={() => setOpen(true)}>{children}</button>;
};

export const SheetClose = ({ children }) => {
    const { setOpen } = React.useContext(SheetCtx);
    return <button onClick={() => setOpen(false)}>{children}</button>;
};

export function SheetContent({ className, side="right", children }) {
    const { open, setOpen } = React.useContext(SheetCtx);
    if (!open) return null;
    const sideClass = {
        right: "inset-y-0 right-0 w-3/4 sm:max-w-sm border-l",
        left: "inset-y-0 left-0 w-3/4 sm:max-w-sm border-r",
        top: "inset-x-0 top-0 border-b h-auto",
        bottom: "inset-x-0 bottom-0 border-t h-auto",
    }[side];
    return (
        <>
            <div className="fixed inset-0 bg-black/50 z-40" onClick={() => setOpen(false)} />
            <div
                className={cn(
                    "fixed z-50 bg-white shadow-lg transition-transform p-4",
                    sideClass,
                    className
                )}
            >
                <button onClick={() => setOpen(false)} className="absolute top-3 right-3">✕</button>
                {children}
            </div>
        </>
    );
}

export const SheetHeader = (p)=><div className={cn("p-2",p.className)} {...p}/>;
export const SheetFooter = (p)=><div className={cn("p-2 mt-auto",p.className)} {...p}/>;
export const SheetTitle = (p)=><h3 className={cn("font-semibold",p.className)} {...p}/>;
export const SheetDescription = (p)=><p className={cn("text-sm text-gray-500",p.className)} {...p}/>;
