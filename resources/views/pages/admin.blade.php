@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gray-50 pt-28">
    <div class="max-w-[1600px] mx-auto px-4 md:px-8 py-10">
        <div class="mb-8 flex items-start justify-between">
            <div>
                <h1 class="text-3xl font-bold text-gray-900">Panel de administración</h1>
                <p class="text-gray-600 mt-2">Gestiona productos, categorías y usuarios.</p>
            </div>
            <form action="/logout" method="POST">
                @csrf
                <button type="submit" class="flex items-center gap-2 px-4 py-2 text-sm font-semibold text-red-600 bg-red-50 rounded-full hover:bg-red-100 transition-colors">
                    <x-icon name="log-out" class="w-4 h-4" />
                    Cerrar sesión
                </button>
            </form>
        </div>

        <div class="grid grid-cols-2 md:grid-cols-4 gap-4 mb-8">
            <a href="/admin/products" class="bg-white rounded-2xl border border-gray-200 p-5 shadow-sm hover:shadow-md transition-all hover:border-[#46A040]/30 block group">
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 rounded-xl bg-[#46A040]/10 flex items-center justify-center group-hover:bg-[#46A040]/20 transition-colors">
                        <x-icon name="package" class="w-5 h-5 text-[#46A040]" />
                    </div>
                    <div>
                        <p class="text-2xl font-bold text-gray-900">{{ $stats['products_count'] }}</p>
                        <p class="text-xs text-gray-500">Productos</p>
                    </div>
                </div>
            </a>
            <a href="/admin/categories" class="bg-white rounded-2xl border border-gray-200 p-5 shadow-sm hover:shadow-md transition-all hover:border-[#46A040]/30 block group">
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 rounded-xl bg-orange-50 flex items-center justify-center group-hover:bg-orange-100 transition-colors">
                        <x-icon name="tv" class="w-5 h-5 text-orange-600" />
                    </div>
                    <div>
                        <p class="text-2xl font-bold text-gray-900">{{ $stats['categories_count'] }}</p>
                        <p class="text-xs text-gray-500">Categorías</p>
                    </div>
                </div>
            </a>
            <div class="bg-white rounded-2xl border border-gray-200 p-5 shadow-sm">
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 rounded-xl bg-blue-50 flex items-center justify-center">
                        <x-icon name="users" class="w-5 h-5 text-blue-600" />
                    </div>
                    <div>
                        <p class="text-2xl font-bold text-gray-900">{{ $stats['users_count'] }}</p>
                        <p class="text-xs text-gray-500">Usuarios</p>
                    </div>
                </div>
            </div>
            <div class="bg-white rounded-2xl border border-gray-200 p-5 shadow-sm">
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 rounded-xl bg-red-50 flex items-center justify-center">
                        <x-icon name="alert-triangle" class="w-5 h-5 text-red-600" />
                    </div>
                    <div>
                        <p class="text-2xl font-bold text-gray-900">{{ $stats['low_stock'] }}</p>
                        <p class="text-xs text-gray-500">Stock bajo</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="grid gap-8 lg:grid-cols-2">
            <section class="bg-white rounded-3xl border border-gray-200 shadow-sm p-6">
                <div class="flex items-center justify-between mb-6">
                    <div class="flex items-center gap-3">
                        <x-icon name="package" class="w-6 h-6 text-[#46A040]" />
                        <div>
                            <h2 class="text-xl font-semibold text-gray-900">Productos</h2>
                            <p class="text-sm text-gray-500">{{ $stats['products_count'] }} registrados.</p>
                        </div>
                    </div>
                    <a href="/admin/products" class="text-sm font-semibold text-[#46A040] hover:underline">Gestionar</a>
                </div>
                <div class="overflow-x-auto">
                    <table class="min-w-full text-left text-sm text-gray-700">
                        <thead>
                            <tr class="border-b border-gray-200">
                                <th class="py-3 px-4 font-medium">Nombre</th>
                                <th class="py-3 px-4 font-medium">Categoría</th>
                                <th class="py-3 px-4 font-medium">Precio</th>
                                <th class="py-3 px-4 font-medium">Stock</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($products as $product)
                            <tr class="border-b border-gray-100 hover:bg-gray-50">
                                <td class="py-4 px-4 font-medium">{{ $product->name }}</td>
                                <td class="py-4 px-4 text-gray-500">{{ $product->category->name ?? 'Sin categoría' }}</td>
                                <td class="py-4 px-4 text-[#46A040] font-semibold">${{ number_format($product->price, 2) }}</td>
                                <td class="py-4 px-4">
                                    <span class="{{ $product->stock < 5 ? 'text-red-600 font-semibold' : 'text-gray-600' }}">
                                        {{ $product->stock }}
                                    </span>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="4" class="py-8 text-center text-gray-400">No hay productos registrados.</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </section>

            <section class="bg-white rounded-3xl border border-gray-200 shadow-sm p-6">
                <div class="flex items-center justify-between mb-6">
                    <div class="flex items-center gap-3">
                        <x-icon name="tv" class="w-6 h-6 text-orange-500" />
                        <div>
                            <h2 class="text-xl font-semibold text-gray-900">Categorías</h2>
                            <p class="text-sm text-gray-500">{{ $stats['categories_count'] }} registradas.</p>
                        </div>
                    </div>
                    <a href="/admin/categories" class="text-sm font-semibold text-orange-500 hover:underline">Gestionar</a>
                </div>
                <div class="space-y-2">
                    @forelse($categories as $cat)
                    <div class="flex items-center justify-between rounded-2xl border border-gray-100 p-3 hover:bg-gray-50 transition-colors">
                        <div class="flex items-center gap-3">
                            <div class="w-9 h-9 rounded-xl bg-gray-100 flex items-center justify-center overflow-hidden">
                                @if($cat->image)
                                <img src="{{ $cat->image }}" alt="" class="w-full h-full object-cover" />
                                @else
                                <x-icon name="{{ $cat->icon ?? 'tv' }}" class="w-4 h-4 text-gray-600" />
                                @endif
                            </div>
                            <div>
                                <p class="font-semibold text-gray-900 text-sm">{{ $cat->name }}</p>
                                <p class="text-xs text-gray-400">{{ $cat->products_count }} productos</p>
                            </div>
                        </div>
                        <span class="text-xs text-gray-400">/{{ $cat->slug }}</span>
                    </div>
                    @empty
                    <p class="text-center text-gray-400 py-6 text-sm">No hay categorías creadas.</p>
                    @endforelse
                </div>
            </section>
        </div>
    </div>
</div>
@endsection