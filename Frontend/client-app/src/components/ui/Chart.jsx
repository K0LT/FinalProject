"use client";
import React from "react";
import { cn } from "./button";


export function ChartContainer({ id, className, children, config = {}, ...props }) {
    const uniqueId = React.useId().replace(/:/g, "");
    const chartId = `chart-${id || uniqueId}`;
    return (
        <div data-slot="chart" data-chart={chartId}
             className={cn("flex aspect-video justify-center text-xs", className)} {...props}>
            {children}
        </div>
    );
}

export function ChartStyle(){ return null; }
export const ChartTooltip = ({ children }) => children ?? null;
export function ChartTooltipContent(){ return null; }
export const ChartLegend = ({ children }) => <div className="pt-3 flex items-center justify-center gap-4">{children}</div>;
export function ChartLegendContent(){ return null; }
