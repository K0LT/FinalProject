import { Geist, Geist_Mono } from "next/font/google";
import "./globals.css";
import { DevAuthProvider } from '@/context/DevAuthProvider';
import DevControlPanel from "@/components/Auth/DevControlPanel";

import LandingLayout from '@/components/landingPage/LandingLayout'
import DashboardSidebarLayout from "@/components/dashboard/DashboardLayout";
import ClientDashLayout from "@/components/clientDashboard/ClientDashLayout";

const geistSans = Geist({
    variable: "--font-geist-sans",
    subsets: ["latin"],
});

const geistMono = Geist_Mono({
    variable: "--font-geist-mono",
    subsets: ["latin"],
});

export const metadata = {
    title: "Sistema de Autenticação",
    description: "Sistema seguro de autenticação",
};

export default function RootLayout({ children }) {

    return (
        <html lang="pt-PT">
        <body className={`${geistSans.variable} ${geistMono.variable} antialiased`} suppressHydrationWarning>
            <DevAuthProvider>
                    {children}
                    {process.env.NODE_ENV === 'development' && <DevControlPanel />}
            </DevAuthProvider>
        </body>
        </html>
    );
}