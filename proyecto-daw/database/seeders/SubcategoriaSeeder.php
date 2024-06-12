<?php

namespace Database\Seeders;

use App\Models\Categoria;
use App\Models\Subcategoria;
use GuzzleHttp\Promise\Create;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SubcategoriaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public $suplementos = ['proteinas','vitaminas'];
    public $ropas = ['camisetas','pantalones'];
    public $accesorios = ['straps','cinturones'];
    public $calzados = ['running','power'];


    public function run(): void
    {
        
        foreach($this->suplementos as $suplemento){
            Subcategoria::factory()->create([
                'nombre'=>$suplemento,
                'id_categoria'=> 1,
            ]);
        }

        foreach($this->ropas as $ropa){
            Subcategoria::factory()->create([
                'nombre'=>$ropa,
                'id_categoria'=> 2,
            ]);
        }

        foreach($this->accesorios as $accesorio){
            Subcategoria::factory()->create([
                'nombre'=>$accesorio,
                'id_categoria'=> 3,
            ]);
        }

        foreach($this->calzados as $calzado){
            Subcategoria::factory()->create([
                'nombre'=>$calzado,
                'id_categoria'=> 4,
            ]);
        }
        
    }
}
