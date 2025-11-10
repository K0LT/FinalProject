import { useEffect, useRef, useState } from "react";
import { updatePatient } from "@/services/patients";

function digitsOnly(value) {
    return (value || "").replace(/\D+/g, "");
}

function toDateInput(value) {
    if (!value) return "";
    const m = value.match(/^(\d{4})-(\d{2})-(\d{2})/);
    if (m) return `${m[1]}-${m[2]}-${m[3]}`;
    const d = new Date(value);
    if (isNaN(d.getTime())) return "";
    const yyyy = d.getFullYear();
    const mm = String(d.getMonth() + 1).padStart(2, "0");
    const dd = String(d.getDate()).padStart(2, "0");
    return `${yyyy}-${mm}-${dd}`;
}

export default function UpdatePatientModal({ open, onClose, patientId, patient }) {
    const ref = useRef(null);

    const template = {
        user_id: patient?.user_id ?? 0,
        phone_number: digitsOnly(patient?.phone_number ?? ""),
        address: patient?.address ?? "",
        gender: patient?.gender ?? "Outro",
        birth_date: toDateInput(patient?.birth_date ?? ""),
        emergency_contact_name: patient?.emergency_contact_name ?? "",
        emergency_contact_phone: digitsOnly(patient?.emergency_contact_phone ?? ""),
        emergency_contact_relation: patient?.emergency_contact_relation ?? "",
        client_since: toDateInput(patient?.client_since ?? ""),
        last_visit: toDateInput(patient?.last_visit ?? ""),
        next_appointment: toDateInput(patient?.next_appointment ?? ""),
        user: {
            id: patient?.user?.id ?? 0,
            role_id: patient?.user?.role_id ?? 3,
            name: patient?.user?.name ?? "",
            surname: patient?.user?.surname ?? "",
            email: patient?.user?.email ?? "",
            email_verified_at: patient?.user?.email_verified_at ?? null,
        },
    };

    const [form, setForm] = useState(template);

    useEffect(() => {
        const dlg = ref.current;
        if (!dlg) return;
        if (open) dlg.showModal?.();
        else dlg.close?.();
    }, [open]);

    useEffect(() => {
        setForm(template);
    }, [patientId]);

    const handleBackdropClick = (event) => {
        if (event.target === ref.current) {
            ref.current?.close();
            onClose?.();
        }
    };

    const handleChange = (e) => {
        const { name, value } = e.target;
        if (name.startsWith("user.")) {
            const key = name.replace("user.", "");
            setForm((prev) => ({ ...prev, user: { ...prev.user, [key]: value } }));
            return;
        }
        setForm((prev) => ({ ...prev, [name]: value }));
    };

    const handleNumericPhone = (e) => {
        const { name, value } = e.target;
        setForm((prev) => ({ ...prev, [name]: digitsOnly(value) }));
    };

    const resetToTemplate = () => setForm(template);

    const handleSubmit = async (e) => {
        e.preventDefault();

        const payload = {
            user_id: Number(form.user_id) || null,
            phone_number: digitsOnly(form.phone_number) || "",
            address: (form.address || "").trim(),
            gender: (form.gender || "").trim(),
            birth_date: toDateInput(form.birth_date) || null,
            emergency_contact_name: (form.emergency_contact_name || "").trim(),
            emergency_contact_phone: digitsOnly(form.emergency_contact_phone) || "",
            emergency_contact_relation: (form.emergency_contact_relation || "").trim(),
            client_since: toDateInput(form.client_since) || null,
            last_visit: toDateInput(form.last_visit) || null,
            next_appointment: toDateInput(form.next_appointment) || null,
            user: {
                name: (form.user?.name || "").trim(),
                surname: (form.user?.surname || "").trim(),
                email: (form.user?.email || "").trim(),
            },
        };
        try {
            await updatePatient(patientId, payload);
        } catch (err) {
            console.error(err);
        }

        ref.current?.close();
        onClose?.();
    };

    const genders = ["Masculino", "Feminino", "Outro", "Prefiro não dizer"];

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
                    <h2 className="text-xl font-semibold tracking-tight">Atualizar Perfil do Paciente</h2>
                    <div className="space-x-2">
                        <button type="button" onClick={resetToTemplate} className="rounded-md border px-3 py-1 text-sm hover:bg-gray-50">
                            RESET
                        </button>
                        <button type="button" onClick={() => { ref.current?.close(); onClose?.(); }} className="rounded-md border px-3 py-1 text-sm hover:bg-gray-50">
                            Cancelar
                        </button>
                        <button type="submit" className="rounded-md border px-4 py-1.5 text-sm font-medium hover:bg-gray-900 hover:text-white">
                            Guardar
                        </button>
                    </div>
                </header>

                {/* USER */}
                <section className="grid grid-cols-1 md:grid-cols-3 gap-4 mb-6">
                    <input name="user.name" className="rounded-xl border px-3 py-2" value={form.user.name} onChange={handleChange} placeholder="Nome" required />
                    <input name="user.surname" className="rounded-xl border px-3 py-2" value={form.user.surname} onChange={handleChange} placeholder="Apelido" required />
                    <input name="user.email" type="email" className="rounded-xl border px-3 py-2" value={form.user.email} onChange={handleChange} placeholder="Email" required />
                </section>

                {/* IDs + Gender */}
                <section className="grid grid-cols-1 md:grid-cols-3 gap-4 mb-6">
                    <input name="user_id" type="number" className="rounded-xl border px-3 py-2" value={form.user_id} onChange={handleChange} required />
                    <select name="gender" className="rounded-xl border px-3 py-2" value={form.gender} onChange={handleChange}>
                        {genders.map((g) => <option key={g} value={g}>{g}</option>)}
                    </select>
                    <input name="birth_date" type="date" className="rounded-xl border px-3 py-2" value={form.birth_date} onChange={handleChange} />
                </section>

                {/* Contact + Address */}
                <section className="grid grid-cols-1 md:grid-cols-2 gap-4 mb-6">
                    <div>
                        <input name="phone_number" className="rounded-xl border px-3 py-2" value={form.phone_number} onChange={handleNumericPhone} placeholder="Telemóvel (apenas dígitos)" />
                        <span className="text-xs text-gray-500">Vai ser enviado como número simples.</span>
                    </div>
                    <textarea name="address" rows={3} className="rounded-xl border px-3 py-2 resize-none" value={form.address} onChange={handleChange} placeholder="Morada" />
                </section>

                {/* Emergency */}
                <section className="grid grid-cols-1 md:grid-cols-3 gap-4 mb-6">
                    <input name="emergency_contact_name" className="rounded-xl border px-3 py-2" value={form.emergency_contact_name} onChange={handleChange} placeholder="Nome emergência" />
                    <input name="emergency_contact_phone" className="rounded-xl border px-3 py-2" value={form.emergency_contact_phone} onChange={handleNumericPhone} placeholder="Telefone emergência" />
                    <input name="emergency_contact_relation" className="rounded-xl border px-3 py-2" value={form.emergency_contact_relation} onChange={handleChange} placeholder="Relação" />
                </section>

                {/* Dates */}
                <section className="grid grid-cols-1 md:grid-cols-3 gap-4">
                    <input name="client_since" type="date" className="rounded-xl border px-3 py-2" value={form.client_since} onChange={handleChange} />
                    <input name="last_visit" type="date" className="rounded-xl border px-3 py-2" value={form.last_visit} onChange={handleChange} />
                    <input name="next_appointment" type="date" className="rounded-xl border px-3 py-2" value={form.next_appointment} onChange={handleChange} />
                </section>
            </form>
        </dialog>
    );
}
