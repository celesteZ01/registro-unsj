<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Crear Nuevo Usuario
        </h2>
    </x-slot>

    <div class="max-w-lg mx-auto">
        <a href="{{ route('users.index') }}" class="text-sm text-indigo-600 hover:underline">← Volver</a>

        <form action="{{ route('users.store') }}" method="POST"
            class="bg-white p-6 rounded-xl shadow-sm border border-slate-200 mt-4">
            @csrf
            <div class="space-y-4">
                {{-- Nombre --}}
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

                {{-- Email --}}
                <div>
                    <label for="email" class="block text-sm font-medium text-slate-700 mb-1">Correo Electrónico</label>
                    <input type="email" name="email" id="email" value="{{ old('email') }}" required @class([
                        'w-full px-3.5 py-2 rounded-lg border text-sm focus:outline-none focus:ring-2',
                        'border-rose-300 focus:border-rose-500 focus:ring-rose-200' => $errors->has('email'),
                        'border-slate-300 focus:border-indigo-500 focus:ring-indigo-100' => !$errors->has('email'),
                    ])>
                    @error('email')
                        <p class="text-xs text-rose-600 mt-1 font-medium">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Contraseña --}}
                <div>
                    <label for="password" class="block text-sm font-medium text-slate-700 mb-1">Contraseña</label>
                    <input type="password" name="password" id="password" required @class([
                        'w-full px-3.5 py-2 rounded-lg border text-sm focus:outline-none focus:ring-2',
                        'border-rose-300 focus:border-rose-500 focus:ring-rose-200' => $errors->has('password'),
                        'border-slate-300 focus:border-indigo-500 focus:ring-indigo-100' => !$errors->has('password'),
                    ])>
                    @error('password')
                        <p class="text-xs text-rose-600 mt-1 font-medium">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Rol (lista desplegable) --}}
                <div>
                    <label for="role" class="block text-sm font-medium text-slate-700 mb-1">Rol</label>
                    <select name="role" id="role" required @class([
                        'w-full px-3.5 py-2 rounded-lg border text-sm focus:outline-none focus:ring-2 bg-white',
                        'border-rose-300 focus:border-rose-500 focus:ring-rose-200' => $errors->has('role'),
                        'border-slate-300 focus:border-indigo-500 focus:ring-indigo-100' => !$errors->has('role'),
                    ])>
                        <option value="">Seleccione un rol</option>
                        <option value="customer" {{ old('role') === 'customer' ? 'selected' : '' }}>Customer</option>
                        <option value="employee" {{ old('role') === 'employee' ? 'selected' : '' }}>Employee</option>
                        <option value="admin" {{ old('role') === 'admin' ? 'selected' : '' }}>Admin</option>
                    </select>
                    @error('role')
                        <p class="text-xs text-rose-600 mt-1 font-medium">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Botones de acción --}}
                <div class="pt-4 flex justify-end gap-3 border-t border-slate-100">
                    <a href="{{ route('users.index') }}"
                        class="px-4 py-2 text-sm text-slate-600 hover:text-slate-900 transition">Cancelar</a>
                    <button type="submit"
                        class="px-4 py-2 text-sm text-white bg-indigo-600 hover:bg-indigo-700 rounded-lg font-medium transition">Guardar</button>
                </div>
            </div>
        </form>
    </div>
</x-app-layout>