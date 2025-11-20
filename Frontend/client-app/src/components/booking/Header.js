"use client";

import React from "react";
import { useRouter } from "next/navigation";

export default function Header() {
    const router = useRouter();

    return (
        <header className="border-b bg-white/80 backdrop-blur-sm">
            <div className="container mx-auto px-4 py-4">
                <div className="flex items-center justify-between">

                    <button
                        onClick={() => router.push("/landingPage")}
                        className="flex items-center gap-2 h-9 px-4 py-2 text-sm font-medium rounded-md hover:bg-accent transition-all"
                    >
                        <svg
                            xmlns="http://www.w3.org/2000/svg"
                            className="w-4 h-4"
                            fill="none"
                            viewBox="0 0 24 24"
                            stroke="currentColor"
                            strokeWidth="2"
                        >
                            <path d="m12 19-7-7 7-7" />
                            <path d="M19 12H5" />
                        </svg>
                        Voltar
                    </button>


                    <div className="flex items-center gap-3">
                        <div className="relative w-8 h-8 flex items-center justify-center">
                            <svg viewBox="0 0 100 100" className="w-full h-full" xmlns="http://www.w3.org/2000/svg">
                                <circle cx="50" cy="50" r="48" fill="#B8860B" stroke="#996F00" strokeWidth="2"></circle>
                                <defs>
                                    <radialGradient id="premiumGradient" cx="30%" cy="30%">
                                        <stop offset="0%" stopColor="#FFD700" stopOpacity="0.9" />
                                        <stop offset="100%" stopColor="#B8860B" stopOpacity="1" />
                                    </radialGradient>
                                </defs>
                                <circle cx="50" cy="50" r="42" fill="url(#premiumGradient)"></circle>
                                <pattern id="premium-pattern" x="0" y="0" width="6" height="6" patternUnits="userSpaceOnUse">
                                    <circle cx="3" cy="3" r="0.4" fill="#FFFACD" opacity="0.3"></circle>
                                </pattern>
                                <circle cx="50" cy="50" r="38" fill="url(#premium-pattern)"></circle>

                                <g fill="white" stroke="white" strokeWidth="1" strokeLinecap="round" strokeLinejoin="round">
                                    <path d="M 28 25 L 72 25" strokeWidth="2.5" opacity="0.95"></path>
                                    <path d="M 50 25 L 50 75" strokeWidth="2" opacity="0.9"></path>
                                    <path d="M 32 35 Q 38 40 32 45 Q 26 50 32 55" fill="none" strokeWidth="2" opacity="0.85"></path>
                                    <path d="M 68 35 Q 62 40 68 45 Q 74 50 68 55" fill="none" strokeWidth="2" opacity="0.85"></path>
                                    <path d="M 42 40 Q 50 35 58 40 Q 50 50 42 40" fill="none" strokeWidth="1.8" opacity="0.8"></path>
                                    <path d="M 35 65 L 65 65" strokeWidth="2" opacity="0.85"></path>
                                    <circle cx="38" cy="32" r="1" fill="white" opacity="0.9"></circle>
                                    <circle cx="50" cy="30" r="1" fill="white" opacity="0.9"></circle>
                                    <circle cx="62" cy="32" r="1" fill="white" opacity="0.9"></circle>
                                </g>

                                <circle cx="50" cy="50" r="47" fill="none" stroke="#FFD700" strokeWidth="0.8" opacity="0.7"></circle>
                                <circle cx="50" cy="50" r="44" fill="none" stroke="#FFFACD" strokeWidth="0.5" opacity="0.5"></circle>
                            </svg>
                        </div>

                        <div>
                            <h1 className="text-xl text-primary">QiFlow</h1>
                            <p className="text-xs text-muted-foreground">Marcação de Consulta</p>
                        </div>
                    </div>

                    <div className="w-[100px]"></div>
                </div>
            </div>
        </header>
    );
}
