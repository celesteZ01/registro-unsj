<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Detalles del Usuario
        </h2>
    </x-slot>

    <div class="max-w-2xl mx-auto">
        <a href="{{ route('users.index') }}" class="text-sm text-indigo-600 hover:underline">← Volver al listado</a>

        <div class="bg-white p-6 rounded-xl shadow-sm border border-slate-200 mt-4">
            
            <div class="flex justify-between items-center pb-3 border-b border-slate-100">
                <span class="font-mono text-xs text-slate-500">ID: #{{ $user['id'] ?? $user->id }}</span>
                @php
                    $rol = strtolower($user['role'] ?? $user->role ?? 'customer');
                @endphp
                <span class="text-xs px-2.5 py-0.5 rounded-full font-semibold
                    @if($rol === 'admin') bg-purple-50 text-purple-700 border border-purple-200
                    @elseif($rol === 'employee') bg-blue-50 text-blue-700 border border-blue-200
                    @else bg-slate-100 text-slate-700 border border-slate-200
                    @endif">
                    {{ ucfirst($rol) }}
                </span>
            </div>

            
            <div class="py-6">
                <h1 class="text-2xl font-bold text-slate-900">{{ $user['name'] ?? $user->name }}</h1>
                <p class="text-sm text-slate-500 mt-1 flex items-center gap-1.5">
                    <span class="font-medium text-slate-700">Email:</span> {{ $user['email'] ?? $user->email }}
                </p>
            </div>

            
            <div class="flex justify-between items-center pt-3 border-t border-slate-100">
                <a href="{{ route('users.edit', $user['id'] ?? $user->id) }}"
                    class="text-sm text-indigo-600 font-medium hover:underline">
                    Editar
                </a>

                @if (($user['id'] ?? $user->id) !== auth()->user()->id)
                    <form action="{{ route('users.destroy', $user['id'] ?? $user->id) }}" method="POST"
                        onsubmit="return confirm('¿Eliminar usuario?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="text-sm text-rose-600 font-medium hover:underline">
                            Eliminar
                        </button>
                    </form>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>