<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PerfilController extends Controller
{
    /**
     * Mostrar la vista del perfil.
     */
    public function index()
    {
        return view('perfil.index');
    }
}
