<?php

use App\Http\Controllers\AnimalController;
use App\Http\Controllers\SpeciesController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AnimalEventController;
use App\Http\Controllers\AnimalOwnerController;
use App\Ai\Agents\PetAssist;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['auth', 'user_is:admin'])->resource('/users', UserController::class); #obliga a estar logueado y ser admin para acceder a estas rutas. #user_is configurado en boostrap/app.php

#obliga a estar logueado y ser admin para acceder a estas rutas.
#Route::middleware(['auth', 'is_admin'])->resource('/users', UserController::class); #is_admin configurado en boostrap/app.php

Route::middleware(['auth', 'user_is:admin,employee'])->group(function () {
    // Dueños del animal
    Route::post('/animales/{animal}/owners', [AnimalOwnerController::class, 'store'])->name('animales.owners.store');
    Route::delete('/animales/{animal}/owners/{user}', [AnimalOwnerController::class, 'destroy'])->name('animales.owners.destroy');
    Route::patch('/animales/{animal}/owners/{user}/primary', [AnimalOwnerController::class, 'setPrimary'])->name('animales.owners.primary');

    // Eventos del animal
    Route::post('/animales/{animal}/events', [AnimalEventController::class, 'store'])->name('animales.events.store');
    Route::delete('/animales/{animal}/events/{event}', [AnimalEventController::class, 'destroy'])->name('animales.events.destroy');
});

#Solo el admin puede acceder al recurso de especies
Route::middleware(['auth', 'user_is:admin'])->resource('/species', SpeciesController::class);

Route::middleware('auth')->group(function () { #obliga a estar logueado para acceder a estas rutas.
    
    Route::post('/animales/reset', [AnimalController::class, 'reset'])->name('animales.reset');
    Route::resource('animales', AnimalController::class)->parameters(['animales' => 'animal']); #supuestamente arregla de lo animales en singular.
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
