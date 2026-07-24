@extends('layouts.app')

@section('content')
<div class="min-h-screen flex items-center justify-center p-6 bg-gray-50 pt-28">
    <div class="w-full max-w-md">
        <div class="text-center mb-8">
            <h1 class="text-3xl font-bold text-gray-900">Verificar correo</h1>
            <p class="text-gray-500 mt-2">Revisa tu bandeja de entrada</p>
        </div>

        <div class="bg-white rounded-3xl border border-gray-200 shadow-sm p-8">
            <p class="text-sm text-gray-600 mb-6">Gracias por registrarte. Antes de empezar, verifica tu correo electrónico con el enlace que te hemos enviado. Si no lo recibiste, te reenviamos otro.</p>

            @if (session('status') == 'verification-link-sent')
            <div class="mb-4 px-4 py-3 bg-green-50 border border-green-200 text-green-700 rounded-xl text-sm font-medium">Se ha enviado un nuevo enlace de verificación a tu correo.</div>
            @endif

            <div class="space-y-4">
                <form method="POST" action="{{ route('verification.send') }}">
                    @csrf
                    <button type="submit" class="w-full py-3 bg-[#46A040] text-white font-semibold rounded-xl hover:bg-[#3d8c38] transition-colors shadow-sm">Reenviar correo de verificación</button>
                </form>

                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="w-full py-3 bg-gray-100 text-gray-700 font-semibold rounded-xl hover:bg-gray-200 transition-colors">Cerrar sesión</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
