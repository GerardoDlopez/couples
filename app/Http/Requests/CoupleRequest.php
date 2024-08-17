<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CoupleRequest extends FormRequest
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
            'user1_id' =>'required|integer|exists:users,id',
            'user2_id' => 'required|integer|different:user1_id|exists:users,id',
        ];
    }

    public function messages(): array
    {
        return [
            'user1_id.required' => 'El campo User 1 es obligatorio.',
            'user1_id.integer' => 'El campo User 1 debe ser un número entero.',
            'user1_id.exists' => 'El usuario seleccionado para User 1 no existe en el sistema.',
            
            'user2_id.required' => 'El campo User 2 es obligatorio.',
            'user2_id.integer' => 'El campo User 2 debe ser un número entero.',
            'user2_id.different' => 'User 2 debe ser diferente de User 1.',
            'user2_id.exists' => 'El usuario seleccionado para User 2 no existe en el sistema.',
        ];
    }
}
