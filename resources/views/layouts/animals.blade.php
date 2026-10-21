<!DOCTYPE html>
<html lang="es" class="dark">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="theme-color" content="#0f172a">
    <title>@yield('title', 'Gestión de Animales') | Animals</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @stack('head')
</head>
<body class="min-h-screen bg-slate-100 font-sans text-slate-900 antialiased dark:bg-slate-900 dark:text-slate-100 flex flex-col justify-between">
    <header class="border-b border-slate-200 bg-white/95 shadow-sm backdrop-blur dark:border-slate-800 dark:bg-slate-950/95">
        <nav class="mx-auto flex max-w-7xl items-center justify-between px-4 py-4 sm:px-6 lg:px-8" aria-label="Navegación principal">
            <a href="{{ route('animales.index') }}" class="text-xl font-bold tracking-tight text-indigo-600 transition hover:text-indigo-500 dark:text-indigo-400 dark:hover:text-indigo-300">
                CRUD Animales
            </a>
            <div class="flex items-center gap-6 text-sm font-medium">
                <a href="{{ route('animales.index') }}" class="text-slate-600 transition hover:text-indigo-600 dark:text-slate-300 dark:hover:text-indigo-400">
                    Animales
                </a>
            </div>
        </nav>
    </header>

    <main class="mx-auto w-full max-w-7xl flex-grow px-4 py-8 sm:px-6 lg:px-8">
        @if(session('success'))
            <div class="mb-4 rounded-md bg-green-500/15 p-4 text-sm text-green-700 dark:text-green-300 border border-green-500/20">
                {{ session('success') }}
            </div>
        @endif
        @if(session('error'))
            <div class="mb-4 rounded-md bg-red-500/15 p-4 text-sm text-red-700 dark:text-red-300 border border-red-500/20">
                {{ session('error') }}
            </div>
        @endif

        @yield('content') 
    </main>

    <footer class="border-t border-slate-200 bg-white py-6 text-center text-sm text-slate-500 dark:border-slate-800 dark:bg-slate-950 dark:text-slate-400">
        &copy; {{ date('Y') }} - Sistema de Gestión de Animales
    </footer>

    @stack('scripts')
</body>
</html>