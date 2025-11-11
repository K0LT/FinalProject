"use client";

import { useMemo } from "react";
import { usePathname } from "next/navigation";
import { Geist, Geist_Mono } from "next/font/google";

import AppLayout from "@/components/layout/AppLayout";
import LandingLayout from "@/app/landingPage/LandingLayout";
import RegistrationLayout from "@/app/registration/RegistrationLayout";
import LoginLayout from "@/app/login/LoginLayout"; // <-- novo import

const geistSans = Geist({ variable: "--font-geist-sans", subsets: ["latin"] });
const geistMono = Geist_Mono({ variable: "--font-geist-mono", subsets: ["latin"] });

function getCookie(name) {
    if (typeof document === "undefined") return null;
    const match = document.cookie.match(new RegExp("(^|; )" + name + "=([^;]*)"));
    return match ? decodeURIComponent(match[2]) : null;
}

export default function RootLayout({ children }) {
    const pathname = usePathname() || "/";

    // Identifica a rota atual
    const isRegistration = pathname === "/registration" || pathname.startsWith("/registration/");
    const isLogin = pathname === "/login" || pathname.startsWith("/login/");

    // Autenticação
    const token = useMemo(() => getCookie("auth-token"), []);
    const isAuthenticated = Boolean(token);

    const Layout = isRegistration
        ? RegistrationLayout
        : isLogin
            ? LoginLayout
            : isAuthenticated
                ? AppLayout
                : LandingLayout;

    return (
        <html lang="pt-PT">
        <body
            className={`${geistSans.variable} ${geistMono.variable} overflow-x-hidden antialiased`}
        >
        <Layout>{children}</Layout>
        </body>
        </html>
    );
}
