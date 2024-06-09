<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreUsuarioRequest extends FormRequest
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
            'apellidos' => 'required|string|max:255',
            'email' => 'required|email|unique:usuarios,email|max:255',
            'password' => 'required|string|min:8',
            'rol' => 'sometimes|in:admin,cliente', // opcional, ya que tiene un valor predeterminado en la base de datos
        ];

    }

    public function messages()
    {
        return [
            'name.required' => 'El nombre es obligatorio.',
            'apellidos.required' => 'Los apellidos son obligatorios.',
            'email.required' => 'El correo electronico es obligatorio.',
            'email.email' => 'Debe ser un correo electronico valido.',
            'email.unique' => 'El correo electronico ya esta registrado.',
            'password.required' => 'La clave es obligatoria.',
            'password.min' => 'La clave debe tener al menos 8 caracteres.',
            'rol.in' => 'El rol debe ser uno de los siguientes valores: admin, cliente.',
        ];
    }
}
