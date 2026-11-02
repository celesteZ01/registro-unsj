<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Listado de Especies
        </h2>
    </x-slot>

    <div class="flex justify-between items-center mb-6">
        
        <a href="{{ route('species.create') }}"
            class="px-4 py-2 text-sm text-white bg-indigo-600 rounded-lg hover:bg-indigo-700">+ Nueva</a>
    </div>
    <div class="bg-white rounded-xl shadow-sm border border-slate-200 overflow-hidden">
        <table class="w-full text-left text-sm">
            <thead class="bg-slate-50 border-b text-xs text-slate-500 uppercase">
                <tr>
                    <th class="py-3 px-6">ID</th>
                    <th class="py-3 px-6">Nombre</th>
                    <th class="py-3 px-6 text-right">Acciones</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-100">
                @forelse ($species as $item)
                    <!-- lee el campo... ($species as $id => $item) ... {id} este lee índice de la posiciónde la lista -->
                    <tr class="hover:bg-slate-50">
                        <td class="py-3 px-6 font-mono text-xs text-slate-400">#{{ $item['id'] }}</td>
                        <td class="py-3 px-6 font-medium">
                            <a href="{{ route('species.show', $item['id'] ?? $item->id) }}"
                                class="hover:underline text-indigo-600 hover:text-indigo-800 font-semibold">
                                {{ $item['name'] ?? $item->name }}
                            </a>
                        </td>
                        <td class="py-3 px-6 text-right space-x-2">
                            <a href="{{ route('species.edit', $item['id']) }}"
                                class="text-indigo-600 hover:underline">Editar</a>
                            <form action="{{ route('species.destroy', $item['id']) }}" method="POST" class="inline"
                                onsubmit="return confirm('¿Borrar?');">
                                @csrf @method('DELETE')
                                <button class="text-rose-600 hover:underline">Eliminar</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="3" class="py-8 text-center text-slate-400">No hay especies registradas.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</x-app-layout>