<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

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

// Rutas del panel de administración para la creación de usuarios
Route::get('/admin/create-user', [AdminController::class, 'createUserForm'])
    ->middleware(['auth', 'can:admin'])
    ->name('admin.create-user');

Route::post('/admin/create-user', [AdminController::class, 'store'])
    ->middleware(['auth', 'can:admin'])
    ->name('admin.store-user');

require __DIR__.'/auth.php';
