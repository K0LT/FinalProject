import React from "react";
import CardBooking from "./CardBooking";
import { UserIcon, StarIcon } from "./icons";

export default function DoctorCard() {
    return (
        <CardBooking>
            <div className="space-y-4 text-center">
                <div className="mx-auto flex h-16 w-16 items-center justify-center rounded-full bg-primary/10">
                    <UserIcon className="h-8 w-8 text-primary" />
                </div>

                <div>
                    <h3 className="font-medium">Dr. José Machado</h3>
                    <p className="text-sm text-muted-foreground">
                        Especialista em Acupunctura
                    </p>
                </div>

                <div className="flex items-center justify-center gap-1">
                    {Array.from({ length: 5 }).map((_, i) => (
                        <StarIcon
                            key={i}
                            className="h-4 w-4 fill-yellow-400 text-yellow-400"
                        />
                    ))}
                    <span className="ml-2 text-sm text-muted-foreground">4.9/5</span>
                </div>
            </div>
        </CardBooking>
    );
}
