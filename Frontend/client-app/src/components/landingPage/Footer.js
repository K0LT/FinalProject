import React from "react";
import { Phone, Mail } from "lucide-react";

const Footer = () => {
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
                                    <circle
                                        cx="50"
                                        cy="50"
                                        r="48"
                                        fill="#B8860B"
                                        stroke="#996F00"
                                        strokeWidth="2"
                                        className="drop-shadow-lg"
                                    ></circle>
                                    <defs>
                                        <radialGradient id="premiumGradient" cx="30%" cy="30%">
                                            <stop offset="0%" stopColor="#FFD700" stopOpacity="0.9" />
                                            <stop offset="100%" stopColor="#B8860B" stopOpacity="1" />
                                        </radialGradient>
                                    </defs>
                                    <circle cx="50" cy="50" r="42" fill="url(#premiumGradient)" />
                                    <pattern
                                        id="premium-pattern"
                                        x="0"
                                        y="0"
                                        width="6"
                                        height="6"
                                        patternUnits="userSpaceOnUse"
                                    >
                                        <circle
                                            cx="3"
                                            cy="3"
                                            r="0.4"
                                            fill="#FFFACD"
                                            opacity="0.3"
                                        ></circle>
                                    </pattern>
                                    <circle cx="50" cy="50" r="38" fill="url(#premium-pattern)" />
                                    <g
                                        fill="white"
                                        stroke="white"
                                        strokeWidth="1"
                                        strokeLinecap="round"
                                        strokeLinejoin="round"
                                    >
                                        <path
                                            d="M 28 25 L 72 25"
                                            strokeWidth="2.5"
                                            opacity="0.95"
                                        ></path>
                                        <path
                                            d="M 50 25 L 50 75"
                                            strokeWidth="2"
                                            opacity="0.9"
                                        ></path>
                                        <path
                                            d="M 32 35 Q 38 40 32 45 Q 26 50 32 55"
                                            fill="none"
                                            strokeWidth="2"
                                            opacity="0.85"
                                        ></path>
                                        <path
                                            d="M 68 35 Q 62 40 68 45 Q 74 50 68 55"
                                            fill="none"
                                            strokeWidth="2"
                                            opacity="0.85"
                                        ></path>
                                        <path
                                            d="M 42 40 Q 50 35 58 40 Q 50 50 42 40"
                                            fill="none"
                                            strokeWidth="1.8"
                                            opacity="0.8"
                                        ></path>
                                        <path
                                            d="M 35 65 L 65 65"
                                            strokeWidth="2"
                                            opacity="0.85"
                                        ></path>
                                        <circle
                                            cx="38"
                                            cy="32"
                                            r="1"
                                            fill="white"
                                            opacity="0.9"
                                        ></circle>
                                        <circle
                                            cx="50"
                                            cy="30"
                                            r="1"
                                            fill="white"
                                            opacity="0.9"
                                        ></circle>
                                        <circle
                                            cx="62"
                                            cy="32"
                                            r="1"
                                            fill="white"
                                            opacity="0.9"
                                        ></circle>
                                    </g>
                                    <circle
                                        cx="50"
                                        cy="50"
                                        r="47"
                                        fill="none"
                                        stroke="#FFD700"
                                        strokeWidth="0.8"
                                        opacity="0.7"
                                    ></circle>
                                    <circle
                                        cx="50"
                                        cy="50"
                                        r="44"
                                        fill="none"
                                        stroke="#FFFACD"
                                        strokeWidth="0.5"
                                        opacity="0.5"
                                    ></circle>
                                </svg>
                            </div>
                            <span className="text-lg font-normal">QiFlow</span>
                        </div>
                        <p className="text-sm text-muted-foreground">
                            Mestre José Machado — especializado em perda de peso através da
                            medicina tradicional chinesa.
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
                            <button className="hover:underline underline-offset-4 text-left">
                                Marcar Consulta
                            </button>
                            <button className="hover:underline underline-offset-4 text-left">
                                Registar-me
                            </button>
                            <button className="hover:underline underline-offset-4 text-left">
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
