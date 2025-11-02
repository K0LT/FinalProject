"use client";
import React from "react";
import { cn } from "./Button";

const NavCtx = React.createContext(null);

export function NavigationMenu({ className, children, viewport=true }) {
    const [openId, setOpenId] = React.useState(null);
    return (
        <NavCtx.Provider value={{ openId, setOpenId, viewport }}>
            <nav className={cn("relative flex items-center justify-center", className)}>
                <ul className="flex list-none items-center gap-1">{children}</ul>
                {viewport && <NavigationMenuViewport />}
            </nav>
        </NavCtx.Provider>
    );
}

export const NavigationMenuList = ({ className, ...p }) =>
    <ul className={cn("flex list-none items-center gap-1", className)} {...p} />;

export const NavigationMenuItem = ({ className, ...p }) =>
    <li className={cn("relative", className)} {...p} />;

export function NavigationMenuTrigger({ className, children, value }) {
    const { openId, setOpenId } = React.useContext(NavCtx);
    const open = openId === value;
    return (
        <button
            onClick={() => setOpenId(open ? null : value)}
            className={cn("inline-flex h-9 items-center rounded-md bg-white px-4 text-sm hover:bg-gray-100", open && "bg-gray-100", className)}
        >
            {children} <span className="ml-1">▾</span>
        </button>
    );
}

export function NavigationMenuContent({ className, children, value }) {
    const { openId, viewport } = React.useContext(NavCtx);
    if (viewport) return null;
    if (openId !== value) return null;
    return (
        <div className={cn("absolute top-full mt-2 rounded-md border bg-white p-2 shadow", className)}>
            {children}
        </div>
    );
}

export function NavigationMenuViewport({ className }) {
    const { openId } = React.useContext(NavCtx);
    if (!openId) return null;
    return (
        <div className="absolute left-0 top-full z-50 flex w-full justify-center">
            <div className={cn("mt-2 w-[min(64rem,100%)] rounded-md border bg-white p-2 shadow", className)}>

                <div className="text-sm text-gray-500 px-2 py-4 text-center">
                    Coloca o conteúdo com a variante sem viewport (ou personaliza este container).
                </div>
            </div>
        </div>
    );
}

export const NavigationMenuLink = ({ className, ...p }) =>
    <a className={cn("rounded-sm p-2 text-sm hover:bg-gray-100", className)} {...p} />;

export const NavigationMenuIndicator = () => null;
export const navigationMenuTriggerStyle = () => "inline-flex h-9 items-center rounded-md px-4 text-sm";
