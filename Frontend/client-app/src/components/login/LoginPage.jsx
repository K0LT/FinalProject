import { CheckCircle2 } from "lucide-react";
import LoginIntro from "@/components/login/LoginIntro";
import {LoginFormCard} from "@/components/login/LoginFormCard";

import {LoginForm} from "@/components/login/LoginForm";
import FeatureGrid from "@/components/login/FeatureGrid";
import TestimonialsRight from "@/components/login/TestimonialsRight";
import ShieldInfo from "@/components/login/ShieldInfo";
import Footer from "@/components/login/Footer"

export const metadata = {
    title: "Entrar – QiFlow",
    description: "Aceda à sua área de cliente QiFlow",
};

export default function LoginPage() {
    return (
        <main className="container mx-auto px-4 py-8">
            <div className="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center min-h-[calc(100vh-120px)]">
                <div className="space-y-8">
                    <LoginIntro />
                    <div className="text-card-foreground flex flex-col gap-6 rounded-xl shadow-lg border-0 bg-white/70 backdrop-blur-sm">
                        <LoginFormCard />
                    </div>
                    <FeatureGrid />
                </div>

                <div className="space-y-8">
                    <section className="rounded-xl border-0 text-white bg-gradient-to-r from-blue-600 to-purple-600 p-8">
                        <h3 className="text-2xl mb-6">Tudo o que precisa numa só plataforma</h3>
                        <ul className="space-y-3 text-sm">
                            {[
                                "Acompanhamento de peso e composição corporal",
                                "Gestão completa de consultas e tratamentos",
                                "Prescrição de exercícios personalizados",
                                "Assistente IA para diagnóstico MTC",
                                "Relatórios detalhados de progresso",
                                "Interface intuitiva e moderna",
                            ].map((item) => (
                                <li key={item} className="flex items-center gap-3">
                                    <CheckCircle2 className="w-5 h-5 text-green-300 flex-shrink-0" />
                                    <span>{item}</span>
                                </li>
                            ))}
                        </ul>
                    </section>
                    <TestimonialsRight />
                    <ShieldInfo />
                </div>
            </div>
            <Footer />

        </main>
    );
}