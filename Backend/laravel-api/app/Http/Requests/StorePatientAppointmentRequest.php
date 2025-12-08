<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePatientAppointmentRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    protected function prepareForValidation()
    {
        $this->merge([
            'patient_id' => auth()->id(),
            'status' => $this->input('status', 'Pendente')
        ]);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'appointment_date_time' => 'required|date',
            'duration' => 'nullable|integer',
            'type' => 'required|string|max:255|in:Acupunturista,Nutricionista,Treinador Pessoal,Medico',
            'notes' => 'nullable|string',
            'status' => 'nullable|string|max:255|in:Pendente,Confirmado,CanceladoConcluído',
            'patient_id' => 'required|exists:patients,id',

        ];
    }
}
