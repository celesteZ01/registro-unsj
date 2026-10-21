<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MovieController extends Controller
{
    private $movies = [
        ['id' => 1, 'título' => 'Avatar', 'género' => 'Ciencia Ficción', 'año' => 2009], 
        ['id' => 2, 'título' => 'Interstellar', 'género' => 'Aventura / Drama', 'año' => 2014],
        ['id' => 3, 'título' => 'Iron Man', 'género' => 'Ciencia Ficción / Acción', 'año' => 2008],
    ];

    public function index()
    {
        // Si no existe nada en la sesión, inicializamos con el array por defecto
        if (!session()->has('movies')) {
            session(['movies' => $this->movies]);
        }

        return view('layouts.movies', [
            'movies' => session('movies')
        ]);
    }

    public function store(Request $request)
    {
        $valDatos = $request->validate([
            'título' => 'required|string|max:255',
            'género' => 'required|string|max:255',
            'año' => 'required|integer|min:1888|max:' . date('Y'),
        ]);

        $movies = session('movies', $this->movies);

        // Generar un id nuevo autoincremental
        $valDatos['id'] = count($movies) > 0 ? max(array_column($movies, 'id')) + 1 : 1;

        $movies[] = $valDatos;
        session(['movies' => $movies]);

        return redirect()->route('movies.index')->with('success', 'Movie added successfully!');
    }

    public function edit(int $id)
    {
        $movies = session('movies', $this->movies);
        $editing = collect($movies)->firstWhere('id', $id);

        abort_if(!$editing, 404);

        return view('layouts.movies', ['movies' => $movies, 'editing' => $editing]);
    }

    public function update(Request $request, int $id)
    {
        $valDatos = $request->validate([ 
            'título' => 'required|string|max:255',
            'género' => 'required|string|max:255',
            'año' => 'required|integer|min:1888|max:' . date('Y'),
        ]);

        $movies = session('movies', $this->movies);
        $movies = array_map(function ($movie) use ($id, $valDatos) {
            if ($movie['id'] === $id) {
                return array_merge($movie, $valDatos);
            }
            return $movie;
        }, $movies);

        session(['movies' => $movies]);
        return redirect()->route('movies.index')->with('success', 'Movie updated successfully!');
    }

    public function destroy(int $id)
    {
        $movies = session('movies', $this->movies);
        $movies = array_values(array_filter($movies, fn ($movie) => $movie['id'] !== $id));

        session(['movies' => $movies]);
        return redirect()->route('movies.index')->with('success', 'Movie deleted successfully!');
    }
}