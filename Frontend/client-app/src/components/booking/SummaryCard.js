import React from "react";
import CardBooking from "./CardBooking";

export default function SummaryCard() {
    return (
        <CardBooking title="Resumo da Marcação">
            <div className="space-y-4">
                <div>
                    <p className="text-sm text-muted-foreground">Data</p>
                    <p className="font-medium">sexta-feira, 14 de novembro de 2025</p>
                </div>
            </div>
        </CardBooking>
    );
}
