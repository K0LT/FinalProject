"use client";

import React from "react";
import Link from "next/link";
import { usePathname } from "next/navigation";

const SIDEBAR_COOKIE_NAME = "sidebar_state";
const SIDEBAR_COOKIE_MAX_AGE = 60 * 60 * 24 * 7; // 7 dias
const SIDEBAR_WIDTH = "16rem";
const SIDEBAR_WIDTH_ICON = "3.25rem";
const SIDEBAR_SHORTCUT = "b";

const SidebarContext = React.createContext(null);

function useSidebar() {
    const ctx = React.useContext(SidebarContext);
    if (!ctx) throw new Error("useSidebar must be used within <SidebarProvider>");
    return ctx;
}

export function SidebarProvider({ children }) {
    const [open, _setOpen] = React.useState(() => {
        if (typeof document === "undefined") return true;
        const m = document.cookie.match(
            new RegExp(`(?:^|; )${SIDEBAR_COOKIE_NAME}=([^;]*)`)
        );
        return m ? m[1] === "true" : true;
    });

    const setOpen = React.useCallback((v) => {
        _setOpen((prev) => {
            const next = typeof v === "function" ? v(prev) : v;
            document.cookie = `${SIDEBAR_COOKIE_NAME}=${next}; path=/; max-age=${SIDEBAR_COOKIE_MAX_AGE}`;
            return next;
        });
    }, []);

    const toggle = React.useCallback(() => setOpen((p) => !p), [setOpen]);

    React.useEffect(() => {
        const handler = (e) => {
            if ((e.metaKey || e.ctrlKey) && e.key.toLowerCase() === SIDEBAR_SHORTCUT) {
                e.preventDefault();
                toggle();
            }
        };
        window.addEventListener("keydown", handler);
        return () => window.removeEventListener("keydown", handler);
    }, [toggle]);

    return (
        <SidebarContext.Provider value={{ open, setOpen, toggle }}>
            <div
                data-slot="sidebar-wrapper"
                style={{
                    "--sidebar-width": SIDEBAR_WIDTH,
                    "--sidebar-width-icon": SIDEBAR_WIDTH_ICON,
                }}
                className="group/sidebar flex min-h-svh w-full"
            >
                {children}
            </div>
        </SidebarContext.Provider>
    );
}

export function SidebarTrigger({ className = "", title = "Alternar sidebar (Ctrl/⌘ + B)" }) {
    const { toggle } = useSidebar();
    return (
        <button
            type="button"
            onClick={toggle}
            title={title}
            className={`inline-flex h-8 w-8 items-center justify-center rounded-md hover:bg-gray-100 focus:outline-none ${className}`}
        >
            <svg viewBox="0 0 24 24" width="18" height="18" aria-hidden="true">
                <path d="M3 6h18M3 12h18M3 18h18" stroke="currentColor" strokeWidth="2" />
            </svg>
            <span className="sr-only">Alternar sidebar</span>
        </button>
    );
}

export function SidebarInset({ children, className = "" }) {
    const { open } = useSidebar();
    return (
        <main
            data-slot="sidebar-inset"
            className={`relative flex min-h-svh flex-1 flex-col transition-[margin] duration-200 ease-linear ${className}`}
            style={{
                marginLeft: open ? "var(--sidebar-width)" : "var(--sidebar-width-icon)",
            }}
        >
            {children}
        </main>
    );
}

export function Sidebar({ header, footer, children, className = "" }) {
    const { open, setOpen } = useSidebar();
    const [mobileOpen, setMobileOpen] = React.useState(false);
    const pathname = usePathname();

    React.useEffect(() => {
        setMobileOpen(false);
    }, [pathname]);

    return (
        <>
            {/* Desktop */}
            <aside
                data-slot="sidebar"
                className={`fixed inset-y-0 left-0 z-30 hidden h-svh border-r bg-white md:flex md:flex-col ${className}`}
                style={{
                    width: open ? "var(--sidebar-width)" : "var(--sidebar-width-icon)",
                    transition: "width 200ms linear",
                }}
            >
                <button
                    type="button"
                    aria-label="Alternar sidebar"
                    onClick={() => setOpen((o) => !o)}
                    className="absolute right-[-10px] top-1/2 hidden h-6 w-6 -translate-y-1/2 items-center justify-center rounded-full border bg-white shadow-sm md:flex"
                >
                    <svg viewBox="0 0 24 24" width="14" height="14">
                        <path
                            d={open ? "M15 6l-6 6 6 6" : "M9 6l6 6-6 6"}
                            stroke="currentColor"
                            strokeWidth="2"
                            fill="none"
                        />
                    </svg>
                </button>

                <div className="flex h-16 items-center gap-3 border-b px-3">{header}</div>
                <div className="min-h-0 flex-1 overflow-y-auto">{children}</div>
                {footer && <div className="border-t p-3">{footer}</div>}
            </aside>

            {/* Mobile trigger (podes mover para a tua topbar) */}
            <button
                type="button"
                onClick={() => setMobileOpen(true)}
                className="md:hidden inline-flex h-9 w-9 items-center justify-center rounded-md border bg-white"
                aria-label="Abrir menu"
            >
                <svg viewBox="0 0 24 24" width="18" height="18">
                    <path d="M3 6h18M3 12h18M3 18h18" stroke="currentColor" strokeWidth="2" />
                </svg>
            </button>

            {/* Mobile sheet */}
            {mobileOpen && (
                <div className="fixed inset-0 z-40 md:hidden">
                    <div className="absolute inset-0 bg-black/40" onClick={() => setMobileOpen(false)} />
                    <aside className="absolute inset-y-0 left-0 z-50 w-72 max-w-[80vw] border-r bg-white shadow-xl">
                        <div className="flex h-16 items-center gap-3 border-b px-3">
                            {header}
                            <button
                                className="ml-auto inline-flex h-8 w-8 items-center justify-center rounded-md hover:bg-gray-100"
                                onClick={() => setMobileOpen(false)}
                                aria-label="Fechar"
                            >
                                ✕
                            </button>
                        </div>
                        <div className="min-h-0 flex-1 overflow-y-auto">{children}</div>
                        {footer && <div className="border-t p-3">{footer}</div>}
                    </aside>
                </div>
            )}
        </>
    );
}

export function SidebarItem({ href, children, onClick }) {
    const pathname = usePathname();
    const isActive = pathname === href || (href !== "/" && pathname.startsWith(href));

    return (
        <Link
            href={href}
            onClick={onClick}
            className={`flex items-center gap-3 rounded-lg px-3 py-2 text-sm transition-colors ${
                isActive ? "bg-gray-100 font-medium text-gray-900" : "text-gray-800 hover:bg-gray-50"
            }`}
        >
            <span className="truncate">{children}</span>
        </Link>
    );
}
