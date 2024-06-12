<?php

namespace App\Http\Controllers;

use App\Models\Producto;
use App\Models\Categoria;
use App\Models\Subcategoria;
use Illuminate\Http\Request;

class ProductoController extends Controller
{
    public function index()
    {
        $productos = Producto::orderBy('updated_at', 'asc')->paginate(8);
        $productos_fk = Producto::all();
    
        $categorias = [];
        $subcategorias = [];
    
        foreach ($productos_fk as $producto) {
            // Si la categoría no está ya en categorias, agregarla
            if (!array_key_exists($producto->id_categoria, $categorias)) {
                $categoria = Categoria::find($producto->id_categoria);
                if ($categoria) {
                    $categorias[$producto->id_categoria] = $categoria->nombre;
                }
            }
    
            // Si la subcategoría no está ya en subcategorias bajo la categoría correspondiente, agregarla
            if (!isset($subcategorias[$producto->id_categoria])) {
                $subcategorias[$producto->id_categoria] = [];
            }
            
            if (!array_key_exists($producto->id_subcategoria, $subcategorias[$producto->id_categoria])) {
                $subcategoria = Subcategoria::find($producto->id_subcategoria);
                if ($subcategoria) {
                    $subcategorias[$producto->id_categoria][$producto->id_subcategoria] = $subcategoria->nombre;
                }
            }
        }
    
        return view('dashboard.productos.index', compact('productos', 'categorias', 'subcategorias'));
    }
    public function create(){}
    public function store(Request $request)
    {
        $data = $request;
        $data['stock'] = 0;
        $data['precioCompra'] = floatval($data['precioCompra']);
        $data['precioVenta'] = floatval($data['precioVenta']);
        $data['descuento'] = floatval($data['descuento']);
        Producto::create([
            'nombre' => $data['nombre'],
            'descripcion' => $data['descripcion'],
            'precioCompra' => $data['precioCompra'],
            'precioVenta' => $data['precioVenta'],
            'descuento' => $data['descuento'],
            'stock' => $data['stock'],
            'imagen' => $data['imagen'],
            'id_categoria' => $data['id_categoria'],
            'id_subcategoria' => $data['id_subcategoria']
        ]);
        return redirect()->route('producto.index')->with('success', 'Producto creado exitosamente.');
    }
    public function show($producto)
    {
        $producto = Producto::where('nombre', $producto)->first();
        return view('producto',compact('producto'));
    }
    public function edit(Producto $producto)
    {
        $categorias = Categoria::pluck('nombre', 'id_categoria');
        $subcategorias = Subcategoria::pluck('nombre', 'id_subcategoria');
    
        return view('dashboard.productos.edit', compact('producto', 'categorias', 'subcategorias'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Producto $producto)
    {
        $data = $request;
        $producto->update([
            'nombre' => $data['nombre'],
            'descripcion' => $data['descripcion'] ? $data['descripcion'] : $producto->descripcion, 
            'precioCompra' => $data['precioCompra'],
            'precioVenta' => $data['precioVenta'],
            'descuento' => $data['descuento'],
            'stock' => $data['stock'] ? $data['stock'] : 0,
            'imagen' => $data['imagen'],
            'id_categoria' => $data['id_categoria'],
            'id_subcategoria' => $data['id_subcategoria']
        ]);
        return redirect()->route('producto.index')->with('success', 'producto actualizado exitosamente.');
    }
    public function updateStock(Request $request)
    {
        $producto = Producto::findOrFail($request->id);
        $producto->stock = $request->stock;
        $producto->save();
        return response()->json(['success' => true]);
    }
    public function destroy(Producto $producto_id)
    {
        $producto_id->delete();
        return redirect()->route('producto.index')->with('success', 'Producto eliminado exitosamente.');
    }
    public function obtenerSubcategorias($categoriaId)
    {
        $subcategorias = Subcategoria::where('id_categoria', $categoriaId)->pluck('nombre', 'id_subcategoria');
        return response()->json(['subcategorias' => $subcategorias]);
    }

}
