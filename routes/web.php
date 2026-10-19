<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ListarPersonasController;
use App\Http\Controllers\MovieController;
use App\Http\Controllers\AnimalController;

Route::get('/', function () {
    return view('welcome');
});

Route:: get(
    '/', 
    function () {
        return view('welcome');
    }
);

Route:: get('/personas', [ListarPersonasController::class,'index']); #lo que venga con la ruta /personas, ejecuta el método index de la clase ListarPersonaController

#moviesss
Route::get('/movies', [MovieController::class, 'index'])->name('movies.index');
Route::get('/movies/{id}/edit', [MovieController::class, 'edit'])->name('movies.edit');


Route::resource('animales', AnimalController::class); #ruta para el CRUD de animalesss


#ruta que apunta al métdo index del controlador
Route:: get ('/usuarios', [UserController::class, 'index']);


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
