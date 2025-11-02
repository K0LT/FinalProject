"use client";
import React from "react";
import { cn } from "./Button";

export const Table = ({ className, ...p }) => (
    <div className="overflow-x-auto">
        <table className={cn("w-full text-sm border-collapse", className)} {...p} />
    </div>
);

export const TableHeader = (p)=><thead className="[&_tr]:border-b" {...p}/>;
export const TableBody = (p)=><tbody className="[&_tr:last-child]:border-0" {...p}/>;
export const TableFooter = (p)=><tfoot className="bg-gray-50 border-t font-medium" {...p}/>;
export const TableRow = (p)=><tr className="border-b hover:bg-gray-50" {...p}/>;
export const TableHead = (p)=><th className="px-2 py-1 text-left font-medium" {...p}/>;
export const TableCell = (p)=><td className="px-2 py-1 align-middle" {...p}/>;
export const TableCaption = (p)=><caption className="mt-2 text-sm text-gray-500" {...p}/>;
