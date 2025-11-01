import { Geist, Geist_Mono } from "next/font/google";
import AppLayout from "@/components/layout/AppLayout";
import "./globals.css";

const geistSans = Geist({
  variable: "--font-geist-sans",
  subsets: ["latin"],
});

const geistMono = Geist_Mono({
  variable: "--font-geist-mono",
  subsets: ["latin"],
});

export const metadata = {
  title: "Qiflow",
  description: "Sistema de gestão para acupuntura",
};

export default function RootLayout({ children }) {
  return (
      <html lang="pt-PT">
      <body className={`${geistSans.variable} ${geistMono.variable}`}>
      <AppLayout>
        {children}
      </AppLayout>
      </body>
      </html>
  );
}