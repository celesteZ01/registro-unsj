<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ListarPersonasController;
use App\Http\Controllers\MovieController;
use App\Http\Controllers\AnimalController;
use App\Http\Controllers\UserController;


# ruta raíz.. responde al método GET en la raíz y devuelve la vista welcome
Route::get('/', function () {
    return view('welcome');
});

Route::get('/home', function () {
    return view('home');
})->name('home');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified']) -> name ('dashboard');  #middleware es como un filtro que intermedia la comunicación para saber si estás autenticado y que el email esté verificado, por eso lleva a inicar sesión o registrarse.

#lo que venga con la ruta /personas, ejecuta el método index de la clase ListarPersonaController
Route:: get('/personas', [ListarPersonasController::class,'index']); 

#rutas /movies
Route::get('/movies', [MovieController::class, 'index']) -> name ('movies.index');
Route::post('/movies', [MovieController::class, 'store']) -> name('movies.store');
Route::get('/movies/{id}/edit', [MovieController::class, 'edit']) -> name('movies.edit'); #ruta con parámetro → {id}
Route::put('/movies/{id}', [MovieController::class, 'update']) -> name('movies.update');
Route::delete('/movies/{id}', [MovieController::class, 'destroy']) -> name('movies.destroy');


#ruta /animales
Route::resource('/animales', AnimalController::class);
Route::post('/animales/reset', [AnimalController::class, 'reset']) ->name('animales.reset');

#ruta que apunta al métdo index del controlador
Route:: get ('/usuarios', [UserController::class, 'index']);




Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// #otra forma de definir rutas... lo que venga con la ruta /prueba, muestra el arreglo que está en la función definida dentro de la mismísima ruta
// Route:: get ('/prueba', function () {
//     $personas = [
//         ['nombre' => 'Juan', 'edad' => 25],
//         ['nombre' => 'María', 'edad' => 30],
//         ['nombre' => 'Pedro', 'edad' => 28],
//     ];
//     return  $personas;
// }) -> name('prueba');

require __DIR__.'/auth.php';
