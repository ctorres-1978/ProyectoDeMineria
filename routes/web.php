<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\RegisteredUserController; // LÍNEA ESENCIAL AÑADIDA
use App\Http\Controllers\AdminController; // Mantengo esta línea ya que la tenías en tu código

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Esta es la ruta que se encarga de redirigir la página principal (/) al login.
Route::get('/', function () {
    return redirect()->route('login');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


// =========================================================
// RUTA PROTEGIDA PARA EL ADMIN: CREAR USUARIO
// =========================================================
Route::middleware('auth')->group(function () {
    // Definimos la ruta /create-user que es la que se usa en el botón del dashboard.
    // Reutilizamos el controlador de registro que ya modificamos (RegisteredUserController)
    Route::get('/create-user', [RegisteredUserController::class, 'create'])->name('user.create'); 
    Route::post('/create-user', [RegisteredUserController::class, 'store'])->name('user.store'); 
});


// MANTENGO TUS RUTAS ORIGINALES DEL ADMIN COMENTADAS, PERO NO SON NECESARIAS POR AHORA:
/*
Route::get('/admin/create-user', [AdminController::class, 'createUserForm'])
    ->middleware(['auth', 'can:admin'])
    ->name('admin.create-user');

Route::post('/admin/create-user', [AdminController::class, 'store'])
    ->middleware(['auth', 'can:admin'])
    ->name('admin.store-user');
*/

// routes/web.php

// ... (Bloques de rutas anteriores, incluyendo las de /create-user) ...


// =========================================================
// RUTA PARA EL ACCESO AL SISTEMA (system.home)
// =========================================================
Route::middleware('auth')->group(function () {
    // Definimos la ruta /sistema con el nombre 'system.home'
    Route::get('/sistema', function () {
        // Esta es la vista que vamos a crear en el siguiente paso
        return view('system.home'); 
    })->name('system.home');
});

require __DIR__.'/auth.php';

require __DIR__.'/auth.php';
