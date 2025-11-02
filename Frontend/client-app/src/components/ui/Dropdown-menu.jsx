"use client";
import React from "react";
import { cn } from "./Button";

/* Contexto raiz */
const DD = React.createContext(null);

export function DropdownMenu({ children }) {
    const [open, setOpen] = React.useState(false);
    const [anchor, setAnchor] = React.useState(null);
    return <DD.Provider value={{ open, setOpen, anchor, setAnchor }}>{children}</DD.Provider>;
}

export const DropdownMenuPortal = ({ children }) => <>{children}</>;

export function DropdownMenuTrigger({ asChild=false, children }) {
    const { setOpen, setAnchor } = React.useContext(DD);
    const ref = React.useRef(null);
    React.useEffect(()=>{ setAnchor(ref.current); },[setAnchor]);
    const Comp = asChild ? "span" : "button";
    return (
        <Comp ref={ref} onClick={()=>setOpen(v=>!v)} aria-haspopup="menu">
            {children}
        </Comp>
    );
}

export function DropdownMenuContent({ className, sideOffset=4, children }) {
    const { open, setOpen, anchor } = React.useContext(DD);
    const [pos, setPos] = React.useState({ left: 0, top: 0 });
    React.useEffect(() => {
        if (open && anchor) {
            const r = anchor.getBoundingClientRect();
            setPos({ left: r.left, top: r.bottom + sideOffset });
            const close = (e) => { if (!e.composedPath().includes(anchor)) setOpen(false); };
            setTimeout(() => document.addEventListener("click", close, { once: true }), 0);
            return () => document.removeEventListener("click", close);
        }
    }, [open, anchor, setOpen, sideOffset]);
    if (!open) return null;
    return (
        <DropdownMenuPortal>
            <div
                role="menu"
                style={{ left: pos.left, top: pos.top, position: "fixed" }}
                className={cn("z-50 min-w-[8rem] rounded-md border bg-white p-1 shadow-md", className)}
            >
                {children}
            </div>
        </DropdownMenuPortal>
    );
}

export const DropdownMenuGroup = (p)=><div {...p}/>;

export function DropdownMenuItem({ className, inset, variant="default", disabled, ...props }) {
    return (
        <button
            role="menuitem"
            disabled={disabled}
            className={cn(
                "w-full select-none rounded-sm px-2 py-1.5 text-left text-sm hover:bg-gray-100 disabled:opacity-50",
                inset && "pl-8",
                variant==="destructive" && "text-red-600 hover:bg-red-50",
                className
            )}
            {...props}
        />
    );
}

export function DropdownMenuCheckboxItem({ checked, children, onCheckedChange }) {
    return (
        <DropdownMenuItem onClick={()=>onCheckedChange?.(!checked)} inset>
            <span className="mr-2 inline-block w-4">{checked ? "✓" : ""}</span>{children}
        </DropdownMenuItem>
    );
}

const RadioCtx = React.createContext(null);
export const DropdownMenuRadioGroup = ({ value, onValueChange, children }) => (
    <RadioCtx.Provider value={{ value, onValueChange }}>{children}</RadioCtx.Provider>
);

export function DropdownMenuRadioItem({ value, children }) {
    const { value: v, onValueChange } = React.useContext(RadioCtx) || {};
    const active = v === value;
    return (
        <DropdownMenuItem onClick={()=>onValueChange?.(value)} inset>
            <span className="mr-2 inline-block w-4">{active ? "•" : ""}</span>{children}
        </DropdownMenuItem>
    );
}

export const DropdownMenuLabel = ({ inset, className, ...p }) =>
    <div className={cn("px-2 py-1.5 text-sm font-medium", inset && "pl-8", className)} {...p} />;
export const DropdownMenuSeparator = ({ className }) =>
    <div role="separator" className={cn("my-1 h-px -mx-1 bg-gray-200", className)} />;
export const DropdownMenuShortcut = (p)=><span className={cn("ml-auto text-xs text-gray-500", p.className)} {...p}/>;
export const DropdownMenuSub = ({ children }) => <div className="relative">{children}</div>;
export const DropdownMenuSubTrigger = ({ children, inset, className, ...p }) =>
    <div className={cn("flex w-full items-center rounded-sm px-2 py-1.5 text-sm hover:bg-gray-100", inset && "pl-8", className)} {...p}>{children}<span className="ml-auto">›</span></div>;
export const DropdownMenuSubContent = ({ children, className }) =>
    <div className={cn("ml-2 mt-0.5 min-w-[8rem] rounded-md border bg-white p-1 shadow-md", className)}>{children}</div>;
