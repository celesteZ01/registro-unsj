@extends('layouts.app')

@section('content')
<div class="mb-6 flex justify-between items-center">
    <h1 class="text-3xl font-bold text-gray-800">Cartelera de Películas</h1>
</div>

<div class="grid grid-cols-1 md:grid-cols-3 gap-6">
    @foreach ($movies as $movie)
        <div class="bg-white rounded-lg shadow p-6 flex flex-col justify-between border border-gray-200">
            <div>
                <span class="text-xs font-semibold px-2 py-1 bg-indigo-100 text-indigo-700 rounded-full">
                    {{ $movie['genre'] }}
                </span>
                <h2 class="text-xl font-bold mt-2 text-gray-900">{{ $movie['title'] }}</h2>
                <p class="text-sm text-gray-500 mt-1">Año de estreno: {{ $movie['year'] }}</p>
            </div>
            
            <div class="mt-6 pt-4 border-t border-gray-100">
                <a href="{{ route('movies.edit', $movie['id']) }}" 
                   class="inline-block text-center w-full bg-indigo-600 hover:bg-indigo-700 text-white font-medium py-2 px-4 rounded transition">
                    Editar
                </a>
            </div>
        </div>
    @endforeach
</div>
@endsection