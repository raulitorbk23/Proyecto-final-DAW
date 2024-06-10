<?php

namespace App\Http\Controllers;

use App\Models\Producto;
use App\Models\Subcategoria;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class TiendaController extends Controller
{

    public function index(){

        $productos = Producto::orderBy('updated_at','asc')->paginate(8);

        $scName = [];
        $subcategorias = Subcategoria::all();

        foreach($subcategorias as $subcategoria){
            array_push($scName,Subcategoria::findOrFail($subcategoria->id_subcategoria)->nombre);
        }

        return view('tienda',compact('productos','scName'));
    }
    
    public function suplementos(){

        $productos = Producto::where('id_categoria',1)->orderBy('updated_at','asc')->paginate(6);
        $subcategorias = Subcategoria::where('id_categoria',1)->get();
        $scName = [];

        foreach($subcategorias as $subcategoria){
            array_push($scName,Subcategoria::findOrFail($subcategoria->id_subcategoria)->nombre);
        }

        return view('tienda',compact('productos','scName'));

    }

    public function ropa(){

        $productos = Producto::where('id_categoria',2)->orderBy('updated_at','asc')->paginate(6);
        $subcategorias = Subcategoria::where('id_categoria',2)->get();
        $scName = [];

        foreach($subcategorias as $subcategoria){
            array_push($scName,Subcategoria::findOrFail($subcategoria->id_subcategoria)->nombre);
        }

        return view('tienda',compact('productos','scName'));
    }

    public function accesorios(){

        $productos = Producto::where('id_categoria',3)->orderBy('updated_at','asc')->paginate(6);
        $subcategorias = Subcategoria::where('id_categoria',3)->get();
        $scName = [];

        foreach($subcategorias as $subcategoria){
            array_push($scName,Subcategoria::findOrFail($subcategoria->id_subcategoria)->nombre);
        }
        
        return view('tienda',compact('productos','scName'));
    }

    public function calzado(){

        $productos = Producto::where('id_categoria',4)->orderBy('updated_at','asc')->paginate(6);
        $subcategorias = Subcategoria::where('id_categoria',4)->get();
        $scName = [];

        foreach($subcategorias as $subcategoria){
            array_push($scName,Subcategoria::findOrFail($subcategoria->id_subcategoria)->nombre);
        }

        return view('tienda',compact('productos','scName'));
    }

    public function ofertas(){

        $productos = Producto::where('descuento','>',0)->orderBy('updated_at','asc')->paginate(6);
        $subcategorias = Subcategoria::all();
        $scName = [];

        foreach($subcategorias as $subcategoria){
            array_push($scName,Subcategoria::findOrFail($subcategoria->id_subcategoria)->nombre);
        }
        return view('tienda',compact('productos','scName'));
    }

    public function novedades(){

        ##Recojo los productos que tengan una antigÜedad igual o inferior a 30 dias
        ##Para ello utilizo una librería de laravel para manipular fechas 'Carbon' 
        $productos = Producto::where('created_at', '>=', Carbon::now()->subDays(30))->orderBy('updated_at','asc')->paginate(6);

        $subcategorias = Subcategoria::all();
        $scName = [];

        foreach($subcategorias as $subcategoria){
            array_push($scName,Subcategoria::findOrFail($subcategoria->id_subcategoria)->nombre);
        }
        
        return view('tienda',compact('productos','scName'));
    }

    public function pagar(){

        return view('pagar');
        
    }
    /*
    funcionalidad carrito dinámico solo con javascript
    
    public function añadirProductoCarrito(Request $request){
        $producto = Producto::where('nombre', $request->nombre)->first();

        if (!$producto) {
            return response()->json(['error' => 'Producto no encontrado'], 404);
        }
    
        $precioFinal = isset($producto->descuento) ? $producto->precioVenta - $producto->descuento : $producto->precioVenta;

        // Convertir el precio final a un float con dos decimales
        $precioFinal = number_format($precioFinal, 2, '.', '');
        
        $jsonProducto = [
            'nombre' => $producto->nombre,
            'precio' => (float) $precioFinal, 
            'img' => $producto->imagen,
            'cantidad' => null
        ];
    
        return response()->json($jsonProducto, 200);

    }*/
    
}


