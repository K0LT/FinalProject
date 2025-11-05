import React from 'react';
import '../../../tailwind.css';
const StartToday = () => {
    return (
        <section className="py-20 bg-gradient-to-r from-primary to-red-600 text-white relative overflow-hidden">
            <div className="absolute inset-0 bg-black/10"></div>
            <div className="container mx-auto px-4 relative">
                <div className="max-w-4xl mx-auto text-center">
                    <h2 className="text-5xl mb-6">Muda o teu corpo e a tua vida com José Machado</h2>
                    <p className="text-xl mb-12 opacity-90 max-w-3xl mx-auto">
                        Programa de nutrição e treino 100% personalizados à tua rotina, gostos e objetivos, com acompanhamento diário de especialistas. Começa hoje a tua transformação.
                    </p>
                    <div className="mb-16">
                        <h3 className="text-3xl mb-12">Como funciona o Programa de Transformação QiFlow</h3>
                        <div className="grid grid-cols-3 gap-8">
                            <div className="bg-white/10 backdrop-blur-sm rounded-xl p-8 border border-white/20">
                                <div className="w-16 h-16 bg-white/20 rounded-full flex items-center justify-center mx-auto mb-6">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" strokeWidth="2" strokeLinecap="round" strokeLinejoin="round" className="lucide lucide-target w-8 h-8 text-white" aria-hidden="true">
                                        <circle cx="12" cy="12" r="10"></circle>
                                        <circle cx="12" cy="12" r="6"></circle>
                                        <circle cx="12" cy="12" r="2"></circle>
                                    </svg>
                                </div>
                                <h4 className="text-xl mb-4">1. Define o teu objetivo</h4>
                                <p className="opacity-90">Consulta personalizada para entender os teus objetivos, limitações e preferências únicas.</p>
                            </div>
                            <div className="bg-white/10 backdrop-blur-sm rounded-xl p-8 border border-white/20">
                                <div className="w-16 h-16 bg-white/20 rounded-full flex items-center justify-center mx-auto mb-6">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" strokeWidth="2" strokeLinecap="round" strokeLinejoin="round" className="lucide lucide-calendar w-8 h-8 text-white" aria-hidden="true">
                                        <path d="M8 2v4"></path>
                                        <path d="M16 2v4"></path>
                                        <rect width="18" height="18" x="3" y="4" rx="2"></rect>
                                        <path d="M3 10h18"></path>
                                    </svg>
                                </div>
                                <h4 className="text-xl mb-4">2. Recebe o teu plano na área reservada</h4>
                                <p className="opacity-90">Plano de nutrição, exercício e acupunctura totalmente personalizado disponível 24/7.</p>
                            </div>
                            <div className="bg-white/10 backdrop-blur-sm rounded-xl p-8 border border-white/20">
                                <div className="w-16 h-16 bg-white/20 rounded-full flex items-center justify-center mx-auto mb-6">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" strokeWidth="2" strokeLinecap="round" strokeLinejoin="round" className="lucide lucide-users w-8 h-8 text-white" aria-hidden="true">
                                        <path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"></path>
                                        <path d="M16 3.128a4 4 0 0 1 0 7.744"></path>
                                        <path d="M22 21v-2a4 4 0 0 0-3-3.87"></path>
                                        <circle cx="9" cy="7" r="4"></circle>
                                    </svg>
                                </div>
                                <h4 className="text-xl mb-4">3. Acompanhamento contínuo</h4>
                                <p className="opacity-90">Suporte diário dos nossos especialistas, ajustes em tempo real e motivação constante.</p>
                            </div>
                        </div>
                    </div>

                    <div className="mb-12">
                        <h3 className="text-3xl mb-12">Porque é que o programa da QiFlow é diferente?</h3>
                        <div className="flex flex-wrap justify-between gap-8 max-w-4xl mx-auto">
                            <div className="text-center flex-1 min-w-[250px]">
                                <div className="w-20 h-20 bg-white/20 rounded-full flex items-center justify-center mx-auto mb-6">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" strokeWidth="2" strokeLinecap="round" strokeLinejoin="round" className="lucide lucide-stethoscope w-10 h-10 text-white" aria-hidden="true">
                                        <path d="M11 2v2"></path>
                                        <path d="M5 2v2"></path>
                                        <path d="M5 3H4a2 2 0 0 0-2 2v4a6 6 0 0 0 12 0V5a2 2 0 0 0-2-2h-1"></path>
                                        <path d="M8 15a6 6 0 0 0 12 0v-3"></path>
                                        <circle cx="20" cy="10" r="2"></circle>
                                    </svg>
                                </div>
                                <h4 className="text-2xl mb-4">Personalização real</h4>
                                <p className="opacity-90 text-lg">Cada plano é único, baseado na medicina tradicional chinesa e nas tuas necessidades específicas.</p>
                            </div>
                            <div className="text-center flex-1 min-w-[250px]">
                                <div className="w-20 h-20 bg-white/20 rounded-full flex items-center justify-center mx-auto mb-6">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" strokeWidth="2" strokeLinecap="round" strokeLinejoin="round" className="lucide lucide-heart w-10 h-10 text-white" aria-hidden="true">
                                        <path d="M2 9.5a5.5 5.5 0 0 1 9.591-3.676.56.56 0 0 0 .818 0A5.49 5.49 0 0 1 22 9.5c0 2.29-1.5 4-3 5.5l-5.492 5.313a2 2 0 0 1-3 .019L5 15c-1.5-1.5-3-3.2-3-5.5"></path>
                                    </svg>
                                </div>
                                <h4 className="text-2xl mb-4">Apoio constante</h4>
                                <p className="opacity-90 text-lg">Especialistas disponíveis todos os dias para te motivar e ajustar o teu programa.</p>
                            </div>
                            <div className="text-center flex-1 min-w-[250px]">
                                <div className="w-20 h-20 bg-white/20 rounded-full flex items-center justify-center mx-auto mb-6">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" strokeWidth="2" strokeLinecap="round" strokeLinejoin="round" className="lucide lucide-zap w-10 h-10 text-white" aria-hidden="true">
                                        <path d="M4 14a1 1 0 0 1-.78-1.63l9.9-10.2a.5.5 0 0 1 .86.46l-1.92 6.02A1 1 0 0 0 13 10h7a1 1 0 0 1 .78 1.63l-9.9 10.2a.5.5 0 0 1-.86-.46l1.92-6.02A1 1 0 0 0 11 14z"></path>
                                    </svg>
                                </div>
                                <h4 className="text-2xl mb-4">Simplicidade total</h4>
                                <p className="opacity-90 text-lg">Tudo numa só plataforma. Fácil de seguir, fácil de manter, resultados garantidos.</p>
                            </div>
                        </div>
                    </div>


                    <div className="bg-white/10 backdrop-blur-sm rounded-2xl p-8 border border-white/20">
                        <h3 className="text-3xl mb-6">Pronto para começar?</h3>
                        <p className="text-xl mb-8 opacity-90">Junta-te a centenas de pessoas que já transformaram as suas vidas com o programa QiFlow.</p>
                        <div className="flex flex-row gap-4 justify-center">
                            <button className="inline-flex items-center justify-center gap-2 whitespace-nowrap font-medium transition-all disabled:pointer-events-none disabled:opacity-50 [&_svg]:pointer-events-none [&_svg]:size-4 shrink-0 [&_svg]:shrink-0 outline-none focus-visible:border-ring focus-visible:ring-ring/50 focus-visible:ring-[3px] aria-invalid:ring-destructive/20 dark:aria-invalid:ring-destructive/40 aria-invalid:border-destructive h-10 rounded-md has-[>svg]:px-4 text-lg px-8 bg-white text-primary hover:bg-gray-100">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" strokeWidth="2" strokeLinecap="round" strokeLinejoin="round" className="lucide lucide-calendar w-5 h-5 mr-2" aria-hidden="true">
                                    <path d="M8 2v4"></path>
                                    <path d="M16 2v4"></path>
                                    <rect width="18" height="18" x="3" y="4" rx="2"></rect>
                                    <path d="M3 10h18"></path>
                                </svg>Marcar Consulta Gratuita
                            </button>
                            <button className="inline-flex items-center justify-center gap-2 whitespace-nowrap font-medium transition-all disabled:pointer-events-none disabled:opacity-50 [&_svg]:pointer-events-none [&_svg]:size-4 shrink-0 [&_svg]:shrink-0 outline-none focus-visible:border-ring focus-visible:ring-ring/50 focus-visible:ring-[3px] aria-invalid:ring-destructive/20 dark:aria-invalid:ring-destructive/40 aria-invalid:border-destructive border border-white text-white hover:bg-white hover:text-primary hover:border-primary h-10 rounded-md has-[>svg]:px-4 text-lg px-8">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" strokeWidth="2" strokeLinecap="round" strokeLinejoin="round" className="lucide lucide-arrow-right w-5 h-5 mr-2" aria-hidden="true">
                                    <path d="M5 12h14"></path>
                                    <path d="m12 5 7 7-7 7"></path>
                                </svg>
                                Começar Hoje
                            </button>
                        </div>
                        <p className="text-sm opacity-75 mt-4">✓ Primeira consulta gratuita ✓ Sem compromisso ✓ Resultados em 30 dias</p>
                    </div>
                </div>
            </div>
        </section>
    );
};

export default StartToday;
