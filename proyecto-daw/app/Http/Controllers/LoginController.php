<?php

namespace App\Http\Controllers;

use App\Models\Usuario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);
        if (Auth::attempt($credentials, $request->input('remember'))) {
            $request->session()->regenerate();
            return redirect()->intended('/');
        }
        return back()->withErrors([
            'email' => 'Las credenciales proporcionadas no coinciden con nuestros registros.',
        ])->onlyInput('email');
    }
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }

    public function registro()
    {
        return view('registro');
    }

    public function store(Request $request)
    {

        $name = $request->input('name');
        $apellidos = $request->input('apellidos');
        $email = $request->input('email');
        
        if ($request->input('password')==$request->input('c-password')){

            $password = $request->input('password');

        } else {

            return 'las contraseñas deben ser iguales';
        }
        
        Usuario::create([
            'name'=>$name,
            'apellidos'=>$apellidos,
            'email'=>$email,
            'password'=>Hash::make($password),
        ]);

        return redirect('/login');
    }
}
