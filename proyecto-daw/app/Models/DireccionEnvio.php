<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DireccionEnvio extends Model
{
    use HasFactory;

    protected $primaryKey = 'id_direccion';

    protected $fillable = [
        'pais',
        'localidad',
        'codPostal',
        'direccion',
        'telefono',
    ];

    public function usuarios()
    {
        return $this->belongsToMany(Usuario::class, 'usuario__direccions', 'id_direccion', 'id_usuario');
    }

    public function pedidos()
    {
        return $this->hasMany(Pedido::class, 'id_direccion', 'id_direccion');
    }
}
