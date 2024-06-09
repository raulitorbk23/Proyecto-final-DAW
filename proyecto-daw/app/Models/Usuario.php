<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User;

class Usuario extends User
{
    use HasFactory;

    protected $primaryKey = 'id_usuario';

    protected $fillable = [
        'name',
        'apellidos',
        'email',
        'password',
        'rol',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    #relaciones eloquent
    
    public function tarjetas()
    {
        return $this->belongsToMany(Tarjeta::class, 'usuario__tarjetas', 'id_usuario', 'id_tarjeta');
    }

    public function direcciones()
    {
        return $this->belongsToMany(DireccionEnvio::class, 'usuario__direccions', 'id_usuario', 'id_direccion');
    }

    public function pedidos()
    {
        return $this->hasMany(Pedido::class, 'id_usuario', 'id_usuario');
    }

    public function pagos()
    {
        return $this->hasMany(Pago::class, 'id_usuario', 'id_usuario');
    }
}
