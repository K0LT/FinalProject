import React from 'react';
import { Star, CheckCircle, Award, Heart, Target, Users, Calendar, Phone, Mail, Shield, Clock, Zap, Stethoscope, BarChart3, ArrowRight } from 'lucide-react';

export default function QiFlowLanding() {
    return (
        <div className="min-h-screen bg-white">
            {/* Header */}
            <header className="border-b bg-white">
                <div className="container mx-auto px-4 py-4">
                    <div className="flex items-center justify-between">
                        <div className="flex items-center gap-3">
                            <div className="size-8 bg-gradient-to-br from-yellow-500 to-yellow-600 rounded-full"></div>
                            <div>
                                <h1 className="text-lg font-bold" style={{color: '#B8860B'}}>QiFlow</h1>
                                <p className="text-xs text-gray-500">Mestre José Machado</p>
                            </div>
                        </div>
                        <div className="flex items-center gap-3">
                            <button className="border border-gray-300 text-gray-700 hover:bg-gray-50 px-4 py-2 rounded-md text-sm font-medium transition-all">
                                Entrar
                            </button>
                            <button className="text-white px-4 py-2 rounded-md text-sm font-medium transition-all" style={{backgroundColor: '#B8860B'}}>
                                Registar-me
                            </button>
                        </div>
                    </div>
                </div>
            </header>

            {/* Hero Section */}
            <section className="py-20 text-center bg-white">
                <div className="container mx-auto px-4">
                    <div className="max-w-4xl mx-auto">
            <span className="inline-block px-4 py-2 rounded-full text-xs font-medium mb-6 border" style={{backgroundColor: 'rgba(184, 134, 11, 0.1)', color: '#B8860B', borderColor: 'rgba(184, 134, 11, 0.2)'}}>
              ✨ Perca Peso de Forma Natural sem Cirurgia - Medicina Tradicional Chinesa
            </span>
                        <h1 className="text-5xl font-bold mb-6 text-gray-900">
                            Perca Peso de Forma <span style={{color: '#B8860B'}}>Natural</span> e <span style={{color: '#B8860B'}}>Sustentável</span>
                        </h1>
                        <p className="text-lg text-gray-600 mb-8 max-w-2xl mx-auto">
                            Combine a sabedoria milenar da Medicina Tradicional Chinesa com tecnologia moderna. Resultados comprovados em mais de 500 pacientes.
                        </p>
                        <div className="flex flex-col sm:flex-row gap-4 justify-center mb-12">
                            <button className="text-white px-8 py-3 rounded-md font-medium transition-all inline-flex items-center justify-center gap-2" style={{backgroundColor: '#B8860B'}}>
                                <Calendar className="size-5" />
                                Marcar Consulta Gratuita
                            </button>
                            <button className="border-2 border-gray-300 text-gray-700 hover:bg-gray-50 px-8 py-3 rounded-md font-medium transition-all inline-flex items-center justify-center gap-2">
                                Quero Transformar-me
                            </button>
                        </div>
                        <div className="grid grid-cols-3 gap-8 max-w-2xl mx-auto">
                            <div className="text-center">
                                <div className="text-3xl font-bold mb-2" style={{color: '#B8860B'}}>500+</div>
                                <div className="text-sm text-gray-500">Clientes Satisfeitos</div>
                            </div>
                            <div className="text-center">
                                <div className="text-3xl font-bold mb-2" style={{color: '#B8860B'}}>95%</div>
                                <div className="text-sm text-gray-500">Taxa de Sucesso</div>
                            </div>
                            <div className="text-center">
                                <div className="text-3xl font-bold mb-2" style={{color: '#B8860B'}}>15+</div>
                                <div className="text-sm text-gray-500">Anos de Experiência</div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            {/* Orange Section */}
            <section className="py-20 text-white relative overflow-hidden" style={{background: 'linear-gradient(to right, #B8860B, #D2691E)'}}>
                <div className="container mx-auto px-4 relative">
                    <div className="max-w-4xl mx-auto text-center">
                        <h2 className="text-5xl font-bold mb-6">
                            Muda o teu corpo e a tua vida com José Machado
                        </h2>
                        <p className="text-xl mb-12 opacity-90 max-w-3xl mx-auto">
                            Programa de nutrição e treino 100% personalizados à tua rotina, gostos e objetivos,
                            com acompanhamento diário de especialistas. Começa hoje a tua transformação.
                        </p>

                        <h3 className="text-3xl font-bold mb-12">
                            Como funciona o Programa de Transformação QiFlow
                        </h3>

                        <div className="grid grid-cols-1 md:grid-cols-3 gap-8 mb-16">
                            <div className="bg-white/10 backdrop-blur-sm rounded-xl p-8 border border-white/20">
                                <div className="size-16 bg-white/20 rounded-full flex items-center justify-center mx-auto mb-6">
                                    <Target className="size-8 text-white" />
                                </div>
                                <h4 className="text-xl font-bold mb-4">1. Define o teu objetivo</h4>
                                <p className="opacity-90">
                                    Consulta personalizada para entender os teus objetivos, limitações e preferências únicas.
                                </p>
                            </div>

                            <div className="bg-white/10 backdrop-blur-sm rounded-xl p-8 border border-white/20">
                                <div className="size-16 bg-white/20 rounded-full flex items-center justify-center mx-auto mb-6">
                                    <Calendar className="size-8 text-white" />
                                </div>
                                <h4 className="text-xl font-bold mb-4">2. Recebe o teu plano na área reservada</h4>
                                <p className="opacity-90">
                                    Plano de nutrição, exercício e acupunctura totalmente personalizado disponível 24/7.
                                </p>
                            </div>

                            <div className="bg-white/10 backdrop-blur-sm rounded-xl p-8 border border-white/20">
                                <div className="size-16 bg-white/20 rounded-full flex items-center justify-center mx-auto mb-6">
                                    <Users className="size-8 text-white" />
                                </div>
                                <h4 className="text-xl font-bold mb-4">3. Acompanhamento contínuo</h4>
                                <p className="opacity-90">
                                    Suporte diário dos nossos especialistas, ajustes em tempo real e motivação constante.
                                </p>
                            </div>
                        </div>

                        <h3 className="text-3xl font-bold mb-12">
                            Porque é que o programa da QiFlow é diferente?
                        </h3>

                        <div className="grid grid-cols-1 md:grid-cols-3 gap-8 max-w-4xl mx-auto mb-12">
                            <div className="text-center">
                                <div className="size-20 bg-white/20 rounded-full flex items-center justify-center mx-auto mb-6">
                                    <Stethoscope className="size-10 text-white" />
                                </div>
                                <h4 className="text-2xl font-bold mb-4">Personalização real</h4>
                                <p className="opacity-90 text-lg">
                                    Cada plano é único, baseado na medicina tradicional chinesa e nas tuas necessidades específicas.
                                </p>
                            </div>

                            <div className="text-center">
                                <div className="size-20 bg-white/20 rounded-full flex items-center justify-center mx-auto mb-6">
                                    <Heart className="size-10 text-white" />
                                </div>
                                <h4 className="text-2xl font-bold mb-4">Apoio constante</h4>
                                <p className="opacity-90 text-lg">
                                    Especialistas disponíveis todos os dias para te motivar e ajustar o teu programa.
                                </p>
                            </div>

                            <div className="text-center">
                                <div className="size-20 bg-white/20 rounded-full flex items-center justify-center mx-auto mb-6">
                                    <Zap className="size-10 text-white" />
                                </div>
                                <h4 className="text-2xl font-bold mb-4">Simplicidade total</h4>
                                <p className="opacity-90 text-lg">
                                    Tudo numa só plataforma. Fácil de seguir, fácil de manter, resultados garantidos.
                                </p>
                            </div>
                        </div>

                        <div className="bg-white/10 backdrop-blur-sm rounded-2xl p-8 border border-white/20">
                            <h3 className="text-3xl font-bold mb-6">Pronto para começar?</h3>
                            <p className="text-xl mb-8 opacity-90">
                                Junta-te a centenas de pessoas que já transformaram as suas vidas com o programa QiFlow.
                            </p>
                            <div className="flex flex-col sm:flex-row gap-4 justify-center">
                                <button className="bg-white text-primary hover:bg-gray-100 h-10 px-8 rounded-md text-lg font-medium transition-all inline-flex items-center justify-center gap-2">
                                    <Calendar className="size-5" />
                                    Marcar Consulta Gratuita
                                </button>
                                <button className="bg-transparent border-2 border-white text-white hover:bg-white hover:text-primary h-10 px-8 rounded-md text-lg font-medium transition-all inline-flex items-center justify-center gap-2">
                                    <ArrowRight className="size-5" />
                                    Começar Hoje
                                </button>
                            </div>
                            <p className="text-sm opacity-75 mt-4">
                                ✓ Primeira consulta gratuita ✓ Sem compromisso ✓ Resultados em 30 dias
                            </p>
                        </div>
                    </div>
                </div>
            </section>


            {/* About Section */}
            <section className="py-20 bg-white">
                <div className="container mx-auto px-4">
                    <div className="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center max-w-6xl mx-auto">
                        <div>
              <span className="inline-block px-3 py-1 rounded-md text-xs font-medium mb-4" style={{backgroundColor: 'rgba(184, 134, 11, 0.1)', color: '#B8860B'}}>
                Especialista e Treinador Certificado
              </span>
                            <h2 className="text-4xl font-bold mb-6 text-gray-900">
                                Conheça o <span style={{color: '#B8860B'}}>José Machado</span>
                            </h2>
                            <p className="text-gray-600 mb-6">
                                Formado em Medicina Tradicional Chinesa e especialista em emagrecimento e nutrição.
                                Acredito em transformar o corpo e a mente.
                            </p>
                            <div className="space-y-3 mb-6">
                                <div className="flex items-start gap-2">
                                    <CheckCircle className="size-5 mt-0.5 shrink-0" style={{color: '#B8860B'}} />
                                    <div>
                                        <div className="font-medium">Licenciatura em Medicina Tradicional Chinesa</div>
                                        <div className="text-sm text-gray-500">Universidade de Medicina Tradicional de Beijing</div>
                                    </div>
                                </div>
                                <div className="flex items-start gap-2">
                                    <CheckCircle className="size-5 mt-0.5 shrink-0" style={{color: '#B8860B'}} />
                                    <div>
                                        <div className="font-medium">Certificação em Nutrição Clínica e Nutrição</div>
                                        <div className="text-sm text-gray-500">Especialização em emagrecimento</div>
                                    </div>
                                </div>
                                <div className="flex items-start gap-2">
                                    <CheckCircle className="size-5 mt-0.5 shrink-0" style={{color: '#B8860B'}} />
                                    <div>
                                        <div className="font-medium">Especialização em Acupunctura</div>
                                        <div className="text-sm text-gray-500">Membro da Ordem dos Nutricionistas</div>
                                    </div>
                                </div>
                            </div>
                            <div className="flex gap-4">
                                <button className="text-white px-6 py-3 rounded-md font-medium transition-all" style={{backgroundColor: '#B8860B'}}>
                                    Conhecer História
                                </button>
                                <div className="flex items-center gap-2 text-sm text-gray-600">
                                    <Phone className="size-4" />
                                    <span>+351 912 345 678</span>
                                </div>
                            </div>
                        </div>
                        <div className="relative">
                            <img
                                src="https://images.unsplash.com/photo-1576091160399-112ba8d25d1d?w=600&h=400&fit=crop"
                                alt="José Machado"
                                className="rounded-xl shadow-xl w-full"
                            />
                            <div className="absolute -bottom-4 -right-4 bg-white p-3 rounded-lg shadow-lg">
                                <div className="flex gap-1 mb-1">
                                    {[...Array(5)].map((_, i) => (
                                        <Star key={i} className="size-3 fill-yellow-400 text-yellow-400" />
                                    ))}
                                </div>
                                <div className="text-xs font-bold">4.9/5.0 avaliações</div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            {/* Why Choose Section */}
            <section className="py-20 bg-gray-50">
                <div className="container mx-auto px-4">
                    <div className="text-center mb-12">
                        <h2 className="text-3xl font-bold mb-4 text-gray-900">Por que escolher o QiFlow?</h2>
                        <p className="text-gray-600">
                            Metodologia única que combina o melhor da medicina ancestral com tecnologia moderna
                        </p>
                    </div>
                    <div className="grid grid-cols-1 md:grid-cols-4 gap-6 max-w-6xl mx-auto">
                        {[
                            { icon: Target, title: 'Acompanhamento Personalizado', desc: 'Plano de tratamento adaptado às tuas necessidades' },
                            { icon: BarChart3, title: 'Ações Orientadas', desc: 'Estratégias eficazes para conquistar os teus objetivos' },
                            { icon: Heart, title: 'Experiência Comprovada', desc: 'Mais de 15 anos ajudando pessoas a alcançar seus objetivos' },
                            { icon: Award, title: 'Resultados Garantidos', desc: '95% de taxa de sucesso dos pacientes' }
                        ].map((item, i) => (
                            <div key={i} className="bg-white rounded-lg p-6 text-center shadow-sm">
                                <div className="size-16 rounded-full flex items-center justify-center mx-auto mb-4" style={{backgroundColor: 'rgba(184, 134, 11, 0.1)'}}>
                                    <item.icon className="size-8" style={{color: '#B8860B'}} />
                                </div>
                                <h3 className="font-bold mb-2 text-gray-900">{item.title}</h3>
                                <p className="text-gray-600 text-sm">{item.desc}</p>
                            </div>
                        ))}
                    </div>
                </div>
            </section>

            {/* Pricing Section */}
            <section className="py-20 bg-white">
                <div className="container mx-auto px-4">
                    <div className="text-center mb-12">
            <span className="inline-block px-3 py-1 rounded-md text-xs font-medium mb-4" style={{backgroundColor: 'rgba(184, 134, 11, 0.1)', color: '#B8860B'}}>
              ✨ Melhor Investimento
            </span>
                        <h2 className="text-3xl font-bold mb-4 text-gray-900">Escolha o seu plano ideal</h2>
                        <p className="text-gray-600">
                            Opções flexíveis para todos os bolsos e objetivos. Investe em ti mesmo!
                        </p>
                    </div>

                    <div className="grid grid-cols-1 md:grid-cols-3 gap-8 max-w-6xl mx-auto">
                        {/* Plan 1 */}
                        <div className="bg-white rounded-xl border-2 border-gray-200 p-6">
                            <h3 className="text-xl font-bold mb-2 text-gray-900">Consulta Individual</h3>
                            <div className="mb-1">
                                <span className="text-3xl font-bold" style={{color: '#B8860B'}}>80€</span>
                                <span className="text-gray-500">/consulta</span>
                            </div>
                            <p className="text-gray-600 text-sm mb-6">Ideal para quem quer experimentar</p>
                            <ul className="space-y-3 mb-6">
                                {['Consulta de 60 minutos', 'Avaliação personalizada', 'Plano nutricional básico', 'Suporte via email'].map((feature, i) => (
                                    <li key={i} className="flex items-start gap-2 text-sm text-gray-900">
                                        <CheckCircle className="size-5 shrink-0" style={{color: '#B8860B'}} />
                                        <span>{feature}</span>
                                    </li>
                                ))}
                            </ul>
                            <button className="w-full border-2 py-3 rounded-full font-medium transition-all" style={{borderColor: '#B8860B', color: '#B8860B'}}>
                                Saber Mais
                            </button>
                        </div>

                        {/* Plan 2 - Featured */}
                        <div className="bg-white rounded-xl border-2 p-6 relative shadow-xl transform scale-105" style={{borderColor: '#B8860B'}}>
              <span className="absolute -top-3 left-1/2 transform -translate-x-1/2 text-white px-4 py-1 rounded-full text-xs font-medium" style={{backgroundColor: '#B8860B'}}>
                Recomendado
              </span>
                            <h3 className="text-xl font-bold mb-2 text-gray-900">Plano Transformação</h3>
                            <div className="mb-1">
                                <span className="text-3xl font-bold" style={{color: '#B8860B'}}>280€</span>
                                <span className="text-gray-500">/mês</span>
                            </div>
                            <p className="text-gray-600 text-sm mb-6">Ideal para quem quer mudanças reais</p>
                            <ul className="space-y-3 mb-6">
                                {['4 consultas / mês', 'Plano nutricional completo', 'Receitas personalizadas', 'Suporte via WhatsApp', 'Aulas de exercícios online'].map((feature, i) => (
                                    <li key={i} className="flex items-start gap-2 text-sm text-gray-900">
                                        <CheckCircle className="size-5 shrink-0" style={{color: '#B8860B'}} />
                                        <span>{feature}</span>
                                    </li>
                                ))}
                            </ul>
                            <button className="w-full text-white py-3 rounded-full font-medium transition-all" style={{backgroundColor: '#B8860B'}}>
                                Escolher Plano
                            </button>
                        </div>

                        {/* Plan 3 */}
                        <div className="bg-white rounded-xl border-2 border-gray-200 p-6">
                            <h3 className="text-xl font-bold mb-2 text-gray-900">Programa Completo</h3>
                            <div className="mb-1">
                                <span className="text-3xl font-bold" style={{color: '#B8860B'}}>720€</span>
                                <span className="text-gray-500">/3 meses</span>
                            </div>
                            <p className="text-gray-600 text-sm mb-6">Transformação completa garantida</p>
                            <ul className="space-y-3 mb-6">
                                {['Tudo do Plano Transformação', 'Acupuntura incluída', 'Sessões de coaching', 'Plano de exercícios', 'Acompanhamento diário'].map((feature, i) => (
                                    <li key={i} className="flex items-start gap-2 text-sm text-gray-900">
                                        <CheckCircle className="size-5 shrink-0" style={{color: '#B8860B'}} />
                                        <span>{feature}</span>
                                    </li>
                                ))}
                            </ul>
                            <button className="w-full border-2 py-3 rounded-full font-medium transition-all" style={{borderColor: '#B8860B', color: '#B8860B'}}>
                                Saber Mais
                            </button>
                        </div>
                    </div>

                    <div className="text-center mt-8">
                        <button className="text-white px-8 py-3 rounded-full font-medium transition-all" style={{backgroundColor: '#B8860B'}}>
                            Agendar Consulta Gratuita Agora
                        </button>
                    </div>
                </div>
            </section>

            {/* Testimonials */}
            <section className="py-20 bg-gray-50">
                <div className="container mx-auto px-4">
                    <h2 className="text-3xl font-bold text-center mb-4 text-gray-900">Histórias de Sucesso</h2>
                    <p className="text-center text-gray-600 mb-12">
                        Veja o que dizem aqueles que já fizeram a transformação
                    </p>

                    <div className="grid grid-cols-1 md:grid-cols-3 gap-8 max-w-6xl mx-auto">
                        {[
                            { name: 'Maria Santos', weight: '-18kg', quote: 'O programa do José mudou completamente a minha vida. Perdi 15kg em 3 meses e finalmente consegui manter o peso ideal!' },
                            { name: 'Carlos Oliveira', weight: '-15kg', quote: 'Não só perdi peso como melhorei completamente a minha qualidade de vida. Recomendo vivamente!' },
                            { name: 'Ana Ferreira', weight: '-22kg', quote: 'O Dr. José conseguiu onde outros falharam. Finalmente encontrei um método sustentável.' }
                        ].map((testimonial, i) => (
                            <div key={i} className="bg-white p-6 rounded-lg shadow-sm">
                                <div className="flex gap-1 mb-4">
                                    {[...Array(5)].map((_, j) => (
                                        <Star key={j} className="size-4 fill-yellow-400 text-yellow-400" />
                                    ))}
                                </div>
                                <p className="text-gray-900 mb-4 text-sm italic">"{testimonial.quote}"</p>
                                <div className="flex items-center justify-between">
                                    <div>
                                        <div className="font-bold text-sm text-gray-900">{testimonial.name}</div>
                                        <div className="text-xs px-2 py-1 rounded-md mt-1 inline-block" style={{backgroundColor: 'rgba(184, 134, 11, 0.1)', color: '#B8860B'}}>
                                            {testimonial.weight}
                                        </div>
                                    </div>
                                    <div className="size-10 rounded-full flex items-center justify-center" style={{backgroundColor: 'rgba(184, 134, 11, 0.1)'}}>
                                        <Users className="size-5" style={{color: '#B8860B'}} />
                                    </div>
                                </div>
                            </div>
                        ))}
                    </div>
                </div>
            </section>

            {/* Final CTA */}
            <section className="py-20 text-white" style={{background: 'linear-gradient(to right, #B8860B, #D2691E)'}}>
                <div className="container mx-auto px-4 text-center">
                    <div className="max-w-3xl mx-auto">
                        <h2 className="text-4xl font-bold mb-4">
                            Pronto para Começar a sua Transformação?
                        </h2>
                        <p className="text-lg mb-8 opacity-90">
                            Agende a sua consulta gratuita e descubra como pode atingir os seus objetivos de forma natural e sustentável com o programa QiFlow.
                        </p>
                        <div className="flex flex-col sm:flex-row gap-4 justify-center mb-6">
                            <button className="bg-white px-8 py-3 rounded-full font-medium transition-all" style={{color: '#B8860B'}}>
                                Marcar Consulta Gratuita
                            </button>
                            <button className="bg-transparent border-2 border-white text-white hover:bg-white px-8 py-3 rounded-full font-medium transition-all">
                                Registar-me Agora
                            </button>
                        </div>
                        <p className="text-sm opacity-80">
                            ✨ Oferta limitada · 📞 Sem compromisso · 🎁 Avaliação 100% gratuita
                        </p>
                    </div>
                </div>
            </section>

            {/* Footer */}
            <footer className="bg-gray-50 border-t py-12">
                <div className="container mx-auto px-4">
                    <div className="grid grid-cols-1 md:grid-cols-4 gap-8">
                        <div>
                            <div className="flex items-center gap-2 mb-4">
                                <div className="size-6 bg-gradient-to-br from-yellow-500 to-yellow-600 rounded-full"></div>
                                <span className="text-lg font-bold">QiFlow</span>
                            </div>
                            <p className="text-sm text-gray-600">
                                Transforme o seu corpo de forma natural e sustentável.
                            </p>
                        </div>
                        <div>
                            <h4 className="font-bold mb-4">QiFlow</h4>
                            <ul className="space-y-2 text-sm text-gray-600">
                                <li>Sobre José Machado</li>
                                <li>Medicina Tradicional Chinesa</li>
                                <li>Nutrição Funcional</li>
                            </ul>
                        </div>
                        <div>
                            <h4 className="font-bold mb-4">Contactos</h4>
                            <ul className="space-y-2 text-sm text-gray-600">
                                <li className="flex items-center gap-2">
                                    <Phone className="size-4" />
                                    +351 912 345 678
                                </li>
                                <li className="flex items-center gap-2">
                                    <Mail className="size-4" />
                                    info@qiflow.pt
                                </li>
                                <li>Porto, Portugal</li>
                            </ul>
                        </div>
                        <div>
                            <h4 className="font-bold mb-4">Links Rápidos</h4>
                            <ul className="space-y-2 text-sm text-gray-600">
                                <li>Política de Privacidade</li>
                                <li>Termos e Condições</li>
                                <li>FAQ</li>
                            </ul>
                        </div>
                    </div>
                    <div className="border-t mt-8 pt-8 text-center text-sm text-gray-600">
                        © 2025 QiFlow. Todos os direitos reservados.
                    </div>
                </div>
            </footer>
        </div>
    );
}