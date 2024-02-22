<?php
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use Illuminate\Support\Facades\Redirect;

Route::get('/', function () {
    return Redirect::route('login');
});

Route::middleware(['web', 'auth:sanctum'])->group(function () {
    Route::get('/home', function () {
        return Inertia::render('Stack/Home');
    })->name('home');
    
});

// Rutas para el perfil del usuario, también protegidas por sanctum
Route::middleware(['auth:sanctum'])->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Rutas de autenticación
require __DIR__.'/auth.php';

