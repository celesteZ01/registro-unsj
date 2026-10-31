<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ListarPersonasController;
use App\Http\Controllers\SpeciesController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AnimalController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MovieController;

Route::get('/', function () {
    return view('welcome');
});

Route:: get(
    '/', 
    function () {
        return view('welcome');
    }
);

#ruta /species
Route::post('/species/reset', [SpeciesController::class, 'reset'])->name('species.reset');
Route::resource('/species', SpeciesController::class);

#ruta /animales
Route::post('/animales/reset', [AnimalController::class, 'reset']) ->name('animales.reset');
Route::resource('/animales', AnimalController::class);

#ruta que apunta al métdo index del controlador
Route:: get ('/usuarios', [UserController::class, 'index']);

Route:: get('/personas', [ListarPersonasController::class,'index']);

#moviesss
Route::get('/movies', [MovieController::class, 'index'])->name('movies.index');
Route::get('/movies/{id}/edit', [MovieController::class, 'edit'])->name('movies.edit');

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

// #otra forma de definir rutas ?
// Route:: get ('/prueba', function () {
//     $personas = [
//         ['nombre' => 'Juan', 'edad' => 25],
//         ['nombre' => 'María', 'edad' => 30],
//         ['nombre' => 'Pedro', 'edad' => 28],
//     ];
//     return  $personas;
// }) -> name('prueba');

require __DIR__.'/auth.php';
