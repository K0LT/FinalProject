"use client";
import React from "react";

export function Toaster({ message, type="info" }) {
    React.useEffect(()=>{ if(message) alert(`${type.toUpperCase()}: ${message}`); },[message,type]);
    return null;
}
