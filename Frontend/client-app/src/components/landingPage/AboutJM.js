import React from 'react';

const AboutJM = () => {
    return (
        <section className="py-20 bg-white">
            <div className="max-w-[1200px] mx-auto px-4">
                {/* Responsive grid: 1 column on mobile, 2 on large screens */}
                <div className="grid grid-cols-1 lg:grid-cols-2 gap-8 lg:gap-12 items-center">
                    {/* Text content: Second on mobile, first on desktop */}
                    <div className="order-2 lg:order-1">
                        <span className="inline-flex items-center justify-center rounded-md border px-3 py-1 text-xs font-medium whitespace-nowrap mb-4 bg-primary/10 text-primary border-primary/20">
                            <svg xmlns="http://www.w3.org/2000/svg" className="mr-[10px]" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" strokeWidth="2" strokeLinecap="round" strokeLinejoin="round">
                                <path d="M11 2v2"></path>
                                <path d="M5 2v2"></path>
                                <path d="M5 3H4a2 2 0 0 0-2 2v4a6 6 0 0 0 12 0V5a2 2 0 0 0-2-2h-1"></path>
                                <path d="M8 15a6 6 0 0 0 12 0v-3"></path>
                                <circle cx="20" cy="10" r="2"></circle>
                            </svg>
                            Especialista e Treinador Certificado
                        </span>

                        <h2 className="text-2xl lg:text-4xl font-normal mb-6 text-gray-900 leading-tight">
                            Conheça o <span className="text-primary">José Machado</span>
                        </h2>

                        <p className="text-base lg:text-lg text-gray-600 mb-6 leading-relaxed">
                            Com mais de 15 anos de experiência combinando Medicina Tradicional Chinesa, treino personalizado e nutrição, especializei-me na transformação completa de corpo e mente.
                        </p>

                        <div className="space-y-4 mb-8">
                            <div className="flex items-start gap-3">
                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" strokeWidth="2" strokeLinecap="round" strokeLinejoin="round" className="text-primary mt-0.5 shrink-0">
                                    <path d="M21.801 10A10 10 0 1 1 17 3.335"></path>
                                    <path d="m9 11 3 3L22 4"></path>
                                </svg>
                                <div>
                                    <h4 className="font-semibold text-gray-900 mb-1">Licenciatura em Medicina Tradicional Chinesa</h4>
                                    <p className="text-sm text-gray-600">Universidade de Medicina Tradicional de Beijing</p>
                                </div>
                            </div>

                            <div className="flex items-start gap-3">
                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" strokeWidth="2" strokeLinecap="round" strokeLinejoin="round" className="text-primary mt-0.5 shrink-0">
                                    <path d="M21.801 10A10 10 0 1 1 17 3.335"></path>
                                    <path d="m9 11 3 3L22 4"></path>
                                </svg>
                                <div>
                                    <h4 className="font-semibold text-gray-900 mb-1">Certificação em Personal Training e Nutrição</h4>
                                    <p className="text-sm text-gray-600">Especialização em Transformação Corporal e Performance</p>
                                </div>
                            </div>

                            <div className="flex items-start gap-3">
                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" strokeWidth="2" strokeLinecap="round" strokeLinejoin="round" className="text-primary mt-0.5 shrink-0">
                                    <path d="M21.801 10A10 10 0 1 1 17 3.335"></path>
                                    <path d="m9 11 3 3L22 4"></path>
                                </svg>
                                <div>
                                    <h4 className="font-semibold text-gray-900 mb-1">Método Inovador QiFlow</h4>
                                    <p className="text-sm text-gray-600">Criador do método que une tradição oriental e ciência moderna</p>
                                </div>
                            </div>
                        </div>

                        {/* Responsive button and contact: Stack vertically on mobile */}
                        <div className="flex flex-col sm:flex-row items-start sm:items-center gap-4">
                            <button className="inline-flex items-center justify-center gap-2 text-sm font-medium transition-colors bg-primary text-white hover:bg-primary/90 h-[40px] rounded-sm px-6 shadow-sm w-full sm:w-auto">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" strokeWidth="2" strokeLinecap="round" strokeLinejoin="round">
                                    <path d="M8 2v4"></path>
                                    <path d="M16 2v4"></path>
                                    <rect width="18" height="18" x="3" y="4" rx="2"></rect>
                                    <path d="M3 10h18"></path>
                                </svg>
                                Agendar Consulta
                            </button>

                            <div className="flex flex-col sm:flex-row items-start sm:items-center gap-4 w-full sm:w-auto">
                                <div className="flex items-center gap-2 text-sm text-gray-600">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" strokeWidth="2" strokeLinecap="round" strokeLinejoin="round" className="text-gray-500 shrink-0">
                                        <path d="M13.832 16.568a1 1 0 0 0 1.213-.303l.355-.465A2 2 0 0 1 17 15h3a2 2 0 0 1 2 2v3a2 2 0 0 1-2 2A18 18 0 0 1 2 4a2 2 0 0 1 2-2h3a2 2 0 0 1 2 2v3a2 2 0 0 1-.8 1.6l-.468.351a1 1 0 0 0-.292 1.233 14 14 0 0 0 6.392 6.384"></path>
                                    </svg>
                                    +351 912 345 678
                                </div>
                                <div className="flex items-center gap-2 text-sm text-gray-600">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" strokeWidth="2" strokeLinecap="round" strokeLinejoin="round" className="text-gray-500 shrink-0">
                                        <path d="m22 7-8.991 5.727a2 2 0 0 1-2.009 0L2 7"></path>
                                        <rect x="2" y="4" width="20" height="16" rx="2"></rect>
                                    </svg>
                                    jose@qiflow.pt
                                </div>
                            </div>
                        </div>
                    </div>

                    {/* Image: First on mobile, second on desktop */}
                    <div className="relative mt-8 lg:mt-0 order-1 lg:order-2">
                        <div className="absolute inset-0 bg-gradient-to-br from-primary/20 to-orange-200 rounded-2xl transform rotate-3"></div>
                        <img
                            src="https://images.unsplash.com/photo-1682530678353-51eda13ddcb8?crop=entropy&cs=tinysrgb&fit=max&fm=jpg&ixid=M3w3Nzg4Nzd8MHwxfHNlYXJjaHwxfHxmaXRuZXNzJTIwdHJhaW5lciUyMGNvYWNoJTIwcG9ydHVndWVzZSUyMG1hbiUyMHByb2Zlc3Npb25hbHxlbnwxfHx8fDE3NTgwMzM1MjF8MA&ixlib=rb-4.1.0&q=80&w=1080"
                            alt="José Machado - Especialista e Treinador"
                            className="relative rounded-2xl shadow-2xl w-full h-auto max-w-[600px] lg:w-[600px] lg:h-[500px] object-cover mx-auto lg:mx-0"
                        />
                        <div className="absolute -bottom-4 -right-4 lg:-bottom-6 lg:-right-6 bg-white p-3 lg:p-4 rounded-xl shadow-lg">
                            <div className="flex items-center gap-2">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="currentColor" stroke="none" className="text-yellow-400">
                                    <path d="M11.525 2.295a.53.53 0 0 1 .95 0l2.31 4.679a2.123 2.123 0 0 0 1.595 1.16l5.166.756a.53.53 0 0 1 .294.904l-3.736 3.638a2.123 2.123 0 0 0-.611 1.878l.882 5.14a.53.53 0 0 1-.771.56l-4.618-2.428a2.122 2.122 0 0 0-1.973 0L6.396 21.01a.53.53 0 0 1-.77-.56l.881-5.139a2.122 2.122 0 0 0-.611-1.879L2.16 9.795a.53.53 0 0 1 .294-.906l5.165-.755a2.122 2.122 0 0 0 1.597-1.16z"></path>
                                </svg>
                                <span className="text-xs lg:text-sm font-medium text-gray-900">4.9/5 (127 avaliações)</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    );
};

export default AboutJM;
