'use client'

import Card from "@/components/ui/Card";
import {useEffect, useState} from "react";
import {getDiagnostics} from "@/services/diagnostics";
import TreatmentsCard from "@/components/treatments/Treatments";
import {getTreatments} from "@/services/treatments";
import NewDiagnosticModal from "@/components/diagnoses/NewDiagnosticModal";
import ButtonRow from "@/components/ui/ButtonRow";
import DiagnosisCard from "@/components/diagnoses/DiagnosisCard";
import {useParams} from "next/navigation";
import NewTreatmentModal from "@/components/treatments/NewTreatmentModal";
import {login} from "@/services/login"

export default function DiagnosesPage() {
    // These names are passed down to the buttons to swap the current card displays
    const names = ['Diagnoses', 'Treatment', 'Progress Notes'];

    const [activeButton, setActiveButton] = useState('diagnoses');
    const [diagOpen, setDiagOpen] = useState(false);
    const [treatOpen, setTreatOpen] = useState(false);

    // This is how we grab information from the dynamic URL functionality provided by next
    const params = useParams();

    const [diagnostics, setDiagnostics] = useState([]);
    const [treatments, setTreatments] = useState([]);

    const [error, setError] = useState(null);
    const [loading, setLoading] = useState(true);

    useEffect(() => {
        const ctrl = new AbortController();
        (async () => {
            try {
                const loginResult = await login({
                    email: "admin@example.com",
                    password: "atec123",
                });

                const diagData = await getDiagnostics(params?.id);
                const treatData = await getTreatments(params?.id);

                setDiagnostics(Array.isArray(diagData) ? diagData : []);
                setTreatments(Array.isArray(treatData) ? treatData : []);
            } catch (e) {
                if (e.name !== "CanceledError") setError(e);
            } finally {
                setLoading(false);
            }
        })();
        return () => ctrl.abort();
    }, [params?.id]);

    function handleClick(key) {
        setActiveButton(key);
    }

    return (
        <div>
            {loading ? <div></div> : <NewDiagnosticModal open={diagOpen} onClose={() => setDiagOpen(false)}/>}
            <NewTreatmentModal open={treatOpen} onClose={() => setTreatOpen(false)}/>

            <div className="flex flex-row justify-between">
                <h2>Diagnoses & Treatment</h2>
                <div className="space-x-2">
                    <button
                        className="rounded-lg border border-amber-200 py-1 px-2 hover:text-yellow-600 hover:bg-gray-50"
                        onClick={() => setDiagOpen(true)}>
                        + New Diagnosis
                    </button>
                    <button className="rounded-lg bg-yellow-600 text-white py-1 px-2 hover:bg-yellow-500"
                        onClick={() => setTreatOpen(true)}>
                        + New Treatment
                    </button>
                </div>
            </div>

            <ButtonRow names={names} activeButton={activeButton} handleClick={handleClick} />

            <div className="mt-4">
                {activeButton === names[0].toLowerCase() && (
                    <>
                        {loading && <div>Loading…</div>}
                        {!loading && error && <div className="text-red-600">Failed to load diagnostics.</div>}
                        {!loading && !error && diagnostics.length === 0 && (
                            <div className="text-gray-500">No diagnoses yet.</div>
                        )}
                        {!loading && !error && diagnostics.length > 0 && (
                            <div>
                                {diagnostics.map((d, idx) => {
                                    const symptoms =
                                        Array.isArray(d.symptoms) ? d.symptoms
                                            : typeof d.symptoms === 'string'
                                                ? d.symptoms.split(',').map(s => s.trim()).filter(Boolean)
                                                : [];

                                    return <DiagnosisCard key={d.id ?? idx} {...d} symptoms={symptoms} />;
                                })}
                            </div>
                        )}
                    </>
                )}
                {activeButton === names[1].toLowerCase() && (
                    <>
                        {loading && <div>Loading…</div>}
                        {!loading && error && <div className="text-red-600">Failed to load treatments.</div>}
                        {!loading && !error && treatments.length === 0 && (
                            <div className="text-gray-500">No treatments yet.</div>
                        )}
                        {!loading && !error && treatments.length > 0 && (
                            <div>
                                {treatments.map((t, idx) => {
                                    const acupoints_used =
                                        Array.isArray(t.acupoints_used) ? t.acupoints_used
                                            : typeof t.acupoints_used === 'string'
                                                ? t.acupoints_used.split(',').map(s => s.trim()).filter(Boolean)
                                                : [];

                                    return <TreatmentsCard key={t.id ?? idx} {...t} acupoints_used={acupoints_used} />;
                                })}
                            </div>
                        )}
                    </>
                )}

                {activeButton === names[2].toLowerCase() && <Card title={names[2]} />}
            </div>
        </div>
    );
}