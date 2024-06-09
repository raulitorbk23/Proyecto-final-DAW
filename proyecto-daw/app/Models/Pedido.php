<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pedido extends Model
{
    use HasFactory;

    protected $primaryKey = 'id_pedido';

    protected $fillable = [
        'fecIni',  
        'estado',
        'precioTotal',
        'id_usuario',
        'id_direccion',
    ];
    
    public $timestamps = false;

    public function usuario()
    {
        return $this->belongsTo(Usuario::class, 'id_usuario', 'id_usuario');
    }

    public function direccionEnvio()
    {
        return $this->belongsTo(DireccionEnvio::class, 'id_direccion', 'id_direccion');
    }

    public function productos()
    {
        return $this->belongsToMany(Producto::class, 'pedido__productos', 'id_pedido', 'id_producto')
            ->withPivot('cantidadProducto', 'precioProducto');
    }

    public function pagos()
    {
        return $this->belongsToMany(Pago::class, 'pedido__pagos', 'id_pedido', 'id_pago');
    }

}
