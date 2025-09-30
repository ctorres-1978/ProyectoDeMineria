<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\RegisteredUserController; 
use App\Http\Controllers\AdminController; 
use App\Http\Controllers\ReporteDiarioController; // <-- AÑADIDO: Importar el controlador

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Aquí registramos las rutas web para la aplicación.
|
*/

// Esta ruta redirige la página principal (/) al login.
Route::get('/', function () {
    return redirect()->route('login');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// =========================================================
// RUTAS PROTEGIDAS (Middleware: 'auth')
// =========================================================
Route::middleware('auth')->group(function () {
    
    // RUTAS BASE DE AUTH (PROFILE)
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // RUTA PROTEGIDA PARA EL ADMIN: CREAR USUARIO
    Route::get('/create-user', [RegisteredUserController::class, 'create'])->name('user.create'); 
    Route::post('/create-user', [RegisteredUserController::class, 'store'])->name('user.store'); 

    // RUTA PARA EL ACCESO AL SISTEMA (system.home)
    Route::get('/sistema', function () {
        return view('system.home'); 
    })->name('system.home');

    // TAREA 3.5: RUTA DEL MÓDULO DE OPERACIONES (REPORTE DIARIO)
    // Esto crea rutas: /reportes, /reportes/create, /reportes/{id}, etc.
    Route::resource('reportes', ReporteDiarioController::class); 

    // MANTENGO TUS RUTAS ORIGINALES DEL ADMIN COMENTADAS (Solo para referencia)
    /*
    Route::get('/admin/create-user', [AdminController::class, 'createUserForm'])
        ->middleware(['auth', 'can:admin'])
        ->name('admin.create-user');

    Route::post('/admin/create-user', [AdminController::class, 'store'])
        ->middleware(['auth', 'can:admin'])
        ->name('admin.store-user');
    */

});

require __DIR__.'/auth.php';
