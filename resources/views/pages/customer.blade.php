@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gray-50 pt-28 pb-16">
    <div class="max-w-2xl mx-auto p-6">
        <div class="flex items-center justify-between mb-4">
            <h1 class="text-2xl font-bold">Mi perfil</h1>
            <button class="flex items-center gap-2 px-4 py-2 text-sm font-semibold text-red-600 bg-red-50 rounded-full hover:bg-red-100 transition-colors">
                <x-icon name="log-out" class="w-4 h-4" />
                Cerrar sesión
            </button>
        </div>
        <div class="bg-white p-6 rounded shadow">
            <p class="mb-2"><strong>Nombre:</strong> Usuario Ejemplo</p>
            <p class="mb-2"><strong>Email:</strong> usuario@ejemplo.com</p>
            <p class="mb-2"><strong>Rol:</strong> customer</p>
        </div>
    </div>
</div>
@endsection
