<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Registrar Nuevo Animal
        </h2>
    </x-slot>

    <div class="max-w-lg mx-auto">
        <a href="{{ route('animales.index') }}" class="text-sm text-indigo-600 hover:underline">← Volver</a>
        

        <form action="{{ route('animales.store') }}" method="POST"
            class="bg-white p-6 rounded-xl shadow-sm border border-slate-200">
            @csrf
            <div class="space-y-4">
                <div>
                    <label for="name" class="block text-sm font-medium text-slate-700 mb-1">Nombre</label>
                    <input type="text" name="name" id="name" value="{{ old('name') }}" required @class([
                        'w-full px-3.5 py-2 rounded-lg border text-sm focus:outline-none focus:ring-2',
                        'border-rose-300 focus:border-rose-500 focus:ring-rose-200' => $errors->has('name'),
                        'border-slate-300 focus:border-indigo-500 focus:ring-indigo-100' => !$errors->has('name'),
                    ])>
                    @error('name')
                        <p class="text-xs text-rose-600 mt-1 font-medium">{{ $message }}</p>
                    @enderror
                </div>

                <div> <!-- lista desplegable -->
                    <label for="species_id" class="block text-sm font-medium text-slate-700 mb-1">Especie</label>
                    <select name="species_id" id="species_id" @class([
                        'w-full px-3.5 py-2 rounded-lg border text-sm focus:outline-none focus:ring-2 bg-white',
                        'border-rose-300 focus:border-rose-500 focus:ring-rose-200' => $errors->has('species_id'),
                        'border-slate-300 focus:border-indigo-500 focus:ring-indigo-100' => !$errors->has('species_id'),
                    ])>
        <option value="">Seleccione una especie</option>
                        @foreach ($species as $specie)
                            <option value="{{ $specie['id'] ?? $specie->id }}" {{ old('species_id') == ($specie['id'] ?? $specie->id) ? 'selected' : '' }}>
                                {{ $specie['name'] ?? $specie->name }}
                            </option>
                        @endforeach
                    </select>
                    @error('species_id')
                        <p class="text-xs text-rose-600 mt-1 font-medium">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="age" class="block text-sm font-medium text-slate-700 mb-1">Edad (años)</label>
                    <input type="number" name="age" id="age" value="{{ old('age') }}" min="0" required @class([
                        'w-full px-3.5 py-2 rounded-lg border text-sm focus:outline-none focus:ring-2',
                        'border-rose-300 focus:border-rose-500 focus:ring-rose-200' => $errors->has('age'),
                        'border-slate-300 focus:border-indigo-500 focus:ring-indigo-100' => !$errors->has('age'),
                    ])>
                    @error('age')
                        <p class="text-xs text-rose-600 mt-1 font-medium">{{ $message }}</p>
                    @enderror
                </div>

                <div class="pt-4 flex justify-end gap-3 border-t">
                    <a href="{{ route('animales.index') }}"
                        class="px-4 py-2 text-sm text-slate-600 hover:text-slate-900 transition">Cancelar</a>
                    <button type="submit"
                        class="px-4 py-2 text-sm text-white bg-indigo-600 hover:bg-indigo-700 rounded-lg font-medium transition">Guardar</button>
                </div>
            </div>
        </form>
    </div>
</x-app-layout>