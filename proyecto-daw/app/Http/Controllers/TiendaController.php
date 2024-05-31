<?php

namespace App\Http\Controllers;

use App\Models\Producto;
use App\Models\Subcategoria;
use Carbon\Carbon;
use Illuminate\Http\Request;

class TiendaController extends Controller
{
    public function suplementos(){
        $productos = Producto::all()->where('id_categoria',1);
        $subcategorias = [];
        $scName = [];
        foreach($productos as $producto){
            if (!in_array($producto->id_subcategoria, $subcategorias)) {
                array_push($subcategorias,$producto->id_subcategoria);
            }
        }
        foreach($subcategorias as $subcategoria){
            array_push($scName,Subcategoria::where('id_subcategoria', '=', $subcategoria)->first()->nombre);
        }
        return view('tienda',compact('productos','scName'));

    }

    public function ropa(){
        $productos = Producto::all()->where('id_categoria',2);
        $subcategorias = [];
        $scName = [];
        foreach($productos as $producto){
            if (!in_array($producto->id_subcategoria, $subcategorias)) {
                array_push($subcategorias,$producto->id_subcategoria);
            }
        }
        foreach($subcategorias as $subcategoria){
            array_push($scName,Subcategoria::where('id_subcategoria', '=', $subcategoria)->first()->nombre);
        }
        return view('tienda',compact('productos','scName'));
    }

    public function accesorios(){
        $productos = Producto::all()->where('id_categoria',3);
        $subcategorias = [];
        $scName = [];
        foreach($productos as $producto){
            if (!in_array($producto->id_subcategoria, $subcategorias)) {
                array_push($subcategorias,$producto->id_subcategoria);
            }
        }
        foreach($subcategorias as $subcategoria){
            array_push($scName,Subcategoria::where('id_subcategoria', '=', $subcategoria)->first()->nombre);
        }
        return view('tienda',compact('productos','scName'));
    }

    public function calzado(){
        $productos = Producto::all()->where('id_categoria',4);
        $subcategorias = [];
        $scName = [];
        foreach($productos as $producto){
            if (!in_array($producto->id_subcategoria, $subcategorias)) {
                array_push($subcategorias,$producto->id_subcategoria);
            }
        }
        foreach($subcategorias as $subcategoria){
            array_push($scName,Subcategoria::where('id_subcategoria', '=', $subcategoria)->first()->nombre);
        }
        return view('tienda',compact('productos','scName'));
    }

    public function ofertas(){
        $productos = Producto::all()->where('descuento','>',0);
        $subcategorias = [];
        $scName = [];
        foreach($productos as $producto){
            if (!in_array($producto->id_subcategoria, $subcategorias)) {
                array_push($subcategorias,$producto->id_subcategoria);
            }
        }
        foreach($subcategorias as $subcategoria){
            array_push($scName,Subcategoria::where('id_subcategoria', '=', $subcategoria)->first()->nombre);
        }
        return view('tienda',compact('productos','scName'));
    }

    public function novedades(){

        ##Recojo los productos que tengan una antigÜedad igual o inferior a 30 dias
        ##Para ello utilizo una librería de laravel para manipular fechas 'Carbon' 
        $productos = Producto::where('created_at', '>=', Carbon::now()->subDays(30))->get();

        $subcategorias = [];
        $scName = [];
        foreach($productos as $producto){
            if (!in_array($producto->id_subcategoria, $subcategorias)) {
                array_push($subcategorias,$producto->id_subcategoria);
            }
        }
        foreach($subcategorias as $subcategoria){
            array_push($scName,Subcategoria::where('id_subcategoria', '=', $subcategoria)->first()->nombre);
        }
        return view('tienda',compact('productos','scName'));
    }
}
