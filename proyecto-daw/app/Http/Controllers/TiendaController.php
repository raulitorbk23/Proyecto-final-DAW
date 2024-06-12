<?php
namespace App\Http\Controllers;

use App\Models\Producto;
use App\Models\Subcategoria;
use Carbon\Carbon;
use Illuminate\Http\Request;

class TiendaController extends Controller
{
    public function index(){
        $productos = Producto::orderBy('updated_at','asc')->paginate(8);
        $scName = Subcategoria::pluck('nombre', 'id_subcategoria')->all();

        return view('tienda', compact('productos', 'scName'));
    }
    public function filtrarPorSubcategoria($id_subcategoria) {
        // Verificar si se proporciona un ID de subcategoría válido
        if (!$id_subcategoria || !is_numeric($id_subcategoria)) {
            return redirect()->route('tienda')->with('error', 'ID de subcategoría no válido');
        }
    
        // Filtrar productos por subcategoría
        $productos = Producto::where('id_subcategoria', $id_subcategoria)->orderBy('updated_at', 'asc')->paginate(8);
        $scName = Subcategoria::pluck('nombre', 'id_subcategoria')->all();
        $subcategoriaActual = Subcategoria::findOrFail($id_subcategoria)->nombre;
    
        return view('tienda', compact('productos', 'scName', 'subcategoriaActual'));
    }
    // Método para filtrar productos por categoría
    private function filtrarPorCategoria($id_categoria) {
        // Obtener las subcategorías asociadas a la categoría
        $subcategorias = Subcategoria::where('id_categoria', $id_categoria)->get();
        $scName = $subcategorias->pluck('nombre', 'id_subcategoria')->all();

        // Obtener los productos de las subcategorías asociadas
        $productos = Producto::whereIn('id_subcategoria', $subcategorias->pluck('id_subcategoria'))->orderBy('updated_at', 'asc')->paginate(6);

        return view('tienda', compact('productos', 'scName'));
    }
    
    // Métodos para filtrar productos por categoría
    public function suplementos(){ return $this->filtrarPorCategoria(1); }
    public function ropa(){ return $this->filtrarPorCategoria(2); }
    public function accesorios(){ return $this->filtrarPorCategoria(3); }
    public function calzado(){ return $this->filtrarPorCategoria(4); }
    public function ofertas(){
        $productos = Producto::where('descuento', '>', 0)->orderBy('updated_at', 'asc')->paginate(6);
        $scName = Subcategoria::pluck('nombre', 'id_subcategoria')->all();

        return view('tienda', compact('productos', 'scName'));
    }
    public function novedades(){
        $productos = Producto::where('created_at', '>=', Carbon::now()->subDays(30))->orderBy('updated_at', 'asc')->paginate(6);
        $scName = Subcategoria::pluck('nombre', 'id_subcategoria')->all();

        return view('tienda', compact('productos', 'scName'));
    }
    public function pagar(){
        return view('pagar');
    }
    
}
