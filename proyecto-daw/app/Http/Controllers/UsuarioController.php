<?php

namespace App\Http\Controllers;

use App\Models\Usuario;
use App\Http\Requests\StoreUsuarioRequest;
use App\Http\Requests\UpdateUsuarioRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UsuarioController extends Controller
{
    public function index()
    {
        $usuarios = Usuario::orderBy('id_usuario','asc')->paginate(8);

        return view('dashboard.usuarios.index',compact('usuarios'));
    }
    public function create(Request $request ){}
    public function store(StoreUsuarioRequest $request)
    {

        $data = $request->validated();

        Usuario::create([
            'name' => $data['name'],
            'apellidos' => $data['apellidos'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'rol' => $data['rol'] ?? 'cliente', 
        ]);

        return redirect()->route('usuario.index')->with('success', 'Usuario creado exitosamente.');

    }
    public function show($id_usuario)
    {
        $usuario = Usuario::with('tarjetas', 'direcciones', 'pedidos', 'pagos')->findOrFail($id_usuario);

        return view('dashboard.usuarios.show', compact('usuario'));
    }
     /**$usuario contiene el id del usuario que queremos editar, laravel por defecto buscaría un campo id en la tabla usuarios,
      * pero como le hemos especificado en el modelo que la clave primaria es id_usuario pasando por los parametros de esta
        manera laravel ya entiende que le estamos pasando un usuario de la tabla usuarios cuya clave primaria esta registrada en 
        la variable usuario, de forma que lo podemos pasar directamente a la vista**/
    public function edit(Usuario $usuario)
    {
        return view('dashboard.usuarios.edit', compact('usuario'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateUsuarioRequest $request, Usuario $usuario)
    {  
        
       $data = $request->validated();

        if ($request->filled('password')) {
            $data['password'] = Hash::make($request->password);
            $usuario->update($data);
            return redirect()->route('usuario.index')->with('success', 'Usuario actualizado exitosamente.');
        }
        
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($usuario_id)
    {
        $usuario = Usuario::findOrFail($usuario_id);

        $usuario->delete();

        return redirect()->route('usuario.index')->with('success', 'Usuario eliminado exitosamente.');

    }
}