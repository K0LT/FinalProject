"use client";
import React from "react";
import { cn } from "./Button";

const HC = React.createContext(null);

export const HoverCard = ({ children, openDelay=150 }) => {
    const [open, setOpen] = React.useState(false);
    const [timer, setTimer] = React.useState(null);
    const api = {
        open,
        openNow: ()=>{ clearTimeout(timer); setOpen(true); },
        scheduleOpen: ()=>{ const t=setTimeout(()=>setOpen(true), openDelay); setTimer(t); },
        close: ()=>{ clearTimeout(timer); setOpen(false); },
    };
    return <HC.Provider value={api}>{children}</HC.Provider>;
};

export const HoverCardTrigger = ({ children }) => {
    const hc = React.useContext(HC);
    return (
        <span onMouseEnter={hc.scheduleOpen} onMouseLeave={hc.close} onFocus={hc.openNow} onBlur={hc.close}>
      {children}
    </span>
    );
};

export function HoverCardContent({ className, sideOffset=4, children }) {
    const { open, openNow, close } = React.useContext(HC);
    const ref = React.useRef(null);
    const [pos, setPos] = React.useState({ left: 0, top: 0 });
    React.useEffect(() => {
        if (!open) return;
        const r = ref.current?.previousElementSibling?.getBoundingClientRect?.();
        if (r) setPos({ left: r.left, top: r.bottom + sideOffset });
    }, [open, sideOffset]);
    if (!open) return null;
    return (
        <div
            ref={ref}
            onMouseEnter={openNow}
            onMouseLeave={close}
            className={cn("fixed z-50 w-64 rounded-md border bg-white p-4 shadow-md", className)}
            style={{ left: pos.left, top: pos.top }}
        >
            {children}
        </div>
    );
}
