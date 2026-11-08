<?php

use App\Http\Controllers\AnimalController;
use App\Http\Controllers\SpeciesController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Ai\Agents\PetAssist;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['auth', 'user_is:admin'])->resource('/users', UserController::class); #obliga a estar logueado y ser admin para acceder a estas rutas. #user_is configurado en boostrap/app.php

#obliga a estar logueado y ser admin para acceder a estas rutas.
#Route::middleware(['auth', 'is_admin'])->resource('/users', UserController::class); #is_admin configurado en boostrap/app.php

Route::middleware('auth')->group(function () { #obliga a estar logueado para acceder a estas rutas.
    
    Route::post('/animales/reset', [AnimalController::class, 'reset'])->name('animales.reset');
    Route::resource('animales', AnimalController::class)->parameters(['animales' => 'animal']); #supuestamente arregla de lo animales en singular.
    Route::resource('species', SpeciesController::class);
});

Route::get('/dashboard', function () {
    #no funciona xq no tengo ia
    #$mensaje= app(PetAssist::class)->prompt('Responde'); #controller inline
    #$mensaje= Str::markdown($mensaje);
    #return view('dashboard', compact('mensaje'));
    return view('dashboard');

})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () { #obliga a estar logueado para acceder a estas rutas.
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


require __DIR__ . '/auth.php';
