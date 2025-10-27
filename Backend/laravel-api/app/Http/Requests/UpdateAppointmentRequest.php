<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateAppointmentRequest extends FormRequest
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
            'patient_id' => 'required|exists:patients,id',
            'profile_id' => 'required|exists:profiles,id',
            'appointment_date_time' => 'required|date',
            'duration' => 'nullable|integer',
            'type' => 'nullable|string|max:255',
            'notes' => 'nullable|string',
        ];
    }
}
