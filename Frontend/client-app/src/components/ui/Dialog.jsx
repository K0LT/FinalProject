"use client";
import React from "react";
import { cn } from "./Button";

const DialogCtx = React.createContext(null);

export function Dialog({ open: o, defaultOpen=false, onOpenChange, children }) {
    const [open, setOpen] = React.useState(o ?? defaultOpen);
    React.useEffect(() => { if (o !== undefined) setOpen(o); }, [o]);
    const set = (v) => {
        const next = typeof v === "function" ? v(open) : v;
        onOpenChange?.(next);
        if (o === undefined) setOpen(next);
    };
    return <DialogCtx.Provider value={{ open, set }}>{children}</DialogCtx.Provider>;
}

export const DialogTrigger = ({ asChild=false, children }) => {
    const { set } = React.useContext(DialogCtx);
    const Comp = asChild ? "span" : "button";
    return <Comp onClick={() => set(true)}>{children}</Comp>;
};

export const DialogPortal = ({ children }) => <>{children}</>;

export function DialogOverlay({ className }) {
    const { open, set } = React.useContext(DialogCtx);
    if (!open) return null;
    return (
        <div
            onClick={() => set(false)}
            className={cn("fixed inset-0 z-50 bg-black/50", className)}
        />
    );
}

export function DialogContent({ className, children, onEscapeKeyDown }) {
    const { open, set } = React.useContext(DialogCtx);
    const ref = React.useRef(null);
    React.useEffect(() => {
        if (!open) return;
        const onKey = (e) => { if (e.key === "Escape") { onEscapeKeyDown?.(e); set(false); } };
        document.addEventListener("keydown", onKey);
        return () => document.removeEventListener("keydown", onKey);
    }, [open, set, onEscapeKeyDown]);
    if (!open) return null;
    return (
        <DialogPortal>
            <DialogOverlay />
            <div
                ref={ref}
                role="dialog"
                aria-modal="true"
                className={cn(
                    "fixed left-1/2 top-1/2 z-50 w-[min(36rem,calc(100%-2rem))] -translate-x-1/2 -translate-y-1/2 rounded-lg border bg-white p-6 shadow-lg",
                    className
                )}
            >
                {children}
                <button
                    className="absolute right-4 top-4 rounded-xs opacity-70 transition hover:opacity-100"
                    onClick={() => set(false)}
                    aria-label="Fechar"
                >
                    ✕
                </button>
            </div>
        </DialogPortal>
    );
}

export const DialogHeader = (p) => <div className={cn("flex flex-col gap-2", p.className)} {...p} />;
export const DialogFooter = (p) => <div className={cn("mt-4 flex flex-col gap-2 sm:flex-row sm:justify-end", p.className)} {...p} />;
export const DialogTitle = (p) => <h2 className={cn("text-lg font-semibold", p.className)} {...p} />;
export const DialogDescription = (p) => <p className={cn("text-sm text-gray-500", p.className)} {...p} />;
export const DialogClose = ({ children }) => {
    const { set } = React.useContext(DialogCtx);
    return <button onClick={() => set(false)}>{children ?? "Fechar"}</button>;
};
