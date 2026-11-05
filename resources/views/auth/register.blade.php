@extends('layouts.app')
@section('title', 'Registro')
@section('content')
<div class="max-w-md mx-auto bg-slate-800 p-8 rounded-xl border border-slate-700 shadow-xl">
    <h2 class="text-2xl font-bold mb-6 text-amber-400 text-center">Registro de Nuevo Huésped</h2>

    @if ($errors->any())
        <div class="mb-4 bg-rose-500/20 border border-rose-500 text-rose-300 p-3 rounded-lg text-xs">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>• {{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('register.submit') }}" method="POST" class="space-y-4">
        @csrf
        <div>
            <label class="block text-sm font-medium text-slate-300 mb-1">Nombre Completo</label>
            <input type="text" name="name" value="{{ old('name') }}" required class="w-full bg-slate-900 border border-slate-700 rounded-lg px-4 py-2 text-white focus:outline-none focus:border-amber-400">
        </div>
        <div>
            <label class="block text-sm font-medium text-slate-300 mb-1">Correo Electrónico</label>
            <input type="email" name="email" value="{{ old('email') }}" required class="w-full bg-slate-900 border border-slate-700 rounded-lg px-4 py-2 text-white focus:outline-none focus:border-amber-400">
        </div>
        <div>
            <label class="block text-sm font-medium text-slate-300 mb-1">Edad (Indispensable para el Casino)</label>
            <input type="number" name="age" value="{{ old('age') }}" min="1" max="120" required class="w-full bg-slate-900 border border-slate-700 rounded-lg px-4 py-2 text-white focus:outline-none focus:border-amber-400">
        </div>
        <div>
            <label class="block text-sm font-medium text-slate-300 mb-1">Contraseña</label>
            <input type="password" name="password" required class="w-full bg-slate-900 border border-slate-700 rounded-lg px-4 py-2 text-white focus:outline-none focus:border-amber-400">
        </div>
        <button type="submit" class="w-full bg-amber-500 hover:bg-amber-400 text-slate-950 font-bold py-2.5 rounded-lg transition shadow-md">Registrarse (1,000 🪙 Gratis)</button>
    </form>
</div>
@endsection