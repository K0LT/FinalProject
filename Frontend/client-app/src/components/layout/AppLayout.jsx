import Sidebar from "./Sidebar";
import Topbar from "./Topbar";
import Footer from "./Footer";

export default function AppLayout({ children }) {
    // In the future, we need to have the userID selected at this point
    // We will use a static variable for the time being
    const userId = 4;

    return (
        <div className="min-h-screen flex">
            {/* Sidebar */}
            <aside className="w-60 bg-white border-r shadow-sm flex-shrink-0">
                <Sidebar props={{userId: userId}}/>
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