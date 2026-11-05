<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Grand Royal Resort - @yield('title')</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>
<body class="bg-slate-900 text-slate-100 font-sans min-h-screen flex flex-col justify-between">

    <!-- Navbar -->
    <nav class="bg-slate-800 border-b border-slate-700 px-6 py-4 flex justify-between items-center shadow-md">
        <a href="{{ route('home') }}" class="text-xl font-bold tracking-wider text-amber-400">🌴 Grand Royal Resort</a>
        <div class="space-x-3 flex items-center">
            @auth
                <div class="bg-slate-900 border border-amber-500/40 px-3 py-1.5 rounded-lg text-sm flex items-center gap-2">
                    <span class="text-amber-400">💰 Fichas:</span>
                    <span id="user-balance" class="font-bold text-white">{{ auth()->user()->balance }}</span>
                </div>
                <a href="{{ route('panel') }}" class="text-sm bg-slate-700 hover:bg-slate-600 px-3 py-2 rounded transition">Mi Habitación</a>
                <form action="{{ route('logout') }}" method="POST" class="inline">
                    @csrf
                    <button type="submit" class="text-sm bg-rose-600 hover:bg-rose-500 px-3 py-2 rounded transition">Salir</button>
                </form>
            @else
                <a href="{{ route('login') }}" class="text-sm text-slate-300 hover:text-white px-3 py-2 transition">Iniciar Sesión</a>
                <a href="{{ route('register') }}" class="text-sm bg-amber-500 hover:bg-amber-400 text-slate-950 font-semibold px-4 py-2 rounded transition">Registrarse</a>
            @endauth
        </div>
    </nav>

    <!-- Contenido -->
    <main class="max-w-4xl mx-auto p-6 w-full flex-grow">
        @if(session('error'))
            <div class="mb-6 bg-rose-500/20 border border-rose-500 text-rose-300 px-4 py-3 rounded-lg shadow">{{ session('error') }}</div>
        @endif
        @if(session('success'))
            <div class="mb-6 bg-emerald-500/20 border border-emerald-500 text-emerald-300 px-4 py-3 rounded-lg shadow">{{ session('success') }}</div>
        @endif
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="bg-slate-800 border-t border-slate-700 text-center py-4 text-xs text-slate-400">
        &copy; 2026 Grand Royal Resort. Todos los derechos reservados.
    </footer>
</body>
</html>