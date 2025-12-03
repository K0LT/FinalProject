import React from "react";
import CardBooking from "./CardBooking";
import { UserIcon } from "./icons";

export default function PatientDataCard() {
    return (
        <CardBooking
            title={
                <>
                    <UserIcon className="h-5 w-5" />
                    4. Os Seus Dados
                </>
            }
            description="Preencha os seus dados para confirmarmos a consulta"
        >
            <form className="space-y-4">
                <div className="space-y-2">
                    <label
                        htmlFor="name"
                        data-slot="label"
                        className="flex select-none items-center gap-2 text-sm font-medium leading-none"
                    >
                        Nome Completo *
                    </label>
                    <input
                        type="text"
                        id="name"
                        data-slot="input"
                        className="border-input bg-input-background file:text-foreground placeholder:text-muted-foreground selection:bg-primary selection:text-primary-foreground dark:bg-input/30 flex h-9 w-full min-w-0 rounded-md border px-3 py-1 text-base outline-none transition-[color,box-shadow] focus-visible:border-ring focus-visible:ring-[3px] focus-visible:ring-ring/50 md:text-sm"
                        placeholder="Seu nome completo"
                        required
                    />
                </div>

                <div className="grid grid-cols-1 gap-4 md:grid-cols-2">
                    <div className="space-y-2">
                        <label
                            htmlFor="email"
                            data-slot="label"
                            className="flex select-none items-center gap-2 text-sm font-medium leading-none"
                        >
                            Email *
                        </label>
                        <input
                            type="email"
                            id="email"
                            data-slot="input"
                            className="border-input bg-input-background file:text-foreground placeholder:text-muted-foreground selection:bg-primary selection:text-primary-foreground dark:bg-input/30 flex h-9 w-full min-w-0 rounded-md border px-3 py-1 text-base outline-none transition-[color,box-shadow] focus-visible:border-ring focus-visible:ring-[3px] focus-visible:ring-ring/50 md:text-sm"
                            placeholder="seu@email.com"
                            required
                        />
                    </div>

                    <div className="space-y-2">
                        <label
                            htmlFor="phone"
                            data-slot="label"
                            className="flex select-none items-center gap-2 text-sm font-medium leading-none"
                        >
                            Telefone *
                        </label>
                        <input
                            type="tel"
                            id="phone"
                            data-slot="input"
                            className="border-input bg-input-background file:text-foreground placeholder:text-muted-foreground selection:bg-primary selection:text-primary-foreground dark:bg-input/30 flex h-9 w-full min-w-0 rounded-md border px-3 py-1 text-base outline-none transition-[color,box-shadow] focus-visible:border-ring focus-visible:ring-[3px] focus-visible:ring-ring/50 md:text-sm"
                            placeholder="+351 912 345 678"
                            required
                        />
                    </div>
                </div>

                <div className="space-y-2">
                    <label
                        htmlFor="message"
                        data-slot="label"
                        className="flex select-none items-center gap-2 text-sm font-medium leading-none"
                    >
                        Mensagem (opcional)
                    </label>
                    <textarea
                        id="message"
                        data-slot="textarea"
                        className="border-input bg-input-background resize-none selection:bg-primary selection:text-primary-foreground dark:bg-input/30 flex min-h-16 w-full rounded-md border px-3 py-2 text-base outline-none transition-[color,box-shadow] focus-visible:border-ring focus-visible:ring-[3px] focus-visible:ring-ring/50 md:text-sm"
                        placeholder="Descreva brevemente o motivo da consulta ou questões específicas..."
                        rows={3}
                    />
                </div>

                <button
                    type="submit"
                    data-slot="button"
                    disabled
                    className="inline-flex h-10 w-full items-center justify-center gap-2 whitespace-nowrap rounded-md bg-primary px-6 text-sm font-medium text-primary-foreground transition-all hover:bg-primary/90 disabled:pointer-events-none disabled:opacity-50"
                >
                    Confirmar Marcação
                </button>
            </form>
        </CardBooking>
    );
}
