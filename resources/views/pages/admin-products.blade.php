@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gray-50 pt-28">
    <div class="max-w-[1600px] mx-auto px-4 md:px-8 py-10">
        <div class="flex items-start justify-between mb-8">
            <div>
                <h1 class="text-3xl font-bold text-gray-900">Productos</h1>
                <p class="text-gray-600 mt-2">Gestiona el catálogo de productos.</p>
            </div>
            <a href="/admin/products/new" class="inline-flex items-center gap-2 px-5 py-3 bg-[#46A040] text-white font-semibold rounded-full hover:bg-[#3d8c38] transition-colors shadow-sm">
                <x-icon name="plus" class="w-4 h-4" />
                Nuevo producto
            </a>
        </div>

        @if(session('success'))
        <div class="mb-6 px-5 py-3 bg-green-50 border border-green-200 text-green-700 rounded-xl text-sm font-medium">
            {{ session('success') }}
        </div>
        @endif

        <div class="bg-white rounded-3xl border border-gray-200 shadow-sm overflow-hidden">
            <div class="overflow-x-auto">
                <table class="min-w-full text-left text-sm text-gray-700">
                    <thead>
                        <tr class="border-b border-gray-200 bg-gray-50">
                            <th class="py-4 px-6 font-semibold text-gray-600">Nombre</th>
                            <th class="py-4 px-6 font-semibold text-gray-600">Categoría</th>
                            <th class="py-4 px-6 font-semibold text-gray-600">Precio</th>
                            <th class="py-4 px-6 font-semibold text-gray-600">Stock</th>
                            <th class="py-4 px-6 font-semibold text-gray-600">Estado</th>
                            <th class="py-4 px-6 font-semibold text-gray-600 text-right">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($products as $product)
                        <tr class="border-b border-gray-100 hover:bg-gray-50/50">
                            <td class="py-4 px-6">
                                <div class="flex items-center gap-3">
                                    <div class="w-10 h-10 rounded-lg bg-gray-100 overflow-hidden shrink-0">
                                        <img src="{{ $product->image_url ?? 'https://images.unsplash.com/photo-1585771724684-38269d6639fd?w=100&h=100&fit=crop' }}" alt="" class="w-full h-full object-cover" />
                                    </div>
                                    <span class="font-medium text-gray-900">{{ $product->name }}</span>
                                </div>
                            </td>
                            <td class="py-4 px-6 text-gray-500">{{ $product->category->name ?? 'Sin categoría' }}</td>
                            <td class="py-4 px-6">
                                <span class="font-semibold text-[#46A040]">${{ number_format($product->price, 2) }}</span>
                                @if($product->original_price)
                                <span class="text-xs text-gray-400 line-through ml-1">${{ number_format($product->original_price, 2) }}</span>
                                @endif
                            </td>
                            <td class="py-4 px-6">
                                <span class="{{ $product->stock < 5 ? 'text-red-600 font-semibold' : 'text-gray-700' }}">
                                    {{ $product->stock }}
                                </span>
                            </td>
                            <td class="py-4 px-6">
                                @if($product->active)
                                <span class="inline-flex items-center rounded-full bg-green-50 px-3 py-1 text-xs font-semibold text-green-700">Activo</span>
                                @else
                                <span class="inline-flex items-center rounded-full bg-gray-100 px-3 py-1 text-xs font-semibold text-gray-500">Inactivo</span>
                                @endif
                            </td>
                            <td class="py-4 px-6 text-right">
                                <div class="flex items-center justify-end gap-2">
                                    <a href="/admin/products/{{ $product->id }}/edit" class="px-3 py-1.5 text-xs font-semibold text-gray-600 bg-gray-100 rounded-lg hover:bg-gray-200 transition-colors">Editar</a>
                                    <form action="/admin/products/{{ $product->id }}" method="POST" onsubmit="return confirm('¿Eliminar este producto?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="px-3 py-1.5 text-xs font-semibold text-red-600 bg-red-50 rounded-lg hover:bg-red-100 transition-colors">Eliminar</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6" class="py-12 text-center">
                                <x-icon name="package" class="w-10 h-10 text-gray-300 mx-auto mb-3" />
                                <p class="text-gray-500 font-medium">No hay productos registrados</p>
                                <a href="/admin/products/new" class="inline-block mt-3 text-sm text-[#46A040] font-semibold hover:underline">Crear primer producto</a>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <div class="mt-4">
            <a href="/admin" class="text-sm text-gray-500 hover:text-gray-700 flex items-center gap-1">
                <x-icon name="chevron-left" class="w-4 h-4" />
                Volver al panel
            </a>
        </div>
    </div>
</div>
@endsection