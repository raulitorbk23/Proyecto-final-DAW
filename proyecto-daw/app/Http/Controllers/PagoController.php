<?php

namespace App\Http\Controllers;

use App\Models\Pago;
use App\Http\Requests\UpdatePagoRequest;
use App\Models\DireccionEnvio;
use App\Models\Pedido;
use App\Models\Producto;
use App\Models\Tarjeta;
use App\Models\Usuario;
use App\Services\SessionServices;
use Carbon\Carbon;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PagoController extends Controller
{
    protected $SessionServices;

    public function __construct(SessionServices $SessionServices)
    {
        $this->SessionServices = $SessionServices;
    }
    public function index()
    {
        $productosCarrito = $this->SessionServices->obtenerDatosCookie('carrito');
        $user = Auth::user();
        $tarjetas = $user->tarjetas;
        $direcciones = $user->direcciones;
        return view('pagar', compact('tarjetas', 'direcciones', 'productosCarrito'));
    }
    public function create(){}
    public function store(Request $request)
    {
        $result = $request->all();
        $productosCarrito = $this->SessionServices->obtenerDatosCookie('carrito');
        $data = json_decode($result['data'], true);

        $detalle = $data['detalles'];
        $infoEnvio = $data['infoEnvio'] ?? null;
        $infoTarjeta = $data['infoTarjeta'] ?? null;
        $tarjetaId = $data['tarjeta_id'] ?? null;
        $direccionId = $data['direccion_id'] ?? null;
    
        $fecha = $detalle['update_time'];
        $fechaCarbon = Carbon::parse($fecha);
        $fechaFormateada = $fechaCarbon->toDateString();
    
        $userId = Auth::id();
    
      
        // Guardar dirección y tarjeta solo si son nuevas
        if (!$direccionId && $infoEnvio) {
            $direccionEnvio = DireccionEnvio::create($infoEnvio);
        } else {
            $direccionEnvio = DireccionEnvio::find($direccionId);
        }

        if (!$tarjetaId && $infoTarjeta) {
            $tarjeta = Tarjeta::create($infoTarjeta);
        } else {
            $tarjeta = Tarjeta::find($tarjetaId);
        }
        $total = 0;
        foreach ($productosCarrito as $index => $item){
            $total += $item['precio'] * $item['cantidad'];
        }
        // Crear pedido
        $pedido = Pedido::create([
            'fecIni' => $fechaFormateada,
            'estado' => $detalle['status'],
            'precioTotal' => $total,
            'id_usuario' => $userId,
            'id_direccion' => $direccionEnvio->id_direccion,
        ]);
        // Adjuntar productos al pedido
        foreach ($productosCarrito as $producto) {
            $idProd = Producto::where('nombre', $producto['nombre'])->first();
            if ($idProd) {
                $pedido->productos()->attach($idProd->id_producto, [
                    'cantidadProducto' => $producto['cantidad'],
                    'precioProducto' => $producto['precio'],
                ]);
            }
        }
          // Crear pago
        $pago = Pago::create([
            'id_transaccion' => $detalle['id'],
            'cantidad' => $detalle['purchase_units'][0]['amount']['value'],
            'estado' => $detalle['status'],
            'email' => $detalle['payer']['email_address'],
            'fecPago' => $fechaFormateada,
            'id_cliente' => $detalle['payer']['payer_id'],
            'id_usuario' => $userId,
            'id_tarjeta' => $tarjeta->id_tarjeta, 
            'id_pedido' => $pedido->id_pedido 
        ]);
    
        // Tablas relacionales
        $usuario = Usuario::find($userId);

        $usuario->direcciones()->syncWithoutDetaching([$direccionEnvio->id_direccion]);
        $usuario->tarjetas()->syncWithoutDetaching([$tarjeta->id_tarjeta]);

        Session::forget('carrito');

        return response()->json([
            'data' => $pedido->id_pedido,
        ]);
    }


    public function detalles($id_pedido)
    {
        $pedido = Pedido::with('direccionEnvio', 'productos', 'pagos.tarjeta')->findOrFail($id_pedido);
        return view('detallesPedido', compact('pedido'));
    }
    public function show(Request $request)
    {
        //
    }

    public function edit(Pago $pago)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePagoRequest $request, Pago $pago)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Pago $pago)
    {
        //
    }
}
