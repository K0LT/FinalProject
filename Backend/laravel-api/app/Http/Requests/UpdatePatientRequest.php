<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdatePatientRequest extends FormRequest
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
            'phone_number'  => 'required|string',
            'address'  => 'nullable|string',
            'birth_date'  => 'nullable|date',
            'emergency_contact_name'  => 'nullable|string',
            'emergency_contact_phone'  => 'nullable|string',
            'emergency_contact_relation'  => 'nullable|string',
            'client_since'  => 'nullable|date',
            'last_visit'  => 'nullable|date',
            'next_appointment'  => 'nullable|date',
        ];
    }
}
