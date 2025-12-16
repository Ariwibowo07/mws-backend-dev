<?php

namespace App\Http\Requests\Admin\Store;

use Illuminate\Foundation\Http\FormRequest;

class StoreInterventionRequest extends FormRequest
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
            'student_uuid' => 'required|exists:students,uuid',
            'intervention_type' => 'required|string',
            'strategy' => 'nullable|string',
            'tier' => 'required|integer|min:1|max:3',
            'progress_status' => 'required|in:on_track,improving,needs_attention',
            'notes' => 'nullable|string',
            'target' => 'nullable|integer|min:0|max:100',
        ];
    }
}
