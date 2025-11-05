import React from 'react';
import '../../../tailwind.css';
const WhyQiFlow = () => {
    return (
        <section className="py-20 bg-gray-50">
            <div className="container mx-auto px-4">
                <div className="text-center mb-16">
                    <h2 className="text-4xl mb-4">Por que escolher o QiFlow?</h2>
                    <p className="text-xl text-muted-foreground max-w-2xl mx-auto">
                        Metodologia única que combina tradição oriental com tecnologia moderna
                    </p>
                </div>
                <div className="flex flex-row gap-8 max-w-6xl mx-auto">

                    <div data-slot="card" className="text-card-foreground flex flex-col gap-6 rounded-xl text-center border-0 shadow-lg bg-white hover:shadow-xl transition-shadow">
                        <div data-slot="card-content" className="px-6 [&:last-child]:pb-6 pt-8 pb-6">
                            <div className="w-16 h-16 bg-primary/10 rounded-full flex items-center justify-center mx-auto mb-4">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" strokeWidth="2" strokeLinecap="round" strokeLinejoin="round" className="lucide lucide-target w-8 h-8 text-primary" aria-hidden="true">
                                    <circle cx="12" cy="12" r="10"></circle>
                                    <circle cx="12" cy="12" r="6"></circle>
                                    <circle cx="12" cy="12" r="2"></circle>
                                </svg>
                            </div>
                            <h3 className="text-lg mb-3">Acompanhamento Personalizado</h3>
                            <p className="text-muted-foreground text-sm">Planos de tratamento individualizados com foco na perda de peso sustentável</p>
                        </div>
                    </div>

                    <div data-slot="card" className="text-card-foreground flex flex-col gap-6 rounded-xl text-center border-0 shadow-lg bg-white hover:shadow-xl transition-shadow">
                        <div data-slot="card-content" className="px-6 [&:last-child]:pb-6 pt-8 pb-6">
                            <div className="w-16 h-16 bg-primary/10 rounded-full flex items-center justify-center mx-auto mb-4">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" strokeWidth="2" strokeLinecap="round" strokeLinejoin="round" className="lucide lucide-chart-column w-8 h-8 text-primary" aria-hidden="true">
                                    <path d="M3 3v16a2 2 0 0 0 2 2h16"></path>
                                    <path d="M18 17V9"></path>
                                    <path d="M13 17V5"></path>
                                    <path d="M8 17v-3"></path>
                                </svg>
                            </div>
                            <h3 className="text-lg mb-3">Análise Detalhada</h3>
                            <p className="text-muted-foreground text-sm">Monitorização completa da composição corporal e progresso semanal</p>
                        </div>
                    </div>

                    <div data-slot="card" className="text-card-foreground flex flex-col gap-6 rounded-xl text-center border-0 shadow-lg bg-white hover:shadow-xl transition-shadow">
                        <div data-slot="card-content" className="px-6 [&:last-child]:pb-6 pt-8 pb-6">
                            <div className="w-16 h-16 bg-primary/10 rounded-full flex items-center justify-center mx-auto mb-4">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" strokeWidth="2" strokeLinecap="round" strokeLinejoin="round" className="lucide lucide-users w-8 h-8 text-primary" aria-hidden="true">
                                    <path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"></path>
                                    <path d="M16 3.128a4 4 0 0 1 0 7.744"></path>
                                    <path d="M22 21v-2a4 4 0 0 0-3-3.87"></path>
                                    <circle cx="9" cy="7" r="4"></circle>
                                </svg>
                            </div>
                            <h3 className="text-lg mb-3">Experiência Comprovada</h3>
                            <p className="text-muted-foreground text-sm">Mais de 15 anos de experiência em medicina tradicional chinesa</p>
                        </div>
                    </div>

                    <div data-slot="card" className="text-card-foreground flex flex-col gap-6 rounded-xl text-center border-0 shadow-lg bg-white hover:shadow-xl transition-shadow">
                        <div data-slot="card-content" className="px-6 [&:last-child]:pb-6 pt-8 pb-6">
                            <div className="w-16 h-16 bg-primary/10 rounded-full flex items-center justify-center mx-auto mb-4">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" strokeWidth="2" strokeLinecap="round" strokeLinejoin="round" className="lucide lucide-award w-8 h-8 text-primary" aria-hidden="true">
                                    <path d="m15.477 12.89 1.515 8.526a.5.5 0 0 1-.81.47l-3.58-2.687a1 1 0 0 0-1.197 0l-3.586 2.686a.5.5 0 0 1-.81-.469l1.514-8.526"></path>
                                    <circle cx="12" cy="8" r="6"></circle>
                                </svg>
                            </div>
                            <h3 className="text-lg mb-3">Resultados Garantidos</h3>
                            <p className="text-muted-foreground text-sm">Metodologia testada com 95% de taxa de sucesso dos pacientes</p>
                        </div>
                    </div>

                </div>

            </div>

        </section>
    );
};

export default WhyQiFlow;
