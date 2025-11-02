"use client";

import { usePathname } from "next/navigation";
import Sidebar from "./Sidebar";
import Topbar from "./Topbar";
import Footer from "./Footer";
import LandingPage from "../../app/Pages/LandingPage/page";

export default function AppLayout({ children }) {
    const pathname = usePathname();

    // Se estiver na homepage, mostra apenas a Landing Page (sem sidebar/topbar/footer)
    if (pathname === "/" || pathname === "/LandingPage") {
        return <LandingPage />;
    }

    // Caso contrário, mostra o layout completo da aplicação
    return (
        <div className="min-h-screen flex">
            {/* Sidebar */}
            <aside className="w-60 bg-white border-r shadow-sm flex-shrink-0">
                <Sidebar />
            </aside>

            {/* Main Area */}
            <div className="flex-1 flex flex-col min-w-0">
                {/* Topbar */}
                <header className="h-14 bg-white sticky top-0 z-40">
                    <Topbar />
                </header>

                {/* Content */}
                <main className="flex-1 overflow-y-auto">
                    <div className="p-6">{children}</div>
                </main>

                {/* Footer */}
                <footer className="h-12 border-t bg-white">
                    <Footer />
                </footer>
            </div>
        </div>
    );
}
