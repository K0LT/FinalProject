"use client";

import React from "react";
import { useRouter } from "next/navigation";
import { Calendar, Heart, Shield, Clock, CircleCheckBig } from "lucide-react";

const ReadyToStart = () => {
    const router = useRouter();

    return (
        <section className="py-20 bg-primary text-white">
            <div className="container mx-auto px-4 text-center">
                <div className="max-w-3xl mx-auto">
                    <h2 className="text-3xl lg:text-4xl mb-4 font-semibold">
                        Pronto para Começar a sua Transformação?
                    </h2>

                    <p className="text-lg lg:text-xl mb-8 opacity-90">
                        Marque a sua consulta gratuita e descubra como pode alcançar os seus
                        objetivos de forma natural
                    </p>

                    <div className="flex flex-col sm:flex-row gap-4 justify-center mb-8">
                        <button
                            onClick={() => router.push("/booking")}
                            className="inline-flex items-center justify-center gap-2 whitespace-nowrap font-medium transition-all bg-secondary text-secondary-foreground hover:bg-secondary/80 h-10 rounded-md text-base lg:text-lg px-6 lg:px-8"
                        >
                            <Calendar className="w-5 h-5 mr-2" />
                            Marcar Consulta Gratuita
                        </button>

                        <button
                            onClick={() => router.push("/registration")}
                            className="inline-flex items-center justify-center gap-2 whitespace-nowrap font-medium transition-all border border-white text-white hover:bg-white hover:text-[#b8860b] h-10 rounded-md text-base lg:text-lg px-6 lg:px-8"
                        >
                            <Heart className="w-5 h-5 mr-2" />
                            Registar-me Agora
                        </button>
                    </div>

                    <div className="flex flex-wrap items-center justify-center gap-4 lg:gap-6 text-sm opacity-80 max-w-[1000px] mx-auto">
                        <div className="flex items-center gap-2">
                            <Shield className="w-4 h-4" />
                            <span>Dados 100% seguros</span>
                        </div>
                        <div className="flex items-center gap-2">
                            <Clock className="w-4 h-4" />
                            <span>Resposta em 24h</span>
                        </div>
                        <div className="flex items-center gap-2">
                            <CircleCheckBig className="w-4 h-4" />
                            <span>Sem compromisso</span>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    );
};

export default ReadyToStart;
