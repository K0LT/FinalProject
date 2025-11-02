"use client";
import React from "react";
import { cn } from "./Button";

const PopCtx = React.createContext(null);

export function Popover({ children }) {
    const [open, setOpen] = React.useState(false);
    const [anchor, setAnchor] = React.useState(null);
    return <PopCtx.Provider value={{ open, setOpen, anchor, setAnchor }}>{children}</PopCtx.Provider>;
}

export const PopoverTrigger = ({ children }) => {
    const { setAnchor, setOpen } = React.useContext(PopCtx);
    const ref = React.useRef(null);
    React.useEffect(()=>{ setAnchor(ref.current); },[setAnchor]);
    return (
        <button ref={ref} onClick={()=>setOpen(v=>!v)} className="inline-flex">
            {children}
        </button>
    );
};

export const PopoverContent = ({ className, children }) => {
    const { open, anchor, setOpen } = React.useContext(PopCtx);
    const [pos, setPos] = React.useState({left:0,top:0});
    React.useEffect(()=>{
        if(open && anchor){
            const r=anchor.getBoundingClientRect();
            setPos({left:r.left,top:r.bottom+4});
            const close=(e)=>!e.composedPath().includes(anchor)&&setOpen(false);
            setTimeout(()=>document.addEventListener("click",close,{once:true}),0);
            return()=>document.removeEventListener("click",close);
        }
    },[open,anchor,setOpen]);
    if(!open) return null;
    return (
        <div
            style={{position:"fixed",left:pos.left,top:pos.top}}
            className={cn("z-50 min-w-[8rem] rounded-md border bg-white p-3 shadow-md",className)}
        >
            {children}
        </div>
    );
};
