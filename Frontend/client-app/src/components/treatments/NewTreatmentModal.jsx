import { useEffect, useRef, useState } from "react";
import { postTreatment } from "@/services/treatments";

const InputField = ({ label, name, value, onChange, placeholder, type = "text", required = false }) => (
    <div className="flex flex-col">
        <label className="text-sm text-gray-600 mb-1" htmlFor={name}>
            {label}
        </label>
        <input
            id={name}
            name={name}
            type={type}
            inputMode="numeric"
            className="rounded-xl border px-3 py-2"
            value={value}
            onChange={onChange}
            placeholder={placeholder}
            required={required}
        />
    </div>
);

const CheckboxList = ({ acupoints, selectedAcupoints, setSelectedAcupoints }) => (
    <div className="flex flex-col overflow-auto max-h-48 rounded-xl border px-3 py-2">
        {acupoints.map((point, idx) => (
            <label key={point.id} className="flex items-center gap-2 py-1">
                <input
                    type="checkbox"
                    value={point.id}
                    checked={selectedAcupoints[idx]?.isSelected ?? false}
                    onChange={(e) =>
                        setSelectedAcupoints((prev) => {
                            const next = [...prev];
                            next[idx] = {
                                ...next[idx],
                                id: point.id,
                                name: point.name,
                                isSelected: e.target.checked,
                            };
                            return next;
                        })
                    }
                />
                <span className="text-sm">{point.name}</span>
            </label>
        ))}
    </div>
);

export default function NewTreatmentModal({ open, onClose }) {
    const ref = useRef(null);

    const templateTreatment = {
        diagnostic_id: 39,
        patient_id: 14,
        profile_id: 3,
        session_date_time: "",
        treatment_methods: "Exercícios de respiração",
        acupoints_used: "CV4, BL32, SP6",
        duration: 60,
        notes: "Paciente apresentou melhora nos sintomas.",
        next_session: "",
    };

    const [form, setForm] = useState({ ...templateTreatment });

    const commonAcupoints = [
        { id: "CV4", name: "CV4 - Guanyuan" },
        { id: "BL32", name: "BL32 - Ciliao" },
        { id: "SP6", name: "SP6 - Sanyinjiao" },
        { id: "LI4", name: "LI4 - Hegu" },
        { id: "ST36", name: "ST36 - Zusanli" },
        { id: "GB34", name: "GB34 - Yanglingquan" },
        { id: "LV3", name: "LV3 - Taichong" },
        { id: "PC6", name: "PC6 - Neiguan" },
    ];

    const [selectedAcupoints, setSelectedAcupoints] = useState(
        commonAcupoints.map((point) => ({
            id: point.id,
            name: point.name,
            isSelected: ["CV4", "BL32", "SP6"].includes(point.id),
        }))
    );

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
        setForm((prev) => ({
            ...prev,
            [name]: value === "" ? "" : Number(value),
        }));
    };

    const resetToTemplate = () => {
        setForm({ ...templateTreatment });
        setSelectedAcupoints(
            commonAcupoints.map((point) => ({
                id: point.id,
                name: point.name,
                isSelected: ["CV4", "BL32", "SP6"].includes(point.id),
            }))
        );
    };

    const handleSubmit = (e) => {
        e.preventDefault();

        const selectedPoints = selectedAcupoints
            .filter((p) => p.isSelected)
            .map((p) => p.id)
            .join(", ");

        const payload = {
            ...form,
            patient_id: form.patient_id === "" ? null : Number(form.patient_id),
            diagnostic_id: form.diagnostic_id === "" ? null : Number(form.diagnostic_id),
            profile_id: form.profile_id === "" ? null : Number(form.profile_id),
            session_date_time: form.session_date_time ? form.session_date_time.replace('T', ' ') : "",
            treatment_methods: form.treatment_methods?.trim() || "",
            acupoints_used: selectedPoints || "",
            duration: form.duration === "" ? null : Number(form.duration),
            notes: form.notes?.trim() || "",
        };

        postTreatment(payload)
            .then((response) => {
                console.log("Tratamento guardado:", response);
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
                    <h2 className="text-xl font-semibold tracking-tight">Novo Tratamento</h2>
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

                <section className="grid grid-cols-1 md:grid-cols-2 gap-4 mb-6">
                    <InputField
                        label="ID do Paciente"
                        name="patient_id"
                        value={form.patient_id}
                        onChange={handleNumberChange}
                        placeholder="ex.: 14"
                        required
                    />
                    <InputField
                        label="ID do Perfil"
                        name="profile_id"
                        value={form.profile_id}
                        onChange={handleNumberChange}
                        placeholder="ex.: 3"
                        required
                    />
                    <InputField
                        label="ID do Diagnóstico"
                        name="diagnostic_id"
                        value={form.diagnostic_id}
                        onChange={handleNumberChange}
                        placeholder="ex.: 39"
                        required
                    />
                    <InputField
                        label="Duração (minutos)"
                        name="duration"
                        value={form.duration}
                        onChange={handleNumberChange}
                        placeholder="ex.: 60"
                        required
                    />
                </section>

                <section className="grid grid-cols-1 md:grid-cols-2 gap-4 mb-6">
                    <InputField
                        label="Data e Hora da Sessão"
                        name="session_date_time"
                        value={form.session_date_time}
                        onChange={handleChange}
                        type="datetime-local"
                        required
                    />
                    <InputField
                        label="Próxima Sessão"
                        name="next_session"
                        value={form.next_session}
                        onChange={handleChange}
                        type="date"
                    />
                </section>

                <section className="mb-6">
                    <InputField
                        label="Métodos de Tratamento"
                        name="treatment_methods"
                        value={form.treatment_methods}
                        onChange={handleChange}
                        placeholder="ex.: Exercícios de respiração, Acupuntura"
                        required
                    />
                </section>

                <section className="grid grid-cols-1 md:grid-cols-2 gap-4 mb-6">
                    <div className="flex flex-col">
                        <label className="text-sm text-gray-600 mb-1">Pontos de Acupuntura</label>
                        <CheckboxList
                            acupoints={commonAcupoints}
                            selectedAcupoints={selectedAcupoints}
                            setSelectedAcupoints={setSelectedAcupoints}
                        />
                    </div>

                    <div className="flex flex-col">
                        <label className="text-sm text-gray-600 mb-1" htmlFor="notes">
                            Notas
                        </label>
                        <textarea
                            id="notes"
                            name="notes"
                            rows="8"
                            className="rounded-xl border px-3 py-2 resize-none"
                            value={form.notes}
                            onChange={handleChange}
                            placeholder="ex.: Paciente apresentou melhora nos sintomas..."
                        />
                    </div>
                </section>
            </form>
        </dialog>
    );
}
