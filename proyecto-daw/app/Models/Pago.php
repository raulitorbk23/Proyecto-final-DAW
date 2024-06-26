<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pago extends Model
{
    use HasFactory;

    protected $primaryKey = 'id_pago';

    protected $fillable = [
        'id_transaccion',
        'cantidad',
        'estado',
        'email',
        'fecPago',
        'id_cliente',
        'id_usuario',
        'id_tarjeta',
        'id_pedido',
    ];

    public $timestamps = false;
        
    public function usuario()
    {
        return $this->belongsTo(Usuario::class, 'id_usuario', 'id_usuario');
    }

    public function tarjeta()
    {
        return $this->belongsTo(Tarjeta::class, 'id_tarjeta', 'id_tarjeta');
    }

    public function pedido()
    {
        return $this->belongsTo(Pedido::class, 'id_pedido', 'id_pedido');
    }
           
        
}
