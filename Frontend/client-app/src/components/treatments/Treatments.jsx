export default function TreatmentsCard({session_date_time, treatment_methods, acupoints_used, duration, notes, next_session}){
    return <section
        className="rounded-2xl border border-amber-100 p-4 bg-white flex flex-col justify-between">
        <div className="flex flex-row justify-between">
            <div className="flex flex-col">
                <span>{treatment_methods}</span>
                <div className="flex flex-row gap-3">
                <span className="text-gray-500">{session_date_time.slice(0,10)}</span>
                <span className="text-gray-500">{duration} minutes</span>
                </div>
            </div>
        </div>
        <div className="flex flex-col mt-4">
            <span>Acupuncture Points</span>
            <div className="flex flex-row space-x-2 pt-1.5">{acupoints_used.map((acupoint) => (
                <div key={acupoint} className="border rounded-lg border-amber-200 text-sm px-1.5">{acupoint}</div>
            ))}</div>
        </div>
        <div className="flex flex-col mt-5 gap-y-2">
            <div className="flex flex-col w-full">
                <span className="text-gray-500">Technique</span>
                <span>{treatment_methods}</span>
            </div>
            <div className="flex flex-col w-full">
                <span className="text-gray-500">Notes</span>
                <span>{notes}</span>
            </div>
        </div>
        <div className="flex flex-col">
            <hr className="border-amber-200 border-0"/>
            <span className="text-gray-500">{next_session}</span>
        </div>
    </section>
}