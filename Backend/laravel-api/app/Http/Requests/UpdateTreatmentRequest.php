<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateTreatmentRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'diagnostic_id' => 'required|integer|exists:diagnostics,id',
            'patient_id' => 'required|integer|exists:patients,id',
            'session_date_time' => 'required|date',
            'treatment_methods' => 'nullable|string',
            'acupoints_used' => 'nullable|string',
            'duration' => 'nullable|integer',
            'notes' => 'nullable|text',
            'next_session' => 'nullable|date',
        ];
    }
}
