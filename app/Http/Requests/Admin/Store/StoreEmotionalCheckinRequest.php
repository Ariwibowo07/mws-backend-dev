<?php

namespace App\Http\Requests\Admin\Store;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Validator;

class StoreEmotionalCheckinRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            // terima ID / UUID / class_id sebagai string
            'user_id' => 'required|string',

            'role' => 'required|string|max:50',
            'internal_weather' => 'nullable|string|max:255',
            'mood' => 'required|string|max:255',
            'energy_level' => 'nullable|in:low,medium,high',
            'balance' => 'nullable|in:unbalanced,balanced,highly_balanced',
            'load' => 'nullable|in:light,moderate,heavy',
            'readiness' => 'nullable|in:not_ready,somewhat_ready,ready',
            'presence_level' => 'required|integer|min:1|max:10',
            'capasity_level' => 'required|integer|min:1|max:10',
            'note' => 'nullable|string|max:500',
            'contact_id' => 'nullable|integer|exists:users,id',
            'checked_in_at' => 'required|date',
        ];
    }

    /** VALIDASI TAMBAHAN: cek apakah user_id cocok dengan id / uuid / class_id */
    public function withValidator(Validator $validator)
    {
        $validator->after(function ($validator) {
            $value = $this->user_id;

            $exists = User::where('id', $value)
                ->orWhere('uuid', $value)
                ->orWhere('class_id', $value)
                ->exists();

            if (! $exists) {
                $validator->errors()->add(
                    'user_id',
                    'The selected user id is invalid.'
                );
            }
        });
    }
}
