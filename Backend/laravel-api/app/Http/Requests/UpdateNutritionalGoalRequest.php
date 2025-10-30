<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateNutritionalGoalRequest extends FormRequest
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
            'target_weight' => 'nullable|numeric|between:30,200',
            'target_body_fat' => 'nullable|numeric|between:15,35',
            'daily_calories_goal' => 'nullable|numeric|between:1500,3000',
            'daily_protein_goal' => 'nullable|numeric|between:50,200',
            'daily_carbs_goal' => 'nullable|numeric|between:100,400',
            'daily_fat_goal' => 'nullable|numeric|between:30,120',
            'start_date' => 'nullable|date',
            'target_date' => 'nullable|date',
        ];
    }
}
