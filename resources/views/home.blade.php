@extends('layouts.app')
@section('title', 'Bienvenido')
@section('content')
<div class="text-center py-16 space-y-6">
    <h1 class="text-4xl font-extrabold tracking-tight text-white">Bienvenido al <span class="text-amber-400">Grand Royal Resort</span></h1>
    <p class="text-slate-400 max-w-lg mx-auto">Disfruta de nuestras exclusivas instalaciones públicas, habitaciones privadas, zona de casino para adultos y áreas de dirección.</p>
    
    @guest
        <div class="pt-4 flex justify-center gap-4">
            <a href="{{ route('login') }}" class="bg-amber-500 hover:bg-amber-400 text-slate-950 font-bold px-6 py-3 rounded-lg shadow-lg transition">Iniciar Sesión</a>
            <a href="{{ route('register') }}" class="bg-slate-700 hover:bg-slate-600 text-white font-bold px-6 py-3 rounded-lg shadow-lg transition">Registrarse</a>
        </div>
    @endguest
</div>
@endsection