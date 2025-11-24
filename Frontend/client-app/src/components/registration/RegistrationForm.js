"use client";

import { useMemo, useState } from "react";
import PropTypes from "prop-types";
import { useRouter } from "next/navigation";
import { apiClient } from '@/lib/api';

export default function RegistrationForm({ onSubmit }) {
    const [form, setForm] = useState({
        name: "",
        email: "",
        password: "",
        confirmPassword: "",
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
    const [showPassword, setShowPassword] = useState(false);
    const [serverError, setServerError] = useState("");

    const router = useRouter();

    const errors = useMemo(() => {
        const e = {};

        if (!form.name.trim()) e.name = "Campo obrigatório.";

        if (!form.email.trim()) {
            e.email = "Campo obrigatório.";
        } else if (!/^\S+@\S+\.\S+$/.test(form.email)) {
            e.email = "Email inválido.";
        }

        if (!form.password) {
            e.password = "Campo obrigatório.";
        } else if (form.password.length < 6) {
            e.password = "A password deve ter pelo menos 6 caracteres.";
        }

        if (!form.confirmPassword) {
            e.confirmPassword = "Campo obrigatório.";
        } else if (form.password !== form.confirmPassword) {
            e.confirmPassword = "As passwords não coincidem.";
        }

        const phoneDigits = (form.phone || "").replace(/\D/g, "");
        if (!form.phone.trim()) {
            e.phone = "Campo obrigatório.";
        } else if (phoneDigits.length < 9) {
            e.phone = "Telefone inválido.";
        }

        if (form.age && form.age.trim() !== "") {
            const v = Number(form.age);
            if (isNaN(v) || v < 0 || v > 120) e.age = "Idade inválida.";
        }

        if (form.weight && form.weight.trim() !== "") {
            const v = Number(form.weight);
            if (isNaN(v) || v <= 0 || v > 500) e.weight = "Peso inválido.";
        }

        if (form.height && form.height.trim() !== "") {
            const v = Number(form.height);
            if (isNaN(v) || v <= 0 || v > 260) e.height = "Altura inválida.";
        }

        if (!form.terms) e.terms = "Tem de aceitar os termos.";

        return e;
    }, [form]);

    const canSubmit = useMemo(() => {
        const hasNoErrors = Object.keys(errors).length === 0;
        const requiredFieldsFilled =
            form.name.trim() !== "" &&
            form.email.trim() !== "" &&
            form.password.trim() !== "" &&
            form.confirmPassword.trim() !== "" &&
            form.phone.trim() !== "" &&
            form.terms === true;

        return hasNoErrors && requiredFieldsFilled;
    }, [errors, form]);

    function handleChange(e) {
        const { id, name, type, checked, value } = e.target;
        const key = id || name;
        setForm((f) => ({ ...f, [key]: type === "checkbox" ? checked : value }));
        if (serverError) setServerError("");
    }

    function handleBlur(e) {
        const key = e.target.id || e.target.name;
        setTouched((t) => ({ ...t, [key]: true }));
    }

    async function handleSubmit(e) {
        e.preventDefault();

        const allTouched = {
            name: true, email: true, password: true, confirmPassword: true, phone: true,
            age: true, gender: true, weight: true, height: true, goals: true, terms: true,
        };
        setTouched(allTouched);

        if (!canSubmit) {
            console.log("Não pode submeter - erros:", errors);
            return;
        }

        try {
            setSubmitting(true);
            setServerError("");

            const registrationData = {
                name: form.name,
                surname: "",
                email: form.email,
                password: form.password,
                phone_number: form.phone,
                age: form.age || null,
                gender: form.gender || null,
                weight: form.weight || null,
                height: form.height || null,
                goals: form.goals || null,
                client_since: new Date().toISOString().split('T')[0]
            };

            console.log("Enviando dados para /users:", registrationData);

            const response = await apiClient.post('/users', registrationData);

            console.log("User criado com sucesso:", response);

            alert("Conta criada com sucesso! Agora pode fazer login.");
            router.push('/login?message=registration_success');

        } catch (error) {
            console.error("Erro ao criar user:", error);

            if (error.message.includes("email") || error.message.includes("Email")) {
                setServerError("Este email já está em uso. Por favor use outro email.");
            } else if (error.message.includes("password")) {
                setServerError("Password inválida. Deve ter pelo menos 6 caracteres.");
            } else {
                setServerError(error.message || "Erro ao criar conta. Tente novamente.");
            }
        } finally {
            setSubmitting(false);
        }
    }

    const baseInput = "file:text-foreground placeholder:text-muted-foreground selection:bg-primary selection:text-primary-foreground border-input flex h-9 w-full min-w-0 rounded-md border px-3 py-1 text-base bg-input-background transition-[color,box-shadow] outline-none md:text-sm focus-visible:border-ring focus-visible:ring-ring/50 focus-visible:ring-[3px]";
    const labelCls = "flex items-center gap-2 text-sm leading-none font-medium select-none";
    const selectCls = "border-input focus-visible:border-ring focus-visible:ring-ring/50 flex w-full items-center justify-between gap-2 rounded-md border bg-input-background px-3 py-2 text-sm transition-[color,box-shadow] outline-none focus-visible:ring-[3px] h-9";

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
                {serverError && (
                    <div className="mb-4 p-4 bg-red-50 border border-red-200 rounded-md">
                        <div className="flex items-center">
                            <div className="flex-shrink-0">
                                <svg className="h-5 w-5 text-red-400" viewBox="0 0 20 20" fill="currentColor">
                                    <path fillRule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.28 7.22a.75.75 0 00-1.06 1.06L8.94 10l-1.72 1.72a.75.75 0 101.06 1.06L10 11.06l1.72 1.72a.75.75 0 101.06-1.06L11.06 10l1.72-1.72a.75.75 0 00-1.06-1.06L10 8.94 8.28 7.22z" clipRule="evenodd" />
                                </svg>
                            </div>
                            <div className="ml-3">
                                <h3 className="text-sm font-medium text-red-800">Erro</h3>
                                <div className="mt-1 text-sm text-red-700">{serverError}</div>
                            </div>
                        </div>
                    </div>
                )}

                {/* Debug info - remova em produção */}
                {process.env.NODE_ENV === 'development' && (
                    <div className="p-4 bg-blue-50 rounded-md text-xs mb-4 border border-blue-200">
                        <div className="font-semibold text-blue-800 mb-2">Debug Info:</div>
                        <div>Botão ativo: <span className={canSubmit ? "text-green-600 font-bold" : "text-red-600"}>{canSubmit ? "SIM" : "NÃO"}</span></div>
                        <div>Erros: <span className={Object.keys(errors).length === 0 ? "text-green-600" : "text-red-600"}>{Object.keys(errors).length === 0 ? "Nenhum" : Object.keys(errors).join(", ")}</span></div>
                        <div>API: POST /users</div>
                    </div>
                )}

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
                                className={`${baseInput} ${touched.name && errors.name ? "border-red-500 border-2" : ""}`}
                                placeholder="Seu nome completo"
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
                                <label htmlFor="email" className={labelCls}>Email *</label>
                                <input
                                    id="email"
                                    name="email"
                                    type="email"
                                    autoComplete="email"
                                    className={`${baseInput} ${touched.email && errors.email ? "border-red-500 border-2" : ""}`}
                                    placeholder="seu@email.com"
                                    value={form.email}
                                    onChange={handleChange}
                                    onBlur={handleBlur}
                                    required
                                />
                                {touched.email && errors.email && (
                                    <p className="text-xs text-red-600">{errors.email}</p>
                                )}
                            </div>

                            <div className="space-y-2">
                                <label htmlFor="phone" className={labelCls}>Telefone *</label>
                                <input
                                    id="phone"
                                    name="phone"
                                    type="tel"
                                    autoComplete="tel"
                                    className={`${baseInput} ${touched.phone && errors.phone ? "border-red-500 border-2" : ""}`}
                                    placeholder="+351 912 345 678"
                                    value={form.phone}
                                    onChange={handleChange}
                                    onBlur={handleBlur}
                                    required
                                />
                                {touched.phone && errors.phone && (
                                    <p className="text-xs text-red-600">{errors.phone}</p>
                                )}
                            </div>
                        </div>

                        <div className="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div className="space-y-2">
                                <label htmlFor="password" className={labelCls}>Password *</label>
                                <div className="relative">
                                    <input
                                        id="password"
                                        name="password"
                                        type={showPassword ? "text" : "password"}
                                        autoComplete="new-password"
                                        className={`${baseInput} pr-10 ${touched.password && errors.password ? "border-red-500 border-2" : ""}`}
                                        placeholder="Sua password"
                                        value={form.password}
                                        onChange={handleChange}
                                        onBlur={handleBlur}
                                        required
                                    />
                                    <button
                                        type="button"
                                        className="absolute right-3 top-1/2 transform -translate-y-1/2 text-gray-500 hover:text-gray-700"
                                        onClick={() => setShowPassword(!showPassword)}
                                    >
                                        {showPassword ? "🙈" : "👁️"}
                                    </button>
                                </div>
                                {touched.password && errors.password && (
                                    <p className="text-xs text-red-600">{errors.password}</p>
                                )}
                                <p className="text-xs text-gray-500 mt-1">
                                    Mínimo 6 caracteres
                                </p>
                            </div>

                            <div className="space-y-2">
                                <label htmlFor="confirmPassword" className={labelCls}>Confirmar Password *</label>
                                <input
                                    id="confirmPassword"
                                    name="confirmPassword"
                                    type={showPassword ? "text" : "password"}
                                    autoComplete="new-password"
                                    className={`${baseInput} ${touched.confirmPassword && errors.confirmPassword ? "border-red-500 border-2" : ""}`}
                                    placeholder="Repita a password"
                                    value={form.confirmPassword}
                                    onChange={handleChange}
                                    onBlur={handleBlur}
                                    required
                                />
                                {touched.confirmPassword && errors.confirmPassword && (
                                    <p className="text-xs text-red-600">{errors.confirmPassword}</p>
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
                                    className={`${baseInput} ${touched.age && errors.age ? "border-red-500 border-2" : ""}`}
                                    placeholder="35"
                                    value={form.age}
                                    onChange={handleChange}
                                    onBlur={handleBlur}
                                />
                                {touched.age && errors.age && (
                                    <p className="text-xs text-red-600">{errors.age}</p>
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
                                    className={`${baseInput} ${touched.weight && errors.weight ? "border-red-500 border-2" : ""}`}
                                    placeholder="70"
                                    value={form.weight}
                                    onChange={handleChange}
                                    onBlur={handleBlur}
                                />
                                {touched.weight && errors.weight && (
                                    <p className="text-xs text-red-600">{errors.weight}</p>
                                )}
                            </div>

                            <div className="space-y-2">
                                <label htmlFor="height" className={labelCls}>Altura (cm)</label>
                                <input
                                    id="height"
                                    name="height"
                                    type="number"
                                    className={`${baseInput} ${touched.height && errors.height ? "border-red-500 border-2" : ""}`}
                                    placeholder="170"
                                    value={form.height}
                                    onChange={handleChange}
                                    onBlur={handleBlur}
                                />
                                {touched.height && errors.height && (
                                    <p className="text-xs text-red-600">{errors.height}</p>
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
                                className="size-4 shrink-0 rounded-[4px] border bg-input-background focus-visible:ring-[3px] focus-visible:ring-ring/50 focus-visible:border-ring mt-1"
                                checked={form.terms}
                                onChange={handleChange}
                                onBlur={handleBlur}
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
                                    <p className="text-xs text-red-600 mt-1">{errors.terms}</p>
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
                        className={`inline-flex items-center justify-center gap-2 whitespace-nowrap text-sm font-medium transition-all h-10 rounded-md px-6 w-full ${
                            canSubmit && !submitting
                                ? "bg-green-600 text-white hover:bg-green-700"
                                : "bg-gray-400 text-gray-200 cursor-not-allowed"
                        }`}
                    >
                        {submitting ? (
                            <>
                                <div className="animate-spin rounded-full h-4 w-4 border-b-2 border-white mr-2"></div>
                                A criar conta...
                            </>
                        ) : (
                            "Criar Conta e Agendar Consulta Gratuita"
                        )}
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