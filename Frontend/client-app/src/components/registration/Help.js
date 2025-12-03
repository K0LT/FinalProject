import React from 'react';
import { Shield, Phone, Mail, MapPin } from 'lucide-react';

const Help = () => {
    return (
        <div className="space-y-8">
            <div className="flex items-center gap-3 p-4 bg-green-50 rounded-lg border border-green-200">
                <Shield className="w-5 h-5 text-green-600" />
                <div>
                    <p className="text-sm text-green-800">Dados 100% seguros</p>
                    <p className="text-xs text-green-600">Conformidade RGPD garantida</p>
                </div>
            </div>
            <div className="text-card-foreground flex flex-col gap-6 rounded-xl border-0 bg-white/70 backdrop-blur-sm">
                <div className="[&:last-child]:pb-6 p-6">
                    <h3 className="text-lg mb-4">Precisa de Ajuda?</h3>
                    <div className="space-y-3">
                        <div className="flex items-center gap-3">
                            <Phone className="w-4 h-4 text-primary" />
                            <div>
                                <p className="text-sm">+351 912 345 678</p>
                                <p className="text-xs text-muted-foreground">Segunda a Sexta: 9h-19h</p>
                            </div>
                        </div>
                        <div className="flex items-center gap-3">
                            <Mail className="w-4 h-4 text-primary" />
                            <div>
                                <p className="text-sm">jose@qiflow.pt</p>
                                <p className="text-xs text-muted-foreground">Resposta em 24h</p>
                            </div>
                        </div>
                        <div className="flex items-center gap-3">
                            <MapPin className="w-4 h-4 text-primary" />
                            <div>
                                <p className="text-sm">Rua do Bem-Estar, 123</p>
                                <p className="text-xs text-muted-foreground">1200-001 Lisboa</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    );
};

export default Help;