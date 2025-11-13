import React from "react";
import { Zap, ArrowRight, CircleCheckBig, Calendar } from "lucide-react";

const Plans = () => {
    return (
        <section className="py-20 bg-white">
            <div className="container mx-auto px-4">
                <div className="text-center mb-16">
                    <span
                        data-slot="badge"
                        className="inline-flex items-center justify-center rounded-md border px-2 py-0.5 text-xs font-medium w-fit whitespace-nowrap shrink-0 gap-1 mb-4 bg-primary/10 text-primary border-primary/20"
                    >
                        <Zap className="w-3 h-3 mr-1" aria-hidden="true" />
                        Planos de Tratamento
                    </span>
                    <h2 className="text-4xl mb-4">Escolha o seu plano ideal</h2>
                    <p className="text-xl text-muted-foreground max-w-2xl mx-auto">
                        Opções flexíveis para todos os objetivos e orçamentos
                    </p>
                </div>
                {/* Responsive flex: Stack vertically on mobile, row on medium+ */}
                <div className="flex flex-col md:flex-row justify-center mx-auto max-w-[1000px] w-full gap-6 md:gap-0">
                    <div className="w-full md:w-1/3 bg-card text-card-foreground flex flex-col gap-6 rounded-xl border border-gray-200 p-6 shadow-sm hover:shadow-md transition-all">
                        <h4 className="text-2xl text-center">Consulta Individual</h4>
                        <div className="text-center mt-2">
                            <span className="text-4xl text-primary">80€</span>
                            <span className="text-muted-foreground"> /por consulta</span>
                        </div>
                        <p className="text-muted-foreground text-center">
                            Perfeito para quem quer experimentar
                        </p>

                        <div className="mt-4 space-y-3">
                            {[
                                "Consulta de 90 minutos",
                                "Avaliação completa MTC",
                                "Plano nutricional básico",
                                "Sessão de acupunctura",
                                "Relatório de progresso",
                            ].map((item) => (
                                <div key={item} className="flex items-center gap-3">
                                    <CircleCheckBig className="w-5 h-5 text-primary" />
                                    <span className="text-sm">{item}</span>
                                </div>
                            ))}
                        </div>
                        <button className="mt-auto inline-flex items-center justify-center gap-2 w-full border rounded-md text-sm font-medium px-4 py-2 hover:bg-accent hover:text-accent-foreground transition-all">
                            Saber Mais
                            <ArrowRight className="w-4 h-4 ml-2" />
                        </button>
                    </div>
                    <div className="w-full md:w-1/3 bg-card text-card-foreground flex flex-col gap-6 rounded-xl border border-primary shadow-2xl relative p-6 md:scale-105">
                        <span className="absolute -top-3 left-1/2 -translate-x-1/2 inline-flex items-center justify-center rounded-md border px-2 py-0.5 text-xs font-medium bg-primary text-white">
                            Mais Popular
                        </span>

                        <h4 className="text-2xl text-center">Plano Transformação</h4>
                        <div className="text-center mt-2">
                            <span className="text-4xl text-primary">280€</span>
                            <span className="text-muted-foreground"> /por mês</span>
                        </div>
                        <p className="text-muted-foreground text-center">
                            Mais popular para resultados sustentáveis
                        </p>

                        <div className="mt-4 space-y-3">
                            {[
                                "4 consultas mensais",
                                "Acompanhamento semanal",
                                "Plano nutricional personalizado",
                                "Prescrição de exercícios",
                                "Suporte via WhatsApp",
                                "Análise composição corporal",
                                "Relatórios mensais detalhados",
                            ].map((item) => (
                                <div key={item} className="flex items-center gap-3">
                                    <CircleCheckBig className="w-5 h-5 text-primary" />
                                    <span className="text-sm">{item}</span>
                                </div>
                            ))}
                        </div>
                        <button className="mt-auto inline-flex items-center justify-center gap-2 w-full bg-primary text-primary-foreground hover:bg-primary/90 rounded-md text-sm font-medium px-4 py-2 transition-all">
                            Começar Agora
                            <ArrowRight className="w-4 h-4 ml-2" />
                        </button>
                    </div>

                    <div className="w-full md:w-1/3 bg-card text-card-foreground flex flex-col gap-6 rounded-xl border border-gray-200 p-6 shadow-sm hover:shadow-md transition-all">
                        <h4 className="text-2xl text-center">Programa Completo</h4>
                        <div className="text-center mt-2">
                            <span className="text-4xl text-primary">720€</span>
                            <span className="text-muted-foreground"> /3 meses</span>
                        </div>
                        <p className="text-muted-foreground text-center">
                            Transformação completa garantida
                        </p>

                        <div className="mt-4 space-y-3">
                            {[
                                "Tudo do Plano Transformação",
                                "12 consultas em 3 meses",
                                "Sessões de coaching",
                                "Plano de manutenção",
                                "Garantia de resultados*",
                                "Acompanhamento pós-tratamento",
                                "Programa VIP prioritário",
                            ].map((item) => (
                                <div key={item} className="flex items-center gap-3">
                                    <CircleCheckBig className="w-5 h-5 text-primary" />
                                    <span className="text-sm">{item}</span>
                                </div>
                            ))}
                        </div>

                        <button className="mt-auto inline-flex items-center justify-center gap-2 w-full border rounded-md text-sm font-medium px-4 py-2 hover:bg-accent hover:text-accent-foreground transition-all">
                            Saber Mais
                            <ArrowRight className="w-4 h-4 ml-2" />
                        </button>
                    </div>
                </div>

                <div className="text-center mt-12">
                    <p className="text-sm text-muted-foreground mb-4">
                        * Garantia válida mediante cumprimento do plano de tratamento
                    </p>
                    <button className="inline-flex items-center justify-center gap-2 text-sm font-medium bg-primary text-primary-foreground hover:bg-primary/90 h-10 rounded-md px-6 transition-all">
                        <Calendar className="w-4 h-4 mr-2" />
                        Marcar Consulta Gratuita de Avaliação
                    </button>
                </div>
            </div>
        </section>
    );
};

export default Plans;
