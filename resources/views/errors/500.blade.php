@extends('layouts.app')

@section('content')
<div class="min-h-screen flex items-center justify-center bg-gray-50 px-4 pt-28">
    <div class="text-center max-w-lg">
        <div class="w-20 h-20 rounded-2xl bg-orange-50 flex items-center justify-center mx-auto mb-6">
            <x-icon name="alert-triangle" class="w-10 h-10 text-orange-500" />
        </div>
        <h1 class="text-6xl font-black text-gray-900 mb-4">500</h1>
        <p class="text-xl font-semibold text-gray-900 mb-2">Error del servidor</p>
        <p class="text-gray-500 mb-8">Algo salió mal. Estamos trabajando para solucionarlo.</p>
        <a href="/" class="inline-flex items-center gap-2 px-6 py-3 bg-[#46A040] text-white font-semibold rounded-full hover:bg-[#3d8c38] transition-colors shadow-sm">
            <x-icon name="arrow-right" class="w-4 h-4" />
            Volver al inicio
        </a>
    </div>
</div>
@endsection
