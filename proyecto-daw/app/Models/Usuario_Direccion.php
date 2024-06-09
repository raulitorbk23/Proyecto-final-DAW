<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Usuario_Direccion extends Model
{
    use HasFactory;

    protected $table = 'usuario__direccions';

    public $incrementing = false;

    public function usuario()
    {
        return $this->belongsTo(Usuario::class, 'id_usuario', 'id_usuario');
    }

    public function direccionEnvio()
    {
        return $this->belongsTo(DireccionEnvio::class, 'id_direccion', 'id_direccion');
    }
    
}
