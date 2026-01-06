import Sidebar from "./Sidebar";
import Topbar from "./Topbar";
import Footer from "./Footer";

export default function AppLayout({ children }) {
    const userId = 4;

    return (
        <div className="min-h-screen flex">
            <aside className="w-60 bg-white border-r shadow-sm flex-shrink-0">
                <Sidebar props={{userId: userId}}/>
            </aside>

            <div className="flex-1 flex flex-col min-w-0">
                <header className="h-14 bg-white sticky top-0 z-40">
                    <Topbar />
                </header>

                <main className="flex-1 overflow-y-auto">
                    <div className="p-6">
                        {children}
                    </div>
                </main>

                <footer className="h-12 border-t bg-white">
                    <Footer />
                </footer>
            </div>
        </div>
    );
}


function PageExample({title}){
    return <div>
        <h1>{title}</h1>
    </div>
}