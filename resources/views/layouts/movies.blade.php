<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="dark">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Movies Manager</title>

    <!-- Fuente Inter -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">

    <!-- Tailwind CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            darkMode: 'class',
            theme: {
                extend: {
                    fontFamily: {
                        sans: ['Inter', 'sans-serif'],
                    }
                }
            }
        }
    </script>
</head>
<body class="bg-slate-900 text-slate-100 font-sans min-h-screen antialiased flex flex-col justify-center items-center p-4 sm:p-6">

    <!-- Título principal -->
    <header class="w-full max-w-2xl mb-6 text-center">
        <h1 class="text-2xl font-bold tracking-tight text-white">
            Movies Manager
        </h1>
    </header>

    <!-- Contenedor del Wireframe -->
    <main class="w-full max-w-2xl bg-slate-800/80 border border-slate-700/70 rounded-2xl shadow-2xl backdrop-blur-sm p-6 sm:p-8">
        
        <!-- Mensaje de éxito -->
        @if (session('success'))
            <div class="mb-6 p-3 bg-emerald-500/20 border border-emerald-500/40 text-emerald-300 text-sm rounded-lg text-center">
                {{ session('success') }}
            </div>
        @endif

        <!-- Errores de validación -->
        @if ($errors->any())
            <div class="mb-6 p-3 bg-rose-500/20 border border-rose-500/40 text-rose-300 text-sm rounded-lg">
                <ul class="list-disc list-inside space-y-1">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <!-- Formulario (Agregar o Editar según si existe $editing) -->
        <form 
            action="{{ isset($editing) ? route('movies.update', $editing['id']) : route('movies.store') }}" 
            method="POST" 
            class="space-y-4 mb-8"
        >
            @csrf
            @if (isset($editing))
                @method('PUT')
            @endif

            <!-- Fila Title -->
            <div class="flex items-center gap-4">
                <label for="título" class="w-20 text-sm font-medium text-slate-300 text-right">Title:</label>
                <input 
                    type="text" 
                    id="título" 
                    name="título" 
                    value="{{ old('título', $editing['título'] ?? '') }}"
                    placeholder="Título de la película"
                    class="flex-1 bg-slate-900/90 border border-slate-700 rounded-lg px-3.5 py-2 text-sm text-slate-100 placeholder-slate-500 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition"
                >
            </div>

            <!-- Fila Género -->
            <div class="flex items-center gap-4">
                <label for="género" class="w-20 text-sm font-medium text-slate-300 text-right">Género:</label>
                <input 
                    type="text" 
                    id="género" 
                    name="género" 
                    value="{{ old('género', $editing['género'] ?? '') }}"
                    placeholder="Género cinematográfico"
                    class="flex-1 bg-slate-900/90 border border-slate-700 rounded-lg px-3.5 py-2 text-sm text-slate-100 placeholder-slate-500 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition"
                >
            </div>

            <!-- Fila Year + Botones -->
            <div class="flex items-center gap-4">
                <label for="año" class="w-20 text-sm font-medium text-slate-300 text-right">Year:</label>
                <input 
                    type="number" 
                    id="año" 
                    name="año" 
                    value="{{ old('año', $editing['año'] ?? '') }}"
                    placeholder="Año" 
                    min="1888" 
                    max="{{ date('Y') }}"
                    class="w-28 bg-slate-900/90 border border-slate-700 rounded-lg px-3.5 py-2 text-sm text-slate-100 placeholder-slate-500 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition"
                >

                <div class="flex-1 flex justify-end items-center gap-3 pl-4">
                    @if (isset($editing))
                        <a 
                            href="{{ route('movies.index') }}" 
                            class="translate-y-1 px-4 py-2 bg-slate-700 hover:bg-slate-600 text-slate-300 text-sm font-medium rounded-lg transition"
                        >
                            Cancelar
                        </a>
                        <button 
                            type="submit" 
                            class="translate-y-1 px-6 py-2 bg-emerald-600 hover:bg-emerald-500 active:bg-emerald-700 text-white text-sm font-semibold rounded-lg shadow transition focus:outline-none focus:ring-2 focus:ring-emerald-400 focus:ring-offset-2 focus:ring-offset-slate-800"
                        >
                            Guardar
                        </button>
                    @else
                        <button 
                            type="submit" 
                            class="translate-y-1 px-6 py-2 bg-indigo-600 hover:bg-indigo-500 active:bg-indigo-700 text-white text-sm font-semibold rounded-lg shadow transition focus:outline-none focus:ring-2 focus:ring-indigo-400 focus:ring-offset-2 focus:ring-offset-slate-800"
                        >
                            Agregar
                        </button>
                    @endif
                </div>
            </div>
        </form>

        <!-- Tabla con iteración y acciones -->
        <div class="border-t border-slate-700/80 pt-6">
            <div class="overflow-x-auto rounded-xl border border-slate-700">
                <table class="w-full text-left text-sm text-slate-300">
                    <thead class="bg-slate-900/80 text-xs uppercase tracking-wider text-slate-400 font-semibold border-b border-slate-700">
                        <tr>
                            <th class="px-4 py-3">Title</th>
                            <th class="px-4 py-3">Género</th>
                            <th class="px-4 py-3 text-center">Year</th>
                            <th class="px-3 py-3 text-center w-16"></th>
                            <th class="px-3 py-3 text-center w-16"></th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-700/60 bg-slate-800/40">
                        @forelse ($movies as $movie)
                            <tr class="hover:bg-slate-700/30 transition">
                                <td class="px-4 py-3 font-medium text-white">
                                    {{ $movie['título'] }}
                                </td>
                                <td class="px-4 py-3 text-slate-300">
                                    {{ $movie['género'] }}
                                </td>
                                <td class="px-4 py-3 text-center font-mono text-slate-400">
                                    {{ $movie['año'] }}
                                </td>
                                <td class="px-3 py-3 text-center">
                                    <a 
                                        href="{{ route('movies.edit', $movie['id']) }}" 
                                        class="inline-block text-xs font-semibold text-amber-400 hover:text-amber-300 bg-amber-400/10 hover:bg-amber-400/20 px-2.5 py-1 rounded transition border border-amber-400/20"
                                    >
                                        Edit
                                    </a>
                                </td>
                                <td class="px-3 py-3 text-center">
                                    <form action="{{ route('movies.destroy', $movie['id']) }}" method="POST" onsubmit="return confirm('¿Eliminar esta película?');">
                                        @csrf
                                        @method('DELETE')
                                        <button 
                                            type="submit" 
                                            class="inline-block text-xs font-semibold text-rose-400 hover:text-rose-300 bg-rose-400/10 hover:bg-rose-400/20 px-2.5 py-1 rounded transition border border-rose-400/20"
                                        >
                                            Delete
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="px-4 py-8 text-center text-slate-500">
                                    No hay películas registradas.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

    </main>

    <footer class="mt-8 text-xs text-slate-500 text-center">
        &copy; {{ date('Y') }} Movies Manager &bull; Cátedra Backend
    </footer>

</body>
</html>