<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreProductoRequest extends FormRequest
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
            'nombre' => 'required|string|max:50|unique:productos,nombre',
            'descripcion' => 'required|string',
            'imagen' => 'nullable|string',
            'precioCompra' => 'required|String|min:1',
            'precioVenta' => 'required|String|min:1',
            'descuento' => 'nullable|String|min:1',
            'stock' => 'required|integer|min:0',
            'id_categoria' => 'required|exists:categorias,id_categoria',
            'id_subcategoria' => 'required|exists:subcategorias,id_subcategoria',
        ];
    }

    public function messages()
    {
        return [
            'nombre.required' => 'El nombre del producto es obligatorio.',
            'nombre.unique' => 'El nombre del producto ya está registrado.',
            'nombre.max' => 'El nombre del producto no puede superar los 50 caracteres.',
            'descripcion.required' => 'La descripción del producto es obligatoria.',
            'precioCompra.required' => 'El precio de compra es obligatorio.',
            'precioCompra.numeric' => 'El precio de compra debe ser un número.',
            'precioCompra.min' => 'El precio de compra no puede ser negativo.',
            'precioVenta.required' => 'El precio de venta es obligatorio.',
            'precioVenta.numeric' => 'El precio de venta debe ser un número.',
            'precioVenta.min' => 'El precio de venta no puede ser negativo.',
            'descuento.numeric' => 'El descuento debe ser un número.',
            'descuento.min' => 'El descuento no puede ser negativo.',
            'stock.required' => 'El stock es obligatorio.',
            'stock.integer' => 'El stock debe ser un número entero.',
            'stock.min' => 'El stock no puede ser negativo.',
            'id_categoria.required' => 'La categoría es obligatoria.',
            'id_categoria.exists' => 'La categoría seleccionada no es válida.',
            'id_subcategoria.required' => 'La subcategoría es obligatoria.',
            'id_subcategoria.exists' => 'La subcategoría seleccionada no es válida.',
        ];
    }
}
