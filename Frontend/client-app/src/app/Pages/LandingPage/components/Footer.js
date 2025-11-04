const Footer = () => {
    return (
        <footer className="border-t bg-gray-50 py-12">
            <div className="container mx-auto px-4">
                <div className="grid grid-cols-1 md:grid-cols-4 gap-8">
                    <div>
                        <span className="text-lg">QiFlow</span>
                        <p className="text-sm text-muted-foreground">Mestre José Machado - especializado em perda de peso através da medicina tradicional chinesa.</p>
                    </div>
                    <div>
                        <h4 className="mb-4">Serviços</h4>
                        <div className="space-y-2 text-sm text-muted-foreground">
                            <div>Acupunctura para Perda de Peso</div>
                            <div>Medicina Tradicional Chinesa</div>
                            <div>Acompanhamento Nutricional</div>
                            <div>Coaching de Bem-estar</div>
                        </div>
                    </div>
                    <div>
                        <h4 className="mb-4">Contactos</h4>
                        <div className="space-y-2 text-sm text-muted-foreground">
                            <div className="flex items-center gap-2">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" className="lucide lucide-phone w-4 h-4" aria-hidden="true"><path d="M13.832 16.568a1 1 0 0 0 1.213-.303l.355-.465A2 2 0 0 1 17 15h3a2 2 0 0 1 2 2v3a2 2 0 0 1-2 2A18 18 0 0 1 2 4a2 2 0 0 1 2-2h3a2 2 0 0 1 2 2v3a2 2 0 0 1-.8 1.6l-.468.351a1 1 0 0 0-.292 1.233 14 14 0 0 0 6.392 6.384"></path></svg>
                                +351 912 345 678
                            </div>
                            <div className="flex items-center gap-2">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" className="lucide lucide-mail w-4 h-4" aria-hidden="true"><path d="m22 7-8.991 5.727a2 2 0 0 1-2.009 0L2 7"></path><rect x="2" y="4" width="20" height="16" rx="2"></rect></svg>
                                jose@qiflow.pt
                            </div>
                            <div>Segunda a Sexta: 9h-19h</div>
                            <div>Sábado: 9h-13h</div>
                        </div>
                    </div>
                </div>
            </div>
        </footer>
    );
};

export default Footer;
