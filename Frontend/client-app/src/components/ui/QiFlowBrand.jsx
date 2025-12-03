"use client";

import React from "react";

export default function QiFlowBrand({
                                        title = "QiFlow",
                                        subtitle = "Mestre José Machado",
                                        size = "md",
                                        className = "",
                                    }) {
    const sizeMap = {
        sm: "h-6 w-6",
        md: "h-8 w-8",
        lg: "h-10 w-10",
    };

    const iconSize = sizeMap[size] || sizeMap.md;

    return (
        <div className={`flex items-center gap-3 ${className}`}>
            <div className={`relative flex ${iconSize} items-center justify-center`} />

            <div className={`relative flex ${iconSize} items-center justify-center`}>
                <svg
                    viewBox="0 0 100 100"
                    className="h-full w-full"
                    xmlns="http://www.w3.org/2000/svg"
                >
                    <circle
                        cx="50"
                        cy="50"
                        r="48"
                        className="fill-[#B8860B] stroke-[#996F00] stroke-[2px] drop-shadow-lg"
                    />
                    <defs>
                        <radialGradient id="premiumGradient" cx="30%" cy="30%">
                            <stop offset="0%" stopColor="#FFD700" stopOpacity="0.9" />
                            <stop offset="100%" stopColor="#B8860B" stopOpacity="1" />
                        </radialGradient>
                        <pattern
                            id="premium-pattern"
                            x="0"
                            y="0"
                            width="6"
                            height="6"
                            patternUnits="userSpaceOnUse"
                        >
                            <circle cx="3" cy="3" r="0.4" className="fill-[#FFFACD]/30" />
                        </pattern>
                    </defs>

                    <circle cx="50" cy="50" r="42" fill="url(#premiumGradient)" />
                    <circle cx="50" cy="50" r="38" fill="url(#premium-pattern)" />

                    <g
                        className="fill-white stroke-white"
                        strokeWidth="1"
                        strokeLinecap="round"
                        strokeLinejoin="round"
                    >
                        <path
                            d="M 28 25 L 72 25"
                            strokeWidth="2.5"
                            opacity="0.95"
                            fill="none"
                        />
                        <path
                            d="M 50 25 L 50 75"
                            strokeWidth="2"
                            opacity="0.9"
                            fill="none"
                        />
                        <path
                            d="M 32 35 Q 38 40 32 45 Q 26 50 32 55"
                            strokeWidth="2"
                            opacity="0.85"
                            fill="none"
                        />
                        <path
                            d="M 68 35 Q 62 40 68 45 Q 74 50 68 55"
                            strokeWidth="2"
                            opacity="0.85"
                            fill="none"
                        />
                        <path
                            d="M 42 40 Q 50 35 58 40 Q 50 50 42 40"
                            strokeWidth="1.8"
                            opacity="0.8"
                            fill="none"
                        />
                        <path
                            d="M 35 65 L 65 65"
                            strokeWidth="2"
                            opacity="0.85"
                            fill="none"
                        />
                        <circle cx="38" cy="32" r="1" opacity="0.9" />
                        <circle cx="50" cy="30" r="1" opacity="0.9" />
                        <circle cx="62" cy="32" r="1" opacity="0.9" />
                    </g>

                    <circle
                        cx="50"
                        cy="50"
                        r="47"
                        className="stroke-[#FFD700]/70"
                        fill="none"
                        strokeWidth="0.8"
                    />
                    <circle
                        cx="50"
                        cy="50"
                        r="44"
                        className="stroke-[#FFFACD]/50"
                        fill="none"
                        strokeWidth="0.5"
                    />
                </svg>
            </div>

            <div>
                <h1 className="text-xl font-semibold text-primary">{title}</h1>
                <p className="text-xs text-muted-foreground">{subtitle}</p>
            </div>
        </div>
    );
}