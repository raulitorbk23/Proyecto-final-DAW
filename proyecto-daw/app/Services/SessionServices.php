<?php

namespace App\Services;

use Illuminate\Support\Facades\Session;

class SessionServices
{
    public function obtenerDatosCookie($cookie)
    {
        switch($cookie){
            case 'carrito':
                if (Session::has('carrito')) {
                    $data = Session::get('carrito');
                    return $data;
                } else {
                    return [
                        'message' => 'No data found in session',
                    ];
                }
        }

    }
}