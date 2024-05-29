<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use \App\Models\Producto;

class ProductoFactory extends Factory
{
    protected $model = Producto::class;

    public function definition()
    {
        $precioCompra = $this->faker->randomFloat(2, 0, 99.99);

        return [
            'nombre' => $this->faker->unique()->word(2, true),
            'descripcion' => $this->faker->paragraph(5, true),
            'imagen' => $this->faker->image('public/img', 300, 400, null, false),
            'precioCompra' => $precioCompra,
            'precioVenta' => $this->faker->randomFloat(2, $precioCompra, 99.99),
            'descuento' => null,
            'stock' => $this->faker->numberBetween(0, 99),
            'id_subcategoria'=>1,
            'id_categoria'=>1,
        ];
    }
}
