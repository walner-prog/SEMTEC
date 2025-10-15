<?php

namespace App\Http\Controllers;

 

class CursoController extends Controller
{
    /**
     * Muestra el listado de cursos.
     */
    public function index()
    {
        
        
        return view('cursos.index');
    }
}
