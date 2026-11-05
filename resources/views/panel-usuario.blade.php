@extends('layouts.app')
@section('title', 'Mi Habitación')
@section('content')
<div class="space-y-6">
    <div class="bg-slate-800 border border-slate-700 p-6 rounded-xl shadow">
        <h2 class="text-2xl font-bold text-white mb-2">Habitación Privada de Huésped</h2>
        <p class="text-slate-300">Bienvenido de nuevo, <span class="text-amber-400 font-semibold">{{ auth()->user()->name }}</span> ({{ auth()->user()->age }} años).</p>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
        <div class="bg-slate-800 border border-slate-700 p-6 rounded-xl flex flex-col justify-between">
            <div>
                <h3 class="text-lg font-bold text-amber-400 mb-1">🎲 Casino Exclusivo</h3>
                <p class="text-sm text-slate-400 mb-4">Sala de juegos con Blackjack y Ruleta (Requiere +18 años).</p>
            </div>
            <a href="{{ route('casino') }}" class="inline-block text-center bg-slate-700 hover:bg-slate-600 text-white font-medium py-2 rounded-lg transition">Entrar al Casino</a>
        </div>

        @if(auth()->user()->is_admin)
        <div class="bg-slate-800 border border-amber-500/50 p-6 rounded-xl flex flex-col justify-between">
            <div>
                <h3 class="text-lg font-bold text-amber-400 mb-1">⚡ Oficina de Dirección</h3>
                <p class="text-sm text-slate-400 mb-4">Área de gestión y control del resort exclusiva para administradores.</p>
            </div>
            <a href="{{ route('admin') }}" class="inline-block text-center bg-amber-500 hover:bg-amber-400 text-slate-950 font-bold py-2 rounded-lg transition">Acceder a Dirección</a>
        </div>
        @endif
    </div>
</div>
@endsection