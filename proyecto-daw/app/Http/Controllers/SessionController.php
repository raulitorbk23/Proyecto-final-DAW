<?php

namespace App\Http\Controllers;

use App\Models\Producto;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;

class SessionController extends Controller
{
    public function storeData(Request $request)
    {
        $cookie = $request->cookie;
        switch ($cookie){
            case 'carrito':
                $producto = Producto::where('nombre', $request->data)->first();
                if (!$producto) {
                    return response()->json([
                        'message' => 'Producto no encontrado',
                    ], 404);
                }
                $precioVenta = is_numeric($producto->precioVenta) ? $producto->precioVenta : 0;
                $descuento = isset($producto->descuento) && is_numeric($producto->descuento) ? $producto->descuento : 0;
                $precioFinal = $precioVenta - $descuento;
                $precioFinal = number_format($precioFinal, 2, '.', '');
                $jsonProducto = [
                    'nombre' => $producto->nombre,
                    'precio' => (float) $precioFinal, 
                    'img' => $producto->imagen,
                    'cantidad' => 1
                ];
                if(!Session::has('carrito')){
                    Session::put('carrito', [$jsonProducto]);
                    return response()->json($jsonProducto, 200);
                } else {
                    $carrito = Session::get('carrito');
                    // Verifica si el producto ya está en el carrito
                    $found = false;
                    foreach ($carrito as &$item) {
                        if ($item['nombre'] == $producto->nombre) {

                            $item['cantidad'] += 1;
                            $found = true;
                            break;
                        }
                    }

                    if (!$found) {
                        try {
                            Session::push('carrito', $jsonProducto);
                        } catch (\Exception $e) {
                            if (strlen(json_encode(Session::get('carrito'))) > 4096) {
                                return response()->json(['message' => 'La cookie no puede exceder los 4096 caracteres.'], 400);
                            } else {
                                return response()->json(['message' => 'Error al guardar el producto en el carrito.'], 500);
                            }
                        }
                    } else {
                        try {
                            Session::put('carrito', $carrito);
                        } catch (\Exception $e) {
                            if (strlen(json_encode(Session::get('carrito'))) > 4096) {
                                return response()->json(['message' => 'La cookie no puede exceder los 4096 caracteres.'], 400);
                            } else {
                                return response()->json(['message' => 'Error al guardar el producto en el carrito.'], 500);
                            }
                        }
                    }

                    return response()->json([
                        'message' => 'producto añadido a carrito',
                    ], 200);
                } 
                break;

            case 'default':
                return response()->json([
                    'message' => 'ha ocurrido algun error case default',
                ], 200);
        }
    }

    public function actualizarCantidad(Request $request)
    {
        $productoNombre = $request->nombre;
        $nuevaCantidad = $request->cantidad;

        if (Session::has('carrito')) {
            $carrito = Session::get('carrito');
            foreach ($carrito as &$item) {
                if ($item['nombre'] === $productoNombre) {
                    $item['cantidad'] = $nuevaCantidad;
                    break;
                }
            }
            Session::put('carrito', $carrito);
            return response()->json(['message' => 'Cantidad actualizada'], 200);
        } else {
            return response()->json(['message' => 'El carrito está vacío'], 404);
        }
    }

    public function getData()
    {
        if (Session::has('carrito')) {
            $data = Session::get('carrito');
            return response()->json([
                'data' => $data,
            ]);
        } else {
            return response()->json([
                'message' => 'No data found in session',
            ], 404);
        }
    }
    public function deleteData(Request $request)
    {
        $cookie = $request->cookie;
        switch ($cookie) {
            case 'carrito':
                $carrito = Session::get('carrito', []);
                $nombreProducto = $request->data;

                // Filtrar el producto a eliminar
                $carrito = array_filter($carrito, function ($item) use ($nombreProducto) {
                    return $item['nombre'] !== $nombreProducto;
                });

                // Reindexar array y guardar en la sesión
                Session::put('carrito', array_values($carrito));

                return response()->json([
                    'message' => 'Producto eliminado del carrito',
                ], 200);
            default:
                return response()->json([
                    'message' => 'Cookie no reconocida',
                ], 400);
        }
    }

}
