<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateExerciseRequest extends FormRequest
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
            'name' => 'required|string|max:255',
            'description' => 'nullable|text',
            'category' => 'required|string|max:255',
            'difficulty_level' => 'required|string|in:Fácil,Moderado,Difícil',
            'instructions' => 'nullable|text',
            'benefits' => 'nullable|text',
            'precautions' => 'nullable|text',
            'video_url' => 'nullable|string',
            'image_url' => 'nullable|string',
        ];
    }
}
