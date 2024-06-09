<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    use HasFactory;

    protected $primaryKey = 'id_producto';

    protected $fillable = [
        'nombre',
        'descripcion',
        'precioCompra',
        'precioVenta',
        'descuento',
        'stock',
        'imagen',
        'id_categoria',
        'id_subcategoria'
    ];
}
