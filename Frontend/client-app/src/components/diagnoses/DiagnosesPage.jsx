'use client'

import Card from "@/components/ui/Card";
import {useState} from "react";

export default function DiagnosesPage(){

    const names = ['Diagnoses', 'Treatment', 'Progress Notes'];

    const diagnosisData = {
        western_diagnosis: "Chronic Lower Back Pain",
        tcm_diagnosis: "Kidney Yang Deficiency with Blood Stasis",
        severity: "Moderate",
        diagnostic_date: "2024-09-15",
        symptoms: ["Lower back stiffness", "Cold limbs", "Fatigue", "Sleep disturbances"],
        pulse_quality: "Deep and slow",
        tongue_description: "Pale with white coating"
    };

    const [activeButton, setActiveButton] = useState('diagnosis');

    function handleClick(key){
        setActiveButton(key);
    }

    return <div>
        <div className="flex flex-row justify-between">
            <h2>Diagnoses & Treatment</h2>
            <div className="space-x-2">
                <button className="rounded-lg border border-amber-200 py-1 px-2 hover:text-yellow-600 hover:bg-gray-50">+  New Diagnosis</button>
                <button className="rounded-lg bg-yellow-600 text-white py-1 px-2 hover:bg-yellow-500">+  New Treatment</button>
            </div>
            </div>

        <ButtonRow names={names} activeButton={activeButton} handleClick={handleClick}/>

        <div className="mt-4">
            {activeButton === names[0].toLowerCase() ?
                <div>
                    <DiagnosisCard {...diagnosisData}/>
                    <DiagnosisCard {...diagnosisData}/>
                </div>
                : '' }
            {activeButton === names[1].toLowerCase() ? <Card title={names[1]}/> : '' }
            {activeButton === names[2].toLowerCase() ? <Card title={names[2]}/> : '' }
        </div>

    </div>

}

// We pass the names for the buttons, potentially also the buttons in the future
// Depending on which is clicked, we shift the activeButton variable, which is used to determine which card is displayed
function ButtonRow({names, activeButton, handleClick}){
    return <div className="flex flex-row mt-4 rounded-lg w-fit h-fit p-1 text-center bg-gray-100">
        {names.map((name) => (
            <button
                key={name.toLowerCase()}
                className={"rounded-lg text-sm px-2 " + (name.toLowerCase() === activeButton ? "bg-white" : "")}
                onClick={() => handleClick(name.toLowerCase())}
            >
                {name}
            </button>
        ))}
    </div>
}

function DiagnosisCard({diagnostic_date, western_diagnosis, tcm_diagnosis, severity, symptoms, pulse_quality, tongue_description}){
    return <section
        className="rounded-2xl border border-amber-100 p-4 bg-white flex flex-col justify-between">
        <div className="flex flex-row justify-between">
            <div className="flex flex-col">
                <span>{western_diagnosis}</span>
                <span className="text-gray-500">{tcm_diagnosis}</span>
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