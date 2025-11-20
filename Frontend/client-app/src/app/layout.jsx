"use client";

import { useMemo } from "react";
import { usePathname } from "next/navigation";
import { Geist, Geist_Mono } from "next/font/google";

import AppLayout from "@/components/layout/AppLayout";
import LandingLayout from "@/app/landingPage/LandingLayout";
import RegistrationLayout from "@/app/registration/RegistrationLayout";
import LoginLayout from "@/app/login/LoginLayout";
import BookingLayout from "@/app/booking/BookingLayout";

const geistSans = Geist({ variable: "--font-geist-sans", subsets: ["latin"] });
const geistMono = Geist_Mono({ variable: "--font-geist-mono", subsets: ["latin"] });

function getCookie(name) {
    if (typeof document === "undefined") return null;
    const match = document.cookie.match(new RegExp("(^|; )" + name + "=([^;]*)"));
    return match ? decodeURIComponent(match[2]) : null;
}

function resolveLayout(pathname, isAuthenticated) {
    const isRegistration =
        pathname === "/registration" || pathname.startsWith("/registration/");
    const isLogin = pathname === "/login" || pathname.startsWith("/login/");
    const isBooking = pathname === "/booking" || pathname.startsWith("/booking/");

    // 1) Rotas especiais têm prioridade
    if (isRegistration) return RegistrationLayout;
    if (isLogin) return LoginLayout;
    if (isBooking) return BookingLayout; // aqui decides se queres proteger por login

    // 2) Resto da app
    if (isAuthenticated) return AppLayout;

    // 3) Visitantes
    return LandingLayout;
}

export default function RootLayout({ children }) {
    const pathname = usePathname() || "/";

    // Autenticação por cookie
    const token = useMemo(() => getCookie("auth-token"), []);
    const isAuthenticated = Boolean(token);

    const Layout = resolveLayout(pathname, isAuthenticated);

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
