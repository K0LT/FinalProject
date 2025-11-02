"use client";
import React from "react";
import { cn } from "./Button";

const FieldCtx = React.createContext({ name: "", id: "" });

export const Form = ({ children }) => <>{children}</>;

export function FormItem({ className, children }) {
    const id = React.useId().replace(/:/g, "");
    return (
        <FieldCtx.Provider value={{ id }}>
            <div className={cn("grid gap-2", className)}>{children}</div>
        </FieldCtx.Provider>
    );
}

export function FormLabel({ className, ...props }) {
    const { id } = React.useContext(FieldCtx);
    return <label htmlFor={`${id}-control`} className={cn("text-sm font-medium", className)} {...props} />;
}

export function FormControl({ children }) {
    const { id } = React.useContext(FieldCtx);
    return React.cloneElement(children, { id: `${id}-control`, "aria-describedby": `${id}-desc` });
}

export const FormDescription = ({ className, ...p }) => {
    const { id } = React.useContext(FieldCtx);
    return <p id={`${id}-desc`} className={cn("text-sm text-gray-500", className)} {...p} />;
};
export const FormMessage = ({ className, children }) => children ? (
    <p className={cn("text-sm text-red-600", className)}>{children}</p>
) : null;

/* Compat helper para quem usava <FormField/> (no-op) */
export const FormField = ({ name, render }) => render?.({ field: { name } });
export const useFormField = () => React.useContext(FieldCtx);
