"use client";

import React from "react";
import { useRouter } from "next/navigation";

const Hero = () => {
    const router = useRouter();

    return (
        <section className="bg-gradient-to-r from-[#f9f2ea] to-white py-12 sm:py-16 text-center">
            <div className="mx-auto max-w-4xl px-4">
                {/* Badge */}
                <div className="mb-5 flex justify-center">
                    <span
                        data-slot="badge"
                        className="inline-flex max-w-full items-center justify-center gap-1 rounded-md border border-primary/20 bg-primary/10 px-2.5 py-1 text-[11px] sm:text-xs font-medium text-primary leading-tight"
                    >
                        <svg
                            xmlns="http://www.w3.org/2000/svg"
                            className="h-3 w-3"
                            viewBox="0 0 24 24"
                            fill="none"
                            stroke="currentColor"
                            strokeWidth="2"
                            strokeLinecap="round"
                            strokeLinejoin="round"
                            aria-hidden="true"
                        >
                            <path d="M11.525 2.295a.53.53 0 0 1 .95 0l2.31 4.679a2.123 2.123 0 0 0 1.595 1.16l5.166.756a.53.53 0 0 1 .294.904l-3.736 3.638a2.123 2.123 0 0 0-.611 1.878l.882 5.14a.53.53 0 0 1-.771.56l-4.618-2.428a2.122 2.122 0 0 0-1.973 0L6.396 21.01a.53.53 0 0 1-.77-.56l.881-5.139a2.122 2.122 0 0 0-.611-1.879L2.16 9.795a.53.53 0 0 1 .294-.906l5.165-.755a2.122 2.122 0 0 0 1.597-1.16z" />
                        </svg>
                        Método Inovador em Portugal - Medicina Tradicional Chinesa
                    </span>
                </div>

                <h1 className="mb-4 text-balance text-3xl sm:text-5xl font-normal leading-tight text-gray-900">
                    Perca Peso de Forma
                    <span className="text-primary"> Natural e Sustentável</span>
                </h1>

                <p className="mx-auto mb-8 max-w-2xl text-pretty text-base sm:text-xl text-muted-foreground">
                    Combine a sabedoria milenar da Medicina Tradicional Chinesa com tecnologia moderna.
                    Resultados comprovados em mais de 500 pacientes.
                </p>

                <div className="mb-10 flex flex-col sm:flex-row items-stretch sm:items-center justify-center gap-3 sm:gap-4">
                    <button
                        data-slot="button"
                        onClick={() => router.push("/booking")}
                        className="inline-flex w-full sm:w-auto items-center justify-center gap-2 whitespace-nowrap font-medium transition-all
                            disabled:pointer-events-none disabled:opacity-50
                            [&_svg]:pointer-events-none [&_svg:not([class*='size-'])]:size-4 [&_svg]:shrink-0
                            focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-primary/40
                            bg-primary text-primary-foreground hover:bg-primary/90
                            h-12 rounded-md text-base sm:text-lg px-5 sm:px-8"
                    >
                        <svg
                            xmlns="http://www.w3.org/2000/svg"
                            className="mr-2 h-5 w-5"
                            viewBox="0 0 24 24"
                            fill="none"
                            stroke="currentColor"
                            strokeWidth="2"
                            strokeLinecap="round"
                            strokeLinejoin="round"
                            aria-hidden="true"
                        >
                            <path d="M8 2v4" />
                            <path d="M16 2v4" />
                            <rect width="18" height="18" x="3" y="4" rx="2" />
                            <path d="M3 10h18" />
                        </svg>
                        Marcar Consulta Gratuita
                    </button>

                    {/* Botão: vai para /registration */}
                    <button
                        data-slot="button"
                        onClick={() => router.push("/registration")}
                        className="inline-flex w-full sm:w-auto items-center justify-center gap-2 whitespace-nowrap font-medium transition-all
                            disabled:pointer-events-none disabled:opacity-50
                            [&_svg]:pointer-events-none [&_svg:not([class*='size-'])]:size-4 [&_svg]:shrink-0
                            focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-primary/20
                            border bg-background text-foreground hover:bg-accent hover:text-accent-foreground
                            dark:bg-input/30 dark:border-input dark:hover:bg-input/50
                            h-12 rounded-md text-base sm:text-lg px-5 sm:px-8"
                    >
                        <svg
                            xmlns="http://www.w3.org/2000/svg"
                            className="mr-2 h-5 w-5"
                            viewBox="0 0 24 24"
                            fill="none"
                            stroke="currentColor"
                            strokeWidth="2"
                            strokeLinecap="round"
                            strokeLinejoin="round"
                            aria-hidden="true"
                        >
                            <path d="M2 9.5a5.5 5.5 0 0 1 9.591-3.676.56.56 0 0 0 .818 0A5.49 5.49 0 0 1 22 9.5c0 2.29-1.5 4-3 5.5l-5.492 5.313a2 2 0 0 1-3 .019L5 15c-1.5-1.5-3-3.2-3-5.5" />
                        </svg>
                        Quero Transformar-me
                    </button>
                </div>

                <div className="mb-0 grid grid-cols-3 gap-6 sm:gap-12">
                    <div className="text-center">
                        <div className="mb-1 text-2xl sm:text-3xl text-primary">500+</div>
                        <div className="text-xs sm:text-sm text-muted-foreground">Pacientes Transformados</div>
                    </div>
                    <div className="text-center">
                        <div className="mb-1 text-2xl sm:text-3xl text-primary">95%</div>
                        <div className="text-xs sm:text-sm text-muted-foreground">Taxa de Sucesso</div>
                    </div>
                    <div className="text-center">
                        <div className="mb-1 text-2xl sm:text-3xl text-primary">15+</div>
                        <div className="text-xs sm:text-sm text-muted-foreground">Anos de Experiência</div>
                    </div>
                </div>
            </div>
        </section>
    );
};

export default Hero;
