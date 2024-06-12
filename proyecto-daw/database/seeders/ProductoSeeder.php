<?php

namespace Database\Seeders;

use App\Models\Subcategoria;
use App\Models\Producto;
use Illuminate\Database\Seeder;

class ProductoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Definir listas de imágenes para cada subcategoría
        $imagenes = [
            1 => ['proteinas.jpeg', 'proteinas2.jpeg', 'proteinas3.jpeg'], // Proteínas
            2 => ['vitaminas.jpeg', 'vitaminas2.jpeg', 'vitaminas3.jpeg'], // Vitaminas
            3 => ['camiseta4.jpeg', 'camiseta5.jpeg', 'camiseta5.jpeg'], // Camisetas
            4 => ['shorts.jpeg', 'shorts2.jpeg', 'shorts3.jpeg'], // Shorts
            5 => ['straps.jpeg', 'straps2.jpeg', 'straps3.jpeg'], // Straps
            6 => ['cinturon.jpeg', 'cinturon2.jpeg', 'cinturon3.jpeg'], // Cinturones
            7 => ['calzadorunning.jpeg', 'calzadorunning2.jpeg', 'calzadorunning3.jpeg'], // Calzado de Running
            8 => ['calzadopower.jpeg', 'calzadopower2.jpeg', 'calzadopower3.jpeg'], // Calzado de Powerlifting
        ];

        // Función para obtener una imagen aleatoria basada en la subcategoría
        function getRandomImage($id_subcategoria, $imagenes) {
            if (isset($imagenes[$id_subcategoria])) {
                $images = $imagenes[$id_subcategoria];
                return $images[array_rand($images)];
            }
            return 'default.jpeg'; // Imagen por defecto si no coincide ninguna subcategoría
        }

        $subcategorias = Subcategoria::all();
        
        // Iterar sobre cada subcategoría
        foreach ($subcategorias as $subcategoria) {
            // Crear 4 productos para cada subcategoría
            for ($i = 0; $i < 4; $i++) {
                Producto::factory()->create([
                    'id_subcategoria' => $subcategoria->id_subcategoria,
                    'id_categoria' => $subcategoria->id_categoria,
                    'imagen' => getRandomImage($subcategoria->id_subcategoria, $imagenes), // Asignar imagen aleatoria
                ]);
            }
        }
    }
}
