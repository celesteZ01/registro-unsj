@extends('layouts.app')

@section('title', 'Editar Animal')

@section('content')
    <div class="max-w-xl mx-auto bg-white dark:bg-slate-950 p-6 rounded-lg border border-slate-200 dark:border-slate-800 shadow-sm">
        <h2 class="text-xl font-bold mb-6 text-slate-800 dark:text-slate-100">Editar Animal</h2>

        <form action="{{ route('animales.update', $animal['id']) }}" method="POST" class="space-y-4">
            @csrf
            @method('PUT')

            <div>
                <label class="block text-sm font-medium mb-1">Nombre</label>
                <input type="text" name="nombre" value="{{ old('nombre', $animal['nombre']) }}" class="w-full rounded-md border border-slate-300 dark:border-slate-700 bg-transparent px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500" required>
            </div>

            <div>
                <label class="block text-sm font-medium mb-1">Especie</label>
                <input type="text" name="especie" value="{{ old('especie', $animal['especie']) }}" class="w-full rounded-md border border-slate-300 dark:border-slate-700 bg-transparent px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500" required>
            </div>

            <div>
                <label class="block text-sm font-medium mb-1">Edad (años)</label>
                <input type="number" name="edad" value="{{ old('edad', $animal['edad']) }}" min="0" class="w-full rounded-md border border-slate-300 dark:border-slate-700 bg-transparent px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500" required>
            </div>

            <div class="flex items-center gap-3 pt-4">
                <button type="submit" class="rounded-md bg-indigo-600 px-4 py-2 text-sm font-medium text-white hover:bg-indigo-500 transition">Actualizar</button>
                <a href="{{ route('animales.index') }}" class="rounded-md border border-slate-300 dark:border-slate-700 px-4 py-2 text-sm font-medium text-slate-700 dark:text-slate-300 hover:bg-slate-50 dark:hover:bg-slate-900 transition">Cancelar</a>
            </div>
        </form>
    </div>
@endsection