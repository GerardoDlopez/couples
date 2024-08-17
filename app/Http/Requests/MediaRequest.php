<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MediaRequest extends FormRequest
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
            'couple_id' => 'required|exists:couples,id', // Valida que el couple_id exista en la tabla couples
            'name'      => 'required|string|max:255',   // El nombre es obligatorio, debe ser una cadena y tener un máximo de 255 caracteres
            'status'    => 'nullable|string|max:255',   // El estado es opcional, pero si está presente debe ser una cadena y tener un máximo de 255 caracteres
            'trailer'   => 'nullable|string|max:255',   // El trailer es opcional, pero si está presente debe ser una cadena y tener un máximo de 255 caracteres
        ];
    }

    public function messages()
    {
        return [
            'couple_id.required' => 'El campo couple_id es obligatorio.',
            'couple_id.exists'   => 'El couple_id debe existir en la tabla couples.',
            'name.required'      => 'El nombre es obligatorio.',
        ];
    }
}
