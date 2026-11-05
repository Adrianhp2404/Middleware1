@extends('layouts.app')
@section('title', 'Iniciar Sesión')
@section('content')
<div class="max-w-md mx-auto bg-slate-800 p-8 rounded-xl border border-slate-700 shadow-xl">
    <h2 class="text-2xl font-bold mb-6 text-amber-400 text-center">Acceso al Resort</h2>

    @if ($errors->any())
        <div class="mb-4 bg-rose-500/20 border border-rose-500 text-rose-300 p-3 rounded-lg text-xs">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>• {{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="mb-6 bg-slate-900 p-4 rounded-lg text-xs text-slate-300 space-y-1 border border-slate-700">
        <p class="font-semibold text-amber-300">💡 Credenciales de prueba rápidas:</p>
        <p>👑 <b>Admin:</b> admin@resort.com / password123</p>
        <p>🧑 <b>Adulto:</b> adulto@resort.com / password123</p>
        <p>👶 <b>Menor:</b> menor@resort.com / password123</p>
    </div>

    <form action="{{ route('login.submit') }}" method="POST" class="space-y-4">
        @csrf
        <div>
            <label class="block text-sm font-medium text-slate-300 mb-1">Correo Electrónico</label>
            <input type="email" name="email" value="{{ old('email') }}" required class="w-full bg-slate-900 border border-slate-700 rounded-lg px-4 py-2 text-white focus:outline-none focus:border-amber-400">
        </div>
        <div>
            <label class="block text-sm font-medium text-slate-300 mb-1">Contraseña</label>
            <input type="password" name="password" required class="w-full bg-slate-900 border border-slate-700 rounded-lg px-4 py-2 text-white focus:outline-none focus:border-amber-400">
        </div>
        <button type="submit" class="w-full bg-amber-500 hover:bg-amber-400 text-slate-950 font-bold py-2.5 rounded-lg transition shadow-md">Entrar</button>
    </form>
</div>
@endsection