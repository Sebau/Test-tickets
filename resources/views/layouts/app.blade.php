<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Sistema de Tickets</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100">

    <div class="min-h-screen">
        {{-- Navbar opcional --}}
        @include('layouts.navigation')

        {{-- Contenido --}}
        <main class="p-6">
            @yield('content')
        </main>
    </div>

    @yield('scripts')
</body>
</html>
