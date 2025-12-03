import React from "react";

const Footer = () => {
    return (
        <footer className="border-t bg-white/70 backdrop-blur-sm mt-8">
            <div className="container mx-auto px-4 py-6">
                <div className="flex flex-col md:flex-row items-center justify-between text-sm text-muted-foreground gap-3 md:gap-0">
                    <p>© 2026 QiFlow. Todos os direitos reservados.</p>

                    <div className="flex items-center gap-4">
                        <a
                            href="#"
                            className="hover:text-primary transition-colors"
                        >
                            Apoio ao Cliente
                        </a>
                        <span>•</span>
                        <a
                            href="/privacidade"
                            className="hover:text-primary transition-colors"
                        >
                            Privacidade
                        </a>
                        <span>•</span>
                        <a
                            href="/termos"
                            className="hover:text-primary transition-colors"
                        >
                            Termos
                        </a>
                    </div>
                </div>
            </div>
        </footer>
    );
};

export default Footer;
