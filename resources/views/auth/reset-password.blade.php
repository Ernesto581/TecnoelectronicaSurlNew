@extends('layouts.app')

@section('content')
<div class="min-h-screen flex items-center justify-center p-6 bg-gray-50 pt-28">
    <div class="w-full max-w-md">
        <div class="text-center mb-8">
            <h1 class="text-3xl font-bold text-gray-900">Nueva contraseña</h1>
            <p class="text-gray-500 mt-2">Elige una contraseña segura</p>
        </div>

        <div class="bg-white rounded-3xl border border-gray-200 shadow-sm p-8">
            <form method="POST" action="{{ route('password.store') }}" class="space-y-5">
                @csrf

                <input type="hidden" name="token" value="{{ $request->route('token') }}">

                <div>
                    <label for="email" class="block text-sm font-semibold text-gray-700 mb-2">Correo electrónico</label>
                    <input id="email" type="email" name="email" value="{{ old('email', $request->email) }}" class="w-full px-4 py-3 rounded-xl border border-gray-200 bg-gray-100 text-gray-600 outline-none text-sm cursor-not-allowed" readonly required autofocus autocomplete="username" />
                    @error('email') <p class="text-red-500 text-xs mt-1.5">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label for="password" class="block text-sm font-semibold text-gray-700 mb-2">Nueva contraseña</label>
                    <input id="password" type="password" name="password" class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:ring-2 focus:ring-[#46A040] focus:border-transparent outline-none text-sm @error('password') border-red-300 bg-red-50 @enderror" placeholder="Mínimo 8 caracteres" required autocomplete="new-password" />
                    @error('password') <p class="text-red-500 text-xs mt-1.5">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label for="password_confirmation" class="block text-sm font-semibold text-gray-700 mb-2">Confirmar contraseña</label>
                    <input id="password_confirmation" type="password" name="password_confirmation" class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:ring-2 focus:ring-[#46A040] focus:border-transparent outline-none text-sm" placeholder="Repite la contraseña" required autocomplete="new-password" />
                    @error('password_confirmation') <p class="text-red-500 text-xs mt-1.5">{{ $message }}</p> @enderror
                </div>

                <button type="submit" class="w-full py-3 bg-[#46A040] text-white font-semibold rounded-xl hover:bg-[#3d8c38] transition-colors shadow-sm">Restablecer contraseña</button>
            </form>
        </div>
    </div>
</div>
@endsection
