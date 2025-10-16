import Stats from "./Stats";

export default function Hero() {
    return (
        <section className="section section--hero">
            <div className="container">
                <span className="badge badge--primary">
                    Método Inovador em Portugal – Medicina Tradicional Chinesa
                </span>

                <h1 className="section-title">
                    Perca Peso de Forma <span className="highlight">Natural e Sustentável</span>
                </h1>

                <p className="hero-subtext">
                    Combine a sabedoria milenar da Medicina Tradicional Chinesa com tecnologia moderna. <br />
                    Resultados comprovados em mais de 500 pacientes.
                </p>

                <div className="hero-actions">
                    <button className="btn btn--gold btn-lg">Marcar Consulta Gratuita</button>
                    <button className="btn btn--white btn-lg">Quero Transformar-me</button>
                </div>

                <Stats />
            </div>
        </section>
    );
}
