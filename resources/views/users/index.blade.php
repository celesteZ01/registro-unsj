<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Listado de Usuarios
        </h2>
    </x-slot>
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mb-6">

        <a href="{{ route('users.create') }}"
            class="inline-flex items-center justify-center px-4 py-2 text-sm font-medium text-white bg-indigo-600 rounded-lg hover:bg-indigo-700 transition shadow-sm">
            + Nuevo Usuario
        </a>
    </div>
    <div
        class="bg-white dark:bg-slate-800/60 rounded-xl shadow-sm border border-gray-200 dark:border-slate-700 overflow-hidden">
        <table class="w-full text-left border-collapse">
            <thead>
                <tr class="bg-slate-50 border-b text-xs text-slate-500 uppercase">
                    <th class="py-3 px-6">ID</th>
                    <th class="py-3 px-6">Nombre</th>
                    <th class="py-3 px-6 text-right">Acciones</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200 dark:divide-slate-700 text-sm">
                @forelse ($users as $item)
                    <tr class="hover:bg-gray-50 dark:hover:bg-slate-700/40 transition-colors">
                        <td class="py-4 px-6 font-mono text-xs text-gray-500 dark:text-slate-400">#{{ $item['id'] }}</td>
                        <td class="py-4 px-6 font-medium text-gray-900 dark:text-slate-100">
                            <a href="{{ route('users.show', $item['id']) }}"
                                class="hover:underline text-indigo-600 hover:text-indigo-800 font-semibold">
                                {{ $item['name'] }}
                            </a>
                        </td>
                        <td class="py-3 px-6 text-right space-x-2">
                            <a href="{{ route('users.edit', $item['id']) }}"
                                class="text-indigo-600 hover:underline">Editar</a>
                            <form action="{{ route('users.destroy', $item['id']) }}" method="POST" class="inline"
                                onsubmit="return confirm('¿Borrar?');">
                                @csrf @method('DELETE')
                                <button class="text-rose-600 hover:underline">Eliminar</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="3" class="py-12 text-center text-gray-500 dark:text-slate-400">
                            No hay usuarios registrados.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</x-app-layout>


{{--
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Listado de Usuarios
        </h2>
    </x-slot>

    <div class="bg-white rounded-xl shadow-sm border border-slate-200 overflow-hidden">
        <table class="w-full text-left text-sm">
            <thead class="bg-slate-50 border-b text-xs text-slate-500 uppercase">
                <tr>
                    <th class="py-3 px-6">ID</th>
                    <th class="py-3 px-6">Nombre</th>
                    <th class="py-3 px-6">Rol</th>
                    <th class="py-3 px-6 text-right">Acciones</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-100">

                @forelse ($users as $item)
                <!-- el usuario logueado no se ve a sí mismo en la lista de usuarios -->
                @if ($item['id'] === auth()->user()->id)
                @continue
                @endif

                <tr class="hover:bg-slate-50">

                    <td class="py-3 px-6 font-mono text-xs text-slate-400">
                        #{{ $item['id'] ?? $item->id }}
                    </td>

                    <td class="py-3 px-6 font-medium">
                        <a href="{{ route('users.show', $item['id'] ?? $item->id) }}"
                            class="hover:underline text-indigo-600 hover:text-indigo-800 font-semibold">
                            {{ $item['name'] ?? $item->name }}
                        </a>
                        @if (($item['id'] ?? $item->id) === auth()->user()->id)
                        <span
                            class="ml-2 text-xs bg-slate-100 text-slate-600 px-2 py-0.5 rounded-full border border-slate-200">
                            (Tú)
                        </span>
                        @endif
                    </td>

                    <td class="py-3 px-6">
                        @php
                        $rol = strtolower($item['role'] ?? 'customer');
                        @endphp
                        <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold
                                        @if($rol === 'admin') bg-purple-100 text-purple-700 border border-purple-200
                                        @elseif($rol === 'employee') bg-blue-100 text-blue-700 border border-blue-200
                                        @else bg-slate-100 text-slate-700 border border-slate-200
                                        @endif">
                            {{ ucfirst($rol) }}
                        </span>
                    </td>

                    <td class="py-3 px-6 text-right space-x-2">
                        <a href="{{ route('users.edit', $item['id']) }}"
                            class="text-indigo-600 hover:underline">Editar</a>
                        <form action="{{ route('users.destroy', $item['id']) }}" method="POST" class="inline"
                            onsubmit="return confirm('¿Borrar?');">
                            @csrf @method('DELETE')
                            <button class="text-rose-600 hover:underline">Eliminar</button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="4" class="py-8 text-center text-slate-400">No hay usuarios registrados.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</x-app-layout>
--}}