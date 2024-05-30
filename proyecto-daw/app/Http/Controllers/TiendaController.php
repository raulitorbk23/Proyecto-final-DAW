<?php

namespace App\Http\Controllers;

use App\Models\Producto;
use Illuminate\Http\Request;

class TiendaController extends Controller
{
    public function suplementos(){
        $productos = Producto::all()->where('id_categoria',1);
        return view('tienda',compact('productos'));
    }

    public function ropa(){
        $productos = Producto::all()->where('id_categoria',2);
        return view('tienda',compact('productos'));
    }

    public function accesorios(){
        $productos = Producto::all()->where('id_categoria',3);
        return view('tienda',compact('productos'));
    }

    public function calzado(){
        $productos = Producto::all()->where('id_categoria',4);
        return view('tienda',compact('productos'));
    }

    public function ofertas(){
        $productos = Producto::all()->where('descuento','>',0);
        return view('tienda',compact('productos'));
    }

    public function novedades(){
        $productos = Producto::all()->where('created_at','>',"SUBDATE('2024-05-29', INTERVAL 30 DAY)
        ");
        dd($productos);
        return view('tienda',compact('productos'));
    }
}
