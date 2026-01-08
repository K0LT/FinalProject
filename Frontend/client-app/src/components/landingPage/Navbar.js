"use client";

import React from "react";
import Link from "next/link";
import { useAuth } from "@/context/AuthContext";
import QiFlowBrand from "@/components/ui/QiFlowBrand";

export default function Navbar() {
    const { isAuthenticated, logout } = useAuth();

    const handleLogout = async () => {
        await logout();
        window.location.href = "/login";
    };

    return (
        <header className="sticky top-0 z-50 border-b bg-white/90 backdrop-blur-sm">
            <div className="container mx-auto px-4 py-4">
                <div className="flex items-center justify-between">
                   <QiFlowBrand />
                    <div className="flex items-center gap-3">
                        {!isAuthenticated && (
                            <>
                                <Link
                                    href="/login"
                                    className="inline-flex h-9 items-center justify-center gap-2 whitespace-nowrap rounded-md border bg-background px-4 py-2 text-sm font-medium text-foreground transition-all hover:bg-accent hover:text-accent-foreground"
                                >
                                    Entrar
                                </Link>

                                <Link
                                    href="/registration"
                                    className="inline-flex h-9 items-center justify-center gap-2 whitespace-nowrap rounded-md bg-primary px-4 py-2 text-sm font-medium text-primary-foreground transition-all hover:bg-primary/90"
                                >
                                    Registar-me
                                </Link>
                            </>
                        )}

                        {isAuthenticated && (
                            <>
                                <Link
                                    href="/dashboard"
                                    className="inline-flex h-9 items-center justify-center gap-2 whitespace-nowrap rounded-md border bg-background px-4 py-2 text-sm font-medium text-foreground transition-all hover:bg-accent hover:text-accent-foreground"
                                >
                                    Dashboard
                                </Link>

                                <button
                                    type="button"
                                    onClick={handleLogout}
                                    className="inline-flex h-9 items-center justify-center gap-2 whitespace-nowrap rounded-md bg-red-600 px-4 py-2 text-sm font-medium text-white transition-all hover:bg-red-700"
                                >
                                    Sair
                                </button>
                            </>
                        )}
                    </div>
                </div>
            </div>

        </header>
    );
}
