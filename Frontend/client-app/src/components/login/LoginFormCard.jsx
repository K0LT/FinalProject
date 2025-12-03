"use client";

import { useState, useMemo } from "react";
import { useRouter } from "next/navigation";
import { login as loginUser } from "@/lib/authClient";

export default function LoginFormCard() {
    const router = useRouter();

    const [form, setForm] = useState({
        email: "",
        password: "",
        remember: false,
    });

    const [touched, setTouched] = useState({});
    const [submitting, setSubmitting] = useState(false);
    const [serverError, setServerError] = useState(null);

    const errors = useMemo(() => {
        const e = {};
        if (!form.email.trim()) {
            e.email = "Campo obrigatório.";
        } else if (!/^\S+@\S+\.\S+$/.test(form.email)) {
            e.email = "Email inválido.";
        }

        if (!form.password) {
            e.password = "Campo obrigatório.";
        }

        return e;
    }, [form]);

    const canSubmit = useMemo(
        () => Object.keys(errors).length === 0,
        [errors],
    );

    function handleChange(e) {
        const { name, type, checked, value } = e.target;
        setForm((f) => ({
            ...f,
            [name]: type === "checkbox" ? checked : value,
        }));
    }

    function handleBlur(e) {
        const { name } = e.target;
        setTouched((t) => ({ ...t, [name]: true }));
    }

    async function handleSubmit(e) {
        e.preventDefault();
        setTouched({ email: true, password: true });
        setServerError(null);

        if (!canSubmit) return;

        try {
            setSubmitting(true);

            await loginUser({
                email: form.email,
                password: form.password,
                remember: form.remember,
            });
            console.log("Login OK — redirecting to /appointments");

            router.push("/clientdashboard");
            router.refresh();
        } catch (err) {
            console.error(err);
            setServerError(err.message || "Falha ao iniciar sessão.");
        } finally {
            setSubmitting(false);
        }
    }

    const baseInput =
        "file:text-foreground placeholder:text-muted-foreground selection:bg-primary selection:text-primary-foreground border-input flex h-9 w-full min-w-0 rounded-md border px-3 py-1 text-base bg-input-background transition-[color,box-shadow] outline-none md:text-sm focus-visible:border-ring focus-visible:ring-ring/50 focus-visible:ring-[3px]";
    const labelCls =
        "flex items-center gap-2 text-sm leading-none font-medium select-none";

    return (
        <div
            data-slot="card"
            className="text-card-foreground flex flex-col gap-6 rounded-xl shadow-lg border-0 bg-white/70 backdrop-blur-sm"
        >
            <div
                data-slot="card-header"
                className="@container/card-header grid auto-rows-min grid-rows-[auto_auto] items-start gap-1.5 px-6 pt-6 has-data-[slot=card-action]:grid-cols-[1fr_auto] [.border-b]:pb-6"
            >
                <h4 data-slot="card-title" className="text-2xl text-center">
                    Iniciar Sessão
                </h4>
                <p
                    data-slot="card-description"
                    className="text-muted-foreground text-center"
                >
                    Aceda à sua conta para gerir a sua prática
                </p>
            </div>

            <div data-slot="card-content" className="px-6 [&:last-child]:pb-6">
                <form className="space-y-4" onSubmit={handleSubmit} noValidate>
                    {serverError && (
                        <p className="text-sm text-red-600 mb-2">
                            {serverError}
                        </p>
                    )}

                    <div className="space-y-2">
                        <label htmlFor="email" className={labelCls}>
                            Email
                        </label>
                        <input
                            id="email"
                            name="email"
                            type="email"
                            autoComplete="email"
                            className={`${baseInput} ${
                                touched.email && errors.email ? "border-destructive" : ""
                            }`}
                            placeholder="seu@email.com"
                            value={form.email}
                            onChange={handleChange}
                            onBlur={handleBlur}
                            aria-invalid={touched.email && !!errors.email}
                        />
                        {touched.email && errors.email && (
                            <p className="text-xs text-red-600">{errors.email}</p>
                        )}
                    </div>

                    <div className="space-y-2">
                        <label htmlFor="password" className={labelCls}>
                            Palavra-passe
                        </label>
                        <input
                            id="password"
                            name="password"
                            type="password"
                            autoComplete="current-password"
                            className={`${baseInput} ${
                                touched.password && errors.password
                                    ? "border-destructive"
                                    : ""
                            }`}
                            placeholder="••••••••"
                            value={form.password}
                            onChange={handleChange}
                            onBlur={handleBlur}
                            aria-invalid={touched.password && !!errors.password}
                        />
                        {touched.password && errors.password && (
                            <p className="text-xs text-red-600">{errors.password}</p>
                        )}
                    </div>

                    <div className="flex items-center justify-between text-xs">
                        <label className="flex items-center gap-2">
                            <input
                                type="checkbox"
                                name="remember"
                                checked={form.remember}
                                onChange={handleChange}
                                className="h-3 w-3 rounded border"
                            />
                            <span>Lembrar sessão neste dispositivo</span>
                        </label>
                    </div>

                    <button
                        data-slot="button"
                        type="submit"
                        disabled={!canSubmit || submitting}
                        className="inline-flex items-center justify-center gap-2 whitespace-nowrap rounded-md text-sm font-medium transition-all disabled:pointer-events-none disabled:opacity-50 bg-primary text-primary-foreground hover:bg-primary/90 h-9 px-4 py-2 has-[>svg]:px-3 w-full"
                    >
                        {submitting ? "A entrar..." : "Entrar"}
                    </button>
                </form>
            </div>
        </div>
    );
}
