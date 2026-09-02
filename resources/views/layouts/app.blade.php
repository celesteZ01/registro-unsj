<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MovieApp</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="min-h-screen bg-gray-100 text-gray-900 flex flex-col">
    <nav class="bg-indigo-600 text-white shadow-md">
        <div class="max-w-6xl mx-auto w-full px-4 py-4">
            <a href="/" class="text-2xl font-bold tracking-wide">MovieApp</a>
        </div>
    </nav>

    <main class="flex-grow max-w-6xl mx-auto w-full px-4 py-8">
        @yield('content')
    </main>

    <footer class="border-t border-gray-200 bg-white py-4 text-center text-sm text-gray-500">
        &copy; {{ date('Y') }} MovieApp
    </footer>
</body>
</html>