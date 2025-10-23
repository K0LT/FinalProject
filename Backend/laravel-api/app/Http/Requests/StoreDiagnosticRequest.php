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
            'profile_id' => 'required|integer|exists:profiles,id',
            'diagnostic_date' => 'required|date',
            'western_diagnosis' => 'nullable|string|max:255',
            'tcm_diagnosis' => 'nullable|string|max:255',
            'severity' => 'nullable|string|max:255',
            'symptoms' => 'nullable|string|max:255',
            'pulse_quality' => 'nullable|string|max:255',
            'tongue_description' => 'nullable|string|max:255',
        ];
    }
}
