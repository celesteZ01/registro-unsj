<x-app-layout>
    

    <div class="max-w-md mx-auto">
        <a href="{{ route('animales.index') }}" class="text-sm text-indigo-600 hover:underline">← Volver</a>

        <div class="bg-white p-6 rounded-xl shadow-sm border border-slate-200 mt-4">
            <div class="flex justify-between items-center pb-3 border-b border-slate-100">
                <span class="font-mono text-xs text-slate-500">ID: #{{ $animal['id'] ?? $animal->id ?? $id }}</span>
                <span class="text-xs px-2.5 py-0.5 rounded-full bg-indigo-50 text-indigo-700 font-semibold">
                    Especie: <span class="font-normal">{{ $animal['species'] ?? $animal->species }}</span>
                </span>
            </div>

            <div class="py-6">
                <h1 class="text-2xl font-bold text-slate-900">{{ $animal['name'] ?? $animal->name }}</h1>
                <p class="text-sm text-slate-400 mt-1">Edad: {{ $animal['age'] ?? $animal->age }} años</p>
            </div>

            <div class="flex justify-between items-center pt-3 border-t border-slate-100">
                <a href="{{ route('animales.edit', $animal['id'] ?? $animal->id ?? $id) }}"
                    class="text-sm text-indigo-600 font-medium hover:underline">Editar</a>

                <form action="{{ route('animales.destroy', $animal['id'] ?? $animal->id ?? $id) }}" method="POST"
                    onsubmit="return confirm('¿Seguro que deseas eliminar este animal?');">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="text-sm text-rose-600 font-medium hover:underline">Eliminar</button>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>