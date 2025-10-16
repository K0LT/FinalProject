export default function Header() {
    return (
        <header className="site-header">
            <div className="container inner">
                <div className="brand">
                    <div className="brand-logo">
                        <img src="#" alt="Logo" />
                    </div>
                    <div>
                        <div className="brand-title">QiFlow</div>
                        <div className="brand-sub">Mestre José Machado</div>
                    </div>
                </div>

                <div className="actions" style={{display:"flex", gap:"12px"}}>
                    <button className="btn btn--white">Entrar</button>
                    <button className="btn btn--gold">Registar-me</button>
                </div>
            </div>
        </header>
    );
}
