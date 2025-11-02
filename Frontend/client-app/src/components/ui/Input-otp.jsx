"use client";
import React from "react";
import { cn } from "./Button";

export function InputOTP({ value="", onChange, maxLength=6, containerClassName, className, ...props }) {
    const [val, setVal] = React.useState(String(value).slice(0, maxLength));
    React.useEffect(()=>setVal(String(value || "").slice(0, maxLength)),[value,maxLength]);

    const refs = React.useRef([]);
    const setChar = (i, ch) => {
        const s = (val.padEnd(maxLength)).split("");
        s[i] = (ch || "").slice(-1);
        const next = s.join("").slice(0, maxLength);
        setVal(next); onChange?.(next);
    };

    return (
        <div className={cn("flex items-center gap-2 has-disabled:opacity-50", containerClassName)} {...props}>
            {Array.from({ length: maxLength }).map((_, i) => (
                <input
                    key={i}
                    ref={el => refs.current[i] = el}
                    inputMode="numeric"
                    pattern="[0-9]*"
                    value={val[i] ?? ""}
                    onChange={(e)=>{ setChar(i, e.target.value.replace(/\D/g,"")); if (e.target.value) refs.current[i+1]?.focus(); }}
                    onKeyDown={(e)=>{ if(e.key==="Backspace" && !val[i] && i>0){ refs.current[i-1]?.focus(); } }}
                    className={cn("h-9 w-9 rounded-md border bg-input-background text-center text-sm outline-none focus:ring-[3px] focus:ring-ring/50", className)}
                />
            ))}
        </div>
    );
}

export const InputOTPGroup = ({ className, ...p }) => <div className={cn("flex items-center gap-1", className)} {...p} />;
export const InputOTPSlot = ({ children }) => <div>{children}</div>; // compat
export const InputOTPSeparator = (p) => <div role="separator" {...p}>-</div>;
