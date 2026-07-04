@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gray-50 pt-28">
    <div class="max-w-[1600px] mx-auto px-4 md:px-8 py-10">
        <div class="mb-8 flex items-start justify-between">
            <div>
                <h1 class="text-3xl font-bold text-gray-900">Panel de administración</h1>
                <p class="text-gray-600 mt-2">Accede a una vista de solo lectura para productos y usuarios admin.</p>
            </div>
            <button class="flex items-center gap-2 px-4 py-2 text-sm font-semibold text-red-600 bg-red-50 rounded-full hover:bg-red-100 transition-colors">
                <x-icon name="log-out" class="w-4 h-4" />
                Cerrar sesión
            </button>
        </div>

        <div class="grid gap-8 lg:grid-cols-[1.2fr_0.8fr]">
            <section class="bg-white rounded-3xl border border-gray-200 shadow-sm p-6">
                <div class="flex items-center gap-3 mb-6">
                    <x-icon name="package" class="w-6 h-6 text-[#46A040]" />
                    <div>
                        <h2 class="text-xl font-semibold text-gray-900">Productos</h2>
                        <p class="text-sm text-gray-500">Lista de los productos registrados.</p>
                    </div>
                </div>
                <div class="overflow-x-auto">
                    <table class="min-w-full text-left text-sm text-gray-700">
                        <thead>
                            <tr class="border-b border-gray-200">
                                <th class="py-3 px-4 font-medium">Nombre</th>
                                <th class="py-3 px-4 font-medium">Precio</th>
                                <th class="py-3 px-4 font-medium">Slug</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr class="border-b border-gray-100 hover:bg-gray-50">
                                <td class="py-4 px-4">Producto Ejemplo</td>
                                <td class="py-4 px-4 text-[#046b22] font-semibold">$99.99</td>
                                <td class="py-4 px-4 text-gray-500">producto-ejemplo</td>
                            </tr>
                            <tr class="border-b border-gray-100 hover:bg-gray-50">
                                <td class="py-4 px-4">Otro Producto</td>
                                <td class="py-4 px-4 text-[#046b22] font-semibold">$149.99</td>
                                <td class="py-4 px-4 text-gray-500">otro-producto</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </section>

            <section class="bg-white rounded-3xl border border-gray-200 shadow-sm p-6">
                <div class="flex items-center gap-3 mb-6">
                    <x-icon name="users" class="w-6 h-6 text-[#46A040]" />
                    <div>
                        <h2 class="text-xl font-semibold text-gray-900">Usuarios</h2>
                        <p class="text-sm text-gray-500">Listado de perfiles creados en la aplicación.</p>
                    </div>
                </div>
                <div class="space-y-3">
                    <div class="rounded-2xl border border-gray-100 p-4 bg-gray-50">
                        <div class="flex items-center justify-between gap-4">
                            <div>
                                <p class="font-semibold text-gray-900">Admin Principal</p>
                                <p class="text-sm text-gray-500">ID: 1</p>
                            </div>
                            <span class="inline-flex items-center rounded-full bg-[#ecf8ef] px-3 py-1 text-xs font-semibold text-[#23612d]">admin</span>
                        </div>
                    </div>
                    <div class="rounded-2xl border border-gray-100 p-4 bg-gray-50">
                        <div class="flex items-center justify-between gap-4">
                            <div>
                                <p class="font-semibold text-gray-900">Cliente Ejemplo</p>
                                <p class="text-sm text-gray-500">ID: 2</p>
                            </div>
                            <span class="inline-flex items-center rounded-full bg-[#ecf8ef] px-3 py-1 text-xs font-semibold text-[#23612d]">customer</span>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>
</div>
@endsection
