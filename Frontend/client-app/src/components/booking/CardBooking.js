import React from "react";

export default function CardBooking({ title, description, children, sticky }) {
    return (
        <div
            data-slot="card"
            className={`bg-card text-card-foreground flex flex-col gap-6 rounded-xl border ${
                sticky ? "sticky top-4" : ""
            }`}
        >
            {(title || description) && (
                <div
                    data-slot="card-header"
                    className="@container/card-header grid auto-rows-min grid-rows-[auto_auto] items-start gap-1.5 px-6 pt-6 [.border-b]:pb-6 has-data-[slot=card-action]:grid-cols-[1fr_auto]"
                >
                    {title && (
                        <h4
                            data-slot="card-title"
                            className="flex items-center gap-2 leading-none"
                        >
                            {title}
                        </h4>
                    )}
                    {description && (
                        <p
                            data-slot="card-description"
                            className="text-sm text-muted-foreground"
                        >
                            {description}
                        </p>
                    )}
                </div>
            )}

            <div data-slot="card-content" className="px-6 [&:last-child]:pb-6">
                {children}
            </div>
        </div>
    );
}
