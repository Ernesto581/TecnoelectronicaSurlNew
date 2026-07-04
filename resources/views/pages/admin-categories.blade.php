@extends('layouts.app')

@section('content')
<div class="min-h-screen flex items-center justify-center bg-gray-50 px-4 py-16 pt-28">
    <div class="max-w-xl w-full bg-white rounded-3xl border border-gray-200 shadow-sm p-8 text-center">
        <h1 class="text-2xl font-bold text-gray-900 mb-4">Ruta desconectada</h1>
        <p class="text-gray-600 mb-6">La vista de administración clásica de categorías ya no está disponible. Usa el panel principal en <span class="font-semibold">/admin</span>.</p>
        <a href="/admin" class="inline-flex items-center justify-center px-5 py-3 rounded-full bg-[#46A040] text-white font-semibold transition-colors hover:bg-[#3d8c38]">Volver al panel admin</a>
    </div>
</div>
@endsection
