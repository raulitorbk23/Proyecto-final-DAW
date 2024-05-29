<?php

namespace Database\Seeders;

use App\Models\Subcategoria;
use App\Models\Producto;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Obtener todas las subcategorías
        $subcategorias = Subcategoria::all();
        
        // Iterar sobre cada subcategoría
        foreach ($subcategorias as $subcategoria) {
            // Crear 4 productos para cada subcategoría
            Producto::factory()->count(4)->create([
                'id_subcategoria' => $subcategoria->id_subcategoria,
                'id_categoria' => $subcategoria->id_categoria,
            ]);
        }
    }
}
