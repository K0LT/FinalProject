<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreDailyNutritionRequest extends FormRequest
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
            'date' => 'required|date',
            'calories_consumed' => 'nullable|integer',
            'protein_consumed' => 'nullable|integer',
            'carbs_consumed' => 'nullable|integer',
            'fat_consumed' => 'nullable|integer',
            'water_intake' => 'nullable|integer',
            'steps' => 'nullable|integer',
            'sleep_hours' => 'nullable|integer',
            'calories_burned' => 'nullable|integer',
        ];
    }
}
