"use client";
import React from "react";
import { cn } from "./Button";

/* Ícone pesquisa */
const Search = (p)=>(<svg viewBox="0 0 24 24" width="16" height="16" {...p}><circle cx="11" cy="11" r="7" stroke="currentColor" strokeWidth="2" fill="none"/><path d="M20 20l-3.5-3.5" stroke="currentColor" strokeWidth="2"/></svg>);

export function Command({ className, children, ...props }) {
    return <div data-slot="command" className={cn("bg-popover text-popover-foreground flex h-full w-full flex-col overflow-hidden rounded-md", className)} {...props}>{children}</div>;
}

export function CommandDialog({ title="Command Palette", description="Search…", open, onOpenChange, children }) {
    if (!open) return null;
    return (
        <div className="fixed inset-0 z-50 grid place-items-center">
            <div className="fixed inset-0 bg-black/30" onClick={()=>onOpenChange?.(false)} />
            <div className="relative z-10 w-full max-w-lg rounded-md border bg-white shadow-xl overflow-hidden">
                <div className="sr-only">
                    <h2>{title}</h2><p>{description}</p>
                </div>
                <Command className="[&_[data-group-heading]]:text-muted-foreground">
                    {children}
                </Command>
            </div>
        </div>
    );
}

export function CommandInput({ className, value, onChange, ...props }) {
    return (
        <div data-slot="command-input-wrapper" className="flex h-12 items-center gap-2 border-b px-3">
            <Search className="opacity-60" />
            <input
                value={value}
                onChange={onChange}
                data-slot="command-input"
                className={cn("placeholder:text-muted-foreground h-10 w-full bg-transparent text-sm outline-none", className)}
                {...props}
            />
        </div>
    );
}

export function CommandList({ className, children, ...props }) {
    return <div data-slot="command-list" className={cn("max-h-[300px] overflow-y-auto", className)} {...props}>{children}</div>;
}

export function CommandEmpty({ children="Sem resultados" }) {
    return <div data-slot="command-empty" className="py-6 text-center text-sm">{children}</div>;
}

export function CommandGroup({ heading, className, children, ...props }) {
    return (
        <div data-slot="command-group" className={cn("p-1", className)} {...props}>
            {heading && <div data-group-heading className="px-2 py-1.5 text-xs font-medium">{heading}</div>}
            {children}
        </div>
    );
}

export function CommandSeparator() {
    return <div data-slot="command-separator" className="bg-border -mx-1 h-px" />;
}

export function CommandItem({ className, children, onSelect, disabled, ...props }) {
    return (
        <button
            disabled={disabled}
            onClick={onSelect}
            className={cn("text-left w-full rounded-sm px-2 py-1.5 text-sm data-[disabled=true]:opacity-50 hover:bg-accent", className)}
            data-slot="command-item"
            {...props}
        >
            {children}
        </button>
    );
}

export function CommandShortcut({ className, children }) {
    return <span data-slot="command-shortcut" className={cn("ml-auto text-xs tracking-widest text-muted-foreground", className)}>{children}</span>;
}
