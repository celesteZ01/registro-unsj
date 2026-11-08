<x-app-layout>
    <div class="max-w-3xl mx-auto py-6">
        <a href="{{ route('animales.index') }}" class="text-sm text-indigo-600 hover:underline">← Volver al listado</a>

        {{-- Tarjeta Principal: Datos del Animal --}}
        <div class="bg-white p-6 rounded-xl shadow-sm border border-slate-200 mt-4">
            <div class="flex justify-between items-center pb-3 border-b border-slate-100">
                <span class="font-mono text-xs text-slate-500">ID: #{{ $animal['id'] ?? '' }}</span>
                <span class="text-xs px-2.5 py-0.5 rounded-full bg-indigo-50 text-indigo-700 font-semibold">
                    Especie: <span class="font-normal">{{ $animal['species'] ?? 'No asignada' }}</span>
                </span>
            </div>

            <div class="py-6">
                <h1 class="text-2xl font-bold text-slate-900">{{ $animal['name'] ?? '' }}</h1>
                <p class="text-sm text-slate-500 mt-1">Edad: {{ $animal['age'] ?? '' }} años</p>
            </div>

            <div class="flex justify-between items-center pt-3 border-t border-slate-100">
                <a href="{{ route('animales.edit', $animal['id'] ?? '') }}"
                    class="text-sm text-indigo-600 font-medium hover:underline">Editar</a>

                <form action="{{ route('animales.destroy', $animal['id'] ?? '') }}" method="POST"
                    onsubmit="return confirm('¿Seguro que deseas eliminar este animal?');">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="text-sm text-rose-600 font-medium hover:underline">Eliminar</button>
                </form>
            </div>
        </div>

        {{-- Sección: Dueños Asociados --}}
        <div class="bg-white p-6 rounded-xl shadow-sm border border-slate-200 mt-6">
            <h2 class="text-lg font-bold text-slate-900 mb-4">Dueños Responsables</h2>

            {{-- Formulario para asignar un dueño --}}
            @role('admin', 'employee')
                <form action="{{ route('animales.owners.store', $animal['id'] ?? '') }}" method="POST" class="flex gap-2 mb-4">
                    @csrf
                    <select name="user_id" required
                        class="flex-1 px-3 py-2 rounded-lg border border-slate-300 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-100 focus:border-indigo-500 bg-white">
                        <option value="">Seleccionar cliente...</option>
                        @foreach ($availableUsers ?? [] as $client)
                            <option value="{{ $client['id'] }}">
                                {{ $client['name'] }} ({{ $client['email'] }})
                            </option>
                        @endforeach
                    </select>
                    <button type="submit"
                        class="px-4 py-2 text-sm text-white bg-indigo-600 hover:bg-indigo-700 rounded-lg font-medium transition shadow-sm">
                        Asignar
                    </button>
                </form>
            @endrole

            {{-- Lista de dueños --}}
            <div class="divide-y divide-slate-100">
                @forelse ($owners ?? [] as $owner)
                    <div class="py-3 flex justify-between items-center">
                        <div>
                            <span class="font-medium text-slate-800 text-sm">{{ $owner['name'] ?? '' }}</span>
                            <span class="text-xs text-slate-400 ml-1">({{ $owner['email'] ?? '' }})</span>
                            @if (!empty($owner['is_primary']))
                                <span class="ml-2 text-xs px-2 py-0.5 rounded-full bg-emerald-50 text-emerald-700 font-semibold border border-emerald-200">
                                    Principal
                                </span>
                            @endif
                        </div>

                        <div class="flex items-center gap-3">
                            @if (empty($owner['is_primary']))
                                <form action="{{ route('animales.owners.primary', ['animal' => $animal['id'] ?? '', 'user' => $owner['id'] ?? '']) }}" method="POST">
                                    @csrf
                                    @method('PATCH')
                                    <button type="submit" class="text-xs text-slate-600 hover:text-indigo-600 underline">
                                        Hacer principal
                                    </button>
                                </form>
                            @endif

                            <form action="{{ route('animales.owners.destroy', ['animal' => $animal['id'] ?? '', 'user' => $owner['id'] ?? '']) }}" method="POST"
                                onsubmit="return confirm('¿Desvincular este dueño?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-xs text-rose-600 hover:underline">Quitar</button>
                            </form>
                        </div>
                    </div>
                @empty
                    <p class="text-sm text-slate-400 py-2">No hay dueños asignados a esta mascota.</p>
                @endforelse
            </div>
        </div>

        {{-- Sección: Historial de Eventos --}}
        <div class="bg-white p-6 rounded-xl shadow-sm border border-slate-200 mt-6">
            <h2 class="text-lg font-bold text-slate-900 mb-4">Historial de Eventos</h2>

            {{-- Formulario para crear evento --}}
            @role('admin', 'employee')
                <form action="{{ route('animales.events.store', $animal['id'] ?? '') }}" method="POST" class="bg-slate-50 p-4 rounded-lg border border-slate-200 mb-4 space-y-3">
                    @csrf
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                        <input type="text" name="title" placeholder="Título (ej: Vacunación antirrábica)" required
                            class="px-3 py-2 rounded-lg border border-slate-300 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-100 focus:border-indigo-500 bg-white">
                        <input type="date" name="date" required value="{{ date('Y-m-d') }}"
                            class="px-3 py-2 rounded-lg border border-slate-300 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-100 focus:border-indigo-500 bg-white">
                    </div>
                    <textarea name="description" rows="2" placeholder="Observaciones clínicas o notas adicionales..."
                        class="w-full px-3 py-2 rounded-lg border border-slate-300 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-100 focus:border-indigo-500 bg-white"></textarea>
                    <div class="flex justify-end">
                        <button type="submit"
                            class="px-4 py-2 text-sm text-white bg-indigo-600 hover:bg-indigo-700 rounded-lg font-medium transition shadow-sm">
                            Registrar Evento
                        </button>
                    </div>
                </form>
            @endrole

            {{-- Lista de eventos --}}
            <div class="divide-y divide-slate-100">
                @forelse ($events ?? [] as $event)
                    <div class="py-3 flex justify-between items-start">
                        <div>
                            <div class="flex items-center gap-2">
                                <span class="font-semibold text-slate-800 text-sm">{{ $event['title'] ?? '' }}</span>
                                <span class="text-xs font-mono text-slate-400">{{ $event['date'] ?? '' }}</span>
                            </div>
                            @if (!empty($event['description']))
                                <p class="text-xs text-slate-600 mt-1">{{ $event['description'] }}</p>
                            @endif
                        </div>

                        <form action="{{ route('animales.events.destroy', ['animal' => $animal['id'] ?? '', 'event' => $event['id'] ?? '']) }}" method="POST"
                            onsubmit="return confirm('¿Eliminar este evento?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-xs text-rose-600 hover:underline">Eliminar</button>
                        </form>
                    </div>
                @empty
                    <p class="text-sm text-slate-400 py-2">No hay eventos registrados para esta mascota.</p>
                @endforelse
            </div>
        </div>
    </div>
</x-app-layout>