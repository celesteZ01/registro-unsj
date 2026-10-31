@extends('layouts.animals')

@section('title', 'Registrar Animal')

@section('content')
    <div class="max-w-xl mx-auto bg-white dark:bg-slate-950 p-6 rounded-lg border border-slate-200 dark:border-slate-800 shadow-sm">
        <h2 class="text-xl font-bold mb-6 text-slate-800 dark:text-slate-100">Registrar Nuevo Animal</h2>

        <form action="{{ route('animales.store') }}" method="POST" class="space-y-4">
            @csrf
            <div>
                <label class="block text-sm font-medium mb-1">Nombre</label>
                <input type="text" name="name" value="{{ old('name') }}" class="w-full rounded-md border border-slate-300 dark:border-slate-700 bg-transparent text-slate-900 px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500" required>
                @error('name')
                <p class="text-red-500 text-sm mt-1" >{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label class="block text-sm font-medium mb-1">Especie</label>
                <input type="text" name="species" value="{{ old('species') }}" placeholder="Ej: Perro, Felino..." class="w-full rounded-md border border-slate-300 dark:border-slate-700 bg-transparent text-slate-900 px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500" required>
                @error('species')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label class="block text-sm font-medium mb-1">Edad (años)</label>
                <input type="number" name="age" value="{{ old('age') }}" min="0" class="w-full rounded-md border border-slate-300 dark:border-slate-700 bg-transparent text-slate-900 px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500" required>
                @error('age')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="flex items-center gap-3 pt-4">
                <button type="submit" class="rounded-md bg-indigo-600 px-4 py-2 text-sm font-medium text-white hover:bg-indigo-500 transition">Guardar</button>
                <a href="{{ route('animales.index') }}" class="rounded-md border border-slate-300 dark:border-slate-700 px-4 py-2 text-sm font-medium text-slate-700 dark:text-slate-300 hover:bg-slate-50 dark:hover:bg-slate-900 transition">Cancelar</a>
            </div>
        </form>
    </div>
@endsection