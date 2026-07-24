@extends('layouts.app')

@section('content')
<div class="min-h-screen flex items-center justify-center p-6 bg-gray-50 pt-28">
    <div class="w-full max-w-md">
        <div class="text-center mb-8">
            <h1 class="text-3xl font-bold text-gray-900">Crear cuenta</h1>
            <p class="text-gray-500 mt-2">Únete a Tecnoelectronica SURL</p>
        </div>

        <div class="bg-white rounded-3xl border border-gray-200 shadow-sm p-8">
            <form method="POST" action="{{ route('register') }}" class="space-y-5">
                @csrf

                <div>
                    <label for="name" class="block text-sm font-semibold text-gray-700 mb-2">Nombre completo</label>
                    <input id="name" type="text" name="name" value="{{ old('name') }}" class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:ring-2 focus:ring-[#46A040] focus:border-transparent outline-none text-sm @error('name') border-red-300 bg-red-50 @enderror" placeholder="Tu nombre" required autofocus autocomplete="name" />
                    @error('name') <p class="text-red-500 text-xs mt-1.5">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label for="email" class="block text-sm font-semibold text-gray-700 mb-2">Correo electrónico</label>
                    <input id="email" type="email" name="email" value="{{ old('email') }}" class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:ring-2 focus:ring-[#46A040] focus:border-transparent outline-none text-sm @error('email') border-red-300 bg-red-50 @enderror" placeholder="tu@email.com" required autocomplete="username" />
                    @error('email') <p class="text-red-500 text-xs mt-1.5">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label for="password" class="block text-sm font-semibold text-gray-700 mb-2">Contraseña</label>
                    <input id="password" type="password" name="password" class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:ring-2 focus:ring-[#46A040] focus:border-transparent outline-none text-sm @error('password') border-red-300 bg-red-50 @enderror" placeholder="Mínimo 8 caracteres" required autocomplete="new-password" />
                    @error('password') <p class="text-red-500 text-xs mt-1.5">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label for="password_confirmation" class="block text-sm font-semibold text-gray-700 mb-2">Confirmar contraseña</label>
                    <input id="password_confirmation" type="password" name="password_confirmation" class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:ring-2 focus:ring-[#46A040] focus:border-transparent outline-none text-sm" placeholder="Repite la contraseña" required autocomplete="new-password" />
                    @error('password_confirmation') <p class="text-red-500 text-xs mt-1.5">{{ $message }}</p> @enderror
                </div>

                <button type="submit" class="w-full py-3 bg-[#46A040] text-white font-semibold rounded-xl hover:bg-[#3d8c38] transition-colors shadow-sm">Crear cuenta</button>
            </form>
        </div>

        <p class="text-sm text-gray-500 text-center mt-6">
            ¿Ya tienes cuenta? <a href="{{ route('login') }}" class="text-[#46A040] font-semibold hover:underline">Inicia sesión</a>
        </p>
    </div>
</div>
@endsection
