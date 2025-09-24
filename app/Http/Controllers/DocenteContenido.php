<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DocenteContenido extends Controller
{
    public function index() {

        return view('docentes.index');
    }
}
