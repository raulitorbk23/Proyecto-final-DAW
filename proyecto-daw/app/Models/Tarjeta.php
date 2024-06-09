<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tarjeta extends Model
{
    use HasFactory;

    protected $primaryKey = 'id_tarjeta';

    protected $fillable = [
        'numTarjeta',
        'titular',
        'fecExpira',
        'cvc',
    ];

    public function usuarios()
    {
        return $this->belongsToMany(User::class, 'usuario__tarjetas', 'id_tarjeta', 'id_usuario');
    }

    public function pagos()
    {
        return $this->hasMany(Pago::class, 'id_tarjeta', 'id_tarjeta');
    }
}
