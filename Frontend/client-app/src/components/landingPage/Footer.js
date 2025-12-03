"use client";

import React from "react";
import { useRouter } from "next/navigation";
import { Phone, Mail } from "lucide-react";

const Footer = () => {
    const router = useRouter();

    return (
        <footer className="border-t bg-gray-50 py-12">
            <div className="container mx-auto px-4">
                <div className="flex flex-wrap justify-between gap-8 max-w-[auto] mx-auto">

                    <div className="flex-1 min-w-[300px] max-w-[320px]">
                        <div className="flex items-center gap-2 mb-4">
                            <div className="w-6 h-6 relative flex items-center justify-center">
                                <svg
                                    viewBox="0 0 100 100"
                                    className="w-full h-full"
                                    xmlns="http://www.w3.org/2000/svg"
                                >
                                    <circle cx="50" cy="50" r="48" fill="#B8860B" stroke="#996F00" strokeWidth="2" />
                                    <defs>
                                        <radialGradient id="premiumGradient" cx="30%" cy="30%">
                                            <stop offset="0%" stopColor="#FFD700" stopOpacity="0.9" />
                                            <stop offset="100%" stopColor="#B8860B" stopOpacity="1" />
                                        </radialGradient>
                                    </defs>
                                    <circle cx="50" cy="50" r="42" fill="url(#premiumGradient)" />
                                    <pattern id="premium-pattern" x="0" y="0" width="6" height="6" patternUnits="userSpaceOnUse">
                                        <circle cx="3" cy="3" r="0.4" fill="#FFFACD" opacity="0.3" />
                                    </pattern>
                                    <circle cx="50" cy="50" r="38" fill="url(#premium-pattern)" />
                                </svg>
                            </div>

                            <span className="text-lg font-normal">QiFlow</span>
                        </div>

                        <p className="text-sm text-muted-foreground">
                            Mestre José Machado — especializado em perda de peso através da medicina tradicional chinesa.
                        </p>
                    </div>

                    <div className="flex-1 min-w-[200px]">
                        <h4 className="mb-4 font-normal">Serviços</h4>
                        <div className="space-y-2 text-sm text-muted-foreground">
                            <div>Acupunctura para Perda de Peso</div>
                            <div>Medicina Tradicional Chinesa</div>
                            <div>Acompanhamento Nutricional</div>
                            <div>Coaching de Bem-estar</div>
                        </div>
                    </div>

                    <div className="flex-1 min-w-[200px]">
                        <h4 className="mb-4 font-normal">Contactos</h4>
                        <div className="space-y-2 text-sm text-muted-foreground">
                            <div className="flex items-center gap-2">
                                <Phone className="w-4 h-4" />
                                <span>+351 912 345 678</span>
                            </div>
                            <div className="flex items-center gap-2">
                                <Mail className="w-4 h-4" />
                                <span>jose@qiflow.pt</span>
                            </div>
                            <div>Segunda a Sexta: 9h–19h</div>
                            <div>Sábado: 9h–13h</div>
                        </div>
                    </div>

                    <div className="flex-1 min-w-[200px] text-left">
                        <h4 className="mb-4 font-normal">Ligações Rápidas</h4>
                        <div className="flex flex-col gap-2 text-sm text-muted-foreground">

                            <button
                                onClick={() => router.push("/booking")}
                                className="hover:underline underline-offset-4 text-left"
                            >
                                Marcar Consulta
                            </button>

                            <button
                                onClick={() => router.push("/registration")}
                                className="hover:underline underline-offset-4 text-left"
                            >
                                Registar-me
                            </button>

                            <button
                                onClick={() => router.push("/login")}
                                className="hover:underline underline-offset-4 text-left"
                            >
                                Área de Cliente
                            </button>
                        </div>
                    </div>
                </div>

                <div className="border-t mt-8 pt-8 text-center text-sm text-muted-foreground">
                    <p>© 2026 QiFlow. Todos os direitos reservados.</p>
                </div>
            </div>
        </footer>
    );
};

export default Footer;
