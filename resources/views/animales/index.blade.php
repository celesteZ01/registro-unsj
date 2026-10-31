@extends('layouts.animals')

@section('title', 'Listado de Animales')

@section('content')
    <div class="mb-6 flex justify-between items-center">
        <h1 class="text-2xl font-bold text-slate-800 dark:text-slate-100">Listado de Animales</h1>
    
        <!-- Contenedor que junta los dos botones a la derecha -->
        <div class="flex items-center gap-3">
            <a 
                href="{{ route('animales.create') }}" 
                class="rounded-md bg-indigo-600 px-4 py-2 text-sm font-medium text-white hover:bg-indigo-500 transition">
                + Agregar Animal
            </a>
            <form 
                action="{{ route('animales.reset') }}"  method="POST" class="inline">
                @csrf
                @method('POST')
                <button
                    type="submit"
                    style="background-color: #601319;" 
                    class="rounded-md px-4 py-2 text-sm font-medium text-white transition hover:opacity-90"
                    onclick="return confirm ('Resetear los datos? :v')">
                - Reset Sesión
                </button>
            </form>
        </div>
    </div>

    @if(count($animales) > 0)
        <div class="overflow-hidden rounded-lg border border-slate-200 dark:border-slate-800 bg-white dark:bg-slate-950 shadow-sm">
            <table class="w-full text-left text-sm">
                <thead class="bg-slate-50 dark:bg-slate-900 border-b border-slate-200 dark:border-slate-800 text-slate-700 dark:text-slate-300">
                    <tr>
                        <th class="px-6 py-3">ID</th>
                        <th class="px-6 py-3">Nombre</th>
                        <th class="px-6 py-3">Especie</th>
                        <th class="px-6 py-3">Edad</th>
                        <th class="px-6 py-3 text-right">Acciones</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-200 dark:divide-slate-800">
                    @foreach($animales as $animal)
                        <tr class="hover:bg-slate-50/50 dark:hover:bg-slate-900/50">
                            <td class="px-6 py-4 font-mono text-xs text-slate-500">{{ $animal['id'] }}</td>
                            <td class="px-6 py-4 font-semibold text-slate-900 dark:text-slate-100">{{ $animal['name'] }}</td>
                            <td class="px-6 py-4 text-slate-600 dark:text-slate-400">{{ $animal['species'] }}</td>
                            <td class="px-6 py-4 text-slate-600 dark:text-slate-400">{{ $animal['age'] }} años</td>
                            <td class="px-6 py-4 flex justify-end gap-3">
                                <a href="{{ route('animales.edit', $animal['id']) }}" class="rounded bg-amber-500/10 px-2.5 py-1.5 text-xs font-semibold text-amber-600 hover:bg-amber-500/20 dark:text-amber-400 transition">
                                    Editar
                                </a>
                                <form action="{{ route('animales.destroy', $animal['id']) }}" method="POST" onsubmit="return confirm('¿Seguro que deseas eliminar este registro?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="rounded bg-red-500/10 px-2.5 py-1.5 text-xs font-semibold text-red-600 hover:bg-red-500/20 dark:text-red-400 transition">
                                        Eliminar
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @else
        <div class="rounded-lg border border-dashed border-slate-300 dark:border-slate-800 p-8 text-center text-slate-500">
            No hay animales registrados aún en la sesión.
        </div>
    @endif
@endsection