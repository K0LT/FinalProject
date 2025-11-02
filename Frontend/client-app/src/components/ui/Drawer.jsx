"use client";
import React from "react";
import { cn } from "./Button";

const DrawerCtx = React.createContext(null);

export function Drawer({ open:o, defaultOpen=false, onOpenChange, direction="bottom", children }) {
    const [open, setOpen] = React.useState(o ?? defaultOpen);
    React.useEffect(()=>{ if(o!==undefined) setOpen(o); },[o]);
    const set = (v)=>{ const n = typeof v==="function"?v(open):v; onOpenChange?.(n); if(o===undefined) setOpen(n); };
    return <DrawerCtx.Provider value={{ open, set, direction }}>{children}</DrawerCtx.Provider>;
}

export const DrawerTrigger = ({ children }) => {
    const { set } = React.useContext(DrawerCtx);
    return <button onClick={()=>set(true)}>{children}</button>;
};

export const DrawerPortal = ({ children }) => <>{children}</>;
export function DrawerOverlay() {
    const { open, set } = React.useContext(DrawerCtx);
    if (!open) return null;
    return <div className="fixed inset-0 z-50 bg-black/50" onClick={()=>set(false)} />;
}

export function DrawerContent({ className, children }) {
    const { open, direction } = React.useContext(DrawerCtx);
    if (!open) return null;
    const common = "fixed z-50 bg-white border shadow-lg";
    const pos = {
        bottom: "inset-x-0 bottom-0 rounded-t-lg max-h-[80vh]",
        top: "inset-x-0 top-0 rounded-b-lg max-h-[80vh]",
        left: "inset-y-0 left-0 w-3/4 sm:max-w-sm rounded-r-lg",
        right:"inset-y-0 right-0 w-3/4 sm:max-w-sm rounded-l-lg",
    }[direction] || "inset-x-0 bottom-0";
    return (
        <DrawerPortal>
            <DrawerOverlay />
            <div className={cn(common, pos, "p-4", className)}>{children}</div>
        </DrawerPortal>
    );
}

export const DrawerHeader = (p)=><div className={cn("p-2 pb-0", p.className)} {...p}/>;
export const DrawerFooter = (p)=><div className={cn("mt-4 flex flex-col gap-2 p-2", p.className)} {...p}/>;
export const DrawerTitle = (p)=><h3 className={cn("text-base font-semibold", p.className)} {...p}/>;
export const DrawerDescription = (p)=><p className={cn("text-sm text-gray-500", p.className)} {...p}/>;
export const DrawerClose = ({ children }) => {
    const { set } = React.useContext(DrawerCtx);
    return <button onClick={()=>set(false)}>{children ?? "Fechar"}</button>;
};
