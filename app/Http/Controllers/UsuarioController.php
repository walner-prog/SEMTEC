<?php

namespace App\Http\Controllers;

 

class UsuarioController extends Controller
{
    /**
     * Mostrar la vista principal de usuarios.
     */

    public function index()
    { 
        return view('usuarios.index');
    }

    
}
