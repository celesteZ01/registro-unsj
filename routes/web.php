<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ListarPersonasController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route:: get('/', function () {
    return view('welcome');
});
#ruta que apunta al métdo index del controlador
Route:: get ('/usuarios', [UserController::class, 'index']);

Route:: get('/personas', [ListarPersonasController::class,'index']);

Route::get('/home', function () {
    return view('home');
})->name('home');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
