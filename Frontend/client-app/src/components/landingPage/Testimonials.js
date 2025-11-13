import React from "react";
import { Star, User } from "lucide-react";

const testimonials = [
    {
        name: "Maria Santos",
        result: "-18kg em 6 meses",
        text: "Perdi 18kg em 6 meses com o acompanhamento do Dr. José. A abordagem holística fez toda a diferença!",
    },
    {
        name: "Carlos Oliveira",
        result: "-15kg em 4 meses",
        text: "Não só perdi peso como melhorei completamente a minha qualidade de vida. Recomendo vivamente!",
    },
    {
        name: "Ana Ferreira",
        result: "-22kg em 8 meses",
        text: "O Dr. José conseguiu onde outros falharam. Finalmente encontrei um método sustentável.",
    },
];

const Testimonials = () => {
    return (
        <section className="py-20 bg-gradient-to-r from-primary/5 to-orange-50">
            <div className="container mx-auto px-4">
                <div className="text-center mb-16">
                    <h2 className="text-3xl lg:text-4xl mb-4 font-semibold">Histórias de Sucesso</h2>
                    <p className="text-lg lg:text-xl text-muted-foreground">
                        Veja os resultados reais dos nossos pacientes
                    </p>
                </div>

                {/* Responsive flex: Stack vertically on mobile, row on medium+ */}
                <div className="flex flex-col md:flex-row justify-center items-stretch gap-6 md:gap-12 max-w-[1200px] mx-auto">
                    {testimonials.map((item, index) => (
                        <div
                            key={index}
                            className="flex flex-col bg-white text-card-foreground rounded-xl shadow-lg p-6 flex-1"
                        >
                            <div className="flex items-center gap-1 mb-4">
                                {[...Array(5)].map((_, i) => (
                                    <Star
                                        key={i}
                                        className="w-4 h-4 fill-yellow-400 text-yellow-400"
                                    />
                                ))}
                            </div>

                            <p className="text-sm italic mb-4">{item.text}</p>

                            <div className="flex items-center justify-between mt-auto">
                                <div>
                                    <p className="text-sm font-medium">{item.name}</p>
                                    <span className="inline-flex items-center justify-center rounded-md bg-secondary text-secondary-foreground text-xs font-medium px-2 py-0.5 mt-1">
                                        {item.result}
                                    </span>
                                </div>
                                <div className="w-10 h-10 bg-primary/10 rounded-full flex items-center justify-center">
                                    <User className="w-5 h-5 text-primary" />
                                </div>
                            </div>
                        </div>
                    ))}
                </div>
            </div>
        </section>
    );
};

export default Testimonials;
