import React from "react";

export default function FinalCta() {
    return (
        <section className="section section--final-cta">
            <div className="container cta">
                <h2>Pronto para Começar a sua Transformação?</h2>

                <p className="cta-text">
                    Marque a sua consulta gratuita e descubra como pode alcançar os seus objetivos de forma natural.
                </p>

                <div className="hero-actions">
                    <button className="btn btn-on-primary btn-lg">
                        Marcar Consulta Gratuita
                    </button>
                    <button className="btn btn-ghost btn-lg btn-ghost-on-primary">
                        Registar-me Agora
                    </button>
                </div>

                <div className="bubble">
                    <span>✓  Dados 100% seguros</span>
                    <span>✓  Resposta em 24h</span>
                    <span>✓  Sem compromisso</span>
                </div>
            </div>
        </section>
    );
}
