export default function Footer() {
    return (
        <div className="h-12 px-4 flex items-center justify-between text-sm">
            <span>© {new Date().getFullYear()} QiFlow</span>
            <span className="opacity-70">v0.1</span>
        </div>
    );
}