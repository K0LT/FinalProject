/*
{ TREATMENT FIELDS
    "id": 1,
    "diagnostic_id": 39,
    "patient_id": 14,
    "profile_id": 3,
    "session_date_time": "2025-06-08 18:41:04",
    "treatment_methods": "Exercícios de respiração",
    "acupoints_used": "CV4, BL32, SP6",
    "duration": 60,
    "notes": "Paciente apresentou melhora nos sintomas.",
    "next_session": "2026-09-16",
    "created_at": "2025-11-09T15:12:04.000000Z",
    "updated_at": "2025-11-09T15:12:04.000000Z"
},*/

import {useEffect, useRef, useState} from "react";
import {postDiagnostic} from "@/services/diagnostics";

export default function NewTreatmentModal({open, onClose}){
    const ref = useRef(null);

    const templateTreatment = {
        diagnostic_id: 39,
        patient_id: 14,
        profile_id: 3,
        // Check time format on debug
        session_date_time: Date.now(),
        treatment_methods: "Template Treatment",
        // Create hardcoded array of acupoints
        acupoints_used: "CV4, BL32, SP6",
        duration: 60,
        notes: "Patient shows improvement, etc..",
        next_session: Date.now(),
    }

    const [form, setForm] = useState(...templateTreatment);


    useEffect(() => {
        const dlg = ref.current;
        if (!dlg) return;
        if (open) dlg.showModal?.();
        else dlg.close?.();
    }, [open]);

    const handleBackdropClick = (event) => {
        if (event.target === ref.current) {
            ref.current?.close();
            onClose?.();
        }
    };

    const handleChange = (e) => {
        const { name, value } = e.target;
        setForm((prev) => ({ ...prev, [name]: value }));
    };

    const handleNumberChange = (e) => {
        const { name, value } = e.target;
        setForm((prev) => ({ ...prev, [name]: value === "" ? "" : Number(value) }));
    };

    const resetToTemplate = () => {
        setForm({ ...templateDiag });
    };

    const handleSubmit = (e) => {
        e.preventDefault();

        const payload = {
            ...form,
            patient_id: form.patient_id === "" ? null : Number(form.patient_id),
            diagnostic_id: form.diagnostic_id === "" ? null : Number(form.diagnostic_id),
            treatment_methods: form.treatment_methods?.trim() ? form.treatment_methods.trim() : null,
            notes: form.western_diagnostic?.trim() || "",
            tcm_diagnosis: form.tcm_diagnosis?.trim() || "",
            symptom_ids: selected.filter(s => s.isSelected).map(s => Number(s.id)),
            severity: form.severity || "",
            tongue_description: form.tongue_description?.trim() || "",
        };
        postDiagnostic(payload)
            .then((response) => {
            })
            .catch((error) => console.log(error));
        onClose();
        ref.current?.close();
    };

    const handleCancel = () => {
        ref.current?.close();
        onClose?.();
    };

    return (
        <dialog
            ref={ref}
            onClose={onClose}
            onClick={handleBackdropClick}
            className="max-w-3xl w-[92vw] p-0 rounded-2xl border shadow-xl backdrop:bg-black/40"
            style={{ margin: "auto" }}
        >
            <form onSubmit={handleSubmit} className="p-6">
                <header className="mb-4 flex items-center justify-between">
                    <h2 className="text-xl font-semibold tracking-tight">Novo Diagnóstico</h2>
                    <div className="space-x-2">
                        <button
                            type="button"
                            onClick={resetToTemplate}
                            className="rounded-md border px-3 py-1 text-sm hover:bg-gray-50"
                        >
                            RESET
                        </button>
                        <button
                            type="button"
                            onClick={handleCancel}
                            className="rounded-md border px-3 py-1 text-sm hover:bg-gray-50"
                        >
                            Cancelar
                        </button>
                        <button
                            type="submit"
                            className="rounded-md border px-4 py-1.5 text-sm font-medium hover:bg-gray-900 hover:text-white"
                        >
                            Guardar
                        </button>
                    </div>
                </header>

                {/* Meta */}
                <section className="grid grid-cols-1 md:grid-cols-2 gap-4 mb-6">
                    <div className="flex flex-col">
                        <label className="text-sm text-gray-600 mb-1" htmlFor="patient_id">
                            ID do Paciente
                        </label>
                        <input
                            id="patient_id"
                            name="patient_id"
                            type="number"
                            inputMode="numeric"
                            className="rounded-xl border px-3 py-2"
                            value={form.patient_id}
                            onChange={handleNumberChange}
                            placeholder="ex.: 17"
                            required
                        />
                    </div>
                    <div className="flex flex-col">
                        <label className="text-sm text-gray-600 mb-1" htmlFor="profile_id">
                            ID do Perfil
                        </label>
                        <input
                            id="profile_id"
                            name="profile_id"
                            type="number"
                            inputMode="numeric"
                            className="rounded-xl border px-3 py-2"
                            value={form.profile_id}
                            onChange={handleNumberChange}
                            placeholder="ex.: 4"
                            required
                        />
                    </div>
                    <div className="flex flex-col">
                        <label className="text-sm text-gray-600 mb-1" htmlFor="diagnostic_date">
                            Data do Diagnóstico
                        </label>
                        <input
                            id="diagnostic_date"
                            name="diagnostic_date"
                            type="date"
                            className="rounded-xl border px-3 py-2"
                            value={form.diagnostic_date}
                            onChange={handleChange}
                            required
                        />
                    </div>
                    <div className="flex flex-col">
                        <label className="text-sm text-gray-600 mb-1" htmlFor="severity">
                            Gravidade
                        </label>
                        <select
                            id="severity"
                            name="severity"
                            className="rounded-xl border px-3 py-2"
                            value={form.severity}
                            onChange={handleChange}
                            required
                        >
                            <option value="">— selecione —</option>
                            <option>Leve</option>
                            <option>Moderada</option>
                            <option>Grave</option>
                        </select>
                    </div>
                </section>

                {/* Western / TCM */}
                <section className="grid grid-cols-1 md:grid-cols-2 gap-4 mb-6">
                    <div className="flex flex-col">
                        <label className="text-sm text-gray-600 mb-1" htmlFor="western_diagnostic">
                            Diagnóstico Ocidental
                        </label>
                        <input
                            id="western_diagnostic"
                            name="western_diagnostic"
                            type="text"
                            className="rounded-xl border px-3 py-2"
                            value={form.western_diagnostic}
                            onChange={handleChange}
                            placeholder="ex.: Diabetes tipo 2"
                            required
                        />
                    </div>
                    <div className="flex flex-col">
                        <label className="text-sm text-gray-600 mb-1" htmlFor="tcm_diagnosis">
                            Diagnóstico MTC
                        </label>
                        <input
                            id="tcm_diagnosis"
                            name="tcm_diagnosis"
                            type="text"
                            className="rounded-xl border px-3 py-2"
                            value={form.tcm_diagnosis}
                            onChange={handleChange}
                            placeholder="ex.: Qi do Baço em Afundamento"
                            required
                        />
                    </div>
                </section>

                {/* Symptoms / Tongue / Pulse */}
                <section className="flex flex-row gap-4">
                    <div className="flex flex-col">
                        <label className="flex flex-col text-sm text-gray-600 mb-1" htmlFor="symptoms">
                            Sintomas
                        </label>
                        <div className="flex flex-col overflow-auto h-50 rounded-xl border px-3 py-2">
                            {symptoms.map((symptom, idx) => (
                                <label key={symptom.id}>
                                    <input
                                        type="checkbox"
                                        value={symptom.id}
                                        checked={selected[idx]?.isSelected ?? false}
                                        onChange={(e) =>
                                            setSelected(prev => {
                                                const next = [...prev];
                                                next[idx] = { ...next[idx], id: symptom.id, isSelected: e.target.checked };
                                                return next;
                                            })
                                        }
                                    />
                                    {symptom.name}
                                </label>
                            ))}
                        </div>
                    </div>
                    <div className="flex flex-col">
                        <label className="text-sm text-gray-600 mb-1" htmlFor="pulse_quality">
                            Qualidade do Pulso (opcional)
                        </label>
                        <input
                            id="pulse_quality"
                            name="pulse_quality"
                            type="text"
                            className="rounded-xl border px-3 py-2"
                            value={form.pulse_quality}
                            onChange={handleChange}
                            placeholder="ex.: Fino"
                        />
                    </div>
                    <div className="flex flex-col">
                        <label className="text-sm text-gray-600 mb-1" htmlFor="tongue_description">
                            Língua
                        </label>
                        <input
                            id="tongue_description"
                            name="tongue_description"
                            type="text"
                            className="rounded-xl border px-3 py-2"
                            value={form.tongue_description}
                            onChange={handleChange}
                            placeholder="ex.: Língua com fissuras"
                            required
                        />
                    </div>
                </section>

                {/* Technical / timestamps (read-only)
                <section className="grid grid-cols-1 md:grid-cols-2 gap-4 mt-6 text-sm">
                    <div className="flex flex-col">
                        <label className="text-gray-500 mb-1" htmlFor="created_at">
                            Criado em (definido ao guardar)
                        </label>
                        <input
                            id="created_at"
                            name="created_at"
                            type="text"
                            className="rounded-xl border px-3 py-2 bg-gray-50"
                            value={form.created_at}
                            readOnly
                        />
                    </div>
                    <div className="flex flex-col">
                        <label className="text-gray-500 mb-1" htmlFor="updated_at">
                            Atualizado em (definido ao guardar)
                        </label>
                        <input
                            id="updated_at"
                            name="updated_at"
                            type="text"
                            className="rounded-xl border px-3 py-2 bg-gray-50"
                            value={form.updated_at}
                            readOnly
                        />
                    </div>
                </section>*/}
            </form>
        </dialog>
    );

}
