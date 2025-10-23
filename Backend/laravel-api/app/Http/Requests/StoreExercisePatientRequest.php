<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreExercisePatientRequest extends FormRequest
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
            'patient_id'  => 'required|integer|exists:patients,id',
            'exercise_id'  => 'required|integer|exists:exercises,id',
            'profile_id'  => 'nullable|integer|exists:profiles,id',
            'prescribed_date' => 'required|date',
            'frequency' => 'nullable|string',
            'status' => 'required|string|max:255',
            'compliance_rate' => 'required|integer',
            'last_performed'=> 'nullable|string',
            'notes' => 'nullable|string',
        ];
    }
}
