import React from 'react';
import '../../../tailwind.css'
const Navbar = () => {
    return (
        <header className="sticky top-0 z-50 border-b bg-white/90 backdrop-blur-sm">
            <div className="container mx-auto px-4 py-4">
                <div className="flex items-center justify-between">
                    <div className="flex items-center gap-3">
                        <div className="w-8 h-8 relative flex items-center justify-center">
                            <svg
                                viewBox="0 0 100 100"
                                className="w-full h-full"
                                xmlns="http://www.w3.org/2000/svg"
                            >
                                <circle
                                    cx="50"
                                    cy="50"
                                    r="48"
                                    fill="#B8860B"
                                    stroke="#996F00"
                                    strokeWidth="2"
                                    className="drop-shadow-lg"
                                />
                                <defs>
                                    <radialGradient id="premiumGradient" cx="30%" cy="30%">
                                        <stop offset="0%" stopColor="#FFD700" stopOpacity="0.9" />
                                        <stop offset="100%" stopColor="#B8860B" stopOpacity="1" />
                                    </radialGradient>
                                </defs>
                                <circle cx="50" cy="50" r="42" fill="url(#premiumGradient)" />
                                <pattern
                                    id="premium-pattern"
                                    x="0"
                                    y="0"
                                    width="6"
                                    height="6"
                                    patternUnits="userSpaceOnUse"
                                >
                                    <circle cx="3" cy="3" r="0.4" fill="#FFFACD" opacity="0.3" />
                                </pattern>
                                <circle cx="50" cy="50" r="38" fill="url(#premium-pattern)" />
                                <g fill="white" stroke="white" strokeWidth="1" strokeLinecap="round" strokeLinejoin="round">
                                    <path
                                        d="M 28 25 L 72 25"
                                        strokeWidth="2.5"
                                        opacity="0.95"
                                    />
                                    <path d="M 50 25 L 50 75" strokeWidth="2" opacity="0.9" />
                                    <path
                                        d="M 32 35 Q 38 40 32 45 Q 26 50 32 55"
                                        fill="none"
                                        strokeWidth="2"
                                        opacity="0.85"
                                    />
                                    <path
                                        d="M 68 35 Q 62 40 68 45 Q 74 50 68 55"
                                        fill="none"
                                        strokeWidth="2"
                                        opacity="0.85"
                                    />
                                    <path
                                        d="M 42 40 Q 50 35 58 40 Q 50 50 42 40"
                                        fill="none"
                                        strokeWidth="1.8"
                                        opacity="0.8"
                                    />
                                    <path d="M 35 65 L 65 65" strokeWidth="2" opacity="0.85" />
                                    <circle cx="38" cy="32" r="1" fill="white" opacity="0.9" />
                                    <circle cx="50" cy="30" r="1" fill="white" opacity="0.9" />
                                    <circle cx="62" cy="32" r="1" fill="white" opacity="0.9" />
                                </g>
                                <circle cx="50" cy="50" r="47" fill="none" stroke="#FFD700" strokeWidth="0.8" opacity="0.7" />
                                <circle cx="50" cy="50" r="44" fill="none" stroke="#FFFACD" strokeWidth="0.5" opacity="0.5" />
                            </svg>
                        </div>
                        <div>
                            <h1 className="text-xl text-primary">QiFlow</h1>
                            <p className="text-xs text-muted-foreground">Mestre José Machado</p>
                        </div>
                    </div>
                    <div className="flex items-center gap-3">
                        <button
                            data-slot="button"
                            className="inline-flex items-center justify-center gap-2 whitespace-nowrap rounded-md text-sm font-medium transition-all disabled:pointer-events-none disabled:opacity-50 [&_svg]:pointer-events-none [&_svg:not([class*='size-'])]:size-4 shrink-0 [&_svg]:shrink-0 outline-none focus-visible:border-ring focus-visible:ring-ring/50 focus-visible:ring-[3px] aria-invalid:ring-destructive/20 dark:aria-invalid:ring-destructive/40 aria-invalid:border-destructive border bg-background text-foreground hover:bg-accent hover:text-accent-foreground dark:bg-input/30 dark:border-input dark:hover:bg-input/50 h-9 px-4 py-2 has-[&_svg]:px-3"
                        >
                            Entrar
                        </button>
                        <button
                            data-slot="button"
                            className="inline-flex items-center justify-center gap-2 whitespace-nowrap rounded-md text-sm font-medium transition-all disabled:pointer-events-none disabled:opacity-50 [&_svg]:pointer-events-none [&_svg:not([class*='size-'])]:size-4 shrink-0 [&_svg]:shrink-0 outline-none focus-visible:border-ring focus-visible:ring-ring/50 focus-visible:ring-[3px] aria-invalid:ring-destructive/20 dark:aria-invalid:ring-destructive/40 aria-invalid:border-destructive bg-primary text-primary-foreground hover:bg-primary/90 h-9 px-4 py-2 has-[&_svg]:px-3"
                        >
                            Registar-me
                        </button>
                    </div>
                </div>
            </div>
        </header>
    );
};

export default Navbar;
