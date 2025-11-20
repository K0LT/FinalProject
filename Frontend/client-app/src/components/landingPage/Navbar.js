"use client";

import React, { useEffect, useState } from "react";
import Link from "next/link";
import { logout } from "@/lib/authClient";

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
                        <div className="relative flex h-8 w-8 items-center justify-center" />

                        <div className="relative flex h-8 w-8 items-center justify-center">
                            <svg
                                viewBox="0 0 100 100"
                                className="h-full w-full"
                                xmlns="http://www.w3.org/2000/svg"
                            >
                                {/* Círculo exterior */}
                                <circle
                                    cx="50"
                                    cy="50"
                                    r="48"
                                    className="fill-[#B8860B] stroke-[#996F00] stroke-[2px] drop-shadow-lg"
                                />

                                {/* Gradiente radial */}
                                <defs>
                                    <radialGradient id="premiumGradient" cx="30%" cy="30%">
                                        <stop
                                            offset="0%"
                                            stopColor="#FFD700"
                                            stopOpacity="0.9"
                                        />
                                        <stop
                                            offset="100%"
                                            stopColor="#B8860B"
                                            stopOpacity="1"
                                        />
                                    </radialGradient>

                                    <pattern
                                        id="premium-pattern"
                                        x="0"
                                        y="0"
                                        width="6"
                                        height="6"
                                        patternUnits="userSpaceOnUse"
                                    >
                                        <circle
                                            cx="3"
                                            cy="3"
                                            r="0.4"
                                            className="fill-[#FFFACD]/30"
                                        />
                                    </pattern>
                                </defs>

                                {/* Disco dourado interior */}
                                <circle
                                    cx="50"
                                    cy="50"
                                    r="42"
                                    fill="url(#premiumGradient)"
                                />

                                {/* Textura */}
                                <circle
                                    cx="50"
                                    cy="50"
                                    r="38"
                                    fill="url(#premium-pattern)"
                                />

                                {/* Símbolo central */}
                                <g
                                    className="fill-white stroke-white"
                                    strokeWidth="1"
                                    strokeLinecap="round"
                                    strokeLinejoin="round"
                                >
                                    <path
                                        d="M 28 25 L 72 25"
                                        strokeWidth="2.5"
                                        opacity="0.95"
                                        fill="none"
                                    />
                                    <path
                                        d="M 50 25 L 50 75"
                                        strokeWidth="2"
                                        opacity="0.9"
                                        fill="none"
                                    />
                                    <path
                                        d="M 32 35 Q 38 40 32 45 Q 26 50 32 55"
                                        strokeWidth="2"
                                        opacity="0.85"
                                        fill="none"
                                    />
                                    <path
                                        d="M 68 35 Q 62 40 68 45 Q 74 50 68 55"
                                        strokeWidth="2"
                                        opacity="0.85"
                                        fill="none"
                                    />
                                    <path
                                        d="M 42 40 Q 50 35 58 40 Q 50 50 42 40"
                                        strokeWidth="1.8"
                                        opacity="0.8"
                                        fill="none"
                                    />
                                    <path
                                        d="M 35 65 L 65 65"
                                        strokeWidth="2"
                                        opacity="0.85"
                                        fill="none"
                                    />
                                    <circle cx="38" cy="32" r="1" opacity="0.9" />
                                    <circle cx="50" cy="30" r="1" opacity="0.9" />
                                    <circle cx="62" cy="32" r="1" opacity="0.9" />
                                </g>

                                {/* Aros exteriores */}
                                <circle
                                    cx="50"
                                    cy="50"
                                    r="47"
                                    className="stroke-[#FFD700]/70"
                                    fill="none"
                                    strokeWidth="0.8"
                                />
                                <circle
                                    cx="50"
                                    cy="50"
                                    r="44"
                                    className="stroke-[#FFFACD]/50"
                                    fill="none"
                                    strokeWidth="0.5"
                                />
                            </svg>
                        </div>

                        <div>
                            <h1 className="text-xl font-semibold text-primary">QiFlow</h1>
                            <p className="text-xs text-muted-foreground">Mestre José Machado</p>
                        </div>
                    </div>

                    {/* BOTÕES À DIREITA */}
                    <div className="flex items-center gap-3">
                        {!authenticated && (
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

                        {authenticated && (
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
