<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Listado de Animales
        </h2>
    </x-slot>

    <div class="flex justify-between items-center mb-6">
        
        <div class="flex items-center gap-3">
            <a href="{{ route('animales.create') }}"
                class="px-4 py-2 text-sm text-white bg-indigo-600 rounded-lg hover:bg-indigo-700 transition">
                + Registrar Animal
            </a>
            <form action="{{ route('animales.reset') }}" method="POST" class="inline">
                @csrf
                <button type="submit"
                    class="px-3 py-2 text-sm text-rose-700 bg-rose-50 border border-rose-200 rounded-lg hover:bg-rose-100 transition"
                    onclick="return confirm('¿Resetear los datos? :v')">
                    - Reset Sesión
                </button>
            </form>
        </div>
    </div>

    <div class="bg-white rounded-xl shadow-sm border border-slate-200 overflow-hidden">
        <table class="w-full text-left text-sm">
            <thead class="bg-slate-50 border-b text-xs text-slate-500 uppercase">
                <tr>
                    <th class="py-3 px-6">ID</th>
                    <th class="py-3 px-6">Nombre</th>
                    <th class="py-3 px-6">Especie</th>
                    <th class="py-3 px-6">Edad</th>
                    <th class="py-3 px-6 text-right">Acciones</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-100">
                @forelse ($animales as $animal)
                    <tr class="hover:bg-slate-50">
                        <td class="py-3 px-6 font-mono text-xs text-slate-400">#{{ $animal['id'] ?? $animal->id }}</td>
                        <td class="py-3 px-6 font-medium">
                            <a href="{{ route('animales.show', $animal['id'] ?? $animal->id) }}"
                                class="hover:underline text-indigo-600 hover:text-indigo-800 font-semibold">
                                {{ $animal['name'] ?? $animal->name }}
                            </a>
                        </td>
                        <td class="py-3 px-6 text-slate-600">{{ $animal['species'] ?? $animal->species }}</td>
                        <td class="py-3 px-6 text-slate-600">{{ $animal['age'] ?? $animal->age }} años</td>
                        <td class="py-3 px-6 text-right space-x-2">
                            <a href="{{ route('animales.edit', $animal['id'] ?? $animal->id) }}"
                                class="text-indigo-600 hover:underline">Editar</a>
                            <form action="{{ route('animales.destroy', $animal['id'] ?? $animal->id) }}" method="POST" class="inline"
                                onsubmit="return confirm('¿Borrar?');">
                                @csrf
                                @method('DELETE')
                                <button class="text-rose-600 hover:underline">Eliminar</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="py-8 text-center text-slate-400">No hay animales registrados.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</x-app-layout>