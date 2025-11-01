export default function Card({ title, actions, children }) {
    return (
        <section className="rounded-2xl border border-amber-100 p-4 bg-white">
            {(title || actions) && (
                <div className="mb-3 flex items-center justify-between">
                    {title && <h3 className="font-medium">{title}</h3>}
                    {actions}
                </div>
            )}
            {children}
        </section>
    );
}