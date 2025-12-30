<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreDiagnosticRequest extends FormRequest
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
            'patient_id' => 'required|integer|exists:patients,id',
            'diagnostic_date' => 'required|date',
            'western_diagnosis' => 'nullable|string|max:255',
            'tcm_diagnosis' => 'nullable|string|max:255',
            'severity' => 'nullable|string|max:255',
            'symptom_ids' => ['array'],
            'symptom_ids.*' => ['integer', 'exists:symptoms,id'],
            'pulse_quality' => 'nullable|string|max:255',
            'tongue_description' => 'nullable|string|max:255',
        ];
    }
}
