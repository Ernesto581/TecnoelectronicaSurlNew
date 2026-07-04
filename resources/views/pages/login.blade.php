@extends('layouts.app')

@section('content')
<div class="min-h-screen flex items-center justify-center p-6 bg-gray-50 pt-28">
    <div class="w-full max-w-lg">
        <h1 class="text-2xl font-bold mb-6 text-center">Iniciar sesión</h1>
        <form class="max-w-sm mx-auto space-y-4" method="POST" action="/login">
            @csrf
            <input type="email" name="email" placeholder="email" class="w-full px-4 py-2 rounded border" required />
            <input type="password" name="password" placeholder="contraseña" class="w-full px-4 py-2 rounded border" required />
            <button type="submit" class="w-full py-2 bg-[#46A040] text-white rounded">Entrar</button>
        </form>
        <p class="text-sm text-gray-500 text-center mt-6">
            ¿No tienes cuenta? <a href="/registro" class="text-[#46A040] font-semibold hover:underline">Regístrate</a>
        </p>
    </div>
</div>
@endsection
