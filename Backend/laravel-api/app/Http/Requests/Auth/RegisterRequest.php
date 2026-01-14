<?php

namespace App\Http\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            // USER
            'name'      => 'required|string|max:255',
            'surname'   => 'nullable|string|max:255',
            'email'     => 'required|email|max:255|unique:users,email',
            'password'  => 'required|string|min:8|confirmed',

            // PATIENT
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
