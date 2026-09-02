<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MovieController extends Controller
{
    private function initializeMovies()
    {
        if (!session()->has('movies')) {
            $initialMovies = [
                [
                    'id' => 1,
                    'title' => 'Inception',
                    'genre' => 'Ciencia Ficción',
                    'year' => 2010
                ],
                [
                    'id' => 2,
                    'title' => 'El Padrino',
                    'genre' => 'Crimen / Drama',
                    'year' => 1972
                ],
                [
                    'id' => 3,
                    'title' => 'Interstellar',
                    'genre' => 'Aventura / Drama',
                    'year' => 2014
                ],
            ];
            session(['movies' => $initialMovies]);
        }
    }

    public function index()
    {
        $this->initializeMovies();
        $movies = session('movies');

        return view('movies.index', compact('movies'));
    }

    public function edit($id)
    {
        $this->initializeMovies();
        $movies = session('movies');

        $movie = collect($movies)->firstWhere('id', (int) $id);

        if (!$movie) {
            abort(404, 'Película no encontrada');
        }

        return view('movies.edit', compact('movie'));
    }
}