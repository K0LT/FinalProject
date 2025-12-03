"use client";

import { useMemo, useState } from "react";
import PropTypes from "prop-types";
import { register as registerUser } from "@/lib/authClient";


export default function RegistrationForm({ onSuccess }) {
    const [form, setForm] = useState({
        name: "",
        email: "",
        phone: "",
        age: "",
        gender: "",
        weight: "",
        height: "",
        goals: "",
        terms: false,
        password: "",
        password_confirmation: "",
    });

    const [touched, setTouched] = useState({});
    const [submitting, setSubmitting] = useState(false);
    const [serverError, setServerError] = useState(null);

    const required = {
        name: true,
        email: true,
        phone: true,
        password: true,
        password_confirmation: true,
        terms: true,
    };

    const errors = useMemo(() => {
        const e = {};

        if (required.name && !form.name.trim()) e.name = "Campo obrigatório.";

        if (required.email && !form.email.trim()) {
            e.email = "Campo obrigatório.";
        } else if (form.email && !/^\S+@\S+\.\S+$/.test(form.email)) {
            e.email = "Email inválido.";
        }

        const phoneDigits = form.phone.replace(/\D/g, "");
        if (required.phone && phoneDigits.length < 9) {
            e.phone = "Telefone inválido.";
        }

        if (form.age) {
            const v = Number(form.age);
            if (!Number.isFinite(v) || v < 0 || v > 120) e.age = "Idade inválida.";
        }

        if (form.weight) {
            const v = Number(form.weight);
            if (!Number.isFinite(v) || v <= 0 || v > 500) e.weight = "Peso inválido.";
        }

        if (form.height) {
            const v = Number(form.height);
            if (!Number.isFinite(v) || v <= 0 || v > 260) e.height = "Altura inválida.";
        }

        if (required.password && form.password.length < 8) {
            e.password = "A palavra-passe deve ter pelo menos 8 caracteres.";
        }

        if (
            required.password_confirmation &&
            form.password_confirmation !== form.password
        ) {
            e.password_confirmation = "As palavras-passe não coincidem.";
        }

        if (required.terms && !form.terms) {
            e.terms = "Tem de aceitar os termos.";
        }

        return e;
    }, [form]);

    const canSubmit = useMemo(
        () => Object.keys(errors).length === 0,
        [errors],
    );

    function handleChange(e) {
        const { id, name, type, checked, value } = e.target;
        const key = id || name;
        setForm((f) => ({
            ...f,
            [key]: type === "checkbox" ? checked : value,
        }));
    }

    function handleBlur(e) {
        const key = e.target.id || e.target.name;
        setTouched((t) => ({ ...t, [key]: true }));
    }

    async function handleSubmit(e) {
        e.preventDefault();
        setServerError(null);

        setTouched({
            name: true,
            email: true,
            phone: true,
            age: true,
            gender: true,
            weight: true,
            height: true,
            goals: true,
            terms: true,
            password: true,
            password_confirmation: true,
        });

        if (!canSubmit) return;

        try {
            setSubmitting(true);

            const payload = {
                name: form.name,
                email: form.email,
                password: form.password,
                password_confirmation: form.password_confirmation,
            };

            const user = await registerUser(payload);

            if (typeof onSuccess === "function") {
                onSuccess(user);
            }

            if (typeof window !== "undefined") {
                window.location.href = "/";
            }
        } catch (err) {
            console.error(err);
            setServerError(
                err.message || "Ocorreu um erro ao criar a sua conta.",
            );
        } finally {
            setSubmitting(false);
        }
    }

    const baseInput =
        "file:text-foreground placeholder:text-muted-foreground selection:bg-primary selection:text-primary-foreground border-input flex h-9 w-full min-w-0 rounded-md border px-3 py-1 text-base bg-input-background transition-[color,box-shadow] outline-none md:text-sm focus-visible:border-ring focus-visible:ring-ring/50 focus-visible:ring-[3px]";
    const labelCls =
        "flex items-center gap-2 text-sm leading-none font-medium select-none";
    const selectCls =
        "border-input focus-visible:border-ring focus-visible:ring-ring/50 flex w-full items-center justify-between gap-2 rounded-md border bg-input-background px-3 py-2 text-sm transition-[color,box-shadow] outline-none focus-visible:ring-[3px] h-9";

return (
        <form className="space-y-6" onSubmit={handleSubmit} noValidate>
            <div className="text-center mb-2">
                <h4 className="text-2xl">Criar Conta</h4>
                <p className="text-muted-foreground text-sm">
                    Todos os dados são confidenciais e protegidos pelo RGPD.
                </p>
            </div>

            {serverError && (
                <p className="text-sm text-red-600">{serverError}</p>
            )}

            <div className="space-y-4">
                <h3 className="text-lg">Informações Pessoais</h3>

                <div className="space-y-2">
                    <label htmlFor="name" className={labelCls}>
                        Nome Completo *
                    </label>
                    <input
                        id="name"
                        name="name"
                        type="text"
                        autoComplete="name"
                        className={`${baseInput} ${
                            touched.name && errors.name
                                ? "border-destructive"
                                : ""
                        }`}
                        placeholder="O seu nome completo"
                        value={form.name}
                        onChange={handleChange}
                        onBlur={handleBlur}
                        required
                    />
                    {touched.name && errors.name && (
                        <p className="text-xs text-red-600">{errors.name}</p>
                    )}
                </div>

                <div className="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div className="space-y-2">
                        <label htmlFor="email" className={labelCls}>
                            Email *
                        </label>
                        <input
                            id="email"
                            name="email"
                            type="email"
                            autoComplete="email"
                            className={`${baseInput} ${
                                touched.email && errors.email
                                    ? "border-destructive"
                                    : ""
                            }`}
                            placeholder="seu@email.com"
                            value={form.email}
                            onChange={handleChange}
                            onBlur={handleBlur}
                            required
                        />
                        {touched.email && errors.email && (
                            <p className="text-xs text-red-600">
                                {errors.email}
                            </p>
                        )}
                    </div>

                    <div className="space-y-2">
                        <label htmlFor="phone" className={labelCls}>
                            Telefone *
                        </label>
                        <input
                            id="phone"
                            name="phone"
                            type="tel"
                            autoComplete="tel"
                            inputMode="tel"
                            className={`${baseInput} ${
                                touched.phone && errors.phone
                                    ? "border-destructive"
                                    : ""
                            }`}
                            placeholder="+351 912 345 678"
                            value={form.phone}
                            onChange={handleChange}
                            onBlur={handleBlur}
                            required
                        />
                        {touched.phone && errors.phone && (
                            <p className="text-xs text-red-600">
                                {errors.phone}
                            </p>
                        )}
                    </div>
                </div>

                <div className="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div className="space-y-2">
                        <label htmlFor="age" className={labelCls}>
                            Idade
                        </label>
                        <input
                            id="age"
                            name="age"
                            type="number"
                            inputMode="numeric"
                            min="0"
                            max="120"
                            className={`${baseInput} ${
                                touched.age && errors.age
                                    ? "border-destructive"
                                    : ""
                            }`}
                            placeholder="35"
                            value={form.age}
                            onChange={handleChange}
                            onBlur={handleBlur}
                        />
                        {touched.age && errors.age && (
                            <p className="text-xs text-red-600">
                                {errors.age}
                            </p>
                        )}
                    </div>

                    <div className="space-y-2">
                        <label htmlFor="gender" className={labelCls}>
                            Género
                        </label>
                        <select
                            id="gender"
                            name="gender"
                            className={selectCls}
                            value={form.gender}
                            onChange={handleChange}
                            onBlur={handleBlur}
                        >
                            <option value="">Selecionar</option>
                            <option value="female">Feminino</option>
                            <option value="male">Masculino</option>
                            <option value="other">Outro</option>
                        </select>
                    </div>
                </div>
            </div>

            <div className="space-y-4">
                <h3 className="text-lg">Acesso à Plataforma</h3>

                <div className="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div className="space-y-2">
                        <label htmlFor="password" className={labelCls}>
                            Palavra-passe *
                        </label>
                        <input
                            id="password"
                            name="password"
                            type="password"
                            autoComplete="new-password"
                            className={`${baseInput} ${
                                touched.password && errors.password
                                    ? "border-destructive"
                                    : ""
                            }`}
                            placeholder="Mínimo 8 caracteres"
                            value={form.password}
                            onChange={handleChange}
                            onBlur={handleBlur}
                        />
                        {touched.password && errors.password && (
                            <p className="text-xs text-red-600">
                                {errors.password}
                            </p>
                        )}
                    </div>

                    <div className="space-y-2">
                        <label
                            htmlFor="password_confirmation"
                            className={labelCls}
                        >
                            Confirmar palavra-passe *
                        </label>
                        <input
                            id="password_confirmation"
                            name="password_confirmation"
                            type="password"
                            autoComplete="new-password"
                            className={`${baseInput} ${
                                touched.password_confirmation &&
                                errors.password_confirmation
                                    ? "border-destructive"
                                    : ""
                            }`}
                            placeholder="Repita a palavra-passe"
                            value={form.password_confirmation}
                            onChange={handleChange}
                            onBlur={handleBlur}
                        />
                        {touched.password_confirmation &&
                            errors.password_confirmation && (
                                <p className="text-xs text-red-600">
                                    {errors.password_confirmation}
                                </p>
                            )}
                    </div>
                </div>
            </div>

            <div className="space-y-4">
                <h3 className="text-lg">Informações de Saúde</h3>

                <div className="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div className="space-y-2">
                        <label htmlFor="weight" className={labelCls}>
                            Peso Atual (kg)
                        </label>
                        <input
                            id="weight"
                            name="weight"
                            type="number"
                            inputMode="decimal"
                            min="0"
                            max="500"
                            step="0.1"
                            className={`${baseInput} ${
                                touched.weight && errors.weight
                                    ? "border-destructive"
                                    : ""
                            }`}
                            placeholder="70"
                            value={form.weight}
                            onChange={handleChange}
                            onBlur={handleBlur}
                        />
                        {touched.weight && errors.weight && (
                            <p className="text-xs text-red-600">
                                {errors.weight}
                            </p>
                        )}
                    </div>

                    <div className="space-y-2">
                        <label htmlFor="height" className={labelCls}>
                            Altura (cm)
                        </label>
                        <input
                            id="height"
                            name="height"
                            type="number"
                            inputMode="numeric"
                            min="0"
                            max="260"
                            className={`${baseInput} ${
                                touched.height && errors.height
                                    ? "border-destructive"
                                    : ""
                            }`}
                            placeholder="170"
                            value={form.height}
                            onChange={handleChange}
                            onBlur={handleBlur}
                        />
                        {touched.height && errors.height && (
                            <p className="text-xs text-red-600">
                                {errors.height}
                            </p>
                        )}
                    </div>
                </div>

                <div className="space-y-2">
                    <label htmlFor="goals" className={labelCls}>
                        Objetivos de Saúde
                    </label>
                    <select
                        id="goals"
                        name="goals"
                        className={selectCls}
                        value={form.goals}
                        onChange={handleChange}
                        onBlur={handleBlur}
                    >
                        <option value="">
                            Qual é o seu principal objetivo?
                        </option>
                        <option value="weight-loss">Perda de Peso</option>
                        <option value="maintenance">Manutenção de Peso</option>
                        <option value="wellness">Bem-estar Geral</option>
                        <option value="pain-management">Gestão da Dor</option>
                        <option value="stress-relief">Alívio do Stress</option>
                        <option value="sleep-improvement">
                            Melhoria do Sono
                        </option>
                    </select>
                </div>
            </div>

            <div className="space-y-4">
                <div className="flex items-start gap-3">
                    <input
                        id="terms"
                        name="terms"
                        type="checkbox"
                        className="size-4 shrink-0 rounded-[4px] border bg-input-background focus-visible:ring-[3px] focus-visible:ring-ring/50 focus-visible:border-ring"
                        checked={form.terms}
                        onChange={handleChange}
                        onBlur={handleBlur}
                    />
                    <div className="text-sm">
                        <label
                            htmlFor="terms"
                            className={`${labelCls} cursor-pointer`}
                        >
                            Aceito os{" "}
                            <a
                                href="/termos"
                                className="text-primary underline underline-offset-4"
                            >
                                Termos e Condições
                            </a>{" "}
                            e a{" "}
                            <a
                                href="/privacidade"
                                className="text-primary underline underline-offset-4"
                            >
                                Política de Privacidade
                            </a>
                            .
                        </label>
                        {touched.terms && errors.terms && (
                            <p className="text-xs text-red-600 mt-1">
                                {errors.terms}
                            </p>
                        )}
                        <p className="text-xs text-muted-foreground mt-1">
                            Todos os dados são confidenciais e protegidos pelo
                            RGPD.
                        </p>
                    </div>
                </div>
            </div>

            <button
                type="submit"
                disabled={!canSubmit || submitting}
                className="inline-flex items-center justify-center gap-2 whitespace-nowrap text-sm font-medium transition-all disabled:pointer-events-none disabled:opacity-50 bg-primary text-primary-foreground hover:bg-primary/90 h-10 rounded-md px-6 w-full"
            >
                {submitting
                    ? "A criar conta..."
                    : "Criar Conta e Agendar Consulta Gratuita"}
            </button>

            <p className="text-center text-sm text-muted-foreground">
                Já tem conta?{" "}
                <a
                    href="/login"
                    className="text-primary underline underline-offset-4"
                >
                    Entrar aqui
                </a>
            </p>
        </form>
    );
}

RegistrationForm.propTypes = {
    onSuccess: PropTypes.func,
};
