import Sidebar from "./Sidebar";
import Topbar from "./Topbar";
import Footer from "./Footer";

export default function AppLayout({ children }) {
    return (
        <div className="min-h-screen grid grid-cols-[18rem_minmax(0,1fr)] grid-rows-[auto_1fr_auto]">
            <aside className="row-span-3 border-r bg-white/90">
                <Sidebar />
            </aside>

            <header className="border-b bg-white/80 backdrop-blur sticky top-0 z-40">
                <Topbar />
            </header>

            <main className="overflow-y-auto">
                <div className="p-6">{children}</div>
            </main>

            <footer className="col-span-2 border-t bg-white">
                <Footer />
            </footer>
        </div>
    );
}