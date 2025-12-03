import React from 'react';
import { Star, User } from 'lucide-react';

const Testimonial = () => {
    return (
        <div className="text-card-foreground flex flex-col gap-6 rounded-xl border-0 bg-white/70 backdrop-blur-sm">
            <div className="[&:last-child]:pb-6 p-6">
                <h3 className="text-lg mb-4">Resultado Real</h3>
                <div className="space-y-4">
                    <div className="flex items-center gap-1 mb-2">
                        {[...Array(5)].map((_, i) => (
                            <Star key={i} className="w-4 h-4 fill-yellow-400 text-yellow-400" />
                        ))}
                    </div>
                    <p className="text-sm italic">"Em 4 meses perdi 15kg e melhorei completamente a minha qualidade de vida. O Dr. José é excepcional!"</p>
                    <div className="flex items-center gap-3">
                        <div className="w-10 h-10 bg-primary/10 rounded-full flex items-center justify-center">
                            <User className="w-5 h-5 text-primary" />
                        </div>
                        <div>
                            <p className="text-sm">Maria Santos</p>
                            <p className="text-xs text-muted-foreground">Paciente desde 2023</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    );
};

export default Testimonial;