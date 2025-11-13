import React from "react";
import Link from "next/link";

const Navbar = () => {
    return (
        <header className="sticky top-0 z-50 border-b bg-white/90 backdrop-blur-sm">
            <div className="container mx-auto px-4 py-4">
                <div className="flex items-center justify-between">
                    <div className="flex items-center gap-3">
                        <div className="w-8 h-8 relative flex items-center justify-center" />
                        <div>
                            <h1 className="text-xl text-primary">QiFlow</h1>
                            <p className="text-xs text-muted-foreground">Mestre José Machado</p>
                        </div>
                    </div>

                    <div className="flex items-center gap-3">
                        <Link
                            href="/login"
                            className="inline-flex items-center justify-center gap-2 whitespace-nowrap rounded-md text-sm font-medium transition-all disabled:pointer-events-none disabled:opacity-50 [&_svg]:pointer-events-none [&_svg:not([class*='size-'])]:size-4 shrink-0 [&_svg]:shrink-0 outline-none focus-visible:border-ring focus-visible:ring-ring/50 focus-visible:ring-[3px] aria-invalid:ring-destructive/20 dark:aria-invalid:ring-destructive/40 aria-invalid:border-destructive border bg-background text-foreground hover:bg-accent hover:text-accent-foreground dark:bg-input/30 dark:border-input dark:hover:bg-input/50 h-9 px-4 py-2 has-[&_svg]:px-3"
                            prefetch
                            aria-label="Ir para a página de login"
                        >
                            Entrar
                        </Link>

                        <Link
                            href="/registration"
                            className="inline-flex items-center justify-center gap-2 whitespace-nowrap rounded-md text-sm font-medium transition-all disabled:pointer-events-none disabled:opacity-50 [&_svg]:pointer-events-none [&_svg:not([class*='size-'])]:size-4 shrink-0 [&_svg]:shrink-0 outline-none focus-visible:border-ring focus-visible:ring-ring/50 focus-visible:ring-[3px] aria-invalid:ring-destructive/20 dark:aria-invalid:ring-destructive/40 aria-invalid:border-destructive bg-primary text-primary-foreground hover:bg-primary/90 h-9 px-4 py-2 has-[&_svg]:px-3"
                            prefetch
                            aria-label="Ir para a página de registo"
                        >
                            Registar-me
                        </Link>
                    </div>
                </div>
            </div>
        </header>
    );
};

export default Navbar;
