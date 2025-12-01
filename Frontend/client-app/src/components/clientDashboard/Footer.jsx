"use client";

import React from "react";

export default function Footer() {
    return (
        <footer className="h-12 border-t bg-white flex items-center justify-between px-4 sm:px-6 text-xs sm:text-sm text-gray-600">
            <span>© {new Date().getFullYear()} QiFlow - Medicina Tradicional Chinesa</span>
            <span className="opacity-70">v1.0</span>
        </footer>
    );
}
