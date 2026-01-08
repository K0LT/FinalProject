<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateTreatment_GoalRequest extends FormRequest
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
            'title' => 'required|string',
            'description' => 'nullable|string|max:255',
            'priority' => 'required|string|in:Mínima,Média,Alta',
            'status' => 'required|string|in:Em progresso,Concluído,Cancelado',
            'progress_percentage' => 'required|integer|min:0|max:100',
            'target_date' => 'nullable|date',
            'treatment_methods' => 'nullable|string',
        ];
    }
}
