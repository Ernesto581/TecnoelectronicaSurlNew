@extends('layouts.app')

@section('content')
<div class="min-h-screen flex items-center justify-center p-6 bg-gray-50 pt-28">
    <div class="w-full max-w-md">
        <div class="text-center mb-8">
            <h1 class="text-3xl font-bold text-gray-900">Recuperar contraseña</h1>
            <p class="text-gray-500 mt-2">Te enviaremos un enlace para restablecerla</p>
        </div>

        <div class="bg-white rounded-3xl border border-gray-200 shadow-sm p-8">
            @if(session('status'))
            <div class="mb-4 px-4 py-3 bg-green-50 border border-green-200 text-green-700 rounded-xl text-sm font-medium">{{ session('status') }}</div>
            @endif

            <form method="POST" action="{{ route('password.email') }}" class="space-y-5">
                @csrf

                <div>
                    <label for="email" class="block text-sm font-semibold text-gray-700 mb-2">Correo electrónico</label>
                    <input id="email" type="email" name="email" value="{{ old('email') }}" class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:ring-2 focus:ring-[#46A040] focus:border-transparent outline-none text-sm @error('email') border-red-300 bg-red-50 @enderror" placeholder="tu@email.com" required autofocus />
                    @error('email') <p class="text-red-500 text-xs mt-1.5">{{ $message }}</p> @enderror
                </div>

                <button type="submit" class="w-full py-3 bg-[#46A040] text-white font-semibold rounded-xl hover:bg-[#3d8c38] transition-colors shadow-sm">Enviar enlace</button>
            </form>
        </div>

        <p class="text-sm text-gray-500 text-center mt-6">
            <a href="{{ route('login') }}" class="text-[#46A040] font-semibold hover:underline">Volver al inicio de sesión</a>
        </p>
    </div>
</div>
@endsection
