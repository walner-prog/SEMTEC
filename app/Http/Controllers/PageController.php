<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PageController extends Controller
{
    public function mision()
    {
        return view('pages.mision');
    }

    public function vision()
    {
        return view('pages.vision');
    }

    public function juegos()
    {
        return view('pages.juegos');
    }

    public function contacto()
    {
        return view('pages.contacto');
    }

    public function ia()
    {
        return view('pages.ia'); // Crea esta vista en resources/views/pages/ia.blade.php
    }
}
