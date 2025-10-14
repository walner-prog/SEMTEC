<?php

use App\Http\Controllers\ProfileController;

use Illuminate\Support\Facades\Route;

 
use App\Http\Controllers\UsuarioController;
use App\Http\Controllers\RolController;
use App\Http\Controllers\ConfiguracionController;
use App\Http\Controllers\DocenteContenido;
use App\Http\Controllers\PageController;
use App\Http\Controllers\PerfilController;



  
use Illuminate\Support\Facades\Artisan;

  

Route::get('/generar_enlace_simbolico', function() {
    Artisan::call('storage:link');
    return '¡Enlace simbólico creado!';
});


 
 

Route::get('/artisan/{command}', function ($command) {
    // ⚠️ Seguridad: key secreta
    if (request('key') !== 'MI_SECRETO_SUPER_SECRETA') {
        abort(403, 'No autorizado');
    }

    // Lista de comandos permitidos
    $permitidos = [
        'cache:clear',
        'config:clear',
        'route:clear',
        'view:clear',
        'storage:link',
        'migrate:refresh --seed', // agregamos el migrate:refresh --seed
    ];

    if (!in_array($command, $permitidos)) {
        return "❌ Comando no permitido.";
    }

    Artisan::call($command);

    return "✅ Comando [$command] ejecutado correctamente.";
});





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



// Agrupamos todas las rutas protegidas
Route::middleware('auth')->group(function () {
   
    // Solo administradores
    Route::middleware('role:Administrador')->group(function () {
        Route::get('/usuarios', [UsuarioController::class, 'index'])->name('usuarios');
        Route::get('/roles', [RolController::class, 'index'])->name('roles');


        Route::get('/configuraciones', [ConfiguracionController::class, 'index'])->name('configuraciones.index');
  
      

        // Perfil
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



});

require __DIR__ . '/auth.php';
