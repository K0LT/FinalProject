<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreGoalMilestoneRequest extends FormRequest
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

            'treatment_goal_id' => 'required|integer|exists:treatment_goals,id',
            'description' => 'nullable|string',
            'target_date' => 'required|date',
            'completed' => 'required|boolean',
            'completion_date' => 'nullable|date',
            'notes' => 'nullable|string',
        ];
    }
}
