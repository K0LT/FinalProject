export default function Topbar() {
    const today = new Date().toLocaleDateString('pt-PT', {
        weekday: 'long',
        day: 'numeric',
        month: 'long',
        year: 'numeric'
    });

    return (
        <div className="h-14 px-6 flex items-center justify-between bg-white">
            {/* Date */}
            <div className="flex items-center gap-2 text-sm text-gray-600">
                <svg className="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path strokeLinecap="round" strokeLinejoin="round" strokeWidth={2} d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                </svg>
                <span className="capitalize">{today}</span>
            </div>

            {/* User Info */}
            <div className="flex items-center gap-3">
                <div className="text-right">
                    <div className="text-sm font-medium text-gray-900">José Machado</div>
                    <div className="text-xs text-gray-500">Acupunturista</div>
                </div>
                <div className="w-10 h-10 rounded-full bg-yellow-500 flex items-center justify-center text-white font-semibold">
                    JM
                </div>
            </div>
        </div>
    );
}