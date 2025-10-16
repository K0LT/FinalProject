export default function Footer(){
    return (
        <footer className="site-footer">
            <div className="container inner">
                <div className="grid-4">
                    <div>
                        <div style={{display:"flex", alignItems:"center", gap:8, marginBottom:12}}>
                            <div style={{width:24,height:24,background:"var(--primary)",borderRadius:"50%"}} />
                            <span style={{fontSize:"1.125rem", fontWeight:600}}>QiFlow</span>
                        </div>
                        <p className="muted">
                            Mestre José Machado – especializado em perda de peso através da medicina tradicional chinesa.
                        </p>
                    </div>

                    <div>
                        <h4>Serviços</h4>
                        <p className="muted">Acupunctura • MTC • Nutrição • Coaching</p>
                    </div>

                    <div>
                        <h4>Contactos</h4>
                        <p className="muted">+351 912 345 678<br/>jose@qiflow.pt</p>
                    </div>

                    <div>
                        <h4>Ligações Rápidas</h4>
                        <p className="muted">Marcar Consulta • Registar-me • Área de Cliente</p>
                    </div>
                </div>

                <div className="bottom mt-4">
                    © {new Date().getFullYear()} QiFlow. Todos os direitos reservados.
                </div>
            </div>
        </footer>
    );
}
