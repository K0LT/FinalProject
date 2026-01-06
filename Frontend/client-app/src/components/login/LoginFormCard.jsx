'use client';

import { useState, useEffect } from 'react';
import { useAuth } from '@/context/AuthContext';
import { useRouter, useSearchParams } from 'next/navigation';
import Link from 'next/link';

export const LoginFormCard = () => {
    const [email, setEmail] = useState('');
    const [password, setPassword] = useState('');
    const [isLoading, setIsLoading] = useState(false);
    const [tab, setTab] = useState('login');

    const { login, error, clearError, isAuthenticated } = useAuth();
    const router = useRouter();
    const searchParams = useSearchParams();
    const redirect = searchParams.get('redirect') || '/dashboard';

    // Clear errors on mount (defensive check from LoginForm.js)
    useEffect(() => {
        if (clearError && typeof clearError === 'function') {
            clearError();
        }
    }, [clearError]);

    // Redirect if already authenticated (from LoginForm.js)
    useEffect(() => {
        if (isAuthenticated) {
            router.push(redirect);
        }
    }, [isAuthenticated, router, redirect]);

    const handleSubmit = async (e) => {
        e.preventDefault();

        // Prevent duplicate submission if already authenticated
        if (isAuthenticated) {
            router.push(redirect);
            return;
        }

        setIsLoading(true);
        if (clearError && typeof clearError === 'function') {
            clearError();
        }

        try {
            await login({ email, password });
            // Note: redirect happens via useEffect above after state updates
        } catch (err) {
            console.error('Erro no login:', err);
            // Error is handled by AuthContext state
        } finally {
            setIsLoading(false);
        }
    };

    // Show loading state if authenticated (navigating)
    if (isAuthenticated) {
        return (
            <div className="flex items-center justify-center p-8">
                <div className="animate-spin rounded-full h-8 w-8 border-b-2 border-blue-600"></div>
            </div>
        );
    }

    return (
        <div className="text-card-foreground flex flex-col gap-6 rounded-xl shadow-lg border-0 bg-white/70 backdrop-blur-sm">
            <div className="grid auto-rows-min grid-rows-[auto_auto] items-start gap-1.5 px-6 pt-6">
                <h4 className="text-2xl text-center">Iniciar Sessão</h4>
                <p className="text-muted-foreground text-center">Aceda à sua conta para gerir a sua prática</p>
            </div>

            <div className="px-6 w-full">
                {/* Tab Switcher */}
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
                    <form className="space-y-4" onSubmit={handleSubmit}>
                        {/* Error Display (enhanced from LoginForm.js) */}
                        {error && (
                            <div className="rounded-md bg-red-50 p-4 border border-red-200">
                                <div className="flex">
                                    <div className="flex-shrink-0">
                                        <svg className="h-5 w-5 text-red-400" viewBox="0 0 20 20" fill="currentColor">
                                            <path fillRule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.28 7.22a.75.75 0 00-1.06 1.06L8.94 10l-1.72 1.72a.75.75 0 101.06 1.06L10 11.06l1.72 1.72a.75.75 0 101.06-1.06L11.06 10l1.72-1.72a.75.75 0 00-1.06-1.06L10 8.94 8.28 7.22z" clipRule="evenodd" />
                                        </svg>
                                    </div>
                                    <div className="ml-3">
                                        <h3 className="text-sm font-medium text-red-800">Erro</h3>
                                        <div className="mt-1 text-sm text-red-700">{error}</div>
                                    </div>
                                </div>
                            </div>
                        )}

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
                                disabled={isLoading}
                            />
                        </div>

                        <div className="space-y-2">
                            <label htmlFor="password" className="text-sm font-medium">Palavra-passe</label>
                            <input
                                id="password"
                                type="password"
                                className="file:text-foreground placeholder:text-muted-foreground selection:bg-primary selection:text-primary-foreground border-input flex h-9 w-full rounded-md border px-3 py-1 text-base bg-input-background outline-none md:text-sm focus-visible:border-ring focus-visible:ring-ring/50 focus-visible:ring-[3px]"
                                placeholder="••••••••"
                                value={password}
                                onChange={(e) => setPassword(e.target.value)}
                                required
                                autoComplete="current-password"
                                disabled={isLoading}
                            />
                        </div>

                        <button
                            type="submit"
                            disabled={isLoading || isAuthenticated}
                            className="inline-flex items-center justify-center gap-2 whitespace-nowrap rounded-md text-sm font-medium transition-all disabled:opacity-50 disabled:cursor-not-allowed bg-primary text-primary-foreground hover:bg-primary/90 h-9 px-4 py-2 w-full"
                        >
                            {isLoading ? (
                                <>
                                    <div className="animate-spin rounded-full h-4 w-4 border-b-2 border-white"></div>
                                    <span>A entrar...</span>
                                </>
                            ) : (
                                <>
                                    <span>Entrar</span>
                                    <svg className="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor">
                                        <path d="M5 12h14" />
                                        <path d="m12 5 7 7-7 7" />
                                    </svg>
                                </>
                            )}
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
                            onClick={() => {
                                // Enable dev mode and reload
                                localStorage.setItem('dev_auto_login', 'true');
                                window.location.reload();
                            }}
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
