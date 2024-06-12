<?php

namespace App\Http\Controllers;

use App\Models\Pedido;
use App\Http\Requests\StorePedidoRequest;
use App\Models\DireccionEnvio;
use Illuminate\Http\Request;

class PedidoController extends Controller
{
    public function index()
    {
        $pedidos = Pedido::orderBy('id_pedido','asc')->paginate(8);
        return view('dashboard.pedidos.index',compact('pedidos'));
    }

    public function create(){}
    public function store(StorePedidoRequest $request){}
    public function show($id_pedido)
    {
        $pedido = Pedido::with(['usuario', 'direccionEnvio', 'productos', 'pagos'])->findOrFail($id_pedido);
        return view('dashboard.pedidos.show', compact('pedido'));
    }
    public function edit($id_pedido) 
    {
        $pedido = Pedido::findOrFail($id_pedido);
        $direcciones = DireccionEnvio::all()->pluck('direccion', 'id_direccion');
        return view('dashboard.pedidos.edit', compact('pedido', 'direcciones'));
    }
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
