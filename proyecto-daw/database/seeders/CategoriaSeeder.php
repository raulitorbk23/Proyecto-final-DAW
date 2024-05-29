<?php

namespace Database\Seeders;

use App\Models\Categoria;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategoriaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Categoria::factory()->create([
            'nombre'=>'suplementos'
        ]);

        Categoria::factory()->create([
            'nombre'=>'ropa'
        ]);

        Categoria::factory()->create([
            'nombre'=>'accesorios'
        ]);

        Categoria::factory()->create([
            'nombre'=>'calzado'
        ]);
    }
}
