@extends('layouts.app')
@section('title', 'Dirección')
@section('content')
<div class="bg-slate-800 border border-amber-500 p-8 rounded-xl shadow-lg text-center space-y-4">
    <span class="text-4xl">📊</span>
    <h2 class="text-3xl font-bold text-white">Oficina de Dirección General</h2>
    <p class="text-amber-400 font-medium">Panel de control con privilegios de administrador concedidos.</p>
    <div class="pt-4">
        <a href="{{ route('panel') }}" class="bg-slate-700 hover:bg-slate-600 px-6 py-2.5 rounded-lg text-sm transition">Volver a mi habitación</a>
    </div>
</div>
@endsection