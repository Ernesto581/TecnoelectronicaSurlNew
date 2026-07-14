@extends('layouts.app')

@section('content')
<div class="min-h-screen flex items-center justify-center p-6 bg-gray-50 pt-28">
    <div class="w-full max-w-lg">
        <h1 class="text-2xl font-bold mb-6 text-center">Crear cuenta</h1>
        <form class="max-w-sm mx-auto space-y-4" method="POST" action="/registro">
            @csrf
            <div>
                <input type="text" name="name" placeholder="nombre completo" value="{{ old('name') }}" class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:ring-2 focus:ring-[#46A040] focus:border-transparent outline-none text-sm @error('name') border-red-300 bg-red-50 @enderror" required />
                @error('name') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
            </div>
            <div>
                <input type="email" name="email" placeholder="correo electrónico" value="{{ old('email') }}" class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:ring-2 focus:ring-[#46A040] focus:border-transparent outline-none text-sm @error('email') border-red-300 bg-red-50 @enderror" required />
                @error('email') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
            </div>
            <div>
                <input type="password" name="password" placeholder="contraseña (mín. 6 caracteres)" class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:ring-2 focus:ring-[#46A040] focus:border-transparent outline-none text-sm @error('password') border-red-300 bg-red-50 @enderror" required minlength="6" />
                @error('password') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
            </div>
            <div>
                <input type="password" name="password_confirmation" placeholder="confirmar contraseña" class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:ring-2 focus:ring-[#46A040] focus:border-transparent outline-none text-sm" required minlength="6" />
            </div>
            <button type="submit" class="w-full py-3 bg-[#46A040] text-white font-semibold rounded-xl hover:bg-[#3d8c38] transition-colors">Crear cuenta</button>
        </form>
        <p class="text-sm text-gray-500 text-center mt-6">
            ¿Ya tienes cuenta? <a href="/login" class="text-[#46A040] font-semibold hover:underline">Inicia sesión</a>
        </p>
    </div>
</div>
@endsection