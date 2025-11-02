"use client";
import React from "react";
import { cn } from "./Button";

const Check = (p)=>(<svg viewBox="0 0 24 24" width="14" height="14" {...p}><path d="M20 6L9 17l-5-5" stroke="currentColor" strokeWidth="2" fill="none"/></svg>);
const ChevronRight = (p)=>(<svg viewBox="0 0 24 24" width="14" height="14" {...p}><path d="M9 6l6 6-6 6" stroke="currentColor" strokeWidth="2" fill="none"/></svg>);
const Dot = (p)=>(<svg viewBox="0 0 24 24" width="10" height="10" {...p}><circle cx="12" cy="12" r="4" fill="currentColor"/></svg>);

const Ctx = React.createContext(null);

export function ContextMenu({ children }) {
    const [open, setOpen] = React.useState(false);
    const [pos, setPos] = React.useState({ x: 0, y: 0 });
    const onContextMenu = (e) => {
        e.preventDefault();
        setPos({ x: e.clientX, y: e.clientY });
        setOpen(true);
    };
    React.useEffect(() => {
        const close = () => setOpen(false);
        if (open) document.addEventListener("click", close, { once: true });
        return () => document.removeEventListener("click", close);
    }, [open]);

    return (
        <Ctx.Provider value={{ open, setOpen, pos }}>
            <div onContextMenu={onContextMenu}>{children}</div>
        </Ctx.Provider>
    );
}

export function ContextMenuTrigger({ children, ...props }) {
    return <div {...props}>{children}</div>;
}

export function ContextMenuContent({ className, children }) {
    const { open, pos } = React.useContext(Ctx);
    if (!open) return null;
    return (
        <div
            data-slot="context-menu-content"
            className={cn(
                "bg-popover text-popover-foreground z-50 min-w-[8rem] overflow-hidden rounded-md border p-1 shadow-md fixed",
                className
            )}
            style={{ left: pos.x, top: pos.y }}
        >
            {children}
        </div>
    );
}

export function ContextMenuItem({ className, inset, variant="default", onSelect, children, disabled }) {
    return (
        <button
            disabled={disabled}
            onClick={onSelect}
            data-slot="context-menu-item"
            className={cn(
                "relative flex w-full cursor-default items-center gap-2 rounded-sm px-2 py-1.5 text-sm select-none",
                inset && "pl-8",
                variant==="destructive" ? "text-red-600 hover:bg-red-50" : "hover:bg-accent",
                "disabled:opacity-50 disabled:pointer-events-none",
                className
            )}
        >
            {children}
        </button>
    );
}
export function ContextMenuCheckboxItem({ checked, children, onCheckedChange }) {
    return (
        <ContextMenuItem onSelect={()=>onCheckedChange?.(!checked)}>
            <span className="w-4 h-4 grid place-items-center">{checked ? <Check/> : null}</span>
            {children}
        </ContextMenuItem>
    );
}
export function ContextMenuRadioGroup({ value, onValueChange, children }) {
    return <div data-slot="context-menu-radio-group" role="group">{React.Children.map(children, (c)=>React.cloneElement(c, { __value:value, __on:onValueChange }))}</div>;
}
export function ContextMenuRadioItem({ value, __value, __on, children }) {
    const active = __value === value;
    return (
        <ContextMenuItem onSelect={()=>__on?.(value)}>
            <span className="w-4 h-4 grid place-items-center">{active ? <Dot/> : <span className="h-2 w-2 rounded-full border" />}</span>
            {children}
        </ContextMenuItem>
    );
}
export function ContextMenuLabel({ inset, className, children }) {
    return <div data-slot="context-menu-label" className={cn("px-2 py-1.5 text-sm font-medium", inset && "pl-8", className)}>{children}</div>;
}
export function ContextMenuSeparator() {
    return <div data-slot="context-menu-separator" className="bg-border -mx-1 my-1 h-px" />;
}
export function ContextMenuShortcut({ className, children }) {
    return <span data-slot="context-menu-shortcut" className={cn("ml-auto text-xs tracking-widest text-muted-foreground", className)}>{children}</span>;
}
export function ContextMenuGroup({ children }) { return <div>{children}</div>; }
export function ContextMenuPortal({ children }) { return <>{children}</> }
export function ContextMenuSub({ children }) { return <div className="relative">{children}</div>; }
export function ContextMenuSubTrigger({ children }) {
    return (
        <div className="flex w-full items-center gap-2 rounded-sm px-2 py-1.5 text-sm hover:bg-accent">
            {children}
            <ChevronRight className="ml-auto" />
        </div>
    );
}
export function ContextMenuSubContent({ children, className }) {
    return <div className={cn("ml-2 mt-[-0.25rem] min-w-[8rem] rounded-md border p-1 shadow-md bg-popover", className)}>{children}</div>;
}
