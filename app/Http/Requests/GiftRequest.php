<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class GiftRequest extends FormRequest
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
            'name'        => 'required|string|max:255',
            'description' => 'nullable|string',
            'link'        => 'nullable|url',
            'priority'    => 'nullable|string|in:Alta,Media,Baja,Ni idea', // Validación del valor de prioridad
            'price'       => 'nullable|numeric|min:0',
        ];
    }

    public function messages()
    {
        return [
            'name.required'        => 'El campo nombre es obligatorio.',
            'name.string'          => 'El campo nombre debe ser una cadena de caracteres.',
            'name.max'             => 'El campo nombre no puede exceder los 255 caracteres.',
            'description.string'   => 'El campo descripción debe ser una cadena de caracteres.',
            'link.url'             => 'El campo enlace debe ser una URL válida.',
            'priority.string'      => 'El campo prioridad debe ser una cadena de caracteres.',
            'priority.in'          => 'El campo prioridad debe ser uno de los siguientes valores: Alta, Media, Baja, Ni idea.',
            'price.numeric'        => 'El campo precio debe ser un número.',
            'price.min'            => 'El campo precio debe ser mayor o igual a 0.',
        ];
    }
}
