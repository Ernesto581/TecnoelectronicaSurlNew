@extends('layouts.app')

@section('content')
<div class="min-h-screen flex items-center justify-center p-6 bg-gray-50 pt-28">
    <div class="w-full max-w-md">
        <div class="text-center mb-8">
            <h1 class="text-3xl font-bold text-gray-900">Confirmar contraseña</h1>
            <p class="text-gray-500 mt-2">Esta es un área segura. Confirma tu contraseña para continuar.</p>
        </div>

        <div class="bg-white rounded-3xl border border-gray-200 shadow-sm p-8">
            <form method="POST" action="{{ route('password.confirm') }}" class="space-y-5">
                @csrf

                <div>
                    <label for="password" class="block text-sm font-semibold text-gray-700 mb-2">Contraseña</label>
                    <input id="password" type="password" name="password" class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:ring-2 focus:ring-[#46A040] focus:border-transparent outline-none text-sm @error('password') border-red-300 bg-red-50 @enderror" placeholder="••••••••" required autocomplete="current-password" />
                    @error('password') <p class="text-red-500 text-xs mt-1.5">{{ $message }}</p> @enderror
                </div>

                <button type="submit" class="w-full py-3 bg-[#46A040] text-white font-semibold rounded-xl hover:bg-[#3d8c38] transition-colors shadow-sm">Confirmar</button>
            </form>
        </div>
    </div>
</div>
@endsection
