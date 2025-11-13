"use client";
import { useState } from "react";
import Link from "next/link";

export default function LoginFormCard() {
    const [email, setEmail] = useState("");
    const [pw, setPw] = useState("");
    const [submitting, setSubmitting] = useState(false);
    const [tab, setTab] = useState("login"); // "login" | "demo"

    async function onSubmit(e) {
        e.preventDefault();
        setSubmitting(true);
        try {
            console.log("login:", { email, pw });
        } finally {
            setSubmitting(false);
        }
    }

    return (
        <div className="text-card-foreground flex flex-col gap-6 rounded-xl shadow-lg border-0 bg-white/70 backdrop-blur-sm">
            <div className="grid auto-rows-min grid-rows-[auto_auto] items-start gap-1.5 px-6 pt-6">
                <h4 className="text-2xl text-center">Iniciar Sessão</h4>
                <p className="text-muted-foreground text-center">Aceda à sua conta para gerir a sua prática</p>
            </div>

            <div className="px-6 w-full">
                <div className="bg-muted text-muted-foreground h-9 items-center justify-center rounded-xl p-[3px] grid w-full grid-cols-2 mb-4">
                    <button
                        type="button"
                        onClick={() => setTab("login")}
                        className={`inline-flex h-[calc(100%-1px)] items-center justify-center rounded-xl px-2 text-sm font-medium transition-[color,box-shadow] border ${
                            tab === "login" ? "bg-card text-foreground border-input" : "border-transparent"
                        }`}
                    >
                        Entrar
                    </button>
                    <button
                        type="button"
                        onClick={() => setTab("demo")}
                        className={`inline-flex h-[calc(100%-1px)] items-center justify-center rounded-xl px-2 text-sm font-medium transition-[color,box-shadow] border ${
                            tab === "demo" ? "bg-card text-foreground border-input" : "border-transparent"
                        }`}
                    >
                        Demo
                    </button>
                </div>

                {tab === "login" ? (
                    <form className="space-y-4" onSubmit={onSubmit}>
                        <div className="space-y-2">
                            <label htmlFor="email" className="text-sm font-medium">Email</label>
                            <input
                                id="email"
                                type="email"
                                className="file:text-foreground placeholder:text-muted-foreground selection:bg-primary selection:text-primary-foreground border-input flex h-9 w-full rounded-md border px-3 py-1 text-base bg-input-background outline-none md:text-sm focus-visible:border-ring focus-visible:ring-ring/50 focus-visible:ring-[3px]"
                                placeholder="seu@email.com"
                                value={email}
                                onChange={(e) => setEmail(e.target.value)}
                                required
                                autoComplete="email"
                            />
                        </div>

                        <div className="space-y-2">
                            <label htmlFor="password" className="text-sm font-medium">Palavra-passe</label>
                            <input
                                id="password"
                                type="password"
                                className="file:text-foreground placeholder:text-muted-foreground selection:bg-primary selection:text-primary-foreground border-input flex h-9 w-full rounded-md border px-3 py-1 text-base bg-input-background outline-none md:text-sm focus-visible:border-ring focus-visible:ring-ring/50 focus-visible:ring-[3px]"
                                placeholder="••••••••"
                                value={pw}
                                onChange={(e) => setPw(e.target.value)}
                                required
                                autoComplete="current-password"
                            />
                        </div>

                        <button
                            type="submit"
                            disabled={submitting}
                            className="inline-flex items-center justify-center gap-2 whitespace-nowrap rounded-md text-sm font-medium transition-all disabled:opacity-50 bg-primary text-primary-foreground hover:bg-primary/90 h-9 px-4 py-2 w-full"
                        >
                            <span>Entrar</span>
                            <svg className="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor">
                                <path d="M5 12h14" />
                                <path d="m12 5 7 7-7 7" />
                            </svg>
                        </button>

                        <p className="text-center text-sm text-muted-foreground">
                            Não tem conta?{" "}
                            <Link href="/registration" className="text-primary underline underline-offset-4">
                                Registar-me
                            </Link>
                        </p>
                    </form>
                ) : (
                    <div className="space-y-3 text-sm text-muted-foreground">
                        <p>Experimente a conta demo para explorar a plataforma.</p>
                        <ul className="list-disc pl-5 space-y-1">
                            <li>Dados fictícios de pacientes e consultas</li>
                            <li>Sem risco para informação real</li>
                            <li>Acesso limitado por tempo</li>
                        </ul>
                        <button
                            type="button"
                            className="inline-flex items-center justify-center gap-2 whitespace-nowrap rounded-md text-sm font-medium transition-all bg-primary text-primary-foreground hover:bg-primary/90 h-9 px-4 py-2 w-full"
                            onClick={() => console.log("entrar demo")}
                        >
                            Entrar em Demo
                        </button>
                    </div>
                )}
            </div>

            <div className="pb-6" />
        </div>
    );
}
