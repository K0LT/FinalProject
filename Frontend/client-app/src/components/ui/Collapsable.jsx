"use client";
import React from "react";

const Ctx = React.createContext(null);

export function Collapsible({ open: o, defaultOpen=false, onOpenChange, children, ...props }) {
    const [open, setOpen] = React.useState(o ?? defaultOpen);
    React.useEffect(()=>{ if(o!==undefined) setOpen(o); },[o]);
    const api = {
        open,
        setOpen: (v)=>{ onOpenChange?.(typeof v==="function" ? v(open) : v); setOpen(typeof v==="function" ? v(open) : v); }
    };
    return <Ctx.Provider value={api}><div data-slot="collapsible" {...props}>{children}</div></Ctx.Provider>;
}

export function CollapsibleTrigger({ children, ...props }) {
    const { open, setOpen } = React.useContext(Ctx);
    return <button data-slot="collapsible-trigger" aria-expanded={open} onClick={()=>setOpen(v=>!v)} {...props}>{children}</button>;
}

export function CollapsibleContent({ children, ...props }) {
    const { open } = React.useContext(Ctx);
    if (!open) return null;
    return <div data-slot="collapsible-content" {...props}>{children}</div>;
}
