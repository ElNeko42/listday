<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\ChecklistController;
use App\Models\Checklist;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/register', [RegisterController::class, 'register']);
Route::post('/login', [LoginController::class, 'login']);

Route::get('/tasks', [ChecklistController::class, 'index'])->middleware('auth:sanctum');

Route::post('/tasks', [ChecklistController::class, 'store'])->middleware('auth:sanctum');
Route::patch('/tasks/{task}', [ChecklistController::class, 'updateCheck'])->middleware('auth:sanctum');
Route::put('/task/{task}', [ChecklistController::class, 'update'])->middleware('auth:sanctum');




