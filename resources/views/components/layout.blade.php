<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'Gestión de Especies' }}</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-slate-50 text-slate-800 min-h-screen flex flex-col">
    <header class="bg-white border-b border-slate-200 shadow-sm sticky top-0 z-10">
        <div class="max-w-5xl mx-auto px-4 sm:px-6 flex justify-between items-center h-16">
            <span class="text-xl font-bold text-indigo-600"> Animals & Species</span>
            <nav class="flex gap-4 text-sm font-medium">
                <a href="{{ route('animales.index') }}"
                    class="transition hover:text-indigo-600 {{ request()->routeIs('animales.*') ? 'text-indigo-600 font-semibold' : 'text-slate-500' }}">
                    Animales
                </a>
                <!-- lo hice en un solo nav para que queden los dos pa la derecha por el justify-between -->
                <a href="{{ route('species.index') }}"
                    class="transition hover:text-indigo-600 {{ request()->routeIs('species.*') ? 'text-indigo-600 font-semibold' : 'text-slate-500' }}">
                    Especies
                </a>
            </nav>

        </div>
    </header>

    <main class="max-w-5xl mx-auto px-4 sm:px-6 py-8 w-full flex-1">
        {{-- Directiva moderna @session en lugar de @if(session('success')) --}}
        @session('success')
            <div class="mb-6 p-4 rounded-xl bg-emerald-50 border border-emerald-200 text-emerald-700 flex items-center
                    justify-between text-sm shadow-sm">
                <div class="flex items-center gap-2">
                    <svg class="w-5 h-5 text-emerald-500 shrink-0" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0
                    00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                            clip-rule="evenodd" />
                    </svg>
                    <span>{{ $value }}</span>
                </div>
            </div>
        @endsession

        <!-- pa los errores -->
        @if ($errors->any())
            <div
                class="mb-6 p-4 rounded-xl bg-rose-500/10 border border-rose-500/30 text-rose-300 flex items-center justify-between">
                <div class="flex items-center gap-2">
                    <svg class="w-5 h-5 text-rose-400 shrink-0" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd"
                            d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z"
                            clip-rule="evenodd" />
                    </svg>
                    <span>Datos no compatibles.</span>
                    {{-- esto indica cada error pero eso ya lo tengo en los campos, sería repetirlo innecesariamente
                        @foreach ($errors -> all() as $error )
                            <p>{{ $erro<r }}</p>                    
                        @endforeach --}}
                </div>
            </div>
        @endif

        @isset($title)
            <h1 class="text-2xl font-bold text-slate-800 mb-6">{{ $title }}</h1>
        @endisset

        {{ $slot }}
    </main>
    <footer class="py-4 text-center text-xs text-slate-400 bg-white border-t">
        Desarrollo Backend I • Laravel & Blade Components • 2026
    </footer>
</body>

</html>