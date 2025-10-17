<?php

use App\Http\Controllers\ProfileController;

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UsuarioController;
use App\Http\Controllers\RolController;
use App\Http\Controllers\DocenteContenido;
use App\Http\Controllers\PageController;
use App\Http\Controllers\PerfilController;
use App\Http\Controllers\CursoController;
use Illuminate\Support\Facades\Artisan;

// Página de login
Route::get('/login', function () {
    // tu vista de login
})->middleware('guest')->name('login');

// Redirigir la raíz "/" según el estado de autenticación
Route::get('/', function () {
    // return redirect()->route(auth()->check() ? 'dashboard' : 'login');
    return view('welcome');
});

// Dashboard
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

 
Route::view('/politicas-de-privacidad', 'politicas')->name('politicas');
Route::view('/condiciones-de-uso', 'condiciones')->name('condiciones');
Route::view('/demo', 'demo-semtec')->name('demo-semtec');




 
Route::middleware('auth')->group(function () {

   
    Route::middleware('role:Administrador')->group(function () {
        Route::get('/usuarios', [UsuarioController::class, 'index'])->name('usuarios');
        Route::get('/roles', [RolController::class, 'index'])->name('roles');

        
        Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
        Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
        Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    });

    Route::get('/mision', [PageController::class, 'mision'])->name('mision');
    Route::get('/vision', [PageController::class, 'vision'])->name('vision');
    Route::get('/juegos', [PageController::class, 'juegos'])->name('juegos.index');
    Route::get('/docente/contenido', [DocenteContenido::class, 'index'])->name('docente.contenido');
    Route::get('/contacto', [PageController::class, 'contacto'])->name('contacto');
    Route::get('/ia', [PageController::class, 'ia'])->name('ia');
    Route::get('/perfil', [PerfilController::class, 'index'])->name('perfil');
    Route::get('/cursos', [CursoController::class, 'index'])->name('cursos');
    
});

require __DIR__ . '/auth.php';
