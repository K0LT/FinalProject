import { Geist, Geist_Mono } from "next/font/google";
import "./globals.css";
import { AuthProvider } from '@/context/AuthContext';
import DevControlPanel from "@/components/Auth/DevControlPanel";

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
        <AuthProvider>
            {children}

            {process.env.NODE_ENV === 'development' && <DevControlPanel />}
        </AuthProvider>
        </body>
        </html>
    );
}