<?php

namespace App\Http\Controllers;

use App\Models\Pedido;
use App\Http\Requests\StorePedidoRequest;
use App\Http\Requests\UpdatePedidoRequest;
use App\Models\DireccionEnvio;
use App\Models\Usuario;
use Illuminate\Http\Request;

class PedidoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $pedidos = Pedido::orderBy('id_pedido','asc')->paginate(8);

        return view('dashboard.pedidos.index',compact('pedidos'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePedidoRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show($id_pedido)
    {
        $pedido = Pedido::with(['usuario', 'direccionEnvio', 'productos', 'pagos'])->findOrFail($id_pedido);

        return view('dashboard.pedidos.show', compact('pedido'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id_pedido) {
        $pedido = Pedido::findOrFail($id_pedido);
        $direcciones = DireccionEnvio::all()->pluck('direccion', 'id_direccion');
    
        return view('dashboard.pedidos.edit', compact('pedido', 'direcciones'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Pedido $pedido)
    {
        $data = $request;

        $pedido->update([
            'fecIni' => $data['fecIni'], 
            'fecFin' => $data['fecFin'] ? $data['fecFin'] : null,
            'estado' => $data['estado'],
            'precioTotal' => $data['precioTotal'],
            'id_usuario' => $pedido->id_usuario,
            'id_direccion' => $data['id_direccion'],
        ]);

        return redirect()->route('pedido.index')->with('success', 'Usuario actualizado exitosamente.');
        
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($pedido_id)
    {

        $pedido = Pedido::find($pedido_id);

        $pedido->delete();

        return redirect()->route('pedido.index')->with('success', 'pedido eliminado exitosamente.');
    }
}
