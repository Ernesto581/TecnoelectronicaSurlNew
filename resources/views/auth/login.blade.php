@extends('layouts.app')

@section('content')
<div class="min-h-screen flex items-center justify-center p-6 bg-gray-50 pt-28">
    <div class="w-full max-w-md">
        <div class="text-center mb-8">
            <h1 class="text-3xl font-bold text-gray-900">Iniciar sesión</h1>
            <p class="text-gray-500 mt-2">Accede a tu cuenta</p>
        </div>

        <div class="bg-white rounded-3xl border border-gray-200 shadow-sm p-8">
            @if(session('status'))
            <div class="mb-4 px-4 py-3 bg-green-50 border border-green-200 text-green-700 rounded-xl text-sm font-medium">{{ session('status') }}</div>
            @endif

            <form method="POST" action="{{ route('login') }}" class="space-y-5">
                @csrf

                <div>
                    <label for="email" class="block text-sm font-semibold text-gray-700 mb-2">Correo electrónico</label>
                    <input id="email" type="email" name="email" value="{{ old('email') }}" class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:ring-2 focus:ring-[#46A040] focus:border-transparent outline-none text-sm @error('email') border-red-300 bg-red-50 @enderror" placeholder="tu@email.com" required autofocus autocomplete="username" />
                    @error('email') <p class="text-red-500 text-xs mt-1.5">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label for="password" class="block text-sm font-semibold text-gray-700 mb-2">Contraseña</label>
                    <input id="password" type="password" name="password" class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:ring-2 focus:ring-[#46A040] focus:border-transparent outline-none text-sm @error('password') border-red-300 bg-red-50 @enderror" placeholder="••••••••" required autocomplete="current-password" />
                    @error('password') <p class="text-red-500 text-xs mt-1.5">{{ $message }}</p> @enderror
                </div>

                <div class="flex items-center justify-between">
                    <label for="remember_me" class="inline-flex items-center cursor-pointer">
                        <input id="remember_me" type="checkbox" class="rounded border-gray-300 text-[#46A040] shadow-sm focus:ring-[#46A040]" name="remember">
                        <span class="ms-2 text-sm text-gray-600">Recordarme</span>
                    </label>

                    @if (Route::has('password.request'))
                    <a class="text-sm text-[#46A040] font-medium hover:underline" href="{{ route('password.request') }}">¿Olvidaste tu contraseña?</a>
                    @endif
                </div>

                <button type="submit" class="w-full py-3 bg-[#46A040] text-white font-semibold rounded-xl hover:bg-[#3d8c38] transition-colors shadow-sm">Entrar</button>
            </form>
        </div>

        <p class="text-sm text-gray-500 text-center mt-6">
            ¿No tienes cuenta? <a href="{{ route('register') }}" class="text-[#46A040] font-semibold hover:underline">Regístrate</a>
        </p>
    </div>
</div>
@endsection
