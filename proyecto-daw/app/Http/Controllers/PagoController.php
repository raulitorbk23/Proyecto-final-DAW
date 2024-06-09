<?php

namespace App\Http\Controllers;

use App\Models\Pago;
use App\Http\Requests\StorePagoRequest;
use App\Http\Requests\UpdatePagoRequest;
use App\Models\DireccionEnvio;
use App\Models\Pedido;
use App\Models\Producto;
use App\Models\Tarjeta;
use App\Models\Usuario;
use App\Services\SessionServices;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PagoController extends Controller
{

    protected $SessionServices;

    public function __construct(SessionServices $SessionServices)
    {
        $this->SessionServices = $SessionServices;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $productosCarrito = $this->SessionServices->obtenerDatosCookie('carrito');
        #return $productosCarrito;
        return view('pagar', compact('productosCarrito'));
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
    public function store(Request $request)
    {

        $result = $request->all();

        $productosCarrito = $this->SessionServices->obtenerDatosCookie('carrito');

        $data = json_decode($result['data'], true);

        #dd($data);

        $detalle = $data['detalles'];
        $infoEnvio = $data['infoEnvio'];
        $infoTarjeta = $data['infoTarjeta'];
        
        $fecha = $detalle['update_time'];
        $fechaCarbon = Carbon::parse($fecha);
        $fechaFormateada = $fechaCarbon->toDateString();

        $userId = Auth::id();

        $pago = Pago::create([
            'id_transaccion' => $detalle['id'],
            'cantidad' => $detalle['purchase_units'][0]['amount']['value'],
            'estado' => $detalle['status'],
            'email' => $detalle['payer']['email_address'],
            'fecPago' => $fechaFormateada,
            'id_cliente' => $detalle['payer']['payer_id'],
            'id_usuario' => $userId,
            'id_tarjeta' => 1,
        ]);

        $direccionEnvio = DireccionEnvio::create([
            'pais' => $infoEnvio['pais'],
            'localidad' => $infoEnvio['localidad'],
            'codPostal' => $infoEnvio['codPostal'],
            'direccion' => $infoEnvio['direccion'],
            'telefono' => $infoEnvio['telefono'],
        ]);

        $tarjeta = Tarjeta::create([
            'numTarjeta' => $infoTarjeta['numTarjeta'],
            'titular' => $infoTarjeta['titular'],
            'fecExpira' => $infoTarjeta['fecExpira'],
            'cvc' => $infoTarjeta['cvc'],
        ]);

        $pedido = Pedido::create([
            'fecIni' => $fechaFormateada,  
            'estado' => 'realizado',
            'precioTotal' => array_sum(array_column($productosCarrito, 'precio')) * array_sum(array_column($productosCarrito, 'cantidad')),
            'id_usuario' => $userId,
            'id_direccion' => $direccionEnvio->id_direccion,
        ]);

        

        foreach ($productosCarrito as $producto) {

            $idProd = Producto::where('nombre', $producto['nombre'])->first();

            if ($idProd) {
                $pedido->productos()->attach($idProd->id_producto, [
                    'cantidadProducto' => $producto['cantidad'],
                    'precioProducto' => $producto['precio'],
                ]);
            }
        }

        $usuario = Usuario::find($userId);

        //tablas relacionales
        $usuario->direcciones()->attach($direccionEnvio->id_direccion);

        $usuario->tarjetas()->attach($tarjeta->id_tarjeta);

        $pago->update(['id_tarjeta' => $tarjeta->id_tarjeta]);
    }

    /**
     * Display the specified resource. Pago $pago
     */
    public function show(Request $request)
    {
        $data = $request;
        return $data;
    }

    /**
     * Show the form for editing the specified resource.
     */
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
