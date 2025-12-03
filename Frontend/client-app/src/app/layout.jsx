"use client";

import { useMemo } from "react";
import { usePathname } from "next/navigation";
import { Geist, Geist_Mono } from "next/font/google";

import AppLayout from "@/components/layout/AppLayout";
import LandingLayout from "@/app/landingPage/LandingLayout";
import RegistrationLayout from "@/app/registration/RegistrationLayout";
import LoginLayout from "@/app/login/LoginLayout";
import BookingLayout from "@/app/booking/BookingLayout";
import DashboardLayout from "@/app/dashboard/DashboardLayout";
import ClientDashLayout from "@/app/clientdashboard/ClientDashLayout";

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
    const isDashboard =
        pathname === "/dashboard" || pathname.startsWith("/dashboard");
    const isClientDashboard =
        pathname === "/clientdashboard" || pathname.startsWith("/clientdashboard");
    if (isRegistration) return RegistrationLayout;
    if (isLogin) return LoginLayout;
    if (isBooking) return BookingLayout;
    if (isClientDashboard) return ClientDashLayout;
    if (isDashboard) return DashboardLayout;

    // DEFAULT FOR NOW
    if (isAuthenticated) return LandingLayout;
    return LandingLayout;
}

export default function RootLayout({ children }) {
    const pathname = usePathname() || "/";
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
