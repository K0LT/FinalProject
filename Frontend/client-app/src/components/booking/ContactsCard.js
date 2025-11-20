import React from "react";
import CardBooking from "./CardBooking";
import { PhoneIcon, MailIcon, MapPinIcon } from "./icons";

function ContactRow({ icon, line1, line2 }) {
    return (
        <div className="flex items-center gap-3">
            {icon}
            <div>
                <p className="text-sm">{line1}</p>
                <p className="text-xs text-muted-foreground">{line2}</p>
            </div>
        </div>
    );
}

export default function ContactsCard() {
    return (
        <CardBooking title={<span className="text-base">Contactos</span>}>
            <div className="space-y-3">
                <ContactRow
                    icon={<PhoneIcon className="h-4 w-4 text-primary" />}
                    line1="+351 912 345 678"
                    line2="Seg-Sex: 9h-19h"
                />
                <ContactRow
                    icon={<MailIcon className="h-4 w-4 text-primary" />}
                    line1="jose@qiflow.pt"
                    line2="Resposta em 24h"
                />
                <ContactRow
                    icon={<MapPinIcon className="h-4 w-4 text-primary" />}
                    line1="Rua do Bem-Estar, 123"
                    line2="1200-001 Lisboa"
                />
            </div>
        </CardBooking>
    );
}
