import React from "react";

function Step({ title, desc }) {
    return (
        <div className="card step-card">
            <div className="step-body">
                <div className="step-icon"></div>
                <h4>{title}</h4>
                <p className="text-on-dark">{desc}</p>
            </div>
        </div>
    );
}

export default function HowItWorks() {
    return (
        <section className="section section--gradient-primary">
            <div className="container">
                <h2 className="text-center">
                    Muda o teu corpo e a tua vida com José Machado
                </h2>

                <p className="text-center text-on-dark text-max-wide">
                    Programa de nutrição e treino 100% personalizados à tua rotina, gostos e objetivos,
                    com acompanhamento diário de especialistas. Começa hoje a tua transformação.
                </p>

                <h3 className="text-center subtitle">
                    Como funciona o Programa de Transformação QiFlow
                </h3>

                <div className="grid-3">
                    <Step
                        title="1. Define o teu objetivo"
                        desc="Consulta personalizada para entender objetivos, limitações e preferências."
                    />
                    <Step
                        title="2. Recebe o teu plano"
                        desc="Nutrição, exercício e acupunctura — tudo na tua área reservada."
                    />
                    <Step
                        title="3. Acompanhamento contínuo"
                        desc="Ajustes em tempo real e motivação constante."
                    />
                </div>

                <div className="card callout">
                    <div className="callout-body">
                        <h3>Pronto para começar?</h3>
                        <p className="text-on-dark">
                            Junta-te a centenas de pessoas que já transformaram as suas vidas com o programa QiFlow.
                        </p>

                        <div className="hero-actions">
                            <button className="btn btn-light-on-dark btn-lg">
                                Marcar Consulta Gratuita
                            </button>
                            <button className="btn btn-ghost btn-lg btn-ghost-on-dark">
                                Começar Hoje
                            </button>
                        </div>

                        <p className="note-on-dark">
                            ✓ Primeira consulta gratuita ✓ Sem compromisso ✓ Resultados em 30 dias
                        </p>
                    </div>
                </div>
            </div>
        </section>
    );
}
