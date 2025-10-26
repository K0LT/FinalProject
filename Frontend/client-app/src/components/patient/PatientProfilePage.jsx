'use client'
import {use, useEffect, useState} from "react";
import {getPatient} from "@/services/clients";
import InfoRow from "@/components/ui/InfoRow";
import Card from "@/components/ui/Card";

export function PatientProfilePage({params}) {
    const [patient, setPatient] = useState([]);
    const [error, setError] = useState(null);
    const [loading, setLoading] = useState(true);

    const slug = use(params);

    useEffect(() => {
        const ctrl = new AbortController();
        (async () => {
            try {
                const data = await getPatient(slug.id);
                setPatient(data);
                console.log("Fetched patient:", data);
            } catch (e) {
                if (e.name !== "CanceledError") setError(e);
                console.error("Error:", e);
            } finally {
                setLoading(false);
            }
        })();
        return () => ctrl.abort();
    }, []);


    useEffect(() => {
        if (patient) console.log("State updated:", patient);
    }, [patient]);

    if (error) return <div className="p-6 text-red-600">Falha ao carregar.</div>;
    if (!patient) return <div className="p-6">A carregar…</div>;
    return (
        <PatientHeaderCard patient={patient}/>
    );


}

function PatientHeaderCard({ patient }) {
    return (
        <div className="flex flex-col">
            <div className="flex flex-row space-x-2">
                <div id="patientIcon" className="flex">ICON</div>
                <div className="flex flex-col w-full">
                    <span className="flex">FIRST NAME</span>
                    <span className="flex">Patient ID info</span>
                </div>
            </div>
        </div>
    );
}