import { Pencil, Trash2 } from 'lucide-react';

const TreatmentInfo = ({ label, content, className = '' }) => (
    <div className={`flex flex-col ${className}`}>
        <span className="text-sm text-gray-600">{label}</span>
        <span className="text-sm text-gray-700">{content || 'Informação não disponível'}</span>
    </div>
);

const AcupointsList = ({ acupoints }) => (
    <div className="flex flex-row space-x-2 pt-1.5">
        {acupoints.length > 0 ? (
            acupoints.map((acupoint, index) => (
                <div
                    key={index}
                    className="border rounded-lg border-amber-200 text-sm px-2 py-1 bg-amber-50"
                >
                    {acupoint}
                </div>
            ))
        ) : (
            <span>Sem pontos de acupuntura</span>
        )}
    </div>
);

export default function TreatmentsCard({
                                           session_date_time,
                                           treatment_methods,
                                           acupoints_used = [],
                                           duration,
                                           notes,
                                           next_session,
                                       }) {
    const formattedDate = session_date_time ? session_date_time.slice(0, 10) : 'Data não disponível';
    const formattedNextSession = next_session || 'Data não disponível';

    return (
        <section className="rounded-2xl border border-amber-100 p-4 bg-white flex flex-col justify-between shadow-md hover:shadow-lg transition-shadow">
            <div className="flex flex-row justify-between">
                <div className="flex flex-col">
                    <span className="font-semibold text-lg text-primary">{treatment_methods}</span>
                    <div className="flex flex-row gap-3 text-sm text-gray-500">
                        <span>{formattedDate}</span>
                        <span>{duration} min</span>
                    </div>
                </div>
            </div>

            <div className="flex flex-col mt-4">
                <TreatmentInfo label="Pontos de Acupuntura" content={<AcupointsList acupoints={acupoints_used} />} />
            </div>

            <div className="flex flex-col mt-5 gap-y-2">
                <TreatmentInfo label="Técnica" content={treatment_methods} />
                <TreatmentInfo label="Notas" content={notes} className="text-gray-700" />
            </div>

            <div className="flex flex-col mt-2">
                <hr className="border-amber-200 border-0 mb-2" />
                <span className="font-semibold">Próxima Sessão</span>
                <span className="text-gray-500">{formattedNextSession}</span>
            </div>

            <div className="mt-4 flex justify-between">
                <button
                    className="flex items-center gap-2 text-sm text-primary bg-transparent hover:bg-primary/10 p-2 rounded-md transition"
                    aria-label="Editar tratamento"
                >
                    <Pencil className="w-4 h-4" />
                    Editar
                </button>
                <button
                    className="flex items-center gap-2 text-sm text-destructive bg-transparent hover:bg-destructive/10 p-2 rounded-md transition"
                    aria-label="Remover tratamento"
                >
                    <Trash2 className="w-4 h-4" />
                    Remover
                </button>
            </div>
        </section>
    );
}
