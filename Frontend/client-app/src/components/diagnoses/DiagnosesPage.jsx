'use client'

import Card from "@/components/ui/Card";
import {useState} from "react";

export default function DiagnosesPage(){

    const names = ['Diagnosis', 'Treatment', 'Progress Notes'];

    const [activeButton, setActiveButton] = useState('diagnosis');

    function handleClick(key){
        setActiveButton(key);
    }

    return <div>
        <h2>Diagnosis & Treatment</h2>
        <ButtonRow names={names} activeButton={activeButton} handleClick={handleClick}/>
        <div className="mt-4">
            <Card title="Diagnostic Info"/>
        </div>
    </div>

}


function ButtonRow({names, activeButton, handleClick}){
    return <div className="flex flex-row mt-4 rounded-lg w-fit h-fit p-1 text-center bg-gray-200">
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