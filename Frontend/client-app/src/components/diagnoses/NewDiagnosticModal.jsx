import { useEffect, useRef, useState } from "react";
import {postDiagnostic} from "@/services/diagnostics";
import {getSymptoms} from "@/services/symptoms";

export default function NewDiagnosticModal({ open, onClose, setPostDiag }) {
    const ref = useRef(null);
    const [symptoms, setSymptoms] = useState(null);
    const [symptomsLoaded, setSymptomsLoaded] = useState(false);
    const [strippedSymptoms, setStrippedSymptoms] = useState([]);

    const templateDiag = {
        patient_id: 17,
        profile_id: 4,
        diagnostic_date: "2026-04-09",
        western_diagnostic: "Diabetes tipo 2",
        tcm_diagnosis: "Qi do Baço em Afundamento",
        severity: "Moderada",
        symptoms: ["dor no peito","espasmos musculares","diarreia"],
        pulse_quality: "",
        tongue_description: "Língua com fissuras",
    };

    const [form, setForm] = useState(() => ({ ...templateDiag }));

    useEffect(() => {
        const dlg = ref.current;
        if (!dlg) return;
        if (open) dlg.showModal?.();
        else dlg.close?.();
    }, [open]);

    useEffect(() => {
        (async () => {
            try{
                if(!symptoms){
                    await getSymptoms().then((value) => {
                        setSymptoms(value);
                        const minimals = value.map(({ id, name }) => ({ id, name }));
                        setStrippedSymptoms(minimals);
                    }
                    );
                }
            }
            catch (e) {
                console.log(e);
            }
            finally{
                setSymptomsLoaded(true);
            }
        }
        )();
        if(symptomsLoaded){
            console.log("Loaded symptoms!\n", strippedSymptoms);
        }
    }, []);

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
            profile_id: form.profile_id === "" ? null : Number(form.profile_id),
            pulse_quality: form.pulse_quality?.trim() ? form.pulse_quality.trim() : null,
            western_diagnostic: form.western_diagnostic?.trim() || "",
            tcm_diagnosis: form.tcm_diagnosis?.trim() || "",
            severity: form.severity || "",
            tongue_description: form.tongue_description?.trim() || "",
        };
        setPostDiag(payload);
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
                        <label className="text-sm text-gray-600 mb-1" htmlFor="symptoms">
                            Simtomas
                        </label>
                        <select
                            id="symptoms"
                            name="symptoms"
                            className="rounded-xl border px-3 py-2"
                            value={form.symptoms[0]}
                            onChange={handleChange}
                            required
                        >
                            <option value="">— selecione —</option>
                            {form.symptoms.map((symptom, index) => <option key={index} value={0}>{symptom}</option>)}
                        </select>
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
                            placeholder="ex.: Fino, Deslizante, Tenso"
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
