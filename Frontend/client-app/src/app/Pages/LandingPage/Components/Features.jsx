import React from "react";
function Feature({ title, desc }) {
    return (
        <div className="card">
            <div className="body feature-body">
                <div className="feature-icon">★</div>
                <h3 className="feature-title">{title}</h3>
                <p className="feature-desc">{desc}</p>
            </div>
        </div>
    );
}

export default function Features() {
    const data = [
        ["Acompanhamento Personalizado", "Planos individualizados com foco na perda de peso sustentável"],
        ["Análise Detalhada", "Monitorização da composição corporal e progresso semanal"],
        ["Experiência Comprovada", "15+ anos em medicina tradicional chinesa"],
        ["Resultados Garantidos", "Metodologia com 95% de taxa de sucesso"],
    ];

    return (
        <section className="section bg-white">
            <div className="container">
                <div className="text-center section-header">
                    <h2>Por que escolher o QiFlow?</h2>
                    <p className="text-muted text-max">
                        Metodologia única que combina tradição oriental com tecnologia moderna
                    </p>
                </div>

                <div className="grid-4">
                    {data.map(([title, desc], i) => (
                        <Feature key={i} title={title} desc={desc} />
                    ))}
                </div>
            </div>
        </section>
    );
}
