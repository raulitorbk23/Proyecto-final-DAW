<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Categoria extends Model
{
    use HasFactory;

    protected $primaryKey = 'id_categoria';

    protected $guarded = [];

    public function subcategorias(){
        return $this->hasMany(Subcategoria::class, 'subcategorias'); 
    }

    public $timestamps = false;
}
