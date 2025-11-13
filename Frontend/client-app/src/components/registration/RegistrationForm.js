"use client";

import { useMemo, useState } from "react";
import PropTypes from "prop-types";

export default function RegistrationForm({ onSubmit }) {
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
    });
    const [touched, setTouched] = useState({});
    const [submitting, setSubmitting] = useState(false);

    const required = { name: true, email: true, phone: true };

    const errors = useMemo(() => {
        const e = {};
        if (required.name && !form.name.trim()) e.name = "Campo obrigatório.";
        if (required.email && !/^\S+@\S+\.\S+$/.test(form.email)) e.email = "Email inválido.";

        const phoneDigits = (form.phone || "").replace(/\D/g, "");
        if (required.phone && phoneDigits.length < 9) e.phone = "Telefone inválido.";

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

        if (!form.terms) e.terms = "Tem de aceitar os termos.";
        return e;
    }, [form]);

    const canSubmit = useMemo(() => Object.keys(errors).length === 0, [errors]);

    function handleChange(e) {
        const { id, name, type, checked, value } = e.target;
        const key = id || name;
        setForm((f) => ({ ...f, [key]: type === "checkbox" ? checked : value }));
    }

    function handleBlur(e) {
        const key = e.target.id || e.target.name;
        setTouched((t) => ({ ...t, [key]: true }));
    }

    async function handleSubmit(e) {
        e.preventDefault();
        setTouched({
            name: true, email: true, phone: true,
            age: true, gender: true, weight: true, height: true, goals: true, terms: true,
        });
        if (!canSubmit) return;

        try {
            setSubmitting(true);
            if (typeof onSubmit === "function") {
                await onSubmit(form);
            } else {
                console.log("RegistrationForm payload:", form);
            }
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
        <div
            data-slot="card"
            className="text-card-foreground flex flex-col gap-6 rounded-xl shadow-lg border-0 bg-white/70 backdrop-blur-sm"
        >

            <div
                data-slot="card-header"
                className="@container/card-header grid auto-rows-min grid-rows-[auto_auto] items-start gap-1.5 px-6 pt-6 has-data-[slot=card-action]:grid-cols-[1fr_auto] [.border-b]:pb-6"
            >
                <h4 data-slot="card-title" className="text-2xl">Criar Conta</h4>
                <p data-slot="card-description" className="text-muted-foreground">
                    Todos os dados são confidenciais e protegidos pelo RGPD
                </p>
            </div>


            <div data-slot="card-content" className="px-6 [&:last-child]:pb-6">
                <form className="space-y-6" onSubmit={handleSubmit} noValidate>

                    <div className="space-y-4">
                        <h3 className="text-lg">Informações Pessoais</h3>


                        <div className="space-y-2">
                            <label htmlFor="name" className={labelCls}>Nome Completo *</label>
                            <input
                                id="name"
                                name="name"
                                type="text"
                                autoComplete="name"
                                className={`${baseInput} ${touched.name && errors.name ? "border-destructive aria-invalid:border-destructive" : ""}`}
                                placeholder="Seu nome completo"
                                value={form.name}
                                onChange={handleChange}
                                onBlur={handleBlur}
                                required
                                aria-invalid={touched.name && !!errors.name}
                                aria-describedby={touched.name && errors.name ? "name-error" : undefined}
                            />
                            {touched.name && errors.name && (
                                <p id="name-error" className="text-xs text-red-600">{errors.name}</p>
                            )}
                        </div>

                        <div className="grid grid-cols-1 md:grid-cols-2 gap-4">

                            <div className="space-y-2">
                                <label htmlFor="email" className={labelCls}>Email *</label>
                                <input
                                    id="email"
                                    name="email"
                                    type="email"
                                    autoComplete="email"
                                    className={`${baseInput} ${touched.email && errors.email ? "border-destructive" : ""}`}
                                    placeholder="seu@email.com"
                                    value={form.email}
                                    onChange={handleChange}
                                    onBlur={handleBlur}
                                    required
                                    aria-invalid={touched.email && !!errors.email}
                                    aria-describedby={touched.email && errors.email ? "email-error" : undefined}
                                />
                                {touched.email && errors.email && (
                                    <p id="email-error" className="text-xs text-red-600">{errors.email}</p>
                                )}
                            </div>


                            <div className="space-y-2">
                                <label htmlFor="phone" className={labelCls}>Telefone *</label>
                                <input
                                    id="phone"
                                    name="phone"
                                    type="tel"
                                    autoComplete="tel"
                                    inputMode="tel"
                                    className={`${baseInput} ${touched.phone && errors.phone ? "border-destructive" : ""}`}
                                    placeholder="+351 912 345 678"
                                    value={form.phone}
                                    onChange={handleChange}
                                    onBlur={handleBlur}
                                    required
                                    aria-invalid={touched.phone && !!errors.phone}
                                    aria-describedby={touched.phone && errors.phone ? "phone-error" : undefined}
                                />
                                {touched.phone && errors.phone && (
                                    <p id="phone-error" className="text-xs text-red-600">{errors.phone}</p>
                                )}
                            </div>
                        </div>

                        <div className="grid grid-cols-1 md:grid-cols-2 gap-4">

                            <div className="space-y-2">
                                <label htmlFor="age" className={labelCls}>Idade</label>
                                <input
                                    id="age"
                                    name="age"
                                    type="number"
                                    inputMode="numeric"
                                    min="0"
                                    max="120"
                                    className={`${baseInput} ${touched.age && errors.age ? "border-destructive" : ""}`}
                                    placeholder="35"
                                    value={form.age}
                                    onChange={handleChange}
                                    onBlur={handleBlur}
                                    aria-invalid={touched.age && !!errors.age}
                                    aria-describedby={touched.age && errors.age ? "age-error" : undefined}
                                />
                                {touched.age && errors.age && (
                                    <p id="age-error" className="text-xs text-red-600">{errors.age}</p>
                                )}
                            </div>


                            <div className="space-y-2">
                                <label htmlFor="gender" className={labelCls}>Género</label>
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
                        <h3 className="text-lg">Informações de Saúde</h3>

                        <div className="grid grid-cols-1 md:grid-cols-2 gap-4">

                            <div className="space-y-2">
                                <label htmlFor="weight" className={labelCls}>Peso Atual (kg)</label>
                                <input
                                    id="weight"
                                    name="weight"
                                    type="number"
                                    inputMode="decimal"
                                    min="0"
                                    max="500"
                                    step="0.1"
                                    className={`${baseInput} ${touched.weight && errors.weight ? "border-destructive" : ""}`}
                                    placeholder="70"
                                    value={form.weight}
                                    onChange={handleChange}
                                    onBlur={handleBlur}
                                    aria-invalid={touched.weight && !!errors.weight}
                                    aria-describedby={touched.weight && errors.weight ? "weight-error" : undefined}
                                />
                                {touched.weight && errors.weight && (
                                    <p id="weight-error" className="text-xs text-red-600">{errors.weight}</p>
                                )}
                            </div>


                            <div className="space-y-2">
                                <label htmlFor="height" className={labelCls}>Altura (cm)</label>
                                <input
                                    id="height"
                                    name="height"
                                    type="number"
                                    inputMode="numeric"
                                    min="0"
                                    max="260"
                                    className={`${baseInput} ${touched.height && errors.height ? "border-destructive" : ""}`}
                                    placeholder="170"
                                    value={form.height}
                                    onChange={handleChange}
                                    onBlur={handleBlur}
                                    aria-invalid={touched.height && !!errors.height}
                                    aria-describedby={touched.height && errors.height ? "height-error" : undefined}
                                />
                                {touched.height && errors.height && (
                                    <p id="height-error" className="text-xs text-red-600">{errors.height}</p>
                                )}
                            </div>
                        </div>


                        <div className="space-y-2">
                            <label htmlFor="goals" className={labelCls}>Objetivos de Saúde</label>
                            <select
                                id="goals"
                                name="goals"
                                className={selectCls}
                                value={form.goals}
                                onChange={handleChange}
                                onBlur={handleBlur}
                            >
                                <option value="">Qual é o seu principal objetivo?</option>
                                <option value="weight-loss">Perda de Peso</option>
                                <option value="maintenance">Manutenção de Peso</option>
                                <option value="wellness">Bem-estar Geral</option>
                                <option value="pain-management">Gestão da Dor</option>
                                <option value="stress-relief">Alívio do Stress</option>
                                <option value="sleep-improvement">Melhoria do Sono</option>
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
                                aria-invalid={touched.terms && !!errors.terms}
                                aria-describedby={touched.terms && errors.terms ? "terms-error" : undefined}
                            />
                            <div className="text-sm leading-relaxed md:leading-normal">
                                <label
                                    htmlFor="terms"
                                    className="flex items-center gap-2 text-sm leading-relaxed md:leading-none font-medium select-none cursor-pointer"
                                >
                                    Aceito os
                                    <a href="/termos" className="text-primary underline underline-offset-4">
                                        Termos e Condições
                                    </a>
                                    e a
                                    <a href="/privacidade" className="text-primary underline underline-offset-4">
                                        Política de Privacidade
                                    </a>.
                                </label>

                                {touched.terms && errors.terms && (
                                    <p id="terms-error" className="text-xs text-red-600 mt-1">{errors.terms}</p>
                                )}
                                <p className="text-xs text-muted-foreground mt-1">
                                    Todos os dados são confidenciais e protegidos pelo RGPD.
                                </p>
                            </div>
                        </div>
                    </div>

                    <button
                        type="submit"
                        disabled={!canSubmit || submitting}
                        className="inline-flex items-center justify-center gap-2 whitespace-nowrap text-sm font-medium transition-all disabled:pointer-events-none disabled:opacity-50 bg-primary text-primary-foreground hover:bg-primary/90 h-10 rounded-md px-6 w-full"
                    >
                        {submitting ? "A enviar..." : "Criar Conta e Agendar Consulta Gratuita"}
                    </button>

                    <p className="text-center text-sm text-muted-foreground">
                        Já tem conta?{" "}
                        <a href="/login" className="text-primary underline underline-offset-4">
                            Entrar aqui
                        </a>
                    </p>
                </form>
            </div>
        </div>
    );
}

RegistrationForm.propTypes = {
    onSubmit: PropTypes.func,
};
