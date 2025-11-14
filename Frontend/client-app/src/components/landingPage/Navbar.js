"use client";

import React, { useEffect, useState } from "react";
import Link from "next/link";
import { logout } from "@/lib/authClient"; // helper para logout

export default function Navbar() {
    const [authenticated, setAuthenticated] = useState(false);

    useEffect(() => {
        const token = document.cookie
            .split("; ")
            .find((row) => row.startsWith("auth-token="));

        setAuthenticated(!!token);
    }, []);

    const handleLogout = async () => {
        await logout();
        setAuthenticated(false);
        window.location.href = "/login";
    };

    return (
        <header className="sticky top-0 z-50 border-b bg-white/90 backdrop-blur-sm">
            <div className="container mx-auto px-4 py-4">
                <div className="flex items-center justify-between">

                    {/* LOGO */}
                    <div className="flex items-center gap-3">
                        <div className="w-8 h-8 relative flex items-center justify-center" />
                        <div>
                            <h1 className="text-xl text-primary">QiFlow</h1>
                            <p className="text-xs text-muted-foreground">Mestre José Machado</p>
                        </div>
                    </div>

                    {/* BOTÕES À DIREITA */}
                    <div className="flex items-center gap-3">

                        {!authenticated && (
                            <>
                                <Link
                                    href="/login"
                                    className="inline-flex items-center justify-center gap-2 whitespace-nowrap rounded-md text-sm font-medium transition-all border bg-background text-foreground hover:bg-accent hover:text-accent-foreground h-9 px-4 py-2"
                                >
                                    Entrar
                                </Link>

                                <Link
                                    href="/registration"
                                    className="inline-flex items-center justify-center gap-2 whitespace-nowrap rounded-md text-sm font-medium transition-all bg-primary text-primary-foreground hover:bg-primary/90 h-9 px-4 py-2"
                                >
                                    Registar-me
                                </Link>
                            </>
                        )}

                        {authenticated && (
                            <>
                                <Link
                                    href="/dashboard"
                                    className="inline-flex items-center justify-center gap-2 whitespace-nowrap rounded-md text-sm font-medium transition-all border bg-background text-foreground hover:bg-accent hover:text-accent-foreground h-9 px-4 py-2"
                                >
                                    Dashboard
                                </Link>

                                <button
                                    onClick={handleLogout}
                                    className="inline-flex items-center justify-center gap-2 whitespace-nowrap rounded-md text-sm font-medium transition-all bg-red-600 text-white hover:bg-red-700 h-9 px-4 py-2"
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
