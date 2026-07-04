@extends('layouts.app')

@section('content')
<div class="min-h-screen flex items-center justify-center p-6 bg-gray-50 pt-28">
    <div class="w-full max-w-lg">
        <h1 class="text-2xl font-bold mb-6 text-center">Crear cuenta</h1>
        <form class="max-w-sm mx-auto space-y-4" method="POST" action="/registro">
            @csrf
            <input type="text" name="name" placeholder="nombre completo" class="w-full px-4 py-2 rounded border" required />
            <input type="email" name="email" placeholder="correo electrónico" class="w-full px-4 py-2 rounded border" required />
            <input type="password" name="password" placeholder="contraseña" class="w-full px-4 py-2 rounded border" required minlength="6" />
            <input type="password" name="password_confirmation" placeholder="confirmar contraseña" class="w-full px-4 py-2 rounded border" required minlength="6" />
            <button type="submit" class="w-full py-2 bg-[#46A040] text-white rounded">Crear cuenta</button>
        </form>
        <p class="text-sm text-gray-500 text-center mt-6">
            ¿Ya tienes cuenta? <a href="/login" class="text-[#46A040] font-semibold hover:underline">Inicia sesión</a>
        </p>
    </div>
</div>
@endsection
