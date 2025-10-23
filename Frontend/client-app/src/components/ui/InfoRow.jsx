export default function InfoRow({ icon, children }) {
    return (
        <div className="flex items-center gap-2 text-sm">
            {icon}
            <span>{children}</span>
        </div>
    );
}