"use client";
import React from "react";
import { cn } from "./Button";

export function Pagination({ className, children, ...props }) {
    return (
        <nav
            role="navigation"
            className={cn("mx-auto flex w-full justify-center", className)}
            {...props}
        >
            <ul className="flex flex-row items-center gap-1">{children}</ul>
        </nav>
    );
}

export const PaginationContent = ({ className, ...p }) => (
    <ul className={cn("flex flex-row items-center gap-1", className)} {...p} />
);

export const PaginationItem = ({ className, ...p }) => (
    <li className={cn("", className)} {...p} />
);

export function PaginationLink({
                                   className,
                                   active,
                                   ...props
                               }) {
    return (
        <a
            aria-current={active ? "page" : undefined}
            className={cn(
                "h-9 w-9 flex items-center justify-center rounded-md border text-sm transition-colors",
                active
                    ? "bg-primary text-primary-foreground"
                    : "hover:bg-accent hover:text-accent-foreground",
                className
            )}
            {...props}
        />
    );
}

export const PaginationPrevious = (p) => (
    <PaginationLink {...p}>‹</PaginationLink>
);
export const PaginationNext = (p) => (
    <PaginationLink {...p}>›</PaginationLink>
);
export const PaginationEllipsis = () => <span className="px-2">…</span>;
