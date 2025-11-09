export default function DiagnosisCard({diagnostic_date, western_diagnosis, tcm_diagnosis, severity, symptoms, pulse_quality, tongue_description}){
    return <section
        className="rounded-2xl border border-amber-100 p-4 bg-white flex flex-col justify-between">
        <div className="flex flex-row justify-between">
            <div className="flex flex-col">
                <span>{western_diagnosis ? western_diagnosis : "DEFAULT WESTERN DIAGNOSIS"}</span>
                <span className="text-gray-500">{tcm_diagnosis ? tcm_diagnosis : "DEFAULT TCM DIAGNOSIS"}</span>
            </div>
            <div className="flex flex-col">
                <div className="space-x-2">
                    <span className="rounded-lg bg-yellow-600 text-xs pt-1 pb-0.5 text-white px-2">{severity}</span>
                    <span className="font-extralight text-gray-500 text-sm">{diagnostic_date}</span>
                </div>
            </div>
        </div>
        <div className="flex flex-col mt-5">
            <span>Symptoms</span>
            <div className="flex flex-row space-x-2 pt-1.5">{symptoms.map((symptom) => (
                <div key={symptom} className="border rounded-lg border-amber-200 text-sm px-1.5">{symptom}</div>
            ))}</div>
        </div>
        <div className="flex flex-row mt-5">
            <div className="flex flex-col w-full">
                <span className="text-gray-500">Pulse Quality</span>
                <span>{pulse_quality}</span>
            </div>
            <div className="flex flex-col w-full">
                <span className="text-gray-500">Tongue</span>
                <span>{tongue_description}</span>
            </div>
        </div>
    </section>
}