@extends('layouts.app')

@section('content')
<div class="max-w-xl mx-auto bg-white p-8 rounded-lg shadow border border-gray-200">
    <h1 class="text-2xl font-bold text-gray-800 mb-6">Editar Película</h1>

    <form action="{{ route('movies.index') }}" method="GET">
        @csrf
        @method('PUT')

        <div class="mb-4">
            <label for="title" class="block text-sm font-medium text-gray-700 mb-1">Título de la película</label>
            <input type="text" 
                   id="title" 
                   name="title" 
                   value="{{ $movie['title'] }}" 
                   class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-indigo-500"
                   required>
        </div>

        <div class="mb-4">
            <label class="block text-sm font-medium text-gray-500 mb-1">Género</label>
            <input type="text" value="{{ $movie['genre'] }}" disabled class="w-full bg-gray-100 border border-gray-200 rounded-md px-3 py-2 text-gray-500">
        </div>

        <div class="mb-6">
            <label class="block text-sm font-medium text-gray-500 mb-1">Año</label>
            <input type="text" value="{{ $movie['year'] }}" disabled class="w-full bg-gray-100 border border-gray-200 rounded-md px-3 py-2 text-gray-500">
        </div>

        <div class="flex items-center justify-end space-x-3">
            <a href="{{ route('movies.index') }}" class="px-4 py-2 text-gray-600 hover:text-gray-800 text-sm">Cancelar</a>
            <button type="submit" class="bg-indigo-600 hover:bg-indigo-700 text-white font-medium py-2 px-5 rounded transition">
                Guardar
            </button>
        </div>
    </form>
</div>
@endsection