export default function ShieldInfo() {
    return (
        <div className="flex items-center justify-center gap-3 p-4 bg-green-50 rounded-lg border border-green-200">
            <svg className="w-5 h-5 text-green-600" viewBox="0 0 24 24" fill="none" stroke="currentColor">
                <path d="M20 13c0 5-3.5 7.5-7.66 8.95a1 1 0 0 1-.67-.01C7.5 20.5 4 18 4 13V6a1 1 0 0 1 1-1c2 0 4.5-1.2 6.24-2.72a1.17 1.17 0 0 1 1.52 0C14.51 3.81 17 5 19 5a1 1 0 0 1 1 1z"/>
            </svg>
            <div className="text-center">
                <p className="text-sm text-green-800">Dados seguros e protegidos</p>
                <p className="text-xs text-green-600">Conformidade RGPD garantida</p>
            </div>
        </div>
    );
}
