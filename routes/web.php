<?php
use App\Http\Controllers\ProfileController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

// La ruta /home puede ser protegida por el middleware de sanctum
// Asegúrate de que tus rutas de Inertia.js están agrupadas bajo el middleware 'web'
Route::middleware(['web', 'auth:sanctum'])->group(function () {
    Route::get('/home', function () {
        return Inertia::render('Stack/Home');
    })->name('home');
    
    // Otras rutas protegidas por sanctum
});

// Rutas para el perfil del usuario, también protegidas por sanctum
Route::middleware(['auth:sanctum'])->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Rutas de autenticación
require __DIR__.'/auth.php';

